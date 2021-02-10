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



$swg_id = isset($_GET['swg_id'])? $_GET['swg_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql =  sprintf("SELECT swg_name	
					FROM cabinetry_section_width_groups 
					WHERE swg_id = '%u'", $swg_id);
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
	
    
    					<h4 class="title text-capitalize">Edit Dimension Restriction Detail</h4>


							<span style="cursor:pointer; float:right;" onclick="close_sub_edit_swg();">Cancel</span>
                            
                            <div class="edit-form-wrapper name" style="height:40px;">
                                	<label class="text-italic" style="width:300px;">Dimension Restriction Name</label>
                                	<input type="text" class="edit-input" style="width:220px;" id="edit_sub_swg_name" name="swg_name" value="<?php echo $swg_name; ?>">
                                <div style="width:22px;position:relative; top: -35px; left:226px;">
                                	<img style="opacity: 0.7; width: 22px;" 
                                    src="<?php echo $ste_root; ?>/manage/assets/svg/edit.svg" alt="">
                                </div>
                                
                            </div>
                         
                            <div style="height:88px;">
                                <label class="text-italic">Select Option</label>
                                <select multiple id="edit_sub_swg_dim_ids" name="dim_ids[]" class="rounded-select" style="z-index:22;"
                                 size="1" onChange="expand_select(this,<?php echo count($dimension_array); ?>)">
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
							
                            <div style="float:right;">
                                <button 
                                	class="btn-default btn-bold btn-mint-border with-bottom-shadow" 
                                    onclick="update_sub_swg(<?php echo $swg_id; ?>)">
                                    Save
                                </button>
                                
                            </div>


