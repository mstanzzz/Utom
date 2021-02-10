

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body data-page="persoanl-dash-mainpage">
<?php


$dir    = './';
$files = scandir($dir);
foreach($files as $key => $val){

	if(strlen($val) > 8){
		
		//echo "<br />---".$val;
		$old_name = $val;
		$new_name = $val;
		//$new_name = str_replace("Installer Personal Dashboard APP_","",$new_name);
		//$new_name = str_replace("Installer Job Dashboard APP_","job-",$new_name);

		$new_name = str_replace(" ","-",$new_name);
		$new_name = str_replace("_","-",$new_name);
		$new_name = preg_replace('/\s+/', '', $new_name);
		$new_name = str_replace(".html",".php",$new_name);
		$new_name = strtolower($new_name);

		if(file_exists($new_name))
        { 
           //echo "Error While Renaming $old_name" ;
        }else{
			
			//if(rename($old_name, $new_name)){ 
				//echo "Successfully Renamed $old_name to $new_name" ;
			
				//echo $new_name;
				//echo "<br />";
			//}else{
				//echo "A File With The Same Name Already Exists" ;
 			//}
		}
	}
}

?>


<br /><br />













<a href="order-fulfillment-dashboard-main-page.php">
order-fulfillment-dashboard-main-page.php</a><br />
<br />

<a href="order-fulfillment-dashboard-inbound-orders.php">
order-fulfillment-dashboard-inbound-orders.php</a><br />
<br />

<a href="order-fulfillment-dashboard-step-2-order-jobs.php">
order-fulfillment-dashboard-step-2-order-jobs.php</a><br />
<br />

<a href="order-fulfillment-dashboard-step-3-room-details.php">
order-fulfillment-dashboard-step-3-room-details.php</a><br />
<br />

<a href="order-fulfillment-dashboard-step-4-order-fulfillment-status.php">
order-fulfillment-dashboard-step-4-order-fulfillment-status.php</a><br />
<br />

<a href="order-fulfillment-dashboard-step-4-order-fulfillment-status-full-step-history-minimized.php">
order-fulfillment-dashboard-step-4-order-fulfillment-status-full-step-history-minimized.php</a><br />
<br />

<a href="order-fulfillment-dashboard-step-4-order-fulfillment-status-step-history-minimized.php">
order-fulfillment-dashboard-step-4-order-fulfillment-status-step-history-minimized.php</a><br />
<br />

<a href="order-fulfillment-dashboard-step-4-order-fulfillment-status-step-history-minimized-pause-reason.php">
order-fulfillment-dashboard-step-4-order-fulfillment-status-step-history-minimized-pause-reason.php</a><br />
<br />

<a href="order-fulfillment-dashboard-step-4-order-fulfillment-status-step-history-minimized-pause-reason-submitted.php">
order-fulfillment-dashboard-step-4-order-fulfillment-status-step-history-minimized-pause-reason-submitted.php</a><br />
<br />


<a href="order-fulfillment-dashboard-team-member-status.php">
order-fulfillment-dashboard-team-member-status.php</a><br />
<br />





<br />


<br /><br />

<br /><br />


</body>
</html>
