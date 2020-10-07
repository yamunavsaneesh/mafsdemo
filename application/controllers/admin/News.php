<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class News extends Web_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $this->load->model(array('newscategory_model', 'news_model'));
    }  
   public function index()
    {
        redirect('admin/news/lists');
    }  
   public function lists()
    {
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - News';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/news/lists/');
        $config['total_rows'] = $this->news_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['contentfields'] = $this->news_model->get_fields();
        $content['sortorders'] = array('asc' => 'Ascending', 'desc' => 'Descending');
        $content['contentcats'] = $this->newscategory_model->get_array();
        $content['contents'] = $this->news_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));
        $main['content'] = $this->load->view('admin/news/content/lists', $content, true);
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
        $this->form_validation->set_rules('location', 'location', '');
        $this->form_validation->set_rules('keywords', 'Keywords', '');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('meta_desc', 'Meta Description', '');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('sectors_id', 'sector', '');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Contents';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $add['contentcats'] = $this->newscategory_model->get_array();
            $main['content'] = $this->load->view('admin/news/content/add', $add, true);
            $this->load->view('admin/main', $main);
        } else {  
           $banner_image = '';
            $content_image = '';
            $config['upload_path'] = 'public/uploads/contents';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('banner_image')) {
                $banner_imagedata = $this->upload->data();
                $banner_image = $banner_imagedata['file_name'];
            }
            if ($this->upload->do_upload('image')) {
                $contentimagedata = $this->upload->data();
                $content_image = $contentimagedata['file_name'];
            }
            $slug = $this->news_model->create_slug($this->input->post('title'));
            if ($this->input->post('date_time') != '') {  
               $date_time = date("Y-m-d", strtotime($this->input->post('date_time'))) . ' ' . date("H:i:s", strtotime($this->input->post('date_time')));  
           } else {
                $date_time = date("Y-m-d H:i:s");
            }
            $maindata = array('status' => $this->input->post('status'), 'sectors_id' => $this->input->post('sectors_id'), 'category_id' => $this->input->post('category_id'), 'slug' => $slug);
            $descdata = array('title' => $this->input->post('title'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_desc' => $this->input->post('meta_desc'),
                'keywords' => $this->input->post('keywords'),
                'location' => $this->input->post('location'),
                'short_desc' => $this->input->post('short_desc'),
                'desc' => $this->input->post('desc'), 'image' => $content_image, 'banner_image' => $banner_image, 'date_time' => $date_time);
            $insertid = $this->news_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>News added Successfully.</p></div>');
                redirect('admin/news/lists');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - News not added.</p></div>');
                redirect('admin/news/lists');
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
        $this->form_validation->set_rules('short_desc', 'Short Description', '');
        $this->form_validation->set_rules('location', 'location', '');
        $this->form_validation->set_rules('keywords', 'Keywords', '');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('meta_desc', 'Meta Description', '');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('sectors_id', 'sector', '');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - News';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['return'] = $return;
            $edit['contentcats'] = $this->newscategory_model->get_array();
            $edit['content'] = $this->news_model->load($id);
            //$edit['sectors'] = $this->sectorscategory_model->get_array();
            $main['content'] = $this->load->view('admin/news/content/edit', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            $contentrow = $this->news_model->load($id);
            if ($contentrow->title != $this->input->post('title')) {
                $slug = $this->news_model->update_slug($this->input->post('title'), $id);
            } else {
                $slug = $this->news_model->update_slug($this->input->post('slug'), $id);
            }
            $date_time = date("Y-m-d H:i:s");
            if ($this->input->post('date_time') != '') {
                /*$date1=$this->input->post('date_time');
                $date=explode(" ",$date1);
                $newdate=date("Y-m-d", strtotime($date[0]));
                $date_time=$newdate." ".$date[1]; */
                $date_time = date("Y-m-d H:i:s", strtotime($this->input->post('date_time')));
            }
            $maindata = array('status' => $this->input->post('status'), 'sectors_id' => $this->input->post('sectors_id'), 'category_id' => $this->input->post('category_id'), 'category_id' => $this->input->post('category_id'), 'slug' => $slug);
            $descdata = array('title' => $this->input->post('title'),
                'meta_title' => $this->input->post('meta_title'),
                'short_desc' => $this->input->post('short_desc'),
                'meta_desc' => $this->input->post('meta_desc'),
                'keywords' => $this->input->post('keywords'), 'location' => $this->input->post('location'), 'desc' => $this->input->post('desc'), 'date_time' => $date_time);
            $config['upload_path'] = 'public/uploads/contents';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('banner_image')) {
                $banner_imagedata = $this->upload->data();
                $descdata['banner_image'] = $banner_imagedata['file_name'];
            }
            if ($this->upload->do_upload('image')) {
                $contentimagedata = $this->upload->data();
                $descdata['image'] = $contentimagedata['file_name'];
            }
            $loginid = $this->news_model->update($maindata, $descdata, $id);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>News updated Successfully.</p></div>');
                redirect('admin/news/lists/' . $return);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - News not updated.</p></div>');
                redirect('admin/news/lists/' . $return);
            }
        }
    }
    public function delete($id, $return)
    {
        $loginid = $this->news_model->delete($id);
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>News deleted Successfully.</p></div>');
            redirect('admin/news/lists/' . $return);
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not deleted.</p></div>');
            redirect('admin/news/lists/' . $return);
        }
    }  
   public function actions()
    {
        $ids = $this->input->post('id');
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
            redirect('admin/news/lists/');
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
            redirect('admin/news/lists/');
        }
        if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}
        if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}
        if (isset($status) && $ids) {
            foreach ($ids as $id):
                $data = array('status' => $status);
                $loginid = $this->news_model->update($data, array(), $id);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content updated Successfully.</p></div>');
            }
        }
        if (isset($_POST['delete']) && $ids) {
            foreach ($ids as $id):
                $loginid = $this->news_model->delete($id);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content Deleted Successfully.</p></div>');
            }
        }
        if (!$loginid) {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not updated.</p></div>');
        }
        redirect('admin/news/lists/' . $this->input->post('return'));
    }  
   public function code_exists($code)
    {
        $id = $this->input->post('id');
        if ($this->news_model->code_exists($code, $id)) {
            $this->form_validation->set_message('code_exists', 'already exists');
            return false;
        } else {
            return true;
        }
    }  
   public function categories()
    {
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - News Categories';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/news/categories/');
        $config['total_rows'] = $this->newscategory_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['contents'] = $this->newscategory_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));
        $main['content'] = $this->load->view('admin/news/category/lists', $content, true);
        $this->load->view('admin/main', $main);
    }  
   public function addcategory()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        //$this->form_validation->set_rules('short_desc', 'Short Desc', '');
        //$this->form_validation->set_rules('keywords', 'Keywords', '');
        //$this->form_validation->set_rules('breadcrumb_status', 'Breadcrumb Status', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        //$this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - News Categories';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $main['content'] = $this->load->view('admin/news/category/add', '', true);
            $this->load->view('admin/main', $main);
        } else {
            $slug = $this->newscategory_model->create_slug($this->input->post('name'));
            $maindata = array('status' => $this->input->post('status'), 'breadcrumb_status' => $this->input->post('breadcrumb_status'), 'slug' => $slug);
            $descdata = array('name' => $this->input->post('name'), 'short_desc' => $this->input->post('short_desc'), 'keywords' => $this->input->post('keywords'));
            $config['upload_path'] = 'public/uploads/contents';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('icon')) {
                $contentimagedata = $this->upload->data();
                $maindata['icon'] = $contentimagedata['file_name'];
            }
            $insertid = $this->newscategory_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>News category added Successfully.</p></div>');
                redirect('admin/news/categories');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - News category not added.</p></div>');
                redirect('admin/news/categories');
            }
        }
    }  
   public function editcategory($id, $return)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        //$this->form_validation->set_rules('short_desc', 'Short Desc', '');
        //$this->form_validation->set_rules('keywords', 'Keywords', '');
        //$this->form_validation->set_rules('breadcrumb_status', 'Breadcrumb Status', 'required');
        //$this->form_validation->set_rules('slug', 'Url Slug', 'required|callback_catcode_exists');
        $this->form_validation->set_rules('status', 'Status', 'required');
        //$this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Content Categories';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['return'] = $return;
            $edit['content'] = $this->newscategory_model->load($id);
            $main['content'] = $this->load->view('admin/news/category/edit', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            $slug = $this->newscategory_model->update_slug($this->input->post('name'), $id);
            $maindata = array('status' => $this->input->post('status'), 'breadcrumb_status' => $this->input->post('breadcrumb_status'), 'slug' => $slug);
            $descdata = array('name' => $this->input->post('name'), 'short_desc' => $this->input->post('short_desc'), 'keywords' => $this->input->post('keywords'));
            $config['upload_path'] = 'public/uploads/contents';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('icon')) {
                $contentimagedata = $this->upload->data();
                $maindata['icon'] = $contentimagedata['file_name'];
            }
            $loginid = $this->newscategory_model->update($maindata, $descdata, $id);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content category updated Successfully.</p></div>');
                redirect('admin/news/categories/' . $return);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content category not updated.</p></div>');
                redirect('admin/news/categories/' . $return);
            }
        }
    }
    public function catcode_exists($code)
    {
        $id = $this->input->post('id');
        if ($this->news_model->code_exists($code, $id)) {
            $this->form_validation->set_message('catcode_exists', 'already exists');
            return false;
        } else {
            return true;
        }
    }

}
/* End of file contents.php */
/* Location: ./application/controllers/admin/contents.php */
