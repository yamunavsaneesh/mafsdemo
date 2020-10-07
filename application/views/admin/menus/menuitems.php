<?php 
$activearr=array('Y'=>'Active','N'=>'Inactive'); 
if($this->uri->segment(5)==""){ 
	$i=0; 
	$return=0; 
}else{ 
	$i=$this->uri->segment(5);  
	$return=$this->uri->segment(5);  
} 
?>
<div class="full_w">
    <div class="h_title">Manage Menu Items - <?php echo $menudetail->name; ?></div>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open('admin/menus/menuitemactions/'.$menudetail->id); ?>
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
                <th scope="col">Name</th>
                <th scope="col" style="width: 100px;">Sort Order <input style="padding:1px;" type="submit"
                        name="sortsave" value="Save" /></th>
                <th scope="col" style="width: 60px;">Status</th>
                <th scope="col" style="width: 30px;">Modify</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $menus; ?>
        </tbody>
    </table>
    <?php form_close(); ?>
    <div class="entry">
        <div class="sep"></div>
        <a class="button add" href="<?php echo site_url('admin/menus/menuitemadd/'.$menudetail->id); ?>">Add New Menu
            Item</a>
    </div>
</div>