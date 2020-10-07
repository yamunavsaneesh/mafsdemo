<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends Web_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
    }  
   public function index()
    {
        $this->load->model('admin_model');
        $this->load->model('language_model');
        $this->load->model('contacts_model');
        $this->load->model('contents_model');
        $this->load->model('services_model');
        $this->load->model('news_model');
        $main['page_title'] = $this->config->item('site_name') . ' - Dashboard';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $content['contents'] = $this->contents_model->get_array_limit(8);
        $content['contacts'] = $this->contacts_model->get_array_limit(8);
        $content['services'] = $this->services_model->get_array_limit(10);
        $content['news'] = $this->news_model->get_array_limit(8);
        $content['languages'] = $this->language_model->get_array_limit(8);
        $content['users'] = $this->admin_model->get_array_limit(8);
        $main['content'] = $this->load->view('admin/content/home', $content, true);
        $this->load->view('admin/main', $main);
    }  
   public function logout()
    {
        $newdata = array(
            'admin_id' => '',
            'admin_name' => '',
            'admin_email' => '',
            'admin_language' => '',
            'admin_logged_in' => false,
        );
        $this->session->set_userdata($newdata);
        redirect('admin/login');
    }
    public function language()
    {
        $newdata = array(
            'admin_language' => $this->input->post('language'),
        );
        $this->session->set_userdata($newdata);
        redirect($this->input->post('return'));
    }  
   public function changepwd()
    {
        $this->load->model('admin_model');
        $this->form_validation->set_rules('passold', 'Old Password', 'required|callback_password_check');
        $this->form_validation->set_rules('pass', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Confirm Password', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_message('matches', 'password mismatch');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Change Password';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $main['content'] = $this->load->view('admin/home/changepwd', '', true);
            $this->load->view('admin/main', $main);
        } else {
            $pass = md5($this->input->post('pass'));
            $data = array('password' => $pass);
            $cond = array('id' => $this->session->userdata('admin_id'));
            $loginid = $this->admin_model->update($data, $cond);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Password Changed Successfully.</p></div>');
                redirect('admin/home');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Password Change Failed.</p></div>');
                redirect('admin/home');
            }
        }
    }  
   public function password_check($code)
    {
        if (!$this->admin_model->password_check($code)) {
            $this->form_validation->set_message('password_check', 'invalid password');
            return false;
        } else {
            return true;
        }
    }  
   public function settings()
    {
        $this->load->model('settings_model');
        $this->form_validation->set_rules('settings', 'Settings', 'trim');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Settings';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['settings'] = $this->settings_model->get_array();
            $main['content'] = $this->load->view('admin/home/settings', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            foreach ($this->input->post('setting') as $identity => $setting):
                $maindata = array();
                $descdata = array('settingvalue' => $setting);
                $loginid = $this->settings_model->update($maindata, $descdata, $identity);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Settings updated Successfully.</p></div>');
                redirect('admin/home/settings/');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Settings not updated.</p></div>');
                redirect('admin/home/settings/');
            }
        }
    }  
   public function addsettings()
    {
        $this->load->model('settings_model');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('settingkey', 'Key', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Settings';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $main['content'] = $this->load->view('admin/home/addsettings', '', true);
            $this->load->view('admin/main', $main);
        } else {
            $maindata = array('status' => $this->input->post('status'), 'settingkey' => $this->input->post('settingkey'), 'settingtype' => $this->input->post('settingtype'), 'title' => $this->input->post('title'));
            $descdata = array('settingvalue' => $this->input->post('settingvalue'));
            $insertid = $this->settings_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Setting added Successfully.</p></div>');
                redirect('admin/home/settings/');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Setting not added.</p></div>');
                redirect('admin/home/settings/');
            }
        }
    }  
   public function localization()
    {
        $this->load->model('localization_model');
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - Localization';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/home/localization/');
        $config['total_rows'] = $this->localization_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['localization'] = $this->localization_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));
        $main['content'] = $this->load->view('admin/home/localization', $content, true);
        $this->load->view('admin/main', $main);
    }  
   public function addlocalization()
    {
        $this->load->model('localization_model');
        $this->load->model('language_model');
        $this->form_validation->set_rules('lang_key', 'Key', 'required');
        $this->form_validation->set_rules('lang_value', 'Value', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Add Localization';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $list['languages'] = $this->language_model->get_active();
            $main['content'] = $this->load->view('admin/home/addlocalization', $list, true);
            $this->load->view('admin/main', $main);
        } else {
            $maindata = array('lang_key' => $this->input->post('lang_key'), 'lang_value' => $this->input->post('lang_value'));
            $insertid = $this->localization_model->insert($maindata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Localization added Successfully.</p></div>');
                redirect('admin/home/localization/');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Localization not added.</p></div>');
                redirect('admin/home/localization/');
            }
        }
    }  
   public function localizationactions()
    {
        $this->load->model('localization_model');
        $lang_values = $this->input->post('lang_value');
        if (isset($_POST['reset']) && $this->input->post('reset') == 'Reset') {
            $newdata = array(
                'localization_key' => '',
            );
            $this->session->set_userdata($newdata);
            redirect('admin/home/localization/');
        }
        if (isset($_POST['search']) && $this->input->post('search') == 'Search') {
            if ($this->input->post('keyword') != '') {
                $newdata = array(
                    'localization_key' => $this->input->post('keyword'),
                );
                $this->session->set_userdata($newdata);
            } else {
                $newdata = array(
                    'localization_key' => '',
                );
                $this->session->set_userdata($newdata);
            }
            redirect('admin/home/localization/');
        }
        if (isset($_POST['save']) && $this->input->post('save') == 'Save') {
            foreach ($lang_values as $id => $lang_value):
                $data = array('lang_value' => $lang_value);
                $loginid = $this->localization_model->update($data, array('id' => $id));
                unset($data);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Localization updated Successfully.</p></div>');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Localization not updated.</p></div>');
            }
        }
        redirect('admin/home/localization/' . $this->input->post('return'));  
   }
    public function clearcache()
    {
        $this->clear_all_cache();
        redirect('admin/home/');
    }
}
/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
