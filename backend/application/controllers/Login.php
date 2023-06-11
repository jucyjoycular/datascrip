<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		//loading Model_login ke controller
		$this->load->model('Model_login');
	}

	public function index()
	{	
		
		$this->load->view('admin/login');
		
		//$this->load->view('theme-body-ci');
	}

	public function proses()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');


		
			$cek = $this->Model_login->cek($username); //hasilnya 0 atau 1

			if($cek == 1)
			{


			 	$user = $this->Model_login->cari($username);

			 	if(md5($password)==$user->password)
			 	{
			 		
					$newdata = array(
						'username' => $user->username,
						'fullname' => $user->fullname,
						'id' => $user->id_acc,
						'role' => $user->role,
						'login' =>1
					);
					$this->session->set_userdata($newdata);

					//$pesan = "Login berhasil";
					//$url   = site_url('home');
					redirect('home');
			 	} else {
					$pesan = "Maaf username atau password anda salah";
					$url   = site_url('login');

					echo "<script>
		 		alert('$pesan');
		 		location='$url';
		 	  </script>
		 	 ";
				}
			} else {
			 	$pesan = "Maaf Username tidak terdaftar";
			 	$url   = site_url('login');

			 	echo "<script>
		 		alert('$pesan');
		 		location='$url';
		 	  </script>
		 	 ";
			}
		
		
		
	}

	function logout()
	{
		$this->session->sess_destroy();
		$pesan = "Logout berhasil";
		$url   = site_url();
		echo "<script>
				alert('$pesan');
				location='$url';
			  </script>
			 ";
	}
}
