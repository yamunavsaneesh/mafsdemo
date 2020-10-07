<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Gallery extends MAFS_Controller {  
	public function index($id='')  
	{  
 		$this->load->model(array('frontend/gallerycategory_model','frontend/gallery_model','frontend/pages_model','frontend/news_model'));   
 		$this->load->library('pagination');   
 		$mediacenter=$this->menuitems_model->get_array(array('parent_id'=>11,'status'=>'Y'),'name as title,icon as image,link ,link as slug');   
		$lists['left']=$this->frontleftmenu($mediacenter);
		$lists['pagemeta']=$pagemeta=$this->pages_model->get_row_cond(array('key'=>'gallery'));   
		if($pagemeta->title!=''){$this->pagetitle=$pagemeta->title;}  
		if($pagemeta->short_desc!=''){$this->desc=$pagemeta->short_desc; }  
		if($pagemeta->keywords!=''){$this->keys=$pagemeta->keywords; }  
		if($pagemeta->banner_image!=''){$this->pagebannner=base_url('public/uploads/pages/'.$pagemeta->banner_image); }  
		if($pagemeta->banner_text!=''){$this->pagebannnertext=$pagemeta->banner_text; }	  
 		$this->breadcrumbarr=array(site_url('/')=>$this->alphasettings['BREADCRUMB_START'],site_url()=>convert_lang('Media Center',$this->alphalocalization),site_url('gallery') => $this->pagetitle);  
		$config['base_url'] = site_url('gallery');   
		$config['total_rows'] = $this->gallery_model->get_pagination_count();  
		$config['per_page'] =16;  
		$config['uri_segment'] = 4;  
		$config['first_link'] = false;  
		$config['last_link'] = false;$config['attributes'] = array('class' => 'page-link');  
		$config['next_link'] = '<i class="fa fa-chevron-right" aria-hidden="true"></i>';  
		$config['prev_link'] = '<i class="fa fa-chevron-left" aria-hidden="true"></i>';  
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';  
		$config['cur_tag_close'] = '</a></li>';  
		$config['full_tag_open'] = '<ul class="pagination">';  
		$config['full_tag_close'] = '</ul>';  
		$config['num_tag_open'] = ' <li class="page-item">';  
		$config['num_tag_close'] = '</li>';  
		$config['next_tag_open'] = '<li class="page-item next">';  
		$config['next_tag_close'] = '</li>';  
		$config['prev_tag_open'] = '<li class="page-item prev">';  
		$config['prev_tag_close'] = '</li>';  
		$config['use_page_numbers'] = TRUE;  
		$offset =0;  $page_number = $this->uri->segment($config['uri_segment'],0);   
		if($page_number){   $offset = ($page_number  == 1) ? 0 : ($page_number * $config['per_page']) - $config['per_page'];	 }  
		$lists['images']=$this->gallery_model->get_pagination($config['per_page'],$offset,NULL,'sort_order DESC');     
		$frontcontent=$this->load->view('frontend/gallery/lists',$lists,true);   
		$main['contents'] = $frontcontent;  
		$main['header']=$this->frontheader();  
		$main['footer']=$this->frontfooter();  
		$main['meta']=$this->frontmetahead();  
		$this->load->view('frontend/main',$main);  
	}    
}  
/* End of file news.php */  
/* Location: ./application/controllers/gallery.php */