<?php
/* ms */
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page = "solution-detail-view";

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();

// add if not exist
$sql = "SELECT solution_detail_view_id FROM solution_detail_view WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO solution_detail_view 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);	
	$_SESSION['solution_detail_view_id'] = $db->insert_id;
}else{
	$_SESSION['solution_detail_view_id'] = (isset($_REQUEST['solution_detail_view_id'])) ? $_REQUEST['solution_detail_view_id'] : 0;
}
if(!is_numeric($_SESSION['solution_detail_view_id'])) $_SESSION['solution_detail_view_id'] = 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['update_solution_detail_view'])){
	
	$img_1_id = isset($_POST['img_1_id'])? $_POST['img_1_id'] : 0;
	$img_2_id = isset($_POST['img_2_id'])? $_POST['img_2_id'] : 0;
	$img_3_id = isset($_POST['img_3_id'])? $_POST['img_3_id'] : 0;

	if(!is_numeric($home_id)) $home_id = 0;
	if(!is_numeric($img_1_id)) $img_1_id = 0;
	if(!is_numeric($img_2_id)) $img_2_id = 0;
	if(!is_numeric($img_3_id)) $img_3_id = 0;

	$top_1 = isset($_POST['top_1'])? addslashes(trim($_POST['top_1'])) : '';
	$top_2 = isset($_POST['top_2'])? addslashes(trim($_POST['top_2'])) : '';
	$top_3 = isset($_POST['top_3'])? addslashes(trim($_POST['top_3'])) : '';
	
	$p_1_head = isset($_POST['p_1_head'])? addslashes(trim($_POST['p_1_head'])) : '';
	$p_1_text = isset($_POST['p_1_text'])? addslashes(trim($_POST['p_1_text'])) : '';
	
	$p_2_head = isset($_POST['p_2_head'])? addslashes(trim($_POST['p_2_head'])) : '';
	$p_2_text = isset($_POST['p_2_text'])? addslashes(trim($_POST['p_2_text'])) : '';

	$p_3_head = isset($_POST['p_3_head'])? addslashes(trim($_POST['p_3_head'])) : '';
	$p_3_text = isset($_POST['p_3_text'])? addslashes(trim($_POST['p_3_text'])) : '';

	$p_4_head = isset($_POST['p_4_head'])? addslashes(trim($_POST['p_4_head'])) : '';
	$p_4_text = isset($_POST['p_4_text'])? addslashes(trim($_POST['p_4_text'])) : '';

	$p_5_head = isset($_POST['p_5_head'])? addslashes(trim($_POST['p_5_head'])) : '';
	$p_5_text = isset($_POST['p_5_text'])? addslashes(trim($_POST['p_5_text'])) : '';

	$p_6_head = isset($_POST['p_6_head'])? addslashes(trim($_POST['p_6_head'])) : '';
	$p_6_text = isset($_POST['p_6_text'])? addslashes(trim($_POST['p_6_text'])) : '';

	$p_7_head = isset($_POST['p_7_head'])? addslashes(trim($_POST['p_7_head'])) : '';
	$p_7_text = isset($_POST['p_7_text'])? addslashes(trim($_POST['p_7_text'])) : '';

	$p_8_head = isset($_POST['p_8_head'])? addslashes(trim($_POST['p_8_head'])) : '';
	$p_8_text = isset($_POST['p_8_text'])? addslashes(trim($_POST['p_8_text'])) : '';
	
	$p_9_head = isset($_POST['p_9_head'])? addslashes(trim($_POST['p_9_head'])) : '';
	$p_9_text = isset($_POST['p_9_text'])? addslashes(trim($_POST['p_9_text'])) : '';	

	$_SESSION['temp_page_fields']['top_1'] = $top_1;	
	$_SESSION['temp_page_fields']['top_2'] = $top_2;	
	$_SESSION['temp_page_fields']['top_3'] = $top_3;	
	$_SESSION['temp_page_fields']['p_1_head'] = $p_1_head;	
	$_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;	
	$_SESSION['temp_page_fields']['p_2_head'] = $p_2_head;	
	$_SESSION['temp_page_fields']['p_2_text'] = $p_2_text;	
	$_SESSION['temp_page_fields']['p_3_head'] = $p_3_head;	
	$_SESSION['temp_page_fields']['p_3_text'] = $p_3_text;	
	$_SESSION['temp_page_fields']['p_4_head'] = $p_4_head;	
	$_SESSION['temp_page_fields']['p_4_text'] = $p_4_text;	
	$_SESSION['temp_page_fields']['p_5_head'] = $p_5_head;	
	$_SESSION['temp_page_fields']['p_5_text'] = $p_5_text;	
	$_SESSION['temp_page_fields']['p_6_head'] = $p_6_head;	
	$_SESSION['temp_page_fields']['p_6_text'] = $p_6_text;	
	$_SESSION['temp_page_fields']['p_7_head'] = $p_7_head;	
	$_SESSION['temp_page_fields']['p_7_text'] = $p_7_text;	
	$_SESSION['temp_page_fields']['p_8_head'] = $p_8_head;	
	$_SESSION['temp_page_fields']['p_8_text'] = $p_8_text;
	$_SESSION['temp_page_fields']['p_9_head'] = $p_9_head;	
	$_SESSION['temp_page_fields']['p_9_text'] = $p_9_text;
	
	$_SESSION['temp_page_fields']['img_1_id'] = $img_1_id;	
	$_SESSION['temp_page_fields']['img_2_id'] = $img_2_id;	
	$_SESSION['temp_page_fields']['img_3_id'] = $img_3_id;	
	
	
	$stmt = $db->prepare("UPDATE solution_detail_view
						SET
						top_1 = ?
						,top_2 = ?
						,top_3 = ?						
						,p_1_head = ?
						,p_1_text = ? 												
						,p_2_head = ?
						,p_2_text = ? 						
						,p_3_head = ?
						,p_3_text = ? 						
						,p_4_head = ?
						,p_4_text = ? 						
						,p_5_head = ?
						,p_5_text = ? 
						,p_6_head = ?
						,p_6_text = ? 
						,p_7_head = ?
						,p_7_text = ? 
						,p_8_head = ?  
						,p_8_text = ?	
						,p_9_head = ?  
						,p_9_text = ?	
						
						WHERE solution_detail_view_id = ?");
						
		echo 'Error-1 UPDATE   '.$db->error;
		
	if(!$stmt->bind_param("sssssssssssssssssssssi"
						,$top_1
						,$top_2
						,$top_3
						,$p_1_head
						,$p_1_text									
						,$p_2_head
						,$p_2_text									
						,$p_3_head
						,$p_3_text								
						,$p_4_head
						,$p_4_text							
						,$p_5_head
						,$p_5_text						
						,$p_6_head
						,$p_6_text						
						,$p_7_head
						,$p_7_text
						,$p_8_head  
						,$p_8_text
						,$p_9_head  
						,$p_9_text
						,$_SESSION['solution_detail_view_id'])){
							
		echo 'Error-2 UPDATE   '.$db->error;
		
	}else{
		$stmt->execute();
		$stmt->close();				
		$msg = "Updated";
	}

	$mssl = (isset($_POST['mssl']))? 1 : 0;	
	$seo_name = (isset($_POST['seo_name']))? trim($_POST['seo_name']) : '';
	$seo_name = str_replace ('\'', '' , $seo_name);
	$seo_name = str_replace ('\"', '' , $seo_name);
	$seo_name = str_replace (' ', '-' , $seo_name);
	$title = (isset($_POST['title']))? trim(addslashes($_POST['title'])) : '';
	$keywords = (isset($_POST['keywords']))? trim(addslashes($_POST['keywords'])) : '';
	$description = (isset($_POST['description']))? trim(addslashes($_POST['description'])) : '';
	$page_heading = (isset($_POST['page_heading']))? trim(addslashes($_POST['page_heading'])) : '';

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/cms/insert_page_seo.php');

	unset($_SESSION['temp_page_fields']);
}


if(isset($_POST['del_img_id'])){

	$del_img_id = (isset($_POST['del_img_id']))? $_POST['del_img_id'] : 0;	
	if(!is_numeric($del_img_id)) $del_img_id = 0;

	$sql = "SELECT file_name FROM image WHERE img_id = '".$del_img_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$object->file_name;		
		if(file_exists($p)) unlink($p);
	}

	$sql = "DELETE FROM image 
	WHERE img_id = '".$del_img_id."'";
	$result = $dbCustom->getResult($db,$sql);	

}

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT *
FROM solution_detail_view 
WHERE solution_detail_view_id = '".$_SESSION['solution_detail_view_id']."'";
$result = $dbCustom->getResult($db,$sql);	


if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_1_id = $object->img_1_id;
	$img_2_id = $object->img_2_id;
	$img_3_id = $object->img_3_id;
	$top_1 = $object->top_1;
	$top_2 = $object->top_2;
	$top_3 = $object->top_3;
	$p_1_head = $object->p_1_head;
	$p_1_text = $object->p_1_text;
	$p_2_head = $object->p_2_head;
	$p_2_text = $object->p_2_text;
	$p_3_head = $object->p_3_head; 
	$p_3_text = $object->p_3_text;
	$p_4_head = $object->p_4_head;
	$p_4_text = $object->p_4_text; 
	$p_5_head = $object->p_5_head;  
	$p_5_text = $object->p_5_text; 
	$p_6_head = $object->p_6_head;  
	$p_6_text = $object->p_6_text; 
	$p_7_head = $object->p_7_head;  
	$p_7_text = $object->p_7_text;
	$p_8_head = $object->p_8_head;  
	$p_8_text = $object->p_8_text;
	$p_9_head = $object->p_9_head;  
	$p_9_text = $object->p_9_text;
		
}else{
	$img_1_id = 0;
	$img_2_id = 0;
	$img_3_id = 0;
	$top_1 = '';
	$top_2 = '';
	$top_3 = '';
	$p_1_head = '';
	$p_1_text = '';
	$p_2_head = '';
	$p_2_text = '';
	$p_3_head = ''; 
	$p_3_text = '';
	
	$p_4_head = '';
	$p_4_text = ''; 
	
	$p_5_head = '';  
	$p_5_text = ''; 
	
	$p_6_head = '';  
	$p_6_text = ''; 
	$p_7_head = '';  
	$p_7_text = '';

	$p_8_head = '';  
	$p_8_text = '';

}
	$_SESSION['temp_page_fields']['top_1'] = $top_1;	
	$_SESSION['temp_page_fields']['top_2'] = $top_2;	
	$_SESSION['temp_page_fields']['top_3'] = $top_3;	

	$_SESSION['temp_page_fields']['p_1_head'] = $p_1_head;	
	$_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;	

	$_SESSION['temp_page_fields']['p_2_head'] = $p_2_head;	
	$_SESSION['temp_page_fields']['p_2_text'] = $p_2_text;	

	$_SESSION['temp_page_fields']['p_3_head'] = $p_3_head;	
	$_SESSION['temp_page_fields']['p_3_text'] = $p_3_text;	

	$_SESSION['temp_page_fields']['p_4_head'] = $p_4_head;	
	$_SESSION['temp_page_fields']['p_4_text'] = $p_4_text;	

	$_SESSION['temp_page_fields']['p_5_head'] = $p_5_head;	
	$_SESSION['temp_page_fields']['p_5_text'] = $p_5_text;	

	$_SESSION['temp_page_fields']['p_6_head'] = $p_6_head;	
	$_SESSION['temp_page_fields']['p_6_text'] = $p_6_text;	

	$_SESSION['temp_page_fields']['p_7_head'] = $p_7_head;	
	$_SESSION['temp_page_fields']['p_7_text'] = $p_7_text;	

	$_SESSION['temp_page_fields']['p_8_head'] = $p_8_head;	
	$_SESSION['temp_page_fields']['p_8_text'] = $p_8_text;	
	
	$_SESSION['temp_page_fields']['p_9_head'] = $p_9_head;	
	$_SESSION['temp_page_fields']['p_9_text'] = $p_9_text;	

	$_SESSION['temp_page_fields']['img_1_id'] = $img_1_id;	
	$_SESSION['temp_page_fields']['img_2_id'] = $img_2_id;	
	$_SESSION['temp_page_fields']['img_3_id'] = $img_3_id;	


$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$_SESSION['temp_page_fields']['img_1_id']."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_1_file_name = $img_obj->file_name;
}else{
	$img_1_file_name = '';
}	

$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$_SESSION['temp_page_fields']['img_2_id']."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_2_file_name = $img_obj->file_name;
}else{
	$img_2_file_name = '';
}	

$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$_SESSION['temp_page_fields']['img_3_id']."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_3_file_name = $img_obj->file_name;
}else{
	$img_3_file_name = '';
}	


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
	
	
	tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "wysiwyg",
        theme : "advanced",
        skin : "o2k7",
        plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
        // Theme options
        theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,styleselect,formatselect,fontsizeselect,|,forecolor,backcolor",
        theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,code",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
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
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php'); ?>
	</div>
	<div class="manage_main">
	<?php 	
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
	?>
	
	<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="update_solution_detail_view" value="1">        
		<input type="hidden" name="solution_detail_view_id" value="<?php echo $_SESSION['solution_detail_view_id']; ?>">

     		<div class="page_actions edit_page">
            	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
				<hr />
				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>
				
			<div class="colcontainer">                
				<label>top_1</label>
				<input type="text" name="top_1"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['top_1']); ?>">
                    
				<label>top_2</label>
				<input type="text" name="top_2"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['top_2']); ?>">

				<label>top_3</label>
				<input type="text" name="top_3"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['top_3']); ?>">


				<label>p_1_head</label>
				<input type="text" name="p_1_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_1_head']); ?>">
	<label>p_1_text</label>
	<textarea id="p_1_text" class="wysiwyg" name="p_1_text"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['p_1_text']); ?></textarea>
	
				<label>p_2_head</label>
				<input type="text" name="p_2_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_2_head']); ?>">
				
	<label>p_2_text</label>
	<textarea id="p_2_text" class="wysiwyg" name="p_2_text"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['p_2_text']); ?></textarea>

				<label>p_3_head</label>
				<input type="text" name="p_3_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_3_head']); ?>">
				
	<label>p_3_text</label>
	<textarea id="p_3_text" class="wysiwyg" name="p_3_text"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['p_3_text']); ?></textarea>
	
				<label>p_4_head</label>
				<input type="text" name="p_4_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_4_head']); ?>">

	<label>p_4_text</label>
	<textarea id="p_4_text" class="wysiwyg" name="p_4_text"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['p_4_text']); ?></textarea>

	
				<label>p_5_head</label>
				<input type="text" name="p_5_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_5_head']); ?>">
	<label>p_5_text</label>
	<textarea id="p_5_text" class="wysiwyg" name="p_5_text"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['p_5_text']); ?></textarea>

	
				<label>p_6_head</label>
				<input type="text" name="p_6_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_6_head']); ?>">
	<label>p_6_text</label>
	<textarea id="p_6_text" class="wysiwyg" name="p_6_text"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['p_6_text']); ?></textarea>

				<label>p_7_head</label>
				<input type="text" name="p_7_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_7_head']); ?>">
	<label>p_7_text</label>
	<textarea id="p_7_text" class="wysiwyg" name="p_7_text"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['p_7_text']); ?></textarea>


				<label>p_8_head</label>
				<input type="text" name="p_8_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_8_head']); ?>">

	<label>p_8_text</label>
	<textarea id="p_8_text" class="wysiwyg" name="p_8_text"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['p_8_text']); ?></textarea>
		
				<label>p_9_head</label>
				<input type="text" name="p_9_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_9_head']); ?>">

	<label>p_9_text</label>
	<textarea id="p_9_text" class="wysiwyg" name="p_9_text"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['p_9_text']); ?></textarea>



			</div>

<?php 
$page_heading = $_SESSION['temp_page_fields']['page_heading'];
$seo_name = $_SESSION['temp_page_fields']['seo_name'];
$title = $_SESSION['temp_page_fields']['title'];
$keywords = $_SESSION['temp_page_fields']['keywords'];	
$description = $_SESSION['temp_page_fields']['description'];
require_once("edit_page_seo.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/edit_page_breadcrumb.php"); 
?>	


		</form>




	</div>
</div>





</body>
</html>
