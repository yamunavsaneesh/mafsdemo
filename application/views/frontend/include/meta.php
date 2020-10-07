<?php if(current_url() == site_url('pagenotfound')){?>
<title><?php echo $this->pagetitle; ?></title>
<meta name="description" content="<?php echo $this->desc; ?>" />
<meta name="keywords" content="<?php echo $this->keys; ?>" />
<meta name="robots" content="noindex">
<?php }else{ ?>
<title><?php echo $this->pagetitle; ?> - <?php echo $this->alphasettings['SITE_NAME']; ?></title>
<meta name="description" content="<?php echo $this->desc; ?>" />
<meta name="keywords" content="<?php echo $this->keys; ?>" />
<meta name="robots" content="index, follow" />
<meta property="og:site_name" content="<?php echo $this->alphasettings['SITE_NAME']; ?>" />
<meta property="og:title" content="<?php echo $this->pagetitle; ?>" />
<meta property="og:type" content="website" />
<meta property="og:description" content="<?php echo $this->desc; ?>" />
<meta property="og:url" content="<?php echo current_url() ?>" /> 
<link rel="canonical" href="<?php echo current_url() ?>" />
<?php }  ?>
