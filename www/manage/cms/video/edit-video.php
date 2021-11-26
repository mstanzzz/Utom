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
$page_title = "Video List";
$page_group = "video";
$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$page_title = "Edit Video";
$page_group = "video";
$ret_page = (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : 'select-video';
$strip = (isset($_REQUEST['strip'])) ? $_REQUEST['strip'] : 0;
$fromfancybox = (isset($_GET['fromfancybox'])) ? $_GET['fromfancybox'] : 0;
$video_id = (isset($_GET['video_id'])) ? $_GET['video_id'] : 0;
$msg = '';
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$video_id = isset($_REQUEST['video_id'])?$_REQUEST['video_id']:0; 
if(!is_numeric($video_id))$video_id=0;

$youtube_id = '';
$title = '';
$description = '';
$name = 'no name';
if ($stmt = $db->prepare("SELECT youtube_id, name, description FROM video WHERE video_id = ?")) {
	$stmt->bind_param('i', $video_id);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows > 0){
		$stmt->bind_result($youtube_id, $name, $description);
		$stmt->fetch();
	}		
	$stmt->close();
}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
</head>
<body>
<?php
echo $msg; 
?>
<div style="margin-left:20px;"> 
<form action="video-list.php" method="post" enctype="multipart/form-data">
<img width='200' height='200' src='http://img.youtube.com/vi/<?php echo $youtube_id; ?>/0.jpg' />
<input type="hidden" name="update_video" value="1" />
<input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
<input type="hidden" name="video_id" value="<?php echo $video_id; ?>" />
<label>Name</label>
<input type="text" name="name" value="<?php echo stripslashes($name); ?>"/>
<label>Description </label>
<textarea cols="140" rows="10" name="description"><?php echo stripslashes($description); ?></textarea>
<br />
<button type="submit" name="edit_video" class="btn btn-success">Submit</button>
<a class="btn btn-large" href="video-list.php">Cancel</a>
</form>
</div>
</body>
</html>
