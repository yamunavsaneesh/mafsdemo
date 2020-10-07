<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <base href="<?php echo base_url('/'); ?>" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="apple-touch-icon" href="<?php echo base_url('favicon.ico'); ?>" />
    <link rel="icon" type="image/png" href="<?php echo base_url('favicon.ico'); ?>" />
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/style.css'); ?>"
        media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/navi.css'); ?>" media="screen" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url('public/admin/css/ui-lightness/ui.custom.min.css'); ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/font-awesome.min.css'); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery-1.7.2.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery-ui-1.10.3.custom.min.js'); ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery-ui-timepicker-addon.js'); ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/ckeditor/ckeditor.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/ckfinder/ckfinder.js'); ?>"></script>
</head>
<body>
    <div class="wrap"> <?php echo $header; ?>
        <div id="content"> <?php // echo $left; ?>
            <div id="main"> <?php echo $content; ?> </div>
            <div class="clear"></div>
        </div>
        <?php echo $footer; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
    function confirmBox() {
        var e = confirm("Are you sure?");
        return 1 == e ? !0 : !1
    }
    function confirmDelete() {
        return 1 == $(".chkbx").is(":checked") ? 1 == confirm("Are you sure?") ? !0 : !1 : 0 == $(".chkbx").is(
            ":checked") ? (alert("Choose a record to delete"), !1) : void 0
    }
    $(document).ready(function() {
        $(".flash_messages").show().delay(2e3).fadeOut(), $(".select_all").click(function() {
            $(this).closest("form").find(":checkbox").prop("checked", this.checked)
        }), $(".datepicker").datetimepicker({
            dateFormat: "dd-mm-yy",
            timeFormat: "hh:mm tt"
        })
        $(".fancybox").fancybox({}), $(".lightbox").fancybox()
    });
    </script>
</body>
</html>