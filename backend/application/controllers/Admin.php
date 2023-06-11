<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_admin');
	}

	public function logo_upload()
	{
		$data['logo'] = $this->model_admin->logo();
		$this->load->view('admin/image/logo_upload/logo_index', $data);
	}

	public function home_slider()
	{
		$data['slider'] = $this->model_admin->slider();
		$this->load->view('admin/image/slider/slider_index', $data);
	}

	public function promo_slider()
	{
		$data['slider'] = $this->model_admin->promo_slider();
		$this->load->view('admin/image/promo_slider/slider_index', $data);
	}


	
	
	public function slider_edit($id)
	{
		$data['slider'] = $this->model_admin->cariidslider($id);
		$this->load->view('admin/image/slider/slider_edit', $data);
	}

	public function logo_edit($id)
	{
		$data['logo'] = $this->model_admin->cariidlogo($id);
		$this->load->view('admin/image/logo_upload/logo_edit', $data);
	}

	public function promo_slider_edit($id)
	{
		$data['slider'] = $this->model_admin->cariidpromoslider($id);
		$this->load->view('admin/image/promo_slider/slider_edit', $data);
	}





	public function update_logo()
	{

		$file = $this->do_upload('logo');
		$foto = $file['file_name'];
		$msg  = strip_tags($file['msg']);
		$this->model_admin->update_logo($_POST, $foto);

		$pesan = "Data Berhasil Diubah. $msg";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('admin/logo_upload');
	}


	public function update_slider()
	{

		$file = $this->do_upload('slider');
		$foto = $file['file_name'];
		$msg  = strip_tags($file['msg']);
		$this->model_admin->update_slider($_POST, $foto);

		$pesan = "Data Berhasil Diubah. $msg";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('admin/home_slider');
	}

	public function update_promo_slider()
	{

		$file = $this->do_upload('promo_slider');
		$foto = $file['file_name'];
		$msg  = strip_tags($file['msg']);
		$this->model_admin->update_promo_slider($_POST, $foto);

		$pesan = "Data Berhasil Diubah. $msg";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('admin/promo_slider');
	}

	

	public function insert_slider_banner()
	{

		$file = $this->do_upload('slider');
		$foto = $file['file_name'];

		$msg  = strip_tags($file['msg']);
		$this->model_admin->insert_slider($_POST, $foto);

		$pesan = "Data Berhasil Disimpan. $msg";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('admin/home_slider');
	}

	public function insert_promo_slider_banner()
	{

		$file = $this->do_upload('promo_slider');
		$foto = $file['file_name'];

		$msg  = strip_tags($file['msg']);
		$this->model_admin->insert_promo_slider($_POST, $foto);

		$pesan = "Data Berhasil Disimpan. $msg";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('admin/promo_slider');
	}

	

	public function do_upload($string)
	{
		$config['upload_path']   = './assets/upload/' . $string;


		$config['allowed_types'] = 'svg|jpg|png';
		$config['file_name']     = date("ymdhis") . rand(1111, 9999); //generate nama file


		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto')) //foto adalah name pada input type file
		{

			var_dump($this->upload->display_errors());
			
			$hasil['msg'] = $this->upload->display_errors();
			$hasil['file_name'] = "";
		} else {
			$data = $this->upload->data();

			$hasil['msg'] = "Upload Success";
			$hasil['file_name'] = $data['file_name'];
		}
		return $hasil;
	}

	public function insert_slider()
	{
		$this->load->view('admin/image/slider/slider_insert');
	}

	public function insert_promo_slider()
	{
		$this->load->view('admin/image/promo_slider/slider_insert');
	}


	

	public function delete_slider($id)
	{
		$banner = $this->db->where('id_banner', $id)->get('home_desktop_banner')->row();
		if (!empty($banner->filename)) {
			unlink("assets/upload/slider/$banner->filename");
		}
		$this->db->where('id_banner', $id);

		$this->db->delete('home_desktop_banner');



		$pesan = "Data Berhasil Dihapus";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('admin/home_slider');
	}


	public function delete_promo_slider($id)
	{
		$banner = $this->db->where('id_banner', $id)->get('promo_slider')->row();
		if (!empty($banner->filename)) {
			unlink("assets/upload/promo_slider/$banner->filename");
		}
		$this->db->where('id_banner', $id);

		$this->db->delete('promo_slider');



		$pesan = "Data Berhasil Dihapus";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('admin/promo_slider');
	}


}
