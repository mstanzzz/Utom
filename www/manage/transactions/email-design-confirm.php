<?php

$msg = '';
$success = 0;


if(!isset($_SESSION['temp_id'])){
	$_SESSION['temp_id'] = time();	
}

$ts = time();

if(isset($_POST['from_design_form_page'])){
	
	$deid = $_POST['deid'];
	
	
	
	//echo "<br />deid".$deid."<br />";

	
	
		$email = trim($_POST['email']); 
		$first_name = trim(addslashes($_POST['first_name'])); 
		$last_name = trim(addslashes($_POST['last_name'])); 
		$name = $first_name.' '.$last_name; 
		//$city = trim(addslashes($_POST['city'])); 
		//$state = trim(addslashes($_POST['state'])); 
		$zip = trim($_POST['zip']); 
		$phone = trim($_POST['phone']); 
		$proposed_finish_date = trim(addslashes($_POST['proposed_finish_date'])); 
		//$job_type = (isset($_POST['job_type']))? trim(addslashes($_POST['job_type'])) : '';
		//$contact_via = (isset($_POST['contact_via']))? trim(addslashes($_POST['contact_via'])) : '';
		//$best_contact_time = trim(addslashes($_POST['best_contact_time'])); 
		$budget_range = (isset($_POST['budget_range']))? $_POST['budget_range'] : '';
		//$storage_type = (isset($_POST['storage_type']))? $_POST['storage_type'] : ''; 
		//$closet_type = (isset($_POST['closet_type']))? trim(addslashes($_POST['closet_type'])) : '';
		//$child_age = trim(addslashes($_POST['child_age'])); 
		//$other_storage_type = (isset($_POST['other_storage_type']))? trim(addslashes($_POST['other_storage_type'])) : '';
		//$door_type = (isset($_POST['door_type']))? trim(addslashes($_POST['door_type'])) : '';
		//$short_hang = trim(addslashes($_POST['short_hang'])); 
		//$medium_hang = trim(addslashes($_POST['medium_hang'])); 
		//$long_hang = trim(addslashes($_POST['long_hang'])); 
		$drawers = trim(addslashes($_POST['drawers'])); 
		$shoes = trim(addslashes($_POST['shoes'])); 
			
		//$tie_rack = trim(addslashes($_POST['tie_rack'])); 
		//$belt_rack = trim(addslashes($_POST['belt_rack'])); 
		//$valet_rod = trim(addslashes($_POST['valet_rod'])); 
		//$has_basket_tall = isset($_POST['has_basket_tall']) ? 1 : 0;	
		//$has_basket_medium = isset($_POST['has_basket_medium']) ? 1 : 0;	
		//$has_basket_short = isset($_POST['has_basket_short']) ? 1 : 0;
		$finish = (isset($_POST['finish']))? trim(addslashes($_POST['finish'])) : ''; 
		$obstructions = trim(addslashes($_POST['obstructions']));
		$comments = trim(addslashes($_POST['comments']));
		


		
		$wall_a = trim(addslashes($_POST['wall_a']));
		$wall_b = trim(addslashes($_POST['wall_b']));
		$wall_c = trim(addslashes($_POST['wall_c']));
		$wall_d = trim(addslashes($_POST['wall_d']));
		$wall_e = trim(addslashes($_POST['wall_e']));
		
		$storage_type = trim(addslashes($_POST['storage_type']));
		$door_type = trim(addslashes($_POST['door_type']));
		
		$ceiling_height = trim(addslashes($_POST['ceiling_height']));
		$base_mold_height = trim(addslashes($_POST['base_mold_height']));
		
		$door_size = trim(addslashes($_POST['door_size']));
		//$obscure_description = trim(addslashes($_POST['obscure_description']));
		
		$has_shelves = isset($_POST['has_shelves'])? 1 : 0;
		$has_laundry_hamper = isset($_POST['has_laundry_hamper']) ? 1 : 0;	
		$has_mirror = isset($_POST['has_mirror']) ? 1 : 0;	
		$has_ironing_board = isset($_POST['has_ironing_board']) ? 1 : 0;
		

		$has_short_hang = isset($_POST['has_short_hang'])? 1 : 0;
		$has_medium_hang = isset($_POST['has_medium_hang'])? 1 : 0;
		$has_long_hang = isset($_POST['has_long_hang'])? 1 : 0;
		$has_tie_rack = isset($_POST['has_tie_rack'])? 1 : 0;
		$has_belt_rack = isset($_POST['has_belt_rack'])? 1 : 0;
		$has_valet_rod = isset($_POST['has_valet_rod'])? 1 : 0;

		$has_basket_tall = isset($_POST['has_basket_tall']) ? 1 : 0;	
		$has_basket_medium = isset($_POST['has_basket_medium']) ? 1 : 0;	
		$has_basket_short = isset($_POST['has_basket_short']) ? 1 : 0;
		
		
		$item_id  = isset($_POST['item_id']) ? $_POST['item_id'] : 0;

/*

	echo "email: ".$email."<br />";
	echo "first_name: ".$first_name."<br />";
	echo "last_name: ".$last_name."<br />";
	echo "zip: ".$zip."<br />";
	echo "phone: ".$phone."<br />";
	echo "proposed_finish_date: ".$proposed_finish_date."<br />";
	echo "budget_range: ".$budget_range."<br />";
	echo "drawers: ".$drawers."<br />";
	echo "shoes: ".$shoes."<br />";
	echo "finish: ".$finish."<br />";
	echo "obstructions: ".$obstructions."<br />";
	echo "comments: ".$comments."<br />";
	echo "wall_a: ".$wall_a."<br />";
	echo "wall_b: ".$wall_b."<br />";
	echo "wall_c: ".$wall_c."<br />";
	echo "wall_d: ".$wall_d."<br />";
	echo "wall_e: ".$wall_e."<br />";
	echo "storage_type: ".$storage_type."<br />";
	echo "door_type: ".$door_type."<br />";
	echo "ceiling_height: ".$ceiling_height."<br />";
	echo "base_mold_height: ".$base_mold_height."<br />";
	echo "door_size: ".$door_size."<br />";		
	echo "has_shelves: ".$has_shelves."<br />";		
	echo "has_laundry_hamper: ".$has_laundry_hamper."<br />";		
	echo "has_mirror: ".$has_mirror."<br />";		
	echo "has_ironing_board: ".$has_ironing_board."<br />";		
	echo "has_short_hang: ".$has_short_hang."<br />";		
	echo "has_short_hang: ".$has_short_hang."<br />";		
	echo "has_medium_hang: ".$has_medium_hang."<br />";		
	echo "has_long_hang: ".$has_long_hang."<br />";		
	echo "has_tie_rack: ".$has_tie_rack."<br />";		
	echo "has_belt_rack: ".$has_belt_rack."<br />";		
	echo "has_valet_rod: ".$has_valet_rod."<br />";		
	echo "has_basket_tall: ".$has_basket_tall."<br />";		
	echo "has_basket_medium: ".$has_basket_medium."<br />";		
	echo "has_basket_short: ".$has_basket_short."<br />";		
	echo "item_id: ".$item_id."<br />";		

echo "<br />";
echo "<br />";


*/
		
		//echo "has_shelves".$has_shelves;
		//echo "<br />";
		//exit;
		
		//$source = trim(addslashes($_POST['source']));
	
		//$master_type = isset($_POST['master_type']) ? $_POST['master_type'] : '';
		//$mobile_hanging_needs = isset($_POST['mobile_hanging_needs']) ? $_POST['mobile_hanging_needs'] : '';
		//$comments = isset($_POST['comments']) ? trim(addslashes($_POST['comments'])) : '';

		//$customer_id = $lgn->getUserIdByEmail($email);

		
		$db = $dbCustom->getDbConnect(SITE_DATABASE);
		
		//echo $deid;
		
		$the_id = 0;
		
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
								,wall_a = ?
								,wall_b = ?
								,wall_c = ?
								,wall_d = ?
								,wall_e = ?	
								,finish = ? 
								,obstructions = ?
								,comments = ?
								,storage_type = ?
								,door_type = ?
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
								,item_id = ?
						WHERE design_email_id = ?");
								
								//echo 'Error-1 UPDATE   '.$db->error;
								
					if(!$stmt->bind_param("sssssssssssssssssssssiiiiiiiiiiiiiii",
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
						,$wall_a
						,$wall_b
						,$wall_c
						,$wall_d
						,$wall_e	
						,$finish 
						,$obstructions
						,$comments
						,$storage_type
						,$door_type
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
							,$item_id
						,$deid)){								
								
			}else{
				$stmt->execute();
				$stmt->close();
				
				$msg = "Your design request has been submitted";
			}
			
		}else{
			
			//echo "INSERT";
			//echo "<br />";
		
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
						,wall_a
						,wall_b
						,wall_c
						,wall_d
						,wall_e	
						,finish 
						,obstructions
						,comments
						,storage_type
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
						,date_submitted
						,item_id
						,profile_account_id)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 
		
		//echo "<br />";
		//echo 'Error INSERT   '.$db->error;
		//echo "<br />";
		
			if(!$stmt->bind_param("ssssssssssssssssssssiiiiiiiiiiiiiiii",
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
						,$wall_a
						,$wall_b
						,$wall_c
						,$wall_d
						,$wall_e	
						,$finish 
						,$obstructions
						,$comments
						,$storage_type
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
						,$ts
						,$item_id
						,$_SESSION['profile_account_id'])){
		
			//echo "<br />";
			//echo 'Error-2 '.$db->error;
			//echo "<br />";
		
		}else{
			$stmt->execute();
			$stmt->close();
			
			$the_id = $db->insert_id;
			
			//echo "<br />";
			//echo "insert_id".$the_id;
			//echo "<br />";
			
			$msg = "Your design request has been submitted";
		}
		
		
		//echo $db->insert_id;
		//echo "<br />";
		
		
	}
	
	if($msg != ''){	
		
		$sql = "SELECT DISTINCT file_name 
			FROM temp_upload 
			WHERE temp_id = '".$_SESSION['temp_id']."'
			AND profile_account_id = '".$_SESSION["profile_account_id"]."'";
			$img_result = $dbCustom->getResult($db,$sql);
		
		//echo $img_result->num_rows;
		//echo "<br />";
		
		if(!file_exists($real_root."/user_uploads/".$_SESSION['profile_account_id'])){
			
			mkdir ($real_root."/user_uploads/".$_SESSION['profile_account_id'] , $mode = 0777 );
		}
		
		
		
		while($row = $img_result->fetch_object()){
			
			$from_file = $real_root."/temp_uploads/".$_SESSION['temp_id']."/".$row->file_name;
	
			if (is_file($from_file)) {
				$file_name = str_replace (" ", "_", $row->file_name);
				
				$file_name = $_SESSION['temp_id']."_".$file_name;
				
				//echo $file_name;
				//echo "<br />";
            
            /*
            $user_dir = $real_root."/user_uploads/".$_SESSION['profile_account_id']
            
            if(!file_exists($user_dir)) {
                mkdir($user_dir, 0777, true);
            }
            */
				
					if(copy($from_file , $real_root."/user_uploads/".$_SESSION['profile_account_id']."/".$file_name)){
						
						//echo "copied";
						
						$sql = "INSERT INTO design_email_image 
						(file_name, design_email_id, temp_id) 
						VALUES 
						('".$file_name."', '".$the_id."', '".$_SESSION['temp_id']."')";				
						$r = $dbCustom->getResult($db,$sql);
						
					}
				
				
			}
		}
	
		//deleteDir($real_root."/temp_uploads/".$_SESSION['temp_id']);
	
	
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
		
		
		$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Site:</font></div>";
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".SITEROOT."</font></div>";	
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
		
		
		
		
		
		if($budget_range != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Budget range:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".$budget_range."</font></div>";
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
		
		
		
		
		
		/*
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
		*/
		

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
		
		/*
		if($tie_rack != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Tie rack:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($tie_rack)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		
		if($belt_rack != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Belt rack:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($belt_rack)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
	
		if($valet_rod != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Velet rod:</font></div>";
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'><font color='#000000'>".stripAllSlashes($valet_rod)."</font></div>";
			$message .= "<div style='clear:both;'></div>";
		}
		*/
		
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
	
		$db = $dbCustom->getDbConnect(SITE_DATABASE);	
	
		$sql = "SELECT DISTINCT file_name
				FROM design_email_image 
				WHERE design_email_id  = '".$the_id."' 
				AND temp_id = '".$_SESSION['temp_id']."'
				ORDER BY design_email_img_id";	
		$img_result = $dbCustom->getResult($db,$sql);
		
		
		while($row = $img_result->fetch_object()){
			
				
			$message .= "<div style='float:left; width:140px; text-align:right;'><font color='#000000'>Uploaded File:</font></div>";
			
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'>".SITEROOT."/user_uploads/".$_SESSION['profile_account_id']."/".$row->file_name."</div>";
			
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
		$headers .= "CC: mark.stanz@gmail.com";
		$headers .= "\r\n";
		$headers .= "Bcc: jeremiah@closetstogo.com";
		
		$to = 'services@closetstogo.com';
	
		error_reporting(0);
		
		if(mail($to, $subject_c, $message, $headers)){
			$success = 1;	
		}
		
		
		
		
		
		
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
		
		if($name != ''){		
			$message .= stripslashes($name)."<br /><br />";
		}
		
		$message .= $customer_email->getDesignRequestCustEmailBody();
		
		/*
		$message .= "Thank you for your design request with ".$_SESSION['profile_company'].". 
				Your designer is Pam. If you have any questions you may contact her at pam@closetstogo.com or call her toll free at 1-888-312-7424.";
		$message .= "<br /><br />You will receive a design in 3-4 business days.";
		$message .= "<br /><br />Sincerely,";
		$message .= "<br /><br />Closets To Go";	
		*/
		
		$message .= "<br /><br /></div>";
		$message .= "</body>";
		$message .= "</html>";
			
		$subject_c = "Closets To Go Design Request";		
	
		$headers = "Content-type: text/html; charset=iso-8859-1";	
		$headers .= "\r\n";
		$headers .= "From: services@closetstogo.com";
		$headers .= "\r\n";
		$headers .= "Return-path: services@closetstogo.com";
	
		$headers .= "\r\n";
		$headers .= "CC: mark.stanz@gmail.com";		
		$headers .= "\r\n";
		$headers .= "Bcc: jeremiah@closetstogo.com";
		
		$to = $email;
	
		if(!mail($to, $subject_c, $message, $headers)){
		
		}
	
	}else{
		//echo "eeeeeeeeeeeeeeeeeeeeeeeeeeeee";
	}
		
		
	$msg = "Your request has been submitted to Closets To Go";

}


if($msg != ''){
	echo "<div id='msg' class='frm_success'>".$msg."</div>";
}

unset($_SESSION['temp_id']);


$dest = $_SESSION['global_url_word'].getURLFileName('email-design');

?>
<!--
<span onClick='load_page_with_form();' class="btn btn-large btn-success" title='Start Designing' style='width:250px; margin-bottom:50px;'>Create Another Design</span>
-->

<a href="<?php echo SITEROOT.'/'.$dest.'.html'; ?>" class="btn btn-large btn-success" title='Start Designing' style='width:250px; margin-bottom:50px;'>Create Another Design</a>


<?php 
if($_SESSION['profile_account_id'] == 1){
	if(strpos($_SERVER['HTTP_HOST'], 'closetstogo.com') !== false){
?>

<!-- Google Code for Email Design Request Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1070979898;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "phoICIyf6F8QurbX_gM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1070979898/?label=phoICIyf6F8QurbX_gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?php
	}
} 
?>



