<?php
require_once("<?php echo SITEROOT; ?>/../includes/config.php"); 
require_once("<?php echo SITEROOT; ?>/../includes/class.admin_login.php");
require_once("<?php echo SITEROOT; ?>/../includes/class.admin_bread_crumb.php");
require_once("<?php echo SITEROOT; ?>/../includes/accessory_cart_functions.php");	
require_once("<?php echo SITEROOT; ?>/includes/tool-tip.php"); 

require_once("<?php echo SITEROOT; ?>/includes/class.setup_progress.php"); 
$progress = new SetupProgress;
require_once("<?php echo SITEROOT; ?>/../includes/class.module.php");	
$module = new Module;

$page_title = "View Costco Order XML";
$page_group = "order";

require_once("<?php echo SITEROOT; ?>/includes/set-page.php");	



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Costco Orders</title>

<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/manageStyle.css" />

<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/jquery-1.4.4.js"></script>


  
</head>
<body>
<?php

	require_once("<?php echo SITEROOT; ?>/includes/manage-header.php");
	require_once("<?php echo SITEROOT; ?>/includes/manage-top-nav.php");


?>




<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once("<?php echo SITEROOT; ?>/includes/manage-side-nav.php");
        ?>
    </div>	
    

    <div class="manage_main">
	<?php 
	
	echo "<div class='manage_main_page_title'>".$page_title."</div>";
	$bc = $bread_crumb->output();
    echo $bc."<br />"; 

	$costco_save_data_id = (isset($_GET["costco_save_data_id"]))? $_GET["costco_save_data_id"] : 0; 
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);	
	$sql = "SELECT filename  
			FROM costco_save_data
			WHERE costco_save_data_id = '".$costco_save_data_id."'";
	 $result = $dbCustom->getResult($db,$sql);	 	 
	 //echo $result->num_rows;
	 if($result->num_rows > 0){
	 	$object = $result->fetch_object();	
	 	
		echo file_get_contents ($object->filename);
	 
	 	//echo $object->filename;
	 }
	
?>
	</div>
<p class="clear"></p>
<?php 
require_once("<?php echo SITEROOT; ?>/includes/manage-footer.php");
?>    
    
</div>


</body>
</html>



