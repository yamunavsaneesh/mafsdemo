<div class="full_w"> 
	<div class="h_title">Add New Widgets</div>	 
	<?php echo form_open('admin/widgets/add'); ?>		 
		<div class="element"> 
			<label for="title">Title<?php if(form_error('title')){ $err=' err'; echo form_error('title'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="title" name="title" type="text" class="text<?php echo $err; ?>" value="<?php echo set_value('title'); ?>" /> 
		</div> 
		<div class="element"> 
			<label for="widget_type">Widget Position <?php if(form_error('widget_position')){ $err=' err'; echo form_error('widget_position'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<select name="widget_position" id="widget_position" class="text"> 
			<option value="">Select</option> 
			<?php foreach($widget_position as $key => $val): ?> 
				<option value="<?php echo $key; ?>" <?php echo set_select('widget_position', $key); ?>><?php echo $val; ?></option> 
			<?php endforeach; ?> 
			</select> 
		</div>	 
        <div class="element"> 
			<label for="widget_type">Widget Type <?php if(form_error('widget_type')){ $err=' err'; echo form_error('widget_type'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<select name="widget_type" id="widget_type" class="text"> 
			<option value="">Select</option> 
			<?php foreach($widget_type as $key => $val): ?> 
				<option value="<?php echo $key; ?>" <?php echo set_select('widget_type', $key); ?>><?php echo $val; ?></option> 
			<?php endforeach; ?> 
			</select> 
		</div>	 
         
         <div class="element"> 
			<label for="widget_type">Menu Widget <?php if(form_error('widget_parent')){ $err=' err'; echo form_error('widget_parent'); } else { $err=''; ?><span> (required)</span><?php }  
			//print_r($widget_submenus[0]);	 
			 
			?></label> 
			<select name="widget_parent[]" id="widget_parent" class="text" multiple="multiple"> 
			<option value="">Select</option> 
			<?php  
			 
					foreach($widget_submenu as $keys):  
					 
					 
			?> 
				<option value="<?php echo $keys['menuitems_id']; ?>" <?php echo set_select('parent_menu_id', $keys); ?>><?php echo $keys['name']; ?></option> 
                 
			<?php endforeach;  ?> 
			</select> 
		</div>	 
         
         <div class="element"> 
			<label for="widget_type">Content Widget <?php if(form_error('widget_parent')){ $err=' err'; echo form_error('widget_parent'); } else { $err=''; ?><span> (required)</span><?php }  
			 
			?></label> 
			<select name="content_menu" id="content_menu" class="text" > 
			<option value="">Select</option> 
			<?php  
			 
					foreach($content_menu as $keys):  
			?> 
				<option value="<?php echo $keys['content_category_id']; ?>" <?php echo set_select('content_category_id', $keys); ?>><?php echo $keys['name']; ?></option> 
			<?php endforeach;  ?> 
			</select> 
		</div>	 
        <div class="element"> 
			<label for="key">Key<?php if(form_error('key')){ $err=' err'; echo form_error('key'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="key" name="key" type="text" class="text<?php echo $err; ?>" value="<?php echo set_value('key'); ?>" /> 
		</div> 
        <div class="element"> 
			<label for="html">Html (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)<?php if(form_error('html')){ $err=' err'; echo form_error('html'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<textarea style="width:100%;" rows="5" id="html" name="html" ><?php echo set_value('html'); ?></textarea> 
		</div>	 
		<div class="element"> 
			<label for="status">Status <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input type="radio" name="status" value="Y" <?php echo set_radio('status', 'Y', TRUE); ?> /> Enabled <input type="radio" name="status" value="N" <?php echo set_radio('status', 'N'); ?> /> Disabled 
		</div> 
		<div class="entry"> 
			<button type="submit" class="add">Save</button><a class="button cancel" href="<?php echo site_url('admin/widgets/lists'); ?>">Cancel</a> 
		</div> 
	<?php echo form_close(); ?> 
</div>