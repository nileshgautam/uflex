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
	public function invoice()
	{
		$result['invoice']=$this->CustomModel->selectAll('master_invoice');
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/pages/invoice',$result);
		$this->load->view('india/layout/footer');
	}
	public function addinvoice()
	{
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/pages/add-invoice');
		$this->load->view('india/layout/footer');
	}
	public function editinvoce()
	{
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/pages/add-invoice');
		$this->load->view('india/layout/footer');
	}
	public function uploadmultipleinvoce()
	{
		$this->load->view('india/layout/header');
		$this->load->view('india/layout/sidenavbar');
		$this->load->view('india/pages/upload-multiple-invoce');
		$this->load->view('india/layout/footer');
	}

	// INSERT INVOICE POST DATA IN TO THE DATABASE
	function postinvoice()
	{
		// echo '<pre>';
		// productlist

		if (!empty($_POST)) {

			$invoiceNumber = $this->input->post('invoiceNumber');
			$tableName = 'master_invoice';
			$condition = array('invoice_number' => $invoiceNumber);
			$result = $this->CustomModel->getWhere($tableName, $condition);
			$timestamp = date("Y-m-d H:i:s");

			if ($result > 0) {
				json_encode(array('messages' => 'Invoice already exist', 'type' => 'worning'));
			} else {
				if (!empty($_POST)) {
					$productlist = $this->input->post('products');
					$doi = $this->input->post('dateOfinvoice');
					$date = yymmdd($doi);
					$rows = array();
					for ($i = 0; $i < count($productlist); $i++) {
						$productlist[$i]['invoicenumber'] = $this->input->post('invoiceNumber');
						$productlist[$i]['dateOfInvoice'] = $this->input->post('dateOfinvoice');
						$data = array(
							'invoice_number' => $productlist[$i]['invoicenumber'],
							'doi' => $date,
							'product_code' => $productlist[$i]['producCode'],
							'product_description' => $productlist[$i]['producDetails'],
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

	function timezone()
	{
		$timezone = $date = date('m-d-Y h:i:s a', time());
	}
	
}
