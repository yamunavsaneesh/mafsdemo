<div class="full_w"> 
  <div class="h_title">Add New Menu Item - <?php echo $menudetail->name; ?></div> 
  <?php echo form_open_multipart('admin/menus/menuitemadd/'.$menudetail->id); ?> 
  <div class="element"> 
    <label for="parent_id">Parent Menu 
      <?php if(form_error('parent_id')){ $err=' err'; echo form_error('parent_id'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <select name="parent_id" id="parent_id" class="text"> 
      <option value="0">None - Top Level</option> 
      <?php echo $parentmenus; ?> 
    </select> 
  </div> 
  <div class="element"> 
    <label for="link_type">Link Type</label> 
    <select name="link_type" id="link_type" class="text" onchange="changeobjects()"> 
      <option value="">Select</option> 
      <?php foreach($linktypes as $key => $val): ?> 
      <option value="<?php echo $key; ?>"><?php echo $val; ?></option> 
      <?php endforeach; ?> 
    </select> 
  </div> 
  <div class="element"> 
    <label for="link_object">Link To</label> 
    <select name="link_object" id="link_object" class="text"> 
      <option value="">Select</option> 
    </select> 
  </div> 
  <div class="element"> 
    <label for="name">Name (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('name')){ $err=' err'; echo form_error('name'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input id="name" name="name" type="text" class="text<?php echo $err; ?>" value="<?php echo set_value('name'); ?>" /> 
  </div> 
  <div class="element"> 
    <label for="short_desc">Short Description (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>) 
      <?php if(form_error('keywords')){ $err=' err'; echo form_error('short_desc'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <textarea id="short_desc" name="short_desc" type="text" class="textarea<?php echo $err; ?>"><?php echo  set_value('short_desc'); ?></textarea> 
  </div> 
  <div class="element"> 
    <label for="class">Class (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <input id="class" name="class" type="text" class="text" value="<?php echo set_value('class'); ?>" /> 
  </div> 
  <div class="element"> 
    <label for="link">Link (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <input id="link" name="link" type="text" class="text" value="<?php echo set_value('link'); ?>" /> 
  </div> 
  <div class="element"> 
    <label for="icon">Icon (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <input type="file" name="icon" /> 
  </div> 
  <div class="element"> 
    <label for="attachment">Attachment (<?php echo $this->languagesarr[$this->session->userdata('admin_language')]?>)</label> 
    <input type="file" name="attachment" /> 
  </div> 
  <div class="element"> 
    <label for="target_type">Target Type </label> 
    <select name="target_type" id="target_type" class="text"> 
      <option value="">Select</option> 
      <?php foreach($targettypes as $key => $val): ?> 
      <option value="<?php echo $key; ?>"><?php echo $val; ?></option> 
      <?php endforeach; ?> 
    </select> 
  </div> 
  <div class="element"> 
    <label for="sort_order">Sort Order </label> 
    <input id="sort_order" name="sort_order" type="text" class="text" value="<?php echo set_value('sort_order'); ?>" /> 
  </div> 
  <div class="element"> 
    <label for="show_subitems">Show Submenu 
      <?php if(form_error('show_subitems')){ $err=' err'; echo form_error('show_subitems'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input type="radio" name="show_subitems" value="Y" <?php echo set_radio('show_subitems', 'Y'); ?> /> 
    Yes 
    <input type="radio" name="show_subitems" value="N" <?php echo set_radio('show_subitems', 'N', TRUE); ?> /> 
    No </div> 
  <div class="element"> 
    <label for="status">Status 
      <?php if(form_error('status')){ $err=' err'; echo form_error('status'); } else { $err=''; ?> 
      <span> (required)</span> 
      <?php } ?> 
    </label> 
    <input type="radio" name="status" value="Y" <?php echo set_radio('status', 'Y', TRUE); ?> /> 
    Enabled 
    <input type="radio" name="status" value="N" <?php echo set_radio('status', 'N'); ?> /> 
    Disabled </div> 
  <div class="entry"> 
    <button type="submit" class="add">Save</button> 
    <a class="button cancel" href="<?php echo site_url('admin/menus/lists'); ?>">Cancel</a> </div> 
  <?php echo form_close(); ?> </div> 
<script type="text/javascript">// <![CDATA[ 
	var selected='';  
    $(document).ready(function(){  
		changeobjects('');   
       /* $('#link_type').change(function(){ //any select change on the dropdown with id country trigger this code         
            changeobjects('');              
        });*/ 
    }); 
	function changeobjects(selected) 
	{ 
		$("#link_object > option").remove(); //first of all clear select items 
            var link_id = $('#link_type').val();  // here we are taking country id of the selected one. 
			var oData = new Object(); 
			oData.link_id=link_id; 
            $.ajax({ 
                type: "POST", 
				data:oData, 
                url: "<?php echo site_url('admin/menus/getlinkto/'); ?>", //here we are calling our user controller and get_cities method with the country_id                  
                success: function(clinks) //we're calling the response json array 'cities' 
                { 
					var dataArray = []; 
					for (id in clinks) { 
						var word = clinks[id]; 
						dataArray.push({id: parseInt(id), word: word}); 
					}					 
					dataArray.sort(function(a, b){ 
						if (a.word < b.word) return -1; 
						if (b.word < a.word) return 1; 
						return 0; 
					}); 
                    $.each(dataArray,function(id,clink) //here we're doing a foeach loop round each city with id as the key and city as the value 
                    { 
						if(clink != undefined) { 
                        var opt = $('<option />'); // here we're creating a new select option with for each city 
                        opt.val(clink.id); 
                        opt.text(clink.word); 
						if(selected==clink.id){ 
						opt.attr('selected',true); 
						} 
                        $('#link_object').append(opt); //here we will append these new select options to a dropdown with the id 'cities' 
						} 
                    }); 
                } 
                  
            }); 
	} 
    // ]]> 
</script>