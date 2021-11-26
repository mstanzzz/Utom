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

$_SESSION['ret_modal'] = 'edit';

$_SESSION['panel_id'] = isset($_GET['panel_id'])? $_GET['panel_id'] : 0;

$first_load = isset($_GET['first_load'])? $_GET['first_load'] : 0;


if(!is_numeric($_SESSION['panel_id'])){
	exit;	
}

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

//echo $first_load;
//echo "<br />";
//echo $_SESSION['panel_id'];
//echo "<br />";

if($first_load > 0){


	$sql = "SELECT panel_name
				,panel_image
				,panel_sku
				,panel_number						
				,panel_weight
				,price_schema_id
				,material_id
				,dim_x
				,dim_y
				,dim_z
				,panel_brand						
				,layout_render_id
				,price_unit
				,qty_unit
				,qty_schema_id
				,part_type_id
				,qty_calc_id
	FROM cabinetry_panels
	WHERE panel_id = '".$_SESSION['panel_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
       	$object = $result->fetch_object();
		
						
		$_SESSION['tmp_vars']['panel_name'] = $object->panel_name;
		$_SESSION['tmp_vars']['panel_image'] = $object->panel_image;
		$_SESSION['tmp_vars']['panel_sku'] = $object->panel_sku;
		$_SESSION['tmp_vars']['panel_number'] = $object->panel_number;
		$_SESSION['tmp_vars']['panel_weight'] = $object->panel_weight;
		$_SESSION['tmp_vars']['price_schema_id'] = $object->price_schema_id;
		$_SESSION['tmp_vars']['material_id'] = $object->material_id;
		
		$_SESSION['tmp_vars']['dim_x'] = $object->dim_x;
		$_SESSION['tmp_vars']['dim_y'] = $object->dim_y;
		$_SESSION['tmp_vars']['dim_z'] = $object->dim_z;	
		
		$_SESSION['tmp_vars']['panel_brand'] = $object->panel_brand;
		$_SESSION['tmp_vars']['qty_calc_id'] = $object->qty_calc_id;
		
	
		$_SESSION['tmp_vars']['price_unit'] = $object->price_unit;
		$_SESSION['tmp_vars']['qty_unit'] = $object->qty_unit;
		$_SESSION['tmp_vars']['qty_schema_id'] = $object->qty_schema_id;
		
		$_SESSION['tmp_vars']['part_type_id'] = $object->part_type_id;
				
							
	}else{		
		echo 'Does not exist';
		exit;	
	}
}

	$_SESSION['constructed_part_array'] = array();
	$_SESSION['fixed_part_array'] = array();
    
	$sql = "SELECT cabinetry_panels_to_parts.part_id
					,cabinetry_panels_to_parts.part_qty
					,parts.part_name
					,parts.part_type_id
			FROM parts, cabinetry_panels_to_parts
			WHERE parts.part_id = cabinetry_panels_to_parts.part_id
			AND cabinetry_panels_to_parts.is_fixed_part = '0'
			AND cabinetry_panels_to_parts.panel_id = '".$_SESSION['panel_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['constructed_part_array'][$i]['part_id'] = $row->part_id;
		$_SESSION['constructed_part_array'][$i]['part_name'] = $row->part_name;
		$_SESSION['constructed_part_array'][$i]['part_type_id'] = $row->part_type_id;	
		$_SESSION['constructed_part_array'][$i]['qty'] = $row->part_qty;	
		$i++;
	}

	$sql = "SELECT cabinetry_panels_to_parts.part_id
					,cabinetry_panels_to_parts.part_qty
					,parts.part_name
					,parts.part_type_id
			FROM parts, cabinetry_panels_to_parts
			WHERE parts.part_id = cabinetry_panels_to_parts.part_id
			AND cabinetry_panels_to_parts.is_fixed_part = '1'
			AND cabinetry_panels_to_parts.panel_id = '".$_SESSION['panel_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['fixed_part_array'][$i]['part_id'] = $row->part_id;
		$_SESSION['fixed_part_array'][$i]['part_name'] = $row->part_name;
		$_SESSION['fixed_part_array'][$i]['part_type_id'] = $row->part_type_id;	
		$_SESSION['fixed_part_array'][$i]['qty'] = $row->part_qty;	
		$i++;
	}




$brand_array = array();

$sql = "SELECT panel_brand_id 
				,panel_brand_name	
		FROM panel_brands
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY panel_brand_name";
$result = $dbCustom->getResult($db,$sql);
$i = 0;
while($row = $result->fetch_object()){
	$brand_array[$i]['panel_brand_id'] = $row->panel_brand_id; 
	$brand_array[$i]['panel_brand_name'] = $row->panel_brand_name;
	$i++;
}


$materials_array = array();

$sql = "SELECT material_id 
			,material_name	
		FROM materials
		ORDER BY material_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$materials_array[$i]['material_id'] = $row->material_id;
	$materials_array[$i]['material_name'] = $row->material_name;
	$i++;
}

$price_schema_array = array();					

$sql = "SELECT price_schema_id 
			,price_schema_name	
		FROM price_schema
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY price_schema_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$price_schema_array[$i]['price_schema_id'] = $row->price_schema_id;
	$price_schema_array[$i]['price_schema_name'] = $row->price_schema_name;
	$i++;
}


$qty_schema_array = array();

$sql = "SELECT qty_schema_id 
			,qty_schema_name	
		FROM qty_schema
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY qty_schema_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$qty_schema_array[$i]['qty_schema_id'] = $row->qty_schema_id;
	$qty_schema_array[$i]['qty_schema_name'] = $row->qty_schema_name;
	$i++;
}



$qty_calc_array = array();

$sql = "SELECT qty_calc_id 
			,qty_calc_name	
		FROM qty_calc_equations
		ORDER BY qty_calc_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$qty_calc_array[$i]['qty_calc_id'] = $row->qty_calc_id;
	$qty_calc_array[$i]['qty_calc_name'] = $row->qty_calc_name;
	$i++;
}


$collection_array = array();

$sql = "SELECT collection_id
			,collection_name
		FROM  collection 
		WHERE saas_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$collection_array[$i]['collection_id'] = $row->collection_id;
	$collection_array[$i]['collection_name'] = $row->collection_name;
	$i++;
}



	//$_SESSION['constructed_part_array'] = array();
	//$_SESSION['fixed_part_array'] = array();

					
?>


<div class="modal-tool-admin clearfix" style="border-bottom:none;">
	<p class="modal-tool-admin-title"> Edit Section Panel</p>
	<form id="upload_form_main_edit"  method="post" enctype="multipart/form-data">				
	<div class="file-container btn-default btn-mint-border" style="width:192px;">
        <label class="modal-tool-admin-label">Select New Image File</label>
        <input type="file" name="uploadedfile" id="uploadedfile" onchange="submit_edit_panel_upload(<?php echo $_SESSION['panel_id']; ?>);">
    </div>
	</form>
</div>                
<form action="<?php echo SITEROOT; ?>manage/tool-admin/section-panel.php" onsubmit="return validate(this);" method="post">
<input type="hidden" name="panel_id" value="<?php echo $_SESSION['panel_id']; ?>" />
<input type="hidden" name="update_panel" value="1" />
<div class="modal-tool-admin clearfix">
    <div class="clearfix">
        <div class="left-side">    
            <div class="separator-text-input">
                <label class="modal-tool-admin-label">Panel Name*</label>
                <input type="text" class="input-border-bottom input-italic" 
                id="edit_panel_name" name="panel_name" value="<?php echo $_SESSION['tmp_vars']['panel_name']; ?>"/>
            </div>  
            <div class="plate-detail clearfix cleat-name-label">
                <label class="modal-tool-admin-label ">Constructed Part</label>
                <button  type="button" class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-plate-detail add-constructed-parts" 
                onClick="open_modal_add_panel_constructed_part_edit();">
                Add Constructed Part
                </button>
                <button type="button" 
                onClick="open_modal_by_id('modify_constructed_part');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <ul id="ajx_part_list_edit">
				<?php
                foreach($_SESSION['constructed_part_array'] as $key => $v){
                echo "<li>".stripslashes($v['part_name']);
                echo "<span style='margin-left:8px;'>QTY:</span>".$v['qty'];
                echo "<a style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_constructed_part(".$v['part_id'].")'>delete</a></li>";
                }
                ?>
            </ul>
            <div class="plate-detail clearfix cleat-name-label">
                <label class="modal-tool-admin-label">Catalog Part</label>
                <button type="button" class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-plate-detail add-catalog-parts" 
                onclick="open_modal_add_panel_fixed_part_edit();">
                Add Catalog Part
                </button>
                <button type="button" 
                onClick="open_modal_by_id('modify_catalog_part');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>                      
            </div>
            <ul id="ajx_fixed_part_list_edit">
            <?php
                    foreach($_SESSION['fixed_part_array'] as $key => $v){
						echo "<li>".stripslashes($v['part_name']);
						echo "<span style='margin-left:8px;'>QTY:</span>".$v['qty'];
						echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_fixed_part(".$v['part_id'].")'>delete</span></li>";
                    }
			?>
			</ul>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label" style="width:190px;">Panel Image</label>
                <input type="text" style="width:160px;" class="input-border-bottom" 
                id="edit_panel_image" name="panel_image" value="<?php echo $_SESSION['tmp_vars']['panel_image']; ?>" />
            </div>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label" style="width:190px;">Panel SKU</label>
                <input type="text" style="width:160px;" class="input-border-bottom" 
                id="edit_panel_sku" name="panel_sku"  value="<?php echo $_SESSION['tmp_vars']['panel_sku']; ?>"/>
            </div>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label" style="width:190px;">Panel Number</label>
                <input type="text" style="width:160px;" class="input-border-bottom" 
                id="edit_panel_number" name="panel_number"  value="<?php echo $_SESSION['tmp_vars']['panel_number']; ?>"/>
            </div>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label" style="width:190px;">Panel Weight</label>
                <input type="text" style="width:160px;" class="input-border-bottom" 
                id="edit_panel_weight" name="panel_weight"  value="<?php echo $_SESSION['tmp_vars']['panel_number']; ?>"/>
            </div>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label" style="width:190px;">Dim X</label>
                <input type="text" style="width:160px;" class="input-border-bottom" 
                id="edit_dim_x" name="dim_x" value="<?php echo $_SESSION['tmp_vars']['dim_x']; ?>"/>
            </div>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label" style="width:190px;">Dim Y</label>
                <input type="text" style="width:160px;" class="input-border-bottom" 
                id="edit_dim_y" name="dim_y" value="<?php echo $_SESSION['tmp_vars']['dim_y']; ?>"/>
            </div>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label" style="width:190px;">Dim Z</label>
                <input type="text" style="width:160px;" class="input-border-bottom" 
                id="edit_dim_z" name="dim_z" value="<?php echo $_SESSION['tmp_vars']['dim_z']; ?>"/>
            </div>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label" style="width:190px;">Unit Price</label>
                <input type="text" style="width:160px;" class="input-border-bottom" 
                id="edit_price_unit" name="price_unit" value="<?php echo $_SESSION['tmp_vars']['price_unit']; ?>"/>
            </div>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label" style="width:190px;">Unit Qty</label>
                <input type="text" style="width:160px;" class="input-border-bottom" 
                id="edit_qty_unit" name="qty_unit" value="<?php echo $_SESSION['tmp_vars']['qty_unit']; ?>"/>
            </div>
        </div>
        <div class="right-side">

                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
					<label style="margin-left:-26px;">Part Type</label>
                    	<select id="edit_part_type_id" name="part_type_id" class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        	<option value="0">Select</option>    
                            <?php
                            foreach($part_type_array as $val){
                            $sel = ($_SESSION['tmp_vars']['part_type_id'] == $val['part_type_id'])? "selected" : '';			
                            echo "<option value='".$val['part_type_id']."' $sel>".$val['part_type_name_user']."</option>";								
                            }
                            ?>
						</select>
                    <!--
					<button type="button" 
                    	onClick="open_modal_by_id('modify_part_type');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                        	Modify
					</button>
                    -->
				</div>

                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
					<label style="margin-left:-26px;">Brand</label>
                    	<select id="edit_panel_brand_id" name="panel_brand_id" class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">              
                        	<option value="0">Select</option>    
                            <?php
                            foreach($brand_array as $val){
                            $sel = ($_SESSION['tmp_vars']['panel_brand_id'] == $val['panel_brand_id'])? "selected" : '';			
                            echo "<option value='".$val['panel_brand_id']."' $sel>".$val['panel_brand_name']."</option>";								
                            }
                            ?>
						</select>

					<button type="button" 
                    	onClick="open_modal_by_id('modify_brand');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                        	Modify
					</button>
                                              
				</div>

                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
					<label style="margin-left:-26px;">Material</label>
                    	<select id="edit_material_id" name="material_id" class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        	<option value="0">Select</option>    
                            <?php
                            foreach($materials_array as $val){
                            $sel = ($_SESSION['tmp_vars']['material_id'] == $val['material_id'])? "selected" : '';			
                            echo "<option value='".$val['material_id']."' $sel>".$val['material_name']."</option>";								
                            }
                            ?>
						</select>

					<button type="button" 
                    	onClick="open_modal_by_id('modify_material');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                        	Modify
					</button>
                      
				</div>
                

                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
					<label style="margin-left:-26px;">Price Scmeme</label>
                    	<select id="edit_price_schema_id" name="price_schema_id" class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        	<option value="0">Select</option>    
                            <?php
                            foreach($price_schema_array as $val){
                            $sel = ($_SESSION['tmp_vars']['price_schema_id'] == $val['price_schema_id'])? "selected" : '';			
                            echo "<option value='".$val['price_schema_id']."' $sel>".$val['price_schema_name']."</option>";								
                            }
                            ?>
						</select>

					<button type="button" 
                    	onClick="open_modal_by_id('modify_price_schema');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                        	Modify
					</button>
                          
				</div>

                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
					<label style="margin-left:-26px;">QTY Scmeme</label>
                    	<select id="edit_qty_schema_id" name="qty_schema_id" class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">              
                        	<option value="0">Select</option>    
                            <?php
                            foreach($price_schema_array as $val){
                            $sel = ($_SESSION['tmp_vars']['qty_schema_id'] == $val['qty_schema_id'])? "selected" : '';			
                            echo "<option value='".$val['qty_schema_id']."' $sel>".$val['qty_schema_name']."</option>";								
                            }
                            ?>
						</select>

					<button type="button" 
                    	onClick="open_modal_by_id('modify_qty_schema');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                        	Modify
					</button>
                    
                    
                          
				</div>
                
                 <div class="label-with-dropdown label-with-dropdown-separator clearfix">
					<label style="margin-left:-26px;">QTY Calculation</label>
                    	<select id="edit_qty_calc_id" name="qty_calc_id" class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">              
                        	<option value="0">Select</option>    
                            <?php
                            foreach($qty_calc_array as $val){
                            $sel = ($_SESSION['tmp_vars']['qty_calc_id'] == $val['qty_calc_id'])? "selected" : '';			
                            echo "<option value='".$val['qty_calc_id']."' $sel>".$val['qty_calc_name']."</option>";								
                            }
                            ?>
						</select>
                    
					<button type="button" 
                    	onClick="open_modal_by_id('modify_qty_calc');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                        	Modify
					</button>
                                                    
				</div>
               
                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
					<label style="margin-left:-26px;">Choose One or More Collections</label>
                    	<select id="edit_collection_id" name="collection_id" class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        	<option value="0">Select</option>    
                            <?php
                            foreach($collection_array as $val){
                            $sel = ($_SESSION['tmp_vars']['collection_id'] == $val['collection_id'])? "selected" : '';			
                            echo "<option value='".$val['collection_id']."' $sel>".$val['collection_id']."</option>";								
                            }
                            ?>
						</select>
                    
					<button type="button" 
                    	onClick="open_modal_by_id('modify_collection');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                        	Modify
					</button>
				</div>
            </div>    
		</div>


		<div class="container-btn-bottom">
            <button class="btn-default btn-bold with-bottom-shadow btn-with-border">
            Save
            </button>
            <span class="modal-close" onclick="close_modal_edit();">Cancel</span>
		</div>
	</div>

</form>




<?php
		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		$sql = "SELECT part_id	
					,part_name		
				FROM parts 
				WHERE parts.part_category='0' 
				AND saas_id = '".$_SESSION['profile_account_id']."'
				ORDER BY part_name";
		$result = $dbCustom->getResult($db,$sql);
?>

<div  id="modal_add_panel_constructed_part_edit" class="edit-container add-new-scheme-parameter"
	style="visibility:hidden; position:absolute; top:200px; left:64%; z-index:22;">
	<form>
	<div class="edit-form-wrapper no-border">
        <label class="text-italic">Add new Constructed Part</label>
        <select id="part_id_edit" class="rounded-select" style="width:180px;">
            <option value="0">Select Options</option>
            <?php
				while($row = $result->fetch_object()) {
					echo "<option value='".$row->part_id."'>".stripslashes($row->part_name)."</option>";
				}
				?>
        </select>
    </div>
    <div class="edit-form-wrapper sort-order no-border">
        <label class="text-italic">QTY</label>
        <input type="text" id="part_qty_edit" class="greyed-input input-width-140">
    </div>
    <div class="btn-wrapper-center">
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_panel_constructed_part_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_panel_constructed_part_edit(); add_session_constructed_part_edit();">
    	    Add
        </button>
    </div>
    </form>
</div>




<?php
		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		$sql = "SELECT part_id	
					,part_name		
				FROM parts 
				WHERE parts.part_category='1' 
				AND saas_id = '".$_SESSION['profile_account_id']."'
				ORDER BY part_name";
		$result = $dbCustom->getResult($db,$sql);
?>
<div id="modal_add_panel_fixed_part_edit" class="edit-container add-new-scheme-parameter"
	style="visibility:hidden; position:absolute; top:200px; left:64%; z-index:22;">
        		
	<form>
	<div class="edit-form-wrapper no-border">
        <label class="text-italic">Add new Catalog Part</label>

		<select id="fixed_part_id_edit" class="small-popoup-select-box" style="width:180px; font-size:12px;">
                <?php
				while($row = $result->fetch_object()) {
				echo "<option value='".$row->part_id."'>".stripslashes($row->part_name)."</option>";
				}
				?>
        </select>
    </div>            
    <div class="edit-form-wrapper sort-order no-border">
        <label class="text-italic">QTY</label>
        <input type="text" id="fixed_part_qty_edit" name="qty" value="1" class="greyed-input input-width-140">
    </div>
    <div class="btn-wrapper-center">
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_panel_fixed_part_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_panel_fixed_part_edit(); add_session_fixed_part_edit();">
    	    Add
        </button>
    </div>
    </form>
</div>
<?php
	$_SESSION['ret_modal'] = '';
?>