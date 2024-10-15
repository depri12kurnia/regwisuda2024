<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barcode_model extends CI_Model
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
		$this->db->from('wisuda');
		$query = $this->db->get();
		return $query->result();
	}

	// Total
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('wisuda');
		$query = $this->db->get();
		return $query->row();
	}

	public function bulk($data)
	{
		$this->db->where('code', $data['code']);
		$this->db->update('wisuda', $data);
	}
}

/* End of file wisuda_model.php */
/* Location: ./application/models/wisuda_model.php */