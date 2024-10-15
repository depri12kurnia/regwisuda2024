<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    // Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_model', 'report');
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman utama
    public function index()
    {
        // Ambil data user
        $data = array(
            'title'       => 'Data Laporan',
            'isi'         => 'laporan/report'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function ajax_list()
    {
        $this->load->helper('url');

        $list = $this->report->get_datatables();
        $data = array();
        $i = 1;
        $no = $_POST['start'];
        foreach ($list as $val) {
            $no++;
            $row = array();
            $row[] = $i++;
            $row[] = $val->prodi;
            $row[] = $val->code;
            $row[] = $val->nama;
            $row[] = $val->ttl;
            // $row[] = $val->nik;
            // $row[] = $val->telepon;
            // $row[] = $val->email;
            $row[] = $val->status;
            $row[] = $val->entry_time;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report->count_all(),
            "recordsFiltered" => $this->report->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}

/* End of file report.php */
/* Location: ./application/controllers/report.php */