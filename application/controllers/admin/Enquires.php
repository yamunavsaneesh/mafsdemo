<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Enquires extends Web_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $this->load->model('enquiry_model');
    }  
   public function index()
    {
        redirect('admin/enquires/lists');
    }  
   public function lists()
    {
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - Callbacks';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/enquires/lists');
        $config['total_rows'] = $this->enquiry_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['enquiries'] = $this->enquiry_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));
        $main['content'] = $this->load->view('admin/enquires/callback', $content, true);
        $this->load->view('admin/main', $main);
    }
    public function delete($id, $return)
    {
        $loginid = $this->enquiry_model->delete($id);
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Contact deleted Successfully.</p></div>');
            redirect('admin/enquires/lists/' . $return);
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Contact not deleted.</p></div>');
            redirect('admin/enquires/lists/' . $return);
        }
    }

}
/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */
