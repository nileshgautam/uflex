<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminControl extends CI_Controller
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
	public function index()
	{
		$data['title'] = 'UFLEX Admin- Dashboard';
		$this->load->view('layout/header', $data);
		$this->load->view('admin/layout/sidenavbar');
		$this->load->view('admin/layout/index');
		$this->load->view('layout/footer');
	}
	public function users_list()
	{
		$data['title'] = 'UFLEX Admin- Users list';
		$this->load->view('layout/header', $data);
		$this->load->view('admin/layout/sidenavbar');
		$this->load->view('admin/pages/users-list');
		$this->load->view('layout/footer');
	}
	public function add_users()
	{
		$data['title'] = 'UFLEX Admin- Add user';
		$this->load->view('layout/header', $data);
		$this->load->view('admin/layout/sidenavbar');
		$this->load->view('admin/pages/users');
		$this->load->view('layout/footer');
	}
	public function edit_users()
	{
		$data['title'] = 'UFLEX Admin- Edit user';
		$this->load->view('layout/header', $data);
		$this->load->view('admin/layout/sidenavbar');
		$this->load->view('admin/pages/users');
		$this->load->view('layout/footer');
	}
}
