<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}  
class Clients extends Web_Controller
{  
    public function __construct()
    {  
        // Call the Model constructor  
        parent::__construct();  
        if (!$this->session->userdata('admin_logged_in')) {  
            redirect('admin/login');  
        }  
        $this->load->model('clients_model');  
    }  
    public function index()
    {  
        redirect('admin/clients/lists');  
    }  
    public function lists($return = 0)
    {  
        $sort_orders = $this->input->post('sort_order');  
        $resultid = false;  
        $ids = $this->input->post('id');  
        $where = array();  
        $main['page_title'] = $this->config->item('site_name') . ' - Projects Gallery';  
        $main['header'] = $this->adminheader();  
        $main['footer'] = $this->adminfooter();  
        $main['left'] = $this->adminleftmenu();  
        $this->load->library('pagination');  
        $config['base_url'] = base_url() . 'admin/clients/lists';  
        $config['total_rows'] = $this->clients_model->get_pagination_count($where);  
        $config['per_page'] = 20;  
        $config['uri_segment'] = 6;  
        $config['first_link'] = 'First';  
        $config['last_link'] = 'Last';  
        $config['cur_tag_open'] = '<span>';  
        $config['cur_tag_close'] = '</span>';  
        $this->pagination->initialize($config);  
        $content['images'] = $this->clients_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']), $where, 'sort_order ASC');  
        $main['content'] = $this->load->view('admin/clients/lists', $content, true);  
        $this->load->view('admin/main', $main);  
        if (isset($_POST['upload'])) {  
            $config['upload_path'] = 'public/uploads/clients';  
            $config['allowed_types'] = 'gif|jpg|jpeg|png';  
            $this->load->library('upload', $config);  
            $this->upload->initialize($config);  
            $insertid = false;  
            if ($this->upload->do_multi_upload('images')) {  
                foreach ($this->upload->get_multi_upload_data() as $imgdata):  
                    $insertid = $this->clients_model->insert(array('image' => $imgdata['file_name']));  
                endforeach;  
            }  
            if ($insertid) {  
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Images(s) added Successfully.</p></div>');  
                redirect('admin/clients/lists/' . $return);  
            } else {  
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Images(s) not added.</p></div>');  
                redirect('admin/clients/lists/' . $return);  
            }  
        } else if (isset($_POST['sortsave']) && count($sort_orders) > 0) {  
            foreach ($sort_orders as $sortid => $sort_order):  
                $data = array('sort_order' => $sort_order);  
                $resultid = $this->clients_model->update($data, $sortid);  
            endforeach;  
            if ($resultid) {  
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Gallery updated Successfully.</p></div>');  
            } else {  
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Gallery not updated.</p></div>');  
            }  
            redirect('admin/clients/lists/' . $return);  
        } else if (isset($_POST['enable']) || isset($_POST['disable'])) {  
            if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';
                $data = array('status' => $status);}  
            if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';
                $data = array('status' => $status);}  
            if (isset($status) && $ids) {  
                foreach ($ids as $statid):  
                    $resultid = $this->clients_model->update($data, $statid);  
                endforeach;  
            }  
            if ($resultid) {  
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Gallery updated Successfully.</p></div>');  
            } else {  
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Gallery not updated.</p></div>');  
            }  
            redirect('admin/clients/lists/' . $return);  
        }  
        if (isset($_POST['delete']) && $ids) {  
            foreach ($ids as $delid):  
                $gallery = $this->clients_model->load($delid);  
                if ($gallery) {  
                    if ($gallery->image && file_exists("public/uploads/clients/" . $gallery->image)) {  
                        unlink("public/uploads/clients/" . $gallery->image);  
                    }  
                }  
                $resultid = $this->clients_model->delete($delid);  
            endforeach;  
            if ($resultid) {  
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Image(s) Deleted Successfully.</p></div>');  
            }  
            redirect('admin/clients/lists/' . $return);  
        }  
    }  
    public function delete($id, $return)
    {  
        $loginid = $this->clients_model->delete($id);  
        if ($loginid) {  
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>User deleted Successfully.</p></div>');  
            redirect('admin/clients/lists/' . $return);  
        } else {  
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - User not deleted.</p></div>');  
            redirect('admin/clients/lists/' . $return);  
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
            redirect('admin/clients/lists/');  
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
            redirect('admin/clients/lists/');  
        }  
        if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';}  
        if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';}  
        if (isset($status) && $ids) {  
            foreach ($ids as $id):  
                $data = array('is_active' => $status);  
                $loginid = $this->clients_model->update(array(), $data, $id);  
            endforeach;  
            if ($loginid) {  
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>User updated Successfully.</p></div>');  
            }  
        }  
        if (isset($_POST['delete']) && $ids) {  
            foreach ($ids as $id):  
                $loginid = $this->clients_model->delete($id);  
            endforeach;  
            if ($loginid) {  
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>User Deleted Successfully.</p></div>');  
            }  
        }  
        if (!$loginid) {  
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - User not updated.</p></div>');  
        }  
        redirect('admin/clients/lists/' . $this->input->post('return'));  
    }  
    public function code_exists($code)
    {  
        $id = $this->input->post('id');  
        if ($this->clients_model->code_exists($code, $id)) {  
            $this->form_validation->set_message('code_exists', 'already exists');  
            return false;  
        } else {  
            return true;  
        }  
    }  
}  
/* End of file contents.php */  
/* Location: ./application/controllers/admin/clients.php */
