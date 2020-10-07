<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Contactus extends MAFS_Controller {  
	public function index($id='')  
	{  
		$this->outputCache();  
		$this->load->model(array('frontend/pages_model' ,'frontend/contactcategory_model','frontend/contacts_model'));  
 		$pagemeta=$this->pages_model->get_row_cond(array('key'=>'contactus'));  
 		if($pagemeta->meta_title!=''){$this->pagetitle=$pagemeta->meta_title;}  
		elseif($pagemeta->title!=''){$this->pagetitle=$pagemeta->title;}  
		if($pagemeta->short_desc!=''){$this->desc=$pagemeta->short_desc; }  
		if($pagemeta->keywords!=''){$this->keys=$pagemeta->keywords; }  
		if($pagemeta->banner_image!=''){$this->pagebannner=base_url('public/uploads/pages/'.$pagemeta->banner_image); }  
		if($pagemeta->banner_text!=''){$this->pagebannnertext=$pagemeta->banner_text; }  
 		$this->breadcrumbarr=array(site_url('/')=>$this->alphasettings['BREADCRUMB_START'],site_url('contactus') =>$pagemeta->title);  
		$home['countries']=$this->contactcategory_model->get_active();  
		$home['contacts']= $locations = $this->contacts_model->get_active();  
		$maps = array(); if($locations) foreach($locations as $location): $maps[$location['category_id']][] = $location;endforeach;  
		$home['pagemeta']=$pagemeta;$home['maps']=$maps;$home['scrollkey']=$id;  
 		$frontcontent=$this->load->view('frontend/content/contactus',$home,true);  
 		$main['contents']=$frontcontent;  
		$main['header']=$this->frontheader();  
		$main['footer']=$this->frontfooter();  
		$main['meta']=$this->frontmetahead();  
		$this->load->view('frontend/main',$main);  
	} 
	public function enquiry()
	{
		$this->load->library('recaptcha');
		$this->form_validation->set_rules('name', 'Your Name', 'required|callback_alphaspace_check'); 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required'); 
        //$this->form_validation->set_rules('captcha', 'Captcha', 'callback_veryfy_captcha');
		$this->form_validation->set_message('required', convert_lang('required',$this->alphalocalization));
		$this->form_validation->set_message('valid_email', convert_lang('Invalid Email',$this->alphalocalization));
		$this->form_validation->set_message('numeric', convert_lang('numbers only',$this->alphalocalization));
		$this->form_validation->set_error_delimiters('<span class="red">(', ')</span>');
		if ($this->form_validation->run() == FALSE)
		{ 	 
			$this->load->view('frontend/content/enquiryform',null);
		} else {
			$custemail = $this->input->post('email'); 
			$ref=  $_SERVER["HTTP_REFERER"];
			$maindata=array('refererurl'=>$ref,'enq_name'=>$this->input->post('name'),'enq_email'=>$this->input->post('email'),
			'enq_phone'=>$this->input->post('phone'),'enq_subject'=>$this->input->post('subject'),'enq_message'=>$this->input->post('message'));
 			$this->load->model('frontend/enquiry_model');
 			$descdata = "";
 			$insertid = $this->enquiry_model->insert($maindata,$descdata);  
            $message = $this->load->view('frontend/mail/enquiry',$maindata,TRUE);
            $thmessage = $this->load->view('frontend/mail/acknowledgement',$maindata,TRUE);
            $this->sendfromadmin($custemail,'Thank you for contacting us',$thmessage);
			$this->adminnotification(convert_lang('MAFS Enquiry',$this->alphalocalization),$message);
			$this->load->view('frontend/contents/contactsuccess'); // exit;		
	   	}
		
		
	}
}  
/* End of file contactus.php */  
/* Location: ./application/controllers/contactus.php */