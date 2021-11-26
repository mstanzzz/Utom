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
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['add_video'])){
	$name = trim(addslashes($_POST['name']));
	$description = trim(addslashes($_POST['description']));
		
	$stmt = $db->prepare("INSERT INTO video
					(name
					,description
					,profile_account_id)
					VALUES
					(?,?,?)"); 
				//echo 'Error INSERT   '.$db->error;
	if(!$stmt->bind_param("ssi",
					$parent_item_id
					,$profile_item_id
					,$_SESSION['profile_account_id'])){
			$msg = "There was a problem this action";
			//exit;
	}else{
		$stmt->execute();
		$stmt->close();
		$item_id = $db->insert_id;	
	}

}

if(isset($_POST['update_video'])){
	$name = trim(addslashes($_POST['name']));
	$description = trim(addslashes($_POST['description']));
	$video_id = $_POST['video_id'];
	
	echo "<br />";
	echo "name:   ".$name;
	echo "<br />";
	echo "description:   ".$description;
	echo "<br />";
	echo "video_id:   ".$video_id;
	
	$stmt = $db->prepare("UPDATE video
						SET name = ?
						,description = ?
					WHERE video_id = ?");					
			//echo 'Error INSERT   '.$db->error;
	if(!$stmt->bind_param("ssi",
					$name
					,$description
					,$video_id)){
			$msg = "There was a problem this action";
			//exit;
	}else{
		$stmt->execute();
		$stmt->close();
		$video_id = $db->insert_id;	

	}
}




if(isset($_POST["del_video"])){
	$video_id = $_POST["del_video_id"];
	if(!is_numeric($video_id))$video_id=0;
	$sql = sprintf("SELECT file_name
			FROM video 
			WHERE video_id = '%u'", $video_id);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$video_obj = $result->fetch_object();			
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/ul_cms/".SITEROOT."/video/".$video_obj->file_name)){
			unlink ($_SERVER['DOCUMENT_ROOT']."/ul_cms/".SITEROOT."/video/".$video_obj->file_name);
		}
		$sql ="DELETE FROM video WHERE video_id = '".$video_id."'";
		$result = $dbCustom->getResult($db,$sql);
	}
	$msg = "Video deleted.";
}


if(isset($_POST['set_active'])){
	$video_id = (isset($_POST["video_id"]))? $_POST["video_id"] : 0;
	$sql = "UPDATE video SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "UPDATE video SET active = '1' WHERE video_id = '".$video_id."'";		
	$result = $dbCustom->getResult($db,$sql);
	$msg = "Your change is now live.";
}
require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>
function previewSubmit() {
  document.form.action = '<?php echo SITEROOT; ?>/pages/preview/preview.php';
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
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<h1>Video Files</h1>
		<?php if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
<?php 
		} else {} 
$url_str = "add-video.php";
$url_str .= "?ret_page=video-list";
echo "<a href='".$url_str."'>ADD</a>";
?>
		<form name="form" action="video-list,php" method="post">
      		<input type="hidden" name="ret_page" value="video-list">        
            <input type="hidden" name="ret_dir" value="manage/cms/video">
            <input type="hidden" name="page_title" value=''>  
			<input type="hidden" name="content_table" value="video"> 
			<input type="hidden" name="set_active" value="1"> 
    		<div class="page_actions"> 
            	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
            </div>
    		<div class="data_table">
				<table border="0" cellpadding="10" cellspacing="0">
					<tr>
					<th>Misc</th>
					
					<th width="10%">Active</th>
					<th width="10%">EDIT</td>
					<th width="10%">Delete</th>
					</tr>
				
<?php
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT video_id, active, file_name, description, raw_html, video_url  
    FROM video 
	WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	
//echo $result->num_rows;
$block = '';
while($row = $result->fetch_object()){
$block .= "<tr style='height:400px'>";

$video_str = '';
$video_str .= "<iframe class='yvideo' width='100%' height='100%' src='".$row->video_url."'
frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' 
allowfullscreen=''></iframe>";


$block .= "<td>".$video_str."</td>";

$checked = ($row->active)? "checked" : '';
$block .= "<td>";
$block .= "<div class='radiotoggle on'>"; 
$block .= "<span class='ontext'>ON</span>
			<a class='switch on' href='#'></a>
			<span class='offtext'>OFF</span>
			<input type='checkbox' class='radioinput' name='video_id' value='".$row->video_id."' $checked />";
$block .= "</div>";
$block .= "</td>";		
$url_str = "edit-video.php";
$url_str .= "?video_id=".$row->video_id;
$block .= "<td>
			<a class='btn btn-primary' href='".$url_str."'>Edit</a>";
$block .= "</td>";
$block .= "<td>";
$block .= "<a style='width:90%;' class='btn btn-danger confirm btn-small'>
			<p>DEL</p>
			<input type='hidden' id='".$row->video_id."' class='itemId' value='".$row->video_id."' />";
$block .= "</a>";
$block .= "</td>";		

$block .= "</tr>";
}
echo $block;
?>
				</table>
			</div>
		</form>

       	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large">Save Changes </a>

	</div>
	<p class="clear"></p>
    <?php
	$url_str = "video-list.php";
	//$url_str .= "&strip=".$strip;											
	//$url_str .= "&pagenum=".$pagenum;
	//$url_str .= "&sortby=".$sortby;
	//$url_str .= "&a_d=".$a_d;
	//$url_str .= "&truncate=".$truncate;

	?>
    
    <div id="content-delete" class="confirm-content">
        <h3>Are you sure you want to delete this Video?</h3>
        <form name="del_video" action="<?php echo $url_str; ?>" method="post" target="_top">
            <input id="del_video_id" class="itemId" type="hidden" name="del_video_id" value='' />
            <a class="btn btn-large dismiss">No, Cancel</a>
            <button class="btn btn-danger btn-large" name="del_video" type="submit" >Yes, Delete</button>
        </form>
    </div>
	<?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
    ?>
</div>
</body>
</html>
