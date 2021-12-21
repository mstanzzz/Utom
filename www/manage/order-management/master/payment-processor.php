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
require_once("<?php echo SITEROOT; ?>../includes/class.admin_login.php");
require_once("<?php echo SITEROOT; ?>../includes/class.admin_bread_crumb.php");	
require_once("<?php echo SITEROOT; ?>includes/tool-tip.php"); 

require_once("<?php echo SITEROOT; ?>includes/class.setup_progress.php"); 
$progress = new SetupProgress;
require_once("<?php echo SITEROOT; ?>../includes/class.module.php");	
$module = new Module;

$page_title = "Payment Processor";
$page_group = "order";

$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

require_once("<?php echo SITEROOT; ?>includes/set-page.php");	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php  echo $page_title; ?></title>

<link rel="stylesheet" href="<?php echo SITEROOT; ?>js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>css/mce.css" />

<script type="text/javascript" src="<?php echo SITEROOT; ?>js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>js/tiny_mce/tiny_mce.js"></script>

<script>
$(document).ready(function() {
	
	$(".inline").click(function(){ 

		if(this.href.indexOf("view_desc") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("edit"));
						
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'view-item-description.php?item_id='+f_id,
			  success: function(data) {
				$('#view_desc').html(data);
				//alert('Load was performed.');
			  }
			});			
			
		}
		
	})
	
	$("a.inline").fancybox();

});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});


function show_msg(msg){
	alert(msg);
}

</script>
</head>

<?php if($msg != ''){ ?>
	<body onload="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

	require_once("<?php echo SITEROOT; ?>includes/manage-header.php");
	require_once("<?php echo SITEROOT; ?>includes/manage-top-nav.php");


?>

<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once("<?php echo SITEROOT; ?>includes/manage-side-nav.php");
        ?>
    </div>	
    
    <!--<div  class="top_link"> <a href='new-processor-request.php'>Request new payment processor</a> </div>-->

    <div class="manage_main">

	<?php 

	echo "<div class='manage_main_page_title'>".$page_title."</div>";
    
	$bc = $bread_crumb->output();
    echo $bc."<br />"; 
	

	$db = $dbCustom->getDbConnect(CART_DATABASE);	
	$sql = "SELECT *
			FROM payment_processor";
    $result = $dbCustom->getResult($db,$sql);	


	$block = '';
	$block .= "<div class='manage_row_container' style='color:#5a7f8f;'>";
	
	$block .= "<div style='float:left; width:100px;'>";
	$block .= "&nbsp;</div>";
	
	$block .= "<div style='float:left; width:100px;'>";
	$block .= "&nbsp;</div>";

	$block .= "<div style='float:left; width:200px;'>";
	$block .= "&nbsp;</div>";
	
	$block .= "<div style='float:left; width:200px;'>";
	$block .= "Processor Name</div>";

	$block .= "<div class='clear'></div>";
	$block .= "</div>";
	echo $block;

    while($row = $result->fetch_object()) {
	
	
	
	// add radio buttons to choose processor.
	
		 
		$block = '';
		$block .= "<div class='manage_row_container'>";

		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$sql = "SELECT payment_processor_id
				FROM profile_account
				WHERE id = '".$_SESSION['profile_account_id']."'";
		$pp_res = mysql_query ($sql);
		if(!$pp_res)die(mysql_error());
		if(mysql_num_rows($pp_res) > 0){
			$pp_obj = mysql_fetch_object($pp_res);
			$payment_processor_id = $pp_obj->payment_processor_id;
		}else{
			$payment_processor_id = 0;
		}
		if(($payment_processor_id == 0 && $row->payment_processor_id == 1)|| $_SESSION['profile_account_id'] = $row->payment_processor_id){
			$checked = "checked";	
		}else{
			$checked = '';	
		}
				
		$block .= "<div style='float:left; width:100px;'>";
		$block .= "<input type='radio' $checked>"; 
		$block .= "</div>";
		
		$block .= "<div style='float:left; width:100px;'>";
		$block .= ''; 
		$block .= "</div>";

		$block .= "<div style='float:left; width:200px;'>";
		$block .= "<a href='payment-processor-credentials.php?payment_processor_id=".$row->name."'>Credentials</a>";
		$block .= "</div>";

		$block .= "<div style='float:left; width:200px;'>";
		$block .= $row->name; 
		$block .= "</div>";
		


		$block .= "<div class='clear'></div>";
		$block .= "</div>";
		
		echo $block;

	}
	
	
	
	
		

    
    ?>
    
	</div>
<p class="clear"></p>
<?php 
require_once("<?php echo SITEROOT; ?>includes/manage-footer.php");
?>    
   
</div>



    <div style="display:none">
        <div id="edit" style="width:900px; height:620px;">
        </div>
    </div>
    

</body>
</html>



