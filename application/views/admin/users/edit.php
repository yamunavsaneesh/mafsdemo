<div class="full_w"> 
	<div class="h_title">Edit User</div>	 
	<?php echo form_open('admin/users/edit/'.$user->id.'/'.$return); ?> 
	<input id="id" name="id" type="hidden" value="<?php echo $user->id; ?>" />		 
		<div class="element"> 
			<label for="name">Name <?php if(form_error('name')){ $err=' err'; echo form_error('name'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="name" name="name" type="text" class="text<?php echo $err; ?>" value="<?php echo $user->name; ?>" /> 
		</div> 
		<div class="element"> 
			<label for="email">Email <?php if(form_error('email')){ $err=' err'; echo form_error('email'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="email" name="email" type="text" class="text<?php echo $err; ?>" value="<?php echo $user->email; ?>" /> 
		</div> 
          
		<div class="element"> 
			<label for="username">Username <?php if(form_error('username')){ $err=' err'; echo form_error('username'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input id="username" name="username" type="text" class="text<?php echo $err; ?>" value="<?php echo $user->username; ?>" /> 
		</div> 
        <div class="element"> 
			<label for="role">Role <?php if(form_error('roles_id')){ $err=' err'; echo form_error('roles_id'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<select name="roles_id" id="roles_id" class="text<?php echo $err; ?>"> 
            <option value="">-----------Select-----------</option> 
			<?php foreach($roles as $role): ?> 
				<option value="<?php echo $role['roles_id']; ?>" <?php if($user->roles_id==$role['roles_id']){ echo 'selected="selected"'; }?>><?php echo $role['role']; ?></option> 
			<?php endforeach; ?> 
			</select> 
		</div> 
		<div class="element"> 
			<label for="status">Status <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?><span> (required)</span><?php } ?></label> 
			<input type="radio" name="status" value="Y" <?php if($user->status=='Y'){ echo 'checked="checked"';} ?> /> Enabled <input type="radio" name="status" value="N" <?php if($user->status=='N'){ echo 'checked="checked"';} ?> /> Disabled 
		</div> 
		<div class="entry"> 
			<button type="submit" class="add">Save</button><a class="button cancel" href="<?php echo site_url('admin/users/lists/'.$return); ?>">Cancel</a> 
		</div> 
	<?php echo form_close(); ?> 
</div>