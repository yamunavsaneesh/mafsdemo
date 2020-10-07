<div class="full_w">
    <div class="h_title">Edit Widget</div>
    <?php echo form_open('admin/widgets/edit/' . $widget->id . '/' . $return); ?>
    <input id="id" name="id" type="hidden" value="<?php echo $widget->id; ?>" />
    <div class="element">
        <label for="title">Title<?php if (form_error('title')) {$err = ' err';
    echo form_error('title');} else { $err = '';?><span> (required)</span><?php }?></label>
        <input id="title" name="title" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $widget->title; ?>" />
    </div>
    <div class="element">
        <label for="widget_type">Widget Position <?php if (form_error('widget_position')) {$err = ' err';
    echo form_error('widget_position');} else { $err = '';?><span> (required)</span><?php }?></label> 
        <select name="widget_position" id="widget_position" class="text">
            <option value="">Select</option>
            <?php foreach ($widget_types as $key => $val): ?>
            <option value="<?php echo $key; ?>"
                <?php if ($widget->widget_position == $key) {echo ' selected="selected"';}?>><?php echo $val; ?>
            </option>
            <?php endforeach;?>
        </select>
    </div> 
    <div class="element">
        <label for="widget_type">Widget Type <?php if (form_error('widget_type')) {$err = ' err';
    echo form_error('widget_type');} else { $err = '';?><span> (required)</span><?php }?></label>
        <select name="widget_type" id="widget_type" class="text">
            <option value="">Select</option>
            <?php foreach ($widget_type as $key => $val): ?>
            <option value="<?php echo $key; ?>"
                <?php if ($widget->widget_type == $key) {echo ' selected="selected"';}?>><?php echo $val; ?></option>
            <?php endforeach;?>
        </select>
    </div> 
    <div class="element">
        <label for="widget_type">Menu Widget <?php if (form_error('widget_parent')) {$err = ' err';
    echo form_error('widget_parent');} else { $err = '';?><span> (required)</span><?php }
//print_r($widget_submenus[0]); 
?></label>
        <?php
@$fldwid = explode(",", stripslashes($widget->parent_menu_id));
?>
        <select name="widget_parent[]" id="widget_parent" class="text" multiple="multiple">
            <option value="">Select</option>
            <?php 
foreach ($widget_submenu as $keys): 
    $flg = 0;
    foreach ($fldwid as $key) {
        if ($key == $keys['menuitems_id']) {
            ?>
            <option value="<?php echo $keys['menuitems_id']; ?>" selected><?php echo $keys['name']; ?></option>
            <?php
    $flg = 1;
        }
    }
    if ($flg == 0) { 
        ?>
            <option value="<?php echo $keys['menuitems_id']; ?>"><?php echo $keys['name']; ?></option>
            <?php
    }
endforeach;?>
        </select>
    </div> 
    <div class="element">
        <label for="widget_type">Content Widget <?php if (form_error('widget_parent')) {$err = ' err';
    echo form_error('widget_parent');} else { $err = '';?><span> (required)</span><?php } 
?></label>
        <select name="content_menu" id="content_menu" class="text">
            <option value="">Select</option>
            <?php 
foreach ($content_menu as $keys):
?>
            <option value="<?php echo $keys['content_category_id']; ?>"
                <?php if ($keys['content_category_id'] == $widget->content_category_id) {echo "selected=selected";}?>>
                <?php echo $keys['name']; ?></option>
            <?php endforeach;?>
        </select>
    </div> 
    <div class="element">
        <label for="key">Key<?php if (form_error('key')) {$err = ' err';
    echo form_error('key');} else { $err = '';?><span> (required)</span><?php }?></label>
        <input id="key" name="key" type="text" class="text<?php echo $err; ?>" value="<?php echo $widget->key; ?>" />
    </div>
    <div class="element">
        <label for="html">Html (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('html')) {$err = ' err';
    echo form_error('html');} else { $err = '';?><span> (required)</span><?php }?></label>
        <textarea style="width:100%;" rows="5" id="html" name="html"><?php echo $widget->html; ?></textarea>
    </div>
    <div class="element">
        <label for="status">Status <?php if (form_error('status')) {$err = ' err';
    echo form_error('status');} else { $err = '';?><span> (required)</span><?php }?></label>
        <input type="radio" name="status" value="Y" <?php if ($widget->status == 'Y') {echo 'checked="checked"';}?> />
        Enabled <input type="radio" name="status" value="N"
            <?php if ($widget->status == 'N') {echo 'checked="checked"';}?> /> Disabled
    </div>
    <div class="entry">
        <button type="submit" class="add">Save</button><a class="button cancel"
            href="<?php echo site_url('admin/widgets/lists'); ?>">Cancel</a>
    </div>
    <?php echo form_close(); ?>
</div>