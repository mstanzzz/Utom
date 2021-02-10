<?php
/*
	Use: 
		Closets To Go CMS 
		list pending changes, rejected changes, approved changes, backed up changes
		approve changes
		restore backups
	Called from menu
	Variables:
		$review_id -- key to review table where changes are stored
		restore_backup_id -- 		maps to backup_id which is the key to the backup table
		$_POST["approve_change"] -- approve the change
		$_POST["reject_change"] -- 	reject the change
		$_POST["del_reject"] -- 	delete rejected change record
		$_POST["del_approved"] -- 	delete approved change record
		$_POST["del_backup"] -- 	delete backup record
		$_POST["restore_backup"] -- restore backup
*/
require_once("../includes/config.php"); 
require_once("../includes/class.admin_login.php");
$aLgn = new AdminLogin;
if(!$aLgn->isLogedIn()){
	$aLgn->redirect("manage/index.php", "Please Log In");	
}
$user_functions_array = $aLgn->getUserFunctions();
$user_id = $aLgn->getUserId();
if(!in_array(5,$user_functions_array)){
	$aLgn->redirect("manage/start.php", "Content change approval is not a function of this user");	
}

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$page = "miscellaneous";

include("includes/class.backup.php");
$backup = new Backup;

//**************************************
//  APPROVE CHANGE
//**************************************

if(isset($_POST["approve_change"])){
	$ts = time();
	$review_id = $_POST["approve_review_id"];
	
	$sql = "UPDATE review SET approved_by_login_id = '".$user_id."', when_approved = '".$ts."' WHERE review_id = '".$review_id."'"; 
	$ab_result = mysql_query($sql);	



	$sql = "SELECT review_id  
				,content_record_id
				,content_table
				,price
				,price_flat
				,price_wholesale
				,percent_markup
				,percent_off
				,cat_id
				,alt_cat_id
				,img_id
				,content1
				,content2
				,content_short1
				,content_short2
				,content_short3
				,list_order
				,hide
				,action	 
	FROM review
	WHERE review_id = '".$review_id."'";
	
	$rev_result = mysql_query($sql);
	$rev_object =  mysql_fetch_object($rev_result);

	$content1 = addslashes($rev_object->content1);	
	$content2 = addslashes($rev_object->content2);	
	$content_short1 = addslashes($rev_object->content_short1);	
	$content_short2 = addslashes($rev_object->content_short2);	
	$content_short3 = addslashes($rev_object->content_short3);	

			//echo $rev_object->content_table;
			//echo $rev_object->content_record_id;
			//exit;


	if($rev_object->content_table == "showroom_item"){
		$db = $dbCustom->getDbConnect(SHOWROOM_DATABASE);
		if($rev_object->action == "add"){
			
			$sql = sprintf("INSERT INTO showroom_item (name, description, price, percent_off, showroom_cat_id, showroom_sub_cat_id, img_id, last_update) 
			VALUES ('%s','%s','%f', '%u', '%u','%u','%u','%u')", 
			$content_short1, $content1, $rev_object->price, $rev_object->percent_off, $rev_object->alt_cat_id, $rev_object->cat_id, $rev_object->img_id, $ts);
			$result = $dbCustom->getResult($db,$sql);	
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'  WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);

		}else{
			
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"showroom_item");	
			
			// update the item
			$sql = sprintf("UPDATE showroom_item 
						SET name = '%s'
						,description = '%s'
						,price = '%f'
						,percent_off = '%u'
						,showroom_cat_id = '%u'
						,showroom_sub_cat_id = '%u'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE showroom_item_id = '%u'", 
			$content_short1
			,$content1
			,$rev_object->price
			,$rev_object->percent_off
			,$rev_object->alt_cat_id
			,$rev_object->cat_id 
			,$rev_object->img_id
			,$ts
			,$rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}		

	}

	// ********************************************

	if($rev_object->content_table == "accessory_item"){
		$db_selected = dbSelect(ACCESSORY_DATABASE);
		if($rev_object->action == "add"){
			
			$sql = sprintf("INSERT INTO accessory_item 
						   (name
							,description
							,price_flat
							,price_wholesale
							,percent_markup
							,percent_off
							,accessory_cat_id
							,accessory_sub_cat_id
							,img_id
							,last_update) 
			VALUES ('%s','%s','%f','%f','%u','%u','%u','%u','%u','%u')", 
			$content_short1
			,$content1
			,$rev_object->price_flat
			,$rev_object->price_wholesale
			,$rev_object->percent_markup
			,$rev_object->percent_off
			,$rev_object->alt_cat_id
			,$rev_object->cat_id
			,$rev_object->img_id
			,$ts);
			$result = $dbCustom->getResult($db,$sql);	
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'  WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);

		}else{
			
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"accessory_item");	
			
			// update the item
			$sql = sprintf("UPDATE accessory_item 
						SET name = '%s'
						,description = '%s'
						,price_flat = '%f'
						,price_wholesale = '%f'
						,percent_markup = '%u'
						,percent_off = '%u'
						,accessory_cat_id = '%u'
						,accessory_sub_cat_id = '%u'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE accessory_item_id = '%u'", 
			$content_short1
			,$content1
			,$rev_object->price_flat
			,$rev_object->price_wholesale
			,$rev_object->percent_markup
			,$rev_object->percent_off
			,$rev_object->alt_cat_id
			,$rev_object->cat_id 
			,$rev_object->img_id
			,$ts
			,$rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}		

	}

	// ********************************************

	if($rev_object->content_table == "added_page"){

		if($rev_object->action == "add"){
			
			$sql = sprintf("INSERT INTO added_page (content, page_name, page_title, page_cat, last_update) VALUES ('%s','%s','%s','%s','%u')", 
			$content1, $content_short1, $content_short2, $content_short3, $ts);
			$result = $dbCustom->getResult($db,$sql);	
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'  WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);

		}else{
			
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"added_page");	
		
			// update the page			
			$sql = sprintf("UPDATE added_page 
						SET content = '%s'
						,page_name = '%s'
						,page_title = '%s'
						,page_cat = '%s'
						,last_update = '%u' 
						WHERE added_page_id = '%u'", 
			$content1
			,$content_short1
			,$content_short2
			,$content_short3 
			,$ts
			,$rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}		
		
	}


	// ********************************************


	if($rev_object->content_table == "about_us"){

		// create a back up
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"about_us");	

		// update page
		$sql = sprintf("UPDATE about_us 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE about_us_id = '%u'", 
		$content1, $rev_object->img_id, $ts, $rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
		
	}

	// ********************************************


	if($rev_object->content_table == "testimonial"){

		// create a back up
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"testimonial");	

		// update page
		$sql = sprintf("UPDATE testimonial 
							SET content = '%s'
							,name = '%s'
							,email = '%s'
							,city_state = '%s'
							,list_order = '%u' 
							,hide = '%u'
							,last_update = '%u' 
							WHERE testimonial_id = '%u'", 
			$content1, 
			$content_short1,  
			$content_short2, 
			$content_short3,
			$rev_object->list_order,
			$rev_object->hide, 
			$ts, 
			$rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
			
	}

	// ********************************************

	if($rev_object->content_table == "testimonial_page"){
		
		// create a back up
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"testimonial_page");	

		// update the page		
		$sql = sprintf("UPDATE testimonial_page 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE testimonial_page_id = '%u'", 
		$content1, $rev_object->img_id, $ts, $rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);

	}

	// ********************************************

	if($rev_object->content_table == "discount_how"){

		// create a back up
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"discount_how");	



		$sql = sprintf("UPDATE discount_how 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE discount_how_id = '%u'", 
		$content1, $rev_object->img_id, $ts, $rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($rev_object->content_table == "discount"){
		
		// create a back up
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"discount");	

		
		$sql = sprintf("UPDATE discount 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE discount_id = '%u'", 
		$content1, $rev_object->img_id, $ts, $rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($rev_object->content_table == "shipping_time"){

		// create a back up
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"shipping_time");	

		$sql = sprintf("UPDATE shipping_time 
						SET description = '%s'
						,content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE shipping_time_id = '%u'", 
		$content_short1, $content1, $rev_object->img_id, $ts, $rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($rev_object->content_table == "shipping_term"){
		// create a backup
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"shipping_term");	

		$sql = sprintf("UPDATE shipping_term 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE shipping_term_id = '%u'", 
		$content1, $rev_object->img_id, $ts, $rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($rev_object->content_table == "policy_category"){
		if($rev_object->action == "add"){
			$sql = sprintf("INSERT INTO policy_category (category_name, last_update) VALUES ('%s','%u')", 
			$content_short1, $ts);
			$result = $dbCustom->getResult($db,$sql);	
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'  WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);

		}else{
			
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"policy_category");	

			$sql = sprintf("UPDATE policy_category 
						SET category_name = '%s' 
						,last_update = '%u' 
						WHERE policy_cat_id = '%u'", 
			$content_short1, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}		
	}

	// ********************************************

	if($rev_object->content_table == "policy"){
		if($rev_object->action == "add"){
			$sql = sprintf("INSERT INTO policy (content, policy_cat_id, img_id, last_update) VALUES ('%s','%u','%u','%u')", 
			$content1, $rev_object->cat_id, $rev_object->img_id, $ts);
			$result = $dbCustom->getResult($db,$sql);
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'    WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);
		
		}else{
			
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"policy");	
			
			$sql = sprintf("UPDATE policy 
						SET policy_cat_id = '%u' 
						,content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE policy_id = '%u'", 
			$rev_object->cat_id, $content1, $rev_object->img_id, $ts,  $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);

		}
				
	}

	// ********************************************

	if($rev_object->content_table == "process_category"){
		if($rev_object->action == "add"){
			$sql = sprintf("INSERT INTO process_category (category_name, last_update) VALUES ('%s','%u')", 
			$content_short1, $ts);
			$result = $dbCustom->getResult($db,$sql);	
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'  WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);

		}else{
			
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"process_category");	
			
			$sql = sprintf("UPDATE process_category 
						SET category_name = '%s' 
						,last_update = '%u' 
						WHERE process_cat_id = '%u'", 
			$content_short1, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}		
	}

	// ********************************************

	if($rev_object->content_table == "process"){
		if($rev_object->action == "add"){
			$sql = sprintf("INSERT INTO process (content, process_cat_id, last_update) VALUES ('%s','%u','%u')", 
			$content1, $rev_object->cat_id, $ts);
			$result = $dbCustom->getResult($db,$sql);
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'    WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);
		
		}else{

			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"process");	

			$sql = sprintf("UPDATE process 
						SET process_cat_id = '%u' 
						,content = '%s'
						,last_update = '%u' 
						WHERE process_id = '%u'", 
			$rev_object->cat_id, $content1, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);

		}
				
	}

	// ********************************************

	if($rev_object->content_table == "faq_category"){
		if($rev_object->action == "add"){
			$sql = sprintf("INSERT INTO faq_category (category_name, last_update) VALUES ('%s','%u')", 
			$content_short1, $ts);
			$result = $dbCustom->getResult($db,$sql);	
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'  WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);

		}else{
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"faq_category");	

			$sql = sprintf("UPDATE faq_category 
						SET category_name = '%s' 
						,last_update = '%u' 
						WHERE faq_cat_id = '%u'", 
			$content_short1, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
		
	}

	// ********************************************

	if($rev_object->content_table == "faq"){
		if($rev_object->action == "add"){
			$sql = sprintf("INSERT INTO faq (question, answere, faq_cat_id, last_update) VALUES ('%s','%s','%u','%u')", 
			$content1, $content2, $rev_object->cat_id, $ts);
			$result = $dbCustom->getResult($db,$sql);	
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'    WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);

		}else{
			
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"faq");	

			$sql = sprintf("UPDATE faq 
						SET question = '%s'
						,answere = '%s' 
						,faq_cat_id = '%u' 
						,last_update = '%u' 
						WHERE faq_id = '%u'", 
			$content1, $content2, $rev_object->cat_id, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
		
	}

	// ********************************************

	if($rev_object->content_table == "contact_us"){
		
		// create a back up
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"contact_us");	

		$sql = sprintf("UPDATE contact_us 
						SET address = '%s'
						,phone = '%s'
						,fax = '%s' 
						,last_update = '%u' 
						WHERE  contact_us_id  = '%u'", 
		$content_short1, $content_short2, $content_short3, $ts, $rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($rev_object->content_table == "contact_email_page"){
		// create a back up
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"contact_us");	

		$sql = sprintf("UPDATE contact_email_page 
						SET content1 = '%s'
						,content2 = '%s' 
						,last_update = '%u' 
						WHERE  contact_email_page_id  = '%u'", 
		$content1, $content2, $ts, $rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($rev_object->content_table == "guide_tip_category"){
		if($rev_object->action == "add"){
			$sql = sprintf("INSERT INTO guide_tip_category (category_name, last_update) VALUES ('%s','%u')", 
			$content_short1, $ts);
			$result = $dbCustom->getResult($db,$sql);	
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'    WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);

		}else{
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"guide_tip_category");				
			
			$sql = sprintf("UPDATE guide_tip_category 
						SET category_name = '%s' 
						,last_update = '%u' 
						WHERE guide_tip_cat_id = '%u'", 
			$content_short1, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
	}

	// ********************************************
	
	if($rev_object->content_table == "guide_tip"){
		if($rev_object->action == "add"){
			$sql = sprintf("INSERT INTO guide_tip (content, guide_tip_cat_id, last_update) VALUES ('%s','%u','%u')", 
			$content1, $rev_object->cat_id, $ts);
			$result = $dbCustom->getResult($db,$sql);
			$id = $db->insert_id;
			$sql = "UPDATE review SET content_record_id = '".$id."'    WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);
		
		}else{
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"guide_tip");				
			$sql = sprintf("UPDATE guide_tip 
						SET guide_tip_cat_id = '%u' 
						,content = '%s'
						,last_update = '%u' 
						WHERE guide_tip_id = '%u'", 
			$rev_object->cat_id, $content1, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);

		}
				
	}

	// ********************************************
	
	if($rev_object->content_table == "terms_of_use"){
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"terms_of_use");				
			$sql = sprintf("UPDATE terms_of_use 
						SET content = '%s'
						,last_update = '%u' 
						WHERE terms_of_use_id = '%u'", 
			$content1, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
				
	}

	// ********************************************
	
	if($rev_object->content_table == "privacy_statement"){
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"privacy_statement");				
			$sql = sprintf("UPDATE privacy_statement 
						SET content = '%s'
						,last_update = '%u' 
						WHERE privacy_statement_id = '%u'", 
			$content1, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
				
	}
	
	// ********************************************
	
	if($rev_object->content_table == "in_home_consultation"){ 
		// create a back up
		$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"in_home_consultation");				
		$sql = sprintf("UPDATE in_home_consultation 
						SET content = '%s'
						,last_update = '%u' 
						WHERE in_home_consultation_id = '%u'", 
		$content1, $ts, $rev_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);

	}

	// ********************************************

	if($rev_object->content_table == "link"){
		
		
		
		if($rev_object->action == "add"){
			
			
			$sql = sprintf("INSERT INTO link (url, link_text, page, last_update) VALUES ('%s','%s','%s','%u')", 
			$content_short1, $content_short2, $content_short3, $ts);
			$result = $dbCustom->getResult($db,$sql);
			//
			//echo "KKKKKKKKKKKKKK";
			$id = $db->insert_id;
			
			$sql = "UPDATE review SET content_record_id = '".$id."' WHERE review_id = '".$rev_object->review_id."'";
 			$r_ud = mysql_query($sql);
		
		}else{

			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"link");	

			$sql = sprintf("UPDATE link 
						SET url = '%s' 
						,link_text = '%s'
						,page = '%s'
						,last_update = '%u' 
						WHERE link_id = '%u'", 
			$content_short1, $content_short2, content_short3, $ts, $rev_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);

		}
				
	}



	

}



//**************************************
//  REJECT CHANGE
//**************************************


if(isset($_POST["reject_change"])){
	$ts = time();
	$review_id = $_POST["reject_review_id"];
	
	$sql = sprintf("UPDATE review 
		SET when_rejected  = '%u'
		,rejected_by_login_id  = '%u' 
		WHERE review_id = '%u'", 
		$ts, $user_id, $review_id);
	$result = $dbCustom->getResult($db,$sql);
	//
	
}

//**************************************
//  DELETE REJECT
//**************************************
if(isset($_POST["del_reject"])){
	$reject_id = $_POST["del_reject_id"];
	$sql = sprintf("DELETE FROM review WHERE review_id = '%u'", $reject_id);
	$result = $dbCustom->getResult($db,$sql);
	
}


//**************************************
//  DELETE APPROVED
//**************************************
if(isset($_POST["del_approved"])){
	$approved_id = $_POST["del_approved_id"];
	$sql = sprintf("DELETE FROM review WHERE review_id = '%u'", $approved_id);
	$result = $dbCustom->getResult($db,$sql);
	
}

//**************************************
//  DELETE BACKUP
//**************************************
if(isset($_POST["del_backup"])){
	$backup_id = $_POST["del_backup_id"];
	$sql = sprintf("DELETE FROM backup WHERE backup_id = '%u'", $backup_id);
	$result = $dbCustom->getResult($db,$sql);
	
}

//**************************************
//  RESTORE BACKUP
//**************************************

if(isset($_POST["restore_backup"])){
	$ts = time();
	$restore_backup_id = $_POST["restore_backup_id"];

	$sql = "SELECT backup_id  
				,content_record_id
				,content_table
				,price
				,price_flat
				,price_wholesale
				,percent_markup
				,percent_off
				,cat_id
				,alt_cat_id
				,img_id
				,content1
				,content2
				,content_short1
				,content_short2
				,content_short3
				,list_order
				,hide
				,action
	FROM backup
	WHERE backup_id = '".$restore_backup_id."'";
	
	$b_result = mysql_query($sql);
	$b_object =  mysql_fetch_object($b_result);

	$content1 = addslashes($b_object->content1);	
	$content2 = addslashes($b_object->content2);	
	$content_short1 = addslashes($b_object->content_short1);	
	$content_short2 = addslashes($b_object->content_short2);	
	$content_short3 = addslashes($b_object->content_short3);	


	if($b_object->content_table == "showroom_item"){

		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"showroom_item");	
		$db = $dbCustom->getDbConnect(SHOWROOM_DATABASE);			
		// update the page			
		$sql = sprintf("UPDATE showroom_item 
						SET name = '%s'
						,description = '%s'
						,price = '%f'
						,percent_off = '%u'
						,showroom_cat_id = '%u'
						,showroom_sub_cat_id = '%u'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE showroom_item_id = '%u'", 
			$content_short1
			,$content1
			,$b_object->price
			,$b_object->percent_off
			,$b_object->alt_cat_id
			,$b_object->cat_id 
			,$b_object->img_id
			,$ts
			,$b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}		

	// ********************************************

	if($b_object->content_table == "accessory_item"){

		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"accessory_item");	
		$db_selected = dbSelect(ACCESSORY_DATABASE);			
		// update the page			
		$sql = sprintf("UPDATE accessory_item 
						SET name = '%s'
						,description = '%s'
						,price_flat = '%f'
						,price_wholesale = '%f'
						,percent_markup = '%u'
						,percent_off = '%u'
						,accessory_cat_id = '%u'
						,accessory_sub_cat_id = '%u'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE accessory_item_id = '%u'", 
			$content_short1
			,$content1
			,$b_object->price_flat
			,$b_object->price_wholesale
			,$b_object->percent_markup
			,$b_object->percent_off
			,$b_object->alt_cat_id
			,$b_object->cat_id 
			,$b_object->img_id
			,$ts
			,$b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}		

	// ********************************************

	if($b_object->content_table == "added_page"){

		if($b_object->action == "delete"){

			$sql = "INSERT INTO added_page
					(content, page_name, page_title, page_cat )
					VALUES
					('".$content1."', '".$content_short1."', '".content_short2."', '".content_short3."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{
			
	
			// create a back up
			$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"added_page");		
				
			// update the page			
			$sql = sprintf("UPDATE added_page 
							SET content = '%s', page_name = '%s', page_title = '%s', page_cat = '%s', hide = '%u', last_updated 
							WHERE added_page_id = '%u'", 
				$content1
				,$content_short1
				,$content_short2 
				,$content_short3
				,$b_object->hide
				,$ts
				,$b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}

	}

	// ********************************************


	if($b_object->content_table == "about_us"){

		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"about_us");	

		// update the page
		$sql = sprintf("UPDATE about_us 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE about_us_id = '%u'", 
		$content1, $b_object->img_id, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
		
	}

	// ********************************************


	if($b_object->content_table == "testimonial"){

		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"testimonial");	

		// update page
		$sql = sprintf("UPDATE testimonial 
							SET content = '%s'
							,name = '%s'
							,email = '%s'
							,city_state = '%s'
							,list_order = '%u'
							,hide = '%u'
							,last_update = '%u' 
							WHERE testimonial_id = '%u'", 
			$content1, 
			$content_short1,  
			$content_short2, 
			$content_short3,
			$b_object->list_order,
			$b_object->hide, 
			$ts, 
			$b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
			
	}

	// ********************************************

	if($b_object->content_table == "testimonial_page"){
		
		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"testimonial_page");	

		// update the page		
		$sql = sprintf("UPDATE testimonial_page 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE testimonial_page_id = '%u'", 
		$content1, $b_object->img_id, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);

	}

	// ********************************************

	if($b_object->content_table == "discount_how"){

		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"discount_how");	

		$sql = sprintf("UPDATE discount_how 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE discount_how_id = '%u'", 
		$content1, $b_object->img_id, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($b_object->content_table == "discount"){
		
		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"discount");	
		
		$sql = sprintf("UPDATE discount 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE discount_id = '%u'", 
		$content1, $b_object->img_id, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}
	
	// ********************************************

	if($b_object->content_table == "shipping_time"){

		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"shipping_time");	

		$sql = sprintf("UPDATE shipping_time 
						SET description = '%s'
						,content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE shipping_time_id = '%u'", 
		$content_short1, $content1, $b_object->img_id, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($b_object->content_table == "shipping_term"){

		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"shipping_term");	

		$sql = sprintf("UPDATE shipping_term 
						SET content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE shipping_term_id = '%u'", 
		$content1, $b_object->img_id, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($b_object->content_table == "policy_category"){
		if($b_object->action == "delete"){

			$sql = "INSERT INTO policy_category
					(category_name)
					VALUE
					('".$content_short1."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{

			// create a back up
			$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"policy_category");	
	
			$sql = sprintf("UPDATE policy_category 
						SET category_name = '%s' 
						,last_update = '%u' 
						WHERE policy_cat_id = '%u'", 
			$content_short1, $ts, $b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
	}


	// ********************************************

	if($b_object->content_table == "policy"){
		if($b_object->action == "delete"){

			$sql = "INSERT INTO policy
					(policy_cat_id, content, img_id)
					VALUES
					('".$b_object->cat_id."', '".$content1."', '".$b_object->img_id."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{
			
			// create a back up
			$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"policy");	
				
			$sql = sprintf("UPDATE policy 
						SET policy_cat_id = '%u' 
						,content = '%s'
						,img_id = '%u'
						,last_update = '%u' 
						WHERE policy_id = '%u'", 
			$b_object->cat_id, $content1, $ts, $b_object->img_id, $b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
	}



	// ********************************************

	if($b_object->content_table == "process_category"){

		if($b_object->action == "delete"){

			$sql = "INSERT INTO process_category
					(category_name)
					VALUE
					('".$content_short1."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{
			// create a back up
			$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"process_category");	
			$sql = sprintf("UPDATE process_category 
							SET category_name = '%s' 
							,last_update = '%u' 
							WHERE process_cat_id = '%u'", 
			$content_short1, $ts, $b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
	}


	// ********************************************

	if($b_object->content_table == "process"){
		
		
		if($b_object->action == "delete"){

			$sql = "INSERT INTO process
					(process_cat_id, content)
					VALUES
					('".$b_object->cat_id."','".$content1."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{
			// create a back up
			$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"process");	

			$sql = sprintf("UPDATE process 
						SET process_cat_id = '%u' 
						,content = '%s'
						,last_update = '%u' 
						WHERE process_id = '%u'", 
			$b_object->cat_id, $content1, $ts, $b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
	}


	// ********************************************

	if($b_object->content_table == "faq_category"){

		if($b_object->action == "delete"){

			$sql = "INSERT INTO faq_category
					(category_name)
					VALUE
					('".$content_short1."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{
		
			// create a back up
			$dbu = $backup->doBackup($rev_object->content_record_id,$user_id,"faq_category");	
	
			$sql = sprintf("UPDATE faq_category 
							SET category_name = '%s' 
							,last_update = '%u' 
							WHERE faq_cat_id = '%u'", 
			$content_short1, $ts, $b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
	}


	// ********************************************

	if($b_object->content_table == "faq"){
		
		if($b_object->action == "delete"){

			$sql = "INSERT INTO faq
					(question, answere, faq_cat_id)
					VALUES
					('".$content1."','".$content2."','".$b_object->cat_id."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{
			
			// create a back up
			$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"faq");	
				
			$sql = sprintf("UPDATE faq 
							SET question = '%s'
							,answere = '%s' 
							,faq_cat_id = '%u' 
							,last_update = '%u' 
							WHERE faq_id = '%u'", 
			$content1, $content2, $b_object->cat_id, $ts, $b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
		
	}

	// ********************************************

	if($b_object->content_table == "contact_us"){
		
		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"contact_us");	

		$sql = sprintf("UPDATE contact_us 
						SET address = '%s'
						,phone = '%s'
						,fax = '%s' 
						,last_update = '%u' 
						WHERE  contact_us_id  = '%u'", 
		$content_short1, $content_short2, $content_short3, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($b_object->content_table == "contact_email_page"){
		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"contact_email_page");	

		$sql = sprintf("UPDATE contact_email_page 
						SET content1 = '%s'
						,content2 = '%s' 
						,last_update = '%u' 
						WHERE  contact_email_page_id  = '%u'", 
		$content1, $content2, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************

	if($b_object->content_table == "guide_tip_category"){
		
		if($b_object->action == "delete"){

			$sql = "INSERT INTO guide_tip_category
					(category_name)
					VALUE
					('".$content_short1."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{
		
			
			// create a back up
			$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"guide_tip_category");				
				
			$sql = sprintf("UPDATE guide_tip_category 
							SET category_name = '%s' 
							,last_update = '%u' 
							WHERE guide_tip_cat_id = '%u'", 
			$content_short1, $ts, $b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
		}
	}

	// ********************************************
	
	if($b_object->content_table == "guide_tip"){

		if($b_object->action == "delete"){

			$sql = "INSERT INTO guide_tip
					(guide_tip_cat_id, content)
					VALUES
					('".$b_object->cat_id."','".$content1."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{
	
			// create a back up
			$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"guide_tip");				
	
			$sql = sprintf("UPDATE guide_tip 
							SET guide_tip_cat_id = '%u' 
							,content = '%s'
							,last_update = '%u' 
							WHERE guide_tip_id = '%u'", 
			$b_object->cat_id, $content1, $ts, $b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);

		}
	}

	// ********************************************
	
	if($b_object->content_table == "terms_of_use"){
		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"terms_of_use");				

		$sql = sprintf("UPDATE terms_of_use 
						SET content = '%s'
						,last_update = '%u' 
						WHERE terms_of_use_id = '%u'", 
		$content1, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}

	// ********************************************
	
	if($b_object->content_table == "privacy_statement"){
		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"privacy_statement");				

		$sql = sprintf("UPDATE privacy_statement 
						SET content = '%s'
						,last_update = '%u' 
						WHERE privacy_statement_id = '%u'", 
		$content1, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}


	// ********************************************
	
	if($b_object->content_table == "in_home_consultation"){
		// create a back up
		$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"in_home_consultation");				

		$sql = sprintf("UPDATE in_home_consultation 
						SET content = '%s'
						,last_update = '%u' 
						WHERE in_home_consultation_id = '%u'", 
		$content1, $ts, $b_object->content_record_id);
		$result = $dbCustom->getResult($db,$sql);
	}


	// ********************************************
	
	if($b_object->content_table == "link"){

		if($b_object->action == "delete"){

			$sql = "INSERT INTO link
					(url, link_text, page)
					VALUES
					('".$content_short1."','".$content_short2."','".$content_short3."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}else{

			// create a back up
			$dbu = $backup->doBackup($b_object->content_record_id,$user_id,"link");				
	
			$sql = sprintf("UPDATE link 
							SET url = '%s'
							,link_text = '%s'
							,page = '%s'
							,last_update = '%u' 
							WHERE link_id = '%u'", 
			$content_short1, $content_short2, $content_short3, $ts, $b_object->content_record_id);
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}

	// ********************************************
	
	if($b_object->content_table == "news"){

		if($b_object->action == "delete"){

			$sql = "INSERT INTO link
					(content, type, list_order)
					VALUES
					('".$content1."','".$content_short2."', '".$b_object->list_order."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}

	// ********************************************
	
	if($b_object->content_table == "blog_post"){

		if($b_object->action == "delete"){

			$sql = "INSERT INTO blog_post
					(when_posted, title, substitute_by, content ,blog_cat_id ,user_id)
					VALUES
					('".$alt_when."','".$content_short1."','".$content_short2."','".$content1."','".$b_object->cat_id."','".$b_object->alt_cat_id."')";
			$result = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM backup WHERE backup_id = '".$b_object->backup_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}


	
	
}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Management</title>


<link type="text/css" rel="stylesheet" href="../css/cmsNav.css" />
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />

<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>

<script>
$(document).ready(function() {

	$(".inline").click(function(){ 
	
		if(this.href.indexOf("approve") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			$("#approve_review_id").val(f_id);			
		}
		
		if(this.href.indexOf("reject") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			$("#reject_review_id").val(f_id);			
		}
		
		if(this.href.indexOf("restore") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			$("#restore_backup_id").val(f_id);			
		}

		if(this.href.indexOf("delete_backup") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_backup_id").val(f_id);
		}

		if(this.href.indexOf("delete_reject") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_reject_id").val(f_id);
		}

		if(this.href.indexOf("delete_approved") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_approved_id").val(f_id);
		}
	});



	$("a.inline").fancybox();

});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
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
	Content Change Management
    
	<div class="top_right_link">
    <?php
	$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "start";
	echo "<a href='".$ret_page.".php'>< BACK</a>";
	?>        
    </div>  
	
</div>
<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>

<div class="page_container">




   <div class="head">Pending Changes</div>
    <?php
    $sql = "SELECT review.slug AS page 
				,review.when_submitted AS when_submitted
				,review.review_id AS review_id
				,review.submitted_by_login_id
	FROM review
	WHERE review.when_approved = '0'
	AND when_rejected = '0'
	ORDER BY page, when_submitted DESC";
    $p_result = mysql_query($sql);	

	if(mysql_num_rows($p_result) > 0){
	
	
		$block = "<table border='0' width='100%' cellpadding='6'>";
		$block .= "<tr>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='14%'><div class='head'>Page</div></td>";
		$block .= "<td width='18%'><div class='head'>Submitted By</div></td>";
		$block .= "<td><div class='head'>When Submitted</div></td>";
		$block .= "</tr>";
		echo $block; 
		while($row = mysql_fetch_object($p_result)) {
			$block = "<tr>"; 				
			$block .= "<td valign='top'><a href='view-change.php?review_id=".$row->review_id."'>
			<img src='../images/button_view.jpg' /></a></td>";
			$block .= "<td valign='top'><a class='inline' href='#approve'>
			<img src='../images/button_approve.jpg' /><div class='e_sub' id='".$row->review_id."' style='display:none'></div> </a></td>";
			$block .= "<td valign='top'><a class='inline' href='#reject'>
			<img src='../images/button_reject.jpg' /><div class='e_sub' id='".$row->review_id."' style='display:none'></div> </a></td>";
			$block .= "<td valign='top'>$row->page</td>";
			
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT name FROM user WHERE id = '".$row->submitted_by_login_id."'";
			$sb_res = mysql_query($sql);
			$sb_object = mysql_fetch_object($sb_res);
			
			$block .= "<td valign='top'>$sb_object->name</td>";
			$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->when_submitted)."</td>";
			$block .= "</tr>";
			echo $block;
		}
		echo "</table>";
	}else{
		echo "None";	
	}

    ?>
    
<br /><br /><hr /><br /> 

   <div class="head">Backups</div>
    <?php
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
    $sql = "SELECT backup.slug AS page 
				,backup.when_backed AS when_backed
				,backup.backup_id AS backup_id
				,backup.backed_by_login_id  AS backed_by_login_id 
	FROM backup
	ORDER BY page, when_backed DESC";
    
	$b_result = mysql_query ($sql);	
	if(!$b_result)die(mysql_error());

	if(mysql_num_rows($b_result) > 0){
	
	
		$block = "<table border='0' width='100%' cellpadding='6'>";
		$block .= "<tr>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='14%'><div class='head'>Page</div></td>";
		$block .= "<td width='14%'><div class='head'>Backed up by</div></td>";		
		$block .= "<td><div class='head'>When Submitted</div></td>";
		$block .= "</tr>";
		echo $block;
		//$i = 0; 
		while($row = mysql_fetch_object($b_result)) {
			$block = '';
			//if($i > 0 && $the_page != $row->page){
				//$block .= "<tr><td colspan='5' bgcolor='#CCCCCC'></td>";		
			//}
			//$the_page = $row->page;
			//$i++;

			$block .= "<tr>"; 				
			$block .= "<td valign='top'><a href='view-change.php?backup_id=".$row->backup_id."&backedup'>
			<img src='../images/button_view.jpg' /></a></td>";
			$block .= "<td valign='top'><a class='inline' href='#restore'>
			<img src='../images/button_restore.jpg' /><div class='e_sub' id='".$row->backup_id."' style='display:none'></div> </a></td>";
			
		
		    $block .= "<td valign='top'><a class='inline' href='#delete_backup'>
			<img src='../images/button_delete.jpg' /><div class='e_sub' id='".$row->backup_id."' style='display:none'></div> </a></td>";
 	
			
			$block .= "<td valign='top'>$row->page</td>";


			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT name FROM user WHERE id = '".$row->backed_by_login_id."'";
			$sb_res = mysql_query($sql);
			$sb_object = mysql_fetch_object($sb_res);
			$block .= "<td valign='top'>$sb_object->name</td>";



			$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->when_backed)."</td>";
			$block .= "</tr>";
			echo $block;
		}
		echo "</table>";
	}else{
		echo "None";	
	}

    ?>
    
<br /><br /><hr /><br /> 


   <div class="head">Rejected Changes</div>

    <?php
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
    $sql = "SELECT slug AS page 
				,when_submitted
				,when_rejected
				,submitted_by_login_id 
				,rejected_by_login_id
				,review_id 
	FROM review
	WHERE when_rejected > '0'
	AND when_approved < when_rejected
	ORDER BY page, when_submitted DESC, when_rejected DESC";
 
    $r_result = mysql_query ($sql);	

	if(mysql_num_rows($r_result) > 0){
	
	
		$block = "<table border='0' width='100%' cellpadding='6'>";
		$block .= "<tr>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='14%'><div class='head'>Page</div></td>";
		$block .= "<td width='14%'><div class='head'>Submitted By</div></td>";
		$block .= "<td width='18%'><div class='head'>When Submitted</div></td>";
		$block .= "<td width='14%'><div class='head'>Rejected By</div></td>";
		$block .= "<td><div class='head'>When Rejected</div></td>";
		$block .= "</tr>";
		echo $block; 

		while($row = mysql_fetch_object($r_result)) {
			$block = "<tr>"; 				
			$block .= "<td valign='top'><a href='view-change.php?review_id=".$row->review_id."&rejected'>
			<img src='../images/button_view.jpg' /></a></td>";
			
			$block .= "<td valign='top'><a class='inline' href='#approve'>
			<img src='../images/button_approve.jpg' /><div class='e_sub' id='".$row->review_id."' style='display:none'></div> </a></td>";
			

		    $block .= "<td valign='top'><a class='inline' href='#delete_reject'>
			<img src='../images/button_delete.jpg' /><div class='e_sub' id='".$row->review_id."' style='display:none'></div> </a></td>";


			$block .= "<td valign='top'>$row->page</td>";
				
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT name FROM user WHERE id = '".$row->submitted_by_login_id."'";
			$sb_res = mysql_query($sql);
			$sb_object = mysql_fetch_object($sb_res);
			$block .= "<td valign='top'>$sb_object->name</td>";

			$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->when_submitted)."</td>";

	        $sql = "SELECT name FROM user WHERE id  = '".$row->rejected_by_login_id."'";
			$rb_res = mysql_query($sql);
			$rb_object = mysql_fetch_object($rb_res);			
			
			$block .= "<td valign='top'>$rb_object->name</td>";
			$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->when_rejected)."</td>";
			$block .= "</tr>";
			echo $block;
		}
		
		echo "</table>";
	}else{
		echo "None";	
	}
		
 
    ?>


    
<br /><br /><hr /><br /> 

   <div class="head">Approved Changes</div>

    <?php
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
    $sql = "SELECT slug AS page 
				,when_submitted
				,when_approved
				,submitted_by_login_id 
				,approved_by_login_id
				,review_id 
	FROM review
	WHERE when_approved > '0'
	AND when_approved > when_rejected
	ORDER BY page, when_submitted DESC, when_approved DESC";
 
    $a_result = mysql_query ($sql);	

	if(mysql_num_rows($a_result) > 0){
	
	
		$block = "<table border='0' width='100%' cellpadding='6'>";
		$block .= "<tr>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='6%'>&nbsp;</td>";
		$block .= "<td width='14%'><div class='head'>Page</div></td>";
		$block .= "<td width='14%'><div class='head'>Submitted By</div></td>";
		$block .= "<td width='24%'><div class='head'>When Submitted</div></td>";
		$block .= "<td width='14%'><div class='head'>Approved By</div></td>";
		$block .= "<td><div class='head'>When Approved</div></td>";
		$block .= "</tr>";
		echo $block; 

		while($row = mysql_fetch_object($a_result)) {
			$block = "<tr>"; 				
			$block .= "<td valign='top'><a href='view-change.php?review_id=".$row->review_id."&approved'>
			<img src='../images/button_view.jpg' /></a></td>";

		    $block .= "<td valign='top'><a class='inline' href='#delete_approved'>
			<img src='../images/button_delete.jpg' /><div class='e_sub' id='".$row->review_id."' style='display:none'></div> </a></td>";


			$block .= "<td valign='top'>$row->page</td>";
			
			
			$db = $dbCustom->getDbConnect(USER_DATABASE);
	        $sql = "SELECT name FROM user WHERE id  = '".$row->submitted_by_login_id."'";
			$sb_res = mysql_query($sql);
			$sb_object = mysql_fetch_object($sb_res);
				
			$block .= "<td valign='top'>$sb_object->name</td>";
			$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->when_submitted)."</td>";

	        $sql = "SELECT name FROM user WHERE id  = '".$row->approved_by_login_id."'";
			$ab_res = mysql_query($sql);
			$ab_object = mysql_fetch_object($ab_res);			
			
			$block .= "<td valign='top'>$ab_object->name</td>";
			$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->when_approved)."</td>";
			$block .= "</tr>";
			echo $block;
		}
		
		echo "</table>";
	}else{
		echo "None";	
	}
		
 
    ?>



    
    <div style="display:none">
        <div id="approve" style="width:280px; height:100px;">
            Are you sure you want to approve this change?
            <form name="approve_change_form" action="change-management.php" method="post">
                <input id="approve_review_id" type="hidden" name="approve_review_id" />
                <input name="approve_change" type="submit" value="APPROVE" />
            </form>
        </div>
    </div>
 
    <div style="display:none">
        <div id="reject" style="width:280px; height:100px;">
            Are you sure you want to reject this change?
            <form name="reject_change_form" action="change-management.php" method="post">
                <input id="reject_review_id" type="hidden" name="reject_review_id" />
                <input name="reject_change" type="submit" value="REJECT" />
            </form>
        </div>
    </div>

    <div style="display:none">
        <div id="restore" style="width:280px; height:100px;">
            Are you sure you want to restore this backup?
            <form name="restore_backup_form" action="change-management.php" method="post">
                <input id="restore_backup_id" type="hidden" name="restore_backup_id" />
                <input name="restore_backup" type="submit" value="RESTORE" />
            </form>
        </div>
    </div>

 	<div style="display:none">
        <div id="delete_backup" style="width:180px; height:80px;">
            Are you sure you want to delete this backup record?
            <form name="del_backup_form" action="change-management.php" method="post">
                <input id="del_backup_id" type="hidden" name="del_backup_id" />
                <input name="del_backup" type="submit" value="DELETE" />
            </form>
        </div>
    </div>

 	<div style="display:none">
        <div id="delete_reject" style="width:180px; height:80px;">
            Are you sure you want to delete this reject record?
            <form name="del_reject_form" action="change-management.php" method="post">
                <input id="del_reject_id" type="hidden" name="del_reject_id" />
                <input name="del_reject" type="submit" value="DELETE" />
            </form>
        </div>
    </div>

 	<div style="display:none">
        <div id="delete_approved" style="width:180px; height:80px;">
            Are you sure you want to delete this approval record?
            <form name="del_approved_form" action="change-management.php" method="post">
                <input id="del_approved_id" type="hidden" name="del_approved_id" />
                <input name="del_approved" type="submit" value="DELETE" />
            </form>
        </div>
    </div>





<p class="clear"></p>
<?php 
require_once("../admin-includes/manage-footer.php");
?>

</div>
</body>
</html>

