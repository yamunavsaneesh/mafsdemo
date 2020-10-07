
<!--============================
=            Footer            =
=============================--> 
<footer class="footer section section-sm">
  <!-- Container Start -->
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-7 offset-md-1 offset-lg-0">
        <!-- About --><h4 class="text-white"> About MAFS</h4>
        <div class="block about"> 
          <p class="alt-color">
Mohamed Al Otaiba Facilities Management Services LLC, a subsidiary of Mohamed Hareb Al Otaiba Group, is distinctive among its peers and brings together the tailored facility management services that fits your specific working environment and corporate culture.</p>
        </div>
      </div>
      <!-- Link list -->
       
      <div class="col-lg-2 offset-lg-1 col-md-3">
        <div class="block">
          <h4> <?php echo $this->servicescategory[1]['name'];?></h4>
          <ul>
            <?php if($this->catservices['1']) foreach($this->catservices['1'] as $cat):?>
            <li><a href="<?php echo site_url('services/view/'.$cat['slug']);?>"><?php echo $cat['title']?></a></li>
            <?php endforeach; ?> 
          </ul>
        </div>
      </div>
      <!-- Link list -->
      <div class="col-lg-2 col-md-3 offset-md-1 offset-lg-0">
        <div class="block">
          <h4><?php echo $this->servicescategory[2]['name'];?></h4>
          <ul>
          <?php if($this->catservices['2']) foreach($this->catservices['2'] as $cat):?>
            <li><a href="<?php echo site_url('services/view/'.$cat['slug']);?>"><?php echo $cat['title']?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
          </div>
      <!-- Promotion -->
      <div class="col-lg-4 col-md-7">
        <!-- App promotion -->
        <div class="block-2 app-promotion">
          <div class="mobile d-flex">
            
            	
             <ul class="contact-details margin-top-20">
             <li class="template-location">
					<h6 class="text-white">Keep In Touch	</li>
							<li class="template-location">
					<div class="text-white">
					Office 2004, API Trio Tower, Al Barsha1, Dubai-UAE					</div>
				</li>
								<li class="template-mobile">
					<div class="text-white">
										<a href="tel:%208006237" class="text-white">
					Toll Free: 800MAFS (6237)					</a>
										</div>
				</li>
								<li class="template-email">
					<div class="text-white">
										<a target="_blank" class="text-white" href="mailto:%20info@mafsuae.ae">
					info@mafsuae.ae					</a>
										</div>
				</li>
						</ul> 
          </div> 
        </div>
      </div>
    </div>
  </div>
  <!-- Container End -->
</footer> 
<!-- Footer Bottom -->
<footer class="footer-bottom">
  <!-- Container Start -->
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-12">
        <!-- Copyright -->
        <div class="copyright">
          <p>Copyright © <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
            </script> <?php echo $this->config->item('site_name'); ?>. All Rights Reserved </a>
            <a href="<?php echo site_url('contents/view/terms-conditions')?>" class="policy ml-2">Terms & Conditions</a> | <a class="policy" href="<?php echo site_url('contents/view/privacy-policy')?>">Privacy Policy</a>
            </p>
        </div>
      </div>
      <div class="col-sm-3 col-12">
        <!-- Social Icons -->
        <ul class="social-media-icons text-right">
        <?php if($this->alphasettings['FACEBOOK_LINK']!=''){ ?>
          <li><a class="fa fa-facebook" href="<?php echo $this->alphasettings['FACEBOOK_LINK'];?>'" target="_blank"></a></li>
        <?php } if($this->alphasettings['TWITTER_LINK']!=''){ ?>
          <li><a class="fa fa-twitter" href="<?php echo $this->alphasettings['TWITTER_LINK'];?>" target="_blank"></a></li>
        <?php } if($this->alphasettings['YOUTUBE_LINK']!=''){ ?>
          <li><a class="fa fa-youtube-play" href="<?php echo $this->alphasettings['YOUTUBE_LINK'];?>" target="_blank"></a></li>
          <?php } if($this->alphasettings['LINKEDIN_LINK']!=''){ ?>
          <li><a class="fa fa-linkedin  " href="<?php echo $this->alphasettings['LINKEDIN_LINK'];?>" target="_blank"></a></li>
          <?php }  ?> 
        </ul>
      </div>
    </div>
  </div>
  <!-- Container End -->
  <!-- To Top -->
  <div class="top-to">
    <a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
  </div>
</footer>