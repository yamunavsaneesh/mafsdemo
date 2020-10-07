<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Clients_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->lang_table_name = 'languages';
        $this->table_name = 'client';
        $this->primary_key = 'id';
    }
    public function get_array()
    {
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_active($cond = '')
    {
        if ($cond != '') {
            $this->db->where($cond);
        }
        $this->db->where('status', 'Y');
        $this->db->from($this->table_name);
        $this->db->order_by('sort_order', 'asc');
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
    public function insert($maindata)
    {
        $this->db->insert($this->table_name, $maindata);
        return $this->db->insert_id();
    }
    public function unsetdefault($id)
    {
        $cond['products_id'] = $id;
        $maindata = array('is_default' => 'N');
        return $this->db->update($this->table_name, $maindata, $cond);
    }
    public function update($maindata, $id)
    {
        $cond[$this->primary_key] = $id;
        return $this->db->update($this->table_name, $maindata, $cond);
    }
    public function delete($id)
    {
        $cond = array('id' => $id);
        return $this->db->delete($this->table_name, $cond);
    }
    public function get_idpair()
    {
        $idpair = array();
        $this->db->from($this->table_name);
        $query = $this->db->get();
        foreach ($query->result_array() as $row):
            $idpair[$row['id']] = $row['image'];
        endforeach;
        return $idpair;
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
    public function get_pagination($num, $offset, $cond = '', $sortorder = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        $this->db->limit($num, $offset);
        $this->db->from($this->table_name);
        $this->db->order_by($sortorder);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_options()
    {
        $options = array('' => 'Select');
        $optarray = $this->get_active();
        foreach ($optarray as $option):
            $options[$option['id']] = $option['name'];
        endforeach;
        return $options;
    }

}
