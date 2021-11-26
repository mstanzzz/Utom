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
require_once($real_root."/includes/config.php");
 
if(!isset($_SESSION['parent_modal'])) $_SESSION['parent_modal'] = 'add';

$finish_id = isset($_GET['finish_id'])? $_GET['finish_id'] : 0;

$first_load = isset($_GET['first_load'])? $_GET['first_load'] : 0;

$_SESSION['finish_id'] = ($finish_id > 0) ? $finish_id : 0; 

$tool_image = isset($_GET['tool_image'])? $_GET['tool_image'] : '';

if($tool_image != ""){	
	$_SESSION['tmp_vars']['tool_image'] = $_GET['tool_image'];
	$_SESSION['tool_image'] = '';
}


$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);


if($first_load > 0){
	
	$sql =  sprintf("SELECT	finish_name
						,type_id
						,tool_color
						,tool_alpha
						,tool_image
				FROM finishes
				WHERE finish_id = '%u'", $finish_id);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){	
		$object = $result->fetch_object(); 	
		$finish_name = $object->finish_name;
		$type_id = $object->type_id;
		$tool_color = $object->tool_color;
		$tool_alpha = $object->tool_alpha;
		$tool_image = $object->tool_image;
		
		//echo "tool_image:    ".$object->tool_image;
		
	}else{
		$finish_name = 'Required Field';
		$type_id = "";
		$tool_color = "";
		$tool_alpha = "";
		$tool_image = "";
	}

		$_SESSION['tmp_vars']['finish_name'] = $finish_name;
		$_SESSION['tmp_vars']['type_id'] = $type_id; 
		$_SESSION['tmp_vars']['tool_color'] = $tool_color; 
		$_SESSION['tmp_vars']['tool_alpha'] = $tool_alpha; 
		$_SESSION['tmp_vars']['tool_image'] = $tool_image; 

		//echo "KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK";			
}



$sql = "SELECT 	material_type_id	
			,material_type_name		
		FROM material_types
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY material_type_name";
$result = $dbCustom->getResult($db,$sql);
$material_type_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$material_type_array[$i]['material_type_id'] = $row->material_type_id;
	$material_type_array[$i]['material_type_name'] = $row->material_type_name; 
	$i++;
}

					
?>

                    
<h4 class="title">Update Finish</h4>
<div>
    <ul>
        <li>
	        <a href="#" onClick="update_sub_finish(<?php echo $_SESSION['finish_id']; ?>);">Save Changes</a>
        </li>
        <li>&nbsp;</li>
        <li>
    	    <a href="#" onclick="close_sub_edit_finish();">Cancel</a> 
        </li>
    </ul>
</div>
                    
<div class="edit-form-wrapper name finishes-edit-wrapper">
    <label class="text-italic">Finish Name*</label>
    <input type="text" id="edit_this_finish_name" name="finish_name" value="<?php echo $_SESSION['tmp_vars']['finish_name']; ?>" 
	    class="input-invisable-bold" style="width:340px;" />
    <img class="icon" src="<?php echo SITEROOT; ?>manage/assets/svg/edit.svg" alt="">
</div>

<div class="edit-form-wrapper no-border">
	<div style="float:left; width:100px; margin-top:23px;">
	    <div class="input-color-container">
    	<input class="input-color color-value" id="edit_this_tool_color" name="tool_color" value="<?php echo $_SESSION['tmp_vars']['tool_color']; ?>" type="color">
    	</div>
	</div>
    <div style="float:left; width:60px;">
        <label class="text-italic">Alpha </label>
        <input type="text" class="full-width smaller-input" id="edit_this_tool_alpha" name="tool_alpha" value="<?php echo $_SESSION['tmp_vars']['tool_alpha']; ?>">
    </div>
    <div style="float:left; width:50px; margin-top:10px; margin-left:12px; line-height:10px;">
	    <span style="font-size:10px; font-style:italic; ">must be a number between 0 and 1</span>
    </div>
    <div style="float:right;">
        <label class="text-italic">Type</label>
        <select id="edit_this_type_id" name="type_id" class="rounded-select inline-block">
        <option value="0">Select Type</option>
        <?php
        foreach($material_type_array as $val){										
        $sel = ($val['material_type_id'] == $_SESSION['tmp_vars']['type_id'])? "selected" : '';
        echo "<option value='".$val['material_type_id']."' $sel>".$val['material_type_name']."</option>";	
        }
        ?>
        </select>
    </div>
	<div style="clear:both;"></div>
    <div style="float:left; width:76px; height:100px;">
    &nbsp;
    </div>
    <div style="float:left; width:220px; margin-top:22px;">
    <label class="text-italic">Tool Image</label>
    <input type="text" class="full-width smaller-input" id="edit_this_tool_image" 
	    name="tool_image" value="<?php echo $_SESSION['tmp_vars']['tool_image']; ?>">
    </div>
    <div style="float:right; margin-top:52px;">
    <form id="modify_finish_upload_form_edit" method="post" enctype="multipart/form-data">
        <div class="file-container btn-default btn-mint-border">
            <label for="">Browse...</label>
            <input type="file" name="uploadedfile" id="uploadedfile" class="greyed-input" 
            onchange="submit_modify_finish_upload('<?php echo $_SESSION['parent_modal']; ?>','edit','<?php echo $_SESSION['finish_id']; ?>');">
        </div>
	</form>
    </div>                         
    <div style="clear:both;"></div>
</div>
               
