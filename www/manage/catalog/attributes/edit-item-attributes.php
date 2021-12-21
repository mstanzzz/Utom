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

$page_title = "Edit Product Attributes: ";
$page_group = "item";

	

$firstload =  (isset($_GET['firstload'])) ? 1 : 0;
if($firstload){
	unset($_SESSION['cat_id']);
	unset($_SESSION['parent_cat_id']);
	
	unset($_SESSION['item_id']);
	unset($_SESSION['search_str']);
	unset($_SESSION['img_id']);
	
	unset($_SESSION['temp_item_fields']);
	unset($_SESSION['temp_attr_opt_ids']);
	
	unset($_SESSION['temp_item_cats']);		
}

$action = (isset($_GET['action'])) ? $_GET['action'] : '';

$parent_cat_id = (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
if(!isset($_SESSION['parent_cat_id'])) $_SESSION['parent_cat_id'] = $parent_cat_id;

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $cat_id;

$this_item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : 0; 
if(!isset($_SESSION['item_id'])) $_SESSION['item_id'] = $this_item_id*1;

$search_str = (isset($_GET['search_str'])) ? addslashes($_GET['search_str']) : ''; 
if(!isset($_SESSION['search_str'])) $_SESSION['search_str'] = $search_str;

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;








$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';


//echo "action".$action;
//echo "<br />";


$db = $dbCustom->getDbConnect(CART_DATABASE);


if($action == 'remove_children'){
	$sql = "UPDATE item
			SET parent_item_id = '0'
			WHERE parent_item_id = '".$_SESSION['item_id']."'";
	$result = $dbCustom->getResult($db,$sql);					
}


if(isset($_POST['edit_item_attr'])){
	
	$item_id = $_POST['item_id'];
	
	$sql = "DELETE FROM item_to_opt 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	
	$sql = "SELECT attribute_id, attribute_name
			FROM  attribute 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY attribute_id";
	$result = $dbCustom->getResult($db,$sql);
	while($attr_row = $result->fetch_object()) {
		if(isset($_POST["attr_".$attr_row->attribute_id])){
			
			
			
			//echo $_POST["attr_".$attr_row->attribute_id]."    ".$item_id;
			//echo "<br />";
			
			$sql = "INSERT INTO item_to_opt 
					(opt_id ,item_id) 
					VALUES 
					('".$_POST["attr_".$attr_row->attribute_id]."','".$item_id."')";
			$res = $dbCustom->getResult($db,$sql);
			
		}
	}
	
	$_SESSION['temp_attr_opt_ids'] = getItemAttrOptionsArray($_SESSION['item_id']);
	
	
	$msg .= "Your change to attriutes is now live.<br />";	
	
	
}



//echo $this_item_id;
//echo "<br />";
//echo $_SESSION['item_id'];
//echo "<br />";


if($action == 'remove_as_child'){	
	$sql = "UPDATE item
			SET parent_item_id = '0'
			WHERE item_id = '".$_SESSION['item_id']."'";
	$res = $dbCustom->getResult($db,$sql);
	
	$msg .= "The product is nolonger a child. Updated seccessfully<br />";		
}



if(isset($_POST['become_child'])){
	
	$parent_item = (isset($_POST['parent_item']))? $_POST['parent_item'] : 0;
	//$item_id = (isset($_POST['item_id']))? $_POST['item_id'] : 0;
	
	
	if($parent_item > 0){
		
		
		//echo $parent_item;
		//echo "<br />";
		//echo $_SESSION['item_id'];
		
		// Is this parent a child also?
		
		$sql = "SELECT item_id 
				FROM item
				WHERE parent_item_id > '0'
				AND item_id = '".$parent_item."'";
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			
			$msg = 'The selected parent product is already a child of another product. This action was not completed.';
						
		}else{
			$sql = "UPDATE item
					SET parent_item_id = '".$parent_item."'
					WHERE item_id = '".$_SESSION['item_id']."'";
			$result = $dbCustom->getResult($db,$sql);	
			
			$_SESSION['temp_item_fields']['parent_item_id'] = $parent_item;
			
			$msg .= "This product is now a child.<br />";		
		}
	}
}




$sql = sprintf("SELECT * FROM item WHERE item_id = '%u'", $_SESSION['item_id']);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();

	
	$parent_name = '';
	if($object->parent_item_id > 0){
		$sql = "SELECT name FROM item WHERE item_id = '".$object->parent_item_id."'";
		$res = $dbCustom->getResult($db,$sql);
		if($res->num_rows > 0){
			$p_obj = $res->fetch_object();
			$parent_name = $p_obj->name; 	
		}
	}
	
	


	if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $object->img_id;

 
	if(!isset($_SESSION['temp_item_fields']['parent_item_id'])) $_SESSION['temp_item_fields']['parent_item_id'] = $object->parent_item_id;	

	if(!isset($_SESSION['temp_item_fields']['main_attr_id'])) $_SESSION['temp_item_fields']['main_attr_id'] = $object->main_attr_id;


	if(!isset($_SESSION['temp_item_fields']['name'])) $_SESSION['temp_item_fields']['name'] = $object->name;
	

	if(!isset($_SESSION['temp_item_fields']['is_kit'])) $_SESSION['temp_item_fields']['is_kit'] = $object->is_kit;	
	
	//echo "parent_item_id:  ".$object->parent_item_id;
	
}


if(!isset($_SESSION['temp_item_cats'])) $_SESSION['temp_item_cats'] = getItemCats($_SESSION['item_id']);

if(!isset($_SESSION['temp_attr_opt_ids'])) $_SESSION['temp_attr_opt_ids'] = getItemAttrOptionsArray($_SESSION['item_id']);


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>


<link type="text/css" href="<?php echo SITEROOT; ?>css/custom-theme/jquery-ui-1.8.23.custom.css" rel="stylesheet">

<script>

function get_query_str(){
	
	var query_str = '';
	//var str_cats = '';

	var is_in_form = 0;
	//var temp_ele_name = "name";
	
	var opt_list = '';
	
	<?php
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT attribute_id
			FROM  attribute
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
			ORDER BY attribute_id";
	$res = $dbCustom->getResult($db,$sql);		
	while($attr_row = $res->fetch_object()) {
		//$nn = "attr_".$attr_row->attribute_id."[]"; use for multiple
		$nn = "attr_".$attr_row->attribute_id;
	
	?>

	
		for(i = 0; i < document.edit_item.elements.length; i++)
		{
			if(document.edit_item.elements[i].name == '<?php echo $nn; ?>'){
				is_in_form = 1;
				//alert("FFF");
			}
		}
		if(is_in_form){
			//opt_list += this.value+"|";
			$("#<?php echo $nn; ?>  option:selected").each(
			
				function(){   
					opt_list += this.value+"|"; 
				}
			);	

		}
	
		is_in_form = 0;
	
	<?php
	}
	
	?>
		// remove last char
		opt_list = opt_list.replace(/(\s+)?.$/, '');	
		
		query_str += "&opt_list="+opt_list;
	
		//alert(opt_list);
	
	
	if($('#main_attr_id').length > 0){
		query_str += "&main_attr_id="+$('#main_attr_id').val(); 
	}

	query_str += "&item_id="+document.edit_item.item_id.value; 
	
	query_str += (document.edit_item.is_kit.checked)? "&is_kit=1" : "&is_kit=0"; 
	//alert(query_str);
	
	return query_str;
}

function set_item_session(){

	var q_str = "?action=1"+get_query_str();
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: '../products/ajax_set_item_session.php'+q_str,
	  success: function(data) {
		//alert(data);
	  }
	});	
}


function set_attr_section(){
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: '../products/ajax_get_attr_area.php',
	  success: function(data) {
		$("#attr_section").html(data);
		//$(".chosen").chosen();
		//alert(data);
	  }
	});
}

function validate(){

	document.forms["edit_item"].submit();	
	
}

$(document).ready(function() {

	
	
	$("#make_child_of").click(function(){		
		set_item_session();
	});
	
	$("#remove_as_child").click(function(){		
		set_item_session();
	});
	
	



	set_attr_section();

});



</script>
</head>

<body>
<div class="manage_page_container lightbox">
	<div class="manage_main">
	<?php
		$page_title .= stripslashes($_SESSION['temp_item_fields']['name']);

		if($parent_name != ''){		
			$page_title .=  '<br />Child of: '.$parent_name;
		}

		$db = $dbCustom->getDbConnect(CART_DATABASE);

		//echo $msg;
		 require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
		 
		//echo $page_title;

		?>      
		<form id="edit_item_form" name="edit_item" action="edit-item-attributes.php" method="post"   enctype="multipart/form-data">
			<input id="item_id" type="hidden" name="item_id" value="<?php echo $_SESSION['item_id'];  ?>" />
			<input type="hidden" name="parent_cat_id" value="<?php echo $_SESSION['parent_cat_id']; ?>" />
			<input type="hidden" name="cat_id" value="<?php echo $_SESSION['cat_id']; ?>" />
			<input type="hidden" name="edit_item_attr" value="1" />
            <div class="page_actions edit_page"> 
				<?php 
		
		
				if($admin_access->product_catalog_level > 1){ 
                    
					echo "<a onClick='validate()' class='btn btn-success btn-large'><i class='icon-ok icon-white'></i> Save Product </a>";
					
					
					
					if($_SESSION['temp_item_fields']['parent_item_id'] == 0){
					
						//echo "<hr /><a id='add_child' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Add New Child</a>";	
							
						if(getNumChildItems($_SESSION['item_id']) > 0){
						
							$url_str = "edit-item-attributes.php";
							$url_str .= "?action=remove_children";
							$url_str .= "&parent_item_id=".$_SESSION['item_id'];
							$url_str .= "&ret_page=edit-item";				
							$url_str .= "&parent_cat_id=".$_SESSION['parent_cat_id'];
							$url_str .= "&cat_id=".$_SESSION['cat_id'];						
							$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
							$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
							$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
							$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
							$url_str .= '&search_str='.$_SESSION['search_str'];
								
							echo "<hr /><a id='remove_children' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Remove All Child Products </a>";	
						}
							
							
					
						$url_str = "../products/become-child-item.php";
						//$url_str .= "?parent_item_id=".$_SESSION['item_id'];
						$url_str .= "?ret_page=edit-item-attributes";
						$url_str .= "&ret_dir=attributes";
						$url_str .= "&item_id=".$_SESSION['item_id'];				
						$url_str .= "&parent_cat_id=".$_SESSION['parent_cat_id'];
						$url_str .= "&cat_id=".$_SESSION['cat_id'];						
						$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
						$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
						$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
						$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
						$url_str .= '&search_str='.$_SESSION['search_str'];
					
						echo "<hr /><a id='make_child_of' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Make this a child of another product</a>";
						
					}else{
						
						$url_str = "edit-item-attributes.php";
						$url_str .= "?action=remove_as_child";
						
						
						echo "<hr /><a id='remove_as_child' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Make this NOT a child of another product</a>";
						
					}
				
				
				}else{ ?>
                	<div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
                <?php } ?>
                


				<!--<a href="set-custom-attributes.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>-->
			</div>
			<div class="page_content edit_page">
 				

				<fieldset class="edit_images" id="product_images">
					<div class="colcontainer">
                    	<div class="colcontainer formcols">
						<?php
							echo stripslashes($_SESSION['temp_item_fields']['name']);
							echo "<br />";
							
							$sql = "SELECT file_name FROM image
							WHERE img_id = '".$_SESSION['img_id']."'";
							$img_res = $dbCustom->getResult($db,$sql);
							
							if($img_res->num_rows > 0){
								$img_obj = $img_res->fetch_object();
								$file_name = $img_obj->file_name;
							}else{
								$file_name = '';
							}
							echo "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$file_name."'>";
						?>							
						</div>
                        <div class="colcontainer formcols">
							<?php
							if(isset($object->profile_item_id)) echo "Product Number:  ".$object->profile_item_id;
							echo "<br />";
							echo "item id  ".$_SESSION['item_id'];
							
							?>
					</div>
                        
                        
                        
                        
                        
				</fieldset>

                
				<fieldset class="edit_page" id="product_attributes">
					<legend>Product Attributes <i class="icon-minus-sign icon-white"></i></legend>
                    <div id="attr_section">
                    
							<?php 
							
							/*							
							
							$block = '';
									
							$sql = "SELECT attribute_id, attribute_name
									FROM  attribute
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
									ORDER BY attribute_id";
							$attr_res = mysql_query ($sql);
							if(!$attr_res)die(mysql_error());
							
							
							
							while($attr_row = mysql_fetch_object($attr_res)) {
								$block .= "<label>".stripslashes($attr_row->attribute_name)."</label>";
								$block .= "<select class='chosen' multiple='multiple' name='attr_".stripslashes($attr_row->attribute_id)."[]' data-placeholder='Type or Select Attributes'>";
								
								$sql = "SELECT opt_id, opt_name
										FROM  opt, attribute 
										WHERE opt.attribute_id = attribute.attribute_id
										AND opt.attribute_id = '".$attr_row->attribute_id."' 
										ORDER BY opt_id";
								$res = $dbCustom->getResult($db,$sql);
								
								if($res->num_rows > 0){
									
									$block .= "<option value='0'>N/A</option>";
									while($opt_row = $res->fetch_object()) {
										
										
										$block .= "<option value='".$opt_row->opt_id."'>".stripslashes($opt_row->opt_name)."</option>";
									}
								}
								$block .= "</select>";
							}
							$block .= '';
							echo $block;
							
							*/
							
							?>
					</div>
                    


				</fieldset>

                
                
			</div>
		</form>
        

</div>

 <p class="clear"></p>
    <?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
    ?>
</div>



	<div style="display:none">
        <div id="add_new_opt" style="width:300px; height:140px;">
      
        </div>
	</div>


	<div style="display:none">
        <div id="add_attribute" style="width:300px; height:140px;">
      
        </div>
	</div>


<div class="disabledMsg">
	<p>Sorry, this item can't be modified.</p>
</div>

</body>
</html>


