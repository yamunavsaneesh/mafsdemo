<section class="page-title">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <!-- Title text -->
                <h3><?php echo $content->title ?></h3>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<section class="section-sm">
    <div class="container"> 
        <div class="product-grid-list">
            <div class="row mt-30">
                <?php if($news) foreach($news as $n):?>
                <div class="col-sm-12 col-lg-4 col-md-6">
                    <!-- product card -->
                    <div class="product-item bg-light">
                        <div class="card">
                            <div class="thumb-content">
                                <a href="<?php echo site_url('news/'.$n['slug'])?>">
                                    <img class="card-img-top img-fluid"
                                        src="<?php echo base_url('public/'.($n['image']?'uploads/contents/'.$n['image']:'frontend/images/noimage.jpg') )?>"
                                        alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><a
                                        href="<?php echo site_url('news/'.$n['slug'])?>"><?php echo $n['title'] ?></a>
                                </h4>
                                <ul class="list-inline product-meta">
                                    <li class="list-inline-item">
                                        <i class="fa fa-map-marker"></i> <?php echo $n['location']; ?>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fa fa-calendar"></i>
                                        <?php echo date('d F Y',strtotime($n['date_time'])) ?>
                                    </li>
                                </ul>
                                <p class="card-text"><?php echo $n['short_desc'] ?></p> 
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?> 
            </div>
        </div>
        <div class="pagination justify-content-center">
            <nav aria-label="Page navigation example">
                <?php echo $this->pagination->create_links(); ?>
            </nav>
        </div>
    </div>
    </div>
    </div>
</section>