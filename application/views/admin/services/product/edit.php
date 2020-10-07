<div class="full_w"> 
  <div class="h_title">Edit Service</div> 
  <?php $cat=explode(",",$content->category_id); 
 echo form_open_multipart('admin/services/edit/'.$content->id.'/'.$return,array('id'=>'productfrm')); ?> 
  <input id="id" name="id" type="hidden" value="<?php echo $content->id; ?>" /> 
  <div class="element"> 
    <label for="category_id">Category 
      <?php if(form_error('category_id')){ $err=' err'; echo form_error('category_id'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <select name="category_id" id="category_id" class="text"> 
      <?php foreach($contentcats as $contentcat): ?> 
      <option value="<?php echo $contentcat['id']; ?>" <?php if(in_array($contentcat['id'],$cat)){ echo 'selected="selected"'; }?>><?php echo $contentcat['name']; ?></option> 
      <?php endforeach; ?> 
    </select> 
  </div>   
  <div class="element"> 
    <label for="title">Title (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('title')){ $err=' err'; echo form_error('title'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input id="title" name="title" type="text" class="text<?php echo $err; ?>" value="<?php echo  $content->title ; ?>" /> 
  </div> 
  <div class="element"> 
    <label for="slug">URL Slug (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('slug')){ $err=' err'; echo form_error('slug'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input id="slug" name="slug" type="text" class="text<?php echo $err; ?>" value="<?php echo $content->slug; ?>" /> 
  </div> 
  <div class="element"> 
    <label for="short_desc">Short Description (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('keywords')){ $err=' err'; echo form_error('short_desc'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <textarea id="short_desc" name="short_desc" type="text" class="textarea<?php echo $err; ?>"><?php echo $content->short_desc; ?></textarea> 
  </div> 
  <div class="element"> 
    <label for="title">Meta Title (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)  
    </label> 
    <input name="meta_title" type="text" class="text" value="<?php echo $content->meta_title; ?>" /> 
  </div> 
  <div class="element"> 
    <label for="meta_desc">Meta Description (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('meta_desc')){ $err=' err'; echo form_error('meta_desc'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <textarea id="meta_desc" name="meta_desc" type="text" class="textarea<?php echo $err; ?>"><?php echo $content->meta_desc; ?></textarea> 
  </div> 
  <div class="element"> 
    <label for="keywords">Keywords (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('keywords')){ $err=' err'; echo form_error('keywords'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <textarea id="keywords" name="keywords" type="text" class="textarea<?php echo $err; ?>"><?php echo $content->keywords; ?></textarea> 
  </div>
  <div class="element"> 
<label for="price">Price </label> 
<input id="price" name="price" type="text" class="text" value="<?php echo $content->price; ?>" /> 
</div>
  <div class="element"> 
    <label for="desc">Description  (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('desc')){ $err=' err'; echo form_error('desc'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <?php echo $this->ckeditor->editor("desc",$content->desc); ?> </div> 
  <div class="element"> 
    <label for="image">Image (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) - <?php echo $content->image; ?></label> 
    <input type="file" name="image" /> 
  </div> 
  <div class="element"> 
    <label for="attach_title">Banner Text (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <input id="attach_title" name="banner_text" type="text" class="text<?php echo $err; ?>" value="<?php echo $content->banner_text; ?>" /> 
  </div> 
  <div class="element"> 
    <label for="attachment"> Banner Image (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)  - <?php echo $content->banner_image; ?></label> 
    <input type="file" name="banner_image" /> 
  </div> 
  <div class="element"> 
    <label for="attachment">Icon - <?php echo $content->icon; ?></label> 
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
  <div class="element"> 
    <label for="featured">Featured 
      <?php if(form_error('featured')){ $err=' err'; echo form_error('featured'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input type="radio" name="featured" value="Y" <?php if($content->featured=='Y'){ echo 'checked="checked"';} ?> /> 
    Enabled 
    <input type="radio" name="featured" value="N" <?php if($content->featured=='N'){ echo 'checked="checked"';} ?> /> 
    Disabled </div> 
  <div class="entry"> 
    <button type="submit" class="add">Save</button> 
    <a class="button cancel" href="<?php echo site_url('admin/services/lists'); ?>">Cancel</a> </div> 
  <?php echo form_close(); ?> </div> 
