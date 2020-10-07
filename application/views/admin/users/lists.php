<div class="full_w"> 
  <div class="h_title">Manage Users - List</div> 
  <?php echo $this->session->flashdata('message'); ?> 
  <table> 
    <thead> 
      <tr> 
        <th scope="col" style="width: 20px;">ID</th> 
        <th scope="col">Name</th> 
        <th scope="col">Email</th> 
        <th scope="col">Username</th> 
        <th scope="col">Role</th> 
        <th scope="col">Status</th> 
        <th scope="col">Modify</th> 
      </tr> 
    </thead> 
    <tbody> 
      <?php  
		$activearr=array('Y'=>'Active','N'=>'Inactive'); 
		if($this->uri->segment(4)==""){ 
			$i=0; 
			$return=0; 
		}else{ 
		 	$i=$this->uri->segment(4);  
			$return=$this->uri->segment(4);  
		}		 
		foreach($users as $user): ?> 
      <tr> 
        <td class="align-center"><?php echo ++$i; ?></td> 
        <td><?php echo $user['name']; ?></td> 
        <td><?php echo $user['email']; ?></td> 
        <td><?php echo $user['username']; ?></td> 
        <td><?php echo $user['role']; ?></td>         
        <td><?php echo $activearr[$user['status']]; ?></td> 
        <td><a href="<?php echo site_url('admin/users/edit/'.$user['id'].'/'.$return); ?>" class="table-icon edit" title="Edit"></a> 
          <?php if(count($users)>0){ ?> 
          <a href="<?php echo site_url('admin/users/delete/'.$user['id'].'/'.$return); ?>" class="table-icon delete" title="Delete" onclick="return confirmBox();"></a> 
          <?php } ?> 
          <?php if($user['id']!=$this->session->userdata('admin_id')){ ?> 
          <a href="<?php echo site_url('admin/users/changepwd/'.$user['id'].'/'.$return); ?>" class="table-icon edit" title="Change Password"></a> 
          <?php } else { ?> 
          <a href="<?php echo site_url('admin/home/changepwd/'); ?>" class="table-icon edit" title="Change Password"></a> 
          <?php } ?></td> 
      </tr> 
      <?php endforeach; ?> 
    </tbody> 
  </table> 
  <div class="entry"> 
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div> 
    <div class="sep"></div> 
    <a class="button add" href="<?php echo site_url('admin/users/add'); ?>">Add New User</a> </div> 
</div> 
