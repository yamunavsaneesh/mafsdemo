<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Services extends MAFS_Controller
{
    public function lists($id = '')
    {
        redirect('services');
    }
    public function index($id = '')
    {
        $this->load->model(array( 'frontend/pages_model', 'frontend/news_model'));       
        if ($id) {$lists['content'] = $pagemeta = $this->sectorscategory_model->get_row_cond(array('slug' => $id), "name as title,meta_title,short_desc,keywords,banner_image,desc");} else { $lists['content'] = $pagemeta = $this->pages_model->get_row_cond(array('key' => 'services'));}
        if ($pagemeta->meta_title != '') {$this->pagetitle = $pagemeta->meta_title;} elseif ($pagemeta->title != '') {$this->pagetitle = $pagemeta->title;}
        if ($pagemeta->short_desc != '') {$this->desc = $pagemeta->short_desc;}
        if ($pagemeta->keywords != '') {$this->keys = $pagemeta->keywords;}
        if ($pagemeta->banner_image != '') {$this->pagebannner = base_url('public/uploads/pages/' . $pagemeta->banner_image);}
        $this->breadcrumbarr = array('/' => $this->alphasettings['BREADCRUMB_START'], site_url() => convert_lang('Sectors', $this->alphalocalization), site_url('news') => $pagemeta->title);
        $this->load->library('pagination');
        $config['base_url'] = site_url('sectors');
        $where = array();
        $config['total_rows'] = $this->sectors_model->get_pagination_count($where);
        $config['per_page'] = 12;
        $config['uri_segment'] = 3;
        $config['num_links'] = 10;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="right">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="left">';
        $config['prev_tag_close'] = '</li>';
        $config['use_page_numbers'] = true;
        $offset = 0;
        $page_number = $this->uri->segment($config['uri_segment'], 0);
        if ($page_number) {$offset = ($page_number == 1) ? 0 : ($page_number * $config['per_page']) - $config['per_page'];}
        $this->pagination->initialize($config);
        $lists['news'] = $this->sectors_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']), $where, 'sort_order DESC');
        $lists['sectors'] = $leftmenus = $this->sectorscategory_model->get_active("name as title,icon_image as image,slug,'sectors' as section,concat_ws('/','sectors',slug) as link");
        $lists['left'] = $this->frontleftmenu($leftmenus);
        $frontcontent = $this->load->view('frontend/services/lists', $lists, true);
        $main['contents'] = $frontcontent;
        $main['header'] = $this->frontheader();
        $main['footer'] = $this->frontfooter();
        $main['meta'] = $this->frontmetahead();
        $this->load->view('frontend/main', $main);
    }
    public function view($id = '')
    {
        $this->load->model(array('frontend/services_model'));
        $main['content'] = $content = $this->serviceslugs[$id]; 
        if ($content['title'] != '') {$this->pagetitle = $content['title'];}
        $main['sercat'] = $this->servicescategory[$content['category_id']];
        $main['sercats'] = $sercats = $this->services_model->get_active(array('category_id' => $content['category_id']));
        if ($content['short_desc'] != '') {$this->short_desc = $content['short_desc'];}
        if ($content['keywords'] != '') {$this->keys = $content['keywords'];} 
        $main['contents'] = $this->load->view('frontend/services/view', $main, true);
        $main['header'] = $this->frontheader();
        $main['footer'] = $this->frontfooter();
        $main['meta'] = $this->frontmetahead(); 
        $this->load->view('frontend/main', $main);
    }
}
/* End of file services.php */
/* Location: ./application/controllers/services.php */
