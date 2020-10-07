<ul class="breadcrums"> 
  <?php $k=1;$c=count($this->breadcrumbarr);foreach($this->breadcrumbarr as $link => $text):  ?> 
  <li><a href="<?php echo ($k==$c)?'javascript:void(0)':$link ?>"><?php echo $text?></a></li> 
  <?php $k++;endforeach; ?> 
</ul>  
