<div class="full_w"> 
  <div class="h_title">Add New Content</div> 
  <?php echo form_open_multipart('admin/news/add'); ?> 
  <div class="element"> 
    <label for="category_id">Category 
      <?php if(form_error('category_id')){ $err=' err'; echo form_error('category_id'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <select name="category_id" class="text"> 
      <?php foreach($contentcats as $contentcat): ?> 
      <option value="<?php echo $contentcat['id']; ?>" <?php if($this->input->post('category_id')==$contentcat['id']){ echo 'selected="selected"'; }?>><?php echo $contentcat['name']; ?></option> 
      <?php endforeach; ?> 
    </select> 
  </div> 
     
  <div class="element"> 
    <label for="title">Title (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('title')){ $err=' err'; echo form_error('title'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input id="title" name="title" type="text" class="text<?php echo $err; ?>" value="<?php echo set_value('title'); ?>" /> 
  </div>
  <div class="element"> 
<label for="meta_title">Meta Title </label> 
<input name="meta_title" type="text" class="text" value="<?php echo set_value('meta_title'); ?>" /> 
</div><div class="element"> 
<label for="meta_desc">Meta Description </label> 
<input name="meta_desc" type="text" class="text" value="<?php echo set_value('meta_desc'); ?>" /> 
</div><div class="element"> 
<label for="keywords">Keywords </label> 
<input name="keywords" type="text" class="text" value="<?php echo set_value('keywords'); ?>" /> 
</div>
  <div class="element"> 
    <label for="location">Location </label> 
    <input name="location" type="text" class="text" value="<?php echo set_value('location'); ?>" /> 
  </div>
  <div class="element"> 
<label for="short_desc">Short Description </label> 
<input name="short_desc" type="text" class="text" value="<?php echo set_value('short_desc'); ?>" /> 
</div>
  <div class="element"> 
    <label for="desc">Description (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('desc')){ $err=' err'; echo form_error('desc'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <?php echo $this->ckeditor->editor("desc",html_entity_decode(set_value('desc'))); ?> </div> 
  <div class="element"> 
    <label for="image">Posted Date </label> 
    <input type="text" name="date_time" id="date_time" class="text datepicker" value="<?php echo set_value('date_time'); ?>" /> 
  </div> 
  <div class="element"> 
    <label for="image">Image (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <input type="file" name="image" /> 
  </div> 
  <div class="element"> 
    <label for="attachment">File (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <input type="file" name="banner_image" /> 
  </div> 
  <div class="element"> 
    <label for="status">Status 
      <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input type="radio" name="status" value="Y" <?php echo set_radio('status', 'Y', TRUE); ?> /> 
    Enabled 
    <input type="radio" name="status" value="N" <?php echo set_radio('status', 'N'); ?> /> 
    Disabled </div> 
  <div class="entry"> 
    <button type="submit" class="add">Save</button> 
    <a class="button cancel" href="<?php echo site_url('admin/news/lists'); ?>">Cancel</a> </div> 
  <?php echo form_close(); ?> </div> 
