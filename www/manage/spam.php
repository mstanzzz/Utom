<?php

$message = '';
	$message .= '<html>';
	$message .= '<head>';
	$message .= '<title>Spam</title>';
	$message .= '</head>';
	$message .= '<body>';
		
	$message .= "<div style='background:#efefef; width:100%; padding:8px;'>";
	$message .= "<font color='#000000'>Holovit Contact</font>";
	$message .= "</div><br />";
	$message .= '</div><br /><br />';
	$message .= '</body>';
	$message .= '</html>';

	$subject_c = "Spam";			
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: mstanzzz@yahoo.com";
	$headers .= "\r\n";
	$headers .= "Return-path: mstanzzz@hotmail.com";	
	$headers .= "\r\n";
	
	
	
	//$headers .= "CC: mark.stanz@gmail.com";		
			//$headers .= "\r\n";
			//$headers .= "Bcc: mike@closetstogo.com";
			//$to = "services@closetstogo.com";
	$to = "mstanzzz@hotmail.com";
	
	
					
			//$to = "mark.stanz@gmail.com";
			error_reporting(1);
			if(!mail($to, $subject_c, $message, $headers)){
			
			
			
			}
			
			$handle = fopen ( 'log_spam.txt' , 'a+');
			$str = 	$headers."   ".$subject_c."   ".$message;	
			fwrite ( $handle , $str);
			
?>