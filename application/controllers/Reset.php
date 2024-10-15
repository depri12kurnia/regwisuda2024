<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reset extends CI_Controller
{

    // Load model
    public function __construct()
    {
        parent::__construct();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
        $this->load->model('reset_model');
    }

    // Halaman utama
    public function index()
    {
        // Ambil data reset
        //Allowing akses to admin only
        if ($this->session->userdata('akses_level') === 'Admin') {
            $totalWisuda      = $this->reset_model->totalWisuda();
            $totalUndangan    = $this->reset_model->totalUndangan();
            $data = array(
                'title'         => 'Truncate Wisuda & Undangan',
                'totalWisuda'   => $totalWisuda,
                'totalUndangan' => $totalUndangan,
                'isi'           => 'reset/list'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    // Tambah
    public function reset_wisuda()
    {

        if ($this->session->userdata('akses_level') === 'Admin') {

            $this->reset_model->TrunWisuda();
            $this->session->set_flashdata('sukses', 'Data telah direset');
            redirect(base_url('reset'), 'refresh');
            // End masuk database
        } else {
            $this->session->set_flashdata('warning', 'Access Deined !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    // Edit
    public function reset_undangan()
    {
        if ($this->session->userdata('akses_level') === 'Admin') {

            $this->reset_model->TrunUndangan();
            $this->session->set_flashdata('sukses', 'Data telah direset');
            redirect(base_url('reset'), 'refresh');
            // End masuk database
        } else {
            $this->session->set_flashdata('warning', 'Access Deined !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }
    
    // Backup DB
    public function backup_db()
    {
        date_default_timezone_set("Asia/Jakarta"); // set waktu sesuai lokasi

        $this->load->dbutil();
        $pref = [
            'format' => 'zip',
            'filename' => 'db_reg_wisuda.sql'
        ];

        $backup     = $this->dbutil->backup($pref);
        $db_name    = 'backup_database__' . date("d-m-Y__H-i-s") . '.zip'; // nama backup dalam bentuk zip
        $save       = './assets/database/' . $db_name; //folder tempat database disimpan

        $this->load->helper('file'); // load helper file
        write_file($save, $backup);

        $this->load->helper("download"); // load helper download
        force_download($db_name, $backup);
    }
}
