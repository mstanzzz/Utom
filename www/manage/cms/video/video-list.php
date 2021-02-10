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


$page_title = "Video List";
$page_group = "video";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';


if(isset($_POST["del_video"])){


		$video_id = $_POST["del_video_id"];

		$sql = sprintf("SELECT file_name
			FROM video 
			WHERE video_id = '%u'", $video_id);
		$result = $dbCustom->getResult($db,$sql);
		
		
		if($result->num_rows > 0){
			$video_obj = $result->fetch_object();			

			if(file_exists($_SERVER['DOCUMENT_ROOT']."/ul_cms/".$domain."/video/".$video_obj->file_name)){
				unlink ($_SERVER['DOCUMENT_ROOT']."/ul_cms/".$domain."/video/".$video_obj->file_name);
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



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>


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
   		<?php
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Video List", '');
        echo $bread_crumb->output();
		?>

		<h1>Video Files</h1>

		<?php if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
		<?php } else {} ?>
		<form name="form" action="logo.php" method="post">

      		<input type="hidden" name="ret_page" value="video-list">        
            <input type="hidden" name="ret_dir" value="manage/cms/video">
            <input type="hidden" name="page_title" value=''>  
			<input type="hidden" name="content_table" value="video"> 
			<input type="hidden" name="set_active" value="1"> 
            
			
            <?php if($admin_access->cms_level > 1){ ?>
			<div class="page_actions"> 
            	<a class="btn btn-large btn-primary fancybox fancybox.iframe" 
                href='<?php echo $ste_root ?>/manage/cms/upload.php?ret_dir=video&ret_page=video-list'>
            	<i class="icon-plus icon-white"></i> Upload Video</a> 
                
            	<a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
            	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
            </div>
            <?php } ?>
            
            
            
			
			<div class="data_table">
				<table border="0" cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="80%">File Name</th>
							<th width="10%">Active</th>
							<th width="10%">Delete</th>
						</tr>
					</thead>
					<?php

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

	$sql = "SELECT video_id, active, file_name 
    FROM video 
	WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
    $result = $dbCustom->getResult($db,$sql);	
	
	//echo $result->num_rows;
	$block = '';
	while($row = $result->fetch_object()){
    	$block .= "<tr>";
		$block .= "<td valign='middle'>".$row->file_name."</td>";
  		
		$checked = ($row->active)? "checked" : '';
		$disabled = ($admin_access->cms_level < 2)? "disabled" : '';
		$block .= "<td valign='middle' class='center'>
			<div class='radiotoggle on ".$disabled." '> 
			<span class='ontext'>ON</span>
			<a class='switch on' href='#'></a>
			<span class='offtext'>OFF</span>
			<input type='radio' class='radioinput' name='video_id' value='".$row->video_id."' $checked /></div></td>";		

		$block .= "<td valign='middle'>
		<a class='btn btn-danger confirm btn-small ".$disabled." '>
		<i class='icon-remove icon-white'></i>
		<input type='hidden' id='".$row->video_id."' class='itemId' value='".$row->video_id."' /></a></td>";
		
		$block .= "</tr>";
		
	}
	echo $block;
    ?>
				</table>
			</div>
		</form>

       	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>

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
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
    ?>
</div>
</body>
</html>
