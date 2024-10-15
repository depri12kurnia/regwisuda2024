<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Listing data
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('undangan');
        $this->db->order_by('status', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data
    public function dasbor()
    {
        $this->db->select('*');
        $this->db->from('undangan');
        $this->db->order_by('code', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing By Status
    public function status($status)
    {
        $this->db->select('*');
        $this->db->from('undangan');
        $this->db->where(array('undangan.status' => $status));
        $this->db->order_by('code', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_count()
    {
        return $this->db->count_all('undangan');
    }

    // Listing total
    public function total_hadir()
    {
        $this->db->select('*');
        $this->db->from('undangan');
        $this->db->where('status', 'Hadir');
        $this->db->order_by('code', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail data
    public function detail($code)
    {
        $this->db->select('*');
        $this->db->from('undangan');
        $this->db->where('code', $code);
        $this->db->order_by('code', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    // update
    public function update($data)
    {
        $this->db->where('code', $data['code']);
        $this->db->update('undangan', $data);
    }

    // Edit
    public function update_presensi($data)
    {
        $this->db->where('code', $data['code']);
        $this->db->update('undangan', $data);
    }

    public function hadir($code, $data)
    {
        $this->db->where('code', $code);
        $this->db->update('undangan', $data);
    }
}

/* End of file Presensi_model.php */
/* Location: ./application/models/Presensi_model.php */