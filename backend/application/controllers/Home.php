<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$login = $this->session->userdata('login');
		if($login != 1) { redirect('login'); } //jika belum login akan di redirect

	}

	public function index()
	{

			$this->load->view('admin/home');
		
		
	}
}
