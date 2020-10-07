<div class="full_w"> 
	<div class="h_title">Add New Gallery</div>	 
	<?php echo form_open_multipart('admin/gallery/add'); ?> 
		<div class="element"> 
			<label for="category">Category <?php if(form_error('category_id')){ $err=' err'; echo form_error('category_id'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<select name="category_id" id="category_id" class="text"> 
			<option value="">Select</option> 
			<?php foreach($categories as $category): ?> 
				<option value="<?php echo $category['id']; ?>" <?php if(set_value('category_id')==$category['id']){echo ' selected="selected"';} ?>><?php echo $category['title']; ?></option> 
			<?php endforeach; ?> 
			</select> 
		</div> 
		<div class="element"> 
			<label for="title">Title (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)<?php if(form_error('title')){ $err=' err'; echo form_error('title'); } else  $err='';  ?></label> 
			<input id="title" name="title" type="text" class="text<?php echo $err; ?>" value="<?php echo set_value('title'); ?>" /> 
		</div>		 
		<div class="element"> 
			<label for="image">Image (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
			<input type="file" name="image[]" multiple="multiple" /> 
		</div>		 
           <!--<label for="image">Upload Multiple Images</label> 
      <input type="file" name="images[]"  multiple="multiple"/>--> 
		<div class="element"> 
			<label for="status">Status <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input type="radio" name="status" value="Y" <?php echo set_radio('status', 'Y', TRUE); ?> /> Enabled <input type="radio" name="status" value="N" <?php echo set_radio('status', 'N'); ?> /> Disabled 
		</div> 
		<div class="entry"> 
			<button type="submit" class="add">Save</button><a class="button cancel" href="<?php echo site_url('admin/gallery/lists'); ?>">Cancel</a> 
		</div> 
	<?php echo form_close(); ?> 
</div>