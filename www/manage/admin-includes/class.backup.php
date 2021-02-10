<?php


class Backup{
	 
	function doBackup($content_record_id, $user_id, $table, $action = "backup"){
		
		$ts = time();	
	
		if($table == "showroom_item"){
			$db = $dbCustom->getDbConnect(SHOWROOM_DATABASE);
			$sql = "SELECT * FROM showroom_item 
			WHERE showroom_item_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$sql = sprintf("INSERT INTO backup (content_table, 
									when_backed, 
									backed_by_login_id,
									slug,
									price,
									percent_off,
									content_short1, 
									content1,
									content_record_id,
									alt_cat_id,
									cat_id, 
									img_id) 
						VALUES ('%s','%u','%u','%s','%f','%u','%s','%s','%u','%u','%u','%u')", 
						"showroom_item", 
						$ts, 
						$user_id, 
						"showroom-item",
						$ex_object->price,
						$ex_object->percent_off,
						addslashes($ex_object->name), 
						addslashes($ex_object->description), 
						$ex_object->showroom_item_id, 
						$ex_object->showroom_cat_id,
						$ex_object->showroom_sub_cat_id, 
						$ex_object->img_id);
			$bu_result = mysql_query($sql);
		}


		if($table == "accessory_item"){
			$db_selected = dbSelect(ACCESSORY_DATABASE);
			$sql = "SELECT * FROM accessory_item WHERE accessory_item_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$sql = sprintf("INSERT INTO backup (content_table, 
									when_backed, 
									backed_by_login_id,
									slug,
									price_flat,
									price_wholesale,
									percent_markup,
									percent_off,
									content_short1, 
									content1,
									content_record_id,
									alt_cat_id,
									cat_id, 
									img_id) 
						VALUES ('%s','%u','%u','%s','%f','%f','%u','%u','%s','%s','%u','%u','%u','%u')", 
						"showroom_item", 
						$ts, 
						$user_id, 
						"showroom-item",
						$ex_object->price_flat,
						$ex_object->price_wholesale,
						$ex_object->percent_markup,
						$ex_object->percent_off,
						addslashes($ex_object->name), 
						addslashes($ex_object->description), 
						$ex_object->showroom_item_id, 
						$ex_object->showroom_cat_id,
						$ex_object->showroom_sub_cat_id, 
						$ex_object->img_id);
			$bu_result = mysql_query($sql);
		}


		if($table == "added_page"){

			$sql = "SELECT * FROM added_page WHERE added_page_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
									when_backed, 
									backed_by_login_id,
									slug,
									content1,
									content_short1,  
									content_short2, 
									content_short3, 
									content_record_id,
									action)
						VALUES ('%s','%u','%u','%s','%s','%s','%s','%s','%u','%s')", 
						"added_page", 
						$ts, 
						$user_id, 
						"added-page", 
						addslashes($ex_object->content), 
						addslashes($ex_object->page_name), 
						addslashes($ex_object->page_title),
						$ex_object->page_cat,
						$ex_object->added_page_id,
						$action);		
			$bu_result = mysql_query($sql);			
		}



		if($table == "about_us"){
			
			$sql = "SELECT * FROM about_us WHERE about_us_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
									when_backed, 
									backed_by_login_id,
									slug,
									content1,
									img_id,  
									content_record_id)
						VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
						"about_us", 
						$ts, 
						$user_id, 
						"about-us", 
						addslashes($ex_object->content), 
						$ex_object->img_id, 
						$ex_object->about_us_id);		
			$bu_result = mysql_query($sql);			
	
		}

		if($table == "testimonial"){

			$sql = "SELECT * FROM testimonial WHERE testimonial_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			
			//echo $ex_object->order; exit;
			
			$sql = sprintf("INSERT INTO backup (content_table, 
									when_backed, 
									backed_by_login_id,
									slug,
									content1,
									content_short1,
									content_short2,
									content_short3,
									list_order,
									hide,  
									content_record_id)
						VALUES ('%s','%u','%u','%s','%s','%s','%s','%s','%u','%u','%u')", 
						"testimonial", 
						$ts, 
						$user_id, 
						"testimonial", 
						addslashes($ex_object->content),
						addslashes($ex_object->name),
						addslashes($ex_object->email),
						addslashes($ex_object->city_state), 
						$ex_object->list_order,
						$ex_object->hide, 
						$ex_object->testimonial_id);	


			//echo $sql; exit;


			$bu_result = mysql_query($sql);			

		}


		if($table == "testimonial_page"){

			$sql = "SELECT * FROM testimonial_page WHERE testimonial_page_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										img_id,  
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
							"testimonial_page", 
							$ts, 
							$user_id, 
							"testimonial-page", 
							addslashes($ex_object->content),
							$ex_object->img_id, 
							$ex_object->testimonial_page_id);		
			$bu_result = mysql_query($sql);			

		}

		if($table == "discount_how"){

			$sql = "SELECT * FROM discount_how WHERE discount_how_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										img_id,  
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
							"discount_how", 
							$ts, 
							$user_id, 
							"discount-how", 
							addslashes($ex_object->content),
							$ex_object->img_id, 
							$ex_object->discount_how_id);		
			$bu_result = mysql_query($sql);		

		}

		if($table == "discount"){

			$sql = "SELECT * FROM discount WHERE discount_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										img_id,  
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
							"discount", 
							$ts, 
							$user_id, 
							"discount", 
							addslashes($ex_object->content),
							$ex_object->img_id, 
							$ex_object->discount_id);		
			$bu_result = mysql_query($sql);		

		}

		if($table == "shipping_time"){

			$sql = "SELECT * FROM shipping_time WHERE shipping_time_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content_short1,
										content1,
										img_id,  
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%s','%u','%u')", 
							"shipping_time", 
							$ts, 
							$user_id, 
							"shipping-time",
							addslashes($ex_object->description), 
							addslashes($ex_object->content),
							$ex_object->img_id, 
							$ex_object->shipping_time_id);		
			$bu_result = mysql_query($sql);		

		}

		if($table == "shipping_term"){

			$sql = "SELECT * FROM shipping_term WHERE shipping_term_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										img_id,  
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
							"shipping_term", 
							$ts, 
							$user_id, 
							"shipping-term", 
							addslashes($ex_object->content),
							$ex_object->img_id, 
							$ex_object->shipping_term_id);		
			$bu_result = mysql_query($sql);		

		}

		if($table == "policy_category"){

			$sql = "SELECT * FROM policy_category WHERE policy_cat_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content_short1,  
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%s','%u','%s')", 
							"policy_category", 
							$ts, 
							$user_id, 
							"policy-category", 
							addslashes($ex_object->category_name),
							$ex_object->policy_cat_id,
							$action);		
			$bu_result = mysql_query($sql);		

		}
		
		if($table == "policy"){

			$sql = "SELECT * FROM policy WHERE policy_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										cat_id,
										content1,
										img_id,  
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%u','%s','%u','%u','%s')", 
							"policy", 
							$ts, 
							$user_id, 
							"policy",
							$ex_object->policy_cat_id,
							addslashes($ex_object->content),
							$ex_object->img_id,
							$ex_object->policy_id,
							$action);		
			$bu_result = mysql_query($sql);		

		}
		
		if($table == "process_category"){

			$sql = "SELECT * FROM process_category WHERE process_cat_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content_short1,
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%s','%u','%s')", 
							"process_category", 
							$ts, 
							$user_id, 
							"process-category",
							addslashes($ex_object->category_name),
							$ex_object->process_cat_id,
							$action);		
			$bu_result = mysql_query($sql);		

		}

		if($table == "process"){

			$sql = "SELECT * FROM process WHERE process_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										cat_id,
										content1,
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%u','%s','%u','%s')", 
							"process", 
							$ts, 
							$user_id, 
							"process",
							$ex_object->process_cat_id,
							addslashes($ex_object->content),
							$ex_object->process_id,
							$action);		
			$bu_result = mysql_query($sql);		

		}
	
		if($table == "faq_category"){

			$sql = "SELECT * FROM faq_category WHERE faq_cat_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content_short1,
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%s','%u','%s')", 
							"faq_category", 
							$ts, 
							$user_id, 
							"faq-category",
							addslashes($ex_object->category_name),
							$ex_object->faq_cat_id,
							$action);		
			$bu_result = mysql_query($sql);		

		
		}


		if($table == "faq"){

			$sql = "SELECT * FROM faq WHERE faq_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			
			//var_dump($ex_object);
			//echo $content_record_id;
			//exit;
			
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										content2,
										cat_id,
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%s','%s','%u','%u','%s')", 
							"faq", 
							$ts, 
							$user_id, 
							"faq",
							addslashes($ex_object->question),
							addslashes($ex_object->answere),
							$ex_object->faq_cat_id,
							$ex_object->faq_id,
							$action);		
			$bu_result = mysql_query($sql);		

		}


		if($table == "contact_us"){

			$sql = "SELECT * FROM contact_us WHERE contact_us_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content_short1,
										content_short2,
										content_short3,
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%s','%s','%u')", 
							"contact_us", 
							$ts, 
							$user_id, 
							"contact-us",
							addslashes($ex_object->address),
							addslashes($ex_object->phone),
							addslashes($ex_object->fax),
							$ex_object->contact_us_id);		
			$bu_result = mysql_query($sql);		

		}


		if($table == "contact_email_page"){

			$sql = "SELECT * FROM contact_email_page WHERE contact_email_page_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										content2,
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%s','%u')", 
							"contact_email_page", 
							$ts, 
							$user_id, 
							"contact-email-page",
							addslashes($ex_object->content1),
							addslashes($ex_object->content2),
							$ex_object->contact_email_page_id);		
			$bu_result = mysql_query($sql);		

		}

		
		if($table == "guide_tip_category"){

			$sql = "SELECT * FROM guide_tip_category WHERE guide_tip_cat_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content_short1,
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%s','%u','%s')", 
							"guide_tip_category", 
							$ts, 
							$user_id, 
							"guide-tip-category",
							addslashes($ex_object->category_name),
							$ex_object->guide_tip_cat_id,
							$action);		
			$bu_result = mysql_query($sql);		

		}
		
		if($table == "guide_tip"){

			$sql = "SELECT * FROM guide_tip WHERE guide_tip_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										cat_id,
										content1,
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%u','%s','%u','%s')", 
							"guide_tip", 
							$ts, 
							$user_id, 
							"guides-tips",
							$ex_object->guide_tip_cat_id,
							addslashes($ex_object->content),
							$ex_object->guide_tip_id,
							$action);		
			$bu_result = mysql_query($sql);		
		}

		if($table == "terms_of_use"){

			$sql = "SELECT * FROM terms_of_use WHERE terms_of_use_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%u')", 
							"terms_of_use", 
							$ts, 
							$user_id, 
							"terms-of-use",
							addslashes($ex_object->content),
							$ex_object->terms_of_use_id);		
			$bu_result = mysql_query($sql);		
			
		}

		if($table == "privacy_statement"){

			$sql = "SELECT * FROM privacy_statement WHERE privacy_statement_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%u')", 
							"privacy_statement", 
							$ts, 
							$user_id, 
							"privacy-statement",
							addslashes($ex_object->content),
							$ex_object->privacy_statement_id);		
			$bu_result = mysql_query($sql);		
			
		}

		if($table == "in_home_consultation"){

			$sql = "SELECT * FROM in_home_consultation WHERE in_home_consultation_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										content_record_id)
							VALUES ('%s','%u','%u','%s','%s','%u')", 
							"in_home_consultation", 
							$ts, 
							$user_id, 
							"in-home-consultation",
							addslashes($ex_object->content),
							$ex_object->in_home_consultation_id);		
			$bu_result = mysql_query($sql);		
			
		}

		if($table == "link"){

			$sql = "SELECT * FROM link WHERE link_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content_short1,
										content_short2,
										content_short3,
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%s','%s','%s','%u','%s')", 
							"link", 
							$ts, 
							$user_id, 
							"link",
							addslashes($ex_object->url),
							addslashes($ex_object->link_text),
							addslashes($ex_object->page),
							$ex_object->link_id,
							$action);		
			$bu_result = mysql_query($sql);		
			
		}

		if($table == "news"){

			$sql = "SELECT * FROM news WHERE news_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										content_short2,
										list_order,
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%s','%s','%u','%u','%s')", 
							"news", 
							$ts, 
							$user_id, 
							"news",
							addslashes($ex_object->content),
							$ex_object->type,
							$ex_object->list_order,
							$ex_object->news_id,
							$action);		
			$bu_result = mysql_query($sql);		
			
		}

		if($table == "blog_post"){

			$sql = "SELECT * FROM blog_post WHERE blog_post_id = '".$content_record_id."'";			
			$ex_result = mysql_query($sql);
			$ex_object =  mysql_fetch_object($ex_result);
			$sql = sprintf("INSERT INTO backup (content_table, 
										when_backed, 
										backed_by_login_id,
										slug,
										content1,
										content_short1,
										content_short2,
										cat_id,
										alt_cat_id,
										alt_when,
										content_record_id,
										action)
							VALUES ('%s','%u','%u','%s','%s','%s','%s','%u','%u','%u','%u','%s')", 
							"blog_post", 
							$ts, 
							$user_id, 
							"blog_post",
							addslashes($ex_object->content),
							$ex_object->title,
							$ex_object->substitute_by,
							$ex_object->blog_cat_id,
							$ex_object->user_id,
							$ex_object->when_posted,
							$ex_object->blog_post_id,
							$action);		
			$bu_result = mysql_query($sql);		
			
		}






		
		if(!$bu_result)die(mysql_error());
		$ret =  (!$bu_result) ? 0 : 1;
		return $ret;		
		
	}
	
	
}
?>