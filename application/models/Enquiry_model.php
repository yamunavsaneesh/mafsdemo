<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Enquiry_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'enquiry_master';
    }
    public function get_array()
    {
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }
    public function get_array_limit($limit)
    {
        $this->db->limit($limit);
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }
    public function load($id)
    {
        $id = $this->db->escape_str($id);
        $cond = array('id' => $id);
        $this->db->where($cond);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }
    public function get_row_cond($cond)
    {
        $this->db->where($cond);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }
    public function insert($data)
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }
    public function update($data, $cond)
    {
        return $this->db->update($this->table_name, $data, $cond);
    }
    public function delete($cond)
    {
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
    public function get_pagination($num, $offset, $cond = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        $this->db->from($this->table_name);
        $this->db->limit($num, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

}
