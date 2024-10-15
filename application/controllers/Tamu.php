<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Tamu extends CI_Controller
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
		$this->load->model('tamu_model');
	}

	// Halaman utama
	public function index()
	{
		// Ambil data tamu
		//Allowing akses to admin only
		if ($this->session->userdata('akses_level') === 'Admin') {
			$tamu 	= $this->tamu_model->listing();
			$total 	= $this->tamu_model->total();

			$data = array(
				'title'		=> 'Management Tamu (' . $total->total . ' data)',
				'tamu'		=> $tamu,
				'isi'		=> 'tamu/list'
			);
			$this->load->view('layout/wrapper', $data, FALSE);
		} else {
			$this->session->set_flashdata('warning', 'Access Dained !!!');
			redirect(base_url('dasbor'), 'refresh');
		}
	}

	// Halaman utama
	public function views()
	{

		$tamu 	= $this->tamu_model->listing();
		$total 		= $this->tamu_model->total();

		$data = array(
			'title'		=> 'Management Tamu(' . $total->total . ' data)',
			'tamu'		=> $tamu,
			'isi'		=> 'tamu/views'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Tambah
	public function tambah()
	{

		if ($this->session->userdata('akses_level') === 'Admin') {

			// Validasi
			$validasi           = $this->form_validation;

			$validasi->set_rules(
				'asal_tamu',
				'Asal Tamu',
				'required',
				array('required' => '%s must be filled')
			);

			if ($validasi->run() === FALSE) {
				// End validasi

				$data = array(
					'title'		=> 'Tambah Tamu Baru',
					'isi'		=> 'tamu/tambah'
				);
				$this->load->view('layout/wrapper', $data, FALSE);
				// Masuk ke database
			} else {
				$inp = $this->input;

				$data = array(
					'code' => $inp->post('code'),
					'asal_tamu' => $inp->post('asal_tamu'),
				);
				$this->tamu_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambahkan');
				redirect(base_url('tamu'), 'refresh');
			}
			// End masuk database
		} else {
			$this->session->set_flashdata('warning', 'Access Deined !!!');
			redirect(base_url('dasbor'), 'refresh');
		}
	}

	// Edit
	public function edit($id_tamu)
	{
		//Allowing akses to admin only
		if ($this->session->userdata('akses_level') === 'Admin') {
			// Ambil data tamu yg akan diedit
			$tamu = $this->tamu_model->detail($id_tamu);

			// Validasi
			$validasi           = $this->form_validation;

			$validasi->set_rules(
				'asal_tamu',
				'Asal Tamu',
				'required',
				array('required' => '%s must be filled')
			);

			if ($validasi->run() === FALSE) {
				// End validasi

				$data = array(
					'title'		=> 'Edit Tamu: ' . $tamu->asal_tamu,
					'tamu'		=> $tamu,
					'isi'		=> 'tamu/edit'
				);
				$this->load->view('layout/wrapper', $data, FALSE);
				// Masuk ke database
			} else {
				$inp = $this->input;

				$data = array(
					'id_tamu'	=> $id_tamu,
					'asal_tamu' => $inp->post('asal_tamu'),
					'status' => $inp->post('status'),
					'jumlah' => $inp->post('jumlah')
					
				);
				$this->tamu_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data undangan telah diupdate');
				redirect(base_url('tamu'), 'refresh');
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
			redirect(base_url('tamu'), 'refresh');
		}

		// Proses hapus jika klik tombol "hapus", jika ga ada yg kosong
		if (isset($_POST['hapus'])) {
			// Proses hapus diloop
			for ($i = 0; $i < sizeof($codenya); $i++) {
				$code = $codenya[$i];
				$data = array('code' => $code);
				$this->tamu_model->delete($data);
			}
			// End proses hapus
			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('tamu'), 'refresh');
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
				$this->tamu_model->bulk($data);
			}
			// End proses bulk
			$this->session->set_flashdata('sukses', 'Data telah diaktifkan');
			redirect(base_url('tamu'), 'refresh');
		}
	}

	// Delete
	public function delete($id_tamu)
	{
		$data = array('id_tamu' => $id_tamu);
		$this->tamu_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('tamu'), 'refresh');
	}

	// Import
	public function import()
	{
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'Import Dokumen',
			'site'			=> $site,
			'isi'			=> 'tamu/import'
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
				$asal_tamu = $sheetdata[$i][2];

				$data[] = array(
					'code' => $code,
					'asal_tamu' => $asal_tamu,
					'created_at' => date('Y-m-d H:i:s')
				);
			}
			$inserdata = $this->tamu_model->insert_batch($data);
			if ($inserdata) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Imoprt Data Successfully</div>');
				redirect('tamu/import');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Imoprt Data Unsuccessfully. Please Try Again.</div>');
				redirect('tamu/import');
			}
		}
	}

	// Halaman tamu manual insert barcode
	public function manual()
	{
		$tamu 		= $this->tamu_model->listing();
		$total 		= $this->tamu_model->total();

		$data = array(
			'title'		=> 'Data Tamu Undangan (' . $total->total . ' data)',
			'tamu'		=> $tamu,
			'isi'		=> 'tamu/manual'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Isi Kehadiran di akses pengguna absensi

	public function hadir($id_tamu)
	{
		//Allowing akses to admin only
		if ($this->session->userdata('akses_level') === 'Admin') {
			// Ambil data tamu yg akan diedit
			$tamu = $this->tamu_model->detail($id_tamu);

			// Validasi
			$validasi           = $this->form_validation;

			$validasi->set_rules(
				'asal_tamu',
				'Asal Tamu',
				'required',
				array('required' => '%s must be filled')
			);

			if ($validasi->run() === FALSE) {
				// End validasi

				$data = array(
					'title'		=> 'Tamu: ' . $tamu->asal_tamu,
					'tamu'		=> $tamu,
					'isi'		=> 'tamu/hadir'
				);
				$this->load->view('layout/wrapper', $data, FALSE);
				// Masuk ke database
			} else {
				$inp = $this->input;

				$data = array(
					'id_tamu'	=> $id_tamu,
					'asal_tamu' => $inp->post('asal_tamu'),
					'nama' => $inp->post('nama'),
					'entry_time' => date('Y-m-d H:i:s'),
					'status' => 'Hadir',
					'jumlah' => $inp->post('jumlah')
					
				);
				$this->tamu_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data undangan telah diupdate');
				redirect(base_url('tamu/manual'), 'refresh');
			}
			// End masuk database
		} else {
			$this->session->set_flashdata('warning', 'Access Dained !!!');
			redirect(base_url('dasbor'), 'refresh');
		}
	}
}

/* End of file tamu.php */
/* Location: ./application/controllers/tamu.php */