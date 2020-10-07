<div class="full_w"> 
  <div class="h_title">Edit Settings</div> 
  <?php echo $this->session->flashdata('message'); ?> <?php echo form_open('admin/home/settings/'); ?> 
  <?php foreach($settings as $setting): ?> 
  <div class="element"> 
    <label for="status"><?php echo $setting['title']; ?> (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <?php if($setting['settingtype']=='radio'){ ?> 
    <input type="radio" name="setting[<?php echo $setting['id']; ?>]" value="Y" <?php if($setting['status']=='Y'){ echo 'checked="checked"';} ?> /> 
    Yes 
    <input type="radio" name="setting[<?php echo $setting['id']; ?>]" value="N" <?php if($setting['status']=='N'){ echo 'checked="checked"';} ?> /> 
    No 
    <?php } else if($setting['settingtype']=='textaera'){ ?> 
    <input  name="setting[<?php echo $setting['id']; ?>]" type="text" class="text" value="<?php echo $setting['settingvalue']; ?>" /> 
    <?php } else { ?> 
    <input  name="setting[<?php echo $setting['id']; ?>]" type="text" class="text" value="<?php echo $setting['settingvalue']; ?>" /> 
    <?php } ?> 
  </div> 
  <?php endforeach; ?> 
  <div class="clear">&nbsp;</div> 
 <div class="entry" align="center"> 
    <button type="submit" class="add">Save</button> 
    <a class="button cancel" href="<?php echo site_url('admin/home'); ?>">Cancel</a> </div> 
  <?php echo form_close(); ?> </div> 
<style>.element{ float:left; clear:none !important; width:48%;}</style>