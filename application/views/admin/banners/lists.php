<?php
$activearr = array('Y' => 'Active', 'N' => 'Inactive');
if ($this->uri->segment(4) == "") {
    $i = 0;
    $return = 0;
} else {
    $i = $this->uri->segment(4);
    $return = $this->uri->segment(4);
}
?>
<div class="full_w">
    <div class="h_title">All Banners</div>
    <?php echo $this->session->flashdata('message'); ?> <?php echo form_open('admin/banners/actions'); ?>
    <div class="entry">
        <input class="button" type="submit" name="enable" value="Enable" />
        <input class="button" type="submit" name="disable" value="Disable" />
        <input class="button" type="submit" name="delete" value="Delete" onclick="return confirmDelete();" />
        <input type="hidden" name="return" value="<?php echo $return; ?>" />
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col" style="width: 20px;"><input type="checkbox" class="select_all" name="ids" id="ids" />
                </th>
                <th scope="col" style="width: 20px;">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Banner</th>
                <th scope="col" style="width: 100px;">Sort Order
                    <input style="padding:1px;" type="submit" name="sortsave" value="Save" />
                </th>
                <th scope="col">Status</th>
                <th scope="col">Modify</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($banners as $banner): ?>
            <tr>
                <td class="align-center"><input type="checkbox" class="chkbx" name="id[]"
                        value="<?php echo $banner['id']; ?>" /></td>
                <td class="align-center"><?php echo ++$i; ?></td>
                <td align="left"><?php echo $banner['title']; ?></td>
                <td align="left">
                    <?php if ($banner['image'] != '' && file_exists('public/uploads/banners/' . $banner['image'])) {?>
                    <a href="<?php echo base_url('public/uploads/banners/' . $banner['image']); ?>" class="fancybox"
                        rel="banner"> <img src="<?php echo base_url('public/uploads/banners/' . $banner['image']); ?>"
                            title="<?php echo $banner['image']; ?>" height="100" /></a>
                    <?php }?>
                </td>
                <td align="center"><input style="text-align:center;" type="text" size="2"
                        name="sort_order[<?php echo $banner['id']; ?>]" value="<?php echo $banner['sort_order']; ?>" />
                </td>
                <td align="center"><?php echo $activearr[$banner['status']]; ?></td>
                <td><a href="<?php echo site_url('admin/banners/edit/' . $banner['id'] . '/' . $return); ?>"
                        class="table-icon edit" title="Edit"></a> <a
                        href="<?php echo site_url('admin/banners/delete/' . $banner['id'] . '/' . $return); ?>"
                        class="table-icon delete" title="Delete" onclick="return confirmBox();"></a></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php form_close();?>
    <div class="entry">
        <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
        <div class="sep"></div>
        <a class="button add" href="<?php echo site_url('admin/banners/add'); ?>">Add New Banner</a>
    </div>
</div>