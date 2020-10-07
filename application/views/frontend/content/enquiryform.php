<?php echo form_open('contactus/enquiry', array("id" => "contactform", "class" => "ajaxform")); ?>
<fieldset class="p-4">
    <div class="form-group">
        <div class="row">
            <div class="col-lg-6 py-2">
                <input type="text" name="name" value="<?php echo set_value('name'); ?>" placeholder="Name *"
                    class="form-control <?php echo form_error('name') ? 'inputerror' : ''; ?>" required>
            </div>
            <div class="col-lg-6 pt-2">
                <input type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email *"
                    class="form-control <?php echo form_error('email') ? 'inputerror' : ''; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 py-2">
                <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="Phone *"
                    class="form-control <?php echo form_error('phone') ? 'inputerror' : ''; ?>" required>
            </div>
            <div class="col-lg-6 pt-2">
                <input type="text" name="subject" value="<?php echo set_value('subject'); ?>" placeholder="Subject *"
                    class="form-control <?php echo form_error('subject') ? 'inputerror' : ''; ?>" required>
            </div>
        </div>
    </div>
    <textarea name="message" placeholder="Message *"
        class="border w-100 p-3 mt-3 mt-lg-4 <?php echo form_error('message') ? 'inputerror' : ''; ?>"><?php echo set_value('message'); ?></textarea>
    <div class="btn-grounp">
        <button type="submit" id="butSub" class="btn btn-primary mt-2 float-right">SUBMIT</button>
    </div>
</fieldset>
<?php echo form_close(); ?>
<script type="text/javascript">
$(function() {
    $("#contactform").submit(function(e) {
        e.preventDefault();
    });
});
</script>