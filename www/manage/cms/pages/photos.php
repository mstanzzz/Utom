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


$page_title = "Photos";
$page_group = "photos";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';
$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "index";
$page =  ($ret_page == "testimonial-page") ? "company" : "support";
$pid =  (isset($_REQUEST['pid'])) ? $_REQUEST['pid'] : 0;

$str_title = ($ret_page == "testimonial-page") ? "Testimonial Photos" : "Email Photos";

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
</head>

<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php
}
?>
	<div class="lightboxcontent">
		<h2>Photos for <?php echo $pid;?></h2>
		<?php
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	if($ret_page == "testimonial-list"){
    	$sql = sprintf("SELECT * FROM testimonial_image WHERE testimonial_id = '%u'", $pid);
		
	}else{
    	$sql = sprintf("SELECT * FROM contact_email_image  WHERE contact_email_id = '%u'", $pid);
	}
	$img_res = $dbCustom->getResult($db,$sql);
	$prows = $img_res->num_rows;
	
	
	if(!$prows){
		echo "There are no photos for this entry.<br /><a class='btn' href='".$ret_page.".php' target='_top'>Return</a> ";	
	}else{
		$i = 1;
		while($img_row = $img_res->fetch_object()) {
			$block = ''; 
			$block .= "<div class='img_box'>";
			$block .= "<img src='".SITEROOT."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name."'  width='200'  />";    
			$block .= "</div>";
			if($i % 4 == 0) $block .= "<div class='clear'></div>";
			$i++;
			echo $block;
			
			//echo SITEROOT."//user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name;
		}
    }
	?>
	</div>
</div>
</body></html>
