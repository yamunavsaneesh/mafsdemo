<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Downloads extends Web_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $this->load->model('downloads_model');
        $this->load->model('downloadcategory_model');
    }  
   public function index()
    {
        redirect('admin/downloads/lists');
    }  
   public function lists()
    {
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - Downloads';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/downloads/lists/');
        $config['total_rows'] = $this->downloads_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 5;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['downloadfields'] = $this->downloads_model->get_fields();
        $content['sortorders'] = array('asc' => 'Ascending', 'desc' => 'Descending');
        $content['downloadcats'] = $this->downloadcategory_model->get_array();
        $content['downloads'] = $this->downloads_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']), array());
        $main['content'] = $this->load->view('admin/downloads/lists', $content, true);
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
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Downloads';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $add['categories'] = $this->downloadcategory_model->get_array();
            $main['content'] = $this->load->view('admin/downloads/add', $add, true);
            $this->load->view('admin/main', $main);
        } else {
            $attachment = '';
            $config['upload_path'] = 'public/uploads/downloads';
            $config['allowed_types'] = 'docx|doc|pdf|rtf|txt';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('attachment')) {
                $attachmentdata = $this->upload->data();
                $attachment = $attachmentdata['file_name'];
            }
            $maindata = array('status' => $this->input->post('status'), 'category_id' => $this->input->post('category_id'));
            $descdata = array('title' => $this->input->post('title'), 'attachment' => $attachment);  
           $config1['upload_path'] = 'public/uploads/downloads';
            $config1['allowed_types'] = 'png|jpg|gif';
            $this->upload->initialize($config1);
            $this->load->library('upload', $config1);
            if ($this->upload->do_upload('image')) {
                $attachmentdata = $this->upload->data();
                $maindata['image'] = $attachmentdata['file_name'];
            }
            $insertid = $this->downloads_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Download added Successfully.</p></div>');
                redirect('admin/downloads/lists');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Download not added.</p></div>');
                redirect('admin/downloads/lists');
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
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Downloads';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['return'] = $return;
            $edit['download'] = $this->downloads_model->load($id);
            $edit['categories'] = $this->downloadcategory_model->get_array();
            $main['content'] = $this->load->view('admin/downloads/edit', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            $maindata = array('status' => $this->input->post('status'), 'category_id' => $this->input->post('category_id'));
            $descdata = array('title' => $this->input->post('title'));
            $config['upload_path'] = 'public/uploads/downloads';
            $config['allowed_types'] = 'docx|doc|pdf|rtf|txt';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('attachment')) {
                $attachmentdata = $this->upload->data();
                $descdata['attachment'] = $attachmentdata['file_name'];
            }
            $config1['upload_path'] = 'public/uploads/downloads';
            $config1['allowed_types'] = 'png|jpg|gif';
            $this->upload->initialize($config1);
            $this->load->library('upload', $config1);
            if ($this->upload->do_upload('image')) {
                $attachmentdata = $this->upload->data();
                $maindata['image'] = $attachmentdata['file_name'];
            }
            $loginid = $this->downloads_model->update($maindata, $descdata, $id);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Download updated Successfully.</p></div>');
                redirect('admin/downloads/lists/' . $return);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Download not updated.</p></div>');
                redirect('admin/downloads/lists/' . $return);
            }
        }
    }  
   public function delete($id, $return)
    {
        $loginid = $this->downloads_model->delete($id);
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Download deleted Successfully.</p></div>');
            redirect('admin/downloads/lists/' . $return);
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Download not deleted.</p></div>');
            redirect('admin/downloads/lists/' . $return);
        }
    }  
   public function actions()
    {
        $loginid = false;
        $ids = $this->input->post('id');
        $sort_orders = $this->input->post('sort_order');
        if (isset($_POST['reset']) && $this->input->post('reset') == 'Reset') {
            $newdata = array(
                'download_key' => '',
                'download_field' => '',
                'download_category_id' => '',
                'order_field' => '',
                'sort_field' => '',
            );
            $this->session->set_userdata($newdata);
            redirect('admin/downloads/lists/');
        }
        if (isset($_POST['search']) && $this->input->post('search') == 'Search') {
            if ($this->input->post('keyword') != '' || $this->input->post('category') != '' || $this->input->post('sortby') != '') {
                $newdata = array(
                    'download_key' => $this->input->post('keyword'),
                    'download_field' => $this->input->post('field'),
                    'download_category_id' => $this->input->post('category'),
                    'order_field' => $this->input->post('orderby'),
                    'sort_field' => $this->input->post('sortby'),
                );
                $this->session->set_userdata($newdata);
            } else {
                $newdata = array(
                    'download_key' => '',
                    'download_field' => '',
                    'download_category_id' => '',
                    'order_field' => '',
                    'sort_field' => '',
                );
                $this->session->set_userdata($newdata);
            }
            redirect('admin/downloads/lists/');
        }  
       if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';
            $data = array('status' => $status);}
        if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';
            $data = array('status' => $status);}
        if (isset($_POST['featured']) && $this->input->post('featured') == 'Featured') {$status = 'Y';
            $data = array('featured' => $status);}
        if (isset($_POST['normal']) && $this->input->post('normal') == 'Regular') {$status = 'N';
            $data = array('featured' => $status);}
        if (isset($status) && isset($_POST['id'])) {
            foreach ($ids as $id):
                $loginid = $this->downloads_model->update($data, array(), $id);
                $flashmsg = 'Downloads updated Successfully.';
            endforeach;
        }
        if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save' && count($sort_orders) > 0) {
            foreach ($sort_orders as $id => $sort_order):
                $data = array('sort_order' => $sort_order);
                $loginid = $this->downloads_model->update($data, array(), $id);
                $flashmsg = 'Downloads updated Successfully.';
            endforeach;
        }
        if (isset($_POST['delete']) && $ids) {
            foreach ($ids as $id):
                $loginid = $this->downloads_model->delete($id);
                $flashmsg = 'Downloads deleted Successfully.';
            endforeach;
        }
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>' . $flashmsg . '</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Download not updated.</p></div>');
        }
        redirect('admin/downloads/lists/' . $this->input->post('return'));
    }  
   public function categories()
    {
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - Download Categories';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/downloads/categories/');
        $config['total_rows'] = $this->downloadcategory_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['downloads'] = $this->downloadcategory_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));
        $main['content'] = $this->load->view('admin/downloads/category/lists', $content, true);
        $this->load->view('admin/main', $main);
    }  
   public function addcategory()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Download Categories';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $main['content'] = $this->load->view('admin/downloads/category/add', '', true);
            $this->load->view('admin/main', $main);
        } else {
            $maindata = array('status' => $this->input->post('status'));
            $descdata = array('name' => $this->input->post('name'));
            $insertid = $this->downloadcategory_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Download category added Successfully.</p></div>');
                redirect('admin/downloads/categories');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Download category not added.</p></div>');
                redirect('admin/downloads/categories');
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
            $main['page_title'] = $this->config->item('site_name') . ' - Download Categories';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['return'] = $return;
            $edit['download'] = $this->downloadcategory_model->load($id);
            $main['content'] = $this->load->view('admin/downloads/category/edit', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            $maindata = array('status' => $this->input->post('status'));
            $descdata = array('name' => $this->input->post('name'));
            $loginid = $this->downloadcategory_model->update($maindata, $descdata, $id);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Download category updated Successfully.</p></div>');
                redirect('admin/downloads/categories/' . $return);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Download category not updated.</p></div>');
                redirect('admin/downloads/categories/' . $return);
            }
        }
    }
    public function deletecategory($id, $return)
    {
        $loginid = $this->downloadcategory_model->delete($id);
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Download category deleted Successfully.</p></div>');
            redirect('admin/downloads/categories/' . $return);
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Download category not deleted.</p></div>');
            redirect('admin/downloads/categories/' . $return);
        }
    }  
   public function categoryactions()
    {
        $loginid = false;
        $ids = $this->input->post('id');
        $sort_orders = $this->input->post('sort_order');
        if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}
        if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}
        if (isset($status) && isset($_POST['id'])) {
            foreach ($ids as $id):
                $data = array('status' => $status);
                $loginid = $this->downloadcategory_model->update($data, array(), $id);
            endforeach;
        }
        if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save' && count($sort_orders) > 0) {
            foreach ($sort_orders as $id => $sort_order):
                $data = array('sort_order' => $sort_order);
                $loginid = $this->downloadcategory_model->update($data, array(), $id);
            endforeach;
        }
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Download category updated Successfully.</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Download category not updated.</p></div>');
        }
        if (isset($_POST['delete']) && $ids) {
            foreach ($ids as $id):
                $loginid = $this->downloadcategory_model->delete($id);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Download category Deleted Successfully.</p></div>');
            }
        }
        redirect('admin/downloads/categories/' . $this->input->post('return'));
    }

}
/* End of file downloads.php */
/* Location: ./application/controllers/admin/downloads.php */
