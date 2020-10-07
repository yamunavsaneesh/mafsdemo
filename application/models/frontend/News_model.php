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
    public function get_array($cond = '', $fileds = '*', $order = 'date_time,desc')
    {
        if ($cond != '') {$this->db->where($cond);}
        $this->db->select($fileds);
        $this->db->where('status', 'Y');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->order_by($order);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_active()
    {
        $this->db->where('status', 'Y');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->order_by('date_time', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array_limit($limit)
    {
        $this->db->limit($limit);
        $this->db->select("$this->table_name.*,$this->desc_table_name.*");
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where('status', 'Y');
        $this->db->order_by('date_time', 'desc');
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
    public function get_row_cond($cond)
    {
        $this->db->where($cond);
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
        $this->db->where('status', 'Y');
        $this->db->order_by('date_time', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function code_exists($code, $id)
    {
        $this->db->where('slug', $code);
        $this->db->where('id !=', $id);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
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
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        foreach ($query->result_array() as $row):
            $idpair[$row['id']] = $row['title'];
        endforeach;
        return $idpair;
    }
    public function get_catnews($slug, $limit = '')
    {
        $this->db->where('slug', $slug);
        $this->db->from('news_category');
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            if ($limit != '') {
                $this->db->limit($limit);
            }
            $this->db->where(array('category_id' => $row->id));
            $this->db->from($this->table_name);
            $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
            $this->db->where('language', $this->session->userdata('front_language'));
            $this->db->order_by('date_time', 'desc');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

}
