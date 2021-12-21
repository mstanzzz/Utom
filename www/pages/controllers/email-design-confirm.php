<?php
$is_spam = 0;

$wall_a = $_SESSION['designrequest']['wall_a'] = isset($_POST['wall_a'])? trim($_POST['wall_a']) : 0;
$wall_b = $_SESSION['designrequest']['wall_b'] = isset($_POST['wall_b'])? trim($_POST['wall_b']) : 0;
$wall_c = $_SESSION['designrequest']['wall_c'] = isset($_POST['wall_c'])? trim($_POST['wall_c']) : 0;
$wall_d = $_SESSION['designrequest']['wall_d'] = isset($_POST['wall_d'])? trim($_POST['wall_d']) : 0;
$wall_e = $_SESSION['designrequest']['wall_e'] = isset($_POST['wall_e'])? trim($_POST['wall_e']) : 0;
$wall_f = $_SESSION['designrequest']['wall_f'] = isset($_POST['wall_f'])? trim($_POST['wall_f']) : 0;
$wall_g = $_SESSION['designrequest']['wall_g'] = isset($_POST['wall_g'])? trim($_POST['wall_g']) : 0;


$proposed_finish_date = (isset($_POST['proposed_finish_date']))? trim(addslashes($_POST['proposed_finish_date'])) :''; 
$_SESSION['designrequest']['proposed_finish_date'] = $proposed_finish_date;

$email = $_SESSION['designrequest']['email'] = (isset($_POST['email']))? trim($_POST['email']) : '';
$obstructions = $_SESSION['designrequest']['obstructions'] = (isset($_POST['obstructions']))? trim(addslashes($_POST['obstructions'])) : ''; 
$comments = $_SESSION['designrequest']['comments'] = (isset($_POST['comments']))? trim(addslashes($_POST['comments'])) : '';
$base_mold_height = $_SESSION['designrequest']['base_mold_height'] = (isset($_POST['base_mold_height']))? trim(addslashes($_POST['base_mold_height'])) : ''; 
$ceiling_height = $_SESSION['designrequest']['ceiling_height'] = (isset($_POST['ceiling_height']))? trim(addslashes($_POST['ceiling_height'])) : ''; 


if($email == ''){
	$is_spam = 1;
}
if(substr_count($email, '@') > 2){
	$is_spam = 1;
}
if(substr($email, -3) == '.ru'){
	$is_spam = 1;	
}	
if(substr($email, -3) == '.pl'){
	$is_spam = 1;	
}	
if(substr($email, -3) == '.ua'){
	$is_spam = 1;	
}

$str = str_replace("/","",$proposed_finish_date);

if(!is_numeric($str)){
	$is_spam = 1;				
}

if(isSPAM($obstructions)){
	$is_spam = 1;	
}
if(isSPAM($comments)){
	$is_spam = 1;	
}

function is_odd_or_even($number){ 
	if($number % 2 == 0){ 
		return 0;  
	}else{ 
		return 1;  
	} 
} 

$msg = '';
$success = 0;

if(!isset($_SESSION['temp_id'])){
	$_SESSION['temp_id'] = time();	
}

$ts = time();

$zip = (isset($_POST['zip'])) ? trim($_POST['zip']) : ''; 

if(strlen($zip) < 5){
	$zip = -1;
}elseif(strlen($zip) > 5){
	$zip = 	substr($zip, 0, 5);
}
if(!is_numeric($zip)){
	$zip = -1;	
}

if($zip != -1){
	$acs_obj = getCityStateFromZip($zip);
	sleep(2);
	$ret_city = $acs_obj['city'];
	$ret_state = $acs_obj['state'];
	$ret_country = $acs_obj['country'];
	$multi_cities = $acs_obj['multi_cities'];
	$formatted_address = $acs_obj['formatted_address'];
}else{
	$ret_city = '';
	$ret_state = '';
	$ret_country = '';
	$multi_cities = '';
	$formatted_address = '';
}


$origin = (isset($_POST['origin'])) ? $_POST['origin'] : 'unknown'; 

if($is_spam) $msg = "<div style='color:red; font-size:1.2em;'>Spam Detected. The request was blocked</div>";

if(isset($_POST['from_design_form_page']) && $is_spam == 0){
		
	$deid = $_POST['deid'];
		
	$email = $_SESSION['designrequest']['email'] = (isset($_POST['email']))? trim($_POST['email']) : '';
	$first_name = $_SESSION['designrequest']['first_name'] = (isset($_POST['first_name']))? trim(addslashes($_POST['first_name'])) : '';
	$last_name = $_SESSION['designrequest']['last_name'] = (isset($_POST['last_name']))? trim(addslashes($_POST['last_name'])) : '';
	$name = $first_name.' '.$last_name; 
		
	$user_id = 0;
	if($lgn->getCustId() > 0){		
		$user_id = $lgn->getCustId();		
	}else{
		$user_id = $lgn->getUserIDFromEmail($dbCustom,$email);
	}


	if($user_id == 0){
		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$password = rand(1, 12);
		$password .= "jetc473nlkjx";		
		
		$user_id = $lgn->create_user($dbCustom, $password, $email, $name);	
		
		$stmt = $db->prepare("SELECT password_salt 
							FROM user
							WHERE username = ?");
		//echo 'Error1 '.$db->error;
		if(!$stmt->bind_param("s", $email)){
			echo 'Error2 '.$db->error;
		}else{
			$stmt->execute();						
			$stmt->bind_result($password_salt);	
			$stmt->fetch();
				
		}
		$stmt->close();

		if($password_salt != ''){
		
			$link = "https://www.".SITEROOT."/reset-password.html?ps=".$password_salt;
			
			$message= '';
			$message.= "Thank you for shopping at Closets To Go";
			$message.= "\n\n\r You have been automatically registered with ".$_SESSION['profile_company'].".  Please re-set your password, click this link or paste it into your web browser:";
			$message.= "\n\n\r";
			$message.= $link;
			$message.= "\n\n\r";
			$subject = $_SESSION['profile_company']." Password Request";		
		
			$headers = "From: services@closetstogo.com";
			//$headers .= "\r\n";
			//$headers .= "Content-type: text/html"; 
			$headers .= "\r\n";
			$headers .= "CC: mark.stanz@gmail.com";
		
			$to      = $email_addr;		
			//$to = "mark.stanz@gmail.com";
			error_reporting(0);
			
			
			if(mail($to, $subject, $message, $headers)){
				$ret = "y";
			}else{
					
					
			}
		}
	}
	
	
	
	
	require_once($real_root.'/includes/class.order_fulfillment.php');
	$order_fulfillment = new OrderFulfillment();

	$job_id = $order_fulfillment->getJobNumber($user_id);

	$zip = $_SESSION['designrequest']['zip'] = (isset($_POST['zip']))? trim($_POST['zip']) : '';
	$phone = $_SESSION['designrequest']['phone'] = (isset($_POST['phone']))? trim($_POST['phone']) : '';
	$proposed_finish_date = $_SESSION['designrequest']['proposed_finish_date'] =  trim(addslashes($_POST['proposed_finish_date'])); 		
	$budget_range = $_SESSION['designrequest']['budget_range'] =  (isset($_POST['budget_range']))? $_POST['budget_range'] : '';		
	$closet_type = $_SESSION['designrequest']['closet_type'] =  (isset($_POST['closet_type']))? trim(addslashes($_POST['closet_type'])) : '';
	$child_age = $_SESSION['designrequest']['child_age'] = trim(addslashes($_POST['child_age'])); 
	$short_hang = $_SESSION['designrequest']['short_hang'] = (isset($_POST['short_hang']))? trim(addslashes($_POST['short_hang'])) : ''; 
	$medium_hang = $_SESSION['designrequest']['medium_hang'] = (isset($_POST['medium_hang']))? trim(addslashes($_POST['medium_hang'])) : ''; 
	$long_hang = $_SESSION['designrequest']['long_hang'] = (isset($_POST['long_hang']))? trim(addslashes($_POST['long_hang'])) : '';
	$drawers = $_SESSION['designrequest']['drawers'] = trim(addslashes($_POST['drawers'])); 
	$shoes = $_SESSION['designrequest']['shoes'] = trim(addslashes($_POST['shoes'])); 
	$finish = $_SESSION['designrequest']['finish'] = (isset($_POST['finish']))? trim(addslashes($_POST['finish'])) : ''; 
		
	$no_base_mold = $_SESSION['designrequest']['no_base_mold'] = isset($_POST['no_base_mold'])? trim($_POST['no_base_mold']) : 0;
		
	if($no_base_mold > 0){
		$base_mold_height = $_SESSION['designrequest']['base_mold_height'] = '';
	}
		
	$storage_type = $_SESSION['designrequest']['storage_type'] = (isset($_POST['storage_type']))? trim(addslashes($_POST['storage_type'])) : ''; 
	$door_type = $_SESSION['designrequest']['door_type'] = (isset($_POST['door_type']))? trim(addslashes($_POST['door_type'])) : ''; 
	$door_size = $_SESSION['designrequest']['door_size'] = isset($_POST['door_size'])? trim(addslashes($_POST['door_size'])) : '';
	$has_shelves = $_SESSION['designrequest']['has_shelves'] = isset($_POST['has_shelves'])? 1 : 0;
	$has_laundry_hamper = $_SESSION['designrequest']['has_laundry_hamper'] = isset($_POST['has_laundry_hamper']) ? 1 : 0;	
	$has_mirror = $_SESSION['designrequest']['has_mirror'] = isset($_POST['has_mirror']) ? 1 : 0;	
	$has_ironing_board = $_SESSION['designrequest']['has_ironing_board'] = isset($_POST['has_ironing_board']) ? 1 : 0;
	$has_short_hang = $_SESSION['designrequest']['has_short_hang'] = isset($_POST['has_short_hang'])? 1 : 0;
	$has_medium_hang = $_SESSION['designrequest']['has_medium_hang'] = isset($_POST['has_medium_hang'])? 1 : 0;
	$has_long_hang = $_SESSION['designrequest']['has_long_hang'] = isset($_POST['has_long_hang'])? 1 : 0;
	$has_tie_rack = $_SESSION['designrequest']['has_tie_rack'] = isset($_POST['has_tie_rack'])? 1 : 0;
	$has_belt_rack = $_SESSION['designrequest']['has_belt_rack'] = isset($_POST['has_belt_rack'])? 1 : 0;
	$has_valet_rod = $_SESSION['designrequest']['has_valet_rod'] = isset($_POST['has_valet_rod'])? 1 : 0;
	$has_basket_tall = $_SESSION['designrequest']['has_basket_tall'] = isset($_POST['has_basket_tall']) ? 1 : 0;	
	$has_basket_medium = $_SESSION['designrequest']['has_basket_medium'] = isset($_POST['has_basket_medium']) ? 1 : 0;	
	$has_basket_short = $_SESSION['designrequest']['has_basket_short'] = isset($_POST['has_basket_short']) ? 1 : 0;
	$has_jewelry_tray = $_SESSION['designrequest']['has_jewelry_tray'] = isset($_POST['has_jewelry_tray']) ? 1 : 0;
		
	$item_id  = $_SESSION['designrequest']['item_id'] = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	
	$the_id = 0;

	//echo "user_id ".$user_id;
	//echo "<br />";
	//echo "job_id ".$job_id;
	//exit;

		
	if($deid > 0){

		$the_id = $deid;
			
		$stmt = $db->prepare("UPDATE design_email
								SET email = ?
								,name = ? 
								,phone = ?
								,zip = ? 
								,proposed_finish_date = ?
								,budget_range = ? 
								,ceiling_height = ?
								,base_mold_height = ?
								,door_size = ?
								,drawers = ? 
								,shoes = ? 
								,closet_type = ?
								,wall_a = ?
								,wall_b = ?
								,wall_c = ?
								,wall_d = ?
								,wall_e = ?
								,wall_f = ?
								,wall_g = ?	
								,finish = ? 
								,obstructions = ?
								,comments = ?
								,storage_type = ?
								,door_type = ?
								,short_hang = ?
								,medium_hang = ?
								,long_hang = ?
								,has_shelves = ?
								,has_laundry_hamper = ?	
								,has_mirror = ?	
								,has_ironing_board = ?
								,has_short_hang = ?
								,has_medium_hang = ? 
								,has_long_hang = ? 
								,has_tie_rack = ? 
								,has_belt_rack = ? 
								,has_valet_rod = ?
								,has_basket_tall = ?	
								,has_basket_medium = ?	
								,has_basket_short = ?
								,has_jewelry_tray = ?
								,item_id = ?
								,origin = ?
								,child_age = ?
								,user_id = ?
								,job_id = ?
						WHERE design_email_id = ?");
								
								//echo 'Error-1 UPDATE   '.$db->error;
								
					if(!$stmt->bind_param("sssssssssssssssssssssssssssiiiiiiiiiiiiiiissiii",
						$email
						,$name 
						,$phone
						,$zip 
						,$proposed_finish_date
						,$budget_range 
						,$ceiling_height
						,$base_mold_height
						,$door_size
						,$drawers 
						,$shoes 
						,$closet_type
						,$wall_a
						,$wall_b
						,$wall_c
						,$wall_d
						,$wall_e
						,$wall_f
						,$wall_g	
						,$finish 
						,$obstructions
						,$comments
						,$storage_type
						,$door_type						
						,$short_hang
						,$medium_hang
						,$long_hang
							,$has_shelves
							,$has_laundry_hamper	
							,$has_mirror	
							,$has_ironing_board							
							,$has_short_hang
							,$has_medium_hang 
							,$has_long_hang 
							,$has_tie_rack 
							,$has_belt_rack 
							,$has_valet_rod
							,$has_basket_tall	
							,$has_basket_medium	
							,$has_basket_short
							,$has_jewelry_tray
							,$item_id
							,$origin
							,$child_age
							,$user_id
							,$job_id
						,$deid)){								
								
			}else{
				$stmt->execute();
				$stmt->close();
				
				$msg = "Your design request has been submitted";
			}
			
		}else{
			
		
			$stmt = $db->prepare("INSERT INTO design_email
					   (email
						,name 
						,phone
						,zip 
						,proposed_finish_date
						,budget_range 
						,ceiling_height
						,base_mold_height
						,door_size
						,drawers 
						,shoes
						,closet_type 
						,wall_a
						,wall_b
						,wall_c
						,wall_d
						,wall_e
						,wall_f
						,wall_g	
						,finish 
						,obstructions
						,comments
						,storage_type
                  		,door_type
						,short_hang
						,medium_hang
						,long_hang
							,has_shelves
							,has_laundry_hamper	
							,has_mirror	
							,has_ironing_board						
							,has_short_hang
							,has_medium_hang 
							,has_long_hang 
							,has_tie_rack 
							,has_belt_rack 
							,has_valet_rod
							,has_basket_tall	
							,has_basket_medium	
							,has_basket_short
							,has_jewelry_tray						
						,date_submitted
						,item_id
						,origin
						,child_age
						,user_id
						,job_id
						,profile_account_id)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 
		
		//echo 'Error INSERT   '.$db->error;
	
		
			if(!$stmt->bind_param("sssssssssssssssssssssssssssiiiiiiiiiiiiiiiissiii",
						$email
						,$name 
						,$phone
						,$zip 
						,$proposed_finish_date
						,$budget_range 
						,$ceiling_height
						,$base_mold_height
						,$door_size
						,$drawers 
						,$shoes 
						,$closet_type
						,$wall_a
						,$wall_b
						,$wall_c
						,$wall_d
						,$wall_e
						,$wall_f
						,$wall_g	
						,$finish 
						,$obstructions
						,$comments
						,$storage_type
                  		,$door_type
						,$short_hang
						,$medium_hang
						,$long_hang
							,$has_shelves
							,$has_laundry_hamper	
							,$has_mirror	
							,$has_ironing_board
							,$has_short_hang
							,$has_medium_hang 
							,$has_long_hang 
							,$has_tie_rack 
							,$has_belt_rack 
							,$has_valet_rod
							,$has_basket_tall	
							,$has_basket_medium	
							,$has_basket_short
							,$has_jewelry_tray		
						,$ts
						,$item_id
						,$origin
						,$child_age
						,$user_id
						,$job_id
						,$_SESSION['profile_account_id'])){
		
			//echo 'Error-2 '.$db->error;
		
		}else{
			$stmt->execute();
			$stmt->close();
			$the_id = $db->insert_id;
			$msg = "Your design request has been submitted";
		}
	}
	
	if($msg != ''){	
		
		$sql = "SELECT DISTINCT file_name 
			FROM temp_upload 
			WHERE temp_id = '".$_SESSION['temp_id']."'
			AND profile_account_id = '".$_SESSION["profile_account_id"]."'";
			$img_result = $dbCustom->getResult($db,$sql);
		
		if(!file_exists($real_root."/user_uploads/".$_SESSION['profile_account_id']."/")){
			mkdir($real_root."/user_uploads/".$_SESSION['profile_account_id']."/" , $mode = 0777 );
		}
      
		
		while($row = $img_result->fetch_object()){
			
			$from_file = $real_root."/temp_uploads/".$_SESSION['temp_id']."/".$row->file_name;
	
			//if(is_file($from_file)) {
			if(file_exists($from_file)){
         
				$file_name = str_replace (" ", "_", $row->file_name);
				
				$file_name = $_SESSION['temp_id']."_".$file_name;
				
				if(copy($from_file , $real_root."/user_uploads/".$_SESSION['profile_account_id']."/".$file_name)){
						
					$sql = "INSERT INTO design_email_image 
						(file_name, design_email_id, temp_id) 
						VALUES 
						('".$file_name."', '".$the_id."', '".$_SESSION['temp_id']."')";				
						$r = $dbCustom->getResult($db,$sql);
						
				}
				
			}
		}
	
		if (file_exists($real_root."/temp_uploads/".$_SESSION['temp_id'])) {
			deleteDir($real_root."/temp_uploads/".$_SESSION['temp_id']);
		}	
	
		$sql = "DELETE FROM temp_upload WHERE temp_id = '".$_SESSION['temp_id']."'";
		$res = $dbCustom->getResult($db,$sql);
		
		$message = '';
		
		$message .= "<html>";
		$message .= "<head>";
		$message .= "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
		
		$message .= "<title>Design Request </title>";
		$message .= "</head>";
		$message .= "<body>";
		$message .= "<div style='font-size:17px;'>";
			
			$message .= "<div style='background:#efefef; width:100%; padding:8px;'>";
			$message .= "<font color='#000000'>Design Request</font>";
			$message .= "</div><br />";
			
		$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Origin:</font></div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$origin."</font></div>";	
		$message .= "<div style='clear:both;'></div>";
		
		$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Site:</font></div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".SITEROOT."/</font></div>";	
		$message .= "<div style='clear:both;'></div>";
		
		$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Customer Email:</font></div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'><a href='mailto:".$email."'>".$email."</a></font></div>";
		$message .= "<div style='clear:both;'></div>";
		$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Customer Name:</font></div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($name)."</font></div>";
		$message .= "<div style='clear:both;'></div>";
	
		
		if($phone != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Phone:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($phone)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}	


		if($multi_cities != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Multiple Cities:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($multi_cities)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}else{	
			if($ret_city != ''){
				$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>City:</font></div>";
				$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($ret_city)."</font></div>";
				$message .= "<div style='clear:both;'></div>";
			}	
		}
		if($ret_state != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>State:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($ret_state)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}	
		if($ret_country != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Country:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($ret_country)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($formatted_address != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Formatted Address:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($formatted_address)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}

		if($zip != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Zip Code:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$zip."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}			
		if($proposed_finish_date != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Proposed finish date:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$proposed_finish_date."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($storage_type != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Storage Type:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$storage_type."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}

		if($child_age != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Child_age:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$child_age."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($budget_range != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Budget range:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$budget_range."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($closet_type != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Closet Type:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$closet_type."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
	
		if($wall_a != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>wall a:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($wall_a)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($wall_b != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>wall b:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($wall_b)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($wall_c != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>wall c:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($wall_c)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($wall_d != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>wall d:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($wall_d)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($wall_e != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>wall e:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($wall_e)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($wall_f != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>wall f:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($wall_f)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($wall_g != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>wall g:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($wall_g)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($ceiling_height != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>ceiling height:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($ceiling_height)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($base_mold_height != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>base mold height:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($base_mold_height)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($door_size != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>door size:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($door_size)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($door_type != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>door type:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$door_type."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($short_hang != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Short hang:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($short_hang)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($medium_hang != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Medium hang:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($medium_hang)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($long_hang != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Long hang:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($long_hang)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}

		if($has_short_hang > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Short Hang:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($has_medium_hang > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Medium Hang:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($has_long_hang > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Long Hang:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($has_basket_tall > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Tall Basket:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($has_basket_medium > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Medium Basket:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($has_basket_short > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Short Basket:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}

		
		if($drawers != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Drawers:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($drawers)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($shoes != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Shoes:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($shoes)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($has_tie_rack > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Tie rack:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($has_belt_rack > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Belt rack:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
	
		if($has_valet_rod > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Velet rod:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($has_jewelry_tray > 0){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has Jewelry Tray:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
	
		//$has_shelves = ($has_shelves) ? "yes" : "no";	
		if($has_shelves){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has shelves:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		//$has_laundry_hamper = ($has_laundry_hamper) ? "yes" : "no";	
		if($has_laundry_hamper){
		$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has laundry hamper:</font></div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
		$message .= "<div style='clear:both;'></div>";
		}
		
		//$has_mirror = ($has_mirror) ? "yes" : "no";	
		if($has_mirror){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has mirror:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		//$has_ironing_board = ($has_ironing_board) ? "yes" : "no";	
		if($has_ironing_board){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Has ironing board:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>Yes</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		if($finish != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Finish:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$finish."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
	
		if($obstructions != ''){
			$obstructions =  str_replace('\r\n', '<br />', $obstructions );
			
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Obstructions:</font></div>";
			//$message .= "<div style='float:left; padding-left:12px; text-align:left;'>--".stripAllSlashes(preg_replace( '/\r\n/', '<br />', $obstructions))."</div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($obstructions)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}

		if($comments != ''){
			$obstructions =  str_replace('\r\n', '<br />', $comments );
			
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Additional Info:</font></div>";
			//$message .= "<div style='float:left; padding-left:12px; text-align:left;'>--".stripAllSlashes(preg_replace( '/\r\n/', '<br />', $obstructions))."</div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($comments)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
	
		if($item_id > 0){
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT name
							FROM item 
							WHERE item_id  = '".$item_id."'";	
			$result = $dbCustom->getResult($db,$sql);
			if($result->num_rows > 0){				
				$object = $result->fetch_object();				
				$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Cart Item ID:</font></div>";
				$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$item_id."</font></div>";
				$message .= "<div style='clear:both;'></div>";		
				$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Cart Item:</font></div>";
				$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$object->name."</font></div>";
				$message .= "<div style='clear:both;'></div>";
			}
		}
	
	
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	
		
		$sql = "SELECT DISTINCT file_name
				FROM design_email_image 
				WHERE design_email_id  = '".$the_id."' 
				AND temp_id = '".$_SESSION['temp_id']."'";	
		$img_result = $dbCustom->getResult($db,$sql);
			
			
		while($row = $img_result->fetch_object()){			
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Uploaded File:</font></div>";	
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'>".SITEROOT."user_uploads/".$_SESSION['profile_account_id']."/".$row->file_name."</div>";
			$message .= "<div style='clear:both;'></div>";
		}
	
		$message .= "</div><br /><br />";
		$message .= "</body>";
		$message .= "</html>";
		
		$subject_c = "Design Request From main site";		
				
		$headers = "Content-type: text/html; charset=iso-8859-1";	
		$headers .= "\r\n";
		$headers .= "From: help@closetstogo.com";
		$headers .= "\r\n";
		$headers .= "Return-path: help@closetstogo.com";
		$headers .= "\r\n";
		//$headers .= "CC: pam@closetstogo.com";
		//$headers .= "CC: services@closetstogo.com";		
		$headers .= "\r\n";
		//$headers .= "Bcc: jeremiah@closetstogo.com";
		$headers .= "Bcc: mark@nazardesigns.com";
		
	
	
		/*
		if(is_odd_or_even($the_id)){
			$designer_email_addr = "pam@closetstogo.com";
			$designer_name = "Pam"; 	
		}else{
			$designer_email_addr = " misty@closetstogo.com";		
			$designer_name = "Misty";
		}
		$to = $designer_email_addr;
		*/
		$to = 'services@closetstogo.com';
		error_reporting(0);
		/* ******* Uncomment when live ******* */
		/*
		if(mail($to, $subject_c, $message, $headers)){
			$success = 1;	
		*/
		
		// TO CUSTOMER
		$message = '';	
		$message .= "<html>";
		$message .= "<head>";
		$message .= "<title>Design Request</title>";
		$message .= "</head>";
		$message .= "<body>";
		$message .= "<div style='color:#565656;'>";
		$message .= "<div style='background:#efefef; width:100%; padding:8px;'>";
		$message .= "Design Request";
		$message .= "</div><br />";
		$message .= "<div style='clear:both;'></div>";
		$message .= "CONGRATULATIONS, your design request has been received and is being reviewed by our design team! "; 
		$message .= "We are excited to see how we can collaborate to provide you with the best possible custom storage solution for your space. "; 
		$message .= "<br />";
		$message .= "Here’s how our process works:";
		$message .= "<br /><br />";
		$message .= " 1: As our online design request form only collects general information, a member of our design team will reach out to you personally to gather more pertinent information. "; 
		$message .= "We will contact you via telephone or email so please check your spam mail as emails may get lost in the mix. ";
		$message .= "At this time, we will discuss any personal needs, obstacles and / or special requests to consider in your design. "; 
		$message .= "We will also give you an estimated timeframe in which you will receive your preliminary design for review. ";
		$message .= "<br />";
		$message .= "<div style='color:#900C3F; background:#efefef; width:100%; padding:8px;'>";
		$message .= "Note, we can not move forward with creating your custom design until we have gathered this personalized information in step 1. ";
		$message .= "</div>";
		$message .= "<br />";
		$message .= " 2: Within the predetermined time frame, you'll receive your preliminary custom design to review. ";
		$message .= "If there are any adjustments you would like us to make, please submit them within 24 hours so that we may expedite our turnaround time in getting your design perfected and back to you in a timely manner. ";
		$message .= "We will make all feasible adjustments needed until we reach the most optimal design for your space. ";
		$message .= "Before we can move on to step 3,  we will also ask you to re-confirm your measurements.  Though this may seem redundant, it is a crucial step to ensure your custom closet system fits flawlessly. "; 
		$message .= "<br />";
		$message .= "3: After your approval, you will receive a purchase order agreement via email. Once we have received this signed purchase order agreement and payment, we begin manufacturing your custom dream closet! On average, you should receive your closet in  just 2-3 weeks time.  However, there are rare occasions where this could take longer due to transit issues or other circumstances beyond our control. ";
		$message .= "***As all products manufactured by Closets To Go are custom made, we are not able to accept cancelations, returns nor give refunds on any CUSTOM orders after the order has been placed. Thus, all sales are final. "; 
		$message .= "We take great pride in delivering superior customer service with our simple 3 step process and are eager to answer any questions you may have along the way. Thank you for choosing Closets To Go and we look forward to working with you! ";
		$message .= "<br /><br />Sincerely,";
		$message .= "<br />Closets To Go";	
		$message .= "<br /></div>";
		$message .= "</body>";
		$message .= "</html>";

		$subject_c = "Closets To Go Design Request";		
	
		$headers = "Content-type: text/html; charset=iso-8859-1";	
		$headers .= "\r\n";
		$headers .= "From: services@closetstogo.com";
		$headers .= "\r\n";
		$headers .= "Return-path: services@closetstogo.com";
		
		$to = $email;
	
		if(!mail($to, $subject_c, $message, $headers)){
		
		}
	
	}else{
		//echo "eeeeeeeeeeeeeeeeeeeeeeeeeeeee";
	}
		
		
	$msg = "Your request has been submitted to Closets To Go";

}

?>



