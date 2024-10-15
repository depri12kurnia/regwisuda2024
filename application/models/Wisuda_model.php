<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisuda_model extends CI_Model
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
		$this->db->order_by('prodi', 'ASC');
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

	// Detail
	public function detail($id_wd)
	{
		$this->db->select('*');
		$this->db->from('wisuda');
		// where
		$this->db->where('id_wd', $id_wd);
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('wisuda', $data);
	}

	// Import Dokumen
	public function insert_batch($data)
	{
		$this->db->insert_batch('wisuda', $data);
		if ($this->db->affected_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_wd', $data['id_wd']);
		$this->db->update('wisuda', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_wd', $data['id_wd']);
		$this->db->delete('wisuda', $data);
	}

	public function bulk($data)
	{
		$this->db->where('code', $data['code']);
		$this->db->update('wisuda', $data);
	}
}

/* End of file wisuda_model.php */
/* Location: ./application/models/wisuda_model.php */