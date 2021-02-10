<?php
require_once("../../../includes/config.php"); 
require_once("../../../includes/class.admin_login.php");
require_once("../../../includes/class.admin_bread_crumb.php");
require_once("../../../includes/accessory_cart_functions.php");	
require_once("../../includes/tool-tip.php"); 

require_once("../../includes/class.setup_progress.php"); 
$progress = new SetupProgress;
require_once("../../../includes/class.module.php");	
$module = new Module;

$page_title = "Costco Order History";
$page_group = "order";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

require_once("../../includes/set-page.php");	



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Costco Orders</title>

<link rel="stylesheet" href="<?php echo SITEROOT; ?>/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/mce.css" />

<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/ui/jquery.ui.datepicker.js"></script>


  


<script>
$(document).ready(function() {


	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();

	
	
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
	
	$("#view_desc").click(function(){ $.fancybox.close;  })



});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});

function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}

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

	require_once("../../includes/manage-header.php");
	require_once("../../includes/manage-top-nav.php");


?>




<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once("../../includes/manage-side-nav.php");
        ?>
    </div>	
    
    <div class="top_link">
	    <!--<a href='download-cosco.php'>Download from Commerce Hub</a><br>-->
    </div>

    <div class="manage_main">
	<?php 
	
	echo "<div class='manage_main_page_title'>".$page_title."</div>";
	$bc = $bread_crumb->output();
    echo $bc."<br />"; 


	$profile_account_id = (isset($_POST['profile_account_id']))? $_POST['profile_account_id'] : 0;
	$billing_name = (isset($_POST["billing_name"]))? $_POST["billing_name"] : '';
	$email = (isset($_POST["email"]))? $_POST["email"] : '';
	

	$sql = "SELECT * 
			FROM  costco_save_data
			ORDER BY orderDate ASC";
	$db = $dbCustom->getDbConnect(CART_DATABASE);
$result = $dbCustom->getResult($db,$sql);	
	
	

	$block = '';
	
	
	$block .= "<div class='manage_row_container' style='color:#5a7f8f;'>";

	$block .= "<div style='float:left; width:140px;'>&nbsp;";
	$block .= "</div>";

	$block .= "<div style='float:left; width:60px;'>&nbsp;";
	$block .= "</div>";



	$block .= "<div style='float:left; width:140px;'>&nbsp;";
	$block .= "Billing Name";
	$block .= "</div>";


	$block .= "<div style='float:left; width:100px;'>";
	$block .= "Order Date";
	$block .= "</div>";


	$block .= "<div style='float:left; width:100px;'>";
	$block .= "Status";
	$block .= "</div>";



	$block .= "<div style='float:right; width:100px;'>";
	$block .= "Total";
	$block .= "</div>";


	$block .= "<div class='clear'></div>";
	$block .= "</div>";
	echo $block;

    while($row = $result->fetch_object()) {
		 
		$block = '';
		$block .= "<div class='manage_row_container'>";

		$block .= "<div style='float:left; width:140px;' class='edit'>";
		$block .= "<a href='costco-upload-shipped.php?costco_save_data_id=".$row->costco_save_data_id."' style='text-decoration:none;'>upload shipped</a>"; 
		$block .= "</div>";
	
		$block .= "<div style='float:left; width:60px;' class='edit'>";
		$block .= "<a href='costco-order.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list' style='text-decoration:none;'>view</a>"; 
		$block .= "</div>";
		
		/* cust
		$cust_name = "None";
		$db = $dbCustom->getDbConnect(USER_DATABASE);		
				
		if($row->customer_id > 0){
			$sql = "SELECT name 
					FROM  user
					WHERE id = '".$row->customer_id."'";
			$n_res = mysql_query ($sql);
			if(!$n_res)die(mysql_error());
			if(mysql_num_rows($n_res)){
				$n_obj = mysql_fetch_object($n_res);
				$cust_name = $n_obj->name;
			}
		}
		*/
		
		
		$block .= "<div style='float:left; width:140px; padding-top:10px; padding-left:18px;'>";
		//$block .= $cust_name;
		$block .= $row->name1; 
		$block .= "&nbsp;</div>";


		$block .= "<div style='float:left; width:100px; padding-top:10px;'>";
		$block .= date("m/d/Y",$row->orderDate); 
		$block .= "&nbsp;</div>";
		
		
		
		$block .= "<div style='float:left; width:100px; padding-top:10px;'>";
		if($row->is_shipped){			
			$block .= "Processed";
		}else{
			$block .= "Not Processed";
			
		}
		$block .= "&nbsp;</div>";
		

		$block .= "<div style='float:right; width:100px; padding-top:10px;'>";
		$block .= "$".number_format($row->unitCost,2);
		$block .= "&nbsp;</div>";


		$block .= "<div class='clear'></div>";
		$block .= "</div>";
		
		echo $block;



	}
    
    ?>
    
	</div>
<p class="clear"></p>
<?php 
require_once("../../includes/manage-footer.php");
?>    
    
</div>


</body>
</html>



