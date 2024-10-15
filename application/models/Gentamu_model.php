<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gentamu_model extends CI_Model
{

	// load database
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('tamu');
		$query = $this->db->get();
		return $query->result();
	}

	// Total
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('tamu');
		$query = $this->db->get();
		return $query->row();
	}

	public function bulk($data)
	{
		$this->db->where('code', $data['code']);
		$this->db->update('tamu', $data);
	}
}

/* End of file tamu_model.php */
/* Location: ./application/models/tamu_model.php */