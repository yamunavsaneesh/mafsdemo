<div class="full_w"> 
	<div class="h_title">Edit Download Category</div>	 
	<?php echo form_open('admin/downloads/editcategory/'.$download->id.'/'.$return); ?> 
	<input id="id" name="id" type="hidden" value="<?php echo $download->id; ?>" />		 
		<div class="element"> 
			<label for="name">Name (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) <?php if(form_error('name')){ $err=' err'; echo form_error('name'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="name" name="name" type="text" class="text<?php echo $err; ?>" value="<?php echo $download->name; ?>" /> 
		</div> 
		<div class="element"> 
			<label for="status">Status <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input type="radio" name="status" value="Y" <?php if($download->status=='Y'){ echo 'checked="checked"';} ?> /> Enabled <input type="radio" name="status" value="N" <?php if($download->status=='N'){ echo 'checked="checked"';} ?> /> Disabled 
		</div> 
		<div class="entry"> 
			<button type="submit" class="add">Save</button><a class="button cancel" href="<?php echo site_url('admin/downloads/categories/'.$return); ?>">Cancel</a> 
		</div> 
	<?php echo form_close(); ?> 
</div>