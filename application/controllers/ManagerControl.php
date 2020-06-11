<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManagerControl extends CI_Controller
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
		// $data['title'] = 'UFLEX Manager - Dashboard';
		// $this->load->view('layout/header', $data);
		// $this->load->view('manager/layout/sidenavbar');
		// $this->load->view('manager/layout/index');
		// $this->load->view('layout/footer');

		redirect(__CLASS__.'/ageing_stock');
	}

	public function ageing_stock()
	{

		$data['title'] = 'UFLEX Manager - Ageing report';
		$tableName = 'london_stock';
		$condition ='closing_stock!=0';
		$result['ageing'] = $this->CustomModel->getwhere($tableName, $condition);

		$this->load->view('layout/header', $data);
		$this->load->view('manager/layout/sidenavbar');
		$this->load->view('manager/pages/ageing-report',$result);
		$this->load->view('layout/footer');
	}

	public function product_list()
	{
		$data['title'] = 'UFLEX Manager - Product list';
		$tableName = 'master_product';
		$condition ='status!=0';
		$result['product_list'] = $this->CustomModel->getwhere($tableName, $condition);
		$this->load->view('layout/header', $data);
		$this->load->view('manager/layout/sidenavbar');
		$this->load->view('manager/pages/product-list',$result);
		$this->load->view('layout/footer');
	}

	public function pending_invoice()
	{
		$tableName = 'master_invoice';
		$condition =array('send_status'=>SENT);
		$result['pending_list'] = $this->CustomModel->getwhere($tableName, $condition);

		$data['title'] = 'UFLEX Manager - Pending invoice';

		$this->load->view('layout/header', $data);
		$this->load->view('manager/layout/sidenavbar');
		$this->load->view('manager/pages/pending-invoice',$result);
		$this->load->view('layout/footer');
	}


	public function reconciliation_report()
	{
		$data['title'] = 'UFLEX Manager - Reconciliation report';
		$this->load->view('layout/header', $data);
		$this->load->view('manager/layout/sidenavbar');
		$this->load->view('manager/pages/reconciliation-report');
		$this->load->view('layout/footer');
	}

	public function change_password()
	{
		$data['title'] = 'UFLEX Manager - Change password';
		$this->load->view('layout/header', $data);
		$this->load->view('manager/layout/sidenavbar');
		$this->load->view('manager/pages/change-password');
		$this->load->view('layout/footer');
	}
}
