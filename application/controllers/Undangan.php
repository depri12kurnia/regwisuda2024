<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Undangan extends CI_Controller
{

	// Load model
	public function __construct()
	{
		parent::__construct();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
		$this->load->model('undangan_model');
	}

	// Halaman utama
	public function index()
	{
		// Ambil data undangan
		//Allowing akses to admin only
		if ($this->session->userdata('akses_level') === 'Admin') {
			$undangan 	= $this->undangan_model->listing();
			$total 	= $this->undangan_model->total();

			$data = array(
				'title'		=> 'Undangan All (' . $total->total . ' data)',
				'undangan'	=> $undangan,
				'isi'		=> 'undangan/list'
			);
			$this->load->view('layout/wrapper', $data, FALSE);
		} else {
			$this->session->set_flashdata('warning', 'Access Dained !!!');
			redirect(base_url('dasbor'), 'refresh');
		}
	}

	// Halaman manual insert barcode
	public function manual()
	{

		$undangan 	= $this->undangan_model->listing();
		$total 		= $this->undangan_model->total();

		$data = array(
			'title'		=> 'Data Undangan (' . $total->total . ' data)',
			'undangan'	=> $undangan,
			'isi'		=> 'undangan/manual'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	function checkCodename($code)
	{
		$code = $this->input->post('code');
		$if_exists = $this->scanner_model->checkCodeexist($code);
		if ($if_exists > 0) {
			echo json_encode('Exists');
		} else {
			echo json_encode('Not exists');
		}
	}

	// Tambah
	public function tambah()
	{
		// Validasi
		$this->form_validation->set_rules('code', 'code', 'required|min_length[12]|max_length[12]');

		if ($this->form_validation->run() === TRUE) {
			$code = $this->input->post('code');
			$if_exists = $this->undangan_model->checkCodeexist($code);
			if ($if_exists > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal Data Sudah Ada !!</div>');
				redirect(base_url('undangan/manual'), 'refresh');
			} else {
				$data = array(
					'code' => strtoupper($this->input->post('code')),
					'status' => 'Hadir',
					'entry_time' => date('Y-m-d H:i:s'),
					'dibuat' =>  $this->session->userdata('id_user')
				);
				$this->undangan_model->tambah($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Tersimpan</div>');
				redirect(base_url('undangan/manual'), 'refresh');
			}
			// redirect(base_url('undangan/manual'), 'refresh');
		} else {
			$this->session->set_flashdata('error', '<div class="alert alert-danger">' . validation_errors() . '</div>');
			redirect(base_url('undangan/manual'), 'refresh');
		}
	}

	// Edit
	public function edit($id_undangan)
	{
		//Allowing akses to admin only
		if ($this->session->userdata('akses_level') === 'Admin') {
			// Ambil data undangan yg akan diedit
			$undangan = $this->undangan_model->detail($id_undangan);

			// Validasi
			$validasi           = $this->form_validation;

			$validasi->set_rules(
				'code',
				'Code',
				'required',
				array('required' => '%s must be filled')
			);

			if ($validasi->run() === FALSE) {
				// End validasi

				$data = array(
					'title'		=> 'Edit Undangan',
					'undangan'	=> $undangan,
					'isi'		=> 'undangan/edit'
				);
				$this->load->view('layout/wrapper', $data, FALSE);
				// Masuk ke database
			} else {
				$inp = $this->input;

				$data = array(
					'id_undangan'	=> $id_undangan,
					'code'	=> $inp->post('code'),
					'status' => $inp->post('status'),
					'created_at' => date('Y-m-d H:i:s'),
					'nama_ortu'	=> $inp->post('nama_ortu'),
					'entry_time' => $inp->post('entry_time'),
				);
				$this->undangan_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data undangan telah diupdate');
				redirect(base_url('undangan'), 'refresh');
			}
			// End masuk database
		} else {
			$this->session->set_flashdata('warning', 'Access Dained !!!');
			redirect(base_url('dasbor'), 'refresh');
		}
	}

	// Proses
	public function proses()
	{
		$codenya	= $this->input->post('code');
		// $pengalihan = $this->input->post('pengalihan');

		// Check code kosong atau tidak
		if ($codenya == "") {
			$this->session->set_flashdata('warning', 'Anda belum memilih data');
			redirect(base_url('undangan'), 'refresh');
		}

		// Proses hapus jika klik tombol "hapus", jika ga ada yg kosong
		if (isset($_POST['hapus'])) {
			// Proses hapus diloop
			for ($i = 0; $i < sizeof($codenya); $i++) {
				$code = $codenya[$i];
				$data = array('code' => $code);
				$this->undangan_model->delete($data);
			}
			// End proses hapus
			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('undangan'), 'refresh');
		} elseif (isset($_POST['cetak'])) {
			// Proses bulk diloop
			for ($i = 0; $i < sizeof($codenya); $i++) {
				$code = $codenya[$i];

				$this->load->library('zend');
				$this->zend->load('Zend/Barcode');
				$barcode = $code; //nomor id barcode

				$imageResource = Zend_Barcode::factory('code128', 'image', array('text' => $barcode), array())->draw();
				// $imageName = $barcode . '.jpg';
				$imagePath = 'assets/barcode/'; // penyimpanan file barcode
				imagejpeg($imageResource, $imagePath . $barcode . '.jpg');
				$pathBarcode = $imagePath . $barcode . '.jpg'; //Menyimpan path image bardcode ke database

				$data = array(
					'code' => $code,
					'barcode' => $code . '.jpg'
				);
				$this->undangan_model->bulk($data);
			}
			// End proses bulk
			$this->session->set_flashdata('sukses', 'Data telah diaktifkan');
			redirect(base_url('undangan'), 'refresh');
		}
	}

	// Delete
	public function delete($code)
	{
		$data = array('code' => $code);
		$this->undangan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('undangan'), 'refresh');
	}

	// Import
	public function import()
	{
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'Import Undangan',
			'site'			=> $site,
			'isi'			=> 'undangan/import'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function import_spreadsheet()
	{
		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file, PATHINFO_EXTENSION);
		if ($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else if ($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount = count($sheetdata);
		if ($sheetcount > 1) {
			$data = array();
			for ($i = 1; $i < $sheetcount; $i++) {
				$code = $sheetdata[$i][1];
				$status = $sheetdata[$i][2];

				$data[] = array(
					'code' => $code,
					'status' => $status,
					'created_at' => date('Y-m-d H:i:s')
				);
			}
			$inserdata = $this->undangan_model->insert_batch($data);
			if ($inserdata) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Imoprt Data Successfully</div>');
				redirect('undangan/import');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Import Data Unsuccessfully. Please Try Again.</div>');
				redirect('undangan/import');
			}
		}
	}

	// Get Wisuda
	public function getWisuda()
	{
		$searchTerm = $this->input->post('searchTerm');

		$response = $this->undangan_model->getWisuda($searchTerm);

		echo json_encode($response);
	}
}

/* End of file undangan.php */
/* Location: ./application/controllers/undangan.php */