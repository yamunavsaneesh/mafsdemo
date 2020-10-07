<!DOCTYPE html>
<html lang="en"> 
<head>
    <?php echo $meta; ?>
    <base href="<?php echo base_url(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="apple-touch-icon" href="<?php echo base_url('favicon.ico'); ?>" />
    <link rel="icon" type="image/png" href="<?php echo base_url('favicon.ico'); ?>" /> 
     <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('public/frontend/plugins/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/frontend/plugins/bootstrap/css/bootstrap-slider.css') ?>">
    <!-- Font Awesome -->
    <link
        href="<?php echo base_url('public/frontend/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet') ?>">
    <!-- Owl Carousel -->
    <link href="<?php echo base_url('public/frontend/plugins/slick-carousel/slick/slick.css" rel="stylesheet') ?>">
    <link
        href="<?php echo base_url('public/frontend/plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet') ?>">
    <!-- Fancy Box -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link
        href="<?php echo base_url('public/frontend/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet') ?>">
    <!-- CUSTOM CSS -->
    <link href="<?php echo base_url('public/frontend/css/style.css" rel="stylesheet') ?>">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head> 
<body class="body-wrapper">
    <?php echo $header ?> <?php echo $contents; ?> <?php echo $footer; ?>
    <!-- JAVASCRIPTS -->
    <script src="<?php echo base_url('public/frontend/plugins/jQuery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/frontend/plugins/bootstrap/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/frontend/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/frontend/plugins/bootstrap/js/bootstrap-slider.js'); ?>"></script>
    <!-- tether js -->
    <script src="<?php echo base_url('public/frontend/plugins/tether/js/tether.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/frontend/plugins/raty/jquery.raty-fa.js'); ?>"></script>
    <script src="<?php echo base_url('public/frontend/plugins/slick-carousel/slick/slick.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/frontend/plugins/jquery-nice-select/js/jquery.nice-select.min.js'); ?>">
    </script>
    <script src="<?php echo base_url('public/frontend/plugins/smoothscroll/SmoothScroll.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="<?php echo base_url('public/frontend/js/script.js'); ?>"></script>
    <script>
    $(document).ready(function() {
        if ($('[data-background]').length > 0) {
            $('[data-background]').each(function() {
                var $background, $backgroundmobile, $this;
                $this = $(this);
                $background = $(this).attr('data-background');
                $backgroundmobile = $(this).attr('data-background-mobile');
                if ($this.attr('data-background').substr(0, 1) === '#') {
                    return $this.css('background-color', $background);
                } else if ($this.attr('data-background-mobile') && device.mobile()) {
                    return $this.css('background-image', 'url(' + $backgroundmobile + ')');
                } else {
                    return $this.css('background-image', 'url(' + $background + ')');
                }
            });
        }
    });
    $(document).ready(function() {
        $('.ct-slick-homepage').slick({
            autoplay: true,
            autoplaySpeed: 3000,
        });
        //$('.carousel').carousel();
        <?php if (in_array($this->router->fetch_class(), array('contactus', 'services'))) {?>getform();
        <?php }?>
        $("#formcontainer").on('click', '#butSub', function() {
            submitform();
        });
    }); 
    function submitform() {
        var dataString = new Object();
        dataString = $('#contactform').serialize();
        $.ajax({
            type: "post",
            url: "<?php echo site_url('contactus/enquiry/'); ?>",
            data: dataString,
            success: function(msg) {
                $('#formcontainer').html(msg);
            }
        });
    } 
    function getform() {
        var dataString = new Object();
        $.ajax({
            type: "get",
            url: "<?php echo site_url('contactus/enquiry/'); ?>",
            success: function(msg) {
                $('#formcontainer').html(msg);
            }
        });
    }
    </script>
</body> 
</html>