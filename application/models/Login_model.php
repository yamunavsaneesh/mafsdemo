<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'admin_logins';
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
    public function get_lastlogin()
    {
        $this->db->where('id', $this->session->userdata('admin_loginid') - 1);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

}
