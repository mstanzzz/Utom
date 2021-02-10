<?php
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.admin_login.php");

$aLgn = new AdminLogin();

$user_id = $aLgn->getUserId();

$x1 = $_POST['x1'];
$y1 = $_POST['y1'];
$x2 = $_POST['x2'];
$y2 = $_POST['y2'];

$orig_img_path = $_POST['orig_img_path'];
$orig_img_fn = $_POST['orig_img_fn'];


list($orig_width, $orig_height) = getimagesize($orig_img_path.$orig_img_fn);

$new_width = $x2 - $x1;

$new_height = $y2 - $y1;


$src_w = $new_width;
$src_h = $new_height;


echo "new_width:  ".$new_width;
echo "<br />";
echo "new_height:  ".$new_height;
echo "<br />";
echo "<br />";
echo "x1:  ".$x1;
echo "<br />";
echo "x2:  ".$x2;
echo "<br />";
echo "y1:  ".$y1;
echo "<br />";
echo "y2:  ".$y2;
echo "<br />";
echo "<br />";


$canvas = imagecreatetruecolor($new_width, $new_height);
$src = imagecreatefromjpeg($orig_img_path.$orig_img_fn);
imagecopy($canvas, $src, 0, 0, $x1, $y1, $x2, $y2);
imagejpeg($canvas, $temp_cropped);



echo "<br />";
echo "<br />";
echo "org:    ".$orig_img_path.$orig_img_fn;
echo "<br />";
echo "<br />";

//exit;




$temp_cropped = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/tmp/new_cropped".time().".jpg";

//$ext = end(explode(".",$orig_img_fn));

$preview = '';




if(strpos($_SESSION['ret_page'], 'test') !== false) {


	$square_x1 = $x1 + 180;	
	$square_x2 = $x2 - 180;
	
	$square_y2 = $y2;
	$square_y1 = $y1;
	
echo "<br />";
echo "<br />";
echo "square_x1:  ".$square_x1;
echo "<br />";
echo "square_x2:  ".$square_x2;
echo "<br />";
echo "square_y2:  ".$square_y2;
echo "<br />";
echo "square_y1:  ".$square_y1;
echo "<br />";
echo "<br />";
	
	$new_square_width = $square_x2 - $square_x1;

	$new_square_height = $square_y2 - $square_y1;

	echo "new_square_width:  ".$new_square_width;
	echo "<br />";
	echo "new_square_height:  ".$new_square_height;
	echo "<br />";
	echo "<br />";

	$square_dst_w = $new_square_width;
	$square_dst_h = $new_square_height;
	$canvas_square = imagecreatetruecolor($new_square_width, $new_square_height);
	imagecopy($canvas_square, $src, 0, 0, $square_x1, $square_y1, $square_x2, $square_y2);
	imagejpeg($canvas_square, $temp_cropped);

	



	// create square image
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/square/".$orig_img_fn;
		
	$dst_w = 520;
	$dst_h = 520;

	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

$preview = $new_path_fn;


	// create wide image
/*
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$orig_img_fn;

	$square_dst_w = 520;
	$square_dst_h = 520;
	
	$square_dst_w = $new_square_width;
	$square_dst_h = $new_square_height;
		
	$dst_img = imageCreateTrueColor($square_dst_w,$square_dst_h);

	imagecopyresampled($dst_img, $canvas_square, 0, 0, 0, 0, $square_dst_w, $square_dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);
*/



//$preview = $new_path_fn;


echo "<img src='".$preview."' />";
echo $preview;


exit;



	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "INSERT INTO image (file_name, profile_account_id) 
		VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					
	
	$_SESSION['img_id'] = $this_img_id;

}


if(strpos($_SESSION['ret_path'], 'dashboard') !== false) {


	$db = $dbCustom->getDbConnect(USER_DATABASE);

	$sql = "INSERT INTO image
				(profile_account_id, file_name, slug)
				VALUES
				('".$_SESSION['profile_account_id']."', '".$orig_img_fn."', 'dashboard')";
	
	$r = $dbCustom->getResult($db,$sql);

	
	$_SESSION["img_id"] = $db->insert_id; 
    $_SESSION["file_name"] = $orig_img_fn; 
	
	
	
	$new_path_fn = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/admin_profile/".$user_id."/".$orig_img_fn;	 
	
	$dir_dest = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/admin_profile/".$user_id."/";
	
	if(!is_dir($dir_dest)){
		//echo "mkdir:   ".mkdir($dir_dest);
		mkdir($dir_dest);			
		//echo "<br /><br />";
	}
	

	

}



if(strpos($_SESSION['ret_path'], 'tool') !== false){


	if(strpos($_SESSION['img_type'], 'thumb') !== false){
		
		/*
	
		$dst_w = 140;
		$dst_h = 140;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);
		
		*/
				
		$_SESSION['thumb_image'] = $orig_img_fn;		
		//$_SESSION['tool_image'] = '';
	}else{

		/*
		$dst_w = 440;
		$dst_h = 440;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);
		
		$_SESSION['reg_image'] = $new_path_fn;
		*/

		$_SESSION['tool_image'] = $orig_img_fn;		
		//$_SESSION['thumb_image'] = '';
		
		
	}
	
	
	$new_path_fn = "../tool-images/".$_SESSION['profile_account_id']."/full/".$orig_img_fn;
	copy($temp_cropped, $new_path_fn);
	
	
	
}


if(strpos($_SESSION['img_type'], 'profile') !== false){

	$db = $dbCustom->getDbConnect(USER_DATABASE);
	
	if(!$aLgn->has_cust_data_record($user_id)){	
		$sql = "INSERT INTO customer_data
				(user_id, profile_img)
				VALUES
				('".$user_id."', '".$orig_img_fn."')";
		//$r = $dbCustom->getResult($db,$sql);

	}else{
	
		$sql = "UPDATE customer_data
				SET profile_img = '".$orig_img_fn."'
				WHERE user_id = '".$user_id."'";
		//$r = $dbCustom->getResult($db,$sql);
	}

	$new_path_fn = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/admin_profile/".$user_id."/".$orig_img_fn;	 
	
	$dir_dest = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/admin_profile/".$user_id."/";
	
	
	if(!is_dir($dir_dest)){
		//echo "mkdir:   ".mkdir($dir_dest);
		mkdir($dir_dest);			
		//echo "<br /><br />";
	}
	
	$dst_w = 240;
	$dst_h = 240;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);
	
	


}


if(strpos($_SESSION['ret_path'], 'keyword-landing') !== false){

	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$orig_img_fn."', 'kwlp', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					

	if($_SESSION['img_type'] == 'video'){
		$_SESSION['temp_page_fields']['video_img_id'] = $this_img_id;		
	}
	if($_SESSION['img_type'] == 'start_design'){
		$_SESSION['temp_page_fields']['start_design_img_id'] = $this_img_id;
	}
	if($_SESSION['img_type'] == 'specs'){
		$_SESSION['temp_page_fields']['specs_img_id'] = $this_img_id;
	}
	if($_SESSION['img_type'] == 'main'){
		$_SESSION['temp_page_fields']['main_img_id'] = $this_img_id;
	}
	if($_SESSION['img_type'] == 'gallery'){
		$_SESSION['temp_page_fields']['gallery_img_id'] = $this_img_id;
	}


	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;

	$dst_w = 240;
	$dst_h = 240;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

	
	if($_SESSION['img_type'] == 'main' || $_SESSION['img_type'] == 'gallery'){

		$new_path_gallery_large_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/large/".$orig_img_fn;
		if(!file_exists($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/large/")){
			mkdir($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/large/");	
		}

		$dst_w = 520;
		$dst_h = 520;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_gallery_large_fn,88);
		$_SESSION['gal_img_id'] = $this_img_id;

	}
	
	$preview = $new_path_fn;



}


if(strpos($_SESSION['ret_path'], 'catalog') !== false && strpos($_SESSION['ret_path'], '-banner') === false){

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$orig_img_fn;
	$dst_w = 520;
	$dst_h = 520;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

$preview = $new_path_fn;

	
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$orig_img_fn;
	$dst_w = 460;
	$dst_h = 460;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$orig_img_fn;
	$dst_w = 240;
	$dst_h = 240;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$orig_img_fn;
	$dst_w = 80;
	$dst_h = 80;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$orig_img_fn;
	$dst_w = 25;
	$dst_h = 25;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

	
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "INSERT INTO image (file_name, profile_account_id) 
		VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					
	
	if($_SESSION['img_type'] == 'gallery'){
		$_SESSION['gal_img_id'] = $this_img_id;
		//$_SESSION['img_id'] = 0;
	}else{
		$_SESSION['img_id'] = $this_img_id;
		$_SESSION['gal_img_id'] = 0;
		$_SESSION['img_type'] = '';
	}
	
}

// chaning quality from 90 to 40

if(strpos($_SESSION['ret_path'], '-banner') !== false){

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/".$orig_img_fn;
	copy($orig_img_path.$orig_img_fn, $new_path_fn);

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/large/".$orig_img_fn;
	$dst_w = 860;
	$dst_h = 460;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);
	
	
	
	
	
$preview = $new_path_fn;

	
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/medium/".$orig_img_fn;
	$dst_w = 700;
	$dst_h = 400;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);
	
	
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/small/".$orig_img_fn;
	$dst_w = 660;
	$dst_h = 340; 
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

	
	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$orig_img_fn."','banner', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 	
	$_SESSION['img_id'] = $this_img_id;
	$_SESSION['new_img_id'] = $this_img_id;
	

}

if(strpos($_SESSION['ret_path'], 'home') !== false && strpos($_SESSION['ret_path'], '-banner') === false){ 


	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;
	$dst_w = 270;
	$dst_h = 198;
	
	
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

$preview = $new_path_fn;

	
	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$orig_img_fn."','home', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 	
	if(!isset($_SESSION['img_type'])) $_SESSION['img_type'] = 0;
	if($_SESSION['img_type'] == 2){
		$_SESSION['img_2_id'] = $this_img_id;	
	}elseif($_SESSION['img_type'] == 1){
		$_SESSION['img_1_id'] = $this_img_id;
	}else{
		$_SESSION['img_id'] = $this_img_id;
	}
	$_SESSION['new_img_id'] = $this_img_id;
	
	 
}




if(strpos($_SESSION['ret_path'], 'blog') !== false){

	//$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;
	//copy($temp_cropped, $new_path_fn);
	
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;
	$dst_w = 600;
	$dst_h = 400;
	
	
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);
	
$preview = $new_path_fn;

	
	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
				VALUES ('".$orig_img_fn."','blog', '".$_SESSION['profile_account_id']."')";
		$r = $dbCustom->getResult($db,$sql);		
		$this_img_id = $db->insert_id; 					
	$_SESSION['img_id'] = $this_img_id;
	$_SESSION['new_img_id'] = $this_img_id; 
	

}

if(strpos($_SESSION['ret_path'], 'installation') !== false && strpos($_SESSION['ret_path'], 'dashboard') === false){


	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;
	copy($temp_cropped, $new_path_fn);


	$preview = $new_path_fn;


	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
				VALUES ('".$orig_img_fn."','installation', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					
	$_SESSION['img_id'] = $this_img_id;
	$_SESSION['new_img_id'] = $this_img_id;
	 
}

if($_SESSION['ret_path'] == 'add-spec' || $_SESSION['ret_path'] == 'edit-spec'){

	$new_path_fn = '../saascustuploads/'.$_SESSION['profile_account_id'].'/cms/'.$orig_img_fn;
	copy($temp_cropped, $new_path_fn);


$preview = $new_path_fn;

	
	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$orig_img_fn."','specs', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					
	$_SESSION['img_id'] = $this_img_id;
	$_SESSION['new_img_id'] = $this_img_id; 
	
}


if($_SESSION['ret_path'] == 'specs-side-content'){
	
	$new_path_fn = '../saascustuploads/'.$_SESSION['profile_account_id'].'/cms/'.$orig_img_fn;
	copy($temp_cropped, $new_path_fn);


$preview = $new_path_fn;


	
	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$orig_img_fn."','specs', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					
	$_SESSION['img_id'] = $this_img_id;
	$_SESSION['new_img_id'] = $this_img_id; 
	
	
}





if($_SESSION['ret_path'] == 'we-design-fax'){


	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;
	copy($temp_cropped, $new_path_fn);

$preview = $new_path_fn;

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$orig_img_fn."','we-design-fax', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					
	$_SESSION['img_id'] = $this_img_id;
	
}

if(strpos($_SESSION['ret_path'], 'about-us') !== false){

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;
	copy($temp_cropped, $new_path_fn);


$preview = $new_path_fn;

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$orig_img_fn."','about-us', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					
	$_SESSION['img_id'] = $this_img_id;

}

if(strpos($_SESSION["ret_path"], "global-discount") !== false){

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;
	copy($temp_cropped, $new_path_fn);


	$preview = $new_path_fn;

	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "INSERT INTO image (file_name, alt_tag, profile_account_id) 
			VALUES ('".$orig_img_fn."','discount', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					
	$_SESSION['img_id'] = $this_img_id;

}

	//echo $_SESSION['tool_image'];
	//echo "<br />";
	//echo $_SESSION['thumb_image'];
	//exit;




imagedestroy($src);
imagedestroy($canvas);

imagedestroy($canvas_square);


	header('Location: '.$ste_root."manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php");



?>


