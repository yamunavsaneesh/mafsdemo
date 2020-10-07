<!-- .ct-header -->
<header class="stickymenu">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light navigation navbar-fixed-top">
                    <a class="navbar-brand" href="<?php echo site_url('home');?>">
                        <img class="img-fluid img primary-logo"
                            src="<?php echo base_url('public/frontend/images/logo.png');?>" alt="MAFS Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> 
                    <div class="collapse navbar-collapse" id="navbarSupportedContent"><?php echo $mainmenu   ?>
                    </div>
                </nav>
            </div>
        </div> 
    </div>
</header>