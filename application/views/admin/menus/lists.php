<?php 
$activearr=array('Y'=>'Active','N'=>'Inactive'); 
if($this->uri->segment(4)==""){ 
	$i=0; 
	$return=0; 
}else{ 
	$i=$this->uri->segment(4);  
	$return=$this->uri->segment(4);  
} 
?>
<div class="full_w">
    <div class="h_title">Manage Menus - List</div>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open('admin/menus/actions'); ?>
    <div class="entry">
        <input class="button" type="submit" name="enable" value="Enable" /><input class="button" type="submit"
            name="disable" value="Disable" />
        <input type="hidden" name="return" value="<?php echo $return; ?>" />
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col" style="width: 20px;"><input type="checkbox" class="select_all" name="ids" id="ids" />
                </th>
                <th scope="col" style="width: 20px;">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col" style="width: 100px;">Status</th>
                <th scope="col">Modify</th>
            </tr>
        </thead>
        <tbody>
            <?php  
		foreach($menus as $menu): ?>
            <tr>
                <td class="align-center"><input type="checkbox" name="id[]" value="<?php echo $menu['id']; ?>" /></td>
                <td class="align-center"><?php echo ++$i; ?></td>
                <td><?php echo $menu['name']; ?></td>
                <td><?php echo $menu['code']; ?></td>
                <td><?php echo $activearr[$menu['status']]; ?></td>
                <td>
                    <a href="<?php echo site_url('admin/menus/edit/'.$menu['id'].'/'.$return); ?>"
                        class="table-icon edit" title="Edit"></a>
                    <a href="<?php echo site_url('admin/menus/menuitems/'.$menu['id'].'/'.$return); ?>"
                        class="table-icon menuitems" title="Menuitems"></a>
                    <a href="<?php echo site_url('admin/menus/delete/'.$menu['id'].'/'.$return); ?>"
                        class="table-icon delete" title="Delete" onclick="return confirmBox();"></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php form_close(); ?>
    <div class="entry">
        <div class="pagination">
            <?php echo $this->pagination->create_links(); ?>
        </div>
        <div class="sep"></div>
        <a class="button add" href="<?php echo site_url('admin/menus/add'); ?>">Add New Menu</a>
    </div>
</div>