<?php

session_start();

if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){  
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; }elseif(strpos($_SERVER['REQUEST_URI'], "designitpro" )){  
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']."/designitpro"; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){  
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site'; 
}else{
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Request new Payment Processor";
$page_group = "order";

$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	


if(isset($_POST["submit"])){
	
	$req = trim(addslashes($_POST["req"])); 
	
	
	
		$message = '';
	
	$message .= "<html>";
	$message .= "<head>";
	$message .= "<title>Request</title>";
	$message .= "</head>";
	$message .= "<body>";
	$message .= "<div style='color:#565656;'>";
	$message .= "<div style='background:#efefef; width:100%; padding:8px;'>";
	$message .= "Saas customer request for new payment processor";
	$message .= "</div><br />";


	$db = $dbCustom->getDbConnect(USER_DATABASE);

	$sql = "SELECT domain_name, company, contact_email, phone   
			FROM profile_account
			WHERE id = '".$_SESSION['profile_account_id']."'";
	$pp_res = mysql_query ($sql);
	if(!$pp_res)die(mysql_error());
	if(mysql_num_rows($pp_res)){
		
		$pp_obj = mysql_fetch_object($pp_res);

		$message .= "<div style='float:left; width:140px; text-align:right;'>Domain Name:</div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>$pp_obj->domain_name</div>";
		$message .= "<div style='clear:both;'></div>";
		$message .= "<div style='float:left; width:140px; text-align:right;'>Company:</div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>$pp_obj->company</div>";
		$message .= "<div style='float:left; width:140px; text-align:right;'>Phone:</div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>$pp_obj->phone</div>";
		$message .= "<div style='float:left; width:140px; text-align:right;'>Contact Email:</div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>$pp_obj->contact_email</div>";
		$message .= "<div style='clear:both;'></div>";
		
	}else{
		$message .= "saas profile id:".$_SESSION['profile_account_id']."<br />"; 	
	}


	$message .= "</div><br /><br />";
	$message .= "</body>";
	$message .= "</html>";

	$to  = "services@closetstogo.com";

	$subject_c = "Saas cust new payment processor request ";		

	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: help@closetstogo.com";
	$headers .= "\r\n";
	$headers .= "Return-path: help@closetstogo.com";

	//$headers .= "\r\n";
	//$headers .= "CC: mark.stanz@gmail.com";		
	//$headers .= "\r\n";
	//$headers .= "Bcc: mike@closetstogo.com";


	//$to = "services@closetstogo.com";
	//$to = "mark.stanz@gmail.com";
	error_reporting(0);
	if(!mail($to, $subject_c, $message, $headers)){
	}

	$msg = "Your message has been submitted";

	
	$progress->completeStep("payment" ,$_SESSION['profile_account_id']);
		
	header("Location: ".SITEROOT."/manage/start.php");

}




require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>

</head>

	<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');


?>

<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    

    <div class="manage_main">

	<?php 
	echo "<div class='manage_main_page_title'>".$page_title."</div>";
    
	$bc = $bread_crumb->output();
    echo $bc."<br />"; 
    ?>


	If you would like to use a payment processor that isn't on the list. Make your request here and it will be sent to us.
	
    <form name="send_request_form" action="new-processor-request.php" method="post">

	<textarea name="req" cols="80" rows="6">
    
    </textarea> 
    
    <input type="submit" name="submit" value="Submit" />

	</form>

    
	</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>    
   
</div>



</body>
</html>



