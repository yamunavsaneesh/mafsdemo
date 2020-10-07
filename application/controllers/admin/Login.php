<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Login extends CI_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('recaptcha');
    }
    public function veryfy_captcha()
    {
        // Catch the user's answer
        $captcha_answer = $this->input->post('g-recaptcha-response');
        // Verify user's answer
        $response = $this->recaptcha->verifyResponse($captcha_answer);
        // Processing ...
        if ($response['success']) {
            // Your success code here
            return true;
        } else {
            $this->form_validation->set_message('veryfy_captcha', '(required)');
            // Something goes wrong
            return false; //var_dump($response);
        }
    }
    public function index()
    {
        $this->form_validation->set_rules('login', 'Username', 'required|trim|callback_login_check');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        //$this->form_validation->set_rules('captcha', 'Captcha', 'callback_veryfy_captcha');
        $this->form_validation->set_message('required', '(required)');
        if ($this->form_validation->run() == false) {
            $this->load->model('language_model');
            $login['langs'] = $this->language_model->get_active();
            $login['content'] = $this->load->view('admin/login/login', $login, true);
            $this->load->view('admin/login', $login);
        } else {
            $this->load->model('login_model');
            $user = $this->db->escape_str($this->input->post('login'));
            $pass = $this->db->escape_str($this->input->post('pass'));
            $pass = md5($pass);
            $cond = array('username' => $user, 'password' => $pass);
            $admin_row = $this->admin_model->get_row_cond($cond);
            if ($admin_row) {
                $logindata = array('admin_id' => $admin_row->id,
                    'login_date' => date('Y-m-d H:i:s'),
                    'login_ip' => $this->input->ip_address());
                $loginid = $this->login_model->insert($logindata);
                $newdata = array(
                    'admin_id' => $admin_row->id,
                    'admin_name' => $admin_row->name,
                    'admin_role' => $admin_row->roles_id,
                    'admin_email' => $admin_row->email,
                    'admin_language' => $this->input->post('language'),
                    'admin_loginid' => $loginid,
                    'admin_logged_in' => true,
                );
                $this->session->set_userdata($newdata);
            }
            redirect('admin/home');
        }
    }
    public function login_check($user)
    {
        $pass = $this->input->post('pass');
        if ($user == '') {$this->form_validation->set_message('login_check', 'required');} elseif (!$this->admin_model->login_check($user, $pass)) {
            $this->form_validation->set_message('login_check', 'Invalid Login');
            return false;
        } else {
            return true;
        }
    }
    public function forgot()
    {
        $this->form_validation->set_rules('login', 'Username', 'required|callback_username_check');
        $this->form_validation->set_message('required', '(required)');
        if ($this->form_validation->run() == false) {
            $login['content'] = $this->load->view('admin/login/forgot', '', true);
            $this->load->view('admin/login', $login);
        } else {
            $user = $this->db->escape_str($this->input->post('login'));
            $cond = array('username' => $user);
            $admin_row = $this->admin_model->get_row_cond($cond);
            if ($admin_row) {
                $this->load->model('adminreset_model');
                $this->load->helper('string');
                $resetdata = array('user_id' => $admin_row->id, 'user_key' => random_string('alnum', 16));
                $this->adminreset_model->insert($resetdata);
                $message = $this->load->view('admin/mail/passwordrequest', $resetdata, true);
                $this->sendfromadmin($admin_row->email, 'Web Capital Market - Password Reset Request', $message);
                redirect('admin/login/forgotsuccess');
            } else {
                redirect('admin/login/forgot');
            }
        }
    }
    public function username_check($user)
    {
        if (!$this->admin_model->username_check($user)) {
            $this->form_validation->set_message('username_check', 'Invalid Username');
            return false;
        } else {
            return true;
        }
    }
    public function forgotsuccess()
    {
        $login['content'] = $this->load->view('admin/login/forgotsuccess', '', true);
        $this->load->view('admin/login', $login);
    }
    public function resetpwd($id, $key)
    {
        $this->load->model('adminreset_model');
        $resetcond = array('user_id' => $id, 'user_key' => $key);
        if ($this->adminreset_model->exists($resetcond)) {
            $this->form_validation->set_rules('pass', 'Password', 'required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Confirm Password', 'required');
            $this->form_validation->set_message('required', '(required)');
            $this->form_validation->set_message('matches', 'Password Mismatch');
            if ($this->form_validation->run() == false) {
                $reset['id'] = $id;
                $reset['key'] = $key;
                $login['content'] = $this->load->view('admin/login/reset', $reset, true);
                $this->load->view('admin/login', $login);
            } else {
                $pass = $this->db->escape_str($this->input->post('pass'));
                $maildata = array('password' => $pass);
                $pass = md5($pass);
                $data = array('password' => $pass);
                $cond = array('id' => $id);
                $this->admin_model->update($data, $cond);
                $resetdata = array('user_id' => $id, 'user_key' => $key);
                $this->adminreset_model->delete($resetdata);
                /*$message=$this->load->view('admin/mail/passwordsend',$maildata,TRUE);
                $this->sendfromadmin($admin_row->email,'Web Capital Market - Password Reset Succesfully',$message);*/
                redirect('admin/login/resetsuccess');
            }
        } else {
            redirect('admin/login/forgot');
        }
    }
    public function resetsuccess()
    {
        $login['content'] = $this->load->view('admin/login/resetsuccess', '', true);
        $this->load->view('admin/login', $login);
    }
    public function sendfromadmin($to, $subject, $message)
    {
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = true;
        $this->email->initialize($config);
        $this->email->from('admin@Web.com', 'Web Admin');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {return true;} else {return false;}
    }

}
/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */
