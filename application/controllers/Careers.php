<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Careers extends MAFS_Controller
{
    public function index()
    {
        $pagemeta = $career['content'] = $this->contents_model->get_row_cond(array('slug' => 'careers'));
        if ($pagemeta->title != '') {$this->pagetitle = $pagemeta->title;}
        if ($pagemeta->short_desc != '') {$this->desc = $pagemeta->short_desc;}
        if ($pagemeta->keywords != '') {$this->keys = $pagemeta->keywords;}
        if ($pagemeta->banner_image != '') {$this->pagebannner = base_url('public/uploads/pages/' . $pagemeta->banner_image);}
        if ($pagemeta->banner_text != '') {$this->pagebannnertext = $pagemeta->banner_text;}
        $this->breadcrumbarr=array('/'=>'Home',site_url('careers') =>'Careers' );
        $main['contents'] = $this->load->view('frontend/contents/view', $career, true);
        $main['meta'] = $this->frontmetahead();
        $main['header'] = $this->frontheader();
        $main['footer'] = $this->frontfooter();
        $this->load->view('frontend/main', $main);
    }
}
/* End of file careers.php */
/* Location: ./application/controllers/careers.php */
