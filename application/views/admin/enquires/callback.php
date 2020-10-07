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
  <div class="h_title">All Enquiries </div>
  <?php echo $this->session->flashdata('message'); ?> <?php echo form_open('admin/enquiry/actions'); ?>  
  <table>
    <thead>
      <tr> 
        <th scope="col" style="width: 20px;">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th> 
        <th scope="col">Subject</th>
        <th scope="col">Message</th>
        <th scope="col">Enquiry Date</th>
        <th scope="col" nowrap> Referrer URL</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
		foreach($enquiries as $enquiry): ?>
      <tr>
         
        <td class="align-center"><?php echo ++$i; ?></td>
        <td align="left" nowrap="nowrap"><?php echo $enquiry['enq_name']; ?></td>
        <td align="left" nowrap="nowrap"><a href="mailto:<?php echo $enquiry['enq_email']; ?>"><?php echo $enquiry['enq_email']; ?></a></td>
        <td align="left" nowrap="nowrap"><?php echo $enquiry['enq_phone']; ?></td> 
        <td align="left" nowrap="nowrap"><?php echo $enquiry['enq_subject']; ?></td>
        <td align="left"><?php echo nl2br($enquiry['enq_message']); ?></td>
        <td align="left" nowrap="nowrap"><?php echo date('d-m-Y h:i A',strtotime($enquiry['added_on']));?></td> 
        <td align="left"><a href="<?php echo $enquiry['refererurl'] ?>" target="_blank">View</a></td>
        <td nowrap="nowrap"><a href="#viewwrap<?php echo $enquiry['id'] ?>" rel="view" class="lightbox table-icon zoom view"><i class="fa fa-info-circle fa-3" aria-hidden="true"></i> View</a> 
        <a href="<?php echo site_url('admin/enquiry/delete/'.$enquiry['id'].'/'.$return); ?>" class="table-icon delete" title="Delete" onclick="return confirmBox();"></a></td>
      </tr>
    <div class="full_w" id="viewwrap<?php echo $enquiry['id'] ?>" style="display:none; padding:5px; color:black ">
      <h2 class="h_title" align="center">ENQUIRY DETAILS</h2> 
      <p>&nbsp;</p>
      <div class="element">
        <label for="title"><strong>Name : <?php echo $enquiry['enq_name']; ?> </strong></label>
      </div>
      <div class="element">
        <label for="title"><strong>Email </strong>: <a href="mailto:<?php echo $enquiry['enq_email']; ?>"><?php echo $enquiry['enq_email']; ?></a> </label>
      </div>
      <div class="element">
        <label for="title"><strong>Contact No </strong>: <?php echo $enquiry['enq_phone']; ?></label>
      </div> 
      <div class="element">
        <label for="title"><strong>Referrer URL </strong>: <a href="<?php echo $enquiry['refererurl']; ?>" target="_blank">view</a></label>
      </div>
      
      <div class="element">
        <label for="title"><strong>Subject </strong>: <?php echo $enquiry['enq_subject']; ?></label>
      </div>
      <div class="element">
          <label for="title"><strong>Message </strong>:
        
         <?php echo nl2br($enquiry['enq_message']); ?> 
          </label>
        
      </div>
      <div class="element">
        <label for="title"><strong>Enquiry Date</strong>: <?php echo date('d-m-Y h:i A',strtotime($enquiry['added_on']));?> </label>
      </div>
    </div>
    <?php endforeach; ?>
    </tbody>
  </table>
  <?php form_close(); ?>
  <div class="entry">
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
  </div>
</div>
<style>
.fancybox-content .element{line-height:20px;border-bottom: 1px dotted #ccc; padding: 5px 0; color:#333;  padding:10px;}
</style> 
