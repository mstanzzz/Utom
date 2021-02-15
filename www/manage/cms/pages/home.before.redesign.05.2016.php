<?php


if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;
$pages = new Pages;

$page_title = "Home Page";
$page_group = "home-page";
$page = "home";

	

$action = (isset($_GET['action'])) ? $_GET['action'] : '';

$banner_id = (isset($_REQUEST['banner_id'])) ? $_REQUEST['banner_id'] : 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

// add if not exist
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT home_id FROM home WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO home 
		(content, last_update, profile_account_id) 
		VALUES ('Add Content', '".time()."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
}


if(isset($_POST['set_hp_display_order'])){

	$list_type = $_POST['list_type'];
	
	$cat_ids  = $_POST['cat_id'];
	
	$order = $_POST['order'];
	
	if(is_array($order)){
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		for($i = 0; $i < count($order); $i++){
			
			if($list_type == 'showroom'){
				$sql = sprintf("UPDATE category 
					SET hp2_display_order = '%u'  
					WHERE cat_id = '%u'",
					$order[$i], $cat_ids[$i]);
					$result = $dbCustom->getResult($db,$sql);
			}else{
				$sql = sprintf("UPDATE category 
					SET hp1_display_order = '%u'  
					WHERE cat_id = '%u'",
					$order[$i], $cat_ids[$i]);
					$result = $dbCustom->getResult($db,$sql);
							
					//echo $cat_ids[$i]."       ".$order[$i];
					//echo "<br />";
					
			}
			
			
			
		}
	}
	$msg = 'Changes Saved.';

}



if(isset($_POST['add_link'])){
	$link = (isset($_POST['link'])) ? trim(addslashes($_POST['link'])) : '';
	$text = (isset($_POST['text'])) ? trim(addslashes($_POST['text'])) : '';
	$page_seo_id = (isset($_POST['page_seo_id'])) ? trim(addslashes($_POST['page_seo_id'])) : '';
	$custom_url = (isset($_POST['custom_url'])) ? trim(addslashes($_POST['custom_url'])) : '';

	$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	

	$indx = (isset($_POST['indx'])) ? trim(addslashes($_POST['indx'])) : 0;

	$_SESSION['home_multi_links'][$indx]['link_text'] = $text;				
	$_SESSION['home_multi_links'][$indx]['page_seo_id'] = $page_seo_id;
	$_SESSION['home_multi_links'][$indx]['url'] = $custom_url;
	$_SESSION['home_multi_links'][$indx]['cat_id'] = $cat_id;				

}

if(isset($_POST['edit_link'])){

	$link = (isset($_POST['link'])) ? trim(addslashes($_POST['link'])) : '';
	$text = (isset($_POST['text'])) ? trim(addslashes($_POST['text'])) : '';
	$page_seo_id = (isset($_POST['page_seo_id'])) ? trim(addslashes($_POST['page_seo_id'])) : '';
	$custom_url = (isset($_POST['custom_url'])) ? trim(addslashes($_POST['custom_url'])) : '';

	$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	

	$indx = (isset($_POST['indx'])) ? trim(addslashes($_POST['indx'])) : 0;
	
	if($link == 'content_heading'){
		$_SESSION['temp_page_fields']['content_heading'] = $text;
		$_SESSION['temp_page_fields']['content_heading_page_seo_id'] = $page_seo_id;
		$_SESSION['temp_page_fields']['content_heading_url'] = $custom_url;
		$_SESSION['temp_page_fields']['content_heading_cat_id'] = $cat_id;
	}
	if($link == 'link'){
		$_SESSION['temp_page_fields']['link_page_seo_id'] = $page_seo_id;
		$_SESSION['temp_page_fields']['link_url'] = $custom_url;
		$_SESSION['temp_page_fields']['link_cat_id'] = $cat_id;
	}	
	if($link == 'link_1'){
		$_SESSION['temp_page_fields']['link_1_label'] = $text;
		$_SESSION['temp_page_fields']['link_1_page_seo_id'] = $page_seo_id;
		$_SESSION['temp_page_fields']['link_1_url'] = $custom_url;
		$_SESSION['temp_page_fields']['link_1_cat_id'] = $cat_id;
	}
	if($link == 'multi'){
		/*
		foreach($_SESSION['home_multi_links'] as $i => $v){		
			if($indx == $i){
				$_SESSION['home_multi_links'][$i]['link_text'] = $text;				
				$_SESSION['home_multi_links'][$i]['page_seo_id'] = $page_seo_id;
				$_SESSION['home_multi_links'][$i]['url'] = $custom_url;
				$_SESSION['home_multi_links'][$i]['cat_id'] = $cat_id;				
			}			
		}
		*/
		if(isset($_SESSION['home_multi_links'][$indx]['link_text'])){
			$_SESSION['home_multi_links'][$indx]['link_text'] = $text;				
			$_SESSION['home_multi_links'][$indx]['page_seo_id'] = $page_seo_id;
			$_SESSION['home_multi_links'][$indx]['url'] = $custom_url;
			$_SESSION['home_multi_links'][$indx]['cat_id'] = $cat_id;							
		}


	}

	
	
}




if(isset($_POST['edit_home_content'])){
		
	$home_id = $_POST['home_id'];
	$img_id = $_POST['img_id'];
	$img_1_id = $_POST['img_1_id'];
	$img_2_id = $_POST['img_2_id'];

/*
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");
	if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;	
	if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;	
	if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;
*/

	$content = (isset($_POST['content'])) ? trim(addslashes($_POST['content'])) : '';

	$content_short1 = (isset($_POST['content_short1'])) ? trim(addslashes($_POST['content_short1'])) : '';
	$content_short2 = (isset($_POST['content_short2'])) ? trim(addslashes($_POST['content_short2'])) : '';
	$content_short3 = (isset($_POST['content_short3'])) ? trim(addslashes($_POST['content_short3'])) : '';


	$p_right_head_content_type = (isset($_POST['p_right_head_content_type'])) ? trim(addslashes($_POST['p_right_head_content_type'])) : '';

	$p_right_head_text = (isset($_POST['p_right_head_text'])) ? trim(addslashes($_POST['p_right_head_text'])) : '';
	
	$p_right_content_type = (isset($_POST['p_right_content_type'])) ? $_POST['p_right_content_type'] : 'form';
	
	$link_1_page_seo_id = (isset($_POST['link_1_page_seo_id'])) ? $_POST['link_1_page_seo_id'] : 0;
	$link_1_label = (isset($_POST['link_1_label'])) ? trim(addslashes($_POST['link_1_label'])) : '';
	$link_1_url = (isset($_POST['link_1_url'])) ? trim(addslashes($_POST['link_1_url'])) : '';
	$link_1_cat_id = (isset($_POST['link_1_cat_id'])) ? trim(addslashes($_POST['link_1_cat_id'])) : '';

	$img_alt_text = (isset($_POST['img_alt_text'])) ? trim(addslashes($_POST['img_alt_text'])) : '';
	$img_1_alt_text = (isset($_POST['img_1_alt_text'])) ? trim(addslashes($_POST['img_1_alt_text'])) : '';

	$title = (isset($_POST['title'])) ? trim(addslashes($_POST['title'])) : '';
	
	$keywords = (isset($_POST['keywords'])) ? trim(addslashes($_POST['keywords'])) : '';
	$description = (isset($_POST['description'])) ? trim(addslashes($_POST['description'])) : '';

	$costco_title = (isset($_POST['costco_title'])) ? trim(addslashes($_POST['costco_title'])) : '';
	$costco_keywords = (isset($_POST['costco_keywords'])) ? trim(addslashes($_POST['costco_keywords'])) : '';
	$costco_description = (isset($_POST['costco_description'])) ? trim(addslashes($_POST['costco_description'])) : '';

	//$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	//$content_heading_cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	

	$shop_by_heading1 = (isset($_POST['shop_by_heading1'])) ? trim(addslashes($_POST['shop_by_heading1'])) : '';
	$shop_by_heading2 = (isset($_POST['shop_by_heading2'])) ? trim(addslashes($_POST['shop_by_heading2'])) : '';
	
	$shop_by1_hide = (isset($_POST['shop_by1_hide'])) ? 0 : 1;
	$shop_by2_hide = (isset($_POST['shop_by2_hide'])) ? 0 : 1;
	
	
	
	$shop_by_top = (isset($_POST['shop_by_top'])) ? $_POST['shop_by_top'] : 1;
	

	$costco_shop_by_heading1 = (isset($_POST['costco_shop_by_heading1'])) ? trim(addslashes($_POST['costco_shop_by_heading1'])) : '';
	$costco_shop_by_heading2 = (isset($_POST['costco_shop_by_heading2'])) ? trim(addslashes($_POST['costco_shop_by_heading2'])) : '';
	
	$content_heading = (isset($_POST['content_heading'])) ? trim(addslashes($_POST['content_heading'])) : '';
	$content_heading_url = (isset($_POST['content_heading_url'])) ? trim(addslashes($_POST['content_heading_url'])) : '';
	$content_heading_page_seo_id = (isset($_POST['content_heading_page_seo_id'])) ? trim(addslashes($_POST['content_heading_page_seo_id'])) : '';
	$content_heading_cat_id = (isset($_POST['content_heading_cat_id'])) ? trim(addslashes($_POST['content_heading_cat_id'])) : '';

	$link_url = (isset($_POST['link_url'])) ? $_POST['link_url'] : 0;
	$link_page_seo_id = (isset($_POST['link_page_seo_id'])) ? $_POST['link_page_seo_id'] : 0;
	$link_cat_id = (isset($_POST['link_cat_id'])) ? $_POST['link_cat_id'] : 0;

	$banner_rotate = (isset($_POST['banner_rotate'])) ? $_POST['banner_rotate'] : 0;
	$banner_random = (isset($_POST['banner_random'])) ? $_POST['banner_random'] : 0;


 $seo_name	= 'home';
 $page	= 'home';

	// do seo part
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_seo.php");

	$actives = (isset($_POST['active']))? $_POST['active'] : array();
	$sql = "UPDATE banner SET hide = '1' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
			
	
	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE banner SET hide = '0' WHERE banner_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}


	/*	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT home_id FROM home WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
	$result = $dbCustom->getResult($db,$sql);
	
	*/	
		//if(in_array(2,$user_functions_array)){
			// create a backup
			//$backup = new Backup;
			//$dbu = $backup->doBackup($about_us_id,$user_id,"about_us");	
			$sql = sprintf("UPDATE home 
			SET content = '%s'
			,last_update = '%u'
			,img_id = '%u'
			,img_1_id = '%u'
			,p_right_content_type = '%s'
			,p_right_head_text = '%s'
			,content_short1 = '%s' 
			,content_short2 = '%s' 
			,content_short3 = '%s'
			,link_url = '%s'
			,link_page_seo_id = '%u'
			,link_cat_id = '%u'
			,link_1_page_seo_id  = '%u'
			,link_1_label = '%s'
			,link_1_url = '%s'
			,link_1_cat_id = '%u'
			,img_alt_text = '%s'
			,img_1_alt_text = '%s'
			,shop_by_heading1 = '%s'
			,shop_by_heading2 = '%s'
			,shop_by1_hide = '%u'
			,shop_by2_hide = '%u'
			,shop_by_top = '%u'
			,costco_shop_by_heading1 = '%s'
			,costco_shop_by_heading2 = '%s'
			,content_heading = '%s'
			,content_heading_url = '%s'
			,content_heading_page_seo_id = '%u'
			,content_heading_cat_id = '%u'
			,banner_rotate = '%u'
			,banner_random = '%u'
			,p_right_head_content_type = '%s'
			,img_2_id = '%u'
			
			
		WHERE home_id = '%u'", 
			$content
			,time()
			,$img_id
			,$img_1_id
			,$p_right_content_type
			,$p_right_head_text
			,$content_short1
			,$content_short2
			,$content_short3
			,$link_url
			,$link_page_seo_id
			,$link_cat_id
			,$link_1_page_seo_id
			,$link_1_label
			,$link_1_url
			,$link_1_cat_id
			,$img_alt_text
			,$img_1_alt_text
			,$shop_by_heading1
			,$shop_by_heading2
			,$shop_by1_hide
			,$shop_by2_hide
			,$shop_by_top			
			,$costco_shop_by_heading1
			,$costco_shop_by_heading2
			,$content_heading
			,$content_heading_url
			,$content_heading_page_seo_id
			,$content_heading_cat_id
			,$banner_rotate
			,$banner_random
			,$p_right_head_content_type
			,$img_2_id
			,$home_id);

			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	
			$result = $dbCustom->getResult($db,$sql);
				

			$msg = "Your change is now live.";

			$sql = "DELETE FROM link 
					WHERE page = 'home'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);
				
			
			foreach($_SESSION['home_multi_links'] as $i => $v){
			
				$sql = sprintf("INSERT INTO link
								(link_text
								,url
								,page_seo_id
								,cat_id
								,page
								,profile_account_id)
								VALUES
								('%s','%s','%u','%u','%s','%u')
								",$_SESSION['home_multi_links'][$i]['link_text']
								,$_SESSION['home_multi_links'][$i]['url']
								,$_SESSION['home_multi_links'][$i]['page_seo_id']
								,$_SESSION['home_multi_links'][$i]['cat_id']
								,'home'
								,$_SESSION['profile_account_id']);	
				$result = $dbCustom->getResult($db,$sql);
					
				
			}

			//echo $sql;

		//}else{
	
			/*
			$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, img_id, content_record_id) 
				VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
				"about_us", time(), $user_id, "about-us", $content, $img_id, $about_us_id);
			$msg = "Your change is now pending approval.";
		
			$result = $dbCustom->getResult($db,$sql);
				
	
			*/
		//}

	// for customer facing page
	unset($_SESSION['home_multi_links']);
	unset($_SESSION['temp_page_fields']);
	unset($_SESSION['cat_id']);
	unset($_SESSION['img_id']);
	unset($_SESSION['img_1_id']);
	unset($_SESSION['img_2_id']);
	unset($_SESSION['img_type']);
	unset($_SESSION['home_cats']);
	
	
	
}




if(isset($_POST['add_banner'])){
	
	$title = trim(addslashes($_POST['title'])); 
	$url = trim(addslashes($_POST['url']));
	$description = trim(addslashes($_POST['description']));
	$img_id = $_POST['img_id'];
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));


	$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	

	//if(in_array(2,$user_functions_array)){
	
		$sql = sprintf("INSERT INTO banner (title, url, description, img_id, img_alt_text, cat_id, profile_account_id) VALUES ('%s','%s','%s','%u','%s','%u','%u')", 
		$title, $url,$description, $img_id, $img_alt_text, $cat_id, $_SESSION['profile_account_id']);
		$msg = "Your change is now live.";


	//}else{
		//echo "You do not have permission to add a banner";
	//}
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$result = $dbCustom->getResult($db,$sql);
	

	$progress->completeStep("banner" ,$_SESSION['profile_account_id']);

	unset($_SESSION['img_id']);
	

}

if(isset($_POST['edit_banner'])){
	
	$title = trim(addslashes($_POST['title'])); 
	$url = trim(addslashes($_POST['url']));
	$description = trim(addslashes($_POST['description']));
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	$img_id = $_POST['img_id'];
	$banner_id = $_POST['banner_id'];
	
	
	$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	

	
	//if(in_array(2,$user_functions_array)){
		$sql = sprintf("UPDATE banner 
					   SET title = '%s'
					   	,url = '%s'
						,description = '%s'
						,img_id = '%u'
						,img_alt_text = '%s'
						,cat_id = '%u'
					   WHERE banner_id = '%u'",
					   $title, $url,$description, $img_id, $img_alt_text, $cat_id, $banner_id);
		$msg = "Your change is now live.";




	//}else{
		//echo "You do not have permission to edit a banner";
	//}
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$result = $dbCustom->getResult($db,$sql);
	

	$progress->completeStep("banner" ,$_SESSION['profile_account_id']);

	unset($_SESSION['img_id']);
	
	
}



if(isset($_POST['add_home_submit_button'])){

	$button_text = trim(addslashes($_POST['button_text'])); 
	$page_seo_id = $_POST['page_seo_id'];

	//if(in_array(2,$user_functions_array)){
		$sql = sprintf("INSERT INTO home_submit_button 
					   (button_text, page_seo_id, profile_account_id )
					   VALUES
					   ('%s', '%u', '%u')",
					   $button_text, $page_seo_id, $_SESSION['profile_account_id']);
		$msg = "Your change is now live.";

	//}else{
		//echo "You do not have permission to edit a banner";
	//}
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$result = $dbCustom->getResult($db,$sql);
	

}


if(isset($_POST['edit_home_submit_button'])){

	$button_text = trim(addslashes($_POST['button_text'])); 
	$page_seo_id = $_POST['page_seo_id'];
	$home_submit_button_id = $_POST['home_submit_button_id'];

	//if(in_array(2,$user_functions_array)){
		$sql = sprintf("UPDATE home_submit_button 
					   SET button_text = '%s'
						,page_seo_id = '%u'
					   WHERE home_submit_button_id = '%u'",
					   $button_text, $page_seo_id, $home_submit_button_id);
		$msg = "Your change is now live.";

	//}else{
		//echo "You do not have permission to edit a banner";
	//}
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$result = $dbCustom->getResult($db,$sql);
	
}


if(isset($_POST['del_banner_id'])){

	$banner_id = $_POST['del_banner_id'];
//echo $banner_id;
	$sql = "SELECT img_id FROM banner WHERE banner_id = '".$banner_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$img_obj = $result->fetch_object();
		
		$sql = "SELECT file_name FROM image WHERE img_id = '".$img_obj->img_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			$fn_obj = $result->fetch_object();
			$myFile = $ste_root."/ul_cms/".$domain."/".$fn_obj->file_name;
			if(file_exists($myFile)) unlink($myFile);
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		}		
		
		$sql = "DELETE FROM image WHERE img_id = '".$img_obj->img_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
	}


	$sql = sprintf("DELETE FROM banner WHERE banner_id = '%u'", $banner_id);
	$result = $dbCustom->getResult($db,$sql);
	
	
}


if(isset($_POST['del_submit_button_id'])){
	
	

	$home_submit_button_id = $_POST['del_submit_button_id'];
//echo $del_submit_button_id;
	$sql = sprintf("DELETE FROM home_submit_button WHERE submit_button_id = '%u'", $home_submit_button_id);
	$result = $dbCustom->getResult($db,$sql);
	
	
}

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
    
	$this_home_id = (isset($_REQUEST['home_id'])) ? $_REQUEST['home_id'] : 8;
	if(!isset($_SESSION['home_id'])) $_SESSION['home_id'] = $this_home_id;;
	
	
 	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT * 
    FROM home 
	WHERE home_id = '".$_SESSION['home_id']."'";
    $result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$content = $object->content;
		$img_id= $object->img_id;
		$img_1_id = $object->img_1_id;	
	

		$img_alt_text = $object->img_alt_text;
		$img_1_alt_text = $object->img_1_alt_text;	
		$this_p_right_content_type = $object->p_right_content_type;	
		$this_content_short1 = $object->content_short1;
		$this_content_short2 = $object->content_short2;
		$this_content_short3 = $object->content_short3;
		
		$this_p_right_head_text = $object->p_right_head_text;

		$link_url = $object->link_url;	
		$link_page_seo_id = $object->link_page_seo_id;	
		$link_cat_id = $object->link_cat_id;	


		$link_1_label = $object->link_1_label;
		$link_1_url = $object->link_1_url;	
		$link_1_page_seo_id = $object->link_1_page_seo_id;
		$link_1_cat_id = $object->link_1_cat_id;

		$shop_by_heading1 = $object->shop_by_heading1;
		$shop_by_heading2 = $object->shop_by_heading2;
		
		$shop_by1_hide = $object->shop_by1_hide;
		$shop_by2_hide = $object->shop_by2_hide;
		
		$shop_by_top = $object->shop_by_top;
		
		
		
		$costco_shop_by_heading1 = $object->costco_shop_by_heading1;
		$costco_shop_by_heading2 = $object->costco_shop_by_heading2;
								
		$content_heading = $object->content_heading;
		$content_heading_url = $object->content_heading_url;
		$content_heading_page_seo_id = $object->content_heading_page_seo_id;
		$content_heading_cat_id = $object->content_heading_cat_id;
		
		$banner_rotate = $object->banner_rotate;
		$banner_random = $object->banner_random;
		
		$img_2_id = $object->img_2_id;
		$p_right_head_content_type = $object->p_right_head_content_type;
	
	}else{
		$content = '';
		$img_id= 0;
		$img_1_id  = 0;
		$img_alt_text = '';
		$img_1_alt_text = '';	
		$this_p_right_content_type = 'form';
		$this_content_short1 = '';
		$this_content_short2 = '';
		$this_content_short3 = '';
		$this_p_right_head_text = '';

		$link_url = '';	
		$link_page_seo_id = 0;	
		$link_cat_id = 0;	

		$link_1_label = '';
		$link_1_url = '';	
		$link_1_page_seo_id = 0;
		$link_1_cat_id = 0;

		$shop_by_heading1 = '';
		$shop_by_heading2 = '';						

		$shop_by1_hide = 0;
		$shop_by2_hide = 0;
		
		$shop_by_top = 0;


		$costco_shop_by_heading1 = '';
		$costco_shop_by_heading2 = '';

		$content_heading = '';
		$content_heading_url = '';
		$content_heading_page_seo_id = 0;
		$content_heading_cat_id = 0;

		$banner_rotate = 1;
		$banner_random = 1;
		$img_2_id = 0;
		$p_right_head_content_type = 'text';

	}


	if(!isset($_SESSION['img_2_id'])) $_SESSION['img_2_id'] = $img_2_id;
	if(!isset($_SESSION['img_1_id'])) $_SESSION['img_1_id'] = $img_1_id;
	if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $img_id;
	
	//echo "<br />img_type: ".$_SESSION['img_type'];
	//echo "<br />img_1_id: ".$_SESSION['img_1_id'];
	//echo "<br />img_id: ".$_SESSION['img_id'];
	//echo "<br />Limg_1_id: ".$img_1_id;
	//echo "<br />home_id: ".$_SESSION['home_id'];

	if(!isset($_SESSION['temp_page_fields']['p_right_head_content_type'])) $_SESSION['temp_page_fields']['p_right_head_content_type'] = $p_right_head_content_type;	


	if(!isset($_SESSION['temp_page_fields']['content'])) $_SESSION['temp_page_fields']['content'] = $content;	
	
	
	if(!isset($_SESSION['temp_page_fields']['p_right_content_type'])) $_SESSION['temp_page_fields']['p_right_content_type'] = $this_p_right_content_type;	
	if(!isset($_SESSION['temp_page_fields']['content_short1'])) $_SESSION['temp_page_fields']['content_short1'] = $this_content_short1;	
	if(!isset($_SESSION['temp_page_fields']['content_short2'])) $_SESSION['temp_page_fields']['content_short2'] = $this_content_short1;	
	if(!isset($_SESSION['temp_page_fields']['content_short3'])) $_SESSION['temp_page_fields']['content_short3'] = $this_content_short3;	

	if(!isset($_SESSION['temp_page_fields']['p_right_head_text'])) $_SESSION['temp_page_fields']['p_right_head_text'] = $this_p_right_head_text;

	if(!isset($_SESSION['temp_page_fields']['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = $img_alt_text;
	if(!isset($_SESSION['temp_page_fields']['img_1_alt_text'])) $_SESSION['temp_page_fields']['img_1_alt_text'] = $img_1_alt_text;


	
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");

	if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;	
	if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;	
	if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;
	
	if(!isset($_SESSION['temp_page_fields']['costco_title'])) $_SESSION['temp_page_fields']['costco_title'] = $costco_title;	
	if(!isset($_SESSION['temp_page_fields']['costco_keywords'])) $_SESSION['temp_page_fields']['costco_keywords'] = $costco_keywords;	
	if(!isset($_SESSION['temp_page_fields']['costco_description'])) $_SESSION['temp_page_fields']['costco_description'] = $costco_description;
	
	if(!isset($_SESSION['temp_page_fields']['shop_by_heading1'])) $_SESSION['temp_page_fields']['shop_by_heading1'] = $shop_by_heading1;
	if(!isset($_SESSION['temp_page_fields']['shop_by_heading2'])) $_SESSION['temp_page_fields']['shop_by_heading2'] = $shop_by_heading2;

	if(!isset($_SESSION['temp_page_fields']['shop_by1_hide'])) $_SESSION['temp_page_fields']['shop_by1_hide'] = $shop_by1_hide;
	if(!isset($_SESSION['temp_page_fields']['shop_by2_hide'])) $_SESSION['temp_page_fields']['shop_by2_hide'] = $shop_by2_hide;
	
	if(!isset($_SESSION['temp_page_fields']['shop_by_top'])) $_SESSION['temp_page_fields']['shop_by_top'] = $shop_by_top;
	
	
	

	if(!isset($_SESSION['temp_page_fields']['costco_shop_by_heading1'])) $_SESSION['temp_page_fields']['costco_shop_by_heading1'] = $costco_shop_by_heading1;
	if(!isset($_SESSION['temp_page_fields']['costco_shop_by_heading2'])) $_SESSION['temp_page_fields']['costco_shop_by_heading2'] = $costco_shop_by_heading2;
	
	if(!isset($_SESSION['temp_page_fields']['content_heading'])) $_SESSION['temp_page_fields']['content_heading'] = $content_heading;
	if(!isset($_SESSION['temp_page_fields']['content_heading_url'])) $_SESSION['temp_page_fields']['content_heading_url'] = $content_heading_url;
	if(!isset($_SESSION['temp_page_fields']['content_heading_page_seo_id'])) $_SESSION['temp_page_fields']['content_heading_page_seo_id'] = $content_heading_page_seo_id;
	if(!isset($_SESSION['temp_page_fields']['content_heading_cat_id'])) $_SESSION['temp_page_fields']['content_heading_cat_id'] = $content_heading_cat_id;
	
	if(!isset($_SESSION['temp_page_fields']['link_url'])) $_SESSION['temp_page_fields']['link_url'] = $link_url;
	if(!isset($_SESSION['temp_page_fields']['link_page_seo_id'])) $_SESSION['temp_page_fields']['link_page_seo_id'] = $link_page_seo_id;
	if(!isset($_SESSION['temp_page_fields']['link_cat_id'])) $_SESSION['temp_page_fields']['link_cat_id'] = $link_cat_id;

	if(!isset($_SESSION['temp_page_fields']['link_1_label'])) $_SESSION['temp_page_fields']['link_1_label'] = $link_1_label;
	if(!isset($_SESSION['temp_page_fields']['link_1_url'])) $_SESSION['temp_page_fields']['link_1_url'] = $link_1_url;
	if(!isset($_SESSION['temp_page_fields']['link_1_page_seo_id'])) $_SESSION['temp_page_fields']['link_1_page_seo_id'] = $link_1_page_seo_id;
	if(!isset($_SESSION['temp_page_fields']['link_1_cat_id'])) $_SESSION['temp_page_fields']['link_1_cat_id'] = $link_1_cat_id;

	if(!isset($_SESSION['temp_page_fields']['banner_rotate'])) $_SESSION['temp_page_fields']['banner_rotate'] = $banner_rotate;
	if(!isset($_SESSION['temp_page_fields']['banner_random'])) $_SESSION['temp_page_fields']['banner_random'] = $banner_random;





unset($_SESSION['cat_id']);
unset($_SESSION['temp_banner_fields']);


unset($_SESSION['banner_id']);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>
$(document).ready(function() {
	
	/*
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 960	
	});
	*/
	
	$(".set_session").click(function(){
		//alert('set_session');	
		set_page_session();
	});	
	

	$(".fancybox").click(function(){
		//alert('fancybox');
		set_page_session();
	});	

});


function set_page_session(){


	var q_str = "?action=1"+get_query_str();
		
	//alert(q_str);
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
	  success: function(data) {			
		
		//alert(data);
	  
	  }
	});
			
}


	tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "wysiwyg",
        theme : "advanced",
        skin : "o2k7",
        plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
        // Theme options
        theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,styleselect,formatselect,fontsizeselect,|,forecolor,backcolor",
        theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        theme_advanced_resize_horizontal : false,
		forced_root_block : false

	});



function get_query_str(){
	
	var query_str = '';

	query_str += "&content_short3="+escape(tinyMCE.get('content_short3').getContent());
	
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	
	
	//query_str += "&content_short1="+escape(tinyMCE.get('content_short1').getContent());
	//query_str += "&content_short2="+document.form.content_short2.value; 

	query_str += "&p_right_head_content_type="+document.form.p_right_head_content_type.value; 

	query_str += "&p_right_head_text="+escape(tinyMCE.get('p_right_head_text').getContent());
	
	
	//alert(escape(tinyMCE.get('p_right_head_text').getContent()));
	

	query_str +=  "&p_right_content_type="+$("input:radio[name='p_right_content_type']:checked").val();

	query_str += "&img_alt_text="+document.form.img_alt_text.value.replace('&', '%26'); 

	//query_str += "&img_1_alt_text="+document.form.img_1_alt_text.value; 

	//query_str += "&page_heading="+document.form.page_heading.value; 

	query_str += "&seo_name="+document.form.seo_name.value; 
	query_str += "&title="+document.form.title.value.replace('&', '%26'); 
	
	//alert(document.form.title.value.replace('&', '%26'));
	
	query_str += "&keywords="+document.form.keywords.value.replace('&', '%26'); 
	query_str += "&description="+document.form.description.value.replace('&', '%26'); 

	query_str += "&costco_title="+document.form.costco_title.value.replace('&', '%26'); 
	query_str += "&costco_keywords="+document.form.costco_keywords.value.replace('&', '%26'); 
	query_str += "&costco_description="+document.form.costco_description.value.replace('&', '%26'); 

	query_str += (document.form.shop_by1_hide.checked)? "&shop_by1_hide=1" : "&shop_by1_hide=0"; 
	query_str += (document.form.shop_by2_hide.checked)? "&shop_by2_hide=1" : "&shop_by2_hide=0"; 
	
	query_str += "&shop_by_heading1="+document.form.shop_by_heading1.value.replace('&', '%26'); 
	query_str += "&shop_by_heading2="+document.form.shop_by_heading2.value.replace('&', '%26'); 

	query_str += "&costco_shop_by_heading1="+document.form.costco_shop_by_heading1.value.replace('&', '%26'); 
	query_str += "&costco_shop_by_heading2="+document.form.costco_shop_by_heading2.value.replace('&', '%26'); 

	query_str += (document.form.banner_rotate.checked)? "&banner_rotate=1" : "&banner_rotate=0"; 
	query_str += (document.form.banner_random.checked)? "&banner_random=1" : "&banner_random=0"; 
	
	//alert(query_str); 	
	return query_str;
	
}

function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
  document.form.action = '<?php echo $current_page; ?>';
  document.form.target = '_self'; 
  document.form.submit(); 
}	


</script>
</head>
<body>


<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

?>
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
		<?php 
		
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add("Home Page", '');
        echo $bread_crumb->output();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
  		?>

		<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_home_content" value="1">        
            <input type="hidden" name="home_id" value="<?php echo $_SESSION['home_id']; ?>">
       		<input type="hidden" name="ret_page" value="home">        
            <input type="hidden" name="ret_dir" value="manage/cms/pages">
            <input type="hidden" name="page_title" value=''>  
			<input type="hidden" name="content_table" value="home"> 
       		<input type="hidden" name="page" value="<?php echo $page; ?>">

       		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>">
       		<input type="hidden" name="img_1_id" value="<?php echo $_SESSION['img_1_id']; ?>">
       		<input type="hidden" name="img_2_id" value="<?php echo $_SESSION['img_2_id']; ?>">


     		<div class="page_actions edit_page">
				
                <!--
	            <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
                -->
            	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>

                <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>
                
				<hr />
				<!--  fancybox fancybox.iframe -->
                <a class="btn btn-primary set_session" href="add-home-banner.php?ret_page=home&firstload=1"><i class="icon-plus icon-white"></i> Add a New Banner Image </a>
                
				<a class="btn btn-primary fancybox fancybox.iframe" href="add-home-submit-button.php"><i class="icon-plus icon-white"></i> Add a New Submit Button</a>
                				
                <a class="btn btn-primary toggleFieldsets" href="#"><i class="icon-minus-sign icon-white"></i> Collapse All Edit Areas </a>
				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>


                <div class="data_table">
                
					<fieldset class="edit_images">
						<legend>Banner Images <i class="icon-minus-sign icon-white"></i></legend>
						
                        
							<div style='float:left;'>
                                <label> Rotate Banner Images</label>
                                <?php $checked = ($_SESSION['temp_page_fields']['banner_rotate']) ? "checked='checked'" : ''; ?>                       
                                <div class='checkboxtoggle on'> 
                                    <span class='ontext'>Yes</span><a class='switch on' href='#'></a>
                                    <span class='offtext'>No</span>
                                    <input type='checkbox' class='checkboxinput' name='banner_rotate' value='1' <?php echo $checked; ?>  />
                                </div>
                            </div>
                            
							<div style='float:left; padding-left:20%;'>
                                <label> Random Start Banner Images</label>
                                <?php $checked = ($_SESSION['temp_page_fields']['banner_random']) ? "checked='checked'" : ''; ?>                        
                                <div class='checkboxtoggle on'> 
                                    <span class='ontext'>Yes</span><a class='switch on' href='#'></a>
                                    <span class='offtext'>No</span>
                                    <input type='checkbox' class='checkboxinput' name='banner_random' value='1' <?php echo $checked; ?>  />
                                </div>
                            </div>
                        
                        <div style="clear:both"></div>
                                        
                        <br />
                        <table cellpadding="10" cellspacing="0">
							<thead>
								<tr>
									<th width="25%">Image</th>
									<th>Title</th>
									<th>Active</th>
									<!--<th>Order</th>-->
									<th width="12%">Edit</th>
									<th width="5%">Delete</th>
								</tr>
							</thead>
								<?php
									$sql = "SELECT image.file_name, banner.title, banner.banner_id, banner.hide  
									FROM image, banner
									WHERE image.img_id = banner.img_id
									AND banner.profile_account_id = '".$_SESSION['profile_account_id']."'
									ORDER BY banner_id
									";
									$result = $dbCustom->getResult($db,$sql);									
									$block = "<tr>";
									while($row = $result->fetch_object()) {
									//image
									$block .= "<td valign='top'><img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/small/".$row->file_name."' 
									width='90%' /></td>";
									//image name
									$block .= "<td valign='top'>".stripslashes($row->title)."</td>";	
									
									//active (on/off)
									$active = (!$row->hide) ? "checked='checked'" : '';
										
									$block .= "<td align='center' valign='middle' >
									<div class='checkboxtoggle on'> 
									<span class='ontext'>ON</span><a class='switch on' href='#'></a>
									<span class='offtext'>OFF</span>
									<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->banner_id."' $active  /></div></td>";	
									
									

									//$block .= "<td align='center' valign='middle' >".$row->banner_id."</td>";

									//edit
									//fancybox fancybox.iframe
									$block .= "<td valign='top'>
									<a class='btn btn-primary btn-small  set_session' 
									href='edit-home-banner.php?banner_id=".$row->banner_id."&ret_page=home&firstload=1'><i class='icon-cog icon-white'></i> Edit</a></div></td>";
									//delete
									$block .= "<td valign='middle'>
									<a class='btn btn-danger btn-small confirm'>
									<i class='icon-remove icon-white'></i>
									<input type='hidden' id='".$row->banner_id."' class='itemId' value='".$row->banner_id."' /></a></td>";		
									
									$block .= "</tr>";
								}
								echo $block;
								?>
						</table>
					</fieldset>
				</div>


				<div class="page_content edit_page">

                <fieldset class="edit_content">
					<legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
				
					<div class="colcontainer">                
   					<label>Shop by Category heading</label>
                    <input type="text" name="shop_by_heading1"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['shop_by_heading1']); ?>">
					
                    <div style="clear:both;"></div>
                    
                    <div style="float:left;">                    

					<?php
						//active (on/off)
						$active = (!$_SESSION['temp_page_fields']['shop_by1_hide']) ? "checked='checked'" : '';
										
						echo "<td align='center' valign='middle' >
									<div class='checkboxtoggle on'> 
									<span class='ontext'>ON</span><a class='switch on' href='#'></a>
									<span class='offtext'>OFF</span>
									<input type='checkbox' class='checkboxinput' name='shop_by1_hide' value='1' $active  /></div></td>";	

					?>
        			</div>

                    
                    	<div style="float:left; margin-left:50px;">                    
                    
                    	<?php
						
						$active = ($_SESSION['temp_page_fields']['shop_by_top'] == 1) ? "checked='checked'" : '';
                    	
						echo "<td valign='middle' class='center'>
						<div class='radiotoggle on '> 
						<span class='ontext'>TOP</span>
						<a class='switch on' href='#'></a>
						<span class='offtext'></span>
						<input type='radio' class='radioinput' name='shop_by_top' value='1' $active /></div></td>";	
									
                    	?>
                        	
						</div>                                



                    	<div style="float:left; margin-left:50px;">                    
						<a href="<?php echo $ste_root;?>/manage/cms/pages/set-home-cat-display-order.php?list_type=cart" 
                        class="btn btn-primary btn-small fancybox fancybox.iframe">Set Display Order</a>
						</div>
		            
                    </div>
					<br /><br /><br />
					<div class="colcontainer">                
   					<label>Shop by Showroom Heading</label>
            		<input type="text" name="shop_by_heading2" style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['shop_by_heading2']); ?>">
					
                    <div style="clear:both;"></div>
                    
					
                    <div style="float:left;">                    
					<?php
						//active (on/off)
						$active = (!$_SESSION['temp_page_fields']['shop_by2_hide']) ? "checked='checked'" : '';
										
						echo "<td align='center' valign='middle' >
									<div class='checkboxtoggle on'> 
									<span class='ontext'>ON</span><a class='switch on' href='#'></a>
									<span class='offtext'>OFF</span>
									<input type='checkbox' class='checkboxinput' name='shop_by2_hide' value='1' $active  /></div></td>";	

					?>
					</div>
                    
                    
                    
                    	<div style="float:left; margin-left:50px;">                    
                    
                    	<?php
						
						//echo $_SESSION['temp_page_fields']['shop_by_top'];
						
						$active = ($_SESSION['temp_page_fields']['shop_by_top'] == 2) ? "checked='checked'" : '';
                    	
						echo "<td valign='middle' class='center'>
						<div class='radiotoggle on '> 
						<span class='ontext'>TOP</span>
						<a class='switch on' href='#'></a>
						<span class='offtext'></span>
						<input type='radio' class='radioinput' name='shop_by_top' value='2' $active /></div></td>";	
									
                    	?>
                        	
						</div>                                
		            

                    	<div style="float:left; margin-left:50px;">                    
						<a href="<?php echo $ste_root;?>/manage/cms/pages/set-home-cat-display-order.php?list_type=showroom" 
                        class="btn btn-primary btn-small fancybox fancybox.iframe">Set Display Order</a>
						</div>
                    
                    
                    
                    </div>
                    
                    <br /><br /><br />

					<?php if($_SESSION['profile_account_id'] == 1){ ?>

				
					<div class="colcontainer">                
   					<label>Costco Shop by Category heading</label>
                    <input type="text" name="costco_shop_by_heading1"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['costco_shop_by_heading1']); ?>">
                    </div>

					<div class="colcontainer">                
   					<label>Costco Shop by Showroom Heading</label>
            		<input type="text" name="costco_shop_by_heading2" style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['costco_shop_by_heading2']); ?>">
					</div>
					
                    <br /><br /><br />

					<?php }else{ 

						echo "<input type='hidden' name='costco_shop_by_heading1' value='".$_SESSION['temp_page_fields']['costco_shop_by_heading1']."'>
						<input type='hidden' name='costco_shop_by_heading2' value='".$_SESSION['temp_page_fields']['costco_shop_by_heading2']."'>";

					} ?>


				

                    <div class="colcontainer">                
   					<label>Lower Content Heading</label>
					<?php
						echo $_SESSION['temp_page_fields']['content_heading'];
					?>
                    
                    
                    
                    <br />
   					<label>Lower Content Heading URL</label>
					<?php
					$url_str = 'edit-link.php';
					$url_str .= '?ret_page=home';
					$url_str .= '&link=content_heading';					
					$url_str .= '&text='.$_SESSION['temp_page_fields']['content_heading'];							
					$url_str .= '&custom_url='.$_SESSION['temp_page_fields']['content_heading_url'];
					$url_str .= '&page_seo_id='.$_SESSION['temp_page_fields']['content_heading_page_seo_id'];
					$url_str .= '&cat_id='.$_SESSION['temp_page_fields']['content_heading_cat_id'];
							
					if($_SESSION['temp_page_fields']['content_heading_cat_id']){
						echo $ste_root.'/'.$_SESSION['global_url_word'].getUrlByCatId($_SESSION['temp_page_fields']['content_heading_cat_id']);	
					}elseif($_SESSION['temp_page_fields']['content_heading_url'] != ''){
						echo $ste_root.'/'.$_SESSION['global_url_word'].$_SESSION['temp_page_fields']['content_heading_url'];	
					}else{						
						$page_name = getURLFileNameById($_SESSION['temp_page_fields']['content_heading_page_seo_id']);
						if($page_name == 'app'){
							echo $ste_root.'/app/';					
						}else{
							echo $ste_root.'/'.$_SESSION['global_url_word'].$page_name.'.html';
						}
					}


					echo "<br /><br /><a class='btn btn-primary btn-small fancybox fancybox.iframe' href='".$url_str."'><i class='icon-cog icon-white'></i>
					Edit Lower Content Heading and URL</a>   ";
						
					?>

					</div>
					<br /><br />

            		<input type="hidden" name="content_heading" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['content_heading']); ?>">
            		<input type="hidden" name="content_heading_url" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['content_heading_url']); ?>">
            		<input type="hidden" name="content_heading_page_seo_id" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['content_heading_page_seo_id']); ?>">
            		<input type="hidden" name="content_heading_cat_id" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['content_heading_cat_id']); ?>">
                    
					<div class="colcontainer">
                    <legend>Main Content</legend>
                        <textarea id="content" class="wysiwyg" name="content"><?php echo stripslashes($_SESSION['temp_page_fields']['content']); ?></textarea>
					</div>
				</fieldset>




				<fieldset class="edit_content">
					<legend>Upper Right Sidebar Content <i class="icon-minus-sign icon-white"></i></legend>

						
					<div class="colcontainer">
                        <div class="twocols">
							<label>Select upper right heading type</label>
						</div>
                        <div class="twocols">
                        
							<select name="p_right_head_content_type">
                            <option value="img" <?php if($_SESSION['temp_page_fields']['p_right_head_content_type'] == 'img') echo 'selected'; ?>>Image</option>
                            <option value="text" <?php if($_SESSION['temp_page_fields']['p_right_head_content_type'] == 'text') echo 'selected'; ?>>Text</option>
                            </select>
                        </div>
                    </div>
                        
                        
					<div class="colcontainer">
                        <div class="twocols">
							<label>Upper right heading image</label>
						</div>
                        <div class="twocols">


						<?php
							$sql = "SELECT image.file_name  
									FROM image
									WHERE img_id = '".$_SESSION['img_2_id']."'";
									
					$result = $dbCustom->getResult($db,$sql);							
							if($result->num_rows > 0){
								$img_obj = $result->fetch_object();
								echo "<img width='200' src='".$ste_root."/ul_cms/".$domain."/".$img_obj->file_name."' />";
							}else{
								echo "no image";	
							}
							?>

						<br /><br />
                        <!--  fancybox fancybox.iframe -->
                        <a  class='btn btn-primary set_session' 
                        href='<?php echo $ste_root; ?>/manage/upload-pre-crop.php?ret_page=home&ret_dir=cms/pages&img_type=2'>Upload new Image</a>		            

                        </div>
                    </div>
                        
                        
                        
                        
                        
					<div class="colcontainer">
                        
                        <div class="twocols">
							<label>Select content type</label>
						</div>
						<div class="twocols">
							<div style="float:left; width:300px;">Visitor Information submission form</div>    
                            <div style="float:left;">
                            <input type="radio" name="p_right_content_type" 
                            value="form" <?php if($_SESSION['temp_page_fields']['p_right_content_type'] != 'img') echo "checked"; ?> ></div>
                            <div class="clear"></div>                             
							<div style="float:left; width:300px;">Image link</div>    
                            <div style="float:left;">
                            <input type="radio" name="p_right_content_type" 
                            value="img" <?php if($_SESSION['temp_page_fields']['p_right_content_type'] == 'img') echo "checked"; ?>></div>
                            <div class="clear"></div>                             
                        </div>
					</div>
					
                    <br />
					Upper Right Head Text				
					<div class="colcontainer">
                        <textarea id="p_right_head_text" class="wysiwyg" name="p_right_head_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_right_head_text']); ?></textarea>
					</div>



                        
                        
                        <div class="twocols">
							<label>Upper Right Image</label>
						</div>
						<div class="twocols">
							<?php
							
							//echo $img_1_id;
							
							$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
							$sql = "SELECT image.file_name  
									FROM image
									WHERE img_id = '".$_SESSION['img_id']."'";
									
					$result = $dbCustom->getResult($db,$sql);							
							if($result->num_rows > 0){
								$img_obj = $result->fetch_object();
								echo "<img width='200' src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."' />";
							}else{
								echo "no image";	
							}
							?>

						<br /><br />
                        <!--  fancybox fancybox.iframe -->
                        <a class='btn btn-primary set_session' 
                        href='<?php echo $ste_root; ?>/manage/upload-pre-crop.php?ret_page=home&ret_dir=cms/pages&img_type=0'>Upload new Image</a>		            

					<label>Link URL For Image</label>
                        
					<?php
						$url_str = 'edit-link.php';
						$url_str .= '?ret_page=home';
						$url_str .= '&link=link';										
						$url_str .= '&custom_url='.$_SESSION['temp_page_fields']['link_url'];
						$url_str .= '&page_seo_id='.$_SESSION['temp_page_fields']['link_page_seo_id'];
						$url_str .= '&cat_id='.$_SESSION['temp_page_fields']['link_cat_id'];
					
						if($_SESSION['temp_page_fields']['link_cat_id']){
							echo $ste_root.'/'.$_SESSION['global_url_word'].getUrlByCatId($_SESSION['temp_page_fields']['link_cat_id']);	
						}elseif($_SESSION['temp_page_fields']['link_url'] != ''){
							echo $ste_root.'/'.$_SESSION['global_url_word'].$_SESSION['temp_page_fields']['link_url'];	
						}else{
							$page_name = getURLFileNameById($_SESSION['temp_page_fields']['link_page_seo_id']);
							if($page_name == 'app'){
								echo $ste_root.'/app/';					
							}else{
								echo $ste_root.'/'.$_SESSION['global_url_word'].$page_name.'.html';
							}
						}
					
					
						echo "<br /><br /><a class='btn btn-primary btn-small fancybox fancybox.iframe' href='".$url_str."'><i class='icon-cog icon-white'></i>
						Edit Upper Right Image URL</a>   ";
							
					
						
					?>
                        
            		<input type="hidden" name="link_url" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['link_url']); ?>">
            		<input type="hidden" name="link_page_seo_id" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['link_page_seo_id']); ?>">
            		<input type="hidden" name="link_cat_id" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['link_cat_id']); ?>">


						<label>Alt Text For Image</label>
						<input type="text" name="img_alt_text" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['img_alt_text']); ?>">

						<br /><br />

						<legend>Submit Buttons <i class="icon-minus-sign icon-white"></i></legend>
						
                        <table cellpadding="10" cellspacing="0">
							<thead>
								<tr>
									<th width="25%">Button Text</th>
									<th>Destination Page</th>
									<th width="12%">Active</th>
									<th width="12%">Edit</th>
									<th width="5%">Delete</th>
								</tr>
							</thead>
								<?php
									$sql = "SELECT home_submit_button_id, button_text, page_seo_id, active  
									FROM home_submit_button
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
							$result = $dbCustom->getResult($db,$sql);									
									$block = "<tr>";
									while($row = $result->fetch_object()) {
							
									$block .= "<td valign='top'>$row->button_text</td>";										
									$dest_page = getURLFileNameById($row->page_seo_id);
									$block .= "<td valign='top'>$dest_page</td>";										
									//active (on/off)
									if($row->active){
										$active = "<div class='checkboxtoggle on'> 
										<span class='ontext'>ON</span><a class='switch on' href='#'></a>
										<span class='offtext'>OFF</span>
										<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->home_submit_button_id."' checked='checked' /></div>";	
									}else{
										$active = "<div class='checkboxtoggle off'> <span class='ontext'>ON</span>
										<a class='switch on' href='#'></a><span class='offtext'>OFF</span>
										<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->home_submit_button_id."' /></div>";	
									}
									$block .= "<td align='center' valign='middle' >".$active."</td>";

									//edit
									$block .= "<td valign='top'>
									<a class='btn btn-primary btn-small fancybox fancybox.iframe' href='edit-home-submit-button.php?home_submit_button_id=".$row->home_submit_button_id."&ret_page=home'>
									<i class='icon-cog icon-white'></i> Edit</a></div></td>";
									//delete
									$block .= "<td valign='middle'>
									<a class='btn btn-danger btn-small confirm'>
									<i class='icon-remove icon-white'></i>
									<input type='hidden' id='".$row->home_submit_button_id."' class='itemId2' value='".$row->home_submit_button_id."' /></a></td>";		
									
									$block .= "</tr>";
								}
								echo $block;
								?>
						</table>
					</fieldset>


				<fieldset class="edit_content">
					<legend>Lower Right Sidebar Content <i class="icon-minus-sign icon-white"></i></legend>
						<label>Image</label>
							<?php
							
							$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
							$sql = "SELECT image.file_name  
									FROM image
									WHERE img_id = '".$_SESSION['img_1_id']."'";
									
					$result = $dbCustom->getResult($db,$sql);							
							if($result->num_rows > 0){
								$img_obj = $result->fetch_object();
								echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."' />";
							}else{
								echo "no image";	
							}
							?>

						<br /><br />
                        <!--  fancybox fancybox.iframe -->
                        <a class='btn btn-primary set_session' 
                        href='<?php echo $ste_root; ?>/manage/upload-pre-crop.php?ret_page=home&ret_dir=cms/pages&img_type=1'>Upload new Image</a>		            



                        <label>Link label Below Image</label>
                        <?php
                            echo $_SESSION['temp_page_fields']['link_1_label'];
                        ?>
                        <br />



						<label>Link URL Below Image</label>
                        
					<?php
						$url_str = 'edit-link.php';
						$url_str .= '?ret_page=home';
						$url_str .= '&link=link_1';	
						$url_str .= '&text='.$_SESSION['temp_page_fields']['link_1_label'];									
						$url_str .= '&custom_url='.$_SESSION['temp_page_fields']['link_1_url'];
						$url_str .= '&page_seo_id='.$_SESSION['temp_page_fields']['link_1_page_seo_id'];
						$url_str .= '&cat_id='.$_SESSION['temp_page_fields']['link_1_cat_id'];
					
							
						if($_SESSION['temp_page_fields']['link_1_cat_id']){
							echo $ste_root.'/'.$_SESSION['global_url_word'].getUrlByCatId($_SESSION['temp_page_fields']['link_1_cat_id']);	
						}elseif($_SESSION['temp_page_fields']['link_1_url'] != ''){
							echo $ste_root.'/'.$_SESSION['global_url_word'].$_SESSION['temp_page_fields']['link_1_url'];	
						}else{
							$page_name = getURLFileNameById($_SESSION['temp_page_fields']['link_1_page_seo_id']);
							if($page_name == 'app'){
								echo $ste_root.'/app/';					
							}else{
								echo $ste_root.'/'.$_SESSION['global_url_word'].$page_name.'.html';
							}
						}


						echo "<br /><br /><a class='btn btn-primary btn-small fancybox fancybox.iframe' href='".$url_str."'><i class='icon-cog icon-white'></i>
						Edit Lower Right Link</a>   ";

						
					?>
                        
            		<input type="hidden" name="link_1_label" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['link_1_label']); ?>">                     
            		<input type="hidden" name="link_1_url" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['link_1_url']); ?>">
            		<input type="hidden" name="link_1_page_seo_id" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['link_1_page_seo_id']); ?>">
            		<input type="hidden" name="link_1_cat_id" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['link_1_cat_id']); ?>">
                        
                        
                    <label>Content Below Image</label>
					<textarea id="content_short3" class="wysiwyg small" name="content_short3"><?php echo stripslashes($_SESSION['temp_page_fields']['content_short3']); ?></textarea>
                        
				</fieldset>




                <label>Lower Right Links</label>
				
				<?php

				if(!isset($_SESSION['home_multi_links'])){

					$_SESSION['home_multi_links'] = array();		
				
					$sql = "SELECT url, page_seo_id, cat_id, link_text  
							FROM link
							WHERE page = 'home'
							AND profile_account_id = '".$_SESSION['profile_account_id']."'";
					$result = $dbCustom->getResult($db,$sql);					
					$i=0;
					while($row = $result->fetch_object()) {
						$_SESSION['home_multi_links'][$i]['link_text'] = $row->link_text;
						$_SESSION['home_multi_links'][$i]['page_seo_id'] = $row->page_seo_id;
						$_SESSION['home_multi_links'][$i]['url'] = $row->url;						
						$_SESSION['home_multi_links'][$i]['cat_id'] = $row->cat_id;
						$i++;
					}
				}
				$i = 0;
				foreach($_SESSION['home_multi_links'] as $i => $v){
					$url_str = 'edit-link.php';
					$url_str .= '?ret_page=home';
					$url_str .= '&indx='.$i;						
					$url_str .= '&link=multi';	
					$url_str .= '&text='.$v['link_text'];									
					$url_str .= '&custom_url='.$v['url'];
					$url_str .= '&page_seo_id='.$v['page_seo_id'];
					$url_str .= '&cat_id='.$v['cat_id'];
					echo "<a class='btn btn-primary btn-small fancybox fancybox.iframe' href='".$url_str."'><i class='icon-cog icon-white'></i>Edit</a>  ";
					echo $_SESSION['home_multi_links'][$i]['link_text'];
					echo "<br />";
				}
				echo "<br />";



				$i++;
				$url_str = 'add-link.php';
				$url_str .= '?ret_page=home';
				$url_str .= '&indx='.$i;

				
				echo "<a class='btn btn-primary btn-small fancybox fancybox.iframe' href='".$url_str."'>Add Link</a>   ";
				
				echo "<br /><br />";




				if(!isset($seo_name)) $seo_name = '';
				$title = $_SESSION['temp_page_fields']['title'];
				$keywords = $_SESSION['temp_page_fields']['keywords'];	
				$description = $_SESSION['temp_page_fields']['description'];

				$costco_title = $_SESSION['temp_page_fields']['costco_title'];
				$costco_keywords = $_SESSION['temp_page_fields']['costco_keywords'];	
				$costco_description = $_SESSION['temp_page_fields']['costco_description'];


				require_once("edit_page_seo.php"); 
				
				?>


			</div>


		</form>




	</div>
	<p class="clear"></p>
	<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
    ?>
</div>


<!-- New Delete Dialogue -->
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this banner?</h3>
	<form name="del_banner" action="home.php" method="post" target="_top">
		<input id="del_banner_id" class="itemId" type="hidden" name="del_banner_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_banner" type="submit" >Yes, Delete</button>
	</form>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this submit button?</h3>
	<form name="del_submit_button" action="home.php" method="post" target="_top">
		<input id="del_submit_button_id" class="itemId2" type="hidden" name="del_submit_button_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_submit_button" type="submit" >Yes, Delete</button>
	</form>
</div>


<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
<!-- New Edit Dialogue 
<div id="content-edit" class="confirm-content">
	<form name="edit_faq_cat" action="faq-category.php" method="post" target="_top">
		<input id="faq_cat_id" type="hidden" class="itemId" name="faq_cat_id" value='' />
		<fieldset class="colcontainer">
			<label>Edit Banner</label>
			<input type="text" class="contentToEdit"  name="added_category" value=''>
		</fieldset>
		<a class="btn btn-large dismiss"> Cancel </a>
		<button name="edit_faq_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
	</form>
</div>
-->
	


</body>
</html>
