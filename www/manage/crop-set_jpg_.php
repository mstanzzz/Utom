<?php
if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek/'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro/';
}else{
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 
}

//echo $_SERVER['DOCUMENT_ROOT'];

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.admin_login.php");

$aLgn = new AdminLogin();

$user_id = $aLgn->getUserId();

$x1 = $_POST['x1'];
$y1 = $_POST['y1'];
$x2 = $_POST['x2'];
$y2 = $_POST['y2'];

//$x1 = 10;
//$y1 = 10;
//$x2 = 100;
//$y2 = 50;

$orig_img_path = $_POST['orig_img_path'];
$orig_img_fn = $_POST['orig_img_fn'];

//list($orig_width, $orig_height) = getimagesize($orig_img_path.$orig_img_fn);

$new_width = $x2 - $x1;

$new_height = $y2 - $y1;

/*
echo "x1:  ".$x1;
echo "<br />";
echo "x2:  ".$x2;
echo "<br />";
echo "y1:  ".$y1;
echo "<br />";
echo "y2:  ".$y2;
echo "<br />";
echo "<br />";
echo "new_width:  ".$new_width;
echo "<br />";
echo "new_height:  ".$new_height;
echo "org:    ".$orig_img_path.$orig_img_fn;
echo "<br />";
echo "<br />";
$w_y2 = $x2/2;
echo $w_y2;
exit;
*/

$temp_cropped = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/tmp/new_cropped".time().".jpg";

//$ext = end(explode(".",$orig_img_fn));

$canvas = imagecreatetruecolor($new_width, $new_height);
$src = imagecreatefromjpeg($orig_img_path.$orig_img_fn);
imagecopy($canvas, $src, 0, 0, $x1, $y1, $x2, $y2);
imagejpeg($canvas, $temp_cropped);

$src_w = $new_width;
$src_h = $new_height;

$preview = '';

if(strpos($_SESSION['img_type'], 'cart') !== false){
	

	if($_SESSION['crop_1'] > 0){

$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$orig_img_fn;

		$dst_w = 620;
		$dst_h = 620;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);

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

	
	}elseif($_SESSION['crop_2'] > 0){
		// do wide
		
$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$orig_img_fn;
		$dst_w = 800;
		$dst_h = 620; 

		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);
		
		
		
$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$orig_img_fn;
				
		
		$dst_w = 480;
		$dst_h = 380;
		
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);
		
		
		
		
		
$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/small/wide/".$orig_img_fn;

		$dst_w = 240;
		$dst_h = 187;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);


$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/wide/".$orig_img_fn;

		$dst_w = 80;
		$dst_h = 62;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);


$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/wide/".$orig_img_fn;
		$dst_w = 25;
		$dst_h = 20;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);
	
	}else{
		// do extra wide
		
$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$orig_img_fn;
		$dst_w = 1480;
		$dst_h = 740; 

		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);
		
$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/exwide/".$orig_img_fn;
			
		$dst_w = 740;
		$dst_h = 370;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);
		
$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/small/exwide/".$orig_img_fn;

		$dst_w = 320;
		$dst_h = 160;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);


$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/exwide/".$orig_img_fn;

		$dst_w = 120;
		$dst_h = 60;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);


$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/exwide/".$orig_img_fn;
		$dst_w = 40;
		$dst_h = 20;
		$dst_img = imageCreateTrueColor($dst_w,$dst_h);
		imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img,$new_path_fn,88);

	}

	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "INSERT INTO image (file_name, profile_account_id) 
		VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$this_img_id = $db->insert_id; 					
	
	$_SESSION['img_id'] = $this_img_id;
	/*
	if($_SESSION['img_type'] == 'gallery'){
		$_SESSION['gal_img_id'] = $this_img_id;
	}else{
		$_SESSION['img_id'] = $this_img_id;
		$_SESSION['gal_img_id'] = 0;
	}
	*/

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


// changing quality from 90 to 40
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

imagedestroy($src);
imagedestroy($canvas);


if($_SESSION['crop_1'] > 0){
	// did square crop
	$_SESSION['crop_1'] = 0;
	$_SESSION['crop_2'] = 1;
	$_SESSION['crop_3'] = 0;		
	header('Location: '.$ste_root."manage/crop-tool.php");

}elseif($_SESSION['crop_2'] > 0){
	// did wide crop
	$_SESSION['crop_1'] = 0;
	$_SESSION['crop_2'] = 0;
	$_SESSION['crop_3'] = 1;
		
	header('Location: '.$ste_root."manage/crop-tool.php");
	
}else{
	
	$_SESSION['crop_1'] = 0;
	$_SESSION['crop_2'] = 0;
	$_SESSION['crop_3'] = 0;
		
	header('Location: '.$ste_root."manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php");
	
}


?>












