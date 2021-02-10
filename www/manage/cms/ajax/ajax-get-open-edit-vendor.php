<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}
require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

if(!isset($rows_per_page)) $rows_per_page = 8;

	$page = 1;
	$data_for = 'vendors';

$db = $dbCustom->getDbConnect(CART_DATABASE);

$vend_man_id = isset($_GET['vend_man_id']) ? $_GET['vend_man_id'] : 0;


	$stmt = $db->prepare("SELECT name
						,web_site
						,description 
						,contact_name
						,contact_email
						,contact_phone
						,contact_fax
						,is_drop_shipper
						,is_vendor
						,is_manufacturer
						,parent_vend_man_id 
					FROM vend_man
					WHERE vend_man_id = ?");
	if(!$stmt->bind_param('i', $vend_man_id)){
		//echo 'Error '.$db->error;
	
	}else{
		$stmt->execute();						
		$stmt->bind_result($name
						,$web_site   
						,$description
						,$contact_name
						,$contact_email
						,$contact_phone
						,$contact_fax
						,$is_drop_shipper
						,$is_vendor
						,$is_manufacturer
						,$parent_vend_man_id);	
		$stmt->fetch();
		$stmt->close();		
	}
 

$sql = "SELECT brand_id
		FROM vend_man_brand
		WHERE vend_man_id = '".$vend_man_id."'";  
$result = $dbCustom->getResult($db,$sql);
$vendor_brand_array = array();
while($row = $result->fetch_object()){
	$vendor_brand_array[] = $row->brand_id;
}

$sql = "SELECT name, vend_man_id 
		FROM vend_man 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY name";
$result = $dbCustom->getResult($db,$sql);
$parent_vendor_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$parent_vendor_array[$i]['vend_man_id'] = $row->vend_man_id;
	$parent_vendor_array[$i]['name'] = $row->name; 
	$i++;
}

$sql = "SELECT brand_id	
			,name		
		FROM brand
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY name";
$result = $dbCustom->getResult($db,$sql);
$brand_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$brand_array[$i]['brand_id'] = $row->brand_id;
	$brand_array[$i]['name'] = $row->name; 
	$i++;
}
?>

<div class="clearfix">
	<p class="modal-tool-admin-title">Add New Vendor</p>
	<div class="left-side" style="width:280px;">
			
            <div class="clearfix edit-unit-detail-label">
    			<label class="modal-tool-admin-label">Name</label>
                                
                <input type="text" class="input-border-bottom" id="edit_sub_vendor_name" name="name" value="<?php echo $name; ?>" 
                style="width:260px; font-size: 0.8em;">
            </div>

			<div class="clearfix edit-unit-detail-label btn-more-edge-banding">
				<i>Choose one or more Brands</i>  
                <select class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown"
                multiple='multiple' id="edit_sub_brand_ids" name='brand__ids[]' size="1" style="width:260px;"
                onChange="expand_select(this,<?php echo count($brand_array); ?>)">
                    <option value="0">Select</option>    
                    <?php
                    foreach($brand_array as $val){
						if(in_array($val['brand_id'], $vendor_brand_array)){
							$sel = "selected";	
						}else{
							$sel = '';
						}
						echo "<option value='".$val['brand_id']."' $sel>".$val['name']."</option>";				
                    }
                    ?>
                </select>
			</div>

			<div class="clearfix edit-unit-detail-label btn-more-edge-banding">
				<i>Choose a Parent Vendor</i>  
                <select class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown"
                id="edit_sub_parent_vendor_id" name='parent_vendor_id' style="width:260px;">
                    <option value="0">Select</option>    
                    <?php
                    foreach($parent_vendor_array as $val){
						$sel = ($parent_vend_man_id == $val['vend_man_id'])? "selected" : '';
                    	echo "<option value='".$val['vend_man_id']."' $sel>".$val['name']."</option>";				
                    }
                    ?>
                </select>
			</div>
			<div id="mat_swiches_add">                        
				<div class="clearfix edit-unit-detail-label">
					<div class="add-on-checkbox-item clearfix">
						<span class="add-on-checkbox-text add-on-checkbox-left-text">Is Vendor</span>
                        <label class="switch">
                        <input type="checkbox" id="edit_sub_is_vendor" name="is_vendor" <?php if($is_vendor) echo "checked"; ?> value="1">
                        <span class="switch-slider round"></span>
                        </label>     
					</div>
					<div class="add-on-checkbox-item clearfix">
						<span class="add-on-checkbox-text add-on-checkbox-left-text">Is DropShipper</span>
                        <label class="switch">
                        <input type="checkbox" id="edit_sub_is_drop_shipper" name="is_drop_shipper" <?php if($is_drop_shipper) echo "checked"; ?> value="1">
                        <span class="switch-slider round"></span>
                        </label>
					</div>
					<div class="add-on-checkbox-item clearfix"> 
						<span class="add-on-checkbox-text add-on-checkbox-left-text">Is Manufacturer</span>
                        <label class="switch">
                        <input type="checkbox" id="edit_sub_is_manufacturer" name="is_manufacturer" <?php if($is_manufacturer) echo "checked"; ?> value="1">
                        <span class="switch-slider round"></span>
                        </label>
					</div>
				</div>
            </div>
		</div>

		<div class="right-side" style="padding-left:20px;">
			<div class="clearfix edit-unit-detail-label">
    			<label class="modal-tool-admin-label" style="width:240px;">Vendor's Website</label>
                                
                <input type="text" class="input-border-bottom" id="edit_sub_web_site" name="web_site" value="<?php echo $web_site; ?>"
                style="width:260px; font-size: 0.8em;">
            </div>

			<div class="clearfix edit-unit-detail-label">
    			<label class="modal-tool-admin-label" style="width:240px;">Contact Person's Name</label>
                                
                <input type="text" class="input-border-bottom" id="edit_sub_contact_name" name="contact_name" value="<?php echo $contact_name; ?>"
                style="width:260px; font-size: 0.8em;">
            </div>

			<div class="clearfix edit-unit-detail-label">
    			<label class="modal-tool-admin-label" style="width:240px;">Contact Person's Email</label>
                                
                <input type="text" class="input-border-bottom" id="edit_sub_contact_email" name="contact_email" value="<?php echo $contact_email; ?>"
                style="width:260px; font-size: 0.8em;">
            </div>

			<div class="clearfix edit-unit-detail-label">
    			<label class="modal-tool-admin-label" style="width:240px;">Contact Person's Phone</label>
                                
                <input type="text" class="input-border-bottom" id="edit_sub_contact_phone" name="contact_phone" value="<?php echo $contact_phone; ?>" 
                style="width:260px; font-size: 0.8em;">
            </div>

			<div class="clearfix edit-unit-detail-label">
    			<label class="modal-tool-admin-label" style="width:240px;">Contact Person's Fax</label>
                                
                <input type="text" class="input-border-bottom" id="edit_sub_contact_fax" name="contact_fax" value="<?php echo $contact_fax; ?>"
                style="width:260px; font-size: 0.8em;">
            </div>


			<div class="clearfix edit-unit-detail-label">
    			<label class="modal-tool-admin-label">Description</label>
				
                <textarea id="edit_sub_description" name="description" style="position:relative; border-width:thin; width:280px;"><?php echo $description; ?></textarea>                                
            </div>


        <div class="container-btn-bottom">	
            <button 
            class="btn-default btn-bold text-capitalize with-bottom-shadow btn-with-border"
            onclick="update_sub_vendor();">
            Save 
            </button>
            <span onclick="close_sub_edit_vendor();" class="modal-close">Cancel</span>
        </div>
	</div>
</div>
