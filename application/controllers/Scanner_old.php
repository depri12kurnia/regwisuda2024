<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scanner extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('scanner_model');
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman scanner
    public function index()
    {
        // $scanner    = $this->scanner_model->listing();
        $site       = $this->konfigurasi_model->listing();

        $data = array(
            'title'           => 'Scan Barcode',
            'site'            => $site,
            'isi'             => 'scanner/list'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function ajax_list()
    {
        $this->load->helper('url');

        $list = $this->scanner_model->get_datatables();
        $data = array();
        $i = 1;
        $no = $_POST['start'];
        foreach ($list as $val) {
            $no++;
            $row = array();
            $row[] = $val->code;
            $row[] = $val->status == 'Hadir'
                ? '<button class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Hadir</button>'
                : ($val->status == 'Hadir'
                    ? '<button class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Sudah</button>'
                    : '<button class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Sudah</button>'
                );
            $row[] = $val->entry_time;
            $row[] = $val->prodi;
            $row[] = $val->pendamping;
            $data[] = $row;
        }
        // <button class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Sudah</button>'
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->scanner_model->count_all(),
            "recordsFiltered" => $this->scanner_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert_data()
    {
        $code = $this->input->post('code');
        $check = $this->scanner_model->checkCodeexist($code);

        if ($check > 0) {
            $code = $this->input->post('code');
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Sudah Ada !</div>');
        } else {
            // Retrieve data from the POST request
            $code = $this->input->post('code');
            $status = $this->input->post('status');
            // Insert data into the database
            $data = array(
                'code'        =>  $code,
                'status'      =>  $status
            );

            $this->scanner_model->proses($data);
            // Send a response back to the JavaScript file
            $this->session->set_flashdata('message', '<div class="alert alert-success">Scan Barcode Berhasil</div>');
        }
    }
}

/* End of file Scanner.php */
/* Location: ./application/controllers/Scanner.php */