<html lang='en'>
<meta charset='utf-8'>
<body>


<center>

<?php


	$content_auto = (isset($_POST['content_auto'])) ? trim($_POST['content_auto']) : '';
	$content_manual = (isset($_POST['content_manual'])) ? trim($_POST['content_manual']) : '';


	
	
	$message .= "<div style='width: 600px;  text-align:left;'>";

	$message .= "<i>Auto Email Text</i><br/><hr/><br/>";

	$message .= "Hi [customer name] <br /><br />";
	
	$message .= $content_auto;
	
	
	$message .= "<br/><br/><br/><br/><i>Manual Email Text</i><br/><hr/><br/>";
	
	$message .= "Hi [customer name] <br /><br />";
	
	$message .= $content_manual;
	

	$message .= "</div>";


	echo $message;
?>

</center>

