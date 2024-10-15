<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

	// load database
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing All
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('regis');
		// join
		$this->db->order_by('id_reg', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing Proses
	public function list_process()
	{
		$this->db->select('*');
		$this->db->from('regis');
		// join
		// End join
		$this->db->where('status', 'Process');
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing verify
	public function list_verify()
	{
		$this->db->select('*');
		$this->db->from('regis');
		// join
		// End join
		$this->db->where('status', 'Verify');
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}


	// Listing failed
	public function list_failed()
	{
		$this->db->select('*');
		$this->db->from('regis');
		// join
		// End join
		$this->db->where('status', 'Failed');
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}


	// Listing Failed
	public function list_failed()
	{
		$this->db->select('regis.*,
							bagian.nama_bagian');
		$this->db->from('regis');
		// join
		$this->db->join('bagian', 'bagian.id_bagian = regis.id_bagian', 'left');
		// End join
		$this->db->where('regis.status_dokumen', 'Tidak');
		$this->db->where('regis.status_pengajuan', 'Gagal');
		$this->db->order_by('regis.id_user', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Total
	public function total_proses()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('regis');
		$this->db->where('status', 'Process');
		$query = $this->db->get();
		return $query->row();
	}

	public function total_success()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('regis');
		$this->db->where('regis.status_dokumen', 'Lengkap');
		$this->db->where('regis.status_pengajuan', 'Berhasil');
		$query = $this->db->get();
		return $query->row();
	}

	public function total_failed()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('regis');
		$this->db->where('regis.status_dokumen', 'Lengkap');
		$this->db->where('regis.status_pengajuan', 'Berhasil');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail($id_user)
	{
		$this->db->select('regis.*,
							bagian.nama_bagian');
		$this->db->from('regis');
		// join
		$this->db->join('bagian', 'bagian.id_bagian = regis.id_bagian', 'left');
		// End join
		// where
		$this->db->where('regis.id_user', $id_user);
		$this->db->order_by('regis.id_user', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function get_filtered($status_pengajuan)
	{
		$this->db->order_by('id_user', 'desc');

		if (!empty($status_pengajuan)) {
			$this->db->where('status_pengajuan', $status_pengajuan);
		}

		$query = $this->db->get('regis');
		return ($query->num_rows() > 0) ? $query->result() : NULL;
	}
}

/* End of file Laporan_model.php */
/* Location: ./application/models/Laporan_model.php */