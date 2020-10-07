<div class="full_w"> 
  <div class="h_title">Edit page</div> 
  <?php echo form_open_multipart('admin/pages/edit/'.$page->id.'/'.$return); ?> 
  <input id="id" name="id" type="hidden" value="<?php echo $page->id; ?>" /> 
  <div class="element"> 
    <label for="title">Title (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('title')){ $err=' err'; echo form_error('title'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input id="title" name="title" type="text" class="text<?php echo $err; ?>" value="<?php echo $page->title; ?>" /> 
  </div> 
  <div class="element"> 
    <label for="meta_title">Meta Title </label> 
    <input name="meta_title" type="text" class="text" value="<?php echo $page->meta_title; ?>" /> 
  </div> 
  <div class="element"> 
    <label for="key">Key 
      <?php if(form_error('key')){ $err=' err'; echo form_error('key'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input id="key" name="key" type="text" class="text<?php echo $err; ?>" value="<?php echo $page->key; ?>" /> 
  </div> 
  <div class="element"> 
    <label for="short_desc">Short Description (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <textarea id="short_desc" name="short_desc" type="text" class="textarea<?php echo $err; ?>"><?php echo $page->short_desc; ?></textarea> 
  </div> 
  <div class="element"> 
    <label for="keywords">Keywords (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('keywords')){ $err=' err'; echo form_error('keywords'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <textarea id="keywords" name="keywords" type="text" class="textarea<?php echo $err; ?>"><?php echo $page->keywords; ?></textarea> 
  </div> 
  <div class="element"> 
    <label for="desc">Description (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('desc')){ $err=' err'; echo form_error('desc'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <?php echo $this->ckeditor->editor("desc",$page->desc); ?> </div> 
  <div class="element"> 
    <label for="attach_title">Banner Text (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <input id="attach_title" name="banner_text" type="text" class="text<?php echo $err; ?>" value="<?php echo $page->banner_text; ?>" /> 
  </div> 
  <div class="element"> 
    <label for="attachment">Banner Image (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)  - <?php echo $page->banner_image; ?></label> 
    <input type="file" name="banner_image" /> 
  </div> 
  <div class="element"> 
    <label for="status">Status 
      <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input type="radio" name="status" value="Y" <?php if($page->status=='Y'){ echo 'checked="checked"';} ?> /> 
    Enabled 
    <input type="radio" name="status" value="N" <?php if($page->status=='N'){ echo 'checked="checked"';} ?> /> 
    Disabled </div> 
  <div class="entry"> 
    <button type="submit" class="add">Save</button> 
    <a class="button cancel" href="<?php echo site_url('admin/pages/lists'); ?>">Cancel</a> </div> 
  <?php echo form_close(); ?> </div> 
