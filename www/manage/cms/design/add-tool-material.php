<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Tool Settings";
$page_group = "tool";

	

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

//$db = $dbCustom->getDbConnect(CTGTOOL_DATABASE);

//$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$msg = '';

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
$strip = (isset($_GET['strip'])) ? $_GET['strip'] : '';
$search_str = (isset($_GET['search_str'])) ? $_GET['search_str'] : '';
require_once($real_root.'/manage/admin-includes/doc_header.php'); 

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

</head>
<body>

<?php
if(!$strip){ 
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php
		if(!$strip){  
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">




<?php




		$url_str = "tool-material.php";
		$url_str .= "?strip=".$strip;		
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		$url_str .= "&search_str=".$search_str;


?>
<form name="add_material" action="<?php echo $url_str;  ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data">

<input type="hidden" name="add_material" value="1" />            

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
				<input style="width:600px;" name="mat_name" type="text" value="" />
				</div>                


				<div class="colcontainer">
				<label>Product Number</label>
				<input style="width:100px;" name="prod_num" type="text" value="" />
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
					echo "<option value='".$row->brand_id."'>".$row->name."  ".$row->profile_account_id."</option>";	
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
					echo "<option value='".$row->brand_id."'>".$row->name."  ".$row->profile_account_id."</option>";	
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
                        FROM core
						ORDER BY core_name, saas_id";
                $result = $dbCustom->getResult($db,$sql);
                while($row = $result->fetch_object()) {
					
					$grn = ($row->is_green) ? 'Green' : 'Not Green';
					
					echo "kkkkkkkkkkkkkkkkkkkk<option value='".$row->core_id."'>".$row->core_name."  SAAS ID:".$row->saas_id."  Is Gren: ".$grn."</option>";	
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
					
					echo "<option value='".$row->mat_type_id."'>".$row->mat_type_name."  SAAS ID:".$row->saas_id."</option>";	
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
					
					
					echo "<option value='".$row->finish_id."'>".$row->finish_name."  SAAS ID:".$row->saas_id."  Tier Name: ".$obj1->tier_name."  mat_type_name: ".$obj2->mat_type_name."</option>";	
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
					
					echo "<option value='".$row->mat_type_id."'>".$row->mat_type_name."  SAAS ID:".$row->saas_id."</option>";	
				}
				?>                
                </select>
                </div>   
                
                
                
                
                             



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
    
	
 <p class="clear"></p>
    <?php
	if(!$strip){  
    	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	}
	?>
</div>
</body>
</html>
