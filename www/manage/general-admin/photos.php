<?php
/*
	Use: 
		Closets To Go CMS 
		display photos submitted through email and testimonial submitting 
	Called from testimonial-page.php and contact-email-page.php
	Variables:
		$ret_page -- return to
		$pid -- key to both testimonial_image and contact_email_image tables
*/
require_once("../includes/config.php"); 
require_once("../includes/class.admin_login.php");
require_once("includes/class.setup_progress.php"); 
$progress = new SetupProgress;
require_once("../admin-includes/class.module.php");	
$module = new Module;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "index";
$page =  ($ret_page == "testimonial-page") ? "company" : "support";
$pid =  (isset($_REQUEST['pid'])) ? $_REQUEST['pid'] : 0;

$str_title = ($ret_page == "testimonial-page") ? "Testimonial Photos" : "Email Photos";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>photos</title>

<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
</head>

<body>

<?php 
include("includes/manage-header.php");
include("includes/manage-nav.php"); 
?>

<div class="page_title_top_spacer"></div>
<div class="page_title">
	<?php echo $str_title; ?>

   	<div class="top_right_link">
    <?php
	$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "start";
	echo "<a href='".$ret_page.".php'>< BACK</a>";
	?>        
    </div>  

</div>
<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>

<div class="page_container">


	<?php
	if($ret_page == "testimonial-page"){
    	$sql = sprintf("SELECT * 
						FROM testimonial_image 
						WHERE testimonial_id = '%u'
						AND profile_account_id = '%u'
						", $pid, $_SESSION['profile_account_id']);
	}else{
    	$sql = sprintf("SELECT * FROM contact_email_image  
						WHERE contact_email_id = '%u'
						AND profile_account_id = '%u'", $pid, $_SESSION['profile_account_id']);
	}
	$img_res = $dbCustom->getResult($db,$sql);
	$prows = $img_res->num_rows;
	
	if(!$prows){
		echo "There are no photos for this entry.<br /><a href='".$ret_page.".php'>Return</a> ";	
	}else{
		$i = 1;
		while($img_row = $img_res->fetch_object()) {
			$block = ''; 
			$block .= "<div class='img_box'>";
			$block .= "<img src='../uploads/".$img_row->file_name."'  width='200px'  />";    
			$block .= "</div>";
			if($i % 4 == 0) $block .= "<div class='clear'></div>";
			$i++;
			echo $block;
		}
    }
	?>

    
</div>

</body>
</html>



