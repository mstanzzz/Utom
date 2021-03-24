<?php
/* ms */
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

//showroom-detail-view-categories

//echo $_SESSION['showroom_id'];

$progress = new SetupProgress;
$module = new Module;

$page_title = "Editing: Showroom";
$page_group = "showroom";
$page = "showroom";

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = 0;


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();

// add if not exist
$sql = "SELECT showroom_id FROM showroom WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO showroom 
		(last_update, profile_account_id) 
		VALUES ('".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);	
	$_SESSION['showroom_id'] = $db->insert_id;
}else{
	$_SESSION['showroom_id'] = (isset($_REQUEST['showroom_id'])) ? $_REQUEST['showroom_id'] : 0;
}

$_SESSION['showroom_id'] = isset($_GET['showroom_id'])? $_GET['showroom_id'] : 0; 
if(!is_numeric($_SESSION['showroom_id'])) $_SESSION['showroom_id'] = 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['update_showroom'])){

	$_SESSION['showroom_id'] = isset($_POST['showroom_id'])? $_POST['showroom_id'] : 0;
	if(!is_numeric($showroom_id)) $showroom_id = 0;
	
	$p_1_head = isset($_POST['p_1_head'])? addslashes(trim($_POST['p_1_head'])) : '';
	$p_1_text = isset($_POST['p_1_text'])? addslashes(trim($_POST['p_1_text'])) : '';

	if(isset($_POST['img_id'])) $_SESSION['img_id'] = $_POST['img_id']; 

	$_SESSION['temp_page_fields']['p_1_head'] = $p_1_head;	
	$_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;	
	
	$stmt = $db->prepare("UPDATE showroom
						SET
						p_1_head = ?
						,p_1_text = ?
						,img_id = ?
						WHERE showroom_id = ?");
						
		//echo 'Error-1 UPDATE   '.$db->error;
		
	if(!$stmt->bind_param("ssii"
						,$p_1_head
						,$p_1_text
						,$_SESSION['img_id']						
						,$_SESSION['showroom_id'])){
							
		echo 'Error-2 UPDATE   '.$db->error;
		
	}else{
		$stmt->execute();
		$stmt->close();				
		$msg = "Updated";
	}

	unset($_SESSION['temp_page_fields']);
}


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT 
		p_1_head
		,p_1_text
		,img_id		
FROM showroom 
WHERE showroom_id = '".$_SESSION['showroom_id']."'";
$result = $dbCustom->getResult($db,$sql);	

if($result->num_rows > 0){
	$object = $result->fetch_object();

	$p_1_head = $object->p_1_head;
	$p_1_text = $object->p_1_text;
	$img_id = $object->img_id;
		
}else{

	$p_1_head = '';
	$p_1_text = '';
	$img_id = 0;
}

//$_SESSION['img_id'] = 1;

if($_SESSION['img_id'] > 0 && $img_id == 0){

	$sql = "UPDATE showroom
			SET img_id = '".$_SESSION['img_id']."' 		 
			WHERE showroom_id = '".$_SESSION['showroom_id']."'";
	$result = $dbCustom->getResult($db,$sql);	
	$img_id	= $_SESSION['img_id'];		
}


$_SESSION['temp_page_fields']['p_1_head'] = $p_1_head;	
$_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;	



if(!isset($_SESSION['img_id']))$_SESSION['img_id'] = 0;
if($_SESSION['img_id'] == 0) $_SESSION['img_id'] = $img_id;


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
<script>

function validate(theform){
			
	return true;
}

$(document).ready(function() {
	$('.fancybox').click(function(){		
		ajax_set_page_session();
	});
});
	

tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});	

function ajax_set_page_session(){
	
	var q_str = "?page=about-us"+get_query_str();
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
	  success: function(data) {
			//alert(data);
	  }
	});
}

function get_query_str(){
	
	var query_str = '';
	
	query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26'); 
	query_str += "&img_alt_text="+$("#img_alt_text").val().replace('&', '%26'); 
	query_str += "&intro="+escape(tinyMCE.get('intro').getContent());
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	
	query_str += "&seo_name="+document.form.seo_name.value; 
	query_str += "&title="+document.form.title.value.replace('&', '%26'); 
	query_str += "&keywords="+document.form.keywords.value.replace('&', '%26'); 
	query_str += "&description="+document.form.description.value.replace('&', '%26'); 
	return query_str;
}

function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
  document.form.action = '<?php echo $current_page; ?>';
  document.form.target = '_self';
  document.form.submit(); 
}	

</script>
</head>
<body>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
		require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php'); 
		?>
	</div>
	<div class="manage_main">
	/showroom-detail-view-categories
	<?php 	
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');


echo "<a class='btn btn-info' href='page.php' >DONE</a>";

echo "<br />";
echo "img_id ".$img_id;
echo "<br />";
echo "S img_id ".$_SESSION['img_id'];
echo "<br />";

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT file_name 
		FROM image
		WHERE img_id = '".$_SESSION['img_id']."'";
$img_res = $dbCustom->getResult($db,$sql);

echo "num_rows ".$img_res->num_rows;
echo "<br />";

if($img_res->num_rows > 0){
	$img_obj = $img_res->fetch_object();
	$file_name = $img_obj->file_name;
}else{
	$file_name = '';
}


//echo $file_name;

$im = "";
$im .= $ste_root;
$im .= "/saascustuploads/";
$im .= $_SESSION['profile_account_id'];
$im .= "/cms/";
$im .= $file_name;

$im = preg_replace('/(\/+)/','/',$im);

//echo $im;
//exit;

echo "<h1>Hero Image </h1>";

echo "<img src='".$im."'>";

//$_SESSION['crop_n'] = 1;
$_SESSION['img_type'] = 'hero';

$url_str= "../../upload-pre-crop.php"; 
//$url_str = preg_replace('/(\/+)/','/',$url_str);
//echo $url_str;
//exit;

$url_str.= "?ret_page=showroom";
$url_str.= "&ret_dir=cms/pages";
$url_str.= "&ret_path=cms/pages";
$url_str.= "&upload_new_img=1";
	?>

<a class="btn btn-info" href="<?php echo $url_str; ?>">Upload Hero Image </a>






	
	<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="update_showroom" value="1">        
		<input type="hidden" name="showroom_id" value="<?php echo $_SESSION['showroom_id']; ?>">
		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>">


     		<div class="page_actions edit_page">
            	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
				<hr />
				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>
				
			<div class="colcontainer">                
				

<label>p_1_head</label>
<input type="text" name="p_1_head"  style="width:520px" value="<?php echo stripslashes($_SESSION['temp_page_fields']['p_1_head']); ?>">

<label>p_1_text</label>
<textarea id="p_1_text" class="wysiwyg" name="p_1_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_1_text']); ?></textarea>
	
				

			</div>


		</form>




	</div>
</div>


<!-- New Delete Dialogue -->
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this banner?</h3>
	<form name="del_banner" action="home.php" method="post" target="_top">
		<input id="del_banner_id" class="itemId" type="hidden" name="del_banner_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_banner" type="submit" >Yes, Delete</button>
	</form>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this submit button?</h3>
	<form name="del_submit_button" action="home.php" method="post" target="_top">
		<input id="del_submit_button_id" class="itemId2" type="hidden" name="del_submit_button_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_submit_button" type="submit" >Yes, Delete</button>
	</form>
</div>


<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
<!-- New Edit Dialogue 
<div id="content-edit" class="confirm-content">
	<form name="edit_faq_cat" action="faq-category.php" method="post" target="_top">
		<input id="faq_cat_id" type="hidden" class="itemId" name="faq_cat_id" value='' />
		<fieldset class="colcontainer">
			<label>Edit Banner</label>
			<input type="text" class="contentToEdit"  name="added_category" value=''>
		</fieldset>
		<a class="btn btn-large dismiss"> Cancel </a>
		<button name="edit_faq_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
	</form>
</div>
-->
	


</body>
</html>
