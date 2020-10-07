<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Adminreset_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'admin_reset';
    }
    public function get_array()
    {
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
    public function update($data, $cond)
    {
        $this->db->update($this->table_name, $data, $cond);
    }
    public function insert($data)
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }
    public function delete($cond)
    {
        $this->db->delete($this->table_name, $cond);
    }
    public function exists($cond)
    {
        $this->db->where($cond);
        $query = $this->db->get($this->table_name);
        $result = $query->num_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

}
