<?php if ($banners) {?>
<section class="hero-area -bg-1 text-center overly" style="background: url(<?php echo base_url('public/uploads/banners/' . $banners[0]['image']) ?>);
   background-size: cover;
   background-repeat: no-repeat;
   }">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Header Contetnt -->
                <div class="content-block">
                    <h1><?php echo $banners[0]['title']; ?> </h1>
                    <p><?php echo $banners[0]['short_desc'] ?></p>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<?php }?>
<!--===================================
   =            SERVICES Slider            =
   ====================================-->
<section class="popular-deals section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>OUR SERVICES</h2>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="trending-ads-slide">
                    <?php if ($services) {foreach ($services as $service): ?>
                    <div class="col-sm-12 col-lg-4">
                        <!-- product card -->
                        <div class="product-item bg-light">
                            <div class="card">
                                <div class="thumb-content">
                                    <!-- <div class="price">$200</div> -->
                                    <a href="<?php echo site_url('services/view/' . $service['slug']); ?>">
                                        <img class="card-img-top img-fluid"
                                            src="<?php echo base_url('public/uploads/services/' . $service['image']) ?>"
                                            alt="Card image cap">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><a
                                            href="<?php echo site_url('services/view/' . $service['slug']); ?>"><?php echo $service['title']; ?></a>
                                    </h4>
                                    <p class="card-text"><?php echo $service['short_desc']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;}?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about section">
    <div class="container">
        <div class="section-title">
            <h2>ABOUT MAFS</h2>
        </div>
        <?php echo $this->contentslugs['about-us']['desc'] ?>
    </div>
</section>
<!--==========================================
   =            OUR CUSTOMERS            =
   ===========================================-->
<section class=" section">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Section title -->
                <div class="section-title">
                    <h2>OUR CUSTOMERS</h2>
                    <p></p>
                </div>
                <div class="row">
                    <?php if ($clients) {foreach ($clients as $client): ?>
                    <!-- Category list -->
                    <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                        <div class="category-block">
                            <div class="header">
                                <img class="img-fluid"
                                    src="<?php echo base_url('public/uploads/clients/' . $client['image']) ?>"
                                    class="attachment-full" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- /Category List -->
                    <?php endforeach;}?>
                </div>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<section class="call-to-action overly bg-3 section-sm">
    <!-- Container Start -->
    <div class="container">
        <div class="row justify-content-md-center text-center">
            <div class="col-md-8">
                <div class="content-holder">
                    <h2>Service You Deserve. People You Trust! </h2>
                    <ul class="list-inline mt-30">
                        <li class="list-inline-item"><a class="btn btn-secondary"
                                href="<?php echo site_url('contactus') ?>">ENQUIRE NOW </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>