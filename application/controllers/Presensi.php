<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('presensi_model');
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman wisuda
    public function index()
    {
        //Allowing akses to admin only
        if ($this->session->userdata('akses_level') === 'Admin') {
            $wisuda     = $this->presensi_model->listing();
            $site       = $this->konfigurasi_model->listing();

            $data = array(
                'title'           => 'Presensi Undangan (' . count($wisuda) . ')',
                'wisuda'          => $wisuda,
                'site'            => $site,
                'isi'             => 'presensi/list'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    // Edit wisuda
    public function edit($id_undangan)
    {
        $this->presensi_model->detail($id_undangan);
    }

    public function change_presensi($id_undangan, $code)
    {
        $data = array('id_undangan' => $id_undangan);
        $this->presensi_model->update_presensi($data);
        $this->session->set_flashdata('sukses', 'Data ' . $code . ' telah hadir');
        redirect(base_url('presensi'), 'refresh');
    }

    public function presensi()
    {
        $id_undangan = $this->input->post("id_undangan"); // this will return the hid POST parameter
        $this->presensi_model->update_presensi($id_undangan);
    }

    public function hadir($id_undangan)
    {

        $data  = array(
            'status'      =>  'Hadir',
            'entry_time'      =>  date('Y-m-d H:i:s')
        );

        $this->presensi_model->hadir($id_undangan, $data);

        //isset Message
        $this->session->set_flashdata('sukses', 'Your approval success');

        //Redirect
        // redirect('presensi');
        redirect(base_url('presensi'), 'refresh');
    }

    // Edit
    public function update($id_undangan)
    {
        //Allowing akses to admin only
        if ($this->session->userdata('akses_level') === 'Admin') {
            // Ambil data wisuda yg akan diedit
            $wisuda = $this->presensi_model->detail($id_undangan);

            // Validasi
            $validasi           = $this->form_validation;

            $validasi->set_rules(
                'prodi',
                'Prodi',
                'required',
                array('required' => '%s must be filled')
            );

            $validasi->set_rules(
                'code',
                'code',
                'required',
                array('required' => '%s must be filled')
            );

            $validasi->set_rules(
                'nama_ortu',
                'Nama Ortu/Wali',
                'required',
                array('required' => '%s must be filled')
            );

            $validasi->set_rules(
                'id_wisuda',
                'Wisudawan',
                'required',
                array('required' => '%s must be filled')
            );

            if ($validasi->run() === FALSE) {
                // End validasi

                $data = array(
                    'title'        => 'Update Presensi: ' . $wisuda->code,
                    'wisuda'    => $wisuda,
                    'isi'        => 'presensi/hadir'
                );
                $this->load->view('layout/wrapper', $data, FALSE);
                // Masuk ke database
            } else {
                $inp = $this->input;

                $data = array(
                    'id_undangan' => $id_undangan,
                    'prodi' => $inp->post('prodi'),
                    'code' => $inp->post('code'),
                    'status' => $inp->post('status'),
                    'nama_ortu' => $inp->post('nama_ortu'),
                    'id_wisuda' => $inp->post('id_wisuda'),
                    'entry_time' => date('Y-m-d H:i:s')
                );
                $this->presensi_model->update($data);
                $this->session->set_flashdata('sukses', 'Data undangan telah diupdate');
                redirect(base_url('presensi'), 'refresh');
            }
            // End masuk database
        } else {
            $this->session->set_flashdata('warning', 'Access Dained !!!');
            redirect(base_url('dasbor'), 'refresh');
        }
    }

    // Get Wisuda
    public function getWisuda()
    {

        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get Undangan
        $response = $this->presensi_model->getWisuda($searchTerm);

        echo json_encode($response);
    }
}

/* End of file presensi.php */
/* Location: ./application/controllers/presensi.php */