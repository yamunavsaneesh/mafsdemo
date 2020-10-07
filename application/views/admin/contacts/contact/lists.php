<?php
$activearr = array('Y' => 'Active', 'N' => 'Inactive');
if ($this->uri->segment(4) == "") {
    $i = 0;
    $return = 0; 
} else {
    $i = $this->uri->segment(4);
    $return = $this->uri->segment(4);
}
?>
<div class="full_w">
    <div class="h_title">Manage Contacts - List</div>
    <?php echo $this->session->flashdata('message'); ?> <?php echo form_open('admin/contacts/actions'); ?>
    <div class="entry">
        <input class="button" type="submit" name="enable" value="Enable" />
        <input class="button" type="submit" name="disable" value="Disable" />
        <input class="button" type="submit" name="delete" value="Delete" onclick="return confirmDelete();" />
        <input type="hidden" name="return" value="<?php echo $return; ?>" />
        <div style="float:right;"> Sort :
            <select name="sortby" style="margin-right:5px;">
                <option value="">Select</option>
                <?php foreach ($contactfields as $id => $key): ?>
                <option value="<?php echo $id; ?>"
                    <?php if ($this->session->userdata('sort_field') == $id) {echo 'selected="selected"';}?>>
                    <?php echo $key; ?></option>
                <?php endforeach;?>
            </select>
            <select name="orderby" style=" margin-right:5px;">
                <option value="">Select</option>
                <?php foreach ($sortorders as $id => $key): ?>
                <option value="<?php echo $id; ?>"
                    <?php if ($this->session->userdata('order_field') == $id) {echo 'selected="selected"';}?>>
                    <?php echo $key; ?></option>
                <?php endforeach;?>
            </select>
            Category :
            <select name="category" style=" margin-right:5px;">
                <option value="">Select</option>
                <?php $cats = array();foreach ($contactcats as $contactcat): $cats[$contactcat[id]] = $contactcat;?>
	               <option value="<?php echo $contactcat['id']; ?>"
	                    <?php if ($this->session->userdata('contact_category_id') == $contactcat['id']) {echo 'selected="selected"';}?>>
	                    <?php echo $contactcat['name']; ?></option>
	               <?php endforeach;?>
            </select>
            Search :
            <input style="margin-right:5px;" type="text" name="keyword"
                value="<?php echo $this->session->userdata('contact_key'); ?>" />
            <select name="field" style="margin-right:5px;">
                <?php foreach ($contactfields as $id => $key): ?>
                <option value="<?php echo $id; ?>"
                    <?php if ($this->session->userdata('contact_field') == $id) {echo 'selected="selected"';}?>>
                    <?php echo $key; ?></option>
                <?php endforeach;?>
            </select>
            <input class="button" type="submit" name="search" value="Search" />
            <input class="button" type="submit" name="reset" value="Reset" />
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col" style="width: 20px;"><input type="checkbox" class="select_all" name="ids" id="ids" />
                </th>
                <th scope="col" style="width: 20px;">ID</th>
                <th scope="col">Category</th>
                <th scope="col">Location</th>
                <th scope="col">Latitude , Longitude</th>
                <th scope="col">Status</th>
                <th scope="col" style="width: 100px;">Sort Order
                    <input style="padding:1px;" type="submit" name="sortsave" value="Save" />
                </th>
                <th scope="col">Modify</th>
            </tr>
        </thead>
        <tbody>
            <?php 
foreach ($contacts as $contact): ?>
            <tr>
                <td class="align-center"><input type="checkbox" class="chkbx" name="id[]"
                        value="<?php echo $contact['id']; ?>" /></td>
                <td class="align-center"><?php echo ++$i; ?></td>
                <td><?php echo $cats[$contact['category_id']]['name']; ?></td>
                <td><?php echo $contact['location'] ?></td>
                <td><?php echo $contact['latitude']; ?> <strong>,</strong> <?php echo $contact['longitude']; ?></td>
                <td><?php echo $activearr[$contact['status']]; ?></td>
                <td align="center"><input style="text-align:center;" type="text" size="2"
                        name="sort_order[<?php echo $contact['id']; ?>]"
                        value="<?php echo $contact['sort_order']; ?>" /></td>
                <td><a href="<?php echo site_url('admin/contacts/edit/' . $contact['id'] . '/' . $return); ?>"
                        class="table-icon edit" title="Edit"></a> <a
                        href="<?php echo site_url('admin/contacts/delete/' . $contact['id'] . '/' . $return); ?>"
                        class="table-icon delete" title="Delete" onclick="return confirmBox();"></a></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php form_close();?>
    <div class="entry">
        <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
        <div class="sep"></div>
        <a class="button add" href="<?php echo site_url('admin/contacts/add'); ?>">Add New Contact</a>
    </div> 
</div>