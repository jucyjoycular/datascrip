<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()

	{

		parent::__construct();
	}

	public function index()
	{
		$data['promo'] = $this->db->order_by('id_banner','ASC')->get('promo_slider')->result();
		$data['list'] = $this->db->order_by('id_banner','ASC')->get('home_desktop_banner')->result();
		$this->load->view('pages/home',$data);
	}
}
