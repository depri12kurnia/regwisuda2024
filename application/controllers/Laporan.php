<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    // Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('laporan_model');
        $this->load->model('bagian_model');
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman utama
    public function index()
    {
        //Allowing akses to admin only
        if ($this->session->userdata('akses_level') === 'Admin') {
            // 
            // Ambil data user
            $getAll         = $this->laporan_model->getAll();
            // $cariBystatus   = $this->laporan_model->cariBystatus();
            $total          = $this->laporan_model->total_proses();

            $data = array(
                'title'        => 'Laporan Semua Pengajuan (' . $total->total . ' Data)',
                'getAll'       => $getAll,
                // 'cariBystatus' => $cariBystatus,
                'isi'          => 'laporan/list'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    public function pencarian()
    {
        //Allowing akses to admin only
        if ($this->session->userdata('akses_level') === 'Admin') {
            // 
            // Ambil data user
            $cariBystatus       = $this->laporan_model->cariBystatus();
            $total              = $this->laporan_model->total_success();

            $data = array(
                'title'       => 'Hasil Pencarian (' . $total->total . ' Data)',
                'cari'        => $cariBystatus,
                'isi'         => 'laporan/pencarian'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    // Halaman utama
    public function proses()
    {
        //Allowing akses to admin only
        if ($this->session->userdata('akses_level') === 'Admin') {
            // 
            // Ambil data user
            $user     = $this->laporan_model->list_proses();
            $total    = $this->laporan_model->total_proses();

            $data = array(
                'title'       => 'Laporan Sedang Proses (' . $total->total . ' Data)',
                'user'        => $user,
                'isi'         => 'laporan/proses'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    public function success()
    {
        //Allowing akses to admin only
        if ($this->session->userdata('akses_level') === 'Admin') {
            // 
            // Ambil data user
            $user     = $this->laporan_model->list_success();
            $total    = $this->laporan_model->total_success();

            $data = array(
                'title'       => 'Laporan Lolos Verifikasi (' . $total->total . ' Data)',
                'user'        => $user,
                'isi'         => 'laporan/success'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    public function failed()
    {
        //Allowing akses to admin only
        if ($this->session->userdata('akses_level') === 'Admin') {
            // 
            // Ambil data user
            $user     = $this->laporan_model->list_failed();
            $total    = $this->laporan_model->total_failed();

            $data = array(
                'title'       => 'Laporan Lolos Verifikasi (' . $total->total . ' Data)',
                'user'        => $user,
                'isi'         => 'laporan/failed'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    // Edit
    public function edit($id_user)
    {
        // Load data bagian
        $bagian         = $this->bagian_model->listing();
        // Ambil data user yg akan diedit
        $user           = $this->laporan_model->detail($id_user);

        // Validasi
        $validasi = $this->form_validation;

        $validasi->set_rules(
            'status_dokumen',
            'status_dokumen',
            'required',
            array('required'        => '%s harus diisi')
        );

        $validasi->set_rules(
            'status_pengajuan',
            'status_pengajuan',
            'required',
            array('required'        => '%s harus diisi')
        );

        if ($validasi->run() === FALSE) {
            // End validasi

            $data = array(
                'title'      => 'Edit User: ' . $user->nama,
                'user'       => $user,
                'bagian'     => $bagian,
                'isi'        => 'laporan/edit'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
            // Masuk ke database
        } else {
            $inp = $this->input;

            $data = array(
                'id_user'        => $id_user,
                // Ganti Status
                'status_dokumen'        => $inp->post('status_dokumen'),
                'status_pengajuan'      => $inp->post('status_pengajuan'),
                'keterangan'            => $inp->post('keterangan')
            );
            $this->laporan_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diupdate');
            redirect(base_url('user'), 'refresh');
        }
        // End masuk database
    }
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */