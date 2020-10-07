<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Web_Controller extends CI_Controller { 
    function __construct()
    {
        parent::__construct();
		$this->load->model('language_model');		
         $this->load->model('settings_model');
		$settings=$this->settings_model->get_array();
		foreach($settings as $setting):
			$this->alphasettings[$setting['settingkey']]=$setting['settingvalue'];
		endforeach;
		$this->languagesarr = $this->language_model->get_active_array();
		$this->langcodes=$this->language_model->language_conversion();
		if(!$this->session->userdata('admin_logged_in'))
		{
		   redirect('admin/login');		
		}
		if($this->session->userdata('admin_role')!='1'){
			$this->checkpermissions(); 
		}
    }
 	function adminheader()
	{
		$this->load->model('login_model');
		$this->load->model('adminmenu_model');	
		$this->load->model('menu_model');	
		$header['login']=$this->login_model->get_lastlogin();
		$header['menus']=$this->adminmenu_model->get_menu();
		$header['frontmenus']=$this->menu_model->get_array();
		$header['langs']=$this->language_model->get_active();
		return  $this->load->view('admin/include/header',$header,true);
	}
 	function adminfooter()
	{
		$footer['menus']='';
		return $this->load->view('admin/include/footer',$footer,true);
	}
 	function adminleftmenu()
	{
		$this->load->model('adminmenu_model');	
		$this->load->model('menu_model');	
		$left['menus']=$this->adminmenu_model->get_menu();
		$left['frontmenus']=$this->menu_model->get_array();
		return $this->load->view('admin/include/left',$left,true);
	}
 	function sendfromadmin($to,$subject,$message)
	{
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;		
		$this->email->initialize($config);
		
		$this->email->from($this->alphasettings['FROM_EMAIL'], 'Web Admin');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);		
		if($this->email->send()){ return true; } else { return false; }
	}
	
	function get_featurecategory_tree($id='0',$selected='')
	{
		$this->load->model('featurecategory_model');
		return $this->featurecategory_model->get_category_tree($id,$selected);
	}
	
	function get_menu_tree($menuid='',$id='0',$selected='')
	{
		$this->load->model('menuitems_model');
		return $this->menuitems_model->get_category_tree($menuid,$id,$selected);
	}
	
	function render_menuitems_lists($menucond,$selected='')
	{
		$this->load->model('menuitems_model');
		return $this->menuitems_model->get_menu_list_tree($menucond,$selected);
	}
	
	public function clear_all_cache()
    {
        $CI =& get_instance();
		
		$path = $CI->config->item('cache_path');
        
        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;
        
        $handle = opendir($cache_path);
        while (($file = readdir($handle))!== FALSE) 
        {
            //Leave the directory protection alone
            if ($file != '.htaccess' && $file != 'index.html')
            {
               @unlink($cache_path.'/'.$file);
            }
        }
        closedir($handle);
    }
		
	function checkpermissions(){	
		$this->load->model('admin_model');
		$link=$this->uri->segment(1);
		if($this->uri->segment(2))
		$link.='/'.$this->uri->segment(2);
		if($this->uri->segment(3))
		$link.='/'.$this->uri->segment(3);
		if(($link=='admin') || ($link=='admin/home') || ($link=='admin/home/logout') || ($link=='admin/accessdenied')){			
			//redirect($link);	
		}else{   
			$cond=array('url'=>$link);		
			$permission=$this->admin_model->check_permission($cond);		
			if($permission)
			{
				$acc_cond=array('permissions_id'=>$permission->permissions_id,'roles_id'=>$this->session->userdata('admin_role')); 
				$access=$this->admin_model->check_access($acc_cond);	
				if($access==0){
					redirect('admin/accessdenied');
				}
			}
		}
	}
}
/* Frontend Controller*/
class MAFS_Controller extends CI_Controller {
	
    function __construct()
    {
        parent::__construct();
		$this->load->model(array('language_model','frontend/settings_model'));	
		$this->load->helper('text');
		$this->languagesarr = $this->language_model->get_active_array();
		$this->langcodes=$this->language_model->language_conversion();
		if($this->config->item('language')!=''){
			$newdata=array('front_language'=>$this->langcodes[$this->config->item('language')]);
		} 
		$this->session->set_userdata($newdata);
		$this->alphasettings=array();
		$this->alphalocalization=array();
		$this->fronthead();	
		$this->clear_all_cache();
 		$this->c = $this->router->fetch_class();
		$this->m = $this->router->fetch_method(); 
    }
	
	public function clear_all_cache()
    {
		
        $CI =& get_instance(); 
	    $path = $CI->config->item('cache_path'); 
        $cache_path = ($path == '') ? APPPATH.'cache/' : $path; 
        $handle = opendir($cache_path);
        while (($file = readdir($handle))!== FALSE) 
        { 
            //Leave the directory protection alone
            if ($file != '.htaccess' && $file != 'index.html')
            {
               @unlink($cache_path.'/'.$file);
			 
            }
        }
        closedir($handle);
    } 
	
	function get_menu_tree($menuid='',$id='0',$selected='')
	{
		$this->load->model('menuitems_model');
		return $this->menuitems_model->get_category_tree($menuid,$id,$selected);
	}
	
	function render_menuitems_lists($menucond,$selected='')
	{
		$this->load->model('menuitems_model');
		return $this->menuitems_model->get_menu_list_tree($menucond,$selected);
	}
	
	function fronthead()
	{
		$this->load->model(array('frontend/menuitems_model','frontend/contents_model','frontend/Servicecategory_model','frontend/services_model','frontend/contentcategory_model')); 
		$settings=$this->settings_model->get_array();  
		foreach($settings as $setting):
			$this->alphasettings[$setting['settingkey']]=$setting['settingvalue'];
		endforeach; 
		$contents=$this->contents_model->get_array();
		foreach($contents as $content):
			$this->contentslugs[$content['slug']]=$content;
			$this->contents[$content['id']]=$content['slug'];
			$this->contentsections[$content['category_id']][]=$content;
		endforeach;
		$catcontents=$this->contentcategory_model->get_array();
		foreach($catcontents as $catcontent):
			$this->contentcategoryslugs[$catcontent['id']]=$catcontent['slug'];
			$this->contentcategory[$catcontent['id']] = $catcontent;
		endforeach; $scats=$this->Servicecategory_model->get_array();
		foreach($scats as $scat):
			$this->servicescategoryslugs[$scat['id']]=$scat['slug'];
			$this->servicescategory[$scat['id']] = $scat;
		endforeach; 
		if($content['short_desc'] !=''){$this->short_desc=$content['short_desc']; }
		$this->services=$this->services_model->get_active('',"id,short_desc,category_id,icon,title,slug,price ,keywords,image,banner_image,desc,'services' as section,concat_ws('/','services/view',slug) as link"); 
		foreach($this->services as $servc):
			$this->serviceslugs[$servc['slug']]=$servc;
			$this->serviceids[$servc['id']] = $servc;
			$this->catservices[$servc['category_id']][] = $servc;
		endforeach;
		$this->pagetitle=$this->alphasettings['DEFAULT_META_TITLE']; 
		$this->desc=$this->alphasettings['DEFAULT_META_DESCRIPTION']; 
		$this->keys=$this->alphasettings['DEFAULT_META_KEYWORDS'];
		if($this->session->userdata('front_language')=='ar'){ 
			$this->pagebannner=base_url('public/frontend/images/new-spot.jpg');  
		} else {
			$this->pagebannner=base_url('public/frontend/images/new-spot.jpg');  
		}
		$this->pagebannnertext='';
		$this->breadcrumbarr=array('/'=>$this->alphasettings['BREADCRUMB_START']);
		$this->currentmenu='';
		$this->currentparentmenu='';
		$this->left_widgets='';
	}
	
	function frontmetahead()
	{
		return  $this->load->view('frontend/include/meta','',true);		
	}
	
	function frontheader()
	{	
  		$frontheader['langs']=$this->language_model->get_active();
		$frontheader['language_pair']=$this->language_model->language_pair();
 		$frontheader['mainmenu']=$this->menuitems_model->get_menu_ul('mainmenu');
 		return $this->load->view('frontend/include/header',$frontheader,true);
	} 
	function frontleftmenu($datas)
	{
		$left['datas']=$datas;
		return $this->load->view('frontend/include/left',$left,true);
	} 
 	function frontprintcontent($frontcontents, $leftboxoption=true,$products=true)
	{
		if($leftboxoption){
			$frontcontent['leftsection']=$this->frontleftmenu();
		} 
		else {
 			$frontcontent['banners']=$this->banners_model->get_active();
		}
		$frontcontent['maintcontent']=$frontcontents;
		$frontcontent['leftbox']=$leftboxoption;
		return $this->load->view('frontend/include/printcontent',$frontcontent,true);
	}
	
	function frontfooter($latestnews=false)
	{  
		$this->load->model('frontend/contacts_model');	
		$footermenus=array();$footer['contact']= $this->contacts_model->get_row_cond(array('category_id'=>1));
  		$footer['footer']=$this->menuitems_model->get_menu('footer');$footer['policy']=$this->menuitems_model->get_policy_menu('policy'); 
 		return $this->load->view('frontend/include/footer',$footer,true);	
	} 
	
	function alphaspace_check($str){ 		
			if(!preg_match('/^([a-z ]|\p{Arabic})+$/iu', trim($str))){
			 $this->form_validation->set_message('alphaspace_check', convert_lang('alphabets only',$this->alphalocalization));
		     return false;    	 		 
		}else{		 
		    return true; 
		}
	}
	
	function captcha_check($str){ 
			$expiration = time()-7200; // Two hour limit
			$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
 			// Then see if a captcha exists:
			$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
			$binds = array($str, $this->input->ip_address(), $expiration);
			$query = $this->db->query($sql, $binds);
			$row = $query->row();			
			if ($row->count == 0)
			{
			 $this->form_validation->set_message('captcha_check', convert_lang('invalid security code',$this->alphalocalization));
		     return false;    	 		 
			}else{		 
				return true; 
			}
	}
		
	function sendfromadmin($to,$subject,$message,$attachment='')
	{
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;		
		$this->email->initialize($config);
		$this->email->from($this->alphasettings['FROM_EMAIL'],$this->alphasettings['SITE_NAME']);
		$this->email->reply_to('noreply@sarralle.com',$this->alphasettings['SITE_NAME']);
		$this->email->to($to);		
		$this->email->subject($subject);
		$this->email->message($message);
		if($attachment!=''){$this->email->attach($attachment);	}
		if($this->email->send()){ return true; } else { return false; }
	}
	
	function sendtoadmin($fromemail,$fromname,$attachment,$subject,$message)
	{
 		$this->load->library('email');
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;		
		$this->email->initialize($config);
		$this->email->from($fromemail, $fromname);
		$this->email->to($this->alphasettings['ADMIN_EMAIL']);
		$this->email->subject($subject);
		$this->email->message($message);		
		if($attachment!=''){$this->email->attach($attachment);	}
		if($this->email->send()){ return true; } else { return false; }
	}
	
	function adminnotification($subject,$message)
	{
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;		
		$this->email->initialize($config);
 		$this->email->from($this->alphasettings['FROM_EMAIL'],'Web Admin');
		$this->email->to($this->alphasettings['ADMIN_EMAIL']);
		$this->email->subject($subject);
		$this->email->message($message);
	
		if($this->email->send()){ return true; } else { return false; }
	}
	
	function adminnotification2($subject,$message,$tomail)
	{
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;		
		$this->email->initialize($config);
 		$this->email->from($this->alphasettings['FROM_EMAIL'],'Web Admin');
		$this->email->to($tomail);
		$this->email->subject($subject);
		$this->email->message($message);
	
		if($this->email->send()){ return true; } else { return false; }
	}
	
	function adminnotification3($subject,$message,$tomail)
	{
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;		
		$this->email->initialize($config);
 		$this->email->from($this->alphasettings['FROM_EMAIL'],'Web Admin');
		$this->email->to($tomail);
		$this->email->subject($subject);
		$this->email->message($message);
	
		if($this->email->send()){ return true; } else { return false; }
	}
	
	function sendtofriend($fromemail,$fromname,$toemail,$toname,$subject,$message)
	{
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;		
		$this->email->initialize($config);
		$this->email->from($fromemail,$fromname);
		$this->email->to($toemail,$toname);
		$this->email->subject($subject);
		$this->email->message($message);		
		if($this->email->send()){ return true; } else { return false; 							}
	}
	
	function outputCache(){
		if($this->alphasettings['CACHE_TIME']!='0'){
			$this->output->cache($this->alphasettings['CACHE_TIME']);
		}
	}
	
}