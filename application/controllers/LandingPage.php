<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LandingPage extends CI_Controller
{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('template');
		$this->load->model('M_MasterModel', 'master');
	}

	public function index()
	{
		$data = [
			'title' => 'Homepage',
			'js' => [
				base_url('assets/js/pagesController/LandingPage/index.js'),
			]
		];

		$this->template->loadViews('pages/index', $data);
	}
}
