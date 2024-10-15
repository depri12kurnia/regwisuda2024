<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Undangan_model extends CI_Model
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
		$this->db->from('undangan');
		$this->db->join('wisuda', 'wisuda.code = undangan.code');
		$this->db->order_by('entry_time', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Total
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('undangan');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail($code)
	{
		$this->db->select('*');
		$this->db->from('undangan');
		// where
		$this->db->where('code', $code);
		$this->db->order_by('code', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	function checkCodeexist($code)
	{
		return $this->db->get_where('undangan', ['code' => $code])->num_rows();
	}

	function getWisuda($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where("code like '%" . $searchTerm . "%' ");
		$fetched_records = $this->db->get('wisuda');
		$wisuda = $fetched_records->result_array();

		$data = array();
		foreach ($wisuda as $ws) {
			$data[] = array("code" => $ws['code'], "text" => $ws['code']);
		}
		return $data;
	}

	public function tambah($data)
	{
		$this->db->insert('undangan', $data);
	}

	public function insert_batch($data)
	{
		$this->db->insert_batch('undangan', $data);
		if ($this->db->affected_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	public function edit($data)
	{
		$this->db->where('code', $data['code']);
		$this->db->update('undangan', $data);
	}

	public function delete($data)
	{
		$this->db->where('code', $data['code']);
		$this->db->delete('undangan', $data);
	}

	public function bulk($data)
	{
		$this->db->where('code', $data['code']);
		$this->db->update('undangan', $data);
	}
}

/* End of file undangan_model.php */
/* Location: ./application/models/undangan_model.php */