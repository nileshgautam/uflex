<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LondonControl extends CI_Controller
{

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

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->library('session');
		$this->load->model('CustomModel');
		$this->load->helper('datefilter');
		if (!isset($_SESSION['userInfo'])) {
			$this->session->sess_destroy();
			redirect('UserAuthenticationControl/index');
		}
	}
	public function index()
	{
		$tableName = 'london_stock';
		// $condition = array('send_status' => SENT);
		$result['invoice'] = $this->CustomModel->selectAll($tableName);
		$this->load->view('london/layout/header');
		$this->load->view('london/layout/sidenavbar');
		// $this->load->view('london/layout/index');
		$this->load->view('london/pages/stock-invoice', $result);

		$this->load->view('london/layout/footer');
	}

	public function stock_invoice()
	{
		$tableName = 'london_stock';
		// $condition = array('send_status' => SENT);
		$result['invoice'] = $this->CustomModel->selectAll($tableName);

		$tablename = 'master_invoice';
		$condition = array('send_status' => SENT);
		$result['r'] = $this->CustomModel->selectAllFromWhere($tablename, $condition);
		$result['count'] = ($result['r'] != 0) ? count($result['r']) : 0;

		$this->load->view('london/layout/header');
		$this->load->view('london/layout/sidenavbar',$result);
		$this->load->view('london/pages/stock-invoice', $result);
		$this->load->view('london/layout/footer');
	}

	public function add_invoice()
	{
		$this->load->view('london/layout/header');
		$this->load->view('london/layout/sidenavbar');
		$this->load->view('london/pages/add-invoice');
		$this->load->view('london/layout/footer');
	}

	public function upload_invoice()
	{
		$this->load->view('london/layout/header');
		$this->load->view('london/layout/sidenavbar');
		$this->load->view('london/pages/upload-multiple-invoce');
		$this->load->view('london/layout/footer');
	}
	// INSERT INVOICE details INTO THE DATABASE

	public function update_invoice()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (!empty($_POST)) {
				$invoiceNumber = $this->input->post('invoiceNumber');
				$tableName = 'master_invoice';
				$condition = array('invoice_number' => validateInput($invoiceNumber));
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
								'invoice_number' => validateInput($this->input->post('invoiceNumber')),
								'invoice_date' => $date,
								'item_code' => validateInput($productlist[$i]['producCode']),
								'item_description' => validateInput($productlist[$i]['producDetails']),
								'qty' => $productlist[$i]['productQuantity'],
								'rate' => $productlist[$i]['productRate'],
								'amount' => $productlist[$i]['productAmount'],
								'update_by' => $_SESSION['userInfo']['username'],
								'last_updated' => $timestamp
							);
							array_push($rows, $data);
						}
						// print_r($rows);

						$tablename = 'london_stock';
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
	}

	public function invoice()
	{
		$tableName = 'master_invoice';
		$condition = array('send_status' => SENT);
		$result['invoice'] = $this->CustomModel->selectAllFromWhere($tableName, $condition);
		$result['count'] = ($result['invoice'] != 0) ? count($result['invoice']) : 0;

		$this->load->view('london/layout/header');
		$this->load->view('london/layout/sidenavbar', $result);
		$this->load->view('london/pages/invoice', $result);
		$this->load->view('london/layout/footer');
	}

	public function accept_invoice_multiple()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST)) {
				// echo '<pre>';
				$selected_invoice = $_POST['invoice_numbers'];
				// print_r($_POST);
				if (!empty($selected_invoice)) {
					$tableName = 'master_invoice';
					$timestamp = date("Y-m-d H:i:s");
					$status = array('send_status' => ACCEPT);
					for ($i = 0; $i < count($selected_invoice); $i++) {
						$date = yymmdd($selected_invoice[$i]['doi']);
						$data = array('send_status' => 10);
						$condition = array(
							'invoice_number' => validateInput($selected_invoice[$i]['invoice_number']),
							'doi' => $date,
							'product_code' => validateInput($selected_invoice[$i]['product_code']),
						);

						$result = $this->CustomModel->selectAllFromWhere($tableName, $condition);
						$data = array(
							'invoice_number' => $result[0]['invoice_number'],
							'item_code' => $result[0]['product_code'],
							'invoice_date' => $result[0]['doi'],
							'item_description' => $result[0]['product_description'],
							'qty' => $result[0]['product_qty'],
							'amount' => $result[0]['product_amount'],
							'rate' => $result[0]['product_rate'],
							'update_by' => $_SESSION['userInfo']['username'],
							'last_updated' => $timestamp
						);
						$tablename = 'london_stock';
						$inr_data = $this->CustomModel->insertInto($tablename, $data);
						$res = $this->CustomModel->update_table($tableName, $condition, $status);
					}
					echo $responce = json_encode(array('message' => 'Stock updated', 'type' => 'success'), true);
				} else {
					echo $responce = json_encode(array('message' => 'OOPs... system error Contact IT', 'type' => 'error'), true);
				}
			}
		}
	}

	public function accept_invoice()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST)) {
				$id = base64_decode($_POST['id']);
				// print_r($id);
				$tableName = 'master_invoice';
				$timestamp = date("Y-m-d H:i:s");
				if (isset($id)) {
					$status = array('send_status' => ACCEPT);
					$condition = array('id' => $id);
					$result = $this->CustomModel->selectAllFromWhere($tableName, $condition); // Checking row into the data base

					$data = array(
						'invoice_number' => $result[0]['invoice_number'],
						'item_code' => $result[0]['product_code'],
						'invoice_date' => $result[0]['doi'],
						'item_description' => $result[0]['product_description'],
						'qty' => $result[0]['product_qty'],
						'amount' => $result[0]['product_amount'],
						'rate' => $result[0]['product_rate'],
						'update_by' => $_SESSION['userInfo']['username'],
						'last_updated' => $timestamp
					);

					$tablename = 'london_stock';
					$inr_data = $this->CustomModel->insertInto($tablename, $data);

					if ($inr_data > 0) {
						$res = $this->CustomModel->update_table($tableName, $condition, $status); //Updating the accept status 
						echo json_encode(array('message' => 'Invoice accepted and stock updated successfuly', 'type' => 'success'));
					} else {
						echo json_encode(array('message' => 'Something went worng please contact IT', 'type' => 'danger'));
					}
				}
			}
		}
	}

	public function reject_invoice()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST)) {
				$id = base64_decode($_POST['id']);
				$remark = validateInput($_POST['reason']);
				if ($remark != '' && $remark != null) {
					$tableName = 'master_invoice';
					$condition = array('send_status' => SENT, 'id' => $id);
					$result = $this->CustomModel->selectAllFromWhere($tableName, $condition);
					if ($result > 0) {
						$data = array('send_status' => REJECTED ,'reject_reason'=>$remark);
						$res = $this->CustomModel->update_table($tableName, $condition, $data);
						if ($res > 0) {
							echo $response = json_encode(array('message' => 'Success! Invoices rejected', 'type' => 'success'), true);
						} else {
							echo $response = json_encode(array('message' => 'Error! Opps... Contact IT', 'type' => 'error'), true);
						}
					}
				} else {
					echo $response = json_encode(array('message' => 'Error! Reject reason is required..', 'type' => 'danger'), true);
				}
			} else {
				echo $response = json_encode(array('message' => 'Error! Opps... Something went wrong, contact IT', 'type' => 'danger'), true);
			}
		}
	}
}
