<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generate_tamu extends CI_Controller
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
		$this->load->model('gentamu_model');
		$this->load->library('zip');
        $this->load->helper('file');
	}

	// Halaman utama
	public function index()
	{
		// Ambil data undangan
		//Allowing akses to admin only
		if ($this->session->userdata('akses_level') === 'Admin') {
			$tamu 	= $this->gentamu_model->listing();
			$total 	    = $this->gentamu_model->total();

			$data = array(
				'title'		=> 'Generate Tamu Barcode All (' . $total->total . ' data)',
				'tamu'	=> $tamu,
				'isi'		=> 'tamu/generate'
			);
			$this->load->view('layout/wrapper', $data, FALSE);
		} else {
			$this->session->set_flashdata('warning', 'Access Dained !!!');
			redirect(base_url('dasbor'), 'refresh');
		}
	}

	// Proses
	public function proses()
	{
		$codenya	= $this->input->post('code');
		$barcodenya	= $this->input->post('barcode');
		// $pengalihan = $this->input->post('pengalihan');

		// Check code kosong atau tidak
		if ($codenya == "") {
			$this->session->set_flashdata('warning', 'Anda belum memilih data');
			redirect(base_url('generate_tamu'), 'refresh');
		}

		// Proses generate jika klik tombol "generate", jika ga ada yg kosong
		if (isset($_POST['generate'])) {
			// Proses generate diloop
			for ($i = 0; $i < sizeof($codenya); $i++) {
				$code = $codenya[$i];

				$this->load->library('zend');
				$this->zend->load('Zend/Barcode');

				$imageResource = Zend_Barcode::factory('code128', 'image', array('text' => $code), array())->draw();
				// $imageName = $barcode . '.jpg';
				$imagePath = 'assets/barcode_tamu/'; // penyimpanan file barcode
				imagejpeg($imageResource, $imagePath . $code . '.jpg');
				$pathBarcode = $imagePath . $code . '.jpg'; //Menyimpan path image bardcode kedatabase

				$data = array(
					'code' => $code,
					'barcode' => $code . '.jpg'
				);
				$this->gentamu_model->bulk($data);
			}
			// End proses generate
			$this->session->set_flashdata('sukses', 'Barcode Telah di Generate');
			redirect(base_url('generate_tamu'), 'refresh');
		} elseif (isset($_POST['print'])) {
			// Proses cetak
			for ($i = 0; $i < sizeof($barcodenya); $i++) {
				$code = $barcodenya[$i];

				$mpdf = new \Mpdf\Mpdf();
				$html = $this->load->view('barcode/cetak', [], true);
				$mpdf->WriteHTML($html);
				$mpdf->Output(); // opens in browser

				$data = array(
					'code'		=> $code,
					'barcode'	=> $code . '.jpg'
				);
				$this->gentamu_model->print($data);
			}
			// End proses cetak
			$this->session->set_flashdata('sukses', 'Data telah di cetak');
			redirect(base_url('barcode_tamu/cetak'), 'refresh');
		} elseif (isset($_POST['kirim'])) {
			for ($i = 0; $i < sizeof($codenya); $i++) {
				$code = $codenya[$i];

				$data = array(
					'code' => $code,
					'barcode' => $code . '.jpg'
				);
				$this->gentamu_model->bulk($data);
			}
			// End proses generate
			$this->session->set_flashdata('sukses', 'Barcode Telah di Generate');
			redirect(base_url('barcode_tamu'), 'refresh');
		}
	}

	public function download_folder() {
        // Pastikan folder ada
        $folder_path = './assets/barcode_tamu' ; // Misalnya folder di direktori uploads
        if (!is_dir($folder_path)) {
            show_error('Folder tidak ditemukan.');
        }

        // Tambahkan folder ke file ZIP
        $this->zip->read_dir($folder_path, FALSE); // FALSE agar tidak menyertakan full path

        // Tentukan nama file ZIP
        $zip_filename = 'barcode-undangan-tamu-wisuda' . '.zip';

        // Unduh file ZIP
        $this->zip->download($zip_filename);
    }

	public function empty_folder() {
        // Tentukan lokasi folder (misalnya folder di dalam direktori uploads)
        $folder_path = './assets/barcode_tamu';

        // Pastikan folder ada
        if (!is_dir($folder_path)) {
            show_error('Folder tidak ditemukan.');
        }

        // Hapus semua file di dalam folder tanpa menghapus foldernya
        delete_files($folder_path, TRUE);
		$this->db->truncate('tamu');

        // Redirect kembali setelah selesai
        $this->session->set_flashdata('message', 'Folder berhasil dikosongkan.');
        redirect('generate_tamu');
    }
}

/* End of file barcode.php */
/* Location: ./application/controllers/barcode.php */