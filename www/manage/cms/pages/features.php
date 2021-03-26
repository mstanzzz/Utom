<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Editing: features";
$page_group = "features";
$page = "features";
$ts = time();

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

// add if not exist
$sql = "SELECT features_id FROM features WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO features 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);	
	$_SESSION['features_id'] = $db->insert_id;
}else{
	$_SESSION['features_id'] = (isset($_REQUEST['features_id'])) ? $_REQUEST['features_id'] : 0;
}
if(!is_numeric($_SESSION['features_id'])) $_SESSION['features_id'] = 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';



//print_r($_POST);

if(isset($_POST['update_features'])){

	$top_1 = isset($_POST['top_1'])? addslashes(trim($_POST['top_1'])) : '';
	$p_1_text = isset($_POST['p_1_text'])? addslashes(trim($_POST['p_1_text'])) : '';

	if(isset($_POST['img_id'])) $_SESSION['img_id'] = $_POST['img_id']; 

	$_SESSION['temp_page_fields']['top_1'] = $top_1;	
	$_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;	
	$stmt = $db->prepare("UPDATE features
						SET
						top_1 = ?
						,p_1_text = ? 												
						,img_id = ?												
						WHERE features_id = ?");
						
		echo 'Error-1 UPDATE   '.$db->error;
		echo "<br />";
	
	if(!$stmt->bind_param("ssii"
						,$top_1
						,$p_1_text									
						,$_SESSION['img_id']
						,$_SESSION['features_id'])){
							
		echo 'Error-2 UPDATE   '.$db->error;
		echo "<br />";
	}else{
		$stmt->execute();
		$stmt->close();				
		$msg = "Updated";
	}

//echo "top_1 ".$_SESSION['temp_page_fields']['top_1'];
//echo "<br />";
//echo "p_1_text ".$_SESSION['temp_page_fields']['p_1_text'];
//echo "<br />";
//exit;
	
	//echo $msg;
	//echo "<br />";
	//unset($_SESSION['temp_page_fields']);
	
}

$sql = "SELECT *
FROM features 
WHERE features_id = '".$_SESSION['features_id']."'";
$result = $dbCustom->getResult($db,$sql);	
if($result->num_rows > 0){
	$object = $result->fetch_object();
	
	// hero
	$img_id = $object->img_id;
	
	$top_1 = $object->top_1;
	$p_1_text = $object->p_1_text;

	$_SESSION['temp_page_fields']['top_1'] = $top_1;
	$_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;
		
}else{
	$img_id = 0;

	$top_1 = '';
	$p_1_text = '';
}



if($_SESSION['img_id'] > 0){

	$sql = "UPDATE features
			SET img_id = '".$_SESSION['img_id']."' 		 
			WHERE features_id = '".$_SESSION['features_id']."'";
	$result = $dbCustom->getResult($db,$sql);	
}

if(!isset($_SESSION['img_id']))$_SESSION['img_id'] = 0;
if($_SESSION['img_id'] == 0) $_SESSION['img_id'] = $img_id;

if(!isset($_SESSION['temp_page_fields']['top_1'])) $_SESSION['temp_page_fields']['top_1'] = $top_1;
if(!isset($_SESSION['temp_page_fields']['p_1_text'])) $_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;


/*
echo "features_id ".$_SESSION['features_id'];
echo "<br />";
echo "img_id ".$_SESSION['img_id'];
echo "<br />";
echo "top_1 ".$_SESSION['temp_page_fields']['top_1'];
echo "<br />";
echo "p_1_text ".$_SESSION['temp_page_fields']['p_1_text'];
echo "<br />";
*/
//exit;



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
<script>

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

echo "<a class='btn btn-info' href='page.php' >DONE</a>";

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
echo "<img src='".$im."' width='500'>";

//$_SESSION['crop_n'] = 1;
$_SESSION['img_type'] = 'hero';

$url_str= "../../upload-pre-crop.php"; 
//$url_str = preg_replace('/(\/+)/','/',$url_str);
//echo $url_str;
//exit;

$url_str.= "?ret_page=features";
$url_str.= "&ret_dir=cms/pages";
$url_str.= "&ret_path=cms/pages";
$url_str.= "&upload_new_img=1";
?>

<a class="btn btn-info" href="<?php echo $url_str; ?>">Upload Hero Image </a>


	
	<form name="form" action="features.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="update_features" value="1">        
		<input type="hidden" name="features_id" value="<?php echo $_SESSION['features_id']; ?>">

		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>">
     		<div class="page_actions edit_page">
			
			<!--
			<a onClick="regularSubmit();" href="#" 
			class="btn btn-success btn-large" >
			<i class="icon-ok icon-white"></i> Save Changes </a>
			-->
			
<input type="submit" name="submit" value="Save Changes">
			<hr />
				<a href="page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>
				
			<div class="colcontainer">                
				
<label>top_1</label>
<input style="width:80%;" type="text" name="top_1" 
value="<?php echo stripslashes($_SESSION['temp_page_fields']['top_1']); ?>"

<label>p_1_text</label>
<textarea 
name="p_1_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_1_text']); ?></textarea>


			</div>
		</form>
	</div>
	<p class="clear"></p>
</div>

</body>
</html>
