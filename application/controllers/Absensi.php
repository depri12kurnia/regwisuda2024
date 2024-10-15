<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPZxing\PHPZxingDecoder;

class Absensi extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('absensi_model');
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
            $absensi    = $this->absensi_model->listing();
            $site       = $this->konfigurasi_model->listing();

            $data = array(
                'title'           => 'Absensi All (' . count($absensi) . ')',
                'absensi'         => $absensi,
                'site'            => $site,
                'isi'             => 'absensi/rekap'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } elseif ($this->session->userdata('akses_level') === 'Absensi') {
            $absensi    = $this->absensi_model->listing();
            $site       = $this->konfigurasi_model->listing();

            $data = array(
                'title'           => 'Absensi All (' . count($absensi) . ')',
                'absensi'         => $absensi,
                'site'            => $site,
                'isi'             => 'absensi/rekap'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }
}

/* End of file absensi.php */
/* Location: ./application/controllers/absensi.php */