<section class="inner-section animatedParent animateOnce" data-appear-top-offset="-100" data-sequence="80">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="inner-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="inner-tittle">
                                <div class="row">
                                    <div class="col-md-10 col-sm-10">
                                        <h2><?php echo $pagemeta->title ?></h2>
                                        <?php $this->load->view('frontend/include/breadcrumb'); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <ul class="share-mail">
                                            <li><a class="print-icon" href=""></a></li>
                                            <li><a class="share-icon" href=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 about-wrap"> <?php echo $pagemeta->desc ?> </div>
                    </div>
                    <ul class="row img-page-list"><?php if($clients) foreach($clients as $key => $client):?>
                        <li class="col-md-3 no-padding">
                            <div class="wrap-list-bx_">
                                <figure><img class="img-responsive"
                                        src="<?php echo base_url('public/uploads/clients/'.$client['image']); ?>"
                                        alt="Sarralle"></figure>
                            </div>
                        </li><?php endforeach;?>
                    </ul>
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</section>