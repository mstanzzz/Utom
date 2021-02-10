<?php
ini_set('display_errors', false);
require_once("../includes/config.php"); 
require_once("../admin-includes/db_connect.php");
require_once("../includes/class.admin_login.php");
require_once("../admin-includes/class.admin_bread_crumb.php");	
require_once("includes/tool-tip.php"); 

require_once("includes/class.setup_progress.php"); 
$progress = new SetupProgress;
require_once("../admin-includes/class.module.php");	
$module = new Module;


$page_title = "start";

require_once("includes/set-page.php");	


//echo "<pre>";
//print_r($_SESSION);
//exit;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Main</title>
<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="../js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script src="../../css/jquery.js"></script>
<script>
$(document).ready(function(){    
		$("div.accord_body3").toggle("fast",function(){
			
		});
	});

$(document).ready(function(){
	
	
/*	
	$('#tabs div').hide(); // Hide all divs
	$('#tabs div:first').show(); // Show the first div
	$('#tabs ul li:first').addClass('active'); // Set the class of the first link to active
	$('#tabs ul li a').click(function(){ //When any link is clicked
		$('#tabs ul li').removeClass('active'); // Remove active class from all links
		$(this).parent().addClass('active'); //Set clicked link class to active
		var currentTab = $(this).attr('href'); // Set variable currentTab to value of href attribute of clicked link
		$('#tabs div').hide(); // Hide all divs
		$(currentTab).show(); // Show div with id equal to variable currentTab
		return false;
	});
	
*/	
	
	
});
</script>
</head>
<body>
<?php 

	require_once("includes/manage-header.php");
?>
<div class="manage_page_container">
<div class="manage_side_nav">
  <?php 
    require_once("includes/manage-side-nav.php");
    ?>
</div>
<div class="manage_main">
  <!--
<br />
<br />
<a href="<?php //echo $ste_root; ?>/cms/start.php">CMS</a>
<br />
<a href="<?php //echo $ste_root; ?>/cart/start.php">Cart</a>
<br />
<a href="global-discount.php">global discounts</a>
<br />
<a href="admin-users.php">admin users</a>
<br />
<a href="admin-levels.php">admin levels</a>
<br />
<a href="customers.php">customers</a>
<br />
<a href="account-email.php">customer Account Email</a>
<br />
<a href="contact-email.php">site contact form email</a>
<br />
<a href="blog.php">blog</a>
<br />
<a href="news.php">news</a>
<br />
<a href="list-closets.php">list closets</a>
<br />
<a href="special.php" style="color:#3f6e84;">specials</a>
<br />
<a href="installer-applications.php" style="color:#3f6e84;">installer applications</a>
<br />
<a href="dealer-applications.php" style="color:#3f6e84;">dealer applications</a>
<br />
<a href="feedback.php" style="color:#3f6e84;">feedback</a>
<br />
-->
  <div class="dashboard_container">
    <div class="box_header">Shopping Cart</div>
    <div class="inner_container">
      <div class="left">
        <ul class="admin_dashboard_row">
          <li class="top_cat"><a href="cart/top-category.php">CMS</a></li>
          <li class="cat"><a href="cart/category.php"> Order Management</a></li>
          <li class="items"><a href="cart/item.php">Shopping Cart</a></li>
          <li class="vendor"><a href="cart/vend-man.php">CMS</a></li>
          <li class="style"><a href="cart/style.php"> Order Management</a></li>
        </ul>
      </div>
      <div class="left">
        <ul class="admin_dashboard_row">
          <li class="lead_time"><a href="cart/cart/lead-time.php">Shopping Cart</a></li>
          <li class="skill_level"><a href="cart/skill-level.php">Customers</a></li>
          <li class="ship_portal"><a href="cart/ship-portal.php">General Admin </a></li>
          <li class="attribute"><a href="cart/attribute.php">Ask Organizer </a></li>
          <li class="type"><a href="cart/type.php">Customers</a></li>
        </ul>
      </div>
      <div class="left">
        <ul class="admin_dashboard_row">
          <li class="delete_images"><a href="cart/images.php">General Admin </a></li>
          <li class="item_reviews"><a href="cart/item-review.php">Ask Organizer </a></li>
          <li class="shipping_type"><a href="cart/ship-type.php">Ask Organizer </a></li>
          <li class="shipping_carrier"><a href="cart/ship-carrier.php">Ask Organizer </a></li>
          <li class="shipping_method"><a href="cart/ship-method.php">Ask Organizer </a></li>
        </ul>
      </div>
      <div class="left">
        <ul class="admin_dashboard_row">
          <li class="shipping_flat_charges"><a href="cart/ship-flat-charge.php">Ask Organizer </a></li>
          <li class="shipping_login_credentials"><a href="cart/ship-credentials.php">Ask Organizer </a></li>
        </ul>
      </div>
    </div>
    <p class="clear"></p>
  </div>
</div>
<p class="clear"></p>
<?php 
    require_once("includes/manage-footer.php");
    ?>
</body>
</html>

