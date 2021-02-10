<?php
require_once("../includes/config.php"); 
include("../includes/class.admin_login.php");
$aLgn = new AdminLogin;
if(!$aLgn->isLogedIn()){
	$aLgn->redirect("manage/index.php", "Please Log In");	
}
$user_functions_array = $aLgn->getUserFunctions();
$user_id = $aLgn->getUserId();
if(!in_array(1,$user_functions_array) && !in_array(2,$user_functions_array)){
	$aLgn->redirect("manage/start.php", "Content management is not a function of this user");	
}

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CTG CMS Main</title>
<link type="text/css" rel="stylesheet" href="../css/cmsNav.css" />
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />

<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>

<script>
$(document).ready(function() {
	
	$(".inline").click(function(){ 


		
		
	})
	
	$("a.inline").fancybox();
});

</script>
</head>

<body>
<?php 
include("includes/cms-header.php");
include("includes/cms-nav.php"); 
?>

<div class="page_title_top_spacer"></div>
<div class="page_title">
	URL Reference

</div>
<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>

<div class="page_container">



<div class="blue">To add links in your content, use the following:</div><br />


<table width="100%" border="0">
  <tr>
    <td width="24%">Signup</td>
    <td>../custom-closet-signup.html</td>
  </tr>

  <tr>
    <td width="24%">Feedback</td>
    <td>../closet-organizer/closet-organizers-feedback.html</td>
  </tr>
  <tr>
    <td>Privacy Statement</td>
    <td>../closet-organizer/closet-organizers-privacy-statement.html</td>
  </tr>
  <tr>
    <td>Terms of Use</td>
    <td>../closet-organizer/closet-organizers-terms-of-use.html</td>
  </tr>
  <tr>
    <td>Installation</td>
    <td>../closet-organizer/closet-organizer-installation.html</td>
  </tr>
  <tr>
    <td>Specs</td>
    <td>../closet-organizer/closet-organizer-specs.html</td>
  </tr>
  <tr>
    <td>Installers Wanted</td>
    <td>../closet-organizer/closet-system-installers.html</td>
  </tr>
  <tr>
    <td>Showroom</td>
    <td>../closet-organizer.html</td>
  </tr>
  <tr>
    <td>FAQs</td>
    <td>../closet-system/closet-system-faq.html</td>
  </tr>
  <tr>
    <td>Contact us</td>
    <td>../closet-system/closet-system-contact.html</td>
  </tr>
  <tr>
    <td>Email us</td>
    <td>../custom-closet-organizers/email-us.html</td>
  </tr>
  <tr>
    <td>Guides & Tips</td>
    <td>../custom-closet-organizers/closet-system-guides-and-tips.html</td>
  </tr>
  <tr>
    <td>Support Added Page</td>
    <td>../custom-closet-organizers/<span class="blue"><i>the-page-name</i></span>.html</td>
  </tr>
  <tr>
    <td>Company Added Page</td>
    <td>../closet-systems/<span class="blue"><i>the-page-name</i></span>.html</td>
  </tr>
  <tr>
    <td>Process</td>
    <td>../closet-design/custom-closets-design.html</td>
  </tr>
  <tr>
    <td>Policies</td>
    <td>../closet-system/custom-closets-policies.htmll</td>
  </tr>
  <tr>
    <td>Shipping</td>
    <td>../custom-closets-shipping.html</td>
  </tr>
  <tr>
    <td>Shipping Time</td>
    <td>../closet-system/shipping-time.html</td>
  </tr>
  <tr>
    <td>Discounts</td>
    <td>../closet-systems/closet-organizer-discounts.html</td>
  </tr>
  <tr>
    <td>Discounts How</td>
    <td>../closet-systems/discounts-how.html</td>
  </tr>
  <tr>
    <td>Testimonials</td>
    <td>../closet-systems/custom-closets-testimonials.html</td>
  </tr>
  <tr>
    <td>About</td>
    <td>../closet-systems/about-closet-organizer.html</td>
  </tr>
  <tr>
    <td>In-home-consultation</td>
    <td>../closet-organizer/closet-organizers-in-home-consultation.html</td>
  </tr>
  
  
  
</table>

<br />
<br />

<div class="blue">front end page container to url:</div><br />
<table width="100%" border="0">
  <tr>
    <td width="24%">index.php</td>
    <td>closet-organizer</td>
  </tr>
  <tr>
    <td>custom-closets.php</td>
    <td>custom-closets</td>
  </tr>
  <tr>
    <td>support.php</td>
    <td>custom-closet-organizers</td>
  </tr>
  <tr>
    <td>company.php</td>
    <td>closet-systems</td>
  </tr>
</table>

<br />
<br />
<br />
<br />
    

</div>
<?php include("includes/cms-footer.php"); ?>

</body>
</html>

