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
	<div class="h_title">Manage Languages - List</div> 
	<?php echo $this->session->flashdata('message'); ?> 
	<?php echo form_open('admin/languages/actions'); ?> 
	<div class="entry"> 
			<input class="button" type="submit" name="enable" value="Enable" /><input class="button" type="submit" name="disable" value="Disable" /> 
			<input type="hidden" name="return" value="<?php echo $return; ?>" /> 
	</div> 
	<table> 
		<thead> 
			<tr> 
				<th scope="col" style="width: 20px;"><input type="checkbox" class="select_all" name="ids" id="ids" /></th> 
				<th scope="col" style="width: 20px;">ID</th> 
				<th scope="col">Name</th> 
				<th scope="col">Code</th> 
				<th scope="col">Status</th> 
				<th scope="col" style="width: 20px;">Modify</th> 
			</tr> 
		</thead> 
			 
		<tbody> 
		<?php 				 
		foreach($languages as $language): ?> 
			<tr> 
				<td class="align-center"><input type="checkbox" name="id[]" value="<?php echo $language['id']; ?>" /></td> 
				<td class="align-center"><?php echo ++$i; ?></td> 
				<td><?php echo $language['name']; ?></td> 
				<td><?php echo $language['code']; ?></td> 
				<td><?php echo $activearr[$language['status']]; ?></td> 
				<td> 
					<a href="<?php echo site_url('admin/languages/edit/'.$language['id'].'/'.$return); ?>" class="table-icon edit" title="Edit"></a> 
					<?php if(count($languages)>1){ ?> 
					<a href="<?php echo site_url('admin/languages/delete/'.$language['id'].'/'.$return); ?>" class="table-icon delete" title="Delete" onclick="return confirmBox();"></a> 
					<?php } ?> 
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
		<a class="button add" href="<?php echo site_url('admin/languages/add'); ?>">Add New Language</a> 
	</div> 
</div> 
