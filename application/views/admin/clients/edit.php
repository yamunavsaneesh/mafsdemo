<?php 
$slctwidget = array(); 
@$contentwidgets = explode(',', @$content->widgets); 
foreach (@$contentwidgets as $contentwidget):
    $currentwidgets = explode(":", $contentwidget);
    $slctwidget[] = $currentwidgets[0]; 
endforeach; 
$selectedwidget = implode(",", $slctwidget); 
?> 
<div class="full_w">
    <div class="h_title">Edit User</div>
    <?php echo form_open_multipart('admin/clients/edit/' . $content->id . '/' . $return); ?>
    <input id="id" name="id" type="hidden" value="<?php echo $content->id; ?>" />
    <div class="element">
        <label for="title">Suffix
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('title')) {$err = ' err';
    echo form_error('title');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="title" name="title" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->title; ?>" />
    </div>
    <div class="element">
        <label for="fname">First Name
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('fname')) {$err = ' err';
    echo form_error('fname');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="fname" name="fname" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->fname; ?>" />
    </div>
    <div class="element">
        <label for="mname">Middle Name
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('mname')) {$err = ' err';
    echo form_error('mname');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="mname" name="mname" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->mname; ?>" />
    </div>
    <div class="element">
        <label for="lname">Last Name
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('lname')) {$err = ' err';
    echo form_error('lname');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="lname" name="lname" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->lname; ?>" />
    </div>
    <div class="element">
        <label for="university">University
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('university')) {$err = ' err';
    echo form_error('university');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="university" name="university" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->university; ?>" />
    </div>
    <div class="element">
        <label for="department">Department
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('department')) {$err = ' err';
    echo form_error('department');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="department" name="department" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->department; ?>" />
    </div>
    <div class="element">
        <label for="author">Email
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('author')) {$err = ' err';
    echo form_error('author');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="author" name="author" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->email; ?>" />
    </div>
    <div class="h_title">Address</div>
    <div class="element">
        <label for="address">Address
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('address')) {$err = ' err';
    echo form_error('address');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <textarea name="address" id="address" class="text"><?php echo $content->address; ?></textarea>
        <!--<input id="address" name="address" type="text" class="text<?php echo $err; ?>" value="<?php echo $content->address; ?>" />-->
    </div>
    <div class="element">
        <label for="state">State
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('state')) {$err = ' err';
    echo form_error('state');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="state" name="state" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->state; ?>" />
    </div>
    <div class="element">
        <label for="city">City
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('city')) {$err = ' err';
    echo form_error('city');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="city" name="city" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->city; ?>" />
    </div>
    <div class="element">
        <label for="zip">Zip
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('zip')) {$err = ' err';
    echo form_error('zip');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="zip" name="zip" type="text" class="text<?php echo $err; ?>" value="<?php echo $content->zip; ?>" />
    </div>
    <div class="element">
        <label for="country">Country
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('country')) {$err = ' err';
    echo form_error('country');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="country" name="country" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->country; ?>" />
    </div>
    <div class="h_title">Mailing Address (Only If Different Than Above) </div>
    <div class="element">
        <label for="address2">Address
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('address2')) {$err = ' err';
    echo form_error('address2');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <textarea name="address2" id="address2" class="text"><?php echo $content->address2; ?></textarea>
        <!--<input id="address" name="address" type="text" class="text<?php echo $err; ?>" value="<?php echo $content->address; ?>" />-->
    </div>
    <div class="element">
        <label for="state2">State
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('state2')) {$err = ' err';
    echo form_error('state2');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="state" name="state2" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->state2; ?>" />
    </div>
    <div class="element">
        <label for="city2">City
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('city2')) {$err = ' err';
    echo form_error('city2');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="city2" name="city2" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->city2; ?>" />
    </div>
    <div class="element">
        <label for="zip2">Zip
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('zip2')) {$err = ' err';
    echo form_error('zip2');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="zip2" name="zip2" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->zip2; ?>" />
    </div>
    <div class="element">
        <label for="country2">Country
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('country2')) {$err = ' err';
    echo form_error('country2');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="country2" name="country2" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->country2; ?>" />
    </div>
    <div class="element">
        <label for="phone">Phone
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('phone')) {$err = ' err';
    echo form_error('phone');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="phone" name="phone" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->phone; ?>" />
    </div>
    <div class="element">
        <label for="mobile">Mobile
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('phone')) {$err = ' err';
    echo form_error('phone');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="mobile" name="mobile" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->phone2; ?>" />
    </div>
    <div class="element">
        <label for="degree">Degree
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('degree')) {$err = ' err';
    echo form_error('degree');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="degree" name="degree" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->degree; ?>" />
    </div>
    <div class="element">
        <label for="profession">Profession
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('profession')) {$err = ' err';
    echo form_error('profession');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input id="profession" name="profession" type="text" class="text<?php echo $err; ?>"
            value="<?php echo $content->profession; ?>" />
    </div>
    <div class="element">
        <label for="resume">Resume
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('resume')) {$err = ' err';
    echo form_error('resume');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <a href="<?php echo base_url('public/uploads/resumes/' . $content->resume); ?>" target="_blank">View</a>
        <!--<input id="resume" name="resume" type="text" class="text<?php echo $err; ?>" value="<?php echo $content->resume; ?>" />-->
    </div>
    <div class="element">
        <label for="organizations">Organizations
            (<?php echo $this->languagesarr[$this->session->userdata('admin_language')] ?>)<?php if (form_error('organizations')) {$err = ' err';
    echo form_error('organizations');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <textarea name="organizations" id="organizations" class="text"><?php echo $content->organizations; ?></textarea>
        <!--<input id="address" name="address" type="text" class="text<?php echo $err; ?>" value="<?php echo $content->address; ?>" />-->
    </div>
    <div class="element">
        <label for="membership_type">Membership Type
            <?php if (form_error('membership_type')) {$err = ' err';
    echo form_error('membership_type');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input type="radio" name="membership_type" value="Regular Membership"
            <?php if ($content->membership_type == 'Regular Membership') {echo 'checked="checked"';}?> /> Regular
        Membership <input type="radio" name="membership_type" value="Associate (Student) Membership"
            <?php if ($content->membership_type == 'Associate (Student) Membership') {echo 'checked="checked"';}?> />
        Associate (Student) Membership
    </div>
    <div class="element">
        <label for="status">Status
            <?php if (form_error('status')) {$err = ' err';
    echo form_error('status');} else { $err = '';?><span>
                (required)</span><?php }?></label>
        <input type="radio" name="status" value="Y"
            <?php if ($content->is_active == 'Y') {echo 'checked="checked"';}?> />
        Enabled <input type="radio" name="status" value="N"
            <?php if ($content->is_active == 'N') {echo 'checked="checked"';}?> /> Disabled
    </div>
    <div class="entry">
        <button type="submit" class="add">Save</button><a class="button cancel"
            href="<?php echo site_url('admin/clients/lists'); ?>">Cancel</a>
    </div>
    <?php echo form_close(); ?>
</div>