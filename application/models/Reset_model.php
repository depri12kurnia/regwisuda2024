<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reset_model extends CI_Model
{

    // load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Truncate
    public function TrunWisuda()
    {
        $this->db->truncate('wisuda');
    }

    public function TrunUndangan()
    {
        $this->db->truncate('undangan');
    }

    // Total
    public function totalWisuda()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('wisuda');
        $query = $this->db->get();
        return $query->row();
    }

    public function totalUndangan()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('undangan');
        $query = $this->db->get();
        return $query->row();
    }
}
