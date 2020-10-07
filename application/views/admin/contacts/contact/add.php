<div class="full_w">
    <div class="h_title">Add New Contact</div>
    <?php echo form_open_multipart('admin/contacts/add'); ?>
    <div class="element">
        <label for="category_id">Category
            <?php if (form_error('category_id')) {$err = ' err';
    echo form_error('category_id');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <select name="category_id" id="category_id" class="text">
            <?php foreach ($contactcats as $contactcat): ?>
            <option value="<?php echo $contactcat['id']; ?>"><?php echo $contactcat['name']; ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="element">
        <label for="location">Location
            <?php if (form_error('location')) {$err = ' err';
    echo form_error('location');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <input id="location" name="location" type="text" class="text<?php echo $err; ?>"
            value="<?php echo set_value('location'); ?>" />
    </div>
    <div class="element">
        <label for="name">Address (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)
            <?php if (form_error('address')) {$err = ' err';
    echo form_error('address');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <?php echo $this->ckeditor->editor("address", html_entity_decode(set_value('address'))); ?>
    </div>
    <div class="element">
        <label for="latitude">Latitude
            <?php if (form_error('latitude')) {$err = ' err';
    echo form_error('latitude');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <input id="latitude" name="latitude" type="text" class="text<?php echo $err; ?>"
            value="<?php echo set_value('latitude'); ?>" />
    </div>
    <div class="element">
        <label for="longitude">Longitude
            <?php if (form_error('longitude')) {$err = ' err';
    echo form_error('longitude');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <input id="longitude" name="longitude" type="text" class="text<?php echo $err; ?>"
            value="<?php echo set_value('longitude'); ?>" />
    </div> 
   <div class="element">
        <label for="image">Image (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)</label>
        <input type="file" name="image" />
    </div>
    <div class="element">
        <label for="status">Status
            <?php if (form_error('status')) {$err = ' err';
    echo form_error('status');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <input type="radio" name="status" value="Y" <?php echo set_radio('status', 'Y', true); ?> />
        Enabled
        <input type="radio" name="status" value="N" <?php echo set_radio('status', 'N'); ?> />
        Disabled
    </div>
    <div class="entry">
        <button type="submit" class="add">Save</button>
        <a class="button cancel" href="<?php echo site_url('admin/contacts/lists'); ?>">Cancel</a>
    </div>
    <?php echo form_close(); ?>
</div>