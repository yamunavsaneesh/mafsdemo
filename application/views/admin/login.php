<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<link rel="icon" type="image/png" href="<?php echo base_url('favicon.png'); ?>"/> 
<title><?php echo $this->config->item('site_name'); ?>- Administration</title> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/login.css'); ?>" media="screen" /> 
</head> 
<body> 
<div class="wrap"> 
  <div id="content"> 
    <div id="main"> 
      
      <div class="full_w">  <div align="center"> 
<h1><a class="page-logo" href="<?php echo site_url() ?>" target="_blank"><img class="img-responsive" src="<?php echo base_url('public/frontend/images/logo.png');?>" tittle="Sarralle"/></a></h1> 
</div><?php echo $content; ?> </div> 
      <div class="footer">&raquo; <a href="<?php echo base_url('home'); ?>"><?php echo $this->config->item('site_name'); ?></a> | Admin Panel</div> 
    </div> 
  </div> 
</div> 
</body> 
</html> 
