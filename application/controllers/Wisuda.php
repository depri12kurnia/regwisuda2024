<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Wisuda extends CI_Controller
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
		$this->load->model('wisuda_model');
	}

	// Halaman utama
	public function index()
	{
		// Ambil data wisuda
		//Allowing akses to admin only
		if ($this->session->userdata('akses_level') === 'Admin') {
			$wisuda 	= $this->wisuda_model->listing();
			$total 	= $this->wisuda_model->total();

			$data = array(
				'title'		=> 'Wisuda All (' . $total->total . ' data)',
				'wisuda'	=> $wisuda,
				'isi'		=> 'wisuda/list'
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

		$wisuda 	= $this->wisuda_model->listing();
		$total 		= $this->wisuda_model->total();

		$data = array(
			'title'		=> 'Wisuda All (' . $total->total . ' data)',
			'wisuda'	=> $wisuda,
			'isi'		=> 'wisuda/views'
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
				'code',
				'Code',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'prodi',
				'Prodi',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'nim',
				'Nim',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'nama',
				'Nama',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'ttl',
				'Ttl',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'nik',
				'Nik',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'telepon',
				'Telepon',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'email',
				'Email',
				'required',
				array('required' => '%s must be filled')
			);

			if ($validasi->run() === FALSE) {
				// End validasi

				$data = array(
					'title'		=> 'Tambah Wisuda Baru',
					'isi'		=> 'wisuda/tambah'
				);
				$this->load->view('layout/wrapper', $data, FALSE);
				// Masuk ke database
			} else {
				$inp = $this->input;

				$data = array(
					'code' => $inp->post('code'),
					'prodi' => $inp->post('prodi'),
					'nim' => $inp->post('nim'),
					'nama' => $inp->post('nama'),
					'ttl' => $inp->post('ttl'),
					'nik' => $inp->post('nik'),
					'telepon' => $inp->post('telepon'),
					'email'	=> $inp->post('email'),
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->wisuda_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambahkan');
				redirect(base_url('wisuda'), 'refresh');
			}
			// End masuk database
		} else {
			$this->session->set_flashdata('warning', 'Access Deined !!!');
			redirect(base_url('dasbor'), 'refresh');
		}
	}

	// Edit
	public function edit($id_wd)
	{
		//Allowing akses to admin only
		if ($this->session->userdata('akses_level') === 'Admin') {
			// Ambil data wisuda yg akan diedit
			$wisuda = $this->wisuda_model->detail($id_wd);

			// Validasi
			$validasi           = $this->form_validation;

			$validasi->set_rules(
				'code',
				'Code',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'prodi',
				'Prodi',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'nim',
				'Nim',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'nama',
				'Nama',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'ttl',
				'Ttl',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'nik',
				'Nik',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'telepon',
				'Telepon',
				'required',
				array('required' => '%s must be filled')
			);

			$validasi->set_rules(
				'email',
				'Email',
				'required',
				array('required' => '%s must be filled')
			);

			if ($validasi->run() === FALSE) {
				// End validasi

				$data = array(
					'title'		=> 'Edit Wisuda: ' . $wisuda->nama,
					'wisuda'	=> $wisuda,
					'isi'		=> 'wisuda/edit'
				);
				$this->load->view('layout/wrapper', $data, FALSE);
				// Masuk ke database
			} else {
				$inp = $this->input;

				$data = array(
					'id_wd'	=> $id_wd,
					'code'	=> $inp->post('code'),
					'prodi'	=> $inp->post('prodi'),
					'nim'	=> $inp->post('nim'),
					'nama'	=> $inp->post('nama'),
					'ttl'	=> $inp->post('ttl'),
					'nik'	=> $inp->post('nik'),
					'telepon' => $inp->post('telepon'),
					'email'	=> $inp->post('email'),
					'created_at' => date('Y-m-d H:i:s'),
				);
				$this->wisuda_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data undangan telah diupdate');
				redirect(base_url('wisuda'), 'refresh');
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
			redirect(base_url('wisuda'), 'refresh');
		}

		// Proses hapus jika klik tombol "hapus", jika ga ada yg kosong
		if (isset($_POST['hapus'])) {
			// Proses hapus diloop
			for ($i = 0; $i < sizeof($codenya); $i++) {
				$code = $codenya[$i];
				$data = array('code' => $code);
				$this->wisuda_model->delete($data);
			}
			// End proses hapus
			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('wisuda'), 'refresh');
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
				$this->wisuda_model->bulk($data);
			}
			// End proses bulk
			$this->session->set_flashdata('sukses', 'Data telah diaktifkan');
			redirect(base_url('wisuda'), 'refresh');
		}
	}

	// Delete
	public function delete($code)
	{
		$data = array('code' => $code);
		$this->wisuda_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('wisuda'), 'refresh');
	}

	// Import
	public function import()
	{
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'Import Dokumen',
			'site'			=> $site,
			'isi'			=> 'wisuda/import'
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
				$prodi = $sheetdata[$i][2];
				$nim = $sheetdata[$i][3];
				$nama = $sheetdata[$i][4];
				$ttl = $sheetdata[$i][5];
				$nik = $sheetdata[$i][6];
				$telepon = $sheetdata[$i][7];
				$email = $sheetdata[$i][8];
				$pendamping = $sheetdata[$i][9];

				$data[] = array(
					'code' => $code,
					'prodi' => $prodi,
					'nim' => $nim,
					'nama' => $nama,
					'ttl' => $ttl,
					'nik' => $nik,
					'telepon' => $telepon,
					'email' => $email,
					'pendamping' => $pendamping,
					'created_at' => date('Y-m-d H:i:s')
				);
			}
			$inserdata = $this->wisuda_model->insert_batch($data);
			if ($inserdata) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Imoprt Data Successfully</div>');
				redirect('wisuda/import');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Imoprt Data Unsuccessfully. Please Try Again.</div>');
				redirect('wisuda/import');
			}
		}
	}
}

/* End of file wisuda.php */
/* Location: ./application/controllers/wisuda.php */