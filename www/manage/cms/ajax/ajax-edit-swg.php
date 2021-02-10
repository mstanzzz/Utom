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

$_SESSION['ret_modal'] = 'edit';

function getDimArray($swg_id){
	
	$ret = array();
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT dimension_id
			FROM cabinetry_section_width_groups_collection
			WHERE swg_id = '".$swg_id."'";
   	$result = $dbCustom->getResult($db,$sql);
	
	while($row = $result->fetch_object()){
		$ret[] = $row->dimension_id; 
	}
	
	return $ret;
}



$_SESSION['swg_id'] = isset($_GET['swg_id'])? $_GET['swg_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql =  sprintf("SELECT swg_name	
					FROM cabinetry_section_width_groups 
					WHERE swg_id = '%u'", $_SESSION['swg_id']);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){	
		$object = $result->fetch_object(); 	
		$swg_name = $object->swg_name;
	}else{
		$swg_name = '';
	}
	
	// if has multi 
	$dim_ids = getDimArray($_SESSION['swg_id']);

	// for drop down
	$sql = "SELECT dimension_id
				,dimension_label 
			FROM dimensions
			WHERE saas_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	$dimension_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$dimension_array[$i]['dimension_label'] = $row->dimension_label; 
		$dimension_array[$i]['dimension_id'] = $row->dimension_id;
		$i++;
	}
					
?>

<div class="edit-container">
    <h4 class="title text-capitalize">Edit Dimension Restriction Detail</h4>
    <div>
        <ul>
        <li>
        <a href="#" onClick="submit_edit_swg_form();">Update</a>
        </li>
        <li>
        <a href="#" onClick="delete_swg(<?php echo $_SESSION['swg_id']; ?>);">Delete</a>
        </li>
        <li>
        <a href="#" onclick="close_modal_edit();">Cancel</a>
        </li>
        </ul>
    </div>
    <form id="edit_swg_form" action="dimension-restrictions.php" method="post" enctype="multipart/form-data" target="_parent">	
    <input type="hidden" name="update_swg" value="1">
    <input type="hidden" name="swg_id" value="<?php echo $_SESSION['swg_id']; ?>" />
    <div class="edit-form-wrapper name">
        <label class="text-italic">Dimension Restriction Name</label>
        <input type="text" class="edit-input" style="width:220px;" id="edit_swg_name" name="swg_name" value="<?php echo $swg_name; ?>">
        <img class="icon" src="<?php echo $ste_root; ?>/manage/assets/svg/edit.svg" alt="">
    </div>
    <div class="edit-form-wrapper no-border">
        <label class="text-italic">Select Option</label>
        <select id="edit_dim_ids" multiple name="dim_ids[]" class="rounded-select" size="1" onChange="expand_select(this,<?php echo count($dimension_array); ?>)">
        <?php
        foreach($dimension_array as $val){
        if(in_array($val['dimension_id'] , $dim_ids)){
        $sel = "selected";	
        }else{
        $sel = '';
        }
        echo "<option value='".$val['dimension_id']."' $sel>".$val['dimension_label']."</option>"; 
        }
        ?>
        </select>
    </div>
</form>
</div>


