<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class News extends MAFS_Controller
{
    public function index()
    {
        $this->load->model(array('frontend/news_model'));
        $lists['content'] = $pagemeta = $this->contents_model->get_row_cond(array('slug' => 'news-events'));
        if ($pagemeta->meta_title != '') {$this->pagetitle = $pagemeta->meta_title;} elseif ($pagemeta->title != '') {$this->pagetitle = $pagemeta->title;}
        if ($pagemeta->short_desc != '') {$this->desc = $pagemeta->short_desc;}
        if ($pagemeta->keywords != '') {$this->keys = $pagemeta->keywords;}
        if ($pagemeta->banner_image != '') {$this->pagebannner = base_url('public/uploads/pages/' . $pagemeta->banner_image);}
        if ($pagemeta->banner_text != '') {$this->pagebannnertext = $pagemeta->banner_text;}
        $this->breadcrumbarr = array('/' => $this->alphasettings['BREADCRUMB_START'], site_url() => convert_lang('Media Center', $this->alphalocalization), site_url('news') => $pagemeta->title);
        $this->load->library('pagination');
        $config['base_url'] = base_url($this->session->userdata('front_language') . '/news');
        $config['total_rows'] = $this->news_model->get_pagination_count();
        $config['per_page'] = 25;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item prv">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['attributes'] = array('class' => 'page-link');
        $config['next_tag_open'] = '<li class="page-item nxt">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active page-item"><a class="page-link" href="javascript:void0)">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $lists['news'] = $this->news_model->get_pagination($config['per_page'], $this->uri->segment($config['uri_segment']), '', 'date_time desc');
        $frontcontent = $this->load->view('frontend/news/lists', $lists, true);
        $main['contents'] = $frontcontent;
        $main['header'] = $this->frontheader();
        $main['footer'] = $this->frontfooter();
        $main['meta'] = $this->frontmetahead();
        $this->load->view('frontend/main', $main);
    }
    public function view($id = '')
    {
        $this->outputCache();
        $this->load->model(array('frontend/news_model', 'frontend/pages_model', 'frontend/menuitems_model'));
        $mediacenter = $this->menuitems_model->get_array(array('parent_id' => 11, 'status' => 'Y'), 'name as title,icon as image,link ,link as slug');
        $main['left'] = $this->frontleftmenu($mediacenter);
        $main['content'] = $news = $this->news_model->get_row_cond(array('slug' => $id));
        if (!$news) {redirect('pagenotfound');}
        if ($news->title != '') {$this->pagetitle = $news->title;}
        if ($news->meta_desc != '') {$this->desc = $news->meta_desc;}
        if ($news->keywords != '') {$this->keys = $news->keywords;}
        $main['pagemeta'] = $pagemeta = $this->pages_model->get_row_cond(array('key' => 'news'));
        if ($pagemeta->title != '') {$this->pagetitle = $pagemeta->title;}
        if ($pagemeta->short_desc != '') {$this->desc = $pagemeta->short_desc;}
        if ($pagemeta->keywords != '') {$this->keys = $pagemeta->keywords;}
        if ($pagemeta->banner_image != '') {$this->pagebannner = base_url('public/uploads/pages/' . $pagemeta->banner_image);}
        if ($pagemeta->banner_text != '') {$this->pagebannnertext = $pagemeta->banner_text;}
        $this->breadcrumbarr = array('/' => $this->alphasettings['BREADCRUMB_START'], site_url() => convert_lang('Media Center', $this->alphalocalization), site_url('news') => $pagemeta->title, site_url('news/view/' . $news->slug) => $news->title);
        $main['news'] = $this->news_model->get_array_limit(5);
        $frontcontent = $this->load->view('frontend/news/view', $main, true);
        $main['contents'] = $frontcontent;
        $main['header'] = $this->frontheader();
        $main['footer'] = $this->frontfooter();
        $main['meta'] = $this->frontmetahead();
        $this->load->view('frontend/main', $main);
    }

}
/* End of file news.php */
/* Location: ./application/controllers/news.php */
