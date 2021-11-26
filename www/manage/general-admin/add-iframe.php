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

require_once($_SERVER['DOCUMENT_ROOT']."/includes/iframe_functions.php");
 
$progress = new SetupProgress;
$module = new Module;



$page_title = "Add Iframe";
$page_group = "admin";

	



$msg = '';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<link rel="stylesheet" href="<?php echo SITEROOT; ?>/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/mce.css" />

<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/tiny_mce/tiny_mce.js"></script>


<script>

function validate(theform){	



	var domain_name = jQuery.trim(theform.domain_name.value);
	
	if(domain_name.length < 5){
		alert("Please enter a domain name");	
		return false;	
	}
	return true;

}

function IsNumeric(sText)
{
	
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
	  
	  
   return IsNumber;
   
     
}

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",	
	content_css : "../css/mce.css"
});

function show_msg(msg){
	alert(msg);
}


function set_iframe_input(){
	var block = '';
	block += "<div style='padding-right:20px'><b>Iframes Allowd</b></div>";
	block += "<input type='text' name='iframes_allowed'  size='10' />";
	$("#iframe_input").html(block);
}


</script>

	<body>



<div class="page_title_top_spacer"></div>
<div class="page_title">

	<div class="top_right_link">
    </div> 
</div>


<div class="manage_page_container">



	<div class="top_link">
       	<a href=''></a>
    </div>

	<div class="manage_main">
	
    <?php
	
	echo "<div class='manage_main_page_title'>".$page_title." </div>";
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	echo $bread_crumb->output();
	echo "<br />";


	
	if(getUsedIframeCount($_SESSION['profile_account_id']) >= getIframeCount($_SESSION['profile_account_id'])){
		echo "You have reached the max number of iframes allowed";
	}else{
		$unused = (getIframeCount($_SESSION['profile_account_id'])) - (getUsedIframeCount($_SESSION['profile_account_id']));
		echo "You have used ".getUsedIframeCount($_SESSION['profile_account_id'])." iframes<br />";
		echo "You have ".$unused." iframes unused<br />";
		
	?>
    
        <form name="add_iframe_form" action="create_iframe.php" method="post" onsubmit="return validate(this);">
        	
		<table border="0" cellpadding="8">
            <tr>
        	<td><div class="head">Domain Name</div></td>
	        <td><input type="text" name="domain_name"  maxlength="160" size="30" /></td>
        </tr>

        <tr>
        <td colspan="2">
		<div style="float:left; padding-left:1px; padding-right:60px; padding-top:33px;">		
	        <input name="add_iframe" type="submit" value="Save" />
        </div>
        <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input type="button" value="Cancel" onclick="location.href = 'iframe.php'; " />
        </div>
        </td>
        </tr>
        </table>
        </form>
	<?php } ?>
	</div>
    <p class="clear"></p>

    </div>
</body>
</html>



