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
 
$brand_id = isset($_GET['brand_id'])? $_GET['brand_id'] : 0;

if(!isset($rows_per_page)) $rows_per_page = 8;

$db = $dbCustom->getDbConnect(CART_DATABASE);

				
$sql = "SELECT name
		,short_name
		,web_site		
	FROM brand
	WHERE brand_id = '".$brand_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object(); 	
	$name = $object->name;
	$short_name = $object->short_name;
	$web_site = $object->web_site; 
}else{
	exit;	
}




$sql = "SELECT vend_man_id
		FROM vend_man_brand
		WHERE brand_id = '".$brand_id."'";
$result = $dbCustom->getResult($db,$sql);
$vendor_ids = array();
while($row = $result->fetch_object()){
	$vendor_ids[] = $row->vend_man_id;
}



$sql = "SELECT name, vend_man_id 
		FROM vend_man 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY name";
$result = $dbCustom->getResult($db,$sql);
$vendor_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$vendor_array[$i]['vend_man_id'] = $row->vend_man_id;
	$vendor_array[$i]['name'] = $row->name; 
	$i++;
}

?>


    <div class="content height-auto" style="padding-top:10px;">
        <div class="header" style="border-bottom: 1px solid #d4d4d4;">
	        <span style="float:right; font-size:0.8em; margin-right:10px; cursor:pointer;" onclick="close_sub_edit_brand();" >Cancel</span>
    	    <center>Edit Brand</center>
        </div>
		
        <input type="hidden" id="update_this_brand_id" name="brand_id" value="<?php echo $brand_id; ?>">

        <div class="main-content qty-form">

            <div class="plate-detail clearfix" style="margin-top:20px;">
                <label style="margin-left:20px; margin-top:15px; font-size:0.9em;" class="modal-tool-admin-label">Name</label>
                                            
                <input type="text" class="input-border-bottom" id="edit_sub_brand_name" name="name" value="<?php echo $name; ?>" 
                style="width:220px; height:40px; font-size: 0.8em;" placeholder="Required Field">
            </div>

            <div class="plate-detail clearfix">
                <label style="margin-left:20px; margin-top:15px; font-size:0.9em;" class="modal-tool-admin-label">Short Name</label>
                                            
                <input type="text" class="input-border-bottom" id="edit_sub_brand_short_name" name="short_name" value="<?php echo $short_name; ?>"
                style="width:220px; height:40px; font-size: 0.8em;">
            </div>

            <div class="plate-detail clearfix">
                <label style="margin-left:20px; margin-top:15px; font-size:0.9em;" class="modal-tool-admin-label">Website</label>
                                            
                <input type="text" class="input-border-bottom" id="edit_sub_brand_web_site" name="web_site" value="<?php echo $web_site; ?>"
                style="width:220px; height:40px; font-size: 0.8em;">
            </div>

			<div style="float:left; height:100px; margin-top:30px; margin-left:20px;">
				<legend>Choose One or More Vendors</legend>
                <select class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown"
                multiple='multiple' id="edit_sub_vendor_ids" name='vendor_ids[]' size="1" 
                onChange="expand_select(this,<?php echo count($vendor_array); ?>)">
					<option value="0">Select</option>    
					<?php
					foreach($vendor_array as $val){						
						if(in_array($val['vend_man_id'],$vendor_ids)){
							$sel = "selected";
						}else{
							$sel = "";
						}						
						echo "<option value='".$val['vend_man_id']."' $sel>".$val['name']."</option>";				
					}
					?>
				</select>
			</div>

             <div style="float:right; height:100px; margin-top:36px; margin-right:20px;">
	            <button type="button" 
                	class="btn-default btn-bold with-bottom-shadow" 
                    onclick="update_sub_brand();">
                	    Save
				</button>
            </div>
        </div>
	</div>





