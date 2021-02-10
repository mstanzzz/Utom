<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'onlinecl/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/onlinecl'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'oldotgdev' )){  
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/oldotgdev'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){  
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site'; 
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Tool Settings";
$page_group = "tool";

	

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

//$db = $dbCustom->getDbConnect(CTGTOOL_DATABASE);

//$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$msg = '';

$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
$strip = (isset($_GET['strip'])) ? trim(mysql_escape_string($_GET['strip'])) : '';

$mat_id = (isset($_GET['mat_id'])) ? $_GET['mat_id'] : 0;


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>

<script>


function validate(theform){	

	/*
	if (theform.elements['chosen_categories[]'].selectedIndex == -1) {
	  alert("Please select parent categoty.");
	}
		
	var name = jQuery.trim(theform.name.value);
	if(name == ''){
		alert("Please enter category name");
		return false;				
	}

	*/


	return true;
}

</script>

<?php


		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
        $sql = "SELECT	mat_name
				,brand_id
				,vend_id
				,prod_num
				,core_id
				,type_id
				,finish_id
				,texture_id
				,green_id
				,mat_price_unit
				,mat_markup
				,mat_waste_allow
				,mat_weight_unit
				,mat_width
				,mat_height
				,mat_thickness
				,mat_stocked
				,stain_id
				,saas_id
			FROM materials
			WHERE mat_id = '".$mat_id."'";
        $result = $dbCustom->getResult($db,$sql);
        $object = $result->fetch_object();
		
		$_SESSION['temp_fields']['mat_name'] = $object->mat_name; 
		$_SESSION['temp_fields']['brand_id'] = $object->brand_id; 
		$_SESSION['temp_fields']['vend_id'] = $object->vend_id; 
		$_SESSION['temp_fields']['prod_num'] = $object->prod_num; 
		$_SESSION['temp_fields']['core_id'] = $object->core_id; 
		$_SESSION['temp_fields']['type_id'] = $object->type_id; 
		$_SESSION['temp_fields']['finish_id'] = $object->finish_id; 
		$_SESSION['temp_fields']['texture_id'] = $object->texture_id; 
		$_SESSION['temp_fields']['green_id'] = $object->green_id; 
		$_SESSION['temp_fields']['mat_price_unit'] = $object->mat_price_unit; 
		$_SESSION['temp_fields']['mat_markup'] = $object->mat_markup; 
		$_SESSION['temp_fields']['mat_waste_allow'] = $object->mat_waste_allow; 
		$_SESSION['temp_fields']['mat_weight_unit'] = $object->mat_weight_unit; 
		$_SESSION['temp_fields']['mat_width'] = $object->mat_width; 
		$_SESSION['temp_fields']['mat_height'] = $object->mat_height; 
		$_SESSION['temp_fields']['mat_thickness'] = $object->mat_thickness; 
		$_SESSION['temp_fields']['mat_stocked'] = $object->mat_stocked; 
		$_SESSION['temp_fields']['stain_id'] = $object->stain_id; 
		$_SESSION['temp_fields']['saas_id'] = $object->saas_id; 




		$url_str = "tool-material.php";
		$url_str .= "?strip=".$_SESSION['strip'];		
		$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
		$url_str .= "&search_str=".$_SESSION['search_str'];


?>
<form name="edit_material" action="<?php echo $url_str;  ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data">


            <div class="page_actions edit_page">
            	<?php //if($admin_access->product_catalog_level > 1){ 
					if(1){
				?> 
					<button class="btn btn-large btn-success" name='edit_cat' type='submit'><i class="icon-ok icon-white"></i> Save Changes</button>
				<?php }else{ ?>
        			<div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        		<?php } ?>		
                <hr />
				<a class="btn btn-primary toggleFieldsets" href="#"><i class="icon-minus-sign icon-white icon-white"></i> Collapse All Edit Areas </a><br />
				<a href="<?php echo $url_str; ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a>

			</div>
			<div class="page_content edit_page">
			
            <fieldset>
				<legend>Material Details<i class="icon-minus-sign icon-white"></i></legend>


				<div class="colcontainer">
				<label>Material Name</label>
				<input style="width:600px;" name="mat_name" type="text" value="<?php echo prepFormInputStr($_SESSION['temp_fields']['mat_name']); ?>" />
				</div>                


				<div class="colcontainer">
				<label>Product Number</label>
				<input style="width:100px;" name="prod_num" type="text" value="<?php echo prepFormInputStr($_SESSION['temp_fields']['prod_num']); ?>" />
				</div>                




				<div class="colcontainer">
				<label>Brand</label>
				<select name="brand_id">
                <option value="0"> Select </option>                
                <?php
                $db = $dbCustom->getDbConnect(CART_DATABASE);
                $sql = "SELECT brand_id	,name, profile_account_id	
                        FROM brand
						ORDER BY name, profile_account_id";
                $result = $dbCustom->getResult($db,$sql);
                while($row = $result->fetch_object()) {
					$selected = ($_SESSION['temp_fields']['brand_id'] == $row->brand_id) ? 'selected' : '';
					echo "<option value='".$row->brand_id."' ".$selected.">".$row->name."  ".$row->profile_account_id."</option>";	
				}
				?>                
                </select>
                </div>                

				<div class="colcontainer">
				<label>Vendor</label>
				<select name="vend_id">
                <option value="0"> Select </option>                
                <?php
                //$db = $dbCustom->getDbConnect(CART_DATABASE);
                $sql = "SELECT vend_man_id , name ,profile_account_id	
                        FROM vend_man
						ORDER BY name, profile_account_id";
                $result = $dbCustom->getResult($db,$sql);
                while($row = $result->fetch_object()) {
					$selected = ($_SESSION['temp_fields']['vend_id'] == $row->vend_man_id) ? 'selected' : '';
					echo "<option value='".$row->brand_id."' ".$selected.">".$row->name."  ".$row->profile_account_id."</option>";	
				}
				?>                
                </select>
                </div>                


				<div class="colcontainer">
				<label>Core</label>
				<select name="core_id">
                <option value="0"> Select </option>                
                <?php
                $db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
                $sql = "SELECT core_id ,core_name ,is_green ,saas_id	
                        FROM vend_man
						ORDER BY core_name, saas_id";
                $result = $dbCustom->getResult($db,$sql);
                while($row = $result->fetch_object()) {
					
					$grn = ($row->is_green) ? 'Green' : 'Not Green';
					$selected = ($_SESSION['temp_fields']['core_id'] == $row->core_id) ? 'selected' : '';					
					echo "<option value='".$row->core_id."' ".$selected.">".$row->core_name."  SAAS ID:".$row->saas_id."  Is Gren: ".$grn."</option>";	
				}
				?>                
                </select>
                </div>                


				<div class="colcontainer">
				<label>Material Type</label>
				<select name="mat_type_id">
                <option value="0"> Select </option>                
                <?php
                //$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
                $sql = "SELECT mat_type_id ,mat_type_name ,saas_id	
                        FROM material_types
						ORDER BY mat_type_name, saas_id";
                $result = $dbCustom->getResult($db,$sql);
                while($row = $result->fetch_object()) {
					
					$selected = ($_SESSION['temp_fields']['type_id'] == $row->mat_type_id) ? 'selected' : '';
					echo "<option value='".$row->mat_type_id."' ".$selected.">".$row->mat_type_name."  SAAS ID:".$row->saas_id."</option>";	
				}
				?>                
                </select>
                </div>                


				<div class="colcontainer">
				<label>Finish ID</label>
				<select name="finish_id">
                <option value="0"> Select </option>                
                <?php
                //$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
                $sql = "SELECT finish_id ,finish_name ,saas_id, tier_id, type_id	
                        FROM finish
						ORDER BY finish_name, saas_id";
                $result = $dbCustom->getResult($db,$sql);
                while($row = $result->fetch_object()) {
					
					
					$sql = "SELECT tier_name 	
                        FROM material_tiers
						WHERE tier_id = '".$row->tier_id."'";
                	$res1 = $dbCustom->getResult($db,$sql);
					$obj1 = $res->fetch_object();
					
					
					$sql = "SELECT mat_type_name 	
                        FROM material_types
						WHERE type_id = '".$row->type_id."'";
                	$res2 = $dbCustom->getResult($db,$sql);
					$obj2 = $res->fetch_object();
					
					$selected = ($_SESSION['temp_fields']['finish_id'] == $row->finish_id) ? 'selected' : '';
					
					echo "<option value='".$row->finish_id."' ".$selected.">".$row->finish_name."  SAAS ID:".$row->saas_id."  Tier Name: ".$obj1->tier_name."  mat_type_name: ".$obj2->mat_type_name."</option>";	
				}
				?>                
                </select>
                </div>                




				<div class="colcontainer">
				<label>Texture ID</label>
				<select name="tex_id">
                <option value="0"> Select </option>                
                <?php
                //$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
                $sql = "SELECT tex_id ,tex_name ,saas_id	
                        FROM textures
						ORDER BY tex_name, saas_id";
                $result = $dbCustom->getResult($db,$sql);
                while($row = $result->fetch_object()) {

					$selected = ($_SESSION['temp_fields']['tex_id'] == $row->tex_id) ? 'selected' : '';

					
					echo "<option value='".$row->mat_type_id."' ".$selected.">".$row->mat_type_name."  SAAS ID:".$row->saas_id."</option>";	
				}
				?>                
                </select>
                </div>                


		$_SESSION['temp_fields']['green_id'] = $object->green_id; 
		$_SESSION['temp_fields']['mat_price_unit'] = $object->mat_price_unit; 
		$_SESSION['temp_fields']['mat_markup'] = $object->mat_markup; 
		$_SESSION['temp_fields']['mat_waste_allow'] = $object->mat_waste_allow; 
		$_SESSION['temp_fields']['mat_weight_unit'] = $object->mat_weight_unit; 
		$_SESSION['temp_fields']['mat_width'] = $object->mat_width; 
		$_SESSION['temp_fields']['mat_height'] = $object->mat_height; 
		$_SESSION['temp_fields']['mat_thickness'] = $object->mat_thickness; 
		$_SESSION['temp_fields']['mat_stocked'] = $object->mat_stocked; 
		$_SESSION['temp_fields']['stain_id'] = $object->stain_id; 
		$_SESSION['temp_fields']['saas_id'] = $object->saas_id; 









				<div class="colcontainer">
				<label>SAAS ID</label>
				<select name="texture_id">
                <option value="0"> Select </option>                
                <?php
                $db = $dbCustom->getDbConnect(USER_DATABASE);
                $sql = "SELECT profile_acount_id, domain_name	
                        FROM profile_acount
						ORDER BY profile_acount_id";
                $result = $dbCustom->getResult($db,$sql);
                while($row = $result->fetch_object()) {
					
					echo "<option value='".$row->profile_acount_id."'>".$row->domain_name."  SAAS ID:".$row->profile_acount_id."</option>";	
				}
				?>                
                </select>
                </div>                




			</fieldset>

<!--
mat_id
mat_name
brand_id
vend_id
prod_num
core_id
type_id
finish_id
texture_id
green_id
mat_price_unit
mat_markup
mat_waste_allow
mat_weight_unit
mat_width
mat_height
mat_thickness
mat_stocked
stain_id
saas_id
-->


        
        </div>
    </form>
    
	
  </div>
 <p class="clear"></p>
    <?php
	if(!$strip){  
    	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	}
	?>
</div>
</body>
</html>
