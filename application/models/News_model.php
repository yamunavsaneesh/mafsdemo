<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class News_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->lang_table_name = 'languages';
        $this->table_name = 'news';
        $this->desc_table_name = 'news_desc';
        $this->primary_key = 'id';
        $this->foreign_key = 'contents_id';
    }
    public function get_array()
    {
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_active()
    {
        $this->db->where('status', 'Y');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_subcategories3($cond)
    {
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('languag', $this->session->userdata('admin_language'));
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array_limit($limit)
    {
        $this->db->limit($limit);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
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
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        return $query->row();
    }
    public function get_row_cond($cond)
    {
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        return $query->row();
    }
    public function insert($maindata, $descdata)
    {
        $this->db->insert($this->table_name, $maindata);
        $prime = $this->db->insert_id();
        $query = $this->db->get($this->lang_table_name);
        foreach ($query->result_array() as $row):
            $rowdata = $descdata;
            $rowdata[$this->foreign_key] = $prime;
            $rowdata['language'] = $row['code'];
            $this->db->insert($this->desc_table_name, $rowdata);
            unset($rowdata);
        endforeach;
        return $prime;
    }
    public function update($maindata, $descdata, $id)
    {
        $cond[$this->primary_key] = $id;
        $desccond[$this->foreign_key] = $id;
        $desccond['language'] = $this->session->userdata('admin_language');
        if (count($descdata) > 0) {
            $this->db->update($this->desc_table_name, $descdata, $desccond);
        }
        return $this->db->update($this->table_name, $maindata, $cond);
    }
    public function delete($id)
    {
        $desccond = array($this->foreign_key => $id);
        $this->db->delete($this->desc_table_name, $desccond);
        $cond = array('id' => $id);
        return $this->db->delete($this->table_name, $cond);
    }
    public function get_pagination_count($cond = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        if ($this->session->userdata('content_category_id') != '') {
            $this->db->where('category_id', $this->session->userdata('content_category_id'));
        }
        if ($this->session->userdata('content_key') != '') {
            $this->db->like($this->session->userdata('content_field'), $this->session->userdata('content_key'), 'both');
        }
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_pagination($num, $offset, $cond = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        if ($this->session->userdata('content_category_id') != '') {
            $this->db->where('category_id', $this->session->userdata('content_category_id'));
        }
        if ($this->session->userdata('content_key') != '') {
            $this->db->like($this->session->userdata('content_field'), $this->session->userdata('content_key'), 'both');
        }
        if ($this->session->userdata('order_field') != '' && $this->session->userdata('sort_field') != '') {
            $this->db->order_by($this->session->userdata('sort_field'), $this->session->userdata('order_field'));
        }
        $this->db->limit($num, $offset);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function code_exists($code, $id)
    {
        $this->db->where('slug', $code);
        $this->db->where('id !=', $id);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        $result = $query->num_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_idpair()
    {
        $idpair = array();
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        foreach ($query->result_array() as $row):
            $idpair[$row['id']] = $row['title'];
        endforeach;
        return $idpair;
    }
    public function get_fields()
    {
        return array('title' => 'Title', 'short_desc' => 'Short Description');
    }
    public function create_slug($title)
    {
        $slug = url_title($title);
        $slug = sanitizeStringForUrl($slug);
        $this->db->where('slug', $slug);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        $result = $query->num_rows();
        if ($result > 0) {
            return $slug . date('ymdhis');
        } else {
            return $slug;
        }
    }
    public function update_slug($slug, $id)
    {
        $slug = url_title($slug);
        $slug = sanitizeStringForUrl($slug);
        $this->db->where('slug', $slug);
        $this->db->where('id !=', $id);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        $result = $query->num_rows();
        if ($result > 0) {
            return $slug . date('ymdhis');
        } else {
            return $slug;
        }
    }

}
