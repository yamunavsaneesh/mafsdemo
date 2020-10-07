<?php 
$activearr = array('Y' => 'i_ok.png', 'N' => 'i_delete.png'); 
if ($this->uri->segment(6) == "") {
    $i = 0;
    $return = 0; 
} else {
    $i = $this->uri->segment(6);
    $return = $this->uri->segment(6); 
} 
?> 
<div class="full_w">
    <div class="h_title">Manage Clients</div>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open_multipart('admin/clients/lists/' . $return, array('id' => 'galleryform')); ?>
    <div class="entry element">
        <div>
            <label for="image">Upload Multiple Images</label>
            <input type="file" name="images[]" multiple="multiple" />
            &nbsp;&nbsp;
            <button type="submit" name="upload" class="add">Upload</button>
        </div>
    </div>
    <div class="entry">
        <div class="button">
            <label class="selectall">
                <input type="checkbox" class="select_all" name="ids" id="ids" />
                Select All</label>
        </div>
        <input class="button" type="submit" name="enable" value="Enable" />
        <input class="button" type="submit" name="disable" value="Disable" />
        <input class="button" type="submit" name="delete" value="Delete" onclick="return confirmDelete();" />
        <input type="hidden" name="return" value="<?php echo $return; ?>" />
        <button type="submit" name="sortsave" class="save">Save Sort Order</button>
    </div>
    <ul class="image-list">
        <?php if ($images) {
    foreach ($images as $image): ?>
        <li>
            <input type="checkbox" class="chkbx left" name="id[]" value="<?php echo $image['id']; ?>" />
            <img src="<?php echo base_url('public/admin/img/' . $activearr[$image['status']]); ?>" class="right" />
            <?php if (file_exists('public/uploads/clients/' . $image['image'])) {?>
            <a href="<?php echo base_url('public/uploads/clients/' . $image['image']); ?>" class="lightbox"
                rel="images">
                <div class="gallery-img"
                    style="background:url('<?php echo base_url('public/uploads/clients/' . $image['image']); ?>') no-repeat center">
                </div>
            </a>
            <div>
                <input id="sort_order" name="sort_order[<?php echo $image['id']; ?>]" type="text" class="small"
                    value="<?php echo $image['sort_order']; ?>" />
            </div>
            <?php }     ?>
        </li>
        <?php endforeach;} else {echo '<h4 class="heading">No Images</h4>';}?>
    </ul>
    <div class="clear"></div>
    <?php form_close();?>
    <div class="entry">
        <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
        <div class="sep"></div>
    </div> 
</div>