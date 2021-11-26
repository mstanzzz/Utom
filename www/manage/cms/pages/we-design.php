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

$page_title = "We Design";
$page_group = "we-design";
$page = "we-design";

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();

$we_design_id = (isset($_REQUEST['we_design_id'])) ? $_REQUEST['we_design_id'] : 0;

// add if not exist
$sql = "SELECT we_design_id FROM we_design WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO we_design 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	$we_design_id = $db->insert_id;
}

if(!isset($_SESSION['we_design_id'])) $_SESSION['we_design_id'] = $we_design_id;


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['update_we_design'])){
	
	$top_1 = (isset($_POST['top_1']))? trim(addslashes($_POST['top_1'])) : ''; 

	
	if(!is_numeric($we_design_id)) $we_design_id = 0;

	$_SESSION['temp_page_fields']['top_1'] = $top_1;
	
	$stmt = $db->prepare("UPDATE we_design
						SET
						top_1 = ?
						WHERE we_design_id = ?");
						
		//echo 'Error-1 UPDATE   '.$db->error;
	if(!$stmt->bind_param("si"
						,$top_1
						,$_SESSION['we_design_id'])){
							
		echo 'Error-2 UPDATE   '.$db->error;
		
	}else{
		$stmt->execute();
		$stmt->close();				
		$msg = "Updated";
	}


	/*	
	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (' ', '-' , $seo_name);
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST['page_heading']));
	*/
	require_once($real_root.'/manage/cms/insert_page_seo.php');
	//require_once($real_root."/manage/cms/insert_page_breadcrumb.php");
	//unset($_SESSION['temp_page_fields']);

}


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT top_1
    FROM we_design 
 	WHERE we_design_id = '".$_SESSION['we_design_id']."'";

$result = $dbCustom->getResult($db,$sql);	
if($result->num_rows > 0){
$object = $result->fetch_object();
	$top_1 = $object->top_1;
}else{
	$top_1 = '';
}

$_SESSION['temp_page_fields']['top_1'] = $top_1;

	
require_once($real_root.'/manage/cms/get_seo_variables.php');

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>

function validate(theform){
			
	return true;
}


/*
function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}
*/


$(document).ready(function() {
	
	
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 920	
	});

		


	$('.fancybox').click(function(){		
		
		ajax_set_page_session();
	
	});


});




function ajax_set_page_session(){
	
	var q_str = "?page=we-design-fax"+get_query_str();
		
	//alert(q_str);
	
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
	//query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26'); 
	//query_str += "&img_alt_text="+$("#img_alt_text").val(); 
	//query_str += "&content="+escape(tinyMCE.get('wysiwyg').getContent());
	
	//query_str += "&design_fax_number="+$("#design_fax_number").val(); 
		
	//query_str += "&seo_name="+document.form.seo_name.value; 
	//query_str += "&title="+document.form.title.value.replace('&', '%26'); 
	//query_str += "&keywords="+document.form.keywords.value.replace('&', '%26'); 
	//query_str += "&description="+document.form.description.value.replace('&', '%26'); 
	
	
	
	
	return query_str;
}


function previewSubmit() {
  document.form.action = '<?php echo SITEROOT; ?>pages/preview/preview.php';
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

	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');

?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php require_once($real_root.'/manage/admin-includes/manage-side-nav.php'); ?>
	</div>
	<div class="manage_main">

	<form name="form" action="we-design.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="update_we_design" value="1">        
		<input type="hidden" name="we_design_id" value="<?php echo $_SESSION['we_design_id']; ?>">		
		<div class="page_actions edit_page"> 
            <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>          
        </div>
		<div class="page_content edit_page">
            <fieldset class="edit_content">
                <legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>top_1</label>
					</div>
					<div class="twocols">
<input id='top_1' type="text" name="top_1" value="<?php echo stripslashes($_SESSION['temp_page_fields']['top_1']); ?>" />
					</div>
				</div>
            </fieldset>
		
		
<?php 
$page_heading = 'page_heading';
$seo_name = $_SESSION['temp_page_fields']['seo_name'];
$title = $_SESSION['temp_page_fields']['title'];
$keywords = $_SESSION['temp_page_fields']['keywords'];	
$description = $_SESSION['temp_page_fields']['description'];
require_once("edit_page_seo.php"); 
require_once($real_root."/manage/cms/edit_page_breadcrumb.php");
?>	
		</div>
		
	</form>	
	</div>
</div>	
</body>
</html>
