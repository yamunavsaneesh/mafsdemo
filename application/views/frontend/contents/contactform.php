<?php echo form_open('contactus/enquiry/', array("id" => "contactform", "class" => "ajaxform")); ?>
<ul class="row">
    <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <input class="form-control required" name="fullname" type="text" id="fullname"
            placeholder="Please type your Name here*" value="<?php echo set_value('fullname'); ?>" />
        <?php $err = '';if (form_error('fullname')) {$err = ' err';
    echo form_error('fullname');}?>
    </li>
    <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <input class="form-control required email" name="email" type="text" id="email"
            placeholder="Please type your Email address*" value="<?php echo set_value('email'); ?>" />
        <?php $err = '';if (form_error('email')) {$err = ' err';
    echo form_error('email');}?>
    </li>
    <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <input class="form-control required number" name="mobile" type="text" id="mobile"
            placeholder="Type your Contact number*" value="<?php echo set_value('mobile'); ?>" />
        <?php $err = '';if (form_error('mobile')) {$err = ' err';
    echo form_error('mobile');}?>
    </li>
    <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <input class="form-control" id="city" type="text" placeholder="Please enter your city" name="city"
            value="<?php echo set_value('city'); ?>">
        <?php $err = '';if (form_error('city')) {$err = ' err';
    echo form_error('city');}?>
    </li>
    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <textarea name="message" placeholder="Type your Message here" cols="" rows="6"
            class="form-control required"><?php echo set_value('message'); ?></textarea>
        <?php $err = '';if (form_error('message')) {$err = ' err';
    echo form_error('message');}?>
    </li>
    <li class="col-lg-7 col-md-7 col-sm-7 col-xs-12 captche">
        <?php echo $this->recaptcha->render(); ?><?php echo form_error('captcha') ?></li>
    <li class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
        <button class="btn btn-submit" name="butSub" type="submit" value="Submit" id="butSub">Submit</button>
    </li>
</ul>
<?php echo form_close(); ?>
<script type="text/javascript">
$(function() {
    $("#contactform").submit(function(e) {
        e.preventDefault();
    });
});
</script>