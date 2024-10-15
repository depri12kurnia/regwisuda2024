<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan_barcode_model extends CI_Model
{

    // load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'scan';
    var $column_order = array(null, 'nim', 'status', 'entry_time');
    var $column_search = array('nim', 'status', 'entry_time');
    var $order = array('nim' => 'desc'); // default order 

    private function _get_datatables_query()
    {
        //add custom filter here
        if (!empty($this->input->post('nim'))) {
            $this->db->like('nim', $this->input->post('nim'), 'both');
        }

        $this->db->from($this->table);
        $this->db->order_by('entry_time', 'DESC');
        // $this->db->where(array('status' => 'Hadir'));
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if (
                    $i === 0
                ) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (
            $_POST['length'] != -1
        )
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function checknimexist($nim)
    {
        return $this->db->get_where('scan', ['nim' => $nim])->num_rows();
    }

    // Detail data
    public function detail($nim)
    {
        $this->db->select('*');
        $this->db->from('scan');
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query->row();
    }

    public function proses($data)
    {
        $this->db->insert('scan', $data);
    }
}

/* End of file wisuda_model.php */
/* Location: ./application/models/wisuda_model.php */