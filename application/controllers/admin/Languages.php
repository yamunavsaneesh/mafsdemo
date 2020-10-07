<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Languages extends Web_Controller
{  
   public function __construct()
    {  
       // Call the Model constructor  
       parent::__construct();  
       if (!$this->session->userdata('admin_logged_in')) {  
           redirect('admin/login');  
       }  
       $this->load->model('language_model');  
   }  
   public function index()
    {  
       redirect('admin/languages/lists');  
   }  
   public function lists()
    {  
       $this->load->library('pagination');  
       $main['page_title'] = $this->config->item('site_name') . ' - Languages';  
       $main['header'] = $this->adminheader();  
       $main['footer'] = $this->adminfooter();  
       $main['left'] = $this->adminleftmenu();  
       $config['base_url'] = site_url('admin/languages/lists/');  
       $config['total_rows'] = $this->language_model->get_pagination_count();  
       $config['per_page'] = '10';  
       $config['uri_segment'] = 4;  
       $config['first_link'] = 'First';  
       $config['last_link'] = 'Last';  
       $config['cur_tag_open'] = '<span>';  
       $config['cur_tag_close'] = '</span>';  
       $this->pagination->initialize($config);  
       $content['languages'] = $this->language_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));  
       $main['content'] = $this->load->view('admin/languages/lists', $content, true);  
       $this->load->view('admin/main', $main);  
   }  
   public function add()
    {  
       $this->form_validation->set_rules('name', 'Name', 'required');  
       $this->form_validation->set_rules('class', 'Class', '');  
       $this->form_validation->set_rules('code', 'Code', 'required|is_unique[languages.code]');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_message('is_unique', 'already exists');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Languages';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $main['content'] = $this->load->view('admin/languages/add', '', true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $data = array(  
               'name' => $this->input->post('name'),  
               'class' => $this->input->post('class'),  
               'code' => $this->input->post('code'),  
               'status' => $this->input->post('status'));  
           $loginid = $this->language_model->insert($data);  
           $this->language_model->updatedesc($this->input->post('code'));  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Language added Successfully.</p></div>');  
               redirect('admin/languages/lists');  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Language not added.</p></div>');  
               redirect('admin/languages/lists');  
           }  
       }  
   }  
   public function edit($id, $return)
    {  
       $this->form_validation->set_rules('name', 'Name', 'required');  
       $this->form_validation->set_rules('class', 'Class', '');  
       $this->form_validation->set_rules('code', 'Code', 'required|callback_code_exists');  
       $this->form_validation->set_rules('status', 'Status', 'required');  
       $this->form_validation->set_message('required', 'required');  
       $this->form_validation->set_message('is_unique', 'already exists');  
       $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');  
       if ($this->form_validation->run() == false) {  
           $main['page_title'] = $this->config->item('site_name') . ' - Languages';  
           $main['header'] = $this->adminheader();  
           $main['footer'] = $this->adminfooter();  
           $main['left'] = $this->adminleftmenu();  
           $edit['return'] = $return;  
           $edit['language'] = $this->language_model->load($id);  
           $main['content'] = $this->load->view('admin/languages/edit', $edit, true);  
           $this->load->view('admin/main', $main);  
       } else {  
           $data = array(  
               'name' => $this->input->post('name'),  
               'class' => $this->input->post('class'),  
               'code' => $this->input->post('code'),  
               'status' => $this->input->post('status'));  
           $cond = array('id' => $id);  
           $loginid = $this->language_model->update($data, $cond);  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Language updated Successfully.</p></div>');  
               redirect('admin/languages/lists/' . $return);  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Language not updated.</p></div>');  
               redirect('admin/languages/lists/' . $return);  
           }  
       }  
   }  
   public function delete($id, $return)
    {  
       $cond = array('id' => $id);  
       $row = $this->language_model->get_row_cond($cond);  
       $code = $row->code;  
       $this->language_model->deletedesc($code);  
       $loginid = $this->language_model->delete($cond);  
       if ($loginid) {  
           $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Language deleted Successfully.</p></div>');  
           redirect('admin/languages/lists/' . $return);  
       } else {  
           $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Language not deleted.</p></div>');  
           redirect('admin/languages/lists/' . $return);  
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
               $loginid = $this->language_model->update($data, array('id' => $id));  
           endforeach;  
           if ($loginid) {  
               $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Language updated Successfully.</p></div>');  
           } else {  
               $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Language not updated.</p></div>');  
           }  
       }  
       redirect('admin/languages/lists/' . $this->input->post('return'));  
   }  
   public function code_exists($code)
    {  
       $id = $this->input->post('id');  
       if ($this->language_model->code_exists($code, $id)) {  
           $this->form_validation->set_message('code_exists', 'already exists');  
           return false;  
       } else {  
           return true;  
       }  
   }

}

/* End of file languages.php */

/* Location: ./application/controllers/admin/languages.php */
