<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Videos extends MAFS_Controller {  
	public function index()  
	{  
		redirect('videos/lists');  
	}  
	public function lists()  
	{  
		$this->outputCache();
		$this->load->library('pagination'); 
		$this->load->model(array('frontend/videocategory_model','frontend/video_model'));  
		$pagemeta=$this->contents_model->get_row_cond(array('slug'=>'videos')); 
		if($pagemeta->title!=''){$this->pagetitle=$pagemeta->title;}  
		if($pagemeta->short_desc!=''){$this->desc=$pagemeta->short_desc; }  
		if($pagemeta->desc!=''){$this->fulldesc=$pagemeta->desc; }  
		if($pagemeta->keywords!=''){$this->keys=$pagemeta->keywords; }  
		if($pagemeta->banner_image!=''){$this->pagebannner=base_url('public/uploads/pages/'.$pagemeta->banner_image); }  
		if($pagemeta->banner_text!=''){$this->pagebannnertext=$pagemeta->banner_text; }   
		$this->breadcrumbarr=array('/'=>$this->alphasettings['BREADCRUMB_START'],site_url('gallery/index') =>'Gallery',site_url('video/lists') =>$this->pagetitle);	
		$lists['galleries']=$this->videocategory_model->get_active();  
		$lists['videos']=$this->video_model->get_active(); 
		$lists['content']=$pagemeta;  
		$frontcontent=$this->load->view('frontend/gallery/videos',$lists,true); 
		$main['contents']=$frontcontent;  
		$main['header']=$this->frontheader();  
		$main['footer']=$this->frontfooter();  
		$main['meta']=$this->frontmetahead();  
		$this->load->view('frontend/main',$main);  
	}  
}  
/* End of file contents.php */  
/* Location: ./application/controllers/videos.php */