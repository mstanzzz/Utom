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

$progress = new SetupProgress;
$module = new Module;

$page_title = "Videos";
$page_group = "videos";
$msg = '';

	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$strip = '';


if(isset($_POST['del_video'])){

	$video_id = $_POST['del_video_id'];

	$sql = sprintf("DELETE FROM video WHERE video_id = '%u'", $video_id);
	$result = $dbCustom->getResult($db,$sql);


	$sql = sprintf("DELETE FROM keyword_landing_to_video WHERE video_id = '%u'", $video_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$msg = "Video Deleted.";
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>

function select_this_video(video_id){
	
	//alert(video_id);
	
	document.getElementById("r"+video_id).checked = true;
	
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
		<?php 
		if(!isset($_SESSION['ret_page'])) $_SESSION['ret_page'] = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';		
		if(!isset($_SESSION['ret_dir'])) $_SESSION['ret_dir'] = (isset($_GET['ret_dir'])) ? $_GET['ret_dir'] : '';
		if(!isset($_SESSION['ret_path'])) $_SESSION['ret_path'] = (isset($_GET['ret_path'])) ? $_GET['ret_path'] : '';
		

		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		
		if($_SESSION['ret_page'] == "edit-keyword-landing"){
			
			$bread_crumb->add("Keyword Landing Pages", $ste_root."manage/cms/keyword-landing/keyword-landing-page-list.php");
			$bread_crumb->add("Edit Keyword Landing Page", $ste_root."manage/cms/keyword-landing/edit-keyword-landing.php");
		}elseif($_SESSION['ret_page'] == "add-keyword-landing"){
		
			$bread_crumb->add("Keyword Landing Pages", $ste_root."manage/cms/keyword-landing/keyword-landing-page-list.php");
			$bread_crumb->add("Add Keyword Landing Page", $ste_root."manage/cms/keyword-landing/add-keyword-landing.php");
		
		}
		
		//echo "rr  ".$_SESSION['ret_page'];
		
		//echo $ste_root."manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php";	
		
		$bread_crumb->add("Select Video", '');
        echo $bread_crumb->output();		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT * 
				FROM video 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		
		$result = $dbCustom->getResult($db,$sql);		
		
		$url_str = $ste_root."manage/cms/add-video.php?ret_page=select-video";	
		
		?>
			<form name="form" action="<?php echo $ste_root."manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php"; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="add_video" value="1">

			<div class="page_actions">
                <a href="<?php echo $url_str;?>" 
                 class="btn btn-primary btn-large"><i class="icon-plus icon-white"></i> Add video to this list </a>
                 
                 <input class="btn btn-success btn-large" type="submit" name="submit" value="Submit Video">
                 
                <a href="<?php echo $ste_root."manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php"; ?>" target='_top'
                class="btn btn-large">Cancel</a>

            </div>
            <div class="clear"></div>
			<div class="data_table">
            	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
          					<th>Image</th>
          					<th>Name</th>
							<th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
						</tr>
					</thead>
					<?php
					$disabled = '';
					$block = ''; 
					while($row = $result->fetch_object()) {
						$block .= "<tr>";
						
						$block .= "<td><a onClick='select_this_video(".$row->video_id.")' href='#' style='text-decoration:none'>";
						$block .= "<img src='http://img.youtube.com/vi/".$row->youtube_id."/0.jpg' /></a></td>";
						
						
						$block .= "<td><a onClick='select_this_video(".$row->video_id.")' href='#' style='text-decoration:none'>".htmlentities($row->name)."</a></td>";
						
						$block .= "<td><input id='r".$row->video_id."' type='radio' name='video_id' value='".$row->video_id."' />".$row->video_id."</td>";
						
						$url_str = "edit-video.php";
						$url_str .= "?ret_page=select-video";
						$url_str .= "&video_id=".$row->video_id;
						
						$block .= "<td><a class='btn btn-primary btn-small fancybox fancybox.iframe' href='".$url_str."'><i class='icon-cog icon-white'></i> Edit</a></td>";							

						
						$block .= "<td><a class='btn btn-danger btn-small confirm ".$disabled." '>
						<i class='icon-remove icon-white'></i>
						<input type='hidden' id='d".$row->video_id."' class='itemId' value='".$row->video_id."' /></a></td>";	
	
						$block .= "</tr>";
					}
					echo $block;
					?>
				</table>
                	<input class="btn btn-success btn-large" type="submit" name="submit" value="Submit Video">	
                </div>
                </form>
				                
			
		
	</div>
	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	
	
	$url_str = "select-video.php";
	$url_str .= "?pagenum=0";
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	
	?>
</div>



<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this video?</h3>
	<form name="del_video" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_video_id" class="itemId" type="hidden" name="del_video_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_video" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>
