<div class="full_w">
    <div class="h_title">Manage Client</div>
    <?php echo form_open_multipart('admin/clients/'.(isset($content->id)?'edit/'.$content->id:'add').'/'.(isset($return)?$return:'')); ?>
    <input id="id" name="id" type="hidden" value="<?php echo isset($content->id)?$content->id:'';  ?>" />
    <div class="element">
        <label for="title">Title
            <?php if(form_error('title')){ $err=' err'; echo form_error('title'); } else { $err=''; ?>
            <span> (required)</span>
            <?php } ?>
        </label>
        <input id="title" name="title" type="text" class="text<?php echo $err; ?>"
            value="<?php echo isset($content->title)?$content->title:set_value('title'); ?>" />
    </div>
    <?php if(isset($content->slug)){?>
    <div class="element">
        <label for="slug">URL Slug
            <?php if(form_error('slug')){ $err=' err'; echo form_error('slug'); } else { $err=''; ?>
            <span> (required)</span>
            <?php } ?>
        </label>
        <input id="slug" name="slug" type="text" class="text<?php echo $err; ?>"
            value="<?php echo isset($content->slug)?$content->slug:set_value('slug'); ?>" />
    </div>
    <?php }?>
    <div class="element">
        <label for="image">Image - <?php echo isset($content->image)?$content->image:''; ?></label>
        <input type="file" name="image" />
    </div>
    <div class="element">
        <label for="status">Status
            <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?>
            <span> (required)</span>
            <?php } ?>
        </label>
        <input type="radio" name="status" value="Y"
            <?php echo isset($content->status) ? ($content->status=='Y'?'checked="checked"':''): ''; ?> />
        Enable
        <input type="radio" name="status" value="N"
            <?php echo isset($content->status) ? ($content->status=='N'?'checked="checked"':''): ''; ?> />
        Disable
    </div>
    <div class="element">
        <button type="submit" class="add">Save</button>
        <a class="button cancel" href="<?php echo site_url('admin/clients/lists'); ?>">Cancel</a>
    </div>
    <?php echo form_close(); ?>
</div>