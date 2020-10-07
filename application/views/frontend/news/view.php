<section class="page-title">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <!-- Title text -->
                <h3>News & Events</h3>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<section class="blog section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
                <article>
                    <!-- Post Image -->
                    <div class="image">
                        <img src="<?php echo base_url( 'public/uploads/contents/'.$content->image )?>">
                    </div>
                    <!-- Post Title -->
                    <h3><?php echo $content->title ?></h3>
                    <ul class="list-inline">
                        <li class="list-inline-item"> <i class="fa fa-map-marker"></i> <?php echo $content->location; ?>
                        </li>
                        <li class="list-inline-item"><i class="fa fa-calendar"></i>
                            <?php echo date('d F Y',strtotime($content->date_time)) ?></li>
                    </ul>
                    <!-- Post Description -->
                    <?php echo $content->desc ?> 
                </article>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
                <div class="sidebar">
                    <!-- Category Widget -->
                    <div class="widget category">
                        <!-- Widget Header -->
                        <h5 class="widget-header">Latest News & Events</h5>
                        <ul class="category-list">
                            <?php if($news) foreach($news as $n): if($n['id']!=$content->id){?>
                            <li> <a href="<?php echo site_url('news/'.$n['slug'])?>"> <?php echo $n['title']?> </a></li>
                            <?php } endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>