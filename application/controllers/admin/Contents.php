<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Contents extends Web_Controller
{  
   public function __construct()
    {  
       // Call the Model constructor  
       parent::__construct();  
       if (!$this->session->userdata('admin_logged_in')) {  
           redirect('admin/login');  
       }  
       $this->load->model('contentcategory_model');  
       $this->load->model('contents_model');  
       $this->load->model('widgets_model');  
   }  
   public function index()
    {  
       redirect('admin/contents/lists');  
   }  
   public function lists()
    {  
       $this->load->library('pagination');  
       $main['page_title'] = $this->config->item('site_name') . ' - Contents';  
       $main['header'] = $this->adminheader();  
       $main['footer'] = $this->adminfooter();  
       $main['left'] = $this->adminleftmenu();  
       $config['base_url'] = site_url('admin/contents/lists/');  
       $config['total_rows'] = $this->contents_model->get_pagination_count();  
       $config['per_page'] = '50';  
       $config['uri_segment'] = 4;  
       $config['first_link'] = 'First';  
       $config['last_link'] = 'Last';  
       $config['cur_tag_open'] = '<span>';  
       $config['cur_tag_close'] = '</span>';  
       $this->pagination->initialize($config);  
       $content['contentfields'] = $this->contents_model->get_fields();  
       $content['sortorders'] = array('asc' => 'Ascending', 'desc' => 'Descending');  
       $content['contentcats'] = $this->contentcategory_model->get_array();  
       $content['contents'] = $this->contents_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));  
       $content['categories'] = $this->contentcategory_model->get_idpair();  
       $main['content'] = $this->load->view('admin/contents/content/lists', $content, true);  
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
       $this->form_validation->set_rules('short_desc', 'Short Description', 'required');  
       $this->form_validation->set_rules('keywords', 'Keywords', '');  
       $this->form_validation->set_rules('desc', 'Description', '');  
       $this->form_validation->set_rules('meta_desc', 'Meta Description', '');  
       $this->form_validation->set_rules('category_id', 'Category', 'required');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Contents';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $add['contentcats'] = $this->contentcategory_model->get_array();  
           $add['widgets'] = $this->widgets_model->get_rightwidgets();  
           $main['content'] = $this->load->view('admin/contents/content/add', $add, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $banner_image = '';  
           $content_image = '';  
           $content_image2 = '';  
           $pdf = '';  
           $config['upload_path'] = 'public/uploads/contents';  
           $config['allowed_types'] = 'gif|jpg|png';  
           $this->load->library('upload', $config);  
           $this->upload->initialize($config);  
           if ($this->upload->do_upload('banner_image')) {  
               $banner_imagedata = $this->upload->data();  
               $banner_image = $banner_imagedata['file_name'];  
           }  
           if ($this->upload->do_upload('image')) {  
               $contentimagedata = $this->upload->data();  
               $content_image = $contentimagedata['file_name'];  
           }  
           if ($this->upload->do_upload('image2')) {  
               $contentimagedata2 = $this->upload->data();  
               $content_image2 = $contentimagedata2['file_name'];  
           }  
           $config['upload_path'] = 'public/uploads/pdf';  
           $config['allowed_types'] = 'pdf';  
           $this->load->library('upload', $config);  
           $this->upload->initialize($config);  
           if ($this->upload->do_upload('pdf')) {  
               $banner_pdfdata = $this->upload->data();  
               $pdf = $banner_pdfdata['file_name'];  
           }  
           $i = 0;  
           $widgets = array();  
           if ($this->input->post('widgets')) {
                foreach ($this->input->post('widgets') as $widgetrow): $i++;  
                   $widgets[] = $widgetrow . ':' . $i;  
               endforeach;  
               $widgets = implode(',', $widgets);  
               $slug = $this->contents_model->create_slug($this->input->post('title'));  
               $date_time = date("Y-m-d H:i:s");  
               if ($this->input->post('date_time') != '') {  
                   $date_time = date("Y-m-d H:i:s", strtotime($this->input->post('date_time')));  
               }
            }  
           $maindata = array('status' => $this->input->post('status'), 'category_id' => $this->input->post('category_id'), 'slug' => $slug, 'widgets' => $widgets);  
           $descdata = array('title' => $this->input->post('title'), 'meta_title' => $this->input->post('meta_title'), 'short_desc' => $this->input->post('short_desc'), 'meta_desc' => $this->input->post('meta_desc'), 'keywords' => $this->input->post('keywords'), 'desc' => $this->input->post('desc'), 'banner_text' => $this->input->post('banner_text'), 'banner_image' => $banner_image, 'image' => $content_image, 'image2' => $content_image2, 'pdf' => $pdf, 'date_time' => $date_time);  
           $insertid = $this->contents_model->insert($maindata, $descdata);  
           if ($insertid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content added Successfully.</p></div>');  
               redirect('admin/contents/lists');  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not added.</p></div>');  
               redirect('admin/contents/lists');  
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
       $this->form_validation->set_rules('slug', 'Url Slug', 'required|callback_code_exists');  
       $this->form_validation->set_rules('short_desc', 'Short Description', 'required');  
       $this->form_validation->set_rules('keywords', 'Keywords', '');  
       $this->form_validation->set_rules('desc', 'Description', '');  
       $this->form_validation->set_rules('meta_desc', 'Meta Description', '');  
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
           $edit['contentcats'] = $this->contentcategory_model->get_array();  
           $edit['content'] = $this->contents_model->load($id);  
           $edit['widgets'] = $this->widgets_model->get_rightwidgets();  
           $main['content'] = $this->load->view('admin/contents/content/edit', $edit, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $new_widgets = $this->input->post('widgets');  
           $contentrow = $this->contents_model->load($id);  
           $widgets = '';//$this->get_editwidgets($contentrow, $new_widgets);  
           $slug = $this->contents_model->update_slug($this->input->post('slug'), $id);  
           $date_time = date("Y-m-d H:i:s");  
           if ($this->input->post('date_time') != '') {  
               $date_time = date("Y-m-d H:i:s", strtotime($this->input->post('date_time')));  
           }  
           $maindata = array('status' => $this->input->post('status'), 'category_id' => $this->input->post('category_id'), 'slug' => $slug, 'widgets' => $widgets);  
           $descdata = array('title' => $this->input->post('title'), 'meta_title' => $this->input->post('meta_title'), 'short_desc' => $this->input->post('short_desc'), 'meta_desc' => $this->input->post('meta_desc'), 'keywords' => $this->input->post('keywords'), 'desc' => $this->input->post('desc'), 'banner_text' => $this->input->post('banner_text'), 'date_time' => $date_time);  
           $config['upload_path'] = 'public/uploads/contents';  
           $config['allowed_types'] = 'gif|jpg|png';  
           $this->load->library('upload', $config);  
           $this->upload->initialize($config);  
           if ($this->upload->do_upload('banner_image')) {  
               $banner_imagedata = $this->upload->data();  
               $descdata['banner_image'] = $banner_imagedata['file_name'];  
           }  
           if ($this->upload->do_upload('image')) {  
               $contentimagedata = $this->upload->data();  
               $descdata['image'] = $contentimagedata['file_name'];  
           }  
           if ($this->upload->do_upload('image2')) {  
               $contentimagedata2 = $this->upload->data();  
               $descdata['image2'] = $contentimagedata2['file_name'];  
           }  
           $config['upload_path'] = 'public/uploads/pdf';  
           $config['allowed_types'] = 'pdf';  
           $this->load->library('upload', $config);  
           $this->upload->initialize($config);  
           if ($this->upload->do_upload('pdf')) {  
               $banner_pdfdata = $this->upload->data();  
               $descdata['pdf'] = $banner_pdfdata['file_name'];  
           }  
           $loginid = $this->contents_model->update($maindata, $descdata, $id);  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content updated Successfully.</p></div>');  
               redirect('admin/contents/lists/' . $return);  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not updated.</p></div>');  
               redirect('admin/contents/lists/' . $return);  
           }  
       }  
   }  
    
        
    public function delete($id, $return)
    {  
       $loginid = $this->contents_model->delete($id);  
       if ($loginid) {  
           $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content deleted Successfully.</p></div>');  
           redirect('admin/contents/lists/' . $return);  
       } else {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not deleted.</p></div>');  
           redirect('admin/contents/lists/' . $return);  
       }  
   }  
   public function actions()
    {  
       $ids = $this->input->post('id');  
       $sort_orders = $this->input->post('sort_order');  
       $loginid = false;  
       if (isset($_POST['reset']) && $this->input->post('reset') == 'Reset') {  
           $newdata = array(  
               'content_key' => '',  
               'content_field' => '',  
               'content_category_id' => '',  
               'order_field' => '',  
               'sort_field' => '',  
           );  
           $this->session->set_userdata($newdata);  
           redirect('admin/contents/lists/');  
       }  
       if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save' && count($sort_orders) > 0) {  
           foreach ($sort_orders as $id => $sort_order):  
               $data = array('sort_order' => $sort_order);  
               $loginid = $this->contents_model->update($data, array(), $id);  
           endforeach;  
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
           redirect('admin/contents/lists/');  
       }  
       if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}  
       if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}  
       if (isset($status) && $ids) {  
           foreach ($ids as $id):  
               $data = array('status' => $status);  
               $loginid = $this->contents_model->update($data, array(), $id);  
           endforeach;  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content updated Successfully.</p></div>');  
           }  
       }  
       if (isset($_POST['delete']) && $ids) {  
           foreach ($ids as $id):  
               $loginid = $this->contents_model->delete($id);  
           endforeach;  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content Deleted Successfully.</p></div>');  
           }  
       }  
       if (!$loginid) {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not updated.</p></div>');  
       }  
       redirect('admin/contents/lists/' . $this->input->post('return'));  
   }  
   public function code_exists($code)
    {  
       $id = $this->input->post('id');  
       if ($this->contents_model->code_exists($code, $id)) {  
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
       $config['base_url'] = site_url('admin/contents/categories/');  
       $config['total_rows'] = $this->contentcategory_model->get_pagination_count();  
       $config['per_page'] = '10';  
       $config['uri_segment'] = 4;  
       $config['first_link'] = 'First';  
       $config['last_link'] = 'Last';  
       $config['cur_tag_open'] = '<span>';  
       $config['cur_tag_close'] = '</span>';  
       $this->pagination->initialize($config);  
       $content['contents'] = $this->contentcategory_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));  
       $content['categories'] = $this->contentcategory_model->get_idpair();  
       $main['content'] = $this->load->view('admin/contents/category/lists', $content, true);  
       $this->load->view('admin/main', $main);  
   }  
   public function addcategory()
    {  
       $this->form_validation->set_rules('parent_id', 'parent', 'required');  
       $this->form_validation->set_rules('name', 'Name', 'required');  
       $this->form_validation->set_rules('short_desc', 'Short Desc', '');  
       $this->form_validation->set_rules('keywords', 'Keywords', '');  
       $this->form_validation->set_rules('breadcrumb_status', 'Breadcrumb Status', 'required');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Content Categories';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $add['widgets'] = $this->widgets_model->get_rightwidgets();  
           $add['contentcats'] = $this->contentcategory_model->get_array();  
           $main['content'] = $this->load->view('admin/contents/category/add', $add, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $i = 0;  
           $widgets = array();  
           if ($this->input->post('widgets')) {
                foreach ($this->input->post('widgets') as $widgetrow): $i++;  
                   $widgets[] = $widgetrow . ':' . $i;  
               endforeach;  
               $widgets = implode(',', $widgets);  
               $config['upload_path'] = 'public/uploads/contents';  
               $config['allowed_types'] = 'gif|jpg|png';  
               $this->load->library('upload', $config);  
               $this->upload->initialize($config);  
               $slug = $this->contentcategory_model->create_slug($this->input->post('name'));  
               $maindata = array('parent_id' => $this->input->post('parent_id'), 'status' => $this->input->post('status'), 'breadcrumb_status' => $this->input->post('breadcrumb_status'), 'slug' => $slug, 'widgets' => $widgets);  
               $descdata = array('name' => $this->input->post('name'), 'short_desc' => $this->input->post('short_desc'), 'keywords' => $this->input->post('keywords'));  
               if ($this->upload->do_upload('image')) {  
                   $contentimagedata = $this->upload->data();  
                   $descdata['image'] = $contentimagedata['file_name'];  
               }
            }  
           $insertid = $this->contentcategory_model->insert($maindata, $descdata);  
           if ($insertid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content category added Successfully.</p></div>');  
               redirect('admin/contents/categories');  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content category not added.</p></div>');  
               redirect('admin/contents/categories');  
           }  
       }  
   }  
   public function editcategory($id, $return)
    {  
       $this->form_validation->set_rules('parent_id', 'parent', 'required');  
       $this->form_validation->set_rules('name', 'Name', 'required');  
       $this->form_validation->set_rules('short_desc', 'Short Desc', '');  
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
           $edit['content'] = $this->contentcategory_model->load($id);  
           $edit['widgets'] = $this->widgets_model->get_rightwidgets();  
           $edit['contentcats'] = $this->contentcategory_model->get_array();  
           $main['content'] = $this->load->view('admin/contents/category/edit', $edit, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $new_widgets = $this->input->post('widgets');  
           $categoryrow = $this->contentcategory_model->load($id);  
           $widgets ='';// $this->get_editwidgets($categoryrow, $new_widgets);  
           $slug = $this->contentcategory_model->update_slug($this->input->post('slug'), $id);  
           $maindata = array('parent_id' => $this->input->post('parent_id'), 'status' => $this->input->post('status'), 'breadcrumb_status' => $this->input->post('breadcrumb_status'), 'slug' => $slug, 'widgets' => $widgets);  
           $descdata = array('name' => $this->input->post('name'), 'short_desc' => $this->input->post('short_desc'), 'keywords' => $this->input->post('keywords'));  
           $config['upload_path'] = 'public/uploads/contents';  
           $config['allowed_types'] = 'gif|jpg|png';  
           $this->load->library('upload', $config);  
           $this->upload->initialize($config);  
           if ($this->upload->do_upload('image')) {  
               $contentimagedata = $this->upload->data();  
               $descdata['image'] = $contentimagedata['file_name'];  
           }  
           $loginid = $this->contentcategory_model->update($maindata, $descdata, $id);  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content category updated Successfully.</p></div>');  
               redirect('admin/contents/categories/' . $return);  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content category not updated.</p></div>');  
               redirect('admin/contents/categories/' . $return);  
           }  
       }  
   }
 
    public function deletecategory($id, $return)
    {  
       $loginid = $this->contentcategory_model->delete($id);  
       if ($loginid) {  
           $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content category deleted Successfully.</p></div>');  
           redirect('admin/contents/categories/' . $return);  
       } else {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content category not deleted.</p></div>');  
           redirect('admin/contents/categories/' . $return);  
       }  
   }  
   public function categoryactions()
    {  
       $ids = $this->input->post('id');  
       $loginid = false;  
       if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}  
       if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}  
       if (isset($status) && $ids) {  
           foreach ($ids as $id):  
               $data = array('status' => $status);  
               $loginid = $this->contentcategory_model->update($data, array(), $id);  
           endforeach;  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content category updated Successfully.</p></div>');  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content category not updated.</p></div>');  
           }  
       }  
       if (isset($_POST['delete']) && $ids) {  
           foreach ($ids as $id):  
               $loginid = $this->contentcategory_model->delete($id);  
           endforeach;  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content category Deleted Successfully.</p></div>');  
           }  
       }  
       redirect('admin/contents/categories/' . $this->input->post('return'));  
   }  
   public function catcode_exists($code)
    {  
       $id = $this->input->post('id');  
       if ($this->contentcategory_model->code_exists($code, $id)) {  
           $this->form_validation->set_message('catcode_exists', 'already exists');  
           return false;  
       } else {  
           return true;  
       }  
   }

}
/* End of file contents.php */
/* Location: ./application/controllers/admin/contents.php */