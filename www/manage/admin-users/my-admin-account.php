<?php
require_once('<?php echo SITEROOT; ?>includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once("<?php echo SITEROOT; ?>includes/config.php"); 
require_once("<?php echo SITEROOT; ?>includes/class.admin_login.php");

require_once("../admin-includes/class.setup_progress.php"); 
$progress = new SetupProgress;
require_once("<?php echo SITEROOT; ?>admin-includes/class.module.php");	
$module = new Module;


exit;

$aLgn = new AdminLogin;
if(!$aLgn->isLogedIn()){
	$aLgn->redirect("index.php", "Please Log In");	
}
$user_level = $aLgn->getUserLevel();

$page = "home";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Main</title>

<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />

<style>

#tabs {
	float:right;
	width:400px;
}
#tabs li {
	list-style: none;
	display: inline;
	padding:6px;
	margin-right:6px;
	border-left-style:solid;
	border-left-width:thin;
	border-top-style:solid;
	border-top-width:thin;
	border-right-style:solid;
	border-right-width:thin;	
	background:#ebebeb;
	
}
#tabs li, #tabs li a {
	float: right;
}
#tabs ul{
	padding:0px;
	margin: 0px;
}
#tabs ul li a {
	text-decoration: none;
	color:#999;
}
#tabs ul li.active {
	background:#FFF;
}
#tabs ul li.active a {
	color:#000;	
}
#tabs div {
	clear: both;
	height: 300px;
	border-style:solid;
	border-width:thin;
	overflow: auto;
	padding:10px;

}


</style>


<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>

<script>



$(document).ready(function(){
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
});


</script>
</head>

<body>
<div class="admin_page_inner_container">
<div class="admin_page_inner_container">





</div>
</div>
</body>
</html>























