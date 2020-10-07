<?php echo form_open('admin/login/forgot'); ?> 
	<span class="validation_error"><?php echo form_error('login'); ?></span><label for="login">Username:</label> 
	<input id="login" name="login" class="text" /> 
	<button type="submit" class="ok">Reset</button> <a class="button" href="<?php echo site_url('admin/login'); ?>">Back to Login</a> 
<?php echo form_close(); ?> 
