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
							$invoices_list = $objPHPExcel->getActiveSheet();


							$invoice_collection = $invoices_list->getCellCollection();

							foreach ($invoice_collection as $cell) {

								$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
								// print_r($column);
								$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();

								$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

								//header will/should be in row 1 only. of course this can be modified to suit your need.
								$inv_arr[$row][$column] = $data_value;
							}
						}
					}
				}
			}

			// $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
			if (
				$inv_arr[1]['A'] == 'invoice_number' &&
				$inv_arr[1]['B'] == 'doi' &&
				$inv_arr[1]['C'] == 'product_code' &&
				$inv_arr[1]['D'] == 'product_description' &&
				$inv_arr[1]['E'] == 'product_qty' &&
				$inv_arr[1]['F'] == 'product_rate' &&
				$inv_arr[1]['G'] == 'product_amount'
			) {
				for ($i = 2; $i <= count($inv_arr); $i++) {
					$data[] = array(
						'invoice_number' => validateInput($inv_arr[$i]['A']),
						'doi'  => validateInput($inv_arr[$i]['B']),
						'product_code'   => validateInput($inv_arr[$i]['C']),
						'product_description'   => validateInput($inv_arr[$i]['D']),
						'product_qty'   => validateInput($inv_arr[$i]['E']),
						'product_rate'   => validateInput($inv_arr[$i]['F']),
						'product_amount'   => validateInput($inv_arr[$i]['G'])

					);
				}
				echo $responce = json_encode(array('message' => 'success', 'type' => 'success', 'inv' => $data), true);
			}else{
				echo $responce = json_encode(array('message' => 'File header not match kindly upload valid file', 'type' => 'danger'), true);
			}
			// $this->csv_import_model->insert($data);
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
					$invoiceNumber = validateInput($data[$i]['invoice_number']);
					$product_code = validateInput($data[$i]['product_code']);
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
							'product_description' => validateInput($data[$i]['product_description']),
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
				// print_r($selected_invoice);
				// die;
				if (!empty($selected_invoice)) {
					$count = 0;
					$tableName = 'master_invoice';
					for ($i = 0; $i < count($selected_invoice); $i++) {
						$date = yymmdd($selected_invoice[$i]['doi']);
						$data = array('send_status' => 10);
						$condition = array(
							'invoice_number' => validateInput($selected_invoice[$i]['invoice_number']),
							'doi' => $date,
							'product_code' => validateInput($selected_invoice[$i]['product_code']),
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

	// Function to import data from excel/csv
	function london_invoice()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_FILES['csv_file'])) {
				$file = $_FILES['csv_file']['tmp_name'];
				$filename = $_FILES['csv_file']['name'];
				$extension = pathinfo($filename, PATHINFO_EXTENSION);
				// print_r($filename);die;
				// echo $extension;
				// checking file extention for inputs validation
				if (!empty($extension)) {
					if ($extension != 'csv') {
						echo $responce = json_encode(array('message' => 'Warning! Only CSV file is allowed. ', 'type' => 'warning'), true);
					} else {
						if (!is_readable($file)) {
							echo $responce = json_encode(array('message' => 'error', "File is not readable.", 'type' => 'danger'), true);
						} else {
							$objcsv = PHPExcel_IOFactory::load($file);
							$invoices_list = $objcsv->getActiveSheet();
							// print_r($invoices_list);die;
							$invoice_collection = $invoices_list->getCellCollection();
							// print_r($invoice_collection);
							// die;

							foreach ($invoice_collection as $cell) {
								$column = $objcsv->getActiveSheet()->getCell($cell)->getColumn();
								// print_r($column);
								$row = $objcsv->getActiveSheet()->getCell($cell)->getRow();

								$data_value = $objcsv->getActiveSheet()->getCell($cell)->getValue();

								//header will/should be in row 1 only. of course this can be modified to suit your need.
								$inv_arr[$row][$column] = $data_value;
							}
						}
					}
				}
			}

			if (
				$inv_arr[1]['A'] == 'invoice_number' &&
				$inv_arr[1]['B'] == 'invoice_date' &&
				$inv_arr[1]['C'] == 'code' &&
				$inv_arr[1]['D'] == 'description' &&
				$inv_arr[1]['E'] == 'qty' &&
				$inv_arr[1]['F'] == 'rate' &&
				$inv_arr[1]['G'] == 'amount'
			){

				for ($i = 2; $i <= count($inv_arr); $i++) {
					$data[] = array(
						'invoice_number' => validateInput($inv_arr[$i]['A']),
						'invoice_date'  => validateInput($inv_arr[$i]['B']),
						'code'   => validateInput($inv_arr[$i]['C']),
						'description'   => validateInput($inv_arr[$i]['D']),
						'qty'   => validateInput($inv_arr[$i]['E']),
						'rate'   => validateInput($inv_arr[$i]['F']),
						'amount'   => validateInput($inv_arr[$i]['G'])
					);
				}
				echo $responce = json_encode(array('message' => 'success', 'type' => 'success', 'inv' => $data), true);
			}else{
				echo $responce = json_encode(array('message' => 'File header not match kindly upload valid file ', 'type' => 'danger'), true);
			}

			
		}
	}

	// insert london invoice

	function insert_london_invoice()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['invoice'])) {
				// echo '<pre>';
				// print_r($_POST['invoice']);
				// $invoiceNumber = $this->input->post('invoiceNumber');
				$tableName = 'london_stock';
				$error = [];
				$data = $_POST['invoice'];
				// print_r($data);die;
				for ($i = 0; $i < count($data); $i++) {
					$date = yymmdd($data[$i]['invoice_date']);
					$invoiceNumber = validateInput($data[$i]['invoice_number']);
					$product_code = validateInput($data[$i]['code']);
					$condition = array('item_code' => $product_code, 'invoice_number' => $invoiceNumber, 'invoice_date' => $date);
					$result = $this->CustomModel->getWhere($tableName, $condition);

					// $d = $data[$i];
					// print_r($d);
					// print_r($result);
					if ($result > 0) {
						array_push($error, $data[$i]);
					} else {

						$timestamp = date("Y-m-d H:i:s");
						$date = yymmdd($data[$i]['invoice_date']);
						$inv_arr = array(
							'invoice_number' => $invoiceNumber,
							'invoice_date' => $date,
							'item_code' => $product_code,
							'item_description' => validateInput($data[$i]['description']),
							'qty' => $data[$i]['qty'],
							'rate' => $data[$i]['rate'],
							'amount' => $data[$i]['amount'],
							'update_by'   => $_SESSION['userInfo']['username'],
							'last_updated'  => $timestamp
						);
						$this->CustomModel->insertInto($tableName, $inv_arr);
					}
				}
				if (count($error) != 0) {
					echo $responce = json_encode(array('message' => 'Stock updated', 'type' => 'succes', 'errorlist' => $error, 'path' => 'invoice'), true);
				} else {
					echo $responce = json_encode(array('message' => 'error', 'type' => 'success', 'path' => 'invoice', 'errorlist' => $error), true);
				}
			}
		}

		// echo $output;
	}
}
