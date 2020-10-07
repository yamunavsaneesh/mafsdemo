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
        $this->menuprimary_key = 'id';
        $this->menuforeign_key = 'menu_id';
        $this->menutable_name = 'menus';
        $this->depth = 0;
        $this->height = 0;
        $this->exclude = array();
        $this->menuarr = array();
        $this->load->model(array('menu_model'));
    }
    public function get_array($cond = '', $fields = '*')
    {
        if (isset($cond)) {
            $this->db->where($cond);
        }$this->db->select($fields);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array_cond_limit($cond, $limit)
    {
        $this->db->where($cond);
        $this->db->limit($limit);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_active()
    {
        $this->db->where('status', 'Y');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_array_limit($limit)
    {
        $this->db->limit($limit);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
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
    public function get_row_cond_current($cond)
    {
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->row();
    }
    public function get_array_cond_parent($cond)
    {
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->join('contents', "contents.id = $this->table_name.link_object");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_row_cond_parent($cond)
    {
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
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
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where($cond);
        $this->db->order_by('sort_order', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_subcategories_home($cond = '')
    {
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where('parent_id', '8');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_subcategories1($cond)
    {
        $this->load->model('widgets_model');
        $fmenu = $this->widgets_model->load_footer();
        $cond1 = $fmenu->parent_menu_id;
        @$fldwid = explode(",", stripslashes($cond1));
        //$this->db->distinct('id');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where($cond);
        $this->db->where_in('menuitems_id', $fldwid);
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

				<td class="align-center"><input type="checkbox" name="id[]" value="' . $child['id'] . '" /></td>

				<td>';
            for ($c = 0; $c < $this->depth; $c++) // Indent over so that there is distinction between levels
            { $temp_tree .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
            $temp_tree .= '<span class="menutitle" style="background-image:url(' . base_url('public/admin/images/arrows/' . $this->depth . '.png') . ')">';
            $temp_tree .= $child['name'] . '</span></td>

				<td align="center"><input style="text-align:center;" type="text" size="2" name="sort_order[' . $child['id'] . ']" value="' . $child['sort_order'] . '" /></td>

				<td align="center">' . $activearr[$child['status']] . '</td>

				<td>

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
        return array('contents' => 'Contents', 'news' => 'News', 'contentlist' => 'Contents Listing', 'external' => 'External Link', 'internal' => 'Internal Link');
    }
    public function get_single_levelmenu($menuid)
    {
        $menus = array();
        $cond = array('code' => $menuid, 'parent_id' => '0', 'menuitems.status' => 'Y');
        $this->db->select('menuitems.*, menuitems_desc.*');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->join('menus', "menus.id = $this->table_name.menu_id");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where($cond);
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        $results = $query->result_array();
        if (count($results) > 0) {
            foreach ($results as $result):
                $link = '';
                if ($result['link_type'] == 'attachments') {
                    $link = base_url('public/uploads/menus/' . $result['attachment']);
                }
                if ($result['link_type'] == 'internal') {
                    $link = site_url($result['link']);
                }
                if ($result['link_type'] == 'contents') {
                    if (isset($this->contents[$result['link_object']])) {
                        @$link = site_url('contents/view/' . $this->contents[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'contentlist') {
                    if (isset($this->contentcategoryslugs[$result['link_object']])) {
                        $link = site_url('contents/lists/' . $this->contentcategoryslugs[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'newslist') {
                    if (isset($this->newcategoryslugs[$result['link_object']])) {
                        $link = site_url('news/lists/' . $this->newcategoryslugs[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'news') {
                    if (isset($this->newslugs[$result['link_object']])) {
                        @$link = site_url('news/view/' . $this->newslugs[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'nolink') {
                    $link = "javascript:void(0);";
                }
                $menu['link'] = $link;
                $menu['name'] = $result['name'];
                $menu['windowtype'] = $result['target_type'];
                $menus[] = $menu;
                unset($menu);
            endforeach;
        }
        return $menus;
    }
    public function get_singlelevel_submenu($menuid, $limit)
    {
        $menuvars = explode(':', $menuid);
        $menuid = $menuvars[0];
        $parentid = $menuvars[1];
        $menus = array();
        $cond = array('menu_id' => $menuid, 'parent_id' => $parentid, 'menuitems.status' => 'Y');
        $this->db->select('menuitems.*, menuitems_desc.*');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->join('menus', "menus.id = $this->table_name.menu_id");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where($cond);
        $this->db->limit($limit);
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        $results = $query->result_array();
        if (count($results) > 0) {
            foreach ($results as $result):
                $link = '';
                if ($result['link_type'] == 'attachments') {
                    $link = base_url('public/uploads/menus/' . $result['attachment']);
                }
                if ($result['link_type'] == 'internal') {
                    $link = site_url($result['link']);
                }
                if ($result['link_type'] == 'contents') {
                    if (isset($this->contents[$result['link_object']])) {
                        @$link = site_url('contents/view/' . $this->contents[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'contentlist') {
                    if (isset($this->contentcategoryslugs[$result['link_object']])) {
                        $link = site_url('contents/lists/' . $this->contentcategoryslugs[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'newslist') {
                    if (isset($this->newcategoryslugs[$result['link_object']])) {
                        $link = site_url('news/lists/' . $this->newcategoryslugs[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'news') {
                    if (isset($this->newslugs[$result['link_object']])) {
                        @$link = site_url('news/view/' . $this->newslugs[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'nolink') {
                    $link = "javascript:void(0);";
                }
                $menu['link'] = $link;
                $menu['name'] = $result['name'];
                $menu['windowtype'] = $result['target_type'];
                $menus[] = $menu;
                unset($menu);
            endforeach;
        }
        return $menus;
    }
    public function get_menu_ul($menuid, $id = '0')
    {
        $lastseg = end($this->uri->segments);
        $segcat = 0;
        switch ($this->router->fetch_class()) {
            case 'services':
                $segres = isset($this->serviceslugs[$lastseg]) ? $this->serviceslugs[$lastseg] : '';
                break;
            case 'contents':
                $segres = isset($this->contentslugs[$lastseg]) ? $this->contentslugs[$lastseg] : '';
                break;
            default:$segcat = 0;
                $segres = '';
                break;
        }
        if ($segres) {$segcat = $segres['category_id'];}
        $link = '';
        $i = 0;
        $menu = $this->menu_model->get_row_cond(array('code' => $menuid));
        $temp_tree = '';
        if ($menu) {
            $cond = array('menu_id' => $menu->id, 'parent_id' => $id, 'menuitems.status' => 'Y');
            $children = $this->get_subcategories($cond);
            if ($children) {
                if ($id < 1) {
                    $temp_tree .= '<ul';
                    if ($this->depth == '') {$temp_tree .= ' class=" navbar-nav ml-auto main-nav ' . $menu->class . '"';}
                    $temp_tree .= '>';}
                foreach ($children as $child) {$objects = '';
                    switch ($child['link_type']) {
                        case 'services':
                            $objects = $this->catservices[$child['link_object']];
                            $link = site_url('services/view');
                            break;
                        case 'attachments':
                            $link = base_url('public/uploads/menus/' . $child['attachment']);
                            break;
                        case 'internal':
                            $link = site_url($child['link']);
                            break;
                        case 'external':
                            $link = $child['link'];
                            break;
                        case 'contents':
                            if (isset($this->contents[$child['link_object']])) {
                                $link = site_url('contents/view/' . $this->contents[$child['link_object']]);
                            } else {
                                $link = site_url('/');
                            }
                            break;
                        case 'contentlist':
                            if (isset($this->contentcategoryslugs[$child['link_object']])) {
                                $link = site_url('contents/lists/' . $this->contentcategoryslugs[$child['link_object']]);
                            } else {
                                $link = site_url('/');
                            }
                            break;
                        case 'nolink':
                            $link = 'javascript:void(0)';
                            break;
                        default:
                            $link = site_url('/');
                            break;
                    }
                    if ($id < 1) {
                        $temp_tree .= ' <li class="nav-item ';
                    }
                    $count = count($children);
                    $active = '';
                    if (current_url() == $link) {$active = 'active';}
                    if ($objects != '') {
                        $temp_tree .= 'dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $child['name'] . '
								<span><i class="fa fa-angle-down"></i></span>
								</a>

								<!-- Dropdown list -->
								<div class="dropdown-menu">';
                        foreach ($objects as $val): $active = '';
                            if (current_url() == $link . '/' . $val['slug']) {$active = 'active';}
                            $temp_tree .= '<a class="dropdown-item ' . $active . '" href="' . $link . '/' . $val['slug'] . '">' . $val['title'] . '</a>';
                        endforeach;
                        $temp_tree .= '</div>';
                    } else {
                        if (in_array($child['name'], array('Media Center', 'About Us'))) {
                            //    print_r($child);
                            //        echo $segcat,$child['id'];exit;
                            //if($segcat == $child['parent_id']){$active = 'active';}
                            $temp_tree .= $active . ' dropdown dropdown-slide"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $child['name'] . '
						<span><i class="fa fa-angle-down"></i></span>
						</a>
						<!-- Dropdown list -->
						<div class="dropdown-menu">';
                            $temp_tree .= $this->get_menu_ul($menuid, $child['id']);
                            $temp_tree .= '</div>';
                        } else {
                            if ($id < 1) {
                                $temp_tree .= ' ' . $active . '"><a class="nav-link" href="' . $link . '"> ' . $child['name'] . '</a>';} else {
                                $temp_tree .= '<a class="dropdown-item ' . $active . '" href="' . $link . '"> ' . $child['name'] . '</a>';}
                        }
                    }
                    $this->depth++;
                    //$this->depth--;
                    if ($id < 1) {$temp_tree .= '</li>';}
                }
                if ($id < 1) {$temp_tree .= '</ul>';}
            }
        }
        $temp_tree .= '';
        return $temp_tree;
    }
    public function get_menu($menuid, $id = '0')
    {
        $link = $temp_tree = '';
        $menu = $this->menu_model->get_row_cond(array('code' => $menuid));
        if ($menu) {
            if ($this->depth == '') {$temp_tree .= '<ul class="footer-nav">';}
            $cond = array('menu_id' => $menu->id, 'parent_id' => $id, 'menuitems.status' => 'Y');
            $children = $this->get_subcategories($cond);
            if ($children) {
                foreach ($children as $child) {$objects = '';
                    switch ($child['link_type']) {
                        case 'services':
                            $objects = $this->services;
                            $objurl = 'services/';
                            $link = site_url('services');
                            break;
                        case 'attachments':
                            $link = base_url('public/uploads/menus/' . $child['attachment']);
                            break;
                        case 'internal':
                            $link = site_url($child['link']);
                            break;
                        case 'external':
                            $link = $child['link'];
                            break;
                        case 'contents':
                            if (isset($this->contents[$child['link_object']])) {
                                $link = site_url('contents/view/' . $this->contents[$child['link_object']]);
                            } else {
                                $link = site_url('/');
                            }
                            break;
                        case 'contentlist':
                            if (isset($this->contentcategoryslugs[$child['link_object']])) {
                                $link = site_url('contents/lists/' . $this->contentcategoryslugs[$child['link_object']]);
                                $objects = $this->contentsections[$child['link_object']];
                                $objurl = 'contents/view/';
                            } else {
                                $link = site_url('/');
                            }
                            break;
                        case 'nolink':
                            $link = 'javascript:void(0)';
                            break;
                        default:
                            $link = site_url('/');
                            break;
                    }
                    if ($this->depth == '') {$temp_tree .= '<li><h3>' . $child['name'] . '</h3>';} else { $temp_tree .= '<dl><dt><a href="' . $link . '">' . $child['name'] . '</a></dt></dl>';}
                    if ($objects != '') {
                        $temp_tree .= '<dl>';
                        foreach ($objects as $val):
                            $temp_tree .= ' <dt><a href="' . site_url($objurl . $val['slug']) . '">' . $val['title'] . '</a></dt>';
                        endforeach;
                        $temp_tree .= '</dl>';
                    } else {
                        $this->depth++;
                        $temp_tree .= $this->get_menu($menuid, $child['id']);
                        $this->depth--;
                        array_push($this->exclude, $child['id']);
                        $this->height++;
                    }
                }
                if ($this->depth == '') {$temp_tree .= '</ul>';}
            }
        }
        return $temp_tree;
    }
    public function get_policy_menu($menuid, $id = '0')
    {
        $link = $temp_tree = '';
        $tree = array();
        $menu = $this->menu_model->get_row_cond(array('code' => $menuid));
        if ($menu) {$cond = array('menu_id' => $menu->id, 'parent_id' => $id, 'menuitems.status' => 'Y');
            $children = $this->get_subcategories($cond);
            if ($children) {
                foreach ($children as $child) {$objects = '';
                    switch ($child['link_type']) {
                        case 'services':
                            $objects = $this->services;
                            $objurl = 'services/';
                            $link = site_url('services');
                            break;
                        case 'attachments':
                            $link = base_url('public/uploads/menus/' . $child['attachment']);
                            break;
                        case 'internal':
                            $link = site_url($child['link']);
                            break;
                        case 'external':
                            $link = $child['link'];
                            break;
                        case 'contents':
                            if (isset($this->contents[$child['link_object']])) {
                                $link = site_url('contents/view/' . $this->contents[$child['link_object']]);
                            } else {
                                $link = site_url('/');
                            }
                            break;
                        case 'contentlist':
                            if (isset($this->contentcategoryslugs[$child['link_object']])) {
                                $link = site_url('contents/lists/' . $this->contentcategoryslugs[$child['link_object']]);
                                $objects = $this->contentsections[$child['link_object']];
                                $objurl = 'contents/view/';
                            } else {
                                $link = site_url('/');
                            }
                            break;
                        case 'nolink':
                            $link = 'javascript:void(0)';
                            break;
                        default:
                            $link = site_url('/');
                            break;
                    }
                    $tree[] = '<a href="' . $link . '">' . $child['name'] . '</a>';
                }
                $temp_tree = implode(' - ', $tree);
            }
        }
        return $temp_tree;
    }
    public function get_single_levelsubmenu($menuid, $parentid)
    {
        $menus = array();
        $cond = array('code' => $menuid, 'parent_id' => $parentid, 'menuitems.status' => 'Y');
        $this->db->select('menuitems.*, menuitems_desc.*');
        $this->db->from($this->table_name);
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->join('menus', "menus.id = $this->table_name.menu_id");
        $this->db->where('language', $this->session->userdata('front_language'));
        $this->db->where($cond);
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        $results = $query->result_array();
        if (count($results) > 0) {
            foreach ($results as $result):
                $link = '';
                if ($result['link_type'] == 'attachments') {
                    $link = base_url('public/uploads/menus/' . $result['attachment']);
                }
                if ($result['link_type'] == 'internal') {
                    $link = site_url($result['link']);
                }
                if ($result['link_type'] == 'contents') {
                    if (isset($this->contents[$result['link_object']])) {
                        @$link = site_url('contents/view/' . $this->contents[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'contentlist') {
                    if (isset($this->contentcategoryslugs[$result['link_object']])) {
                        $link = site_url('contents/lists/' . $this->contentcategoryslugs[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'newslist') {
                    if (isset($this->newcategoryslugs[$result['link_object']])) {
                        $link = site_url('news/lists/' . $this->newcategoryslugs[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'news') {
                    if (isset($this->newslugs[$result['link_object']])) {
                        @$link = site_url('news/view/' . $this->newslugs[$result['link_object']]);
                    } else {
                        @$link = site_url('/');
                    }
                }
                if ($result['link_type'] == 'nolink') {
                    $link = "javascript:void(0);";
                }
                $menu['link'] = $link;
                $menu['id'] = $result['id'];
                $menu['name'] = $result['name'];
                $menu['windowtype'] = $result['target_type'];
                $menus[] = $menu;
                unset($menu);
            endforeach;
        }
        return $menus;
    }
    public function get_currentmenu($id, $link_type)
    {
        if ($link_type == 'internal') {
            $cond = array('link_type' => $link_type, 'code' => 'top_menu', 'link' => $id);
        } else {
            $cond = array('link_type' => $link_type, 'link_object' => $id, 'code' => 'top_menu');
        }
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $this->db->select($this->table_name . '.*');
        $this->db->join($this->menutable_name, "$this->table_name.$this->menuforeign_key = $this->menutable_name.$this->menuprimary_key");
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            $this->db->where(array('parent_id' => $row->id, 'menu_id' => $row->menu_id));
            $this->db->from($this->table_name);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count > 0) {
                return $row->id . ':' . $row->id;
            } else {
                return $row->id . ':' . $row->parent_id;
            }
        } else {
            return ':';
        }
    }
    public function get_currentnewsmenu($id, $link_type)
    {
        $cond = array('id' => $id);
        $this->db->where($cond);
        $this->db->from('news');
        $query = $this->db->get();
        $row = $query->row();
        $cond = array('link_type' => $link_type, 'link_object' => $row->category_id, 'code' => 'top_menu');
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $this->db->select($this->table_name . '.*');
        $this->db->join($this->menutable_name, "$this->table_name.$this->menuforeign_key = $this->menutable_name.$this->menuprimary_key");
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id . ':' . $row->parent_id;
        } else {
            return ':';
        }
    }
    public function get_currentmenurow($id, $link_type)
    {
        if ($link_type == 'internal') {
            $cond = array('link_type' => $link_type, 'code' => 'top_menu', 'link' => $id);
        } else {
            $cond = array('link_type' => $link_type, 'link_object' => $id, 'code' => 'top_menu');
        }
        $this->db->where($cond);
        $this->db->from($this->table_name);
        $this->db->select($this->table_name . '.*');
        $this->db->join($this->menutable_name, "$this->table_name.$this->menuforeign_key = $this->menutable_name.$this->menuprimary_key");
        $this->db->join($this->desc_table_name, "$this->desc_table_name.$this->foreign_key = $this->table_name.$this->primary_key");
        $this->db->where('language', $this->session->userdata('front_language'));
        $query = $this->db->get();
        return $query->row();
    }
    public function get_menu_path($id)
    {
        $catpath = array();
        $menu = $this->load($id);
        $i = 0;
        while ($menu) {
            $i++;
            if ($menu->link_type == 'attachments') {
                $link = base_url('public/uploads/menus/' . $menu->attachment);
            }
            if ($menu->link_type == 'internal') {
                $link = site_url($menu->link);
            }
            if ($menu->link_type == 'contents') {
                if (isset($this->contents[$menu->link_object])) {
                    @$link = site_url('contents/view/' . $this->contents[$menu->link_object]);
                } else {
                    @$link = site_url('/');
                }
            }
            if ($menu->link_type == 'contentlist') {
                if (isset($this->contentcategoryslugs[$menu->link_object])) {
                    $link = site_url('contents/lists/' . $this->contentcategoryslugs[$menu->link_object]);
                } else {
                    @$link = site_url('/');
                }
            }
            if ($menu->link_type == 'newslist') {
                if (isset($this->newcategoryslugs[$menu->link_object])) {
                    $link = site_url('news/lists/' . $this->newcategoryslugs[$menu->link_object]);
                } else {
                    @$link = site_url('/');
                }
            }
            if ($menu->link_type == 'news') {
                if (isset($this->newslugs[$menu->link_object])) {
                    @$link = site_url('news/view/' . $this->newslugs[$menu->link_object]);
                } else {
                    @$link = site_url('/');
                }
            }
            if ($menu->link_type == 'nolink') {
                $link = $menu->link_type;
            }
            $catpath[$i]['link'] = $link;
            $catpath[$i]['name'] = $menu->name;
            $menu = $this->load($menu->parent_id);
        }
        return $catpath;
    }

}
