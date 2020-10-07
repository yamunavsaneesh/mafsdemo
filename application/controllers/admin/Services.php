<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Services extends Web_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $this->load->model('servicecategory_model');
        $this->load->model('services_model');
    }  
   public function index()
    {
        redirect('admin/services/lists');
    }  
   public function lists()
    {  
       $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - Products';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/services/lists/');
        $config['total_rows'] = $this->services_model->get_pagination_count();
        $config['per_page'] = '50';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['contentfields'] = $this->services_model->get_fields();
        $content['sortorders'] = array('asc' => 'Ascending', 'desc' => 'Descending');
        $content['contentcats'] = $this->servicecategory_model->get_array();
        $content['contents'] = $this->services_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']), null, 'sort_order ASC');
        $content['categories'] = $this->servicecategory_model->get_idpair();
        $main['content'] = $this->load->view('admin/services/product/lists', $content, true);
        $this->load->view('admin/main', $main);
    }
    public function add()
    {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url('public/admin/ckeditor/');
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '100%';
        $this->ckeditor->config['height'] = '200px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url('public/admin/ckfinder/'));
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('short_desc', 'Short Description', '');
        $this->form_validation->set_rules('price', 'Price', '');
        $this->form_validation->set_rules('meta_title', 'meta_title', '');
        $this->form_validation->set_rules('keywords', 'Keywords', '');
        $this->form_validation->set_rules('desc', 'Description', '');
        $this->form_validation->set_rules('meta_desc', 'Meta Description', '');
        $this->form_validation->set_rules('banner_text', 'banner text', '');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Products';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $add['contentcats'] = $this->servicecategory_model->get_array();
            $main['content'] = $this->load->view('admin/services/product/add', $add, true);
            $this->load->view('admin/main', $main);
        } else {
            $slug = $this->services_model->create_slug($this->input->post('title'));
            $price = (int) $this->input->post('price');
            $maindata = array('featured' => $this->input->post('featured'), 'price' => $price,
                'status' => $this->input->post('status'), 'category_id' => $this->input->post('category_id'), 'slug' => $slug);
            $descdata = array('title' => $this->input->post('title'),
                'keywords' => $this->input->post('keywords'),
                'meta_desc' => $this->input->post('meta_desc'),
                'short_desc' => $this->input->post('short_desc'),
                'desc' => $this->input->post('desc'),
                'meta_title' => $this->input->post('meta_title'),
                'banner_text' => $this->input->post('banner_text'));
            $config['upload_path'] = 'public/uploads/services';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('banner_image')) {
                $banner_imagedata = $this->upload->data();
                $descdata['banner_image'] = $banner_imagedata['file_name'];
            }
            if ($this->upload->do_upload('image')) {
                $contentimagedata = $this->upload->data();
                $descdata['image'] = $contentimagedata['file_name'];
            }  
           if ($this->upload->do_upload('icon')) {
                $contentpdfdata = $this->upload->data();
                $descdata['icon'] = $contentpdfdata['file_name'];
            }
            $insertid = $this->services_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content added Successfully.</p></div>');
                redirect('admin/services/lists');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not added.</p></div>');
                redirect('admin/services/lists');
            }
        }
    }
    public function edit($id, $return)
    {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url('public/admin/ckeditor/');
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '100%';
        $this->ckeditor->config['height'] = '200px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url('public/admin/ckfinder/'));
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('short_desc', 'Short Description', '');
        $this->form_validation->set_rules('price', 'Price', '');
        $this->form_validation->set_rules('meta_title', 'meta_title', '');
        $this->form_validation->set_rules('keywords', 'Keywords', '');
        $this->form_validation->set_rules('desc', 'Description', '');
        $this->form_validation->set_rules('meta_desc', 'Meta Description', '');
        $this->form_validation->set_rules('banner_text', 'banner text', '');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Contents';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['return'] = $return;
            $edit['contentcats'] = $this->servicecategory_model->get_array();
            $edit['content'] = $this->services_model->load($id);
            $main['content'] = $this->load->view('admin/services/product/edit', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            $slug = $this->services_model->update_slug($this->input->post('slug'), $id);
            $price = (int) $this->input->post('price');
            $maindata = array('featured' => $this->input->post('featured'), 'price' => $price, 'status' => $this->input->post('status'), 'category_id' => $this->input->post('category_id'), 'slug' => $slug);
            $descdata = array('title' => $this->input->post('title'),
                'keywords' => $this->input->post('keywords'),
                'meta_desc' => $this->input->post('meta_desc'),
                'short_desc' => $this->input->post('short_desc'),
                'desc' => $this->input->post('desc'),
                'meta_title' => $this->input->post('meta_title'),
                'banner_text' => $this->input->post('banner_text'));
            $config['upload_path'] = 'public/uploads/services';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('banner_image')) {
                $banner_imagedata = $this->upload->data();
                $descdata['banner_image'] = $banner_imagedata['file_name'];
            }
            if ($this->upload->do_upload('image')) {
                $contentimagedata = $this->upload->data();
                $descdata['image'] = $contentimagedata['file_name'];
            }  
           if ($this->upload->do_upload('icon')) {
                $contentpdfdata = $this->upload->data();
                $descdata['icon'] = $contentpdfdata['file_name'];
            }
            $loginid = $this->services_model->update($maindata, $descdata, $id);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content updated Successfully.</p></div>');
                redirect('admin/services/lists/' . $return);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not updated.</p></div>');
                redirect('admin/services/lists/' . $return);
            }
        }
    }  
   public function delete($id, $return)
    {
        $loginid = $this->services_model->delete($id);
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content deleted Successfully.</p></div>');
            redirect('admin/services/lists/' . $return);
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not deleted.</p></div>');
            redirect('admin/services/lists/' . $return);
        }
    }  
   public function actions()
    {
        $ids = $this->input->post('id');  
       $sort_orders = $this->input->post('sort_order');
        $loginid = false;  
       if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save' && count($sort_orders) > 0) {
            foreach ($sort_orders as $id => $sort_order):
                $data = array('sort_order' => $sort_order);
                $loginid = $this->services_model->update($data, array(), $id);
            endforeach;
        }
        if (isset($_POST['reset']) && $this->input->post('reset') == 'Reset') {
            $newdata = array(
                'content_key' => '',
                'content_field' => '',
                'content_category_id' => '',
                'order_field' => '',
                'sort_field' => '',
            );
            $this->session->set_userdata($newdata);
            redirect('admin/services/lists/');
        }
        if (isset($_POST['search']) && $this->input->post('search') == 'Search') {
            if ($this->input->post('keyword') != '' || $this->input->post('category') != '' || $this->input->post('sortby') != '') {
                $newdata = array(
                    'content_key' => $this->input->post('keyword'),
                    'content_field' => $this->input->post('field'),
                    'content_category_id' => $this->input->post('category'),
                    'order_field' => $this->input->post('orderby'),
                    'sort_field' => $this->input->post('sortby'),
                );
                $this->session->set_userdata($newdata);
            } else {
                $newdata = array(
                    'content_key' => '',
                    'content_field' => '',
                    'content_category_id' => '',
                    'order_field' => '',
                    'sort_field' => '',
                );
                $this->session->set_userdata($newdata);
            }
            redirect('admin/services/lists/');
        }
        if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}  
       if (isset($_POST['featured']) && $this->input->post('featured') == 'Featured') {$fstatus = 'Y';}  
       if (isset($_POST['unfeatured']) && $this->input->post('unfeatured') == 'UnFeatured') {$fstatus = 'N';}
        if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}
        if (isset($status) && $ids) {
            foreach ($ids as $id):
                $data = array('status' => $status);
                $loginid = $this->services_model->update($data, array(), $id);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Product updated Successfully.</p></div>');
            }
        }  
       if (isset($fstatus) && $ids) {
            foreach ($ids as $id):
                $data = array('featured' => $fstatus);
                $loginid = $this->services_model->update($data, array(), $id);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Product updated Successfully.</p></div>');
            }
        }  
       if (isset($_POST['delete']) && $ids) {
            foreach ($ids as $id):
                $loginid = $this->services_model->delete($id);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content Deleted Successfully.</p></div>');
            }
        }
        if (!$loginid) {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not updated.</p></div>');
        }
        redirect('admin/services/lists/' . $this->input->post('return'));
    }  
   public function code_exists($code)
    {
        $id = $this->input->post('id');
        if ($this->services_model->code_exists($code, $id)) {
            $this->form_validation->set_message('code_exists', 'already exists');
            return false;
        } else {
            return true;
        }
    }  
   public function categories()
    {
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - Content Categories';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/services/categories/');
        $config['total_rows'] = $this->servicecategory_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['contents'] = $this->servicecategory_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));
        $content['categories'] = $this->servicecategory_model->get_idpair();
        $main['content'] = $this->load->view('admin/services/category/lists', $content, true);
        $this->load->view('admin/main', $main);
    }  
   public function addcategory()
    {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url('public/admin/ckeditor/');
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '100%';
        $this->ckeditor->config['height'] = '200px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url('public/admin/ckfinder/'));
        $this->form_validation->set_rules('parent_id', 'parent', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('short_desc', 'Short Desc', '');
        $this->form_validation->set_rules('desc', 'Description', '');
        $this->form_validation->set_rules('keywords', 'Keywords', '');
        $this->form_validation->set_rules('breadcrumb_status', 'Breadcrumb Status', '');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Content Categories';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $add['contentcats'] = $this->servicecategory_model->get_array();
            $main['content'] = $this->load->view('admin/services/category/add', $add, true);
            $this->load->view('admin/main', $main);
        } else {  
           $content_image = '';
            $config['upload_path'] = 'public/uploads/products';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $contentimagedata = $this->upload->data();
                @$content_image = $contentimagedata['file_name'];
            }
            $config['allowed_types'] = 'pdf|doc';  
           $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('pdf')) {
                $contentpdfdata = $this->upload->data();
                @$content_pdf = $contentpdfdata['file_name'];
            }
            $i = 0;
            $slug = $this->servicecategory_model->create_slug($this->input->post('name'));
            $maindata = array('parent_id' => $this->input->post('parent_id'), 'status' => $this->input->post('status'), 'breadcrumb_status' => $this->input->post('breadcrumb_status'), 'slug' => $slug);
            $descdata = array('name' => $this->input->post('name'), 'short_desc' => $this->input->post('short_desc'), 'desc' => $this->input->post('desc'), 'image' => $content_image, 'pdf' => @$content_pdf, 'keywords' => $this->input->post('keywords'));
            $insertid = $this->servicecategory_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Product category added Successfully.</p></div>');
                redirect('admin/services/categories');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Product category not added.</p></div>');
                redirect('admin/services/categories');
            }
        }
    }  
   public function editcategory($id, $return)
    {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url('public/admin/ckeditor/');
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '100%';
        $this->ckeditor->config['height'] = '200px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url('public/admin/ckfinder/'));
        $this->form_validation->set_rules('parent_id', 'parent', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('short_desc', 'Short Desc', '');
        $this->form_validation->set_rules('desc', 'Description', '');
        $this->form_validation->set_rules('keywords', 'Keywords', '');
        $this->form_validation->set_rules('breadcrumb_status', 'Breadcrumb Status', 'required');
        $this->form_validation->set_rules('slug', 'Url Slug', 'required|callback_catcode_exists');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Content Categories';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['return'] = $return;
            $edit['content'] = $this->servicecategory_model->load($id);
            $edit['contentcats'] = $this->servicecategory_model->get_array();
            $main['content'] = $this->load->view('admin/services/category/edit', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            $categoryrow = $this->servicecategory_model->load($id);
            $slug = $this->servicecategory_model->update_slug($this->input->post('slug'), $id);
            $maindata = array('parent_id' => $this->input->post('parent_id'), 'status' => $this->input->post('status'), 'breadcrumb_status' => $this->input->post('breadcrumb_status'), 'slug' => $slug);
            $descdata = array('name' => $this->input->post('name'), 'short_desc' => $this->input->post('short_desc'), 'desc' => $this->input->post('desc'), 'keywords' => $this->input->post('keywords'));  
           $config['upload_path'] = 'public/uploads/products';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);  
           if ($this->upload->do_upload('image')) {
                $contentimagedata = $this->upload->data();
                $descdata['image'] = $contentimagedata['file_name'];
            }
            $config['allowed_types'] = 'pdf|doc';  
           $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('pdf')) {
                $contentpdfdata = $this->upload->data();
                $descdata['pdf'] = $contentpdfdata['file_name'];
            }
            $loginid = $this->servicecategory_model->update($maindata, $descdata, $id);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Product category updated Successfully.</p></div>');
                redirect('admin/services/categories/' . $return);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Product category not updated.</p></div>');
                redirect('admin/services/categories/' . $return);
            }
        }
    }
    public function categorywidgets($id)
    {
        $main['page_title'] = $this->config->item('site_name') . ' - product Widgets';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $cond = array('id' => $id);
        $content['category'] = $this->servicecategory_model->get_row_cond($cond);
        $content['widgets'] = $this->widgets_model->get_idpair();
        $main['content'] = $this->load->view('admin/services/category/widget/lists', $content, true);
        $this->load->view('admin/main', $main);
    }  
   public function categorywidgetactions($categoryid)
    {
        $loginid = false;
        $sort_orders = $this->input->post('sort_order');
        if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save' && count($sort_orders) > 0) {
            foreach ($sort_orders as $id => $val):
                $sort_order[] = $id . ':' . $val;
            endforeach;
            $sort_order = implode(',', $sort_order);
            $data = array('widgets' => $sort_order);
            $loginid = $this->servicecategory_model->update($data, array(), $categoryid);
        }
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Product updated Successfully.</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Product not updated.</p></div>');
        }
        redirect('admin/services/lists/' . $this->input->post('return'));
    }  
   public function deletecategory($id, $return)
    {
        $loginid = $this->servicecategory_model->delete($id);
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Product category deleted Successfully.</p></div>');
            redirect('admin/services/categories/' . $return);
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Product category not deleted.</p></div>');
            redirect('admin/services/categories/' . $return);
        }
    }  
   public function categoryactions()
    {
        $ids = $this->input->post('id');
        $loginid = false;
        if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}
        if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}  
       if (isset($_POST['featured']) && $this->input->post('featured') == 'Featured') {$fstatus = 'Y';}  
       if (isset($_POST['unfeatured']) && $this->input->post('unfeatured') == 'UnFeatured') {$fstatus = 'N';}
        if (isset($status) && $ids) {
            foreach ($ids as $id):
                $data = array('status' => $status);
                $loginid = $this->servicecategory_model->update($data, array(), $id);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Product category updated Successfully.</p></div>');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Product category not updated.</p></div>');
            }
        }  
       if (isset($fstatus) && $ids) {
            foreach ($ids as $id):
                $data = array('featured' => $fstatus);
                $loginid = $this->servicecategory_model->update($data, array(), $id);
            endforeach;  
           if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Product updated Successfully.</p></div>');
            }
        }  
       if (isset($_POST['delete']) && $ids) {
            foreach ($ids as $id):
                $loginid = $this->servicecategory_model->delete($id);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Product category Deleted Successfully.</p></div>');
            }
        }
        redirect('admin/services/categories/' . $this->input->post('return'));
    }  
   public function catcode_exists($code)
    {
        $id = $this->input->post('id');
        if ($this->servicecategory_model->code_exists($code, $id)) {
            $this->form_validation->set_message('catcode_exists', 'already exists');
            return false;
        } else {
            return true;
        }
    }

}
/* End of file products.php */
/* Location: ./application/controllers/admin/products.php */
