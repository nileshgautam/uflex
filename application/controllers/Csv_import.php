<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Csv_import extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Load session library
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('csv_import_model');
		$this->load->model('CustomModel');
		if (!isset($_SESSION['userInfo'])) {
			$this->session->sess_destroy();
			redirect('UserAuthenticationControl/index');
		}
	}

	// Function to import data from excel/csv
	function import()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_FILES['csv_file'])) {

				$file = $_FILES['csv_file']['tmp_name'];
				$filename = $_FILES['csv_file']['name'];
				$extension = pathinfo($filename, PATHINFO_EXTENSION);
				// echo $extension;
				// checking file extention for inputs validation
				if (!empty($extension)) {
					if ($extension != 'csv') {
						echo $responce = json_encode(array('message' => 'Warning! Only CSV file is allowed. ', 'type' => 'warning'), true);
					} else {
						if (!is_readable($file)) {
							echo $responce = json_encode(array('message' => 'error', "File is not readable.", 'type' => 'danger'), true);
						} else {

							$objPHPExcel = PHPExcel_IOFactory::load($file); //Creating file object 
							$invoices_list = $objPHPExcel->getSheetByName('invoice');


							$invoice_collection = $invoices_list->getCellCollection();

							foreach ($invoice_collection as $cell) {

								$column = $objPHPExcel->getSheetByName('invoice')->getCell($cell)->getColumn();
								// print_r($column);
								$row = $objPHPExcel->getSheetByName('invoice')->getCell($cell)->getRow();

								$data_value = $objPHPExcel->getSheetByName('invoice')->getCell($cell)->getValue();

								//header will/should be in row 1 only. of course this can be modified to suit your need.
								$inv_arr[$row][$column] = $data_value;
							}
						}
					}
				}
			}

			// $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);

			for ($i = 2; $i <= count($inv_arr); $i++) {
				$data[] = array(
					'invoice_number' => $inv_arr[$i]['A'],
					'doi'  => $inv_arr[$i]['B'],
					'product_code'   => $inv_arr[$i]['C'],
					'product_description'   => $inv_arr[$i]['D'],
					'product_qty'   => $inv_arr[$i]['E'],
					'product_rate'   => $inv_arr[$i]['F'],
					'product_amount'   => $inv_arr[$i]['G']

				);
			}
			echo $responce = json_encode(array('message' => 'success', 'type' => 'success', 'inv' => $data), true);			// $this->csv_import_model->insert($data);
		}
	}

	function insert_invoice()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['invoice'])) {
				// echo '<pre>';
				// print_r($_POST['invoice']);
				// $invoiceNumber = $this->input->post('invoiceNumber');
				$tableName = 'master_invoice';
				$error = [];
				$data = $_POST['invoice'];

				// print_r($data);

				for ($i = 0; $i < count($data); $i++) {
					$date = yymmdd($data[$i]['doi']);
					$invoiceNumber = $this->db->escape($data[$i]['invoice_number']);
					$product_code = $this->db->escape($data[$i]['product_code']);
					$condition = array('product_code' => $product_code, 'invoice_number' => $invoiceNumber, 'doi' => $date);
					$result = $this->CustomModel->getWhere($tableName, $condition);

					// $d = $data[$i];
					// print_r($d);
					// print_r($result);

					if ($result > 0) {
						array_push($error, $data[$i]);
						// continue;
					} else {
						// print_r();
						$timestamp = date("Y-m-d H:i:s");
						$status = 0;
						$date = yymmdd($data[$i]['doi']);
						$inv_arr = array(
							'invoice_number' => $invoiceNumber,
							'doi' => $date,
							'product_code' => $product_code,
							'product_description' => $this->db->escape($data[$i]['product_description']),
							'product_qty' => $data[$i]['product_qty'],
							'product_rate' => $data[$i]['product_rate'],
							'product_amount' => $data[$i]['product_amount'],
							'entered_by'   => $_SESSION['userInfo']['username'],
							'send_status'   => $status,
							'entery_datetime'  => $timestamp
						);
						$this->CustomModel->insertInto($tableName, $inv_arr);
					}
				}
				if (count($error) != 0) {
					echo $responce = json_encode(array('message' => 'Invoice uploaded', 'type' => 'succes', 'errorlist' => $error, 'path' => 'invoice'), true);
				} else {
					echo $responce = json_encode(array('message' => 'error', 'type' => 'success', 'path' => 'invoice', 'errorlist' => $error), true);
				}
			}
		}

		// echo $output;
	}

	public function send_invoice()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['invoice_numbers'])) {


				$selected_invoice = $_POST['invoice_numbers'];
				print_r($selected_invoice);
				// die;
				if (!empty($selected_invoice)) {
					$count = 0;
					$tableName = 'master_invoice';
					for ($i = 0; $i < count($selected_invoice); $i++) {
						$date = yymmdd($selected_invoice[$i]['doi']);
						$data=array('send_status'=>1);
						$condition = array(
							'invoice_number' =>$this->db->escape($selected_invoice[$i]['invoice_number']),
							'doi' =>$date,
							'product_code' =>$this->db->escape($selected_invoice[$i]['product_code']),
						);
						$res = $this->CustomModel->update_table($tableName, $condition, $data);
						$count++;
					}
					echo $responce = json_encode(array('messages' => 'Invoice Sent', 'type' => 'success'), true);
				} else {
					echo $responce = json_encode(array('messages' => 'OOPs... system error Contact IT', 'type' => 'error'), true);
				}
			}
		}
	}
}
