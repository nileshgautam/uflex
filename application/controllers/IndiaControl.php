<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndiaControl extends CI_Controller {

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



}
