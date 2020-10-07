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
  <div class="h_title">Manage Page Meta - List</div> 
  <?php echo $this->session->flashdata('message'); ?> <?php echo form_open('admin/pages/actions'); ?> 
  <div class="entry"> 
    <input class="button" type="submit" name="enable" value="Enable" /> 
    <input class="button" type="submit" name="disable" value="Disable" /> 
    <input class="button" type="submit" name="delete" value="Delete" onclick="return confirmDelete();" /> 
    <input type="hidden" name="return" value="<?php echo $return; ?>" /> 
  </div> 
  <table> 
    <thead> 
      <tr> 
        <th scope="col" style="width: 20px;"><input type="checkbox" class="select_all" name="ids" id="ids" /></th> 
        <th scope="col" style="width: 20px;">ID</th> 
        <th scope="col">Title</th> 
        <th scope="col">Short Description</th> 
        <th scope="col" style="width:200px;">Banner Image</th> 
        <th scope="col">Status</th> 
        <th scope="col">Modify</th> 
      </tr> 
    </thead> 
    <tbody> 
      <?php  
		foreach($pages as $page): ?> 
      <tr> 
        <td class="align-center"><input type="checkbox" class="chkbx" name="id[]" value="<?php echo $page['id']; ?>" /></td> 
        <td class="align-center"><?php echo ++$i; ?></td> 
        <td><?php echo substr($page['title'],0,100); ?></td> 
        <td><?php echo substr($page['short_desc'],0,100); ?></td> 
        <td align="center"><?php if ($page['banner_image']) { ?> 
                  <img src="<?php echo base_url('public/uploads/pages/'.$page['banner_image']); ?>" title="<?php echo $page['banner_image']; ?>" width="175" height="50" /> 
                  <?php } ?></td> 
        <td><?php echo $activearr[$page['status']]; ?></td> 
        <td><a href="<?php echo site_url('admin/pages/edit/'.$page['id'].'/'.$return); ?>" class="table-icon edit" title="Edit"></a> <a href="<?php echo site_url('admin/pages/delete/'.$page['id'].'/'.$return); ?>" class="table-icon delete" title="Delete" onclick="return confirmBox();"></a></td> 
      </tr> 
      <?php endforeach; ?> 
    </tbody> 
  </table> 
  <?php form_close(); ?> 
  <div class="entry"> 
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div> 
    <div class="sep"></div> 
    <a class="button add" href="<?php echo site_url('admin/pages/add'); ?>">Add New Page Meta</a> </div> 
</div> 
