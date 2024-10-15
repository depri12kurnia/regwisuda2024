<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tamu_model extends CI_Model
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
		$this->db->order_by('entry_time', 'ASC');
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

	// Detail
	public function detail($id_tamu)
	{
		$this->db->select('*');
		$this->db->from('tamu');
		// where
		$this->db->where('id_tamu', $id_tamu);
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('tamu', $data);
	}

	// Import Dokumen
	public function insert_batch($data)
	{
		$this->db->insert_batch('tamu', $data);
		if ($this->db->affected_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_tamu', $data['id_tamu']);
		$this->db->update('tamu', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_tamu', $data['id_tamu']);
		$this->db->delete('tamu', $data);
	}

	public function bulk($data)
	{
		$this->db->where('code', $data['code']);
		$this->db->update('tamu', $data);
	}
}

/* End of file tamu_model.php */
/* Location: ./application/models/tamu_model.php */