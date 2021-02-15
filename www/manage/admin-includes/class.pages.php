<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 

class Pages{

	function newProfileSetup($new_profile_account_id)
	{
		$ts = time();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	
		$this->setSeoPageNames($new_profile_account_id);
		$sql = "INSERT INTO side_nav
				(profile_account_id, submenu_content_type)
				VALUES('".$new_profile_account_id."', '1')";
		$result = $dbCustom->getResult($db,$sql);
		
		$sql = "INSERT INTO global_seo_words
				(profile_account_id)
				VALUES('".$new_profile_account_id."')";
		$result = $dbCustom->getResult($db,$sql);
			
		$sql = "SELECT img_id FROM image WHERE file_name = 'dummy_logo.jpg' AND profile_account_id = '".$new_profile_account_id."'"; 
		$img_res = $dbCustom->getResult($db,$sql);
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();		
			$new_img_id = $img_obj->img_id;
		}else{
			$sql = "INSERT INTO image
					(file_name, slug, profile_account_id)
					VALUES('dummy_logo.jpg', 'logo', '".$new_profile_account_id."')";
			$i_res = $dbCustom->getResult($db,$sql);		
			$new_img_id = $db->insert_id;
			
			
		}

		$sql = "INSERT INTO logo
				(img_id, active, profile_account_id)
				VALUES('".$new_img_id."', '1', '".$new_profile_account_id."')";
		$l_res = $dbCustom->getResult($db,$sql);		

		$sql = "SELECT img_id FROM image WHERE file_name = 'dummy_banner.jpg' AND profile_account_id = '".$new_profile_account_id."'"; 
		$img_res = $dbCustom->getResult($db,$sql);
		
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();		
			$new_img_id = $img_obj->img_id;
		}else{
			$sql = "INSERT INTO image
					(file_name, slug, profile_account_id)
					VALUES('dummy_banner.jpg', 'logo', '".$new_profile_account_id."')";
			
			$res = $dbCustom->getResult($db,$sql);			
			$new_img_id = $db->insert_id;
		}
		$sql = "INSERT INTO banner
					(img_id, hide, title, profile_account_id)
				VALUES('".$new_img_id."', '0', 'Title Here', '".$new_profile_account_id."')";		
		$l_res = $dbCustom->getResult($db,$sql);
		
		/*
		$sql = "INSERT INTO design 
			(content1, content2, content3, content4, last_update, profile_account_id) 
		VALUES ('You can use our email form if your closet is square or rectangular in shape. If you have a closet with an obscure shape then you will need to fax us your dimensions.'
				,'Our fax form works best if you have an irregular-shaped closet or if you have drawings to send us. You can use our email form if your closet is square or rectangular in shape'
				,'We have free in-home design consulations for certain zip codes. click below to see if you are in a service area.'
				,'Use our online design program to build your custom closet system. Our program allows you to build, save, and change your design at your convenience.'
				, '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		*/
		
		$sql = "INSERT INTO design_email_content 
			(content, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);


		$sql = "INSERT INTO about_us 
			(content, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);


		$sql = "INSERT INTO guarantee 
			(content, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO faq_page 
			(profile_account_id) 
			VALUES ('".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO company_info 
				(text_block2, phone, fax, days, hours, addr_line1, addr_line2, profile_account_id)
				VALUES
				('Metrics content goes here', 'your phone', 'your fax', 'days open', 'hours open', 'your street address', 'your city state zip', '".$new_profile_account_id."')";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO contact_email_page 
			(content1, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO contact_us 
			(last_update, profile_account_id) 
			VALUES ('".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		


		$sql = "INSERT INTO guides_tips_page 
			(profile_account_id) 
			VALUES ('".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		


		$sql = "INSERT INTO guide_tip_category 
			(category_name, last_update, profile_account_id) 
			VALUES ('Sample Category', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "SELECT guide_tip_cat_id FROM guide_tip_category 
				WHERE profile_account_id = '".$new_profile_account_id."'
			"; 
		$result = $dbCustom->getResult($db,$sql);
		
		$c_obj = $result->fetch_object();

		$sql = "INSERT INTO guide_tip 
			(guide_tip_cat_id, content, last_update, profile_account_id) 
			VALUES ('".$c_obj->guide_tip_cat_id."', 'Sample Guide Tip', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO faq_category 
			(category_name, last_update, profile_account_id) 
			VALUES ('Sample Category', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "SELECT faq_cat_id FROM faq_category 
				WHERE profile_account_id = '".$new_profile_account_id."'
			"; 
		$result = $dbCustom->getResult($db,$sql);
		
		$c_obj = $result->fetch_object();

		$sql = "INSERT INTO faq 
			(faq_cat_id, question, answere, last_update, profile_account_id) 
			VALUES ('".$c_obj->faq_cat_id."', 'Sample Question', 'Sample Answere', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "SELECT img_id FROM image WHERE file_name = '15percent.jpg' AND profile_account_id = '".$new_profile_account_id."'"; 
		$img_res = $dbCustom->getResult($db,$sql);
		
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();		
			$new_img_id = $img_obj->img_id;
		}else{
			$sql = "INSERT INTO image
					(file_name, slug, profile_account_id)
					VALUES('15percent.jpg', 'discount', '".$new_profile_account_id."')";
			$i_res = $dbCustom->getResult($db,$sql);		
			$new_img_id = $db->insert_id;
		}

		$sql = "INSERT INTO discount 
			(img_id ,content, last_update, profile_account_id) 
			VALUES ('".$new_img_id."', 'Add Content', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO discount_how 
			(content, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		


		for($i = 1; $i < 6; $i++){	

			$sql = sprintf("INSERT INTO footer_nav-label (label, submenu_content_type, display_order, profile_account_id) 
			VALUES ('%s', '%u', '%u', '%u')", "Label".$i, 3, $i, $new_profile_account_id);
			$result = $dbCustom->getResult($db,$sql);
			
		}

		
		for($i = 1; $i < 5; $i++){	

			if($i == 1){
				$submenu_content_type = 1;
			}elseif($i == 2){
				$submenu_content_type = 2;
			}else{
				$submenu_content_type = 3;
			}
		
			$sql = sprintf("INSERT INTO navbar_label (label, submenu_content_type, display_order, profile_account_id) 
			VALUES ('%s', '%u', '%u', '%u')", "Label".$i, $submenu_content_type, $i, $new_profile_account_id);
			$result = $dbCustom->getResult($db,$sql);
			
		}

		$sql = "SELECT img_id FROM image WHERE file_name = 'dummy_image.jpg' AND profile_account_id = '".$new_profile_account_id."'"; 
		$img_res = $dbCustom->getResult($db,$sql);
		
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();		
			$new_img_id = $img_obj->img_id;
		}else{
			$sql = "INSERT INTO image
					(file_name, slug, profile_account_id)
					VALUES('dummy_image.jpg', 'home', '".$new_profile_account_id."')";
			$i_res = $dbCustom->getResult($db,$sql);
			$new_img_id = $db->insert_id;
		}

		$sql = "INSERT INTO home 
			(content, img_1_id, content_short3, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$new_img_id."', 'Add Content', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO image
				(file_name, slug, profile_account_id)
				VALUES('installation-banner-default.png', 'installation', '".$new_profile_account_id."')";
		$i_res = $dbCustom->getResult($db,$sql);
		$new_img_id = $db->insert_id;


		$sql = "INSERT INTO installation 
			(content, img_id,  profile_account_id) 
			VALUES ('Metrics content goes here', '".$new_img_id."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		
		$new_installation_id = $db->insert_id;

		$sql = "INSERT INTO installation_appearance 
				(installation_id
				,background_color
				,menu_color
				,header_background_color
				,header_text_color  
				,description_text_color) 
			VALUES ('".$new_installation_id."'
				,'#dce9f0'				
				,'#9ddef3'
				,'#c6c6c6'
				,'#000000'
				,'#2e6c81')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		for($i = 1; $i < 9; $i++){

			if($i == 1){ 
				$inst_step_name = 'Mark Line';
			}elseif($i == 2){ 
				$inst_step_name = 'Hang Rail';
			}elseif($i == 3){
				 $inst_step_name = 'Hang Verticals';
			}elseif($i == 4){
				 $inst_step_name = 'Adjust Brackets';
			}elseif($i == 5){
				 $inst_step_name = 'Tighten Cams';
			}elseif($i == 6){
				 $inst_step_name = 'Secure Cleats';
			}elseif($i == 7){
				 $inst_step_name = 'Drawers & Baskets';
			}else{
				 $inst_step_name = 'Shelves & Rails';
			}
			
			$inst_step_img = "installation-step-".$i."-default.png";
			$sql = "INSERT INTO image
					(file_name, slug, profile_account_id)
					VALUES('".$inst_step_img."', 'installation', '".$new_profile_account_id."')";
			$i_res = $dbCustom->getResult($db,$sql);			
			$new_img_id = $db->insert_id;
			
			$sql = "INSERT INTO installation_step
					(installation_id, img_id, name, display_order)
					VALUES
					('".$new_installation_id."', '".$new_img_id."', '".$inst_step_name."', '".$i."')";
			$i_res = $dbCustom->getResult($db,$sql);
			
			
		}
		
		
		for($i = 1; $i < 7; $i++){

			if($i == 1){ 
				$inst_tool_name = 'Screwdriver';
				$inst_tool_descr = 'Screws hold tighter and longer than nails, and require a screwdriver during closet installation';
				$inst_tool_img = 'tools-screwdriver.jpg';
			}elseif($i == 2){ 
				$inst_tool_name = 'Drill';
				$inst_tool_descr = 'A drill is extremely helpful while building a closet system';
				$inst_tool_img = 'tools-drill.jpg';
			}elseif($i == 3){ 
				$inst_tool_name = 'Stud Finder';
				$inst_tool_descr = 'Locates wall studs quickly while you are building a closet system';
				$inst_tool_img = 'tools-studfinder.jpg';
			}elseif($i == 4){ 
				$inst_tool_name = 'Level';
				$inst_tool_descr = 'Use a level to produce clean angles and build a closet system without wobble';
				$inst_tool_img = 'tools-level.jpg';
			}elseif($i == 5){ 
				$inst_tool_name = 'Tape Measure';
				$inst_tool_descr = 'A tape measure is necessary in building a closet system';
				$inst_tool_img = 'tools-tapemeasure.jpg';
			}else{
				$inst_tool_name = 'Pencil';
				$inst_tool_descr = 'Building a closet requires marking spots on the wall with a pencil';
				$inst_tool_img = 'tools-pencil.jpg';
			}

			$sql = "INSERT INTO image
					(file_name, slug, profile_account_id)
					VALUES('".$inst_tool_img."', 'installation', '".$new_profile_account_id."')";
			$i_res = $dbCustom->getResult($db,$sql);
			$new_img_id = $db->insert_id;

			$sql = "INSERT INTO installation_tool
					(installation_id, img_id, name, description)
					VALUES
					('".$new_installation_id."', '".$new_img_id."', '".$inst_tool_name."', '".$inst_tool_descr."')";
			$i_res = $dbCustom->getResult($db,$sql);

		}


		$sql = "INSERT INTO free_in_home_consults 
			(content, last_update, profile_account_id) 
			VALUES ('Add Content', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		


		$sql = "INSERT INTO privacy_statement 
			(content, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		


		$sql = "INSERT INTO process_category 
			(category_name , last_update, profile_account_id) 
			VALUES ('category 1', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		
		
		
		$sql = "INSERT INTO process 
			(content, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO process_page 
			(last_update, profile_account_id) 
			VALUES ('".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		
		$sql = "INSERT INTO policy 
			(last_update, profile_account_id) 
			VALUES ('".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO policy_page 
			(last_update, profile_account_id) 
			VALUES ('".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		


		$sql = "INSERT INTO we_design_fax 
			(last_update, profile_account_id) 
			VALUES ('".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "SELECT img_id FROM image WHERE file_name = 'usa_small.jpg' AND profile_account_id = '".$new_profile_account_id."'"; 
		$img_res = $dbCustom->getResult($db,$sql);
		
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();		
			$new_img_id = $img_obj->img_id;					
		}else{
			$sql = "INSERT INTO image
					(file_name, slug, profile_account_id)
					VALUES('usa_small.jpg', 'shipping_term', '".$new_profile_account_id."')";
			$i_res = $dbCustom->getResult($db,$sql);
			$new_img_id = $db->insert_id;
		}

		$sql = "INSERT INTO shipping_term 
			(img_id, content, last_update, profile_account_id) 
			VALUES ('".$new_img_id."', 'Add Content', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO shipping_time 
			(content, description, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', 'Add description', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO specs_content 
			(content, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "SELECT state, state_abr, country 
			FROM states 
			WHERE profile_account_id = '1'";
		$copy_res = $dbCustom->getResult($db,$sql);	 
		
		while($row = $copy_res->fetch_object()) {
			$sql = "INSERT INTO states
					(state
					,state_abr
					,country
					,profile_account_id
					)
					VALUES
					('".$row->state."'
					,'".$row->state_abr."'
					,'".$row->country."'
					,'".$new_profile_account_id."'
					)";
			
			$i_res = $dbCustom->getResult($db,$sql);
			
	
		}

		$sql = "INSERT INTO terms_of_use 
			(content, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		
		$sql = "INSERT INTO testimonial_page 
			(content, last_update, profile_account_id) 
			VALUES ('Metrics content goes here', '".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO downloads_page 
			(last_update, profile_account_id) 
			VALUES ('".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO feedback_page 
			(last_update, profile_account_id) 
			VALUES ('".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "INSERT INTO showroom 
			(last_update, profile_account_id) 
			VALUES ('".$ts."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);


		
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT img_id FROM image WHERE file_name = 'big_promo.png' AND profile_account_id = '".$new_profile_account_id."'"; 
		$img_res = $dbCustom->getResult($db,$sql);
		
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();		
			$new_img_id = $img_obj->img_id;
					
		}else{
			$sql = "INSERT INTO image
					(file_name, profile_account_id)
					VALUES('big_promo.png', '".$new_profile_account_id."')";
			$i_res = $dbCustom->getResult($db,$sql);		
			$new_img_id = $db->insert_id;
		}
		$sql = "INSERT INTO banner
					(img_id, section, profile_account_id)
				VALUES('".$new_img_id."', 'shop', '".$new_profile_account_id."')";
		$i_res = $dbCustom->getResult($db,$sql);		

		$sql = "INSERT INTO banner
					(img_id, section, profile_account_id)
				VALUES('".$new_img_id."', 'showroom', '".$new_profile_account_id."')";
		$i_res = $dbCustom->getResult($db,$sql);		

		$sql = "SELECT img_id FROM image WHERE file_name = 'Your-Category.jpg' AND profile_account_id = '".$new_profile_account_id."'"; 
		$img_res = $dbCustom->getResult($db,$sql);
		
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();
			$new_cat_img_id = $img_obj->img_id;					
		}else{
			$sql = "INSERT INTO image
					(file_name, profile_account_id)
					VALUES('dummy_cat.jpg', '".$new_profile_account_id."')";
			$i_res = $dbCustom->getResult($db,$sql);		
			$new_cat_img_id = $db->insert_id;
		}

			$sql = "SELECT img_id FROM image WHERE file_name = 'Your-Item.jpg' AND profile_account_id = '".$new_profile_account_id."'"; 
			$img_res = $dbCustom->getResult($db,$sql);
			
			if($img_res->num_rows > 0){
				$img_obj = $img_res->fetch_object($img_res);
				$new_item_img_id = $img_obj->img_id;					
			}else{
				$sql = "INSERT INTO image
						(file_name, profile_account_id)
						VALUES('dummy_item.jpg', '".$new_profile_account_id."')";
				$i_res = $dbCustom->getResult($db,$sql);
				$new_item_img_id = $db->insert_id;
			}



		for($i = 1; $i < 5; $i++){

			$sql = "INSERT INTO category
						(img_id
						,name
						,title
						,show_in_cart
						,show_in_showroom
						,profile_account_id
						)
					VALUES('".$new_cat_img_id."'
						,'Sample Category ".$i."'
						,'Sample Category ".$i."'
						,'1'
						,'1'
						,'".$new_profile_account_id."'
						)";
			$l_res = $dbCustom->getResult($db,$sql);	
			$new_top_cat_id = $db->insert_id;
	
	
			$sql = "INSERT INTO category
						(img_id
						,name
						,title
						,is_special
						,show_on_home_page
						,show_in_cart
						,show_in_showroom
						,profile_account_id
						)
					VALUES('".$new_cat_img_id."'
						,'Sample Sub Category ".$i."'
						,'Sample Sub Category ".$i."'
						,'1'
						,'1'
						,'1'
						,'1'
						,'".$new_profile_account_id."'
						)";
			$l_res = $dbCustom->getResult($db,$sql);	
			$new_cat_id = $db->insert_id;
	
			$sql = "INSERT INTO child_cat_to_parent_cat
						(child_cat_id
						,parent_cat_id
						)
					VALUES('".$new_cat_id."'
						,'".$new_top_cat_id."'
						)";
			$l_res = $dbCustom->getResult($db,$sql);
	
	
			$sql = "INSERT INTO item
						(img_id
						,name
						,show_in_cart
						,show_in_showroom
						,date_active
						,date_inactive
						,profile_account_id
						)
					VALUES('".$new_item_img_id."'
						,'Sample Item ".$i."'
						,'1'
						,'1'
						,NOW()
						,'3000-12-12 00:00:00'
						,'".$new_profile_account_id."'
						)";
			$l_res = $dbCustom->getResult($db,$sql);
			$new_item_id = $db->insert_id;
			
			$sql = "INSERT INTO item_to_category
					(item_id
					,cat_id
					)VALUES(
					'".$new_item_id."'
					,'".$new_cat_id."'
					)";
			$l_res = $dbCustom->getResult($db,$sql);

		}
		 
		
		
		$sql = "INSERT INTO vend_man
				(name
				,profile_account_id

				)VALUES(
				'Sample Vendor'
				,'".$new_profile_account_id."'
				)";
		$l_res = $dbCustom->getResult($db,$sql);
		
		$new_vend_man_id = $db->insert_id;

		$sql = "INSERT INTO brand
				(name
				,profile_account_id

				)VALUES(
				'Sample Brand'
				,'".$new_profile_account_id."'
				)";
		$l_res = $dbCustom->getResult($db,$sql);
		$new_brand_id = $db->insert_id;

		$sql = "INSERT INTO vend_man_brand
				(brand_id
				,vend_man_id
				)VALUES(
				'".$new_brand_id."'
				,'".$new_vend_man_id."'
				)";
		$l_res = $dbCustom->getResult($db,$sql);


		$sql = "UPDATE item 
			SET brand_id = '".$new_brand_id."'
			WHERE item_id = '".$new_item_id."'";
		$l_res = $dbCustom->getResult($db,$sql);

		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT domain_name
				FROM profile_account 
			WHERE id = '".$new_profile_account_id."'";
		$res = $dbCustom->getResult($db,$sql);
		
		if($res->num_rows){
			$object = $res->fetch_object();
			$new_domain = $object->domain_name;	
		}else{
			$new_domain = "noname".$new_profile_account_id;
		}

		if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/temp_uploads/')){
			mkdir($_SERVER['DOCUMENT_ROOT'].'/temp_uploads/');	
		}
      
		if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/user_uploads/'.$new_profile_account_id.'/')){
			mkdir($_SERVER['DOCUMENT_ROOT'].'/user_uploads/'.$new_profile_account_id.'/' , $mode = 0777 );
		}
		
		if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/saascustuploads/'.$new_profile_account_id.'/')){
			mkdir($_SERVER['DOCUMENT_ROOT'].'/saascustuploads/'.$new_profile_account_id.'/');	
		}


		if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/saascustuploads/'.$new_profile_account_id.'/cart/')){
			mkdir($_SERVER['DOCUMENT_ROOT'].'/saascustuploads/'.$new_profile_account_id.'/cart');	
		}
		
		if(!file_exists($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/cms/")){
			mkdir($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/cms");	
		}
		
		if(!file_exists($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/cms/large/")){
			mkdir($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/cms/large/");	
		}

		if(!file_exists($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/cms/doc/")){
			mkdir($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/cms/doc/");	
		}

		if(!file_exists($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/user/")){
			mkdir($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/user");	
		}
				
		$this->recurse_copy($_SERVER['DOCUMENT_ROOT']."/saascustuploads/sas_starter_cart/", $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/cart/");
		
		$this->recurse_copy($_SERVER['DOCUMENT_ROOT']."/saascustuploads/sas_starter_cms/", $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$new_profile_account_id."/");
		
	}


	function recurse_copy($src,$dst) { 
		$dir = opendir($src); 
		@mkdir($dst); 
		while(false !== ( $file = readdir($dir)) ) { 
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					$this->recurse_copy($src . '/' . $file,$dst . '/' . $file); 
				} 
				else { 
					copy($src . '/' . $file,$dst . '/' . $file); 
				} 
			} 
		} 
		closedir($dir); 
	} 



	function setSeoPageNames($new_profile_account_id)
	{
		$dbCustom = new DbCustom();
		
		if(!$this->isSeoPageNames($new_profile_account_id)){
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'social-network'
			,'social-network'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			



// ADDED
			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'free-in-home-consults'
			,'free-in-home-consults'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			

			
			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'checkout'
			,'checkout'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
					
			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'item-details'
			,'item-details'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			
			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'shopping-cart'
			,'shopping-cart'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			
			
			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'quick-installation'
			,'quick-installation'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
		
			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'installation'
			,'installation'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'showroom'
			,'our-showroom'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'specs'
			,'specs'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'process'
			,'process'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'testimonials'
			,'testimonials'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'email-design'
			,'email-design'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'give-testimonial'
			,'give-testimonial'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			
			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'we-design'
			,'we-design'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'we-design-fax'
			,'we-design-fax'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'shop'
			,'store'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'policies'
			,'policies'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'showroom-details'
			,'showroom-details'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'shipping-time'
			,'shipping-time'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'shipping'
			,'shipping'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'discounts'
			,'discounts'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'discounts-how'
			,'discounts-how'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'about-us'
			,'about-us'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'our-guarantee'
			,'our-guarantee'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			



			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'faq'
			,'faq'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'contact-us'
			,'contact-us'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'guides-and-tips'
			,'guides-and-tips'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'downloads'
			,'downloads'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'email-us'
			,'email-us'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'news'
			,'news'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'news-more'
			,'news-more'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'blog'
			,'blog'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'blog-more'
			,'blog-more'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'feedback'
			,'feedback'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'privacy-statement'
			,'privacy-statement'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'account'
			,'account'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'app'
			,'app'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'signup-form'
			,'signup-form'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'signup-form'
			,'signup-form'
			,'".$new_profile_account_id."'			
			)	
			";	
	$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'terms-of-use'
			,'terms-of-use'
			,'".$new_profile_account_id."'			
			)	
			";	
			$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'home'
			,'home'
			,'".$new_profile_account_id."'			
			)	
			";	
			$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'order-history'
			,'order-history'
			,'".$new_profile_account_id."'			
			)	
			";	
			$result = $dbCustom->getResult($db,$sql);			


			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'order-receipt'
			,'order-receipt'
			,'".$new_profile_account_id."'			
			)	
			";	
			$result = $dbCustom->getResult($db,$sql);			

			$sql = "
			INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'account-designs'
			,'account-designs'
			,'".$new_profile_account_id."'			
			)	
			";	
			$result = $dbCustom->getResult($db,$sql);			


		$sql = "INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'support'
			,'support'
			,'".$new_profile_account_id."'			
			)	
			";	
			$result = $dbCustom->getResult($db,$sql);			


		$sql = "INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'services'
			,'services'
			,'".$new_profile_account_id."'			
			)	
			";	
			$result = $dbCustom->getResult($db,$sql);			


		$sql = "INSERT INTO page_seo
			(
			page_name
			,seo_name
			,profile_account_id
			)VALUES(
			'solution-detail-view'
			,'solution-detail-view'
			,'".$new_profile_account_id."'			
			)	
			";	
			$result = $dbCustom->getResult($db,$sql);			



			// Set defoult breadcrumbs for account pages
			$sql = "SELECT page_seo_id
					FROM page_seo
					WHERE page_name = 'account'
					AND profile_account_id = '".$new_profile_account_id."'";
			$res = $dbCustom->getResult($db,$sql);
			
			if($res->num_rows){
				$obj = $res->fetch_object();
			
				$sql = "INSERT INTO bread_crumb
						(profile_account_id, text, page_seo_id, page, display_order)
						VALUES
						('".$new_profile_account_id."', 'Account Dashboard', '".$obj->page_seo_id."', 'order-history', '1')";
				$result = $dbCustom->getResult($db,$sql);
				

				$sql = "INSERT INTO bread_crumb
						(profile_account_id, text, page_seo_id, page, display_order)
						VALUES
						('".$new_profile_account_id."', 'Account Dashboard', '".$obj->page_seo_id."', 'order-receipt', '1')";
				$result = $dbCustom->getResult($db,$sql);
				

				$sql = "INSERT INTO bread_crumb
						(profile_account_id, text, page_seo_id, page, display_order)
						VALUES
						('".$new_profile_account_id."', 'Account Dashboard', '".$obj->page_seo_id."', 'account-designs', '1')";
				$result = $dbCustom->getResult($db,$sql);
				
			
			
				$sql = "INSERT INTO bread_crumb
						(profile_account_id, text, display_order, page)
						VALUES
						('".$new_profile_account_id."', 'Account Designs', '2', 'account-designs')";
				$result = $dbCustom->getResult($db,$sql);
				
			
				$sql = "INSERT INTO bread_crumb
						(profile_account_id, text, display_order, page)
						VALUES
						('".$new_profile_account_id."', 'Order History', '2', 'order-history')";
				$result = $dbCustom->getResult($db,$sql);
				
			
				$sql = "INSERT INTO bread_crumb
						(profile_account_id, text, display_order, page)
						VALUES
						('".$new_profile_account_id."', 'Order Receipt', '2', 'order-receipt')";
				$result = $dbCustom->getResult($db,$sql);
				

			}

		}
		
		
		$this->setSeoPageOptional($new_profile_account_id);

	}



	function setSeoPageOptional($new_profile_account_id)
	{
		$optional_pages_array = $this->getOptionalPageNames();

		

		if(sizeof($optional_pages_array) > 0){
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			foreach($optional_pages_array as $value){
				$sql = "UPDATE page_seo 
						SET optional = '1', available = '0'
						WHERE page_name = '".$value."'
						AND profile_account_id = '".$new_profile_account_id."'";	
				$result = $dbCustom->getResult($db,$sql);				
			}
		}
		
	}





	function isSeoPageNames($new_profile_account_id)
	{
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT page_seo_id FROM page_seo WHERE profile_account_id = '".$new_profile_account_id."'";	
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$ret = 1;	
		}else{
			$ret = 0;
		}
		
		return $ret;
	}

	
	
	
	function undoProfileSetup($profile_account_id)
	{
		$ts = time();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
				
		$sql = "DELETE FROM page_seo WHERE profile_account_id = '".$profile_account_id."'";	
		$result = $dbCustom->getResult($db,$sql);		

		$sql = "DELETE FROM logo WHERE profile_account_id = '".$profile_account_id."'"; 		
		$result = $dbCustom->getResult($db,$sql);		

		$sql = "DELETE FROM we_design 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);


		$sql = "DELETE FROM design_email_content 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM about_us 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);

		$sql = "DELETE FROM guarantee 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM company_info 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		


		$sql = "DELETE FROM contact_email_page 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM contact_us 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM discount 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM discount_how 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM footer_nav-label 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM footer_nav_submenu_label 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM navbar_label 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM navbar_submenu_label 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM home 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM free_in_home_consultation 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "SELECT installation_id FROM installation
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			
			$sql = "DELETE FROM installation_appearance 
					WHERE installation_id = '".$object->installation_id."'";
			$result = $dbCustom->getResult($db,$sql);
			
			
			$sql = "DELETE FROM installation_step
					WHERE installation_id = '".$object->installation_id."'";
			$result = $dbCustom->getResult($db,$sql);
			
			
			$sql = "DELETE FROM installation_tool
					WHERE installation_id = '".$object->installation_id."'";
			$result = $dbCustom->getResult($db,$sql);
			
						
			$sql = "DELETE FROM installation_link
					WHERE installation_id = '".$object->installation_id."'";
			$result = $dbCustom->getResult($db,$sql);
			
				
		}

		$sql = "DELETE FROM installation 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		
		$sql = "DELETE FROM installation_video
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM privacy_statement 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM policy 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM policy_page 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		


		$sql = "DELETE FROM process 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM process_category 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM process_page 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM downloads_page 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		


		$sql = "DELETE FROM shipping_term 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM shipping_time 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM specs_content 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM states 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM terms_of_use 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM testimonial_page 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM feedback_page 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		


		$sql = "DELETE FROM faq_category 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM faq 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM faq_page 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM guides_tips_page 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM guide_tip_category 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM guide_tip 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM we_design_fax 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM showroom 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);


		$sql = "DELETE FROM item_details 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);


		$sql = "DELETE FROM keyword_landing 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM image WHERE profile_account_id = '".$profile_account_id."'"; 		
		$result = $dbCustom->getResult($db,$sql);		

		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "DELETE FROM image WHERE profile_account_id = '".$profile_account_id."'"; 		
		$result = $dbCustom->getResult($db,$sql);		

		$sql = "SELECT cat_id FROM category 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		while($row = $result->fetch_object()){
			$sql = "DELETE FROM item_to_category 
					WHERE cat_id = '".$row->cat_id."'";
			
			$res = $dbCustom->getResult($db,$sql);	
		
		}

		$sql = "DELETE FROM category 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		$sql = "SELECT item_id
				FROM item
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		while($row = $result->fetch_object()){
			
			$sql = "DELETE FROM item_to_opt 
			WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);		
			
			$sql = "DELETE FROM item_to_kit 
					WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);
			
			$sql = "DELETE FROM item_to_kit 
					WHERE kit_item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM item_gallery 
					WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);
	
			$sql = "DELETE FROM item_rating 
					WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);
				
			$sql = "DELETE FROM item_review 
					WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);

			$sql = "DELETE FROM item_to_category 
					WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);	
		
			$sql = "DELETE FROM item_to_document 
					WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);
			
			$sql = "DELETE FROM item_to_media 
					WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);
			
			$sql = "DELETE FROM item_to_opt 
					WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);
								
			$sql = "DELETE FROM item_to_vend_man 
					WHERE item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);
			
		}


		$sql = "DELETE FROM item 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM attribute 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		$sql = "DELETE FROM banner 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		

		$sql = "DELETE FROM brand 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
	}


	function getOptionalPages($profile_account_id){

		$page_list_array = array();	
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	
		$sql = "SELECT * FROM page_seo 
		WHERE profile_account_id = '".$profile_account_id."'
		AND optional = '1'
		";
		$sql .= " ORDER BY page_name";

		$result = $dbCustom->getResult($db,$sql);
		
		$i = 0;
		
        while($row = $result->fetch_object()) {
			$page_list_array[$i]['available'] = $row->available;
			$page_list_array[$i]['page_name'] = $row->page_name;							
			$page_list_array[$i]['page_seo_id'] = $row->page_seo_id;
			$i++;
		}
		
		return $page_list_array;
	}


	function getOptionalPageNames(){

		$page_list_array = array();	
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	
		$sql = "SELECT DISTINCT page_name FROM page_seo 
		WHERE optional = '1'";
		$sql .= " ORDER BY page_name";
		$result = $dbCustom->getResult($db,$sql);
		
		$i = 0;
        while($row = $result->fetch_object()) {
			$page_list_array[$i] = $row->page_name;							
			$i++;
		}
		return $page_list_array;
	}



	function getAvailableNavPages($profile_account_id){

		$module = new Module;

		$page_list_array = array();	
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	
		
		$sql = "SELECT * FROM page_seo 
		WHERE profile_account_id = '".$profile_account_id."'
		AND available = '1'
		AND page_name != 'checkout'
		AND page_name != 'default'
		AND page_name != 'blog-more'
		AND page_name != 'account'
		AND page_name != 'order-history'
		AND page_name != 'order-receipt'
		AND page_name != 'account-designs'
		AND page_name != 'app'
		AND page_name != 'news'
		AND page_name != 'news-more'
		AND page_name != 'signup-form'
		AND page_name != 'signin-form'
		AND page_name != 'social-network-about'
		AND page_name != 'social-network-answer'
		AND page_name != 'social-network-answers'
		AND page_name != 'social-network-before-after'
		AND page_name != 'social-network-blog'
		AND page_name != 'social-network-blog-article'
		AND page_name != 'social-network-gallery'
		AND page_name != 'social-network-members'
		AND page_name != 'social-network-profile'
		AND page_name != 'social-network-results'
		AND page_name != 'shop'
		AND page_name != 'store'
		AND page_name != 'showroom-details'
		AND page_name != 'give-testimonial'
		AND page_name != 'search-results'";

		$sql .= " ORDER BY page_name";

		$result = $dbCustom->getResult($db,$sql);
		
		
		$i = 0;
		
        while($row = $result->fetch_object()) {
			if(!$module->hasSeoModule($profile_account_id)){
				$page_list_array[$i]["visible_name"] = $row->seo_name;			
			}else{
				$page_list_array[$i]["visible_name"] = $row->page_name;							
			}
			$page_list_array[$i]["page_seo_id"] = $row->page_seo_id;
			$i++;
		}
		return $page_list_array;
	}


	function getPageSeoUrls($profile_account_id, $require_active = 1){

	
		$module = new Module;
		
		$page_url_array = array();	

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

        $sql = "SELECT seo_name FROM page_seo 
		WHERE profile_account_id = '".$profile_account_id."'
		AND page_name != 'checkout'
		AND page_name != 'shopping-cart'
		AND page_name != 'account'
		AND page_name != 'order-history'
		AND page_name != 'order-receipt'
		AND page_name != 'account-designs'
		AND page_name != 'default'
		AND page_name != 'home'
		AND page_name != 'news'
		AND page_name != 'news-more'
		AND page_name != 'blog-more'		
		AND page_name != 'shop'
		AND page_name != 'showroom'
		AND page_name != 'showroom-details'
		AND page_name != 'signup-form'
		AND page_name != 'signin-form'
		AND page_name != 'social-network'
		AND page_name != 'social-network-about'
		AND page_name != 'social-network-answer'
		AND page_name != 'social-network-answers'
		AND page_name != 'social-network-before-after'
		AND page_name != 'social-network-blog'
		AND page_name != 'social-network-blog-article'
		AND page_name != 'social-network-gallery'
		AND page_name != 'social-network-members'
		AND page_name != 'social-network-profile'
		AND page_name != 'social-network-results'
		AND page_name != 'search-results'";
		
		if($require_active){
			$sql .= "AND active = '1'";
		}

		if(!$module->hasDesignServicesModule($profile_account_id)){
			$sql = "AND page_name != 'we-design-fax'
					AND page_name != 'email-design'
					AND page_name != 'we-design'";	
		}

		$result = $dbCustom->getResult($db,$sql);
        
		$i = 0;
        while($row = $result->fetch_object()) {
			$page_url_array[$i] = $row->seo_name;
			$i++;
		}

		return $page_url_array;

	

	}	


	function getPageListArray($profile_account_id)
	{
		

		$module = new Module;	

		$page_list_array = array();	
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	
        $sql = "SELECT max(home_id) AS id FROM home 
		WHERE profile_account_id = '".$profile_account_id."'";
		
		$p_res = $dbCustom->getResult($db,$sql);
		$p_obj = $p_res->fetch_object();
		
		
		$page_list_array[0]["page_id"] = $p_obj->id;
		$page_list_array[0]["page_manage_path"] = "home.php?home_id=".$p_obj->id;							
		$page_list_array[0]['page_name'] = "home";
		$page_list_array[0]['url'] = "/home.html";							
		$page_list_array[0]["active"] = 1;
		$page_list_array[0]["optional"] = 0;
		$page_list_array[0]["available"] = 1;
		$page_list_array[0]['mssl'] = 0;

        $sql = "SELECT * FROM page_seo 
		WHERE profile_account_id = '".$profile_account_id."'
		AND added_page_id = '0'		
		AND page_name != 'order-history'
		AND page_name != 'order-receipt'
		AND page_name != 'app'
		AND page_name != 'blog-more'
		AND page_name != 'checkout'
		AND page_name != 'default'
		AND page_name != 'email-us'
		AND page_name != 'give-testimonial'
		AND page_name != 'news'
		AND page_name != 'news-more'
		AND page_name != 'quick-installation'
		AND page_name != 'shop'
		AND page_name != 'showroom-details'
		AND page_name != 'signup-form'
		AND page_name != 'social-network'
		AND page_name != 'social-network-about'
		AND page_name != 'social-network-answer'
		AND page_name != 'social-network-answers'
		AND page_name != 'social-network-before-after'
		AND page_name != 'social-network-blog'
		AND page_name != 'social-network-blog-article'
		AND page_name != 'social-network-gallery'
		AND page_name != 'social-network-members'
		AND page_name != 'social-network-profile'
		AND page_name != 'social-network-results'
		AND page_name != 'signin-form'
		AND page_name != 'search-results'
		AND page_name != 'email-design'";

		$sql .= "ORDER BY page_name";

		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
		$result = $dbCustom->getResult($db,$sql);

		
		$i = 1;
        while($row = $result->fetch_object()) {
	
			if(!$module->hasSeoModule($profile_account_id)){
				$page_list_array[$i]['url'] = "/".$row->seo_name.".html";			
			}else{
				$page_list_array[$i]['url'] = "/".$row->page_name.".html";							
			}

			$page_list_array[$i]["optional"] = $row->optional;
			$page_list_array[$i]["available"] = $row->available;
			
			$page_list_array[$i]["active"] = $row->active;
			$page_list_array[$i]["page_seo_id"] = $row->page_seo_id;
			$page_list_array[$i]["page_id"] = 0;
			$page_list_array[$i]["page_manage_path"] = '';							
			$page_list_array[$i]['page_name'] = $row->page_name;

			$page_list_array[$i]['mssl'] = $row->mssl;







			if($row->page_name == 'support'){
		        $sql = "SELECT max(support_id) AS id FROM support 
				WHERE profile_account_id = '".$profile_account_id."'";
				
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					
					$p_obj = $p_res->fetch_object();
					
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "support.php?support_id=".$page_id;							

			}


	
			if($row->page_name == 'services'){
		        $sql = "SELECT max(services_id) AS id FROM services 
				WHERE profile_account_id = '".$profile_account_id."'";
				
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					
					$p_obj = $p_res->fetch_object();
					
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "services.php?services_id=".$page_id;							

			}



			if($row->page_name == 'solution-detail-view'){
		        
				$sql = "SELECT max(solution_detail_view_id) AS id FROM solution_detail_view 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					
					$p_obj = $p_res->fetch_object();
					
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "solution-detail-view.php?solution_detail_view_id=".$page_id;							
			}



			if($row->page_name == 'diy-instructions'){
		        $sql = "SELECT max(diy_instructions_id) AS id FROM diy_instructions 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					
					$p_obj = $p_res->fetch_object();
					
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "diy-instructions.php?diy_instructions_id=".$page_id;							

			}


			if($row->page_name == 'fax-a-design-plan'){
				
		        $sql = "SELECT max(fax_a_design_plan_id) AS id FROM fax_a_design_plan 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "fax-a-design-plan.php?fax_a_design_plan_id=".$page_id;							

			}


			if($row->page_name == 'we-design'){
				
		        $sql = "SELECT max(we_design_id) AS id FROM we_design 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "we-design.php?we_design_id=".$page_id;							

			}

			if($row->page_name == 'about-us'){
		        $sql = "SELECT max(about_us_id) AS id FROM about_us 
				WHERE profile_account_id = '".$profile_account_id."'";
				
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					
					$p_obj = $p_res->fetch_object();
					
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "about-us.php?about_us_id=".$page_id;							

			}
			

			if($row->page_name == 'free-in-home-consults'){
		        $sql = "SELECT max(free_in_home_consults_id) AS id FROM free_in_home_consults 
				WHERE profile_account_id = '".$profile_account_id."'";
				
				$p_res = $dbCustom->getResult($db,$sql);



				if($p_res->num_rows > 0){
					
					$p_obj = $p_res->fetch_object();
					
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "free-in-home-consults.php?free_in_home_consults_id=".$page_id;							

			}
			
			
			if($row->page_name == 'our-guarantee'){
		        $sql = "SELECT max(guarantee_id) AS id FROM guarantee 
				WHERE profile_account_id = '".$profile_account_id."'";
				
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					
					$p_obj = $p_res->fetch_object();
					
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "our-guarantee.php?guarantee_id=".$page_id;							

			}


			if($row->page_name == 'contact-us'){
		        $sql = "SELECT max(contact_us_id) AS id FROM contact_us 
				WHERE profile_account_id = '".$profile_account_id."'";
				
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "contact-us.php?contact_us_id=".$page_id;							

			}
			
			if($row->page_name == 'discounts'){
		        $sql = "SELECT max(discount_id) AS id FROM discount 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "discount.php?discount_id=".$page_id;							

			}

			if($row->page_name == 'discounts-how'){
		        $sql = "SELECT max(discount_how_id) AS id FROM discount_how 
				WHERE profile_account_id = '".$profile_account_id."'";
				
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "discount-how.php?discount_how_id=".$page_id;							

			}

			if($row->page_name == 'downloads'){
		        $sql = "SELECT max(downloads_page_id) AS id FROM downloads_page 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "downloads-page.php?downloads_page_id=".$page_id;							

			}
			
			if($row->page_name == "guides-and-tips"){
		        
		        $sql = "SELECT max(guides_tips_page_id) AS id FROM guides_tips_page 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "guides-tips.php?guides_tips_page_id=".$page_id;							

			}
			

			if($row->page_name == 'diy-instructions'){
		        $sql = "SELECT max(diy_instructions_id) AS id FROM diy_instructions 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "diy-instructions.php?diy_instructions_id=".$page_id;							

			}
			

			if($row->page_name == 'privacy-statement'){
		        $sql = "SELECT max(privacy_statement_id) AS id FROM privacy_statement 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "privacy-statement.php?privacy_statement_id=".$page_id;							
				
			}



			if($row->page_name == 'policies'){
		        $sql = "SELECT max(policy_page_id) AS id FROM policy_page 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "policy.php?policy_page_id=".$page_id;							

			}

			if($row->page_name == 'shipping'){
		        $sql = "SELECT max(shipping_term_id) AS id FROM shipping_term 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "shipping-term.php?shipping_term_id=".$page_id;	
			}

			if($row->page_name == 'shipping-time'){
		        $sql = "SELECT max(shipping_time_id) AS id FROM shipping_time 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "shipping-time.php?shipping_time_id=".$page_id;							

			}

			if($row->page_name == 'specs'){
		        $sql = "SELECT max(specs_content_id) AS id FROM specs_content 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "specs.php?specs_content_id=".$page_id;							

			}



			if($row->page_name == 'terms-of-use'){
		        $sql = "SELECT max(terms_of_use_id) AS id FROM terms_of_use 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "terms-of-use.php?terms_of_use_id=".$page_id;							

			}

			if($row->page_name == 'testimonials'){
		        $sql = "SELECT max(testimonial_page_id) AS id FROM testimonial_page
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "testimonial-page.php?testimonial_page_id=".$page_id;							

			}

			if($row->page_name == 'showroom'){
		        $sql = "SELECT max(showroom_id) AS id FROM showroom
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "showroom.php?showroom_id=".$page_id;							

			}




			if($row->page_name == 'faq'){
		        $sql = "SELECT max(faq_page_id) AS id FROM faq_page 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "faq.php?faq_page_id=".$page_id;							

			}


			if($row->page_name == 'process'){
				
		        $sql = "SELECT max(process_page_id) AS id FROM process_page 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				
				$page_id = $p_res->num_rows;
				
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]['page_manage_path'] = "process.php?process_page_id=".$page_id;							
			}

			
			if($row->page_name == "feedback"){
		        $sql = "SELECT max(feedback_page_id) AS id FROM feedback_page 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_id = $p_obj->id;	
				}else{
					$page_id = 0;
				}
				$page_list_array[$i]['page_id'] = $page_id;
				$page_list_array[$i]["page_manage_path"] = "feedback-page.php?feedback_page_id=".$page_id;							

			}

	
			if($row->page_name == "blog"){
				$page_list_array[$i]["page_id"] = 0;
				// No edit page yet
				$page_list_array[$i]["page_manage_path"] = "blog_page_id=".$p_obj->id;							

			}

			if($row->page_name == "shopping-cart"){
				$page_list_array[$i]["page_id"] = 0;
				// No edit page yet
				$page_list_array[$i]["page_manage_path"] = "shopping-cart_id=".$p_obj->id;							

			}


			$i++;


		}



		$added_page_seo_id = 0;
		$added_page_active = "none";
		$added_page_ssl = 0;
		$this->resetPagesSession();

		$sql = "SELECT page_name, added_page_id 
				FROM added_page
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		while($row = $result->fetch_object()) {


			foreach($_SESSION["pages"] as $p_val){
				
				if($p_val['page_name'] == $row->page_name){						
					$added_page_seo_id = $p_val["page_seo_id"];
					$added_page_active = $p_val["active"];
					$added_page_ssl = $p_val["ssl"];
				}
			}		

			$page_list_array[$i]['url'] = "/".$row->page_name.".html";									
			$page_list_array[$i]["active"] = $added_page_active; 
			$page_list_array[$i]["page_seo_id"] = $added_page_seo_id;
			$page_list_array[$i]["page_id"] = $row->added_page_id;
			$page_list_array[$i]['page_name'] = $row->page_name;
			$page_list_array[$i]["page_manage_path"] = $ste_root."manage/cms/custom-pages/added-page.php?added_page_id=".$row->added_page_id;							
			$page_list_array[$i]["optional"] = 0;
			$page_list_array[$i]["available"] = 1;
			$page_list_array[$i]['mssl'] = $added_page_ssl;

			$i++;

		}

		return $page_list_array;

		//return array();
	}

	

	function getPageDesignListArray($profile_account_id)
	{
		
		$module = new Module;	

		$page_list_array = array();	
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	

        $sql = "SELECT * FROM page_seo 
		WHERE profile_account_id = '".$profile_account_id."'
		AND added_page_id = '0'		
		AND (page_name = 'email-design'
		OR page_name = 'we-design-fax'
		OR page_name = 'free-in-home-consults'
		OR page_name = 'design'	
		)";
		$sql .= "ORDER BY page_name";

		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
        $result = $dbCustom->getResult($db,$sql);        
		$i = 0;
        while($row = $result->fetch_object()) {
		
			if(!$module->hasSeoModule($profile_account_id)){
				$page_list_array[$i]['url'] = "/".$row->seo_name.".html";			
			}else{
				$page_list_array[$i]['url'] = "/".$row->page_name.".html";							
			}

			$page_list_array[$i]["optional"] = $row->optional;
			$page_list_array[$i]["available"] = $row->available;
			
			$page_list_array[$i]["active"] = $row->active;
			$page_list_array[$i]["page_seo_id"] = $row->page_seo_id;
			$page_list_array[$i]["page_id"] = 0;
			$page_list_array[$i]["page_manage_path"] = '';							
			$page_list_array[$i]['page_name'] = $row->page_name;

			$page_list_array[$i]['mssl'] = $row->mssl;
			
			if($row->page_name == "free-in-home-consults"){
		        $sql = "SELECT max(free_in_home_consults_id) AS id FROM free_in_home_consults 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				$p_obj = $p_res->fetch_object();
				$page_list_array[$i]["page_id"] = $p_obj->id;
				$page_list_array[$i]["page_manage_path"] = "free-in-home-consults.php?free_in_home_consults_id=".$p_obj->id;							

			}

			if($row->page_name == "email-design"){
		        $sql = "SELECT max(design_email_content_id) AS id FROM design_email_content 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				if($p_res->num_rows > 0){
					$p_obj = $p_res->fetch_object();
					$page_list_array[$i]["page_id"] = $p_obj->id;
					$page_list_array[$i]["page_manage_path"] = "design-email-content.php?design_email_content_id=".$p_obj->id;							
				}else{
					$page_list_array[$i]['page_id'] = 1;
					$page_list_array[$i]["page_manage_path"] = "design-email-content.php?design_email_content_id=1";
				}
			}

			if($row->page_name == "we-design-fax"){
				
				
		        $sql = "SELECT max(we_design_fax_id) AS id FROM we_design_fax 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				$p_obj = $p_res->fetch_object();
				$page_list_array[$i]["page_id"] = $p_obj->id;
				$page_list_array[$i]["page_manage_path"] = "we-design-fax.php?we_design_fax_id=".$p_obj->id;							

			}


			if($row->page_name == "we-design"){
		        $sql = "SELECT max(we_design_id) AS id FROM we_design 
				WHERE profile_account_id = '".$profile_account_id."'";
				$p_res = $dbCustom->getResult($db,$sql);
				
				$p_obj = $p_res->fetch_object();
				$page_list_array[$i]["page_id"] = $p_obj->id;
				$page_list_array[$i]["page_manage_path"] = "we-design.php?we_design_id=".$p_obj->id;							
			}

			$i++;
		}

		return $page_list_array;

	}

	function resetPagesSession(){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$_SESSION["pages"] = array();
		$sql = "SELECT page_seo_id, page_name, seo_name, mssl, active  
				FROM page_seo
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY page_name
				";		 		
		$res = $dbCustom->getResult($db,$sql);
		
		$i = 0;			
		while($row = $res->fetch_object()){
			$_SESSION["pages"][$i]['page_name'] = $row->page_name;
			$_SESSION["pages"][$i]['seo_name'] = $row->seo_name;
			$_SESSION["pages"][$i]["page_seo_id"] = $row->page_seo_id;
			$_SESSION["pages"][$i]["ssl"] = $row->mssl;
			$_SESSION["pages"][$i]["active"] = $row->active;

			$i++;
		}	
	}


}
?>