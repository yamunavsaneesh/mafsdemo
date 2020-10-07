<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Contacts_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->lang_table_name = 'languages';
        $this->table_name = 'contacts';
        $this->desc_table_name = 'contacts_desc';
        $this->primary_key = 'id';
        $this->foreign_key = 'contacts_id';
    }
    public function get_array()
    {
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_active()
    {
        $this->db->where('contacts.status', 'Y');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->join('contact_category', "contact_category.id= $this->table_name.category_id", 'left');
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->order_by('contact_category.sort_order asc,contact_category.id asc,contacts.sort_order ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array_limit($limit)
    {
        $this->db->limit($limit);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function load($id)
    {
        $id = $this->db->escape_str($id);
        $cond = array('id' => $id);
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->row();
    }
    public function get_row_cond($cond = '')
    {
        if ($cond != '') {
            $this->db->where($cond);
        }
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->row();
    }
    public function get_pagination_count($cond = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_pagination($num, $offset, $cond = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        $this->db->limit($num, $offset);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function code_exists($code, $id)
    {
        $this->db->where('code', $code);
        $this->db->where('id !=', $id);
        $query = $this->db->get($this->table_name);
        $result = $query->num_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_contacts($category = null)
    {
        $this->db->where('status', 'Y');
        if (!empty($category)) {
            $this->db->where('category_id', $category);
        }
        $this->db->order_by('category_id', 'ASC');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->result_array();
    }

}
