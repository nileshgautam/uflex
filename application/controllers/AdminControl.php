<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminControl extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->library('session');
		$this->load->model('CustomModel');
		$this->load->helper('datefilter');
		if (!isset($_SESSION['userInfo'])) {
			$this->session->sess_destroy();
			redirect('/');
		}
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $data['title'] = 'UFLEX Admin- Dashboard';
		// $this->load->view('layout/header', $data);
		// $this->load->view('admin/layout/sidenavbar');
		// $this->load->view('admin/layout/index');
		// $this->load->view('layout/footer');
		redirect(__CLASS__.'/users_list');
	}
	public function users_list()
	{
		$data['title'] = 'UFLEX Admin- Users list';

		$tableName = "users";
		$where = "role !='admin'";
		$result['users'] = $this->CustomModel->getwhere($tableName, $where);

		$this->load->view('layout/header', $data);
		$this->load->view('admin/layout/sidenavbar');
		$this->load->view('admin/pages/users-list', $result);
		$this->load->view('layout/footer');
	}
	public function add_users()
	{
		$data['title'] = 'UFLEX Admin- Add user';

		$tableRole = "user_role";
		$tableContry = "master_countries";
		$where = array('status' => 1);
		$result['role'] = $this->CustomModel->getwhere($tableRole, $where);
		$result['country'] = $this->CustomModel->selectAll($tableContry);

		$this->load->view('layout/header', $data);
		$this->load->view('admin/layout/sidenavbar');
		$this->load->view('admin/pages/users', $result);
		$this->load->view('layout/footer');
	}
	public function edit_users($id = null)
	{
		$tableName = "users";
		$tableRole = "user_role";
		$tableContry = "master_countries";

		$data['title'] = 'UFLEX Admin- Edit user';

		$where = array('id' => base64_decode($id));
		$condition = array('status' => 1);

		$result['role'] = $this->CustomModel->getwhere($tableRole, $condition);
		$result['country'] = $this->CustomModel->selectAll($tableContry);
		$result['users'] = $this->CustomModel->getwhere($tableName, $where);

		$this->load->view('layout/header', $data);
		$this->load->view('admin/layout/sidenavbar');
		$this->load->view('admin/pages/users', $result);
		$this->load->view('layout/footer');
	}

	// function to extract all the state from the database.
	public function get_state()
	{
		$id = $this->input->post('c_id');
		$tableState = "master_states";
		$condition = array('country_id' => $id);
		$data = $this->CustomModel->getwhere($tableState, $condition);
		$myjson = json_encode($data, true);
		echo $myjson;
	}

	// function to extract all the city from the database.
	public function get_cities()
	{
		$id = $this->input->post('c_id');
		$tableState = "master_cities";
		$condition = array('state_id' => $id);
		$data = $this->CustomModel->getwhere($tableState, $condition);
		$myjson = json_encode($data, true);
		echo $myjson;
	}

	// Function to insert users details in DB
	public function user_post()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST)) {

				$first_name = validateInput($_POST['first-name']);
				$last_name = validateInput($_POST['last-name']);
				$gender = validateInput($_POST['gender']);
				$dob = $_POST['dob'];
				$doj = $_POST['doj'];
				$address = validateInput($_POST['address']);
				$country = validateInput($_POST['country']);
				$state = validateInput($_POST['state']);
				$city = validateInput($_POST['city']);
				$pin = validateInput($_POST['zip-pin-code']);
				$email = validateInput($_POST['email']);
				$password = validateInput($_POST['confirm-password']);
				$role = validateInput($_POST['role']);
				$mobile_no = validateInput($_POST['mobile-no']);

				$tableUsers = 'users';

				$condition = array('email' => $email, 'mobile' => $mobile_no);

				$res = $this->CustomModel->getWhere($tableUsers, $condition);

				if ($res > 0) {
					echo $response = json_encode(array('message' => 'Users already exits. ', 'type' => 'danger', 'path' => 'admin/users'), true);
				} else {
					$data = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'gender' => $gender,
						'dob' => $dob,
						'joining_date' => $doj,
						'address' => $address,
						'country' => $country,
						'state' => $state,
						'city' => $city,
						'role' => $role,
						'password' => $password,
						'email' => $email,
						'zip_pin' => $pin,
						'mobile' => $mobile_no
					);

					$result = $this->CustomModel->insertInto($tableUsers, $data);
					if ($result > 0) {
						echo $response = json_encode(array('message' => 'Users details successfully saved. ', 'type' => 'success'), true);
					} else {
						echo $response = json_encode(array('message' => 'Something went wrong Contact IT', 'type' => 'danger'), true);
					}
				}
			} else {
				echo $response = json_encode(array('message' => 'Empty form not allowed.', 'type' => 'danger'), true);
			}
		}
	}

	// Function to edit users details in DB
	public function user_edit_post()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST)) {
				$id = validateInput($_POST['id']);
				$first_name = validateInput($_POST['first-name']);
				$last_name = validateInput($_POST['last-name']);
				$gender = validateInput($_POST['gender']);
				$dob = $_POST['dob'];
				$doj = $_POST['doj'];
				$address = validateInput($_POST['address']);
				$country = validateInput($_POST['country']);
				$state = validateInput($_POST['state']);
				$city = validateInput($_POST['city']);
				$pin = validateInput($_POST['zip-pin-code']);
				$email = validateInput($_POST['email']);
				$password = validateInput($_POST['confirm-password']);
				$role = validateInput($_POST['role']);
				$mobile_no = validateInput($_POST['mobile-no']);
				$tableUsers = 'users';
				$condition = array('id' => $id);

				$data = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'gender' => $gender,
					'dob' => $dob,
					'joining_date' => $doj,
					'address' => $address,
					'country' => $country,
					'state' => $state,
					'city' => $city,
					'role' => $role,
					'password' => $password,
					'email' => $email,
					'zip_pin' => $pin,
					'mobile' => $mobile_no
				);

				$result = $this->CustomModel->update_table($tableUsers, $condition, $data);

				if ($result > 0) {
					echo  json_encode(array('message' => 'Users details updated successfully. ', 'type' => 'success', 'path' => 'admin/users'), true);
				} else {
					echo  json_encode(array('message' => 'Something went wrong Contact IT', 'type' => 'danger', 'path' => 'admin/users'), true);
				}
			} else {
				echo  json_encode(array('message' => 'Empty form not allowed.', 'type' => 'danger'), true);
			}
		}
	}


	// Funtion to show setting

	public function setting()
	{
		$data['title'] = 'UFLEX Admin- Setting';
		$this->load->view('layout/header', $data);
		$this->load->view('admin/layout/sidenavbar');
		$this->load->view('layout/change-password-admin');
		$this->load->view('layout/footer');
	}
}
