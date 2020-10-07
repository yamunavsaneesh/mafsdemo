<?php 
$activearr=array('Y'=>'Active','N'=>'Inactive'); 
if($this->uri->segment(5)==""){ 
	$i=0; 
	$return=0; 
}else{ 
	$i=$this->uri->segment(5);  
	$return=$this->uri->segment(5);  
} 
//echo $this->uri->segment(3); 
?> 
<div class="full_w"> 
  <div class="h_title">Manage Downloads - List</div> 
  <?php echo $this->session->flashdata('message'); ?> <?php echo form_open('admin/downloads/actions'); ?> 
  <div class="entry"> 
    <input class="button" type="submit" name="enable" value="Enable"  /> 
    <input class="button" type="submit" name="disable" value="Disable"  /> 
    <input type="hidden" name="return" value="<?php echo $return; ?>" /> 
    <input class="button" type="submit" name="delete" value="Delete" onclick="return confirmDelete();" /> 
    <div style="float:right;"> Sort : 
      <select name="sortby" style="margin-right:5px;"> 
        <option value="">Select</option> 
        <?php foreach($downloadfields as $id => $key): ?> 
        <option value="<?php echo $id; ?>" <?php if($this->session->userdata('sort_field')==$id){ echo 'selected="selected"'; }?>><?php echo $key; ?></option> 
        <?php endforeach; ?> 
      </select> 
      <select name="orderby" style=" margin-right:5px;"> 
        <option value="">Select</option> 
        <?php foreach($sortorders as $id => $key): ?> 
        <option value="<?php echo $id; ?>" <?php if($this->session->userdata('order_field')==$id){ echo 'selected="selected"'; }?>><?php echo $key; ?></option> 
        <?php endforeach; ?> 
      </select> 
      Category : 
      <select name="category" style=" margin-right:5px;"> 
        <option value="">Select</option> 
        <?php foreach($downloadcats as $downloadcat): ?> 
        <option value="<?php echo $downloadcat['id']; ?>" <?php if($this->session->userdata('download_category_id')==$downloadcat['id']){ echo 'selected="selected"'; }?>><?php echo $downloadcat['name']; ?></option> 
        <?php endforeach; ?> 
      </select> 
      Search : 
      <input style="margin-right:5px;" type="text" name="keyword" value="<?php echo $this->session->userdata('download_key'); ?>" /> 
      <select name="field" style="margin-right:5px;"> 
        <?php foreach($downloadfields as $id => $key): ?> 
        <option value="<?php echo $id; ?>" <?php if($this->session->userdata('download_field')==$id){ echo 'selected="selected"'; }?>><?php echo $key; ?></option> 
        <?php endforeach; ?> 
      </select> 
      <input class="button" type="submit" name="search" value="Search" /> 
      <input class="button" type="submit" name="reset" value="Reset"  /> 
    </div> 
  </div> 
  <table> 
    <thead> 
      <tr> 
        <th scope="col" style="width: 20px;"><input type="checkbox" class="select_all" name="ids" id="ids" /></th> 
        <th scope="col" style="width: 20px;">ID</th> 
        <th scope="col">Title</th> 
        <th scope="col" style="width: 100px;">Sort Order 
          <input style="padding:1px;" type="submit" name="sortsave" value="Save" /></th> 
        <th scope="col">Status</th> 
        <th scope="col">Modify</th> 
      </tr> 
    </thead> 
    <tbody> 
      <?php  
		foreach($downloads as $download): ?> 
      <tr> 
        <td class="align-center"><input type="checkbox" name="id[]" class="chkbx" value="<?php echo $download['id']; ?>" /></td> 
        <td class="align-center"><?php echo ++$i; ?></td> 
        <td><?php echo $download['title']; ?></td> 
        <td align="center"><input style="text-align:center;" type="text" size="2" name="sort_order[<?php echo $download['id']; ?>]" value="<?php echo $download['sort_order']; ?>" /></td> 
        <td align="center"><?php echo $activearr[$download['status']]; ?></td> 
        <td><a href="<?php echo site_url('admin/downloads/edit/'.$download['id'].'/'.$this->uri->segment(4).'/'.$return); ?>" class="table-icon edit" title="Edit"></a> <a href="<?php echo site_url('admin/downloads/delete/'.$download['id'].'/'.$this->uri->segment(4).'/'.$return); ?>" class="table-icon delete" title="Delete" onclick="return confirmBox();"></a></td> 
      </tr> 
      <?php endforeach; ?> 
    </tbody> 
  </table> 
  <?php form_close(); ?> 
  <div class="entry"> 
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div> 
    <div class="sep"></div> 
    <a class="button add" href="<?php echo site_url('admin/downloads/add/'.$this->uri->segment(4)); ?>">Add New Download</a> </div> 
</div> 
