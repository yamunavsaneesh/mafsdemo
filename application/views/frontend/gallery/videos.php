<section class="page-title">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <!-- Title text -->
                <h3>Video Gallery</h3>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<section class="section bg-gray -gallery">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <?php if($videos)foreach($videos as $v): $youtubeID = getYouTubeVideoId($v['video']); $thumbURL = 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';?>
            <div class="col-md-4 mt-2">
                <div class="thumbnail text-center">
                    <a data-fancybox href="<?php echo $v['video']?>">
                        <img class="img-thumbnail" src="<?php echo $thumbURL;?>">
                        <div class="caption">
                            <p> <?php echo $v['title']?></p>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach;  ?>
        </div>
    </div>
</section>