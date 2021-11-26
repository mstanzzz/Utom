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

$page_title = "Add-ons Change Request";
$page_group = "admin";
$msg = '';

	

if(isset($_POST['send_request'])){

	$db = $dbCustom->getDbConnect(USER_DATABASE);
		
	$module_names = '';
		
	if(isset($_POST["module_ids"])){
		$module_ids = $_POST["module_ids"]; 
		$i = 0;
		foreach($module_ids as $value){
			
			$sql = "SELECT name 
					FROM module
					WHERE id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			if($result->num_rows > 0){
				$object = $result->fetch_object();	
				if($i == 0){
					$module_names .= "\"".$object->name."\"";
				}else{
					$module_names .= ", \"".$object->name."\"";
				}
				$i++;
			}
			
		}
		
		$sql = "SELECT company, domain_name, email, phone 
				FROM profile_account
				WHERE id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);
		
		$object = $result->fetch_object();
		$company = $object->company;
		SITEROOT_name = $object->domain_name;
		$email = $object->email;
		$phone = $object->phone;

		$message = '';
		
		$message .= "<html>";
		$message .= "<head>";
		$message .= "<title>Add-on Request</title>";
		$message .= "</head>";
		$message .= "<body>";
		$message .= "<div style='color:#565656;'>";
		$message .= "<div style='background:#efefef; width:100%; padding:8px;'>";
		$message .= "Saas Customer Add-on Change request";
		$message .= "</div><br />";
		$message .= "<div style='float:left; width:140px; text-align:right;'>Company Name</div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>$company</div>";
		$message .= "<div style='clear:both;'></div>";
		$message .= "<div style='float:left; width:140px; text-align:right;'>Domain Name:</div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>SITEROOT_name</div>";
		$message .= "<div style='clear:both;'></div>";
		$message .= "<div style='float:left; width:140px; text-align:right;'>Email:</div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>$email</div>";
		$message .= "<div style='clear:both;'></div>";
		$message .= "<div style='float:left; width:140px; text-align:right;'>Phone:</div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>$phone</div>";
		$message .= "<div style='clear:both;'></div>";	
		$message .= "<div style='float:left; width:140px; text-align:right;'>Requested Add-ons:</div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>$module_names</div>";
		$message .= "<div style='clear:both;'></div>";
		$message .= "</div><br /><br />";
		$message .= "</body>";
		$message .= "</html>";


	
		$subject_c = "Add-on Change Request";		
	
		$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: help@closetstogo.com";
		$headers .= "\r\n";
		$headers .= "Return-path: help@closetstogo.com";

		//$headers .= "\r\n";
		//$headers .= "CC: mark.stanz@gmail.com";		
		//$headers .= "\r\n";
		//$headers .= "Bcc: mike@closetstogo.com";
	
	
		//$to = "services@closetstogo.com";
		$to = "mark.stanz@gmail.com";
		error_reporting(0);
		if(!mail($to, $subject_c, $message, $headers)){
		}
	
		$msg = "Your request has been submitted";



	}

		
	$url = SITEROOT.'/manage/start.php';	

	header('Location: '.$url);


	
}



require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script>


function validate(theform){	

	
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

function checkPercent(str){
	
	var ret = 1;
	
	if(!IsNumeric(str)){
		alert("Please enter valid numbers only");
		ret = 0;	
	}else{	
		if(str != 0 && str <= 1){
			alert("Please enter 0 or a number greater than 1");
			ret = 0;
		}
		
		if(str >= 100){
			alert("Please enter a number less than 100");
			ret = 0;
		}
	}
	
	return ret;
}

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",	
	content_css : "../css/mce.css"
});


</script>
</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
        require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("Administration", SITEROOT."manage/general-admin/admin-landing.php");
		$bread_crumb->add("Addon Change Request", '');
        echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
		?>
		<form name="edit_addons_form" action="add-on-change-request.php " method="post" onSubmit="return validate(this);">
            
            <div class="page_actions edit_page">
				<?php if($admin_access->administration_level > 1){ ?>
                    <button type="submit" name="send_request" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
                    <hr />
                 <?php }else{ ?>
                    <div class="alert">
                        <i class="icon-warning-sign"></i>         
                        Sorry, you don't have the permissions to make this requests.
                    </div>            
                <?php } ?>
			</div>
			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<div class="alert alert-info">To change add-ons, choose the the ones you want active, and submit your request. Your fees may be adjusted. </div>
					<?php
						$db = $dbCustom->getDbConnect(USER_DATABASE); 
						$sql = "SELECT id, name 
						FROM module 
						WHERE name != 'social network and blog'";
						$result = $dbCustom->getResult($db,$sql);						
						$block = '';
						while($row = $result->fetch_object()) {
							$sql = "SELECT id 
							FROM profile_account_to_module
							WHERE module_id = '".$row->id."' 
							AND profile_account_id = '".$_SESSION['profile_account_id']."'";
							
							$res = $dbCustom->getResult($db,$sql);

							
							if($res->num_rows > 0){
								$checked = "checked='checked'"; 
							}else{
								$checked = '';
							}
							$disabled = ($admin_access->administration_level < 2)? "disabled" : '';
							$block .= "<h3><div class='checkboxtoggle on fltlft mR15 ".$disabled." '> 
							<span class='ontext'>ON</span><a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='module_ids[]' value='".$row->id."' ".$checked." /></div>".$row->name."</h3><hr />";
						}
						echo $block;
					
					?>
				</fieldset>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
