<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
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
		$this->db->select('mahasiswa.*, prodi.nama_prodi');
		$this->db->from('mahasiswa');
		$this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi', 'LEFT');
		$this->db->order_by('prodi', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Total
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('mahasiswa');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail($id_mahasiswa)
	{
		$this->db->select('*');
		$this->db->from('mahasiswa');
		// where
		$this->db->where('id_mahasiswa', $id_mahasiswa);
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('mahasiswa', $data);
	}

	// Import Dokumen
	public function insert_batch($data)
	{
		$this->db->insert_batch('mahasiswa', $data);
		if ($this->db->affected_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_mahasiswa', $data['id_mahasiswa']);
		$this->db->update('mahasiswa', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_mahasiswa', $data['id_mahasiswa']);
		$this->db->delete('mahasiswa', $data);
	}

	public function bulk($data)
	{
		$this->db->where('nim', $data['nim']);
		$this->db->update('mahasiswa', $data);
	}
}

/* End of file mahasiswa_model.php */
/* Location: ./application/models/mahasiswa_model.php */