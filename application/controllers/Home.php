<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Home extends MAFS_Controller {  
	public function index()  
	{   
		$this->outputCache();  
		$this->load->model(array('frontend/banners_model','frontend/clients_model'));   
 		$main['meta']=$this->frontmetahead();  
 	  	$home['banners']=$this->banners_model->get_active();    
		$home['services']= $this->services_model->get_featured_active();  
 	  	$home['clients']=$this->clients_model->get_active();   
	  	$main['contents']=$this->load->view('frontend/content/home',$home,true);   
		$main['header']=$this->frontheader();  
		$main['footer']=$this->frontfooter();   
		$this->load->view('frontend/main',$main);  
	}     
}  
/* End of file home.php */  
/* Location: ./application/controllers/home.php */