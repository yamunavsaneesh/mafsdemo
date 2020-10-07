<div class="full_w">
 <div class="h_title">Add User</div>
 <?php echo form_open_multipart('admin/clients/add'); ?>
<div class="element">
   <label for="title">Name (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)
     <?php if (form_error('title')) {$err = ' err';
    echo form_error('title');} else { $err = '';?>
     <span> (required)</span>
     <?php }?>
   </label>
   <input id="title" name="title" type="text" class="text<?php echo $err; ?>" value="<?php echo set_value('title'); ?>" />
 </div>
<div class="element">
   <label for="author">Email (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)
     <?php if (form_error('author')) {$err = ' err';
    echo form_error('author');} else { $err = '';?>
     <span> (required)</span>
     <?php }?>
   </label>
   <input id="author" name="author" type="text" class="text<?php echo $err; ?>" value="<?php echo set_value('author'); ?>" />
 </div>
	<div class="element">
   <label for="phone">Phone (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)
     <?php if (form_error('phone')) {$err = ' err';
    echo form_error('phone');} else { $err = '';?>
     <span> (required)</span>
     <?php }?>
   </label>
   <input id="phone" name="phone" type="text" class="text<?php echo $err; ?>" value="<?php echo set_value('phone'); ?>" />
 </div>
<div class="element">
   <label for="image">Posted Date </label>
   <input type="text" name="date_time" id="date_time" class="text datepicker" value="<?php echo @set_value('date_time'); ?>" />
 </div>
<div class="element">
   <label for="status">Status
     <?php if (form_error('status')) {$err = ' err';
    echo form_error('status');} else { $err = '';?>
     <span> (required)</span>
     <?php }?>
   </label>
   <input type="radio" name="status" value="Y" <?php echo set_radio('status', 'Y', true); ?> />
   Enabled
   <input type="radio" name="status" value="N" <?php echo set_radio('status', 'N'); ?> />
   Disabled </div>
 <div class="entry">
   <button type="submit" class="add">Save</button>
   <a class="button cancel" href="<?php echo site_url('admin/clients/lists'); ?>">Cancel</a> </div>
 <?php echo form_close(); ?> 
</div>