<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dasbor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
		$this->load->model('dasbor_model');
	}

	// Halaman dasbor
	public function index()
	{
		$data = array(
			'title'					=> 'Halaman Dashboard',
			'isi'					=> 'dasbor/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file Dasbor.php */
/* Location: ./application/controllers/Dasbor.php */