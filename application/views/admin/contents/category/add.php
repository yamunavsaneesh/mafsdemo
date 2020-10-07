<div class="full_w">
    <div class="h_title">Add New Content Category</div>
    <?php echo form_open_multipart('admin/contents/addcategory'); ?>
    <div class="element">
        <label for="parent_id">Parent Category
            <?php if (form_error('parent_id')) {$err = ' err';
    echo form_error('parent_id');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <select name="parent_id" id="parent_id" class="text">
            <option value="0"><?php echo 'Root Category'; ?></option>
            <?php foreach ($contentcats as $contentcat): ?>
            <option value="<?php echo $contentcat['id']; ?>"><?php echo $contentcat['name']; ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="element">
        <label for="name">Name (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)
            <?php if (form_error('name')) {$err = ' err';
    echo form_error('name');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <input id="name" name="name" type="text" class="text<?php echo $err; ?>"
            value="<?php echo set_value('name'); ?>" />
    </div>
    <div class="element">
        <label for="short_desc">Short Description
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)
            <?php if (form_error('short_desc')) {$err = ' err';
    echo form_error('short_desc');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <textarea id="short_desc" name="short_desc" type="text"
            class="text<?php echo $err; ?>"><?php echo set_value('short_desc'); ?></textarea>
    </div>
    <div class="element">
        <label for="keywords">Keywords (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)
            <?php if (form_error('keywords')) {$err = ' err';
    echo form_error('keywords');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <input id="keywords" name="keywords" type="text" class="text<?php echo $err; ?>"
            value="<?php echo set_value('keywords'); ?>" />
    </div>
    <div class="element">
        <label for="image">Image (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)</label>
        <input type="file" name="image" />
    </div>
    <div class="element">
        <label for="breadcrumb_status">Breadcrumb Status
            <?php if (form_error('breadcrumb_status')) {$err = ' err';
    echo form_error('breadcrumb_status');} else { $err = '';?>
            <span> (required)</span>
            <?php }?>
        </label>
        <input type="radio" name="breadcrumb_status" value="Y"
            <?php echo set_radio('breadcrumb_status', 'Y', true); ?> />
        Enabled
        <input type="radio" name="breadcrumb_status" value="N" <?php echo set_radio('breadcrumb_status', 'N'); ?> />
        Disabled
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
        <a class="button cancel" href="<?php echo site_url('admin/contents/categories'); ?>">Cancel</a>
    </div>
    <?php echo form_close(); ?>
</div>