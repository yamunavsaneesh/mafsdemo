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
  <div class="h_title">Manage Widgets - List</div> 
  <?php echo $this->session->flashdata('message'); ?> <?php echo form_open('admin/widgets/actions'); ?> 
  <div class="entry"> 
    <input class="button" type="submit" name="enable" value="Enable"  style="width:65px;" /> 
    <input class="button" type="submit" name="disable" value="Disable" style="width:65px;"  /> 
    <input type="hidden" name="return" value="<?php echo $return; ?>" /> 
    <div style="float:right;"> Sort : 
      <select name="sortby" style="margin-right:5px;"> 
        <option value="">Select</option> 
        <?php foreach($widgetfields as $id => $key): ?> 
        <option value="<?php echo $id; ?>" <?php if($this->session->userdata('sort_field')==$id){ echo 'selected="selected"'; }?>><?php echo $key; ?></option> 
        <?php endforeach; ?> 
      </select> 
      <select name="orderby" style=" margin-right:5px;"> 
        <option value="">Select</option> 
        <?php foreach($sortorders as $id => $key): ?> 
        <option value="<?php echo $id; ?>" <?php if($this->session->userdata('order_field')==$id){ echo 'selected="selected"'; }?>><?php echo $key; ?></option> 
        <?php endforeach; ?> 
      </select> 
      Widget Type : 
      <select name="widget_type" style=" margin-right:5px;"> 
        <option value="">Select</option> 
        <?php foreach($widget_types as $key => $val):  ?> 
        <option value="<?php echo $key; ?>" <?php if($this->session->userdata('widget_type_key')==$key){ echo 'selected="selected"'; }?>><?php echo $val; ?></option> 
        <?php endforeach; ?> 
      </select> 
      Search : 
      <input style="margin-right:5px;" type="text" name="keyword" value="<?php echo $this->session->userdata('widget_key'); ?>" /> 
      <select name="field" style="margin-right:5px;"> 
        <?php foreach($widgetfields as $id => $key): ?> 
        <option value="<?php echo $id; ?>" <?php if($this->session->userdata('widget_field')==$id){ echo 'selected="selected"'; }?>><?php echo $key; ?></option> 
        <?php endforeach; ?> 
      </select> 
      <input class="button" type="submit" name="search" value="Search"  style="width:65px;"/> 
      <input class="button" type="submit" name="reset" value="Reset"  style="width:65px;" /> 
    </div> 
  </div> 
  <table> 
    <thead> 
      <tr> 
        <th scope="col" style="width: 20px;"><input type="checkbox" class="select_all" name="ids" id="ids" /></th> 
        <th scope="col" style="width: 20px;">ID</th> 
        <th scope="col">Title</th> 
        <th scope="col">Key</th> 
        <th scope="col" style="width: 100px;">Sort Order 
          <input style="padding:1px;" type="submit" name="sortsave" value="Save" /></th> 
        <th scope="col">Status</th> 
        <th scope="col" style="width: 20px;">Modify</th> 
      </tr> 
    </thead> 
    <tbody> 
      <?php  
		foreach($widgets as $widget): ?> 
      <tr> 
        <td class="align-center"><input type="checkbox" name="id[]" class="chkbx" value="<?php echo $widget['id']; ?>" /></td> 
        <td class="align-center"><?php echo ++$i; ?></td> 
        <td><?php echo $widget['title']; ?></td> 
        <td><?php echo $widget['key']; ?></td> 
        <td align="center"><input style="text-align:center;" type="text" size="2" name="sort_order[<?php echo $widget['id']; ?>]" value="<?php echo $widget['sort_order']; ?>" /></td> 
        <td><?php echo $activearr[$widget['status']]; ?></td> 
        <td><a href="<?php echo site_url('admin/widgets/edit/'.$widget['id'].'/'.$return); ?>" class="table-icon edit" title="Edit"></a></td> 
      </tr> 
      <?php endforeach; ?> 
    </tbody> 
  </table> 
  <?php form_close(); ?> 
  <div class="entry"> 
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div> 
    <div class="sep"></div> 
    <a class="button add" href="<?php echo site_url('admin/widgets/add'); ?>">Add New Widget</a> </div> 
</div> 
