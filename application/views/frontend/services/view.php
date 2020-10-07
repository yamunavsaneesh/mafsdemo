<section class="page-title"> 
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center"> 
                <h3><?php echo $content['title'] ?></h3>
            </div>
        </div>
    </div> 
</section>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                <div class="sidebar"> 
                    <div class="widget user-dashboard-profile">
                        <h5 class="text-center"><?php echo $sercat['name'];?></h5>
                    </div>
                    <div class="widget user-dashboard-menu">
                        <ul>
                            <?php if($sercats) foreach($sercats as $c): ?>
                            <li class="<?php echo ($c['slug']==$content['slug']) ? 'active':'';?>">
                                <a href="<?php echo site_url('services/view/'.$c['slug']);?>"><i class="fa fa-dot">
                                    </i><?php echo $c['title'];?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <div class="about-content">
                    <?php echo $content['desc'] ;  ?>
                    <fieldset class="pl-4 text-center">
                        <h2>Get a Quote</h2>
                        <p>Please fill the enquiry form below we are happy to assist you</p>
                    </fieldset>
                    <div class="quote-form-wrap" id="formcontainer"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>