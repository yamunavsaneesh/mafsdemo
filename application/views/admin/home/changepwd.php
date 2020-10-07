<div class="full_w"> 
	<div class="h_title">Change Password</div>	 
	<?php echo form_open('admin/home/changepwd/'); ?> 
		<div class="element"> 
			<label for="passold">Old Password <?php if(form_error('passold')){ $err=' err'; echo form_error('passold'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="passold" name="passold" type="password" class="text<?php echo $err; ?>" value="" /> 
		</div> 
		<div class="element"> 
			<label for="pass">Password <?php if(form_error('pass')){ $err=' err'; echo form_error('pass'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="pass" name="pass" type="password" class="text<?php echo $err; ?>" value="" /> 
		</div> 
		<div class="element"> 
			<label for="passconf">Confirm Password <?php if(form_error('passconf')){ $err=' err'; echo form_error('passconf'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="passconf" name="passconf" type="password" class="text<?php echo $err; ?>" value="" /> 
		</div> 
		<div class="entry"> 
			<button type="submit" class="add">Save</button><a class="button cancel" href="<?php echo site_url('admin/home/'); ?>">Cancel</a> 
		</div> 
	<?php echo form_close(); ?> 
</div>