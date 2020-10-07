<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
} 
class Pages extends Web_Controller
{  
   public function __construct()
    {  
       // Call the Model constructor  
       parent::__construct();  
       if (!$this->session->userdata('admin_logged_in')) {  
           redirect('admin/login');  
       }  
       $this->load->model('pages_model');  
   }  
   public function index()
    {  
       redirect('admin/pages/lists');  
   }  
   public function lists()
    {  
       $this->load->library('pagination');  
       $main['page_title'] = $this->config->item('site_name') . ' - Page Meta';  
       $main['header'] = $this->adminheader();  
       $main['footer'] = $this->adminfooter();  
       $main['left'] = $this->adminleftmenu();  
       $config['base_url'] = site_url('admin/pages/lists/');  
       $config['total_rows'] = $this->pages_model->get_pagination_count();  
       $config['per_page'] = '10';  
       $config['uri_segment'] = 4;  
       $config['first_link'] = 'First';  
       $config['last_link'] = 'Last';  
       $config['cur_tag_open'] = '<span>';  
       $config['cur_tag_close'] = '</span>';  
       $this->pagination->initialize($config);  
       $content['pages'] = $this->pages_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));  
       $main['content'] = $this->load->view('admin/pages/lists', $content, true);  
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
       $this->form_validation->set_rules('key', 'Key', 'required');  
       $this->form_validation->set_rules('meta_title', 'title', '');  
       $this->form_validation->set_rules('short_desc', 'Short Description', '');  
       $this->form_validation->set_rules('keywords', 'Keywords', '');  
       $this->form_validation->set_rules('desc', 'Description', '');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Page Meta';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $main['content'] = $this->load->view('admin/pages/add', null, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $banner_image = '';  
           $config['upload_path'] = 'public/uploads/pages';  
           $config['allowed_types'] = 'gif|jpg|png';  
           $this->load->library('upload', $config);  
           if ($this->upload->do_upload('banner_image')) {  
               $banner_imagedata = $this->upload->data();  
               $banner_image = $banner_imagedata['file_name'];  
           }  
           $i = 0;  
           $maindata = array('status' => $this->input->post('status'), 'key' => $this->input->post('key'));  
           $descdata = array('title' => $this->input->post('title'), 'meta_title' => $this->input->post('meta_title'), 'short_desc' => $this->input->post('short_desc'), 'keywords' => $this->input->post('keywords'), 'desc' => $this->input->post('desc'), 'banner_text' => $this->input->post('banner_text'), 'banner_image' => $banner_image);  
           $insertid = $this->pages_model->insert($maindata, $descdata);  
           if ($insertid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content added Successfully.</p></div>');  
               redirect('admin/pages/lists');  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not added.</p></div>');  
               redirect('admin/pages/lists');  
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
       $this->form_validation->set_rules('meta_title', 'Title', '');  
       $this->form_validation->set_rules('key', 'Key', 'required');  
       $this->form_validation->set_rules('short_desc', 'Short Description', '');  
       $this->form_validation->set_rules('keywords', 'Keywords', '');  
       $this->form_validation->set_rules('desc', 'Description', '');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Page Meta';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $edit['return'] = $return;  
           $edit['page'] = $this->pages_model->load($id);  
           $main['content'] = $this->load->view('admin/pages/edit', $edit, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $pagerow = $this->pages_model->load($id);  
           $maindata = array('status' => $this->input->post('status'), 'key' => $this->input->post('key'));  
           $descdata = array('title' => $this->input->post('title'), 'meta_title' => $this->input->post('meta_title'), 'short_desc' => $this->input->post('short_desc'), 'keywords' => $this->input->post('keywords'), 'desc' => $this->input->post('desc'), 'banner_text' => $this->input->post('banner_text'));  
           $config['upload_path'] = 'public/uploads/pages';  
           $config['allowed_types'] = 'gif|jpg|png';  
           $this->load->library('upload', $config);  
           if ($this->upload->do_upload('banner_image')) {  
               $banner_imagedata = $this->upload->data();  
               $descdata['banner_image'] = $banner_imagedata['file_name'];  
           }  
           $loginid = $this->pages_model->update($maindata, $descdata, $id);  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content updated Successfully.</p></div>');  
               redirect('admin/pages/lists/' . $return);  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not updated.</p></div>');  
               redirect('admin/pages/lists/' . $return);  
           }  
       }  
   }  
   public function delete($id, $return)
    {  
       $loginid = $this->pages_model->delete($id);  
       if ($loginid) {  
           $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Content deleted Successfully.</p></div>');  
           redirect('admin/pages/lists/' . $return);  
       } else {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Content not deleted.</p></div>');  
           redirect('admin/pages/lists/' . $return);  
       }  
   }  
   public function actions()
    {  
       $loginid = false;  
       $ids = $this->input->post('id');  
       if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}  
       if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}  
       if ($ids && isset($status)) {  
           foreach ($ids as $id):  
               $data = array('status' => $status);  
               $loginid = $this->pages_model->update($data, array(), $id);  
           endforeach;  
       }  
       if ($loginid) {  
           $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Page Meta updated Successfully.</p></div>');  
       } else {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Page Meta not updated.</p></div>');  
       }  
       if (isset($_POST['delete']) && $ids) {  
           foreach ($ids as $id):  
               $loginid = $this->pages_model->delete($id);  
           endforeach;  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Page Meta Deleted Successfully.</p></div>');  
           }  
       }  
       redirect('admin/pages/lists/' . $this->input->post('return'));  
   }

}

/* End of file pages.php */

/* Location: ./application/controllers/admin/pages.php */
