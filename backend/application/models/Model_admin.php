<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_admin extends CI_Model
{


	function logo()
	{
		$data = $this->db->get('logo')->result();
		return $data;
	}

	
	function slider()
	{
		$data = $this->db->get('home_desktop_banner')->result();
		return $data;
	}

	function promo_slider()
	{
		$data = $this->db->get('promo_slider')->result();
		return $data;
	}

	
	function cariidlogo($id)
	{
		$this->db->where('id_logo', $id);
		$data = $this->db->get('logo')->row();
		return $data;
	}


	

	function cariidslider($id)
	{
		$this->db->where('id_banner', $id);
		$data = $this->db->get('home_desktop_banner')->row();
		return $data;
	}

	function cariidpromoslider($id)
	{
		$this->db->where('id_banner', $id);
		$data = $this->db->get('promo_slider')->row();
		return $data;
	}

	

	function update_logo($post, $foto)
	{
		//data dikirim dalam bentuk array

		//jika fotonya nggak kosong maka diubah
		if (!empty($foto)) {
			$logo = $this->cariidlogo($post['id']);
			if (!empty($logo->filename)) {
				unlink("assets/upload/logo/$logo->filename");
			}
			$data['filename'] = $foto;
		}

		$this->db->where('id_logo', $post['id']);
		$this->db->update('logo', $data);
	}


	function update_slider($post, $foto)
	{
		$data = array(
			'update_date' => date("Y-m-d H:i:s"),
			'update_by' => $this->session->userdata('id'),
			'heading' => $post['heading'],
			'caption' => $post['caption'],
			'btn_title' => $post['btn_title'],
			'btn_link' => $post['btn_link']

		);

		if (!empty($foto)) {
			$slider = $this->cariidslider($post['id']);
			if (!empty($slider->filename)) {
				unlink("assets/upload/slider/$slider->filename");
			}
			$data['filename'] = $foto;
		}

		$this->db->where('id_banner', $post['id']);
		$this->db->update('home_desktop_banner', $data);
	}


	function update_promo_slider($post, $foto)
	{
		$data = array(
			'update_date' => date("Y-m-d H:i:s"),
			'update_by' => $this->session->userdata('id'),
			'link' => $post['link']

		);

		if (!empty($foto)) {
			$slider = $this->cariidpromoslider($post['id']);
			if (!empty($slider->filename)) {
				unlink("assets/upload/promo_slider/$slider->filename");
			}
			$data['filename'] = $foto;
		}

		$this->db->where('id_banner', $post['id']);
		$this->db->update('promo_slider', $data);
	}

	



	

	



	function insert_slider($post, $foto)
	{
		//data dikirim dalam bentuk array
		$data = array(
			'filename' => $foto,
			'created_date' => date("Y-m-d H:i:s"),
			'heading' => $post['heading'],
			'caption' => $post['caption'],
			'btn_title' => $post['btn_title'],
			'btn_link' => $post['btn_link']
		);
		$this->db->insert('home_desktop_banner', $data);
	}

	function insert_promo_slider($post, $foto)
	{
		//data dikirim dalam bentuk array
		$data = array(
			'filename' => $foto,
			'created_date' => date("Y-m-d H:i:s"),
			'link' => $post['link']
		);
		$this->db->insert('promo_slider', $data);
	}

	
	function data2()
	{
		$data = $this->db->get('logo')->result();
		return $data;
	}

	
	function data4()
	{
		$data = $this->db->get('banner_logo')->result();
		return $data;
	}


	function cariid2($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('logo')->row();
		return $data;
	}

	
	

	
	

	function insert2($post, $foto)
	{
		//data dikirim dalam bentuk array
		$data = array(
			'filename' => $foto,
			'upload_date' => date("Y-m-d H:i:s")
		);
		$this->db->insert('logo', $data);
	}



	function update2($post, $foto)
	{
		//data dikirim dalam bentuk array
		$data = array(
			'upload_date' => date("Y-m-d H:i:s")
		);
		//jika fotonya nggak kosong maka diubah
		if (!empty($foto)) {
			$banner = $this->cariid2($post['id']);
			if (!empty($banner->filename)) {
				unlink("images/logo/$banner->filename");
			}
			$data['filename'] = $foto;
		}
		$this->db->where('id', $post['id']);
		$this->db->update('logo', $data);
	}

	

	function delete($id)
	{
		$banner = $this->cariid($post['id']);
		if (!empty($banner->filename)) {
			unlink("images/banner/$banner->filename");
		}

		$this->db->where('id', $id);
		$this->db->delete('banner');
	}

	
	function delete2($id)
	{
		$banner = $this->cariid2($post['id']);
		if (!empty($banner->filename)) {
			unlink("images/logo/$banner->filename");
		}

		$this->db->where('id', $id);
		$this->db->delete('logo');
	}


}
