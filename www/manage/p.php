<?php


if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

//require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

date_default_timezone_set('America/Vancouver');

$ts = time();

$db_now = date('Y-m-d h:i:s');


$db = new mysqli("localhost", "buyclose_ctg", "toroman1A", "buyclose_ctg");

//$db = mysql_connect("localhost", "buyclose_ctg", "toroman1A");


		if($db->connect_errno > 0){
			die('Unable to connect to database [' . $db->connect_error . ']');
			exit;
		}	

$sql = "SELECT * FROM customer_data";

		if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
				return 0;
		}

echo $result->num_rows;

$db = new mysqli("localhost", "bridgepo", "bridgep01A", "bridgepo_USERS");
	
//$db = new mysqli("localhost", "otgtotes_otg", "z018ZrKzHb", "otgtotes_USERS");

/*
$sql = "DELETE FROM user WHERE id > '3570'";
$res = $db->query($sql);

$sql = "DELETE FROM customer_data WHERE user_id > '3570'";
$res = $db->query($sql);
*/
//exit;


while($row = $result->fetch_object()){


	
	
		$sql = "SELECT id FROM user 
			WHERE username = '".$row->email."'
			AND profile_account_id = '1'";
			
		$res = $db->query($sql);
		
		if($res->num_rows == 0){
	
	
			echo $row->email;
			echo "<br />";
			
			$tmp_password = 'akmerkez';
	
			$salt = sha1(uniqid(rand()));
			$hash = sha1($tmp_password.$salt);
	
	
			$sql = "INSERT INTO user 
				(name
				,username
				,user_type_id
				,created
				,visited
				,profile_account_id
				,password_hash
				,password_salt
				,legacy)
				VALUES
				('".$row->name."'
				,'".$row->email."'
				,'1'
				,'".$db_now."'
				,'".$db_now."'
				,'1'
				,'".$hash."'
				,'".$salt."'
				,'1')"; 
				
			//$res = $db->query($sql);
	
			$user_id = $db->insert_id;
			
			
			$tmp_name = str_replace($row->name,"  "," ");			
			$tmp_name = explode($tmp_name, ' ');
			if(isset($tmp_name[1])){			
				$name_first = $tmp_name[0];
				$name_last = $tmp_name[1];	
			}else{
				$name_first = $tmp_name;
				$name_last = '';					
			}
			
			
	
	
			$sql = "INSERT INTO customer_data 
				(user_id
				,name_first
				,name_last
				,address_one
				,city
				,state
				,zip
				,phone_one
				,email
				,shipping_name_first
				,shipping_name_last
				,shipping_address_one
				,shipping_city
				,shipping_state
				,shipping_zip
				,shipping_phone_one
				,billing_name_first
				,billing_name_last
				,billing_address_one
				,billing_city
				,billing_state
				,billing_zip
				)
			   VALUES('".$user_id."'
			   ,'".$name_first."'
			   ,'".$name_last."'
			   ,'".$row->address."'
			   ,'".$row->city."'
			   ,'".$row->state."'
			   ,'".$row->zip."
			   ,'".$row->phone."
			   ,'".$row->email."'
			   ,'".$name_first."'
			   ,'".$name_last."'
			   ,'".$row->address."'
			   ,'".$row->city."'
			   ,'".$row->state."'
			   ,'".$row->zip."
			   ,'".$row->phone."			   
			   ,'".$name_first."'
			   ,'".$name_last."'
			   ,'".$row->address."'
			   ,'".$row->city."'
			   ,'".$row->state."'
			   ,'".$row->zip."
			   )"; 
				
			//$res = $db->query($sql);
			
			
			
		}

	
}



/*

$db = mysql_connect("localhost", "buyclose_ctg", "toroman1A");

 mysql_select_db("buyclose_ctg");


CREATE TABLE IF NOT EXISTS `customer_data` (
  `username` varchar(80) NOT NULL DEFAULT '',
  `customer_num` int(50) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(45) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `city` varchar(40) NOT NULL DEFAULT '',
  `state` varchar(30) NOT NULL DEFAULT '',
  `zip` varchar(25) NOT NULL DEFAULT '',
  `phone` varchar(15) NOT NULL DEFAULT '',
  `fax` varchar(15) NOT NULL DEFAULT '',
  `email` varchar(80) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `joinDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `campaign` varchar(100) NOT NULL DEFAULT '',
  `coupon` tinyint(4) DEFAULT NULL,
  `couponCode` varchar(50) NOT NULL DEFAULT '',
  `totalCoupons` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `account_type` varchar(100) NOT NULL DEFAULT '',
  `loginStatus` double NOT NULL DEFAULT '0',
  `last_ip` varchar(30) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `numSaves` int(11) NOT NULL DEFAULT '0',
  `numPurchases` int(11) NOT NULL DEFAULT '0',
*/




exit;


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "DELETE FROM in_home_consult_request WHERE comments LIKE '%viagra%'";
$result = $dbCustom->getResult($db,$sql);


$sql = "DELETE FROM in_home_consult_request WHERE comments LIKE '%levitra%'";
$result = $dbCustom->getResult($db,$sql);


$sql = "DELETE FROM in_home_consult_request WHERE comments LIKE '%cialis%'";
$result = $dbCustom->getResult($db,$sql);


$sql = "DELETE FROM in_home_consult_request WHERE comments LIKE '%klonopin%'";
$result = $dbCustom->getResult($db,$sql);

 
$sql = "DELETE FROM in_home_consult_request WHERE comments LIKE '%dapoxetine%'";
$result = $dbCustom->getResult($db,$sql);

 


$sql = "UPDATE page_seo SET seo_name = 'home' WHERE page_name = 'home'";
//$result = $dbCustom->getResult($db,$sql);
//




$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "SELECT id FROM profile_account";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


	$sql = "SELECT main_nav_bar_id FROM main_nav_bar WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
	$t_res = mysql_query($sql);
	if(!$t_res)die(mysql_error());
	if(mysql_num_rows($t_res) == 0){
		$sql = "INSERT INTO main_nav_bar 
			(profile_account_id) 
			VALUES ('".$_SESSION['profile_account_id']."')"; 
		//$result = $dbCustom->getResult($db,$sql);
		//
		echo "done";	
	}



/*
	$sql = "SELECT guides_tips_page_id FROM guides_tips_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
	$t_res = mysql_query($sql);
	if(!$t_res)die(mysql_error());
	if(mysql_num_rows($t_res) == 0){
		$sql = "INSERT INTO guides_tips_page 
			(profile_account_id) 
			VALUES ('".$_SESSION['profile_account_id']."')"; 
		//$result = $dbCustom->getResult($db,$sql);
		//
		echo "done";	
	}






	$sql = "SELECT feedback_page_id FROM feedback_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
	$t_res = mysql_query($sql);
	if(!$t_res)die(mysql_error());
	if(mysql_num_rows($t_res) == 0){
		$sql = "INSERT INTO feedback_page 
			(profile_account_id) 
			VALUES ('".$_SESSION['profile_account_id']."')"; 
		//$result = $dbCustom->getResult($db,$sql);
		//
		
	}




	$sql = "SELECT downloads_page_id FROM downloads_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
	$t_res = mysql_query($sql);
	if(!$t_res)die(mysql_error());
	if(mysql_num_rows($t_res) == 0){
		$sql = "INSERT INTO downloads_page 
			(profile_account_id) 
			VALUES ('".$_SESSION['profile_account_id']."')"; 
		$result = $dbCustom->getResult($db,$sql);
		
		
	}



	$sql = "SELECT process_page_id FROM process_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
	$t_res = mysql_query($sql);
	if(!$t_res)die(mysql_error());
	if(mysql_num_rows($t_res) == 0){
		$sql = "INSERT INTO process_page 
			(profile_account_id) 
			VALUES ('".$_SESSION['profile_account_id']."')"; 
		$result = $dbCustom->getResult($db,$sql);
		
		
	}




	$sql = "SELECT policy_page_id FROM policy_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
	$t_res = mysql_query($sql);
	if(!$t_res)die(mysql_error());
	if(mysql_num_rows($t_res) == 0){
		$sql = "INSERT INTO policy_page 
			(profile_account_id) 
			VALUES ('".$_SESSION['profile_account_id']."')"; 
		$result = $dbCustom->getResult($db,$sql);
		
		
	}


	
	
	$sql = "SELECT faq_page_id FROM faq_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
	$t_res = mysql_query($sql);
	if(!$t_res)die(mysql_error());
	if(mysql_num_rows($t_res) == 0){
		$sql = "INSERT INTO faq_page 
			(profile_account_id) 
			VALUES ('".$_SESSION['profile_account_id']."')"; 
		$result = $dbCustom->getResult($db,$sql);
		
		
		$faq_page_id = $db->insert_id;
		
	}


	
	
	$sql = "INSERT INTO we_design_fax 
		(content, last_update, profile_account_id) 
		VALUES ('', '".$ts."', '".$row->id."')"; 
	$t_res = mysql_query($sql);
	if(!$t_res)die(mysql_error());
	*/
}


exit;


$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "SELECT id FROM profile_account";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){



	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT file_name, img_id 
			FROM image 
			WHERE profile_account_id = '".$row->id."'
			ORDER BY cat_id";
	$img_res = $dbCustom->getResult($db,$sql);
	
	while($img_row = $img_res->fetch_object()){
		
		echo $img_row->file_name;
		echo "<br />";
	
		$sql = "SELECT brand, name
				FROM item
				WHERE img_id = '".$img_row->img_id."'";
		$item_res = $dbCustom->getResult($db,$sql);
		
		while($item_row = $item_res->fetch_object()){
			
		
		
		
		}
		
		
		
		
		$from = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/cat/".$object->file_name;
		$to = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/cat/".$new_file_name;	
		if(file_exists($from)){
			//rename($from , $to);
			
		}
		
		
		/*
		$p = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/details/".$object->file_name;
		if(file_exists($p)) unlink($p);
		$p = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/details_large/".$object->file_name;
		if(file_exists($p)) unlink($p);
		$p = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/details_med/".$object->file_name;
		if(file_exists($p)) unlink($p);
		$p = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/grid/".$object->file_name;
		if(file_exists($p)) unlink($p);
		$p = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/landing/".$object->file_name;
		if(file_exists($p)) unlink($p);
		$p = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/like/".$object->file_name;
		if(file_exists($p)) unlink($p);
		$p = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/list/".$object->file_name;
		if(file_exists($p)) unlink($p);
		$p = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/promo/".$object->file_name;
		if(file_exists($p)) unlink($p);
		$p = $_SERVER['DOCUMENT_ROOT']."/ul_cart/".$domain."/cart/tiny/".$object->file_name;
		if(file_exists($p)) unlink($p);
		*/
		

	}

}




//reSetAllCatSeoUrlAndListGlobal();
//reSetAllItemSeoUrlAndListGlobal();
echo "d";
exit;

$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "SELECT id FROM profile_account";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO side_nav
			(profile_account_id, submenu_content_type)
			VALUES('".$row->id."', '1')";
	//$result = $dbCustom->getResult($db,$sql);
	//
	
	echo $ts;
	
}


exit;

$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "SELECT id FROM profile_account";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){

	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT cat_id 
			FROM category 
			WHERE profile_account_id = '".$row->id."'
			ORDER BY cat_id";
	$item_res = $dbCustom->getResult($db,$sql);
	
	$i = 1;
	while($item_row = $item_res->fetch_object()){
		echo $i;
		echo "<br />";
		
		$sql = "UPDATE category
				SET profile_cat_id = '".$i."'
				WHERE cat_id = '".$item_row->cat_id."'";
		//$u_res = mysql_query ($sql);
		//
		$i++;
	}
}

exit;


$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT cat_id, name, img_id, show_on_home_page, display_order, active, show_in_showroom 
				FROM category"; 
				//WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){


	echo $row->name."      id:".$row->cat_id."   -----";
	
	
	$sql = "SELECT child_cat_to_parent_cat_id, parent_cat_id 
					FROM child_cat_to_parent_cat
					WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
			$tgc_res = mysql_query($sql);
			if(!$tgc_res)die(mysql_error());
			
			if(!mysql_num_rows($tgc_res) > 0){
				echo "top";	
			}else{
				
				$obj = mysql_fetch_object($tgc_res);
				
				
				$sql = "SELECT cat_id
						FROM category
						WHERE cat_id = '".$obj->parent_cat_id."'";	
				$td_res = mysql_query($sql);
				if(!$td_res)die(mysql_error());
				if(!mysql_num_rows($td_res) > 0){
				
					echo "zzz".$obj->child_cat_to_parent_cat_id;	
				
					$sql = "DELETE FROM child_cat_to_parent_cat
							WHERE child_cat_to_parent_cat_id = '".$obj->child_cat_to_parent_cat_id."'";
					//$d_res = mysql_query($sql);
					//
					
					
				}
				
				
				//echo $obj->parent_cat_id;
			}
				
				
				
echo "<br />";
	
	
}




exit;

$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "SELECT id FROM profile_account";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){

	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT item_id 
			FROM item 
			WHERE profile_account_id = '".$row->id."'
			ORDER BY item_id";
	$item_res = $dbCustom->getResult($db,$sql);
	
	$i = 1;
	while($item_row = $item_res->fetch_object()){
		$sql = "UPDATE item
				SET profile_item_id = '".$i."'
				WHERE item_id = '".$item_row->item_id."'";
		$u_res = mysql_query ($sql);
		
		$i++;
	}
}


exit;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


/*
		$sql = "SELECT blog_category.name, blog_category.blog_cat_id, count(blog_post.blog_cat_id) as c 
				FROM blog_category, blog_post
				WHERE blog_category.blog_cat_id = blog_post.blog_cat_id
				AND blog_post.hide = '0'
				AND blog_post.profile_account_id = '".$_SESSION['profile_account_id']."'
				GROUP BY blog_post.blog_cat_id";

$result = $dbCustom->getResult($db,$sql);		
		while($row = $result->fetch_object()){
			echo $row->blog_cat_id."   ".stripAllSlashes($row->name);
			echo "<br />";
		}	
echo "<br />";echo "<br />";

*/




			$sql = "SELECT name, blog_cat_id 
					FROM blog_category
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$bc_res = mysql_query ($sql);
			if(!$bc_res)die(mysql_error());
			while($row = mysql_fetch_object($bc_res)){

				echo "cat:  ".$row->name."          blog_cat_id:".$row->blog_cat_id;
				echo "-----------------------------------";
				echo "<br />";

				$sql = "SELECT title, blog_post_id 
						FROM blog_post
						WHERE blog_cat_id = '".$row->blog_cat_id."'
						AND hide = '0'";			
				$bp_res = mysql_query ($sql);
				if(!$bp_res)die(mysql_error());
				while($bp_row = mysql_fetch_object($bp_res)){


					echo $bp_row->title."      cat id:".$row->blog_cat_id;
					echo "<br />";


				}
			}	



/*
				$sql = "SELECT title, blog_post_id, blog_cat_id 
						FROM blog_post
						WHERE hide = '0'
						";			
				$bp_res = mysql_query ($sql);
				if(!$bp_res)die(mysql_error());
				while($bp_row = mysql_fetch_object($bp_res)){


					echo $bp_row->title."         cat id:".$bp_row->blog_cat_id;
					echo "<br />";


				}
*/


exit;

//$input = "test.txt";
//exec("gzip ".$input);


/*
	$data = implode('', file("test.txt"));
    $gzdata = gzencode($data, 9);
    $fp = fopen("test.txt.gz", "w");
    fwrite($fp, $gzdata);
    fclose($fp);
*/




$str = 'aa"bb"cc';


echo htmlentities($str,ENT_QUOTES);

exit;


	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

	$sql = "UPDATE page_seo
			SET seo_name = 'showroom'
			WHERE page_name = 'showroom'";
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "UPDATE page_seo
			SET seo_name = 'blog'
			WHERE page_name = 'blog'";
	$result = $dbCustom->getResult($db,$sql);
	


//&amp

//echo urlencode("http://www.organizetogo.com/custom-organizing-solutions/drawer-options/drawer-bottoms/standard-14-melamine-drawer-bottoms/product.html?itemId=646&catId=537");

//echo htmlentities("This 10 foot tall walk in ' is shown in our Sunset Cherry. A contemporary look with the bar pull handles with sleek birds eye maple drawer fronts and island top. The island has open drawers for a sneek peek. Click below to start creating your dream closet organizer.");


//echo strip_tags("aaa <br /> bb <p> cc </p> dd <span>");


$customer_id = 60;
$search_str = '';

exit;

$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT item_id FROM item";
	$result = $dbCustom->getResult($db,$sql);
	
	while($row = $res->fetch_object()){
	
		$sql = sprintf("SELECT word FROM key_words WHERE item_id = '%u'", $row->item_id);
		$kw_res = mysql_query ($sql);
		if(!$kw_res)die(mysql_error());
		$kw_str = '';
		$i = 0;
		while($kw_row = mysql_fetch_object($kw_res)){
			if($i > 0) $kw_str .= ", ";
			$kw_str .= $kw_row->word;
			$i++;
		}
		
		$sql = "UPDATE item
				SET key_words = '".$kw_str."'
				WHERE item_id = '".$row->item_id."'";	
		$kw_res = mysql_query ($sql);
		if(!$kw_res)die(mysql_error());
		


	}


	$sql = "SELECT key_words FROM item";
	$result = $dbCustom->getResult($db,$sql);
	
	while($row = $res->fetch_object()){
		
		echo $row->key_words;
		echo "<br />";

	}

exit;

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

	$sql = "UPDATE bread_crumb
			SET display_order = '1'
			WHERE display_order = '0'";
	//$result = $dbCustom->getResult($db,$sql);
	//



$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "SELECT id FROM profile_account";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
/*
	$sql = "INSERT INTO bread_crumb
			(profile_account_id, text, display_order, page)
			VALUES
			('".$row->id."', 'Account Designs', '2', 'account-designs')";
	$result = $dbCustom->getResult($db,$sql);
	


	$sql = "INSERT INTO bread_crumb
			(profile_account_id, text, display_order, page)
			VALUES
			('".$row->id."', 'Order History', '2', 'order-history')";
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "INSERT INTO bread_crumb
			(profile_account_id, text, display_order, page)
			VALUES
			('".$row->id."', 'Order Receipt', '2', 'order-receipt')";
	$result = $dbCustom->getResult($db,$sql);
	

*/
	echo $row->id;
	echo "<br />";

/*


	$sql = "SELECT max(page_seo_id)  AS acc_seo_id
			FROM page_seo
			WHERE page_name = 'account'
			AND profile_account_id = '".$row->id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$obj = $res->fetch_object();			
	
	echo $obj->acc_seo_id;
	echo "<br />";
	
*/	
	
/*
	$sql = "INSERT INTO page_seo
			(profile_account_id, page_name, seo_name, last_update)
			VALUES
			('".$row->id."', 'order-history', 'order-history', '".$ts."')";
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "INSERT INTO bread_crumb
			(profile_account_id, text, page_seo_id, page)
			VALUES
			('".$row->id."', 'Account Dashboard', '".$obj->acc_seo_id."', 'order-history')";
	$result = $dbCustom->getResult($db,$sql);
	
	
	//---


	$sql = "INSERT INTO page_seo
			(profile_account_id, page_name, seo_name, last_update)
			VALUES
			('".$row->id."', 'order-receipt', 'order-receipt', '".$ts."')";
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "INSERT INTO bread_crumb
			(profile_account_id, text, page_seo_id, page)
			VALUES
			('".$row->id."', 'Account Dashboard', '".$obj->acc_seo_id."', 'order-receipt')";
	$result = $dbCustom->getResult($db,$sql);
	
	
	//---


	$sql = "INSERT INTO page_seo
			(profile_account_id, page_name, seo_name, last_update)
			VALUES
			('".$row->id."', 'account-designs', 'account-designs', '".$ts."')";
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "INSERT INTO bread_crumb
			(profile_account_id, text, page_seo_id, page)
			VALUES
			('".$row->id."', 'Account Dashboard', '".$obj->acc_seo_id."', 'account-designs')";
	$result = $dbCustom->getResult($db,$sql);
	
	
*/

}


exit;

$db = $dbCustom->getDbConnect(DESIGN_DATABASE);
if($search_str != ''){
	$sql = sprintf("SELECT job.id as job_id
		,job.name as job_name
		,design.id as design_id
		,design.name as design_name 
		FROM job, design 
		WHERE job.id = design.job_id
		AND job.user_id = '%u'
		AND name like '%%%s%%'
		",$customer_id, $search_str);
}else{
	$sql = sprintf("SELECT job.id as job_id
			,job.name as job_name
			,design.id as design_id
			,design.name as design_name 
		FROM job, design 
		WHERE job.id = design.job_id
		AND job.user_id = '%u'", $customer_id);	
}

$limit = ' limit 0,30';

$sql .= " ORDER BY job.id, design.id".$limit;

$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){

	echo $row->job_name."   ".$row->design_name;
	echo "<br />";

}







$db = $dbCustom->getDbConnect(CART_DATABASE);


$sql = "SELECT *
		FROM item";
	$result = $dbCustom->getResult($db,$sql);
	
while($row = $result->fetch_object()){

	
	//echo "<textarea cols='140' rows='5'>".$row->short_description."</textarea>";

	echo "<br />";
	
	//echo $row->name." ".$row->is_closet;
	if($row->is_closet){
		$show_in_cart = 0;
		$show_in_showroom = 1;
	}else{
		$show_in_cart = 1;
		$show_in_showroom = 0;
	}

		$show_in_cart = 1;
		$show_in_showroom = 1;

	echo $row->show_in_cart;

	
	$sql = "UPDATE item SET show_in_cart = '".$show_in_cart."', show_in_showroom = '".$show_in_showroom."'
			WHERE item_id = '".$row->item_id."'";
	//$result = $dbCustom->getResult($db,$sql);
	//

	
	
	
	//echo strpos($row->short_description, '•'); 
	//<li>
	
	//echo $row->profile_account_id.'  '.$row->name;
	
	//echo "<br />";

	/*
	$new_str = str_replace ("<p>", '', $row->short_description);
	$new_str = str_replace ("</p>", '', $new_str);
	$new_str = str_replace ("\\\\", "\\", $new_str);

	$new_str = str_replace ("<ul>", '', $new_str);
	$new_str = str_replace ("</ul>", '', $new_str);

	$new_str = str_replace ("<br />", '', $new_str);
	$new_str = str_replace ("<b>", '', $new_str);
	$new_str = str_replace ("</b>", '', $new_str);
	 
	$new_str = str_replace ("<strong>", '', $new_str);
	$new_str = str_replace ("</strong>", '', $new_str);


	//$new_str = trim($new_str);

	$new_str = addslashes($new_str);
	
	$sql = "UPDATE item SET short_description = '".$new_str."'
			WHERE item_id = '".$row->item_id."'";
	//$result = $dbCustom->getResult($db,$sql);
	//
	*/		

}


exit;

	$sql = "INSERT INTO design 
		(content1, content2, content3, content4,last_update, profile_account_id) 
		VALUES ('You can use our email form if your closet is square or rectangular in shape. If you have a closet with an obscure shape then you will need to fax us your dimensions.'
				,'Our fax form works best if you have an irregular-shaped closet or if you have drawings to send us. You can use our email form if your closet is square or rectangular in shape'
				,'We have free in-home design consulations for certain zip codes. click below to see if you are in a service area.'
				,'Use our online design program to build your custom closet system. Our program allows you to build, save, and change your design at your convenience.'
				, '".$ts."', '73')"; 
	//$result = $dbCustom->getResult($db,$sql);
	

	$sql = "INSERT INTO design 
		(content1, content2, content3, content4,last_update, profile_account_id) 
		VALUES ('You can use our email form if your closet is square or rectangular in shape. If you have a closet with an obscure shape then you will need to fax us your dimensions.'
				,'Our fax form works best if you have an irregular-shaped closet or if you have drawings to send us. You can use our email form if your closet is square or rectangular in shape'
				,'We have free in-home design consulations for certain zip codes. click below to see if you are in a service area.'
				,'Use our online design program to build your custom closet system. Our program allows you to build, save, and change your design at your convenience.'
				, '".$ts."', '78')"; 
	//$result = $dbCustom->getResult($db,$sql);
	

	$sql = "INSERT INTO design 
		(content1, content2, content3, content4,last_update, profile_account_id) 
		VALUES ('You can use our email form if your closet is square or rectangular in shape. If you have a closet with an obscure shape then you will need to fax us your dimensions.'
				,'Our fax form works best if you have an irregular-shaped closet or if you have drawings to send us. You can use our email form if your closet is square or rectangular in shape'
				,'We have free in-home design consulations for certain zip codes. click below to see if you are in a service area.'
				,'Use our online design program to build your custom closet system. Our program allows you to build, save, and change your design at your convenience.'
				, '".$ts."', '88')"; 
	//$result = $dbCustom->getResult($db,$sql);
	



	$sql = "INSERT INTO design 
		(content1, content2, content3, content4,last_update, profile_account_id) 
		VALUES ('You can use our email form if your closet is square or rectangular in shape. If you have a closet with an obscure shape then you will need to fax us your dimensions.'
				,'Our fax form works best if you have an irregular-shaped closet or if you have drawings to send us. You can use our email form if your closet is square or rectangular in shape'
				,'We have free in-home design consulations for certain zip codes. click below to see if you are in a service area.'
				,'Use our online design program to build your custom closet system. Our program allows you to build, save, and change your design at your convenience.'
				, '".$ts."', '89')"; 
	//$result = $dbCustom->getResult($db,$sql);
	


	$sql = "INSERT INTO design 
		(content1, content2, content3, content4,last_update, profile_account_id) 
		VALUES ('You can use our email form if your closet is square or rectangular in shape. If you have a closet with an obscure shape then you will need to fax us your dimensions.'
				,'Our fax form works best if you have an irregular-shaped closet or if you have drawings to send us. You can use our email form if your closet is square or rectangular in shape'
				,'We have free in-home design consulations for certain zip codes. click below to see if you are in a service area.'
				,'Use our online design program to build your custom closet system. Our program allows you to build, save, and change your design at your convenience.'
				, '".$ts."', '90')"; 
	//$result = $dbCustom->getResult($db,$sql);
	



echo "profile_account_id ".$_SESSION['profile_account_id'];

exit;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "UPDATE page_seo SET seo_name = 'blog' WHERE page_name = 'blog'";
$result = $dbCustom->getResult($db,$sql);
$sql = "UPDATE page_seo SET seo_name = 'blog-more' WHERE page_name = 'blog-more'";
$result = $dbCustom->getResult($db,$sql);


//reSetAllCatSeoUrlAndListGlobal();
//reSetAllItemSeoUrlAndListGlobal();


//require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.seo.php");
//$seo = new Seo;

//$seo->setMeta('shop', 1);

//echo "title:  ".$seo->title;

//print_r($seo);

exit;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT navbar_submenu_label_id, custom_url
FROM navbar_submenu_label
";
//WHERE profile_account_id = '1'
$result = $dbCustom->getResult($db,$sql);
while($row = $result->fetch_object()){

	echo $row->custom_url;
	echo "<br />";

	$newcustom_url = str_replace ("/-", "/", $row->custom_url);

	$newcustom_url = str_replace ("-/", "/", $newcustom_url);

	$newcustom_url = str_replace ("/shop.html", "/category.html", $newcustom_url);
	
	echo $newcustom_url;
	
	echo "<br />";
	echo "<br />";
	
	
	$sql = "UPDATE navbar_submenu_label
			SET custom_url = '".$newcustom_url."'
			WHERE navbar_submenu_label_id = '".$row->navbar_submenu_label_id."'";
	//$result = $dbCustom->getResult($db,$sql);
	//
	
	

}


exit;

reSetAllCatSeoUrlGlobal();
reSetAllItemSeoUrlGlobal();

exit;

$db = $dbCustom->getDbConnect(CART_DATABASE);

				$cat_id = 39;
				
				
				
				
				
				$sql = "SELECT DISTINCT item.name 
				,item.item_id
				,image.file_name 
				FROM item, item_to_category, category, child_cat_to_parent_cat, image
				WHERE item.item_id = item_to_category.item_id
				AND item_to_category.cat_id = category.cat_id
				AND child_cat_to_parent_cat.child_cat_id = category.cat_id
                AND item.img_id = image.img_id
				AND (child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'
					OR category.cat_id = '".$cat_id."')
				AND date_inactive > NOW()
				AND date_active <= NOW()
				AND item.show_in_showroom = '1'
				AND item.active = '1'								
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
				
				
				
				
				
				
				
				
		$result = $dbCustom->getResult($db,$sql);				
				
				$num_res = $result->num_rows;
				
				
				
/*				
				$sql = "SELECT DISTINCT item.name 
				,item.item_id
				,image.file_name 
				FROM item, image, item_to_category
				WHERE item.img_id = image.img_id
				AND item_to_category.item_id = item.item_id
				AND item_to_category.cat_id = '39'
				AND show_in_showroom = '1'
				AND item.active = '1'
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY item.item_id";
		$result = $dbCustom->getResult($db,$sql);				
				
				$num_res = $result->num_rows;

				if($num_res < 1){
					
					$sql = "SELECT child_cat_id
							FROM child_cat_to_parent_cat_id
							WHERE parent_cat_id = '".$cat_id."'";	
						
											
				}
*/

echo $num_res;

?>