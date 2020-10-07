<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pagenotfound extends MAFS_Controller
{
    public function index()
    {
        $pagemeta = $this->contents_model->get_row_cond(array('slug' => 'pagenotfound'));
        if ($pagemeta->title != '') {$this->pagetitle = $pagemeta->title;}
        if ($pagemeta->short_desc != '') {$this->desc = $pagemeta->short_desc;}
        if ($pagemeta->keywords != '') {$this->keys = $pagemeta->keywords;}
        if ($pagemeta->banner_image != '') {$this->pagebannner = base_url('public/uploads/pages/' . $pagemeta->banner_image);}
        if ($pagemeta->banner_text != '') {$this->pagebannnertext = $pagemeta->banner_text;} 
        $this->breadcrumbarr = array('/' => $this->alphasettings['BREADCRUMB_START'], site_url('contactus') => $this->pagetitle);
         $main['contents'] = $this->load->view('frontend/content/pagenotfound', array('content' => $pagemeta), true);
        $main['header'] = $this->frontheader();
        $main['footer'] = $this->frontfooter();
        $main['meta'] = $this->frontmetahead();
        $this->load->view('frontend/main', $main);
    }

}
/* End of file contents.php */
/* Location: ./application/controllers/404.php */
