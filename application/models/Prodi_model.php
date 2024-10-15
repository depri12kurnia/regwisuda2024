<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi_model extends CI_Model
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
		$this->db->from('prodi');
		$this->db->order_by('nama_prodi', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Total
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('prodi');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail($id_prodi)
	{
		$this->db->select('*');
		$this->db->from('prodi');
		// where
		$this->db->where('id_prodi', $id_prodi);
		$this->db->order_by('id_prodi', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('prodi', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_prodi', $data['id_prodi']);
		$this->db->update('prodi', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_prodi', $data['id_prodi']);
		$this->db->delete('prodi', $data);
	}
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */