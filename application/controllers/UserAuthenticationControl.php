<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserAuthenticationControl extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Load session library
        $this->load->library('session');
        $this->load->model('CustomModel');
    }

    // Show login page
    public function index()
    {
        $this->load->view('login/login');
    }

    public function forgotpassword()
    {
        $this->load->view('login/forgot-password');
    }

    public function dashboard()
    {
        $data['users'] = $this->CustomModel->getAllUsers();
        $this->load->view('layout/header');
        $this->load->view('pages/dashboard', $data);
        $this->load->view('layout/footer');
    }

    // validate user login by role
    function auth()
    {
        //    print_r($_POST);die;
        $username = $this->input->post('inputEmail');
        $password = $this->input->post('password');
        $remember_me = $this->input->post('remember_me');
        if (isset($remember_me)) {
            $remember_me = 1;
        } else {
            $remember_me = 0;
        }
        if ($username == "" &&  $password == "") {
            $message = json_encode(array('msg' => 'Warning! username and password are required', 'type' => 'danger'), true);
            echo $message;
        } elseif ($username == "") {
            $message = json_encode(array('msg' => 'Warning! username is required', 'type' => 'danger'), true);
            echo $message;
        } elseif ($password == '') {
            $message = json_encode(array('msg' => 'Warning! password is required', 'type' => 'danger'), true);
            echo $message;
        } else {
            $this->load->model('CustomModel');
            $tableName = 'users';
            $condition = array('email' => $username, 'password' => $password);
            $result = $this->CustomModel->selectAllFromWhere($tableName, $condition);
            if ($result == 0) {
                $message = json_encode(array('msg' => 'Please enter vaild details', 'type' => 'danger'), true);
                echo $message;
            } elseif ($result != 0) {
                $data  = $result;
                $id    = $data[0]['id'];
                $name  = $data[0]['first_name'] . " " . $data[0]['last_name'];
                $email = $data[0]['email'];
                $user_role = $data[0]['role'];
                $sesdata = array(
                    'id'       =>  $id,
                    // 'company' => $company_id,
                    'username'  => $name,
                    'email'     => $email,
                    'user_role' => $user_role,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata("userInfo", $sesdata);

                $result = json_encode(array('msg' => 'true', 'type' => 'success', 'role' => $user_role, 'remember_me' => $remember_me), true);
                echo $result;
            }
        }
    }

    // Check for user login process
    // public function user_login_process()
    // {
    //     // print_r($_POST);
    //     // die;
    //     $username = $this->input->post('username');
    //     $password = $this->input->post('password');
    //     $remember_me = $this->input->post('remember_me');
    //     if (isset($remember_me)) {
    //         $remember_me = 1;
    //     } else {
    //         $remember_me = 0;
    //     }
    //     if ($username == "" &&  $password == "") {
    //         $message = json_encode(array('msg' => 'Warning! username and password are required', 'type' => 'danger'), true);
    //         echo $message;
    //     } elseif ($username == "") {
    //         $message = json_encode(array('msg' => 'Warning! username required', 'type' => 'danger'), true);
    //         echo $message;
    //     } elseif ($password == '') {
    //         $message = json_encode(array('msg' => 'Warning! password required', 'type' => 'danger'), true);
    //         echo $message;
    //     } else {
    //         $this->load->model('CustomModel');
    //         $tableName = 'users';
    //         $condition = array('email' => $username, 'password' => $password);
    //         $result = $this->CustomModel->getAllfromWhere($tableName, $condition);
    //         if ($result == 0) {
    //             $message = json_encode(array('msg' => 'Warning! username and password invalid', 'type' => 'danger'), true);
    //             echo $message;
    //         } elseif ($result != 0) {
    //             $sess_data = array(
    //                 'username' => $username,
    //                 'password' => $password,
    //                 'name' => $result[0]['first_name'] . ' ' . $result[0]['last_name']
    //             );
    //             $this->session->set_userdata('logged_in', $sess_data);
    //             $result = json_encode(array('msg' => 'true', 'type' => 'success', 'remember_me' => $remember_me), true);
    //             echo $result;
    //         }
    //     }
    // }

    // Logout from admin page
    public function logout()
    {
        // Destroy session data
        $this->session->sess_destroy();
        redirect('/');
        // $data['message_display'] = 'Successfully Logout';
    }

    // user registration
    public function userRegitration()
    {
        if (!empty($_POST)) {
            $email = $this->input->post('user-email');
            $password = $this->input->post('user-pass');
            $checkUser = $this->CustomModel->checkUser($email);
            if (isset($checkUser)) {
                echo json_encode(array('message' => 'Email already exsit, back to login', 'type' => 'danger'), true);
            } else {
                //generate simple random code
                $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $code = substr(str_shuffle($set), 0, 12);
                $user['email'] = $email;
                $user['password'] = $password;
                $user['code'] = $code;
                $user['active'] = false;
                $id = $this->CustomModel->insert($user);
                //set up email
                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'nileshwephyre@gmail.com', // change it to yours
                    'smtp_pass' => 'gautam@1990', // change it to yours
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE
                );


                $message =     "
          <html>
          <head>
              <title>Verification Code</title>
          </head>
          <body>
              <h2>Thank you for Registering.</h2>
              <p>Your Account:</p>
              <p>Email: " . $email . "</p>
              <p>Password: " . $password . "</p>
              <p>Please click the link below to activate your account.</p>
              <h4><a href='" . base_url() . "User_Authentication/activate/" . $id . "/" . $code . "'>Activate My Account</a></h4>
          </body>
          </html>
          ";

                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($config['smtp_user']);
                $this->email->to($email);
                $this->email->subject('Signup Verification Email');
                $this->email->message($message);

                //sending email
                if ($this->email->send()) {
                    echo json_encode(array('message' => 'Activation code sent to email', 'type' => 'success'), true);
                } else {
                    echo json_encode(array('message' => $this->email->print_debugger(), 'type' => 'error'), true);
                }
            }
        }
        //    redirect(__CLASS__.'/index');
    }
    public function activate()
    {
        $id =  $this->uri->segment(3);
        $code = $this->uri->segment(4);

        //fetch user details
        $user = $this->CustomModel->getUser($id);

        //if code matches
        if ($user['code'] == $code) {
            //update user active status
            $data['active'] = true;
            $query = $this->CustomModel->activate($data, $id);

            if ($query) {
                $this->session->set_flashdata('message', 'User activated successfully');
            } else {
                $this->session->set_flashdata('message', 'Something went wrong in activating account');
            }
        } else {
            $this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
        }

        redirect(__CLASS__ . '/index');
    }
    // Validate password for changing current password
    public function check_password()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST)) {

                $id = $_SESSION['userInfo']['id'];
                $password = validateInput($this->input->post('password'));

                $table_users = "users";
                $condition = array('id' => $id);
                $data = $this->CustomModel->getwhere($table_users, $condition);

                if ($data > 0) {
                    if ($data[0]['password'] == $password) {
                        echo json_encode(array('res' => true));
                    } else {
                        echo json_encode(array('res' => false));
                    }
                } else {
                    echo json_encode(array('res' => 'OOps! Something went wrong contact IT', 'type' => 'danger'));
                }
            } else {
                echo json_encode(array('res' => 'Enter current password', 'type' => 'danger'), true);
            }
        }
    }
    // Function Validating and updating current password
    public function update_password()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST)) {
                $id = $_SESSION['userInfo']['id'];
                $old_password = validateInput($this->input->post('oldpassword'));

                $table_users = 'users';

                $where = array('id' => $id, 'password' => $old_password);

                $result = $this->CustomModel->getwhere($table_users, $where); // validating record exist or not into the DB

                if ($result > 0) {
                    $new_password = validateInput($_POST['newpassword']);

                    $condition = array('id' => $id);

                    $data = array('password' => $new_password);

                    $res = $this->CustomModel->update_table($table_users, $condition, $data); //Updating new password inTo the DB.
                    if ($res > 0) {
                        echo json_encode(array('message' => 'Password changed', 'type' => 'success'), true);
                    } else {
                        echo json_encode(array('message' => 'OOps..! Contact IT', 'type' => 'danger'), true);
                    }
                } else {
                    echo json_encode(array('message' => 'Current password invalid', 'type' => 'danger'), true);
                }
            }
        }
    }
}
