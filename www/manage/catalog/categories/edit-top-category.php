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
require_once($real_root.'/includes/class.nav.php');
$progress = new SetupProgress;
$module = new Module;
$nav = new Nav;
$page_title = "Edit Top Category";
$page_group = "top-cat";

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
if(isset($_GET['firstload'])){
	unset($_SESSION['temp_cat_fields']);
	unset($_SESSION['temp_attr_ids']);
	unset($_SESSION['temp_cats']);
	unset($_SESSION['cat_id']);	
	unset($_SESSION['img_id']);	
}
$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;
$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;
$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;
$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $cat_id;
$search_str = (isset($_GET['search_str'])) ? addslashes($_GET['search_str']) : ''; 
if(!isset($_SESSION['search_str'])) $_SESSION['search_str'] = $search_str;
$strip =  (isset($_GET['strip'])) ? $_GET['strip'] : 0;
if(!isset($_SESSION['strip'])) $_SESSION['strip'] = $strip;
if(isset($_GET['sel_img_id']) && isset($_GET['img_type'])){
	$_SESSION['img_id'] = $_GET['sel_img_id'];
}
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = sprintf("SELECT * FROM category WHERE cat_id = '%u'", $_SESSION['cat_id']);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name;
	$short_name = $object->short_name;
	$tool_tip = $object->tool_tip;
	$description = $object->description;
	$show_on_home_page = $object->show_on_home_page;
	$show_in_cart = $object->show_in_cart;
	$show_in_showroom = $object->show_in_showroom;
	$img_id = $object->img_id;
	$img_alt_text = $object->img_alt_text;
	$key_words = $object->key_words;
	$profile_cat_id = $object->profile_cat_id;
	$showroom_item_display_priority = $object->showroom_item_display_priority;
}else{
	$name = '';
	$short_name = '';
	$tool_tip = '';
	$description = '';
	$show_on_home_page = '';		
	$show_in_cart = '';
	$show_in_showroom = '';
	$img_id = 0;
	$img_alt_text = '';
	$key_words = '';
	$profile_cat_id = '';
	$showroom_item_display_priority = 1;
}
if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $img_id;
if(!isset($_SESSION['temp_cat_fields']['name'])) $_SESSION['temp_cat_fields']['name'] = $name;	
if(!isset($_SESSION['temp_cat_fields']['short_name'])) $_SESSION['temp_cat_fields']['short_name'] = $short_name;	
if(!isset($_SESSION['temp_cat_fields']['tool_tip'])) $_SESSION['temp_cat_fields']['tool_tip'] = $tool_tip;	
if(!isset($_SESSION['temp_cat_fields']['description'])) $_SESSION['temp_cat_fields']['description'] = $description;	
if(!isset($_SESSION['temp_cat_fields']['show_on_home_page'])) $_SESSION['temp_cat_fields']['show_on_home_page'] = $show_on_home_page;	
if(!isset($_SESSION['temp_cat_fields']['show_in_cart'])) $_SESSION['temp_cat_fields']['show_in_cart'] = $show_in_cart;	
if(!isset($_SESSION['temp_cat_fields']['show_in_showroom'])) $_SESSION['temp_cat_fields']['show_in_showroom'] = $show_in_showroom;	
if(!isset($_SESSION['temp_cat_fields']['img_alt_text'])) $_SESSION['temp_cat_fields']['img_alt_text'] = $img_alt_text;	
if(!isset($_SESSION['temp_cat_fields']['key_words'])) $_SESSION['temp_cat_fields']['key_words'] = $key_words;
if(!isset($_SESSION['temp_cat_fields']['profile_cat_id'])) $_SESSION['temp_cat_fields']['profile_cat_id'] = $profile_cat_id;
if(!isset($_SESSION['temp_cat_fields']['showroom_item_display_priority'])) $_SESSION['temp_cat_fields']['showroom_item_display_priority'] = $showroom_item_display_priority;

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script src="https://cdn.tiny.cloud/1/iyk23xxriyqcd2gt44r230a2yjinya99cx1kd3tk9huatz50/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});
</script>

<script>
function does_exist(ele){
    if (ele !== undefined) {
        return 1;
    }else{
		return 0;
	}
}

function get_query_str(){
	var query_str = '';
	var attr_str = '';
	var cat_str = '';
	if(does_exist(document.form1.name)){
		query_str += "&name="+document.form1.name.value.replace('&', '%26');	
	}
	if(does_exist(document.form1.short_name)){
		query_str += "&short_name="+document.form1.short_name.value.replace('&', '%26');	
	}
	if(does_exist(document.form1.tool_tip)){
		query_str += "&tool_tip="+document.form1.tool_tip.value.replace('&', '%26');	
	}
	if(does_exist(document.form1.img_alt_text)){
		query_str += "&img_alt_text="+document.form1.img_alt_text.value.replace('&', '%26');	
	}
	if(does_exist(document.form1.key_words)){
		query_str += "&key_words="+document.form1.key_words.value.replace('&', '%26');	
	}
	if(does_exist(document.form1.description)){
		query_str += "&description="+escape(tinyMCE.get('wysiwyg1').getContent());	
	}
	if(does_exist(document.form1.show_on_home_page)){
		query_str += (document.form1.show_on_home_page.checked)? "&show_on_home_page=1" : "&show_on_home_page=0"; 
	}
	if(does_exist(document.form1.show_in_cart)){
		query_str += (document.form1.show_in_cart.checked)? "&show_in_cart=1" : "&show_in_cart=0"; 
	}
	if(does_exist(document.form1.showroom_item_display_priority)){
		query_str += (document.form1.showroom_item_display_priority.checked)? "&showroom_item_display_priority=1" : "&showroom_item_display_priority=0"; 
	}
	return query_str;
}

</script>
</head>
<body>
<?php
if(!$strip){ 
	require_once($real_root.'/manage/admin-includes/manage-header.php');
}
?>
<div class="manage_page_container <?php if($strip){ echo "lightbox"; }?>">
	<div class="manage_side_nav">
		<?php
		if(!$strip){  
        	require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
<?php
	$url_str = "top-category.php";
	$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
	$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
	$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
	$url_str .= "&search_str=".$_SESSION['search_str'];

?>
<form name="form1" action="<?php echo $url_str; ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data" target="_top">
	<input id="cat_id" type="hidden" name="cat_id" value="<?php echo $_SESSION['cat_id'];  ?>" />
	<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
    <input type="hidden" name="edit_top_cat" value="1">  
		
	<div class="page_actions edit_page">
		<button class="btn btn-large btn-success" name='edit' type='submit'>
		<i class="icon-ok icon-white"></i> Save Changes</button>
		<hr />
		<a href="<?php echo $url_str; ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a>
	</div>
	<div class="page_content edit_page">



<br />
SELECT ICON
<br />

<?php
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT * 
		FROM svg
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		";
$result = $dbCustom->getResult($db,$sql);
echo "<select id='svg_id' name='svg_id'>";
while($row = $result->fetch_object()) {		
	$selected = ($_SESSION['temp_cat_fields']['svg_id']  == $row->svg_id)? "selected" : '';
	echo "<option value='".$row->svg_id."' $selected>".$row->name."</option>";
}
echo "</select>";			

?>


	
		<h2>Editing <em>"<?php echo $name; ?>"</em></h2>
		<fieldset class="colcontainer">
 		<?php 
		$_SESSION['crop_n'] = 1;				
		$_SESSION['img_type'] = 'cart';
		$url_str = SITEROOT."manage/upload-pre-crop.php";
		$url_str .= "?ret_page=edit-top-category";
		$url_str .= "&ret_path=catalog/categories";
		$url_str .= "&ret_dir=categories";
		$url_str .= "&img_type=cart";
		$url_str .= "&crop_n=1";
		?>
		<div class="colcontainer">              
			<div style="float:left;">
			<a href="<?php echo $url_str; ?>" class="btn btn-primary"><i class="icon-plus icon-white"></i>Upload new Image</a>
			</div>
			<?php
			$url_str = "../select-image.php";               				
			$url_str .= "?ret_page=edit-top-category";
			$url_str .= "&ret_path=catalog/categories";
			$url_str .= "&ret_dir=categories";                   
			?>                    
			<div style="float:left; margin-left:10%;">                        
			<a class="btn btn-primary" href="<?php echo $url_str; ?>"><i class="icon-plus icon-white"></i> 
			Select new Image 
			</a>
			</div>
			<br /><br />
			<div class="colcontainer">
			<?php
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
			$img_res = $dbCustom->getResult($db,$sql);							
			if($img_res->num_rows){
				$img_obj = $img_res->fetch_object();
				echo "<img src='".SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$img_obj->file_name."'>";	
			}
			?>
			</div>
   			<div class="colcontainer">
				<label>Image Alt Tag text</label>
				<input style="width:600px;" type="text" id="img_alt_text" name="img_alt_text" value="<?php echo stripslashes($_SESSION['temp_cat_fields']['img_alt_text']); ?>"/>
			</div>            
			</fieldset>
			<fieldset>
				<legend>Edit Details</legend>
				<div class="colcontainer">
				<label>Category Name</label>
				<input style="width:600px;" name="name" type="text" value="<?php echo stripslashes($_SESSION['temp_cat_fields']['name']); ?>" />
				</div>                
				<div class="colcontainer formcols">
					<label>Short name for website navigation</label>
					<input style="width:230px;" type="text" name="short_name" value="<?php echo stripslashes($_SESSION['temp_cat_fields']['short_name']); ?>" />
				</div>
				<div class="colcontainer formcols">
					<label>Tool Tip</label>
					<input style="width:600px;" name="tool_tip" type="text" value="<?php echo stripslashes($_SESSION['temp_cat_fields']['tool_tip']); ?>" />	
				</div>
				<div class="colcontainer">
				<label>Key Words</label>
				<input style="width:600px;" name="key_words" type="text" value="<?php echo stripslashes($_SESSION['temp_cat_fields']['key_words']); ?>" />
				</div>
				
				<div class="colcontainer formcols">
					<label>Description</label>
					<textarea name="description" rows="25" /><?php echo stripslashes($_SESSION['temp_cat_fields']['description']); ?></textarea>
				</div>
				
				
			</fieldset>

 		</div>
	</form>
</div>
 <p class="clear"></p>
    <?php
	if(!$strip){  
    	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	}
	?>
</div>
</body>
</html>

