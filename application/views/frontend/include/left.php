<ul class="left-nav"> 
  <?php if($datas) foreach($datas as $value): $url = site_url( isset($value['link'])?$value['link']:'contents/view/'.$value['slug']);?> 
  <li <?php echo in_array($url,array(current_url(),site_url($this->c)))?'class="active"':'' ?>> <a href="<?php echo $url ?>"> 
    <?php if ($value['image'] !='' && file_exists('public/uploads/'.(isset($value['section'])?$value['section']:'contents').'/'.$value['image'])){ ?> 
    <i><img class="img-responsive" src="<?php echo base_url('public/uploads/'.(isset($value['section'])?$value['section']:'contents').'/'.$value['image']);?>" tittle="Sarralle" alt="Sarralle" /></i> 
    <?php } ?> 
    <p><?php echo $value['title'] ?></p> 
    </a> </li> 
  <?php endforeach;?> 
</ul> 
