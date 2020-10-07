<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Enquiry_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'enquiry_master';
        $this->primary_key = 'id';
    }
    public function get_array()
    {
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_active()
    {
        $this->db->where('is_active', 'Y');
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array_limit($limit)
    {
        $this->db->limit($limit);
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function load($id)
    {
        $id = $this->db->escape_str($id);
        $cond = array('id' => $id);
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_row_cond($cond)
    {
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->row();
    }
    public function insert($maindata, $descdata)
    {
        $this->db->insert($this->table_name, $maindata);
        $prime = $this->db->insert_id();
        return $prime;
    }
    public function insert2($maindata, $descdata)
    {
        $this->db->insert('comments', $maindata);
        $prime = $this->db->insert_id();
        return $prime;
    }
    public function update($maindata, $descdata, $id)
    {
        $cond[$this->primary_key] = $id;
        return $this->db->update($this->table_name, $maindata, $cond);
    }
    public function delete($id)
    {
        $cond = array('id' => $id);
        return $this->db->delete($this->table_name, $cond);
    }
    public function get_pagination_count($cond = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_pagination($num, $offset, $cond = '', $order = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        if (!empty($order) && count($order) > 0) {
            $this->db->order_by($order);
        }
        $this->db->limit($num, $offset);
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result_array();
    }

}
