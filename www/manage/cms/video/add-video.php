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
$page_title = "Add Video";
$page_group = "video";
$ret_page = (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : 'select-video';
$strip = (isset($_REQUEST['strip'])) ? $_REQUEST['strip'] : 0;
$fromfancybox = (isset($_GET['fromfancybox'])) ? $_GET['fromfancybox'] : 0;
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$msg = '';

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
</head>
<body>
<?php echo $msg; ?> 
<form action="video-list.php" method="post.php" enctype="multipart/form-data">
<input type="hidden" name="add_video" value="1">
<label>Enter the whole Youtube URL</label>
<input type="text" name="youtube_url" style="width:400px !important;" />
<br />
<label>Name</label>
<input type="text" name="name" style="width:400px !important;" />
<br />
<label>Description </label>
<textarea cols="42" rows="5" name="description"></textarea>
<br />
<label>RAW HTML</label>
<textarea cols="42" rows="5" name="raw_html"></textarea>

<button type="submit" name="add_video" class="btn btn-success"><i class="icon-ok icon-white"></i> Submit </button>
<a class="btn btn-large" href="<?php echo $ret_page.".php"; ?>">Cancel</a> 
</form>
</body>
</html>
