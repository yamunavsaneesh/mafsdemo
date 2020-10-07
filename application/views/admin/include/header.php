<div id="header"> 
  <div id="top">
  <div class="left"> <img class="img primary-logo" src="<?php echo base_url('public/frontend/images/logo.png');?>" alt="MAFS Logo"></div>
    <div class="right tp-20"> 
      <p>Welcome, <strong><?php echo $this->session->userdata('admin_name');?></strong> | <a href="<?php echo site_url('admin/home/logout'); ?>">logout</a> </p> 
    </div> 
    <div class="right tp-20"> 
      <div class="header-right align-right"> <?php if(count($langs)>1){ echo form_open('admin/home/language'); ?> 
         
        <select name="language" class="language" onChange="this.form.submit();"> 
          <?php foreach($langs as $lang): ?> 
          <option value="<?php echo $lang['code']; ?>" <?php if($this->session->userdata('admin_language')==$lang['code']){ echo 'selected="selected"'; }?>><?php echo $lang['name']; ?></option> 
          <?php endforeach; ?> 
        </select> 
        <input type="hidden" name="return" value="<?php echo uri_string(); ?>" /> 
        <?php echo form_close(); } ?> 
         
      </div> 
    </div> 
  </div> 
  <ul class="topmenu">  
    <?php  $ic=0; 
			foreach($menus as $menu):  
			$ic++;  
			$menuarr=explode('/',$menu['link']);  
			if(isset($menuarr['1'])){ 
				$currmenu=$menuarr['1']; 
			}else{ 
				$currmenu=''; 
			} 
	?> 
    <li class="menuwrap"> 
      <?php if(count($menu['sub_menu'])>0){?> 
      <a class="dropmenu" href="<?php echo $menu['link'] ?>"><i class="<?php echo $menu['class']?$menu['class']:'icon-plus-sign-alt' ?>"></i><span class="hidden-tablet"> <?php echo  $menu['name']; ?></span></a> 
      <ul> 
        <?php foreach($menu['sub_menu'] as $submenu):?> 
        <li> <a href="<?php echo site_url($submenu['link']); ?>" target="<?php echo $submenu['link'] == 'home' ? '_blank':'_self' ?>"><i class="icon-chevron-right"></i><span class="hidden-tablet"> <?php echo $submenu['name']; ?></span></a> 
          <?php if(count($submenu['child_menus'])>0 ){?> 
          <ul> 
            <?php foreach($submenu['child_menus'] as $childmenu):?> 
            <li><a href="<?php echo site_url($childmenu['link']); ?>"><i class="icon-chevron-right"></i><span class="hidden-tablet"> <?php echo $childmenu['name']; ?></span></a></li> 
            <?php endforeach; ?> 
            <?php if($submenu['id']=='9'){ foreach($frontmenus as $frontmenu):  ?> 
            <li><a href="<?php echo site_url('admin/menus/menuitems/'.$frontmenu['id']); ?>"><i class="icon-chevron-right"></i><span class="hidden-tablet"><?php echo $frontmenu['name']; ?></span></a></li> 
            <?php endforeach; } ?> 
          </ul> 
          <?php } ?> 
        </li> 
        <?php endforeach;  ?> 
      </ul> 
      <?php } ?> 
    </li> 
    <?php endforeach; ?> 
  </ul> 
</div> 
