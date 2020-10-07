<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Menuitems_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->lang_table_name = 'languages';
        $this->table_name = 'menuitems';
        $this->desc_table_name = 'menuitems_desc';
        $this->primary_key = 'id';
        $this->foreign_key = 'menuitems_id';
        $this->depth = 0;
        $this->height = 0;
        $this->exclude = array();
    }
    public function get_array($cond = '')
    {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_menu_withsubmenu($menuid)
    {
        $this->db->distinct();
        $this->db->select('parent_id');
        $this->db->where(array('parent_id !=' => '0', 'menu_id' => $menuid));
        $this->db->from($this->table_name);
        $query = $this->db->get();
        $parentmenus = $query->result_array();
        $parentmenuids = array();
        foreach ($parentmenus as $parentmenu) {
            $parentmenuids[] = $parentmenu['parent_id'];
        }
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where_in('id', $parentmenuids);
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array2($cond = '')
    {
        /*if(isset($cond)){
        $this->db->where($cond);
        }*/
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array1($cond = '')
    {
        /*    if(isset($cond)){
        $this->db->where($cond);
        }
         */
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $query = $this->db->get();
        $pagerow = $query->result_array();
        $children = array();
        foreach ($pagerow as $pagerow1) {
            $id = $pagerow1['menuitems_id'];
            $children = $this->get_array(array('parent_id' => $id));
        }
        return $children;
    }
    public function get_array_sub($cond = '')
    {
        if (isset($cond)) {
            $this->db->where('parent_id !=', 1);
        }
        // $this->db->distinct('parent_id');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('languag', $this->session->userdata('admin_language'));
        $this->db->group_by('parent_id');
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
    public function get_mutiple($cond)
    {
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $this->db->where_in($cond);
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
        $this->db->limit($num, $offset);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
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
    public function get_subcategories($cond)
    {
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('admin_language'));
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_subcategories2($cond)
    {
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('languag', $this->session->userdata('admin_language'));
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_menu_list_tree($cond, $selected = '')
    {
        $activearr = array('Y' => 'Active', 'N' => 'Inactive');
        $temp_tree = "";
        $children = $this->get_subcategories($cond);
        foreach ($children as $child) {
            $temp_tree .= '<tr>

				<td class="align-center" width="1%" nowrap="nowrap"><input type="checkbox" name="id[]" value="' . $child['id'] . '" /></td>

				<td>';
            for ($c = 0; $c < $this->depth; $c++) // Indent over so that there is distinction between levels
            { $temp_tree .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
            $temp_tree .= '<span class="menutitle" style="background-image:url(' . base_url('public/admin/images/arrows/' . $this->depth . '.png') . ')">';
            $temp_tree .= $child['name'] . '</span></td>

				<td align="center" nowrap="nowrap"><input style="text-align:center;" type="text" size="2" name="sort_order[' . $child['id'] . ']" value="' . $child['sort_order'] . '" /></td>

				<td align="center">' . $activearr[$child['status']] . '</td>

				<td align="center" nowrap="nowrap">

					<a href="' . site_url('admin/menus/menuitemedit/' . $child['menu_id'] . '/' . $child['id']) . '" class="table-icon edit" title="Edit"></a>

				</td>

			</tr>';
            $this->depth++;
            $cond['parent_id'] = $child['id'];
            $temp_tree .= $this->get_menu_list_tree($cond, $selected);
            $this->depth--;
            array_push($this->exclude, $child['id']);
            $this->height++;
        }
        return $temp_tree;
    }
    public function get_category_tree($menuid, $id = '0', $selected = '')
    {
        $temp_tree = "";
        $cond = array('menu_id' => $menuid, 'parent_id' => $id);
        $children = $this->get_subcategories($cond);
        foreach ($children as $child) {
            $temp_tree .= '<option value="' . $child['id'] . '"';
            if ($selected == $child['id']) {$temp_tree .= ' selected="selected" ';}
            $temp_tree .= '>';
            for ($c = 0; $c < $this->depth; $c++) // Indent over so that there is distinction between levels
            { $temp_tree .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
            if ($this->depth > 0) {$temp_tree .= '----&nbsp;';}
            $temp_tree .= $child['name'] . '</option>';
            $this->depth++;
            $temp_tree .= $this->get_category_tree($menuid, $child['id'], $selected);
            $this->depth--;
            array_push($this->exclude, $child['id']);
            $this->height++;
        }
        return $temp_tree;
    }
    public function get_target_types()
    {
        return array('_self' => 'Self', '_blank' => 'Blank', '_new' => 'New', '_parent' => 'Parent', '_top' => 'Top');
    }
    public function get_link_types()
    {
        return array('contents' => 'Contents',
            'news' => 'News',
            'services' => 'Services', 'contentlist' => 'Contents Listing', 'external' => 'External Link', 'internal' => 'Internal Link');
    }

}
