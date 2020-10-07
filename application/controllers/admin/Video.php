<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Video extends Web_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $this->load->model('video_model');
        $this->load->model('videocategory_model');
    }  
   public function index()
    {
        redirect('admin/video/lists');
    }  
   public function lists()
    {
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - Video';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/video/lists/');
        $config['total_rows'] = $this->video_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['galleryfields'] = $this->video_model->get_fields();
        $content['sortorders'] = array('asc' => 'Ascending', 'desc' => 'Descending');
        $content['gallerycats'] = $this->videocategory_model->get_array();
        $content['galleries'] = $this->video_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));
        $main['content'] = $this->load->view('admin/video/lists', $content, true);
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
        $this->form_validation->set_rules('title', 'Title', '');  
       $this->form_validation->set_rules('desc', 'Desc', '');
        $this->form_validation->set_rules('video', 'Video', '');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Video';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $add['categories'] = $this->videocategory_model->get_array();
            $main['content'] = $this->load->view('admin/video/add', $add, true);
            $this->load->view('admin/main', $main);
        } else {
            $image = '';
            $config['upload_path'] = 'public/uploads/gallery';
            $config['allowed_types'] = 'jpg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $imagedata = $this->upload->data();
                $image = $imagedata['file_name'];
                $this->load->library('image_lib');
                $configSize1['image_library'] = 'gd2';
                $configSize1['source_image'] = 'public/uploads/gallery/' . $image;
                $configSize1['maintain_ratio'] = true;
                $configSize1['width'] = 200;
                $configSize1['height'] = 70;
                $configSize1['master_dim'] = 'height';
                $configSize1['new_image'] = 'public/uploads/gallery/thumb_' . $image;
                $this->image_lib->initialize($configSize1);
                $this->image_lib->resize();
                $this->image_lib->clear();
                $configSize3['image_library'] = 'gd2';
                $configSize3['source_image'] = 'public/uploads/gallery/' . $image;
                $configSize3['maintain_ratio'] = true;
                $configSize3['width'] = 1600;
                $configSize3['height'] = 1000;
                $configSize3['new_image'] = 'public/uploads/gallery/main_' . $image;
                $this->image_lib->initialize($configSize3);
                $this->image_lib->resize();
                $this->image_lib->clear();
                $this->resizecrop($imagedata, 'view_', '936', '460');
            }
            $maindata = array('status' => $this->input->post('status'), 'category_id' => $this->input->post('category_id'));
            $descdata = array('title' => $this->input->post('title'), 'desc' => $this->input->post('desc'), 'image' => $image, 'video' => $this->input->post('video'));
            $insertid = $this->video_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Gallery added Successfully.</p></div>');
                redirect('admin/video/lists');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Gallery not added.</p></div>');
                redirect('admin/video/lists');
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
        $this->form_validation->set_rules('title', 'Title', '');  
       $this->form_validation->set_rules('desc', 'Desc', '');
        $this->form_validation->set_rules('video', 'Video', '');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Video';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['return'] = $return;
            $edit['gallery'] = $this->video_model->load($id);
            $edit['categories'] = $this->videocategory_model->get_array();
            $main['content'] = $this->load->view('admin/video/edit', $edit, true);
            $this->load->view('admin/main', $main);
        } else {  
           $maindata = array('status' => $this->input->post('status'), 'category_id' => $this->input->post('category_id'));
            $descdata = array('title' => $this->input->post('title'), 'desc' => $this->input->post('desc'), 'video' => $this->input->post('video'));
            $config['upload_path'] = 'public/uploads/gallery';
            $config['allowed_types'] = 'jpg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $imagedata = $this->upload->data();
                $descdata['image'] = $imagedata['file_name'];
                $this->load->library('image_lib');
                $configSize1['image_library'] = 'gd2';
                $configSize1['source_image'] = 'public/uploads/gallery/' . $descdata['image'];
                $configSize1['maintain_ratio'] = true;
                $configSize1['width'] = 200;
                $configSize1['height'] = 70;
                $configSize1['master_dim'] = 'height';
                $configSize1['new_image'] = 'public/uploads/gallery/thumb_' . $descdata['image'];
                $this->image_lib->initialize($configSize1);
                $this->image_lib->resize();
                $this->image_lib->clear();
                $configSize3['image_library'] = 'gd2';
                $configSize3['source_image'] = 'public/uploads/gallery/' . $descdata['image'];
                $configSize3['maintain_ratio'] = true;
                $configSize3['width'] = 1600;
                $configSize3['height'] = 1000;
                $configSize3['new_image'] = 'public/uploads/gallery/main_' . $descdata['image'];
                $this->image_lib->initialize($configSize3);
                $this->image_lib->resize();
                $this->image_lib->clear();
                $this->resizecrop($imagedata, 'view_', '936', '460');
                $gallery = $this->video_model->load($id);
                if ($gallery->image != '' && file_exists('public/uploads/gallery/' . $gallery->image)) {unlink('public/uploads/gallery/' . $gallery->image);}
            }
            $loginid = $this->video_model->update($maindata, $descdata, $id);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Gallery updated Successfully.</p></div>');
                redirect('admin/video/lists/' . $return);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Gallery not updated.</p></div>');
                redirect('admin/video/lists/' . $return);
            }
        }
    }  
   public function delete($id, $return)
    {
        $gallery = $this->video_model->load($id);
        if ($gallery->image != '' && file_exists('public/uploads/gallery/' . $gallery->image)) {unlink('public/uploads/gallery/' . $gallery->image);}
        $loginid = $this->video_model->delete($id);
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Gallery deleted Successfully.</p></div>');
            redirect('admin/video/lists/' . $return);
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Gallery not deleted.</p></div>');
            redirect('admin/video/lists/' . $return);
        }
    }  
   public function actions()
    {
        $loginid = false;
        $ids = $this->input->post('id');
        $sort_orders = $this->input->post('sort_order');
        if (isset($_POST['reset']) && $this->input->post('reset') == 'Reset') {
            $newdata = array(
                'gallery_key' => '',
                'gallery_field' => '',
                'gallery_category_id' => '',
                'order_field' => '',
                'sort_field' => '',
            );
            $this->session->unset_userdata($newdata);
            redirect('admin/video/lists/');
        }
        if (isset($_POST['search']) && $this->input->post('search') == 'Search') {
            if ($this->input->post('keyword') != '' || $this->input->post('category') != '' || $this->input->post('sortby') != '') {
                $newdata = array(
                    'gallery_key' => $this->input->post('keyword'),
                    'gallery_field' => $this->input->post('field'),
                    'gallery_category_id' => $this->input->post('category'),
                    'order_field' => $this->input->post('orderby'),
                    'sort_field' => $this->input->post('sortby'),
                );
                $this->session->set_userdata($newdata);
            } else {
                $newdata = array(
                    'gallery_key' => '',
                    'gallery_field' => '',
                    'gallery_category_id' => '',
                    'order_field' => '',
                    'sort_field' => '',
                );
                $this->session->unset_userdata($newdata);
            }
            redirect('admin/video/lists/');
        }  
       if (isset($_POST['enable']) && $this->input->post('enable') == 'Enable') {$status = 'Y';
            $data = array('status' => $status);}
        if (isset($_POST['disable']) && $this->input->post('disable') == 'Disable') {$status = 'N';
            $data = array('status' => $status);}
        if (isset($status) && isset($_POST['id'])) {
            foreach ($ids as $id):
                $loginid = $this->video_model->update($data, array(), $id);
                $flashmsg = 'Gallery updated Successfully.';
            endforeach;
        }
        if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save' && count($sort_orders) > 0) {
            foreach ($sort_orders as $id => $sort_order):
                $data = array('sort_order' => $sort_order);
                $loginid = $this->video_model->update($data, array(), $id);
                $flashmsg = 'Gallery updated Successfully.';
            endforeach;
        }
        if (isset($_POST['delete']) && $ids) {
            foreach ($ids as $id):
                $gallery = $this->video_model->load($id);
                if ($gallery->image != '' && file_exists('public/uploads/gallery/' . $gallery->image)) {unlink('public/uploads/gallery/' . $gallery->image);}
                $loginid = $this->video_model->delete($id);
                $flashmsg = 'Gallery deleted Successfully.';
            endforeach;
        }
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>' . $flashmsg . '</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Gallery not updated.</p></div>');
        }
        redirect('admin/video/lists/' . $this->input->post('return'));
    }  
   public function categories()
    {
        $this->load->library('pagination');
        $main['page_title'] = $this->config->item('site_name') . ' - Video Categories';
        $main['header'] = $this->adminheader();
        $main['footer'] = $this->adminfooter();
        $main['left'] = $this->adminleftmenu();
        $config['base_url'] = site_url('admin/video/categories/');
        $config['total_rows'] = $this->videocategory_model->get_pagination_count();
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $content['galleries'] = $this->videocategory_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']));
        $main['content'] = $this->load->view('admin/video/category/lists', $content, true);
        $this->load->view('admin/main', $main);
    }  
   public function addcategory()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Video Categories';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $main['content'] = $this->load->view('admin/video/category/add', '', true);
            $this->load->view('admin/main', $main);
        } else {
            $image = '';
            $config['upload_path'] = 'public/uploads/gallery';
            $config['allowed_types'] = 'jpg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $imagedata = $this->upload->data();
                $image = $imagedata['file_name'];
                $this->load->library('image_lib');
                $this->resizecrop($imagedata, 'list_', '296', '183');
            }
            $slug = $this->videocategory_model->create_slug($this->input->post('title'));
            $maindata = array('status' => $this->input->post('status'), 'slug' => $slug);
            $descdata = array('title' => $this->input->post('title'), 'image' => $image);
            $insertid = $this->videocategory_model->insert($maindata, $descdata);
            if ($insertid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Gallery category added Successfully.</p></div>');
                redirect('admin/video/categories');
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Gallery category not added.</p></div>');
                redirect('admin/video/categories');
            }
        }
    }  
   public function editcategory($id, $return)
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('slug', 'Url Slug', 'required|callback_code_exists');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_message('required', 'required');
        $this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
        if ($this->form_validation->run() == false) {
            $main['page_title'] = $this->config->item('site_name') . ' - Video Categories';
            $main['header'] = $this->adminheader();
            $main['footer'] = $this->adminfooter();
            $main['left'] = $this->adminleftmenu();
            $edit['return'] = $return;
            $edit['gallery'] = $this->videocategory_model->load($id);
            $main['content'] = $this->load->view('admin/video/category/edit', $edit, true);
            $this->load->view('admin/main', $main);
        } else {
            $slug = $this->videocategory_model->update_slug($this->input->post('slug'), $id);
            $maindata = array('status' => $this->input->post('status'), 'slug' => $slug);
            $descdata = array('title' => $this->input->post('title'));
            $config['upload_path'] = 'public/uploads/gallery';
            $config['allowed_types'] = 'jpg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $imagedata = $this->upload->data();
                $descdata['image'] = $imagedata['file_name'];
                $this->load->library('image_lib');
                $this->resizecrop($imagedata, 'list_', '296', '183');
                $gallery = $this->videocategory_model->load($id);
                if ($gallery->image != '' && file_exists('public/uploads/gallery/' . $gallery->image)) {unlink('public/uploads/gallery/' . $gallery->image);}
            }
            $loginid = $this->videocategory_model->update($maindata, $descdata, $id);
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Gallery category updated Successfully.</p></div>');
                redirect('admin/video/categories/' . $return);
            } else {
                $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Gallery category not updated.</p></div>');
                redirect('admin/video/categories/' . $return);
            }
        }
    }
    public function deletecategory($id, $return)
    {
        $gallery = $this->videocategory_model->load($id);
        if ($gallery->image != '' && file_exists('public/uploads/gallery/' . $gallery->image)) {unlink('public/uploads/gallery/' . $gallery->image);}
        $loginid = $this->videocategory_model->delete($id);
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Gallery category deleted Successfully.</p></div>');
            redirect('admin/video/categories/' . $return);
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Gallery category not deleted.</p></div>');
            redirect('admin/video/categories/' . $return);
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
                $loginid = $this->videocategory_model->update($data, array(), $id);
            endforeach;
        }
        if (isset($_POST['sortsave']) && $this->input->post('sortsave') == 'Save' && count($sort_orders) > 0) {
            foreach ($sort_orders as $id => $sort_order):
                $data = array('sort_order' => $sort_order);
                $loginid = $this->videocategory_model->update($data, array(), $id);
            endforeach;
        }
        if ($loginid) {
            $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Video category updated Successfully.</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="n_error flash_messages"><p>Error!! - Video category not updated.</p></div>');
        }
        if (isset($_POST['delete']) && $ids) {
            foreach ($ids as $id):
                $gallery = $this->videocategory_model->load($id);
                if ($gallery->image != '' && file_exists('public/uploads/gallery/' . $gallery->image)) {unlink('public/uploads/gallery/' . $gallery->image);}
                $loginid = $this->videocategory_model->delete($id);
            endforeach;
            if ($loginid) {
                $this->session->set_flashdata('message', '<div class="n_ok flash_messages"><p>Video category Deleted Successfully.</p></div>');
            }
        }
        redirect('admin/video/categories/' . $this->input->post('return'));
    }  
   public function resizecrop($promotiondata, $name, $width, $height)
    {
        $image = $promotiondata['file_name'];
        $dimwidth = (intval($promotiondata["image_width"]) / intval($promotiondata["image_height"]));
        $dimheight = (intval($promotiondata["image_height"]) / intval($promotiondata["image_width"]));
        $newheight = $dimwidth * $height;
        $newwidth = $dimheight * $width;
        if ($newheight > $height) {
            $resizewidth = $width;
            $resizeheight = $newheight;
            $master_dim = 'height';
        } else {
            $resizewidth = $newwidth;
            $resizeheight = $height;
            $master_dim = 'width';
        }
        $configSize['image_library'] = 'gd2';
        $configSize['source_image'] = 'public/uploads/gallery/' . $image;
        $configSize['maintain_ratio'] = true;
        $configSize['width'] = $resizewidth;
        $configSize['height'] = $resizeheight;
        $configSize['master_dim'] = $master_dim;
        $configSize['quality'] = 100;
        $configSize['new_image'] = 'public/uploads/gallery/resize_' . $name . $image;
        $this->image_lib->initialize($configSize);
        $this->image_lib->resize();
        $this->image_lib->clear();
        $configCrop['image_library'] = 'gd2';
        $configCrop['source_image'] = 'public/uploads/gallery/resize_' . $name . $image;
        $configCrop['width'] = $width;
        $configCrop['height'] = $height;
        $configCrop['x_axis'] = 0;
        $configCrop['y_axis'] = 0;
        $configCrop['quality'] = 100;
        $configCrop['maintain_ratio'] = false;
        $configCrop['new_image'] = 'public/uploads/gallery/' . $name . $image;
        $this->image_lib->initialize($configCrop);
        $this->image_lib->crop();
        $this->image_lib->clear();
        unlink('public/uploads/gallery/resize_' . $name . $image);
    }
}
/* End of file gallery.php */
/* Location: ./application/controllers/admin/gallery.php */
