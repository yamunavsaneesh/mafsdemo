<div class="full_w"> 
	<div class="h_title">Edit Menu</div>	 
	<?php echo form_open('admin/menus/edit/'.$menu->id.'/'.$return); ?> 
	<input id="id" name="id" type="hidden" value="<?php echo $menu->id; ?>" /> 
		<div class="element"> 
			<label for="name">Name <?php if(form_error('name')){ $err=' err'; echo form_error('name'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="name" name="name" type="text" class="text<?php echo $err; ?>" value="<?php echo $menu->name; ?>" /> 
		</div> 
		<div class="element"> 
			<label for="class">Class <?php if(form_error('class')){ $err=' err'; echo form_error('class'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="class" name="class" type="text" class="text<?php echo $err; ?>" value="<?php echo $menu->class; ?>" /> 
		</div> 
		<div class="element"> 
			<label for="code">Identifier <?php if(form_error('code')){ $err=' err'; echo form_error('code'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="code" name="code" type="text" class="text<?php echo $err; ?>" value="<?php echo $menu->code; ?>" /> 
		</div> 
		<div class="element"> 
			<label for="status">Status <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input type="radio" name="status" value="Y" <?php if($menu->status=='Y'){ echo 'checked="checked"';} ?> /> Enabled <input type="radio" name="status" value="N" <?php if($menu->status=='N'){ echo 'checked="checked"';} ?> /> Disabled 
		</div> 
		<div class="entry"> 
			<button type="submit" class="add">Save</button><a class="button cancel" href="<?php echo site_url('admin/menus/lists/'.$return); ?>">Cancel</a> 
		</div> 
	<?php echo form_close(); ?> 
</div>