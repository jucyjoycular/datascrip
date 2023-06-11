<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	function cari($username)
	{
		//load dari tabel user
		$this->db->where('username',$username);
		$data = $this->db->get('account')->row(); //row() menghasilkan hanya satu data
		return $data; //mengeluarkan isi variabel $data
	} 

	function cek($username)
	{
		$this->db->where('username',$username);
		$data = $this->db->get('account')->num_rows();//menghitung jumlah data yang ditemukan
		return $data;
	}

}
