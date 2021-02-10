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
 
$id = isset($_GET['id'])? $_GET['id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql = "SELECT hex_value
			,name
		FROM color
		WHERE id = '".$id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name; 
	$hex_value = $object->hex_value;
}
					
?>

<div class="content height-auto" style="padding-top:10px;">
	<div class="header" style="border-bottom: 1px solid #d4d4d4;">
		<span style="float:right; font-size:0.8em; margin-right:10px; cursor:pointer;" onclick="close_sub_edit_color();" >Cancel</span>
		<center>Edit Color</center>
	</div>
	<div class="main-content qty-form">
		<div class="plate-detail clearfix">
			<input type="hidden" id="update_this_color_id" name="id" value="<?php echo $id; ?>">

			<label style="margin-left:20px; margin-top:15px; font-size:1.1em;" class="modal-tool-admin-label">Name</label>
            <input type="text" class="input-border-bottom" id="update_this_color_name" name="name" 
            	style="width:220px; height:40px; font-size: 0.8em;" value="<?php echo $name; ?>">
		</div>
        <div class="plate-detail clearfix">
        	<div class="input-color-container" style="margin-left:40px;">
            	<input class="input-color color-value" id="update_this_hex_value" name="hex_value" type="color" value="<?php echo $hex_value; ?>">
			</div>
		</div>
        <div class="create-new-qty-btn-wrapper" style="padding-bottom:20px;">
	    	<button class="btn-default btn-bold with-bottom-shadow" onclick="update_sub_color();">Save</button>
        </div>
	</div>
</div>
