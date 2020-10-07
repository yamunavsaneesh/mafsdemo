<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Contents extends MAFS_Controller {  
	public function index($id='')  
	{  
		redirect('home');  
	}  
	public function view($id='')  
	{  
 		$this->outputCache();  
		if($id==''){ redirect('home'); }  
		$main['content'] =$contents=$this->contents_model->get_row_cond(array('slug'=>$id));   
		if(!$contents){redirect('pagenotfound');}  
		if($contents->meta_title!=''){$this->pagetitle=$contents->meta_title; }  
		elseif($contents->title!=''){$this->pagetitle=$contents->title; }  
		if($contents->meta_desc!=''){$this->desc=$contents->meta_desc; }  
		if($contents->keywords!=''){$this->keys=$contents->keywords; }   
		if($contents->banner_image !='' && file_exists('public/uploads/contents/'.$contents->banner_image)) $this->pagebannner=base_url('public/uploads/contents/'.$contents->banner_image);   
		if($contents->banner_text!=''){$this->pagebannnertext=$contents->banner_text; }   
		$main['category']=$catcontent=$this->contentcategory[$contents->category_id];  
		$menurow=$this->menuitems_model->get_currentmenurow($contents->id,'contents');  
		if($menurow){  
			$breadcrumbs=array_reverse($this->menuitems_model->get_menu_path($menurow->id));  
		} else {  
			$breadcrumbs=array_reverse($this->contentcategory_model->get_category_path($catcontent['id']));  
		}  
		$this->breadcrumbarr=array(site_url()=>$this->alphasettings['BREADCRUMB_START']);   
		foreach($breadcrumbs as $index => $breadcrumb):  
			$this->breadcrumbarr[$breadcrumb['link']]=$breadcrumb['name'];  
		endforeach;$this->breadcrumbarr[current_url()]=$contents->title;  
		$main['left']=$this->frontleftmenu($this->contentsections[$contents->category_id]);  
 		$main['contents']=$this->load->view('frontend/contents/view',$main,true);  
 		$main['header']=$this->frontheader();  
		$main['footer']=$this->frontfooter();  
		$main['meta']=$this->frontmetahead();  
		$this->load->view('frontend/main',$main);  
	}  
	  
	public function printcontent($id='')  
	{}   
}  
/* End of file contents.php */  
/* Location: ./application/controllers/contents.php */