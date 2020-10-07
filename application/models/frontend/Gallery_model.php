<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Gallery_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->lang_table_name = 'languages';
        $this->table_name = 'gallery';
        $this->desc_table_name = 'gallery_desc';
        $this->primary_key = 'id';
        $this->foreign_key = 'gallery_id';
    }
    public function get_array()
    {
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where('status', 'Y');
        $this->db->order_by('sort_order', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array_cond($id)
    {
        $id = $this->db->escape_str($id);
        $cond = array('parent_id' => $id);
        $this->db->where($cond);
        $this->db->order_by('sort_order', 'asc');
        $this->db->from('gallery1');
        //$this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        //$this->db->where('language',$this->session->userdata('front_language'));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }
    public function get_active()
    {
        $this->db->where('status', 'Y');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where('status', 'Y');
        $this->db->order_by('sort_order', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array_limit($limit)
    {
        $this->db->limit($limit);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where('status', 'Y');
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
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->row();
    }
    public function get_row_cond($cond)
    {
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where('status', 'Y');
        $this->db->order_by('sort_order', 'asc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
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
        $desccond['language'] = $this->session->userdata('front_language');
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
    public function get_array_cond2($id)
    {
        $id = $this->db->escape_str($id);
        $cond = array('parent_id' => $id);
        $this->db->where($cond);
        $this->db->order_by('sort_order', 'asc');
        $this->db->from('gallery1');
        //$this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        //$this->db->where('language',$this->session->userdata('front_language'));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function get_pagination_count($cond = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }

//        if($this->session->userdata('gallery_category_id')!=''){

//            $this->db->where('category_id',$this->session->userdata('gallery_category_id'));

//        }

//        if($this->session->userdata('gallery_key')!=''){

//            $this->db->like($this->session->userdata('gallery_field'),$this->session->userdata('gallery_key'),'both');

//        }
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

//        if($this->session->userdata('gallery_category_id')!=''){

//            $this->db->where('category_id',$this->session->userdata('gallery_category_id'));

//        }

//        if($this->session->userdata('gallery_key')!=''){

//            $this->db->like($this->session->userdata('gallery_field'),$this->session->userdata('gallery_key'),'both');

//        }

//        if($this->session->userdata('order_field')!='' && $this->session->userdata('sort_field')!=''){

//            $this->db->order_by($this->session->userdata('sort_field'), $this->session->userdata('order_field'));

//        }
        $this->db->limit($num, $offset);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_catcontents($slug, $limit = '')
    {
        $this->db->where('slug', $slug);
        $this->db->from('gallery_category');
        $query = $this->db->get();
        $row = $query->row();
        if ($limit != '') {
            $this->db->limit($limit);
        }
        $this->db->where(array('category_id' => $row->id));
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->order_by('sort_order', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

}
