<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Contacts extends Web_Controller
{  
   public function __construct()
    {  
       // Call the Model constructor  
       parent::__construct();  
       if (!$this->session->userdata('admin_logged_in')) {  
           redirect('admin/login');  
       }  
       $this->load->model('contactcategory_model');  
       $this->load->model('contacts_model');  
   }  
   public function index()
    {  
       redirect('admin/contacts/lists');  
   }  
   public function lists()
    {  
       $this->load->library('pagination');  
       $main['page_title'] = $this->config->item('site_name') . ' - Contacts';  
       $main['header'] = $this->adminheader();  
       $main['footer'] = $this->adminfooter();  
       $main['left'] = $this->adminleftmenu();  
       $config['base_url'] = site_url('admin/contacts/lists/');  
       $config['total_rows'] = $this->contacts_model->get_pagination_count();  
       $config['per_page'] = '25';  
       $config['uri_segment'] = 4;  
       $config['first_link'] = 'First';  
       $config['last_link'] = 'Last';  
       $config['cur_tag_open'] = '<span>';  
       $config['cur_tag_close'] = '</span>';  
       $this->pagination->initialize($config);  
       $content['contactfields'] = $this->contacts_model->get_fields();  
       $content['sortorders'] = array('asc' => 'Ascending', 'desc' => 'Descending');  
       $content['contactcats'] = $this->contactcategory_model->get_array();  
       $content['contacts'] = $this->contacts_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));  
       $main['content'] = $this->load->view('admin/contacts/contact/lists', $content, true);  
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
       $this->form_validation->set_rules('address', 'Address', 'required');  
       $this->form_validation->set_rules('location', 'Location', 'required');  
       $this->form_validation->set_rules('latitude', 'Latitude', 'required');  
       $this->form_validation->set_rules('longitude', 'Longitude', 'required');  
       $this->form_validation->set_rules('category_id', 'Category', 'required');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_rules('style', 'style', '');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Contacts';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $add['contactcats'] = $this->contactcategory_model->get_array();  
           $main['content'] = $this->load->view('admin/contacts/contact/add', $add, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $content_image = '';  
           $config['upload_path'] = 'public/uploads/contents';  
           $config['allowed_types'] = 'pdf';  
           $this->load->library('upload', $config);  
           if ($this->upload->do_upload('image')) {  
               $contentimagedata = $this->upload->data();  
               $content_image = $contentimagedata['file_name'];  
           }  
           $maindata = array('status' => $this->input->post('status'), 'latitude' => $this->input->post('latitude'), 'longitude' => $this->input->post('longitude'), 'category_id' => $this->input->post('category_id'));  
           $descdata = array('location' => $this->input->post('location'), 'address' => $this->input->post('address'), 'image' => $content_image, 'style' => $this->input->post('style'));  
           $insertid = $this->contacts_model->insert($maindata, $descdata);  
           if ($insertid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Contact added Successfully.</p></div>');  
               redirect('admin/contacts/lists');  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Contact not added.</p></div>');  
               redirect('admin/contacts/lists');  
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
       $this->form_validation->set_rules('address', 'Address', 'required');  
       $this->form_validation->set_rules('location', 'Location', 'required');  
       $this->form_validation->set_rules('latitude', 'Latitude', 'required');  
       $this->form_validation->set_rules('longitude', 'Longitude', 'required');  
       $this->form_validation->set_rules('category_id', 'Category', 'required');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_rules('style', 'style', '');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Contacts';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $edit['return'] = $return;  
           $edit['contactcats'] = $this->contactcategory_model->get_array();  
           $edit['contact'] = $this->contacts_model->load($id);  
           $main['content'] = $this->load->view('admin/contacts/contact/edit', $edit, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $maindata = array('status' => $this->input->post('status'), 'latitude' => $this->input->post('latitude'), 'longitude' => $this->input->post('longitude'), 'category_id' => $this->input->post('category_id'));  
           $descdata = array('location' => $this->input->post('location'), 'address' => $this->input->post('address'), 'style' => $this->input->post('style'));  
           $config['upload_path'] = 'public/uploads/contents';  
           $config['allowed_types'] = 'pdf';  
           $this->load->library('upload', $config);  
           if ($this->upload->do_upload('image')) {  
               $contentimagedata = $this->upload->data();  
               $descdata['image'] = $contentimagedata['file_name'];  
           }  
           $loginid = $this->contacts_model->update($maindata, $descdata, $id);  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Contact updated Successfully.</p></div>');  
               redirect('admin/contacts/lists/' . $return);  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Contact not updated.</p></div>');  
               redirect('admin/contacts/lists/' . $return);  
           }  
       }  
   }  
   public function delete($id, $return)
    {  
       $loginid = $this->contacts_model->delete($id);  
       if ($loginid) {  
           $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Contact deleted Successfully.</p></div>');  
           redirect('admin/contacts/lists/' . $return);  
       } else {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Contact not deleted.</p></div>');  
           redirect('admin/contacts/lists/' . $return);  
       }  
   }  
   public function actions()
    {  
       $ids = $this->input->post('id');  
       $loginid = false;  
       if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}  
       if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}  
       if (isset($_POST['reset']) && $this->input->post('reset') == 'Reset') {  
           $newdata = array(  
               'contact_key' => '',  
               'contact_field' => '',  
               'contact_category_id' => '',  
               'order_field' => '',  
               'sort_field' => '',  
           );  
           $this->session->set_userdata($newdata);  
           redirect('admin/contacts/lists/');  
       }  
       if (isset($_POST['search']) && $this->input->post('search') == 'Search') {  
           if ($this->input->post('keyword') != '' || $this->input->post('category') != '' || $this->input->post('sortby') != '') {  
               $newdata = array(  
                   'contact_key' => $this->input->post('keyword'),  
                   'contact_field' => $this->input->post('field'),  
                   'contact_category_id' => $this->input->post('category'),  
                   'order_field' => $this->input->post('orderby'),  
                   'sort_field' => $this->input->post('sortby'),  
               );  
               $this->session->set_userdata($newdata);  
           } else {  
               $newdata = array(  
                   'contact_key' => '',  
                   'contact_field' => '',  
                   'contact_category_id' => '',  
                   'order_field' => '',  
                   'sort_field' => '',  
               );  
               $this->session->set_userdata($newdata);  
           }  
           redirect('admin/contacts/lists/');  
       }  
       if (isset($status) && $ids) {  
           foreach ($ids as $id):  
               $data = array('status' => $status);  
               $loginid = $this->contacts_model->update($data, array(), $id);  
               $flashmsg = 'Contact updated Successfully.';  
           endforeach;  
       }  
       $sort_orders = $this->input->post('sort_order');  
       if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save' && count($sort_orders) > 0) {  
           foreach ($sort_orders as $id => $sort_order):  
               $data = array('sort_order' => $sort_order);  
               $loginid = $this->contacts_model->update($data, array(), $id);  
           endforeach;  
           $flashmsg = 'Sort order updated Successfully.';  
       }  
       if (isset($_POST['delete']) && $ids) {  
           foreach ($ids as $id):  
               $loginid = $this->contacts_model->delete($id);  
               $flashmsg = 'Contact deleted Successfully.';  
           endforeach;  
       }  
       if ($loginid) {  
           $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>' . $flashmsg . '</p></div>');  
       } else {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Contact not updated.</p></div>');  
       }  
       redirect('admin/contacts/lists/' . $this->input->post('return'));  
   }  
   public function categories()
    {  
       $this->load->library('pagination');  
       $main['page_title'] = $this->config->item('site_name') . ' - Contact Categories';  
       $main['header'] = $this->adminheader();  
       $main['footer'] = $this->adminfooter();  
       $main['left'] = $this->adminleftmenu();  
       $config['base_url'] = site_url('admin/contacts/categories/');  
       $config['total_rows'] = $this->contactcategory_model->get_pagination_count();  
       $config['per_page'] = '10';  
       $config['uri_segment'] = 4;  
       $config['first_link'] = 'First';  
       $config['last_link'] = 'Last';  
       $config['cur_tag_open'] = '<span>';  
       $config['cur_tag_close'] = '</span>';  
       $this->pagination->initialize($config);  
       $content['contacts'] = $this->contactcategory_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));  
       $main['content'] = $this->load->view('admin/contacts/category/lists', $content, true);  
       $this->load->view('admin/main', $main);  
   }  
   public function addcategory()
    {  
       $this->form_validation->set_rules('name', 'Name', 'required');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Contact Categories';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $main['content'] = $this->load->view('admin/contacts/category/add', '', true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $maindata = array('status' => $this->input->post('status'), 'slug' => url_title($this->input->post('name'), '-', true));  
           $descdata = array('name' => $this->input->post('name'));  
           $insertid = $this->contactcategory_model->insert($maindata, $descdata);  
           if ($insertid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Contact category added Successfully.</p></div>');  
               redirect('admin/contacts/categories');  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Contact category not added.</p></div>');  
               redirect('admin/contacts/categories');  
           }  
       }  
   }  
   public function editcategory($id, $return)
    {  
       $this->form_validation->set_rules('name', 'Name', 'required');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Contact Categories';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $edit['return'] = $return;  
           $edit['contact'] = $this->contactcategory_model->load($id);  
           $main['content'] = $this->load->view('admin/contacts/category/edit', $edit, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $maindata = array('status' => $this->input->post('status'), 'slug' => url_title($this->input->post('name'), '-', true));  
           $descdata = array('name' => $this->input->post('name'));  
           $loginid = $this->contactcategory_model->update($maindata, $descdata, $id);  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Contact category updated Successfully.</p></div>');  
               redirect('admin/contacts/categories/' . $return);  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Contact category not updated.</p></div>');  
               redirect('admin/contacts/categories/' . $return);  
           }  
       }  
   }  
   public function deletecategory($id, $return)
    {  
       $loginid = $this->contactcategory_model->delete($id);  
       if ($loginid) {  
           $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Contact category deleted Successfully.</p></div>');  
           redirect('admin/contacts/categories/' . $return);  
       } else {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Contact category not deleted.</p></div>');  
           redirect('admin/contacts/categories/' . $return);  
       }  
   }  
   public function categoryactions()
    {  
       $ids = $this->input->post('id');  
       if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}  
       if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}  
       $sort_orders = $this->input->post('sort_order');  
       $loginid = false;  
       if (count($ids) > 0 && isset($status)) {  
           foreach ($ids as $id):  
               $data = array('status' => $status);  
               $loginid = $this->contactcategory_model->update($data, array(), $id);  
           endforeach;  
       }  
       if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save' && count($sort_orders) > 0) {  
           foreach ($sort_orders as $id => $sort_order):  
               $data = array('sort_order' => $sort_order);  
               $loginid = $this->contactcategory_model->update($data, array(), $id);  
           endforeach;  
       }  
       if ($loginid) {  
           $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Contact category updated Successfully.</p></div>');  
       } else {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Contact category not updated.</p></div>');  
       }  
       if (isset($_POST['delete']) && $ids) {  
           foreach ($ids as $id):  
               $loginid = $this->contactcategory_model->delete($id);  
               if ($loginid) {  
                   $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Contact category deleted Successfully.</p></div>');  
               }  
           endforeach;  
       }  
       redirect('admin/contacts/categories/' . $this->input->post('return'));  
   }

}

/* End of file contacts.php */

/* Location: ./application/controllers/admin/contacts.php */
