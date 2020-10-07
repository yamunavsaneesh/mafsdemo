<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Menus extends Web_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $this->load->model('menu_model');
        $this->load->model('menuitems_model');
    }  
   public function index()
    {
        redirect('admin/menus/lists');
    }  
   public function lists()
    {
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - Menus';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/menus/lists/');
        $config['total_rows'] = $this->menu_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['menus'] = $this->menu_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));
        $main['content'] = $this->load->view('admin/menus/lists', $content, true);
        $this->load->view('admin/main', $main);
    }  
   public function add()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('class', 'Class', 'trim');
        $this->form_validation->set_rules('code', 'Code', 'trim|required|is_unique[menus.code]');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_message('is_unique', 'already exists');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Menus';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $main['content'] = $this->load->view('admin/menus/add', '', true);
            $this->load->view('admin/main', $main);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'class' => $this->input->post('class'),
                'code' => $this->input->post('code'),
                'status' => $this->input->post('status'));
            $loginid = $this->menu_model->insert($data);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Menu added Successfully.</p></div>');
                redirect('admin/menus/lists');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Menu not added.</p></div>');
                redirect('admin/menus/lists');
            }
        }
    }  
   public function edit($id, $return)
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('class', 'Class', 'trim');
        $this->form_validation->set_rules('code', 'Code', 'trim|required|callback_code_exists');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_message('is_unique', 'already exists');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Menus';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['return'] = $return;
            $edit['menu'] = $this->menu_model->load($id);
            $main['content'] = $this->load->view('admin/menus/edit', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'class' => $this->input->post('class'),
                'code' => $this->input->post('code'),
                'status' => $this->input->post('status'));  
           $cond = array('id' => $id);
            $loginid = $this->menu_model->update($data, $cond);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Menu updated Successfully.</p></div>');
                redirect('admin/menus/lists/' . $return);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Menu not updated.</p></div>');
                redirect('admin/menus/lists/' . $return);
            }
        }
    }  
   public function delete($id, $return)
    {
        $cond = array('id' => $id);
        $loginid = $this->menu_model->delete($cond);
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Menu deleted Successfully.</p></div>');
            redirect('admin/menus/lists/' . $return);
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Menu not deleted.</p></div>');
            redirect('admin/menus/lists/' . $return);
        }
    }  
   public function code_exists($code)
    {
        $id = $this->input->post('id');
        if ($this->menu_model->code_exists($code, $id)) {
            $this->form_validation->set_message('code_exists', 'already exists');
            return false;
        } else {
            return true;
        }
    }  
   public function actions()
    {
        $ids = $this->input->post('id');
        if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}
        if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}
        if (count($ids) > 0) {
            foreach ($ids as $id):
                $data = array('status' => $status);
                $loginid = $this->menu_model->update($data, array('id' => $id));
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Menu updated Successfully.</p></div>');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Menu not updated.</p></div>');
            }
        }
        redirect('admin/menus/lists/' . $this->input->post('return'));
    }  
   public function menuitems($id)
    {
        $menucond = array('menu_id' => $id, 'parent_id' => '0');
        $main['page_title'] = $this->config->item('site_name') . ' - Menus';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $content['menudetail'] = $this->menu_model->load($id);
        $content['menus'] = $this->render_menuitems_lists($menucond);
        $main['content'] = $this->load->view('admin/menus/menuitems', $content, true);
        $this->load->view('admin/main', $main);
    }  
   public function menuitemadd($id)
    {
        $menudetail = $this->menu_model->load($id);
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('short_desc', 'desc', 'trim');
        $this->form_validation->set_rules('class', 'Class', '');
        $this->form_validation->set_rules('link', 'Link', '');
        $this->form_validation->set_rules('show_subitems', 'Sub items', '');
        $this->form_validation->set_rules('target_type', 'Target', '');
        $this->form_validation->set_rules('parent_id', 'Parent', '');
        $this->form_validation->set_rules('link_type', 'Link Type', '');
        $this->form_validation->set_rules('link_object', 'Link object', '');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Menus';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $add['menudetail'] = $menudetail;
            $add['targettypes'] = $this->menuitems_model->get_target_types();
            $add['linktypes'] = $this->menuitems_model->get_link_types();
            $add['parentmenus'] = $this->get_menu_tree($id);
            $main['content'] = $this->load->view('admin/menus/addmenuitem', $add, true);
            $this->load->view('admin/main', $main);
        } else {
            $attachment = '';
            $config['upload_path'] = 'public/uploads/menus';
            $config['allowed_types'] = 'docx|doc|pdf|rtf|txt';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('attachment')) {
                $attachmentdata = $this->upload->data();
                $attachment = $attachmentdata['file_name'];
            }
            $so = (int) $this->input->post('sort_order');
            $maindata = array('menu_id' => $id, 'parent_id' => $this->input->post('parent_id'), 'link_type' => $this->input->post('link_type'), 'link_object' => $this->input->post('link_object'), 'show_subitems' => $this->input->post('show_subitems'), 'target_type' => $this->input->post('target_type'), 'sort_order' => $so, 'status' => $this->input->post('status'));
            $descdata = array('short_desc' => $this->input->post('short_desc'), 'class' => $this->input->post('class'), 'name' => $this->input->post('name'), 'attachment' => $attachment, 'link' => $this->input->post('link'));
            $config1['upload_path'] = 'public/uploads/contents';
            $config1['allowed_types'] = 'png|jpg|gif';
            $this->upload->initialize($config1);
            $this->load->library('upload', $config1);
            if ($this->upload->do_upload('icon')) {
                $attachmentdata = $this->upload->data();
                $maindata['icon'] = $attachmentdata['file_name'];
            }
            $insertid = $this->menuitems_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Menu Item added Successfully.</p></div>');
                redirect('admin/menus/menuitems/' . $id);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Menu Item not added.</p></div>');
                redirect('admin/menus/menuitems/' . $id);
            }
        }
    }  
   public function menuitemedit($id, $itemid)
    {
        $menudetail = $this->menu_model->load($id);
        $menuitemdetail = $this->menuitems_model->load($itemid);
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('short_desc', 'desc', 'trim');
        $this->form_validation->set_rules('class', 'Class', '');
        $this->form_validation->set_rules('link', 'Link', '');
        $this->form_validation->set_rules('show_subitems', 'Sub items', '');
        $this->form_validation->set_rules('target_type', 'Target', '');
        $this->form_validation->set_rules('parent_id', 'Parent', '');
        $this->form_validation->set_rules('link_type', 'Link Type', '');
        $this->form_validation->set_rules('link_object', 'Link object', '');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Menus';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['menudetail'] = $menudetail;
            $edit['menuitemdetail'] = $menuitemdetail;
            $edit['targettypes'] = $this->menuitems_model->get_target_types();
            $edit['linktypes'] = $this->menuitems_model->get_link_types();
            $edit['parentmenus'] = $this->get_menu_tree($id, '0', $menuitemdetail->parent_id);
            $main['content'] = $this->load->view('admin/menus/editmenuitem', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            $maindata = array('menu_id' => $id, 'parent_id' => $this->input->post('parent_id'), 'link_type' => $this->input->post('link_type'), 'link_object' => $this->input->post('link_object'), 'show_subitems' => $this->input->post('show_subitems'), 'target_type' => $this->input->post('target_type'), 'sort_order' => $this->input->post('sort_order'), 'status' => $this->input->post('status'));
            $descdata = array('short_desc' => $this->input->post('short_desc'), 'class' => $this->input->post('class'), 'name' => $this->input->post('name'), 'link' => $this->input->post('link'));
            $config['upload_path'] = 'public/uploads/menus';
            $config['allowed_types'] = 'docx|doc|pdf|rtf|txt';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('attachment')) {
                $attachmentdata = $this->upload->data();
                $descdata['attachment'] = $attachmentdata['file_name'];
            }
            $config1['upload_path'] = 'public/uploads/contents';
            $config1['allowed_types'] = 'png|jpg|gif';
            $this->upload->initialize($config1);
            $this->load->library('upload', $config1);
            if ($this->upload->do_upload('icon')) {
                $ico = $this->upload->data();
                $maindata['icon'] = $ico['file_name'];
            }
            $insertid = $this->menuitems_model->update($maindata, $descdata, $itemid);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Menu Item updated Successfully.</p></div>');
                redirect('admin/menus/menuitems/' . $id);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Menu Item not updated.</p></div>');
                redirect('admin/menus/menuitems/' . $id);
            }
        }
    }  
   public function menuitemactions($menuid)
    {
        $loginid = false;
        $ids = $this->input->post('id');
        $sort_orders = $this->input->post('sort_order');
        if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}
        if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}
        if (isset($status) && isset($_POST['id'])) {
            foreach ($ids as $id):
                $data = array('status' => $status);
                $loginid = $this->menuitems_model->update($data, array(), $id);
            endforeach;
        }
        if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save') {
            if ($sort_orders) {
                foreach ($sort_orders as $id => $sort_order):
                    $data = array('sort_order' => $sort_order);
                    $loginid = $this->menuitems_model->update($data, array(), $id);
                endforeach;
            }
        }
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Menu item updated Successfully.</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Menu item not updated.</p></div>');
        }
        redirect('admin/menus/menuitems/' . $menuid . '/' . $this->input->post('return'));
    }  
   public function getlinkto()
    {
        $linktype = $this->input->post('link_id');
        if ($linktype == '') {
            $finalarr = array();
        } else {
            $this->load->model(array('news_model', 'newscategory_model', 'contents_model', 'contentcategory_model', 'servicecategory_model'));
            $linktypes = array();
            $linktypes['news'] = $this->news_model->get_idpair();
            $linktypes['newslist'] = $this->newscategory_model->get_idpair();
            $linktypes['contents'] = $this->contents_model->get_idpairslug();
            $linktypes['contentlist'] = $this->contentcategory_model->get_idpairslug();  
           $linktypes['services'] = $this->servicecategory_model->get_idpair();
            $linktypes['external'] = array();
            $linktypes['internal'] = array();
            $linktypes['attachments'] = array();
            $linktypes['nolink'] = array();
            $intial = array('0' => 'Select');
            $finalarr = $linktypes[$linktype];
            $finalarr = $intial + $finalarr;
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($finalarr));exit;
    }

}
/* End of file menus.php */
/* Location: ./application/controllers/admin/menus.php */
