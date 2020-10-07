<section class="page-title">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <!-- Title text -->
                <h3>Image Gallery</h3>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<section class="section bg-gray -gallery">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <?php if($images)foreach($images as $image):?>
            <div class="col-md-3 mt-2">
                <div class="thumbnail text-center">
                    <a data-fancybox="gallery" href="<?php echo base_url('public/uploads/gallery/'.$image['image']);?>">
                        <img class="img-thumbnail"
                            src="<?php echo base_url('public/uploads/gallery/'.$image['image']);?>" alt=""> 
                    </a>
                </div>
            </div>
            <?php endforeach;  ?>
        </div>
    </div>
</section>