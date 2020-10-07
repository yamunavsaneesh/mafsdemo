<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Adminmenu_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'admin_menu';
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
    public function get_menu()
    {
        $menu = $sub_menu_items = array();
        $this->db->where('status', 'Y');
        $this->db->where('parent_id', '0');
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get($this->table_name);
        $main_menus = $query->result_array();
        foreach ($main_menus as $main_menu):
            $this->db->where('status', 'Y');
            $this->db->where('parent_id', $main_menu['id']);
            $this->db->order_by('sort_order', 'ASC');
            $query = $this->db->get($this->table_name);
            $sub_menus = $query->result_array();
            $sub_menu_items = array();
            if ($sub_menus) {
                foreach ($sub_menus as $child):
                    $this->db->where('status', 'Y');
                    $this->db->where('parent_id', $child['id']);
                    $this->db->order_by('sort_order', 'ASC');
                    $query = $this->db->get($this->table_name);
                    $child_menus = $query->result_array();
                    $sub_menu_items[] = array(
                        'id' => $child['id'],
                        'name' => $child['name'],
                        'class' => $child['class'],
                        'link' => $child['link'],
                        'child_menus' => $child_menus,
                    );
                endforeach;}
            $menu[] = array(
                'id' => $main_menu['id'],
                'name' => $main_menu['name'],
                'class' => $main_menu['class'],
                'link' => $main_menu['link'],
                'sub_menu' => $sub_menu_items,
            );
        endforeach;
        return $menu;
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
        $this->db->limit($num, $offset);
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result_array();
    }

}
