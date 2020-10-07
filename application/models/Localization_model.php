<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Localization_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->lang_table_name = 'languages';
        $this->table_name = 'localization';
    }
    public function get_array()
    {
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }
    public function get_array_limit($limit)
    {
        $this->db->where('language', $this->session->userdata('admin_language'));
        $this->db->limit($limit);
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }
    public function load($id)
    {
        $id = $this->db->escape_str($id);
        $cond = array('id' => $id);
        $this->db->where($cond);
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get($this->table_name);
        return $query->row();
    }
    public function get_row_cond($cond)
    {
        $this->db->where($cond);
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get($this->table_name);
        return $query->row();
    }
    public function insert($data)
    {
        $query = $this->db->get($this->lang_table_name);
        foreach ($query->result_array() as $row):
            $rowdata = $data;
            $rowdata['language'] = $row['code'];
            $this->db->insert($this->table_name, $rowdata);
            unset($rowdata);
        endforeach;
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
        if ($this->session->userdata('localization_key') != '') {
            $this->db->like('lang_key', $this->session->userdata('localization_key'), 'both');
        }
        $this->db->where('language', $this->session->userdata('admin_language'));
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
        if ($this->session->userdata('localization_key') != '') {
            $this->db->like('lang_key', $this->session->userdata('localization_key'), 'both');
        }
        $this->db->where('language', $this->session->userdata('admin_language'));
        $this->db->from($this->table_name);
        $this->db->limit($num, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

}
