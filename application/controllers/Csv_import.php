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
		$this->load->library('csvimport');
		// $this->load->helper('datefilter');
		if (!isset($_SESSION['userInfo'])) {
			$this->session->sess_destroy();
			redirect('UserAuthenticationControl/index');
		}
	}

	function insert_invoice()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['invoice'])) {
				echo '<pre>';
				print_r($_POST['invoice']);
				// $this->csv_import_model->insert($data);
			}
		}

		// echo $output;
	}

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
}
