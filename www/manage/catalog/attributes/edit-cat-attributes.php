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


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');


$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Category Attributes";
$page_group = "cat";

	

if(isset($_GET['firstload'])){
	unset($_SESSION['temp_attr_ids']);
	unset($_SESSION['cat_id']);	
	unset($_SESSION['img_id']);
}

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $cat_id;

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['restricted_attributes'])){
	
	$restricted_attributes = (isset($_POST["restricted_attributes"]))? $_POST["restricted_attributes"] : array();	
	
	$sql = "DELETE FROM category_to_attr 
			WHERE cat_id = '".$_SESSION['cat_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	foreach($restricted_attributes as $val){
		$sql = "INSERT INTO category_to_attr
				(attribute_id, cat_id)
				VALUES
				('".$val."', '".$_SESSION['cat_id']."')";		
		$result = $dbCustom->getResult($db,$sql);	
		
		//echo $val;
		//echo "<br />";
	}
	
	$msg = "Update  Successfull";

	unset($_SESSION['temp_attr_ids']);

}

if(!isset($_SESSION['temp_attr_ids'])) $_SESSION['temp_attr_ids'] = getCatAttrArray($_SESSION['cat_id']);

if(!isset($_SESSION['temp_cats'])) $_SESSION['temp_cats'] = getCatParentCats($_SESSION['cat_id']);

if(isset($_GET['copy_attr'])){
	
	$attr_array = array();	
	$i = 0;
	
	

	foreach($_SESSION['temp_cats'] as $cat_v){
			
		$sql = "SELECT attribute_id 
				FROM category_to_attr 
				WHERE cat_id = '".$cat_v['cat_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		while($row = $result->fetch_object()) {
			$attr_array[$i] = $row->attribute_id;
			$i++;
		}
	}
	
	$_SESSION['temp_attr_ids'] = $attr_array;
}


$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = sprintf("SELECT * FROM category WHERE cat_id = '%u'", $_SESSION['cat_id']);
$result = $dbCustom->getResult($db,$sql);if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name;
	$img_id = $object->img_id;

}else{
	$name = '';
	$img_id	= 0;
}




if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $img_id;	

if(!isset($_SESSION['name'])) $_SESSION['name'] = $name;	





require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>

<script>

$(document).ready(function() {
	
	$("#copy_attr").click(function(e){
		e.preventDefault();
		var q_str = "?action=2"+get_query_str();
		//alert(q_str);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_cat_session.php'+q_str,
		  success: function(data) {			
			
			//alert(data);
			
			location.href = "edit-category.php?copy_attr=1"; 
		  }
		});		
	});



});


function get_query_str(){
	
//name, tool_tip, show_on_home_page, restricted_attributes[]	
	var query_str = '';
	var attr_str = '';
	var cat_str = '';

	attr_str = $("#r_attr option:selected").map(function(){ return this.value }).get().join("|");
	//alert(attr_str);	 
	query_str += "&attr_str="+attr_str; 


	//alert(query_str); 	
	return query_str;
}

</script>

</head>
<body>
<div class="manage_page_container lightbox">
	<div class="manage_main">
        
    
    	<?php 
		
		require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		
        
		$url_str = "edit-cat-attributes.php";
		$url_str .= "?cat_id=".$_SESSION['cat_id'];
		

		?>
		<form name="edit_cat" action="<?php echo $url_str;  ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data">
		  	<input id="cat_id" type="hidden" name="cat_id" value="<?php echo $_SESSION['cat_id'];  ?>" />
            
            <div class="page_actions edit_page">
            	<?php if($admin_access->product_catalog_level > 1){ ?> 
					<button class="btn btn-large btn-success" name='edit_cat' type='submit'><i class="icon-ok icon-white"></i> Save Changes</button>
				<?php }else{ ?>
        			<div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        		<?php } ?>		
                <hr />
                <!--
				<a href="<?php //echo $url_str; ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a>
                -->

			</div>

			<div class="page_content edit_page">

            <fieldset>
	            <div class="colcontainer">
                <h1>
				
                <?php
					echo $_SESSION['name']
				?>		
                </h1>        
				</div>

                <div class="colcontainer">

                    <?php
					
						
					
							$db = $dbCustom->getDbConnect(CART_DATABASE);
							$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
							$img_res = $dbCustom->getResult($db,$sql);
							
							if($img_res->num_rows > 0){
								$img_obj = $img_res->fetch_object();
								echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$img_obj->file_name."'>";	
							}
							
					?>
				</div>   				

			</fieldset>

            
      		<fieldset>
				<legend>Allowed Attributes<i class="icon-minus-sign icon-white"></i></legend>
				<div class="alert alert-info">
                	<span class="fltlft">
                    	<i class="icon-info-sign icon-white"></i>
                    </span>
                    <strong>Restrict which product attributes are available</strong> in this category. Leave blank to allow all attributes for products in this category.
                </div>
				<div class="colcontainer">
					<label>Choose Attributes</label>
						<div class='twocols'>
							<?php 
							$block = '';
							$block .= "<select id='r_attr' multiple='multiple' name='restricted_attributes[]' data-placeholder='Type or Select Attributes' style='width: 220px;' >";
							$db = $dbCustom->getDbConnect(CART_DATABASE);
							$sql = "SELECT attribute_id, attribute_name
									FROM  attribute
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
									ORDER BY attribute_id";
							$res = $dbCustom->getResult($db,$sql);
							while($attr_row = $res->fetch_object()) {
								
								if(in_array($attr_row->attribute_id , $_SESSION['temp_attr_ids'])){
									$sel = "selected";	
								}else{
									$sel = '';
								}
	
								$block .= "<option value='".$attr_row->attribute_id."' $sel>".stripslashes($attr_row->attribute_name)."</option>";
							}
							$block .= "</select>";
							echo $block;
							?>
						</div>
                        <!--
						<div class="twocols">
                			<a class="btn btn-primary" id="copy_attr" href="#"><i class="icon-refresh icon-white"></i> Copy Parent Attributes</a>
						</div>
                        -->
					</div>

					<br /><br />
			</fieldset>
            
        
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

