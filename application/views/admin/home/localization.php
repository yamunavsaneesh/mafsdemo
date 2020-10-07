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
  <div class="h_title">Manage Localization - List</div> 
  <?php echo $this->session->flashdata('message'); ?> <?php echo form_open('admin/home/localizationactions'); ?> 
  <div class="entry"> 
    <div style="float:right;width:80%;">Search : 
      <input style="margin-right:10px;width:50%;" type="text" name="keyword" value="<?php echo $this->session->userdata('localization_key'); ?>" /> 
      <input class="button" type="submit" name="search" value="Search" /> 
      <input class="button" type="submit" name="reset" value="Reset" /> 
      <a href="admin/home/addlocalization" class="button add"> Add </a> </div> 
    <input class="button" type="submit" name="save" value="Save" /> 
    <input type="hidden" name="return" value="<?php echo $return; ?>" /> 
  </div> 
  <table> 
    <thead> 
      <tr> 
        <th scope="col" style="width: 20px;">ID</th> 
        <th scope="col" style="width:35%;">Key</th> 
        <th scope="col">Value (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</th> 
      </tr> 
    </thead> 
    <tbody> 
      <?php  
		foreach($localization as $localizationitem): ?> 
      <tr> 
        <td class="align-center"><?php echo ++$i; ?></td> 
        <td><?php echo $localizationitem['lang_key']; ?></td> 
        <td><textarea style="width:98%;" name="lang_value[<?php echo $localizationitem['id']; ?>]"><?php echo $localizationitem['lang_value']; ?></textarea></td> 
      </tr> 
      <?php endforeach; ?> 
    </tbody> 
  </table> 
  <div class="entry"> 
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div> 
    <div class="sep"></div> 
    <input class="button" type="submit" name="save" value="Save" /> 
  </div> 
  <?php form_close(); ?> 
</div> 
