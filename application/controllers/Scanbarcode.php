<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ScanBarcode extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('scanbarcode_model');
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman registrasi
    public function index()
    {
        //Allowing akses to admin only
        if ($this->session->userdata('akses_level') === 'Admin') {
            $registrasi = $this->scanbarcode_model->listing();
            $site       = $this->konfigurasi_model->listing();

            $data = array(
                'title'           => 'Scan Barcode Presensi (' . count($registrasi) . ')',
                'registrasi'      => $registrasi,
                'site'            => $site,
                'isi'             => 'scan/scan_barcode'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } elseif ($this->session->userdata('akses_level') === 'Absensi') {
            $registrasi = $this->scanbarcode_model->listing();
            $site       = $this->konfigurasi_model->listing();

            $data = array(
                'title'           => 'Scan Barcode Presensi (' . count($registrasi) . ')',
                'registrasi'      => $registrasi,
                'site'            => $site,
                'isi'             => 'scan/scan_barcode'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    // Edit registrasi
    public function edit($id_reg)
    {
        $registrasi     = $this->scanbarcode_model->detail($id_reg);
    }

    public function change_presensi($id_reg, $no_reg)
    {
        $data = array('id_reg' => $id_reg);
        $this->scanbarcode_model->update_presensi($data);
        $this->session->set_flashdata('sukses', 'Data ' . $no_reg . ' telah hadir');
        redirect(base_url('bagian'), 'refresh');
    }

    public function presensi()
    {
        $id_reg = $this->input->post("id_reg"); // this will return the hid POST parameter
        $this->scanbarcode_model->updatePresensi($id_reg);
    }

    public function hadir($id_reg)
    {

        $data  = array(
            'presensi'      =>  'Hadir'
        );

        $this->scanbarcode_model->hadir($id_reg, $data);


        //isset Message
        $this->session->set_flashdata('sukses', 'Your approval was send');

        //Redirect
        redirect('scanbarcode');
    }
}

/* End of file registrasi.php */
/* Location: ./application/controllers/registrasi.php */