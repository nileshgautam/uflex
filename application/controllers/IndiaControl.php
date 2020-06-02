<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndiaControl extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Load session library
		date_default_timezone_set('Asia/Kolkata');
		$this->load->library('session');
		$this->load->model('CustomModel');
		$this->load->helper('datefilter');
		if (!isset($_SESSION['userInfo'])) {
			$this->session->sess_destroy();
			redirect('UserAuthenticationControl/index');
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
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/layout/index');
		$this->load->view('india/layout/footer');
	}

	public function sent_invoice($var = null)
	{
		# code...
		// sent-invoice
		$tableName = 'master_invoice';
		$condition = array('send_status' => 1);
		$result['invoice'] = $this->CustomModel->selectAllFromWhere($tableName, $condition);
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/pages/sent-invoice', $result);
		$this->load->view('india/layout/footer');
	}
	// Function to Show list of all the latest invocie ever
	public function invoice()
	{
		$tableName = 'master_invoice';
		$condition = array('send_status' => 0);
		$result['invoice'] = $this->CustomModel->selectAllFromWhere($tableName, $condition);
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/pages/invoice', $result);
		$this->load->view('india/layout/footer');
	}
	// Function to show add invoice details 
	public function addinvoice()
	{
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/pages/add-invoice');
		$this->load->view('india/layout/footer');
	}
	// Function to show all upload multiple invocie by csv file 
	public function uploadmultipleinvoce()
	{
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/pages/upload-multiple-invoce');
		$this->load->view('india/layout/footer');
	}
	// INSERT INVOICE details INTO THE DATABASE
	function postinvoice()
	{
		if (!empty($_POST)) {
			$invoiceNumber = $this->input->post('invoiceNumber');
			$tableName = 'master_invoice';
			$condition = array('invoice_number' => $this->db->escape($invoiceNumber));
			$result = $this->CustomModel->getWhere($tableName, $condition);
			$timestamp = date("Y-m-d H:i:s");

			if ($result > 0) {
				json_encode(array('messages' => 'Invoice already exist', 'type' => 'worning'));
			} else {
				if (!empty($_POST)) {
					$productlist =  $this->input->post('products');
					$doi = $this->input->post('dateOfinvoice');
					$date = yymmdd($doi);
					$rows = array();
					for ($i = 0; $i < count($productlist); $i++) {
						$data = array(
							'invoice_number' => $this->db->escape($this->input->post('invoiceNumber')),
							'doi' => $date,
							'product_code' => $this->db->escape($productlist[$i]['producCode']),
							'product_description' =>$this->db->escape($productlist[$i]['producDetails']),
							'product_qty' => $productlist[$i]['productQuantity'],
							'product_rate' => $productlist[$i]['productRate'],
							'product_amount' => $productlist[$i]['productAmount'],
							'entered_by' => $_SESSION['userInfo']['username'],
							'entery_datetime' => $timestamp,
							'send_status' => $timestamp,
						);
						array_push($rows, $data);
					}
					// print_r($rows);
					$this->load->model('CustomModel');
					$tablename = 'master_invoice';
					$result = $this->CustomModel->insertBatch($tablename, $rows);
					// print_r($result);
					if ($result > 0) {
						echo json_encode(array('messages' => 'Invoice submited successfuly', 'type' => 'success'));
					} else {
						echo json_encode(array('messages' => 'Something went worng please contact IT', 'type' => 'error'));
					}
				}
			}
		}
	}

	// Function to show invoice edit view
	public function eiditinvoce($invoiceNumber = null, $productCode = null)
	{
		$tableName = 'master_invoice';
		$condition = array('invoice_number' => base64_decode($invoiceNumber), 'product_code' => base64_decode($productCode));
		$result['invoice'] = $this->CustomModel->selectAllFromWhere($tableName, $condition);
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/pages/edit-invoice', $result);
		$this->load->view('india/layout/footer');
	}

	// Function to Update invoce details 
	public function update_invoice()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST)) {
				// print_r($_POST);
				$invoice_number = $this->db->escape($_POST['invoice-number']);
				$product_code = $this->db->escape($_POST['icode']);
				$product_description = $this->db->escape($_POST['idec']);
				$timestamp = date("Y-m-d H:i:s");
				$date = $_POST['doi'];
				$inv_arr = array(
					'invoice_number' => $invoice_number,
					'doi' => $date,
					'product_code' => $product_code,
					'product_description' => $product_description,
					'product_qty' => $_POST['iqty'],
					'product_rate' => $_POST['irate'],
					'product_amount' => $_POST['amount'],
					'entered_by'   => $_SESSION['userInfo']['username'],
					'entery_datetime'  => $timestamp
				);

				$tableName='master_invoice';

				$condition=array(
					'id'=>$_POST['invoice-id']
				);

				// print_r($inv_arr);

				$res= $this->CustomModel->update_table($tableName , $condition, $inv_arr);
				if($res>0){
					echo $response=json_encode(array('message'=>'Success! Invoices updated', 'type'=>'success'),true);
				}else{
					echo $response=json_encode(array('message'=>'Error! Opps... Contact IT', 'type'=>'error'),true);
				}
			}
		}
	}
}
