<div class="full_w"> 
  <div class="h_title">Edit News Category</div> 
  <?php echo form_open('admin/news/editcategory/'.$content->id.'/'.$return); ?> 
  <input id="id" name="id" type="hidden" value="<?php echo $content->id; ?>" /> 
  <div class="element"> 
    <label for="name">Name (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('name')){ $err=' err'; echo form_error('name'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input id="name" name="name" type="text" class="text<?php echo $err; ?>" value="<?php echo $content->name; ?>" /> 
  </div> 
  <div class="element"> 
    <label for="icon">Icon <?php echo $content->icon; ?></label> 
    <input type="file" name="icon" /> 
  </div> 
  <div class="element"> 
    <label for="status">Status 
      <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input type="radio" name="status" value="Y" <?php if($content->status=='Y'){ echo 'checked="checked"';} ?> /> 
    Enabled 
    <input type="radio" name="status" value="N" <?php if($content->status=='N'){ echo 'checked="checked"';} ?> /> 
    Disabled </div> 
  <div class="entry"> 
    <button type="submit" class="add">Save</button> 
    <a class="button cancel" href="<?php echo site_url('admin/news/categories/'.$return); ?>">Cancel</a> </div> 
  <?php echo form_close(); ?> </div> 
