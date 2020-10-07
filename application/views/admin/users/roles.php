<div class="full_w"> 
  <div class="h_title">Manage Roles - List</div> 
  <?php echo $this->session->flashdata('message'); ?> 
  <table> 
    <thead> 
      <tr> 
        <th scope="col" style="width: 20px;">ID</th> 
        <th scope="col">Role</th> 
      </tr> 
    </thead> 
    <tbody> 
      <?php $i=0;foreach($roles as $role): ?> 
      <tr> 
        <td class="align-center"><?php echo ++$i; ?></td> 
        <td><?php echo $role['role']; ?></td> 
      </tr> 
      <?php endforeach; ?> 
    </tbody> 
  </table> 
</div>