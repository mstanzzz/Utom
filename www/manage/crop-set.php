<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();
require_once($real_root.'/manage/admin-includes/manage-includes.php');

$orig_img_path = $_POST['orig_img_path'];
$orig_img_fn = $_POST['orig_img_fn'];

$x1 = $_POST['x1'];
$y1 = $_POST['y1'];
$x2 = $_POST['x2'];
$y2 = $_POST['y2'];

$ret_err = 0;
if(!is_numeric($x1))$ret_err = 1;
if(!is_numeric($x2))$ret_err = 1;
if(!is_numeric($y1))$ret_err = 1;
if(!is_numeric($y2))$ret_err = 1;


$new_width = 600;
$new_height = 600;

//list($orig_width, $orig_height) = getimagesize($orig_img_path.$orig_img_fn);
if(!$ret_err){
	$new_width = $x2 - $x1;
	$new_height = $y2 - $y1;

	if($new_width < 1)$ret_err = 1;
	if($new_height < 1)$ret_err = 1;
}

//echo "new_width: ".$new_width;
//echo "<br />";
//echo "new_height: ".$new_height;
//exit;

if($ret_err){

	echo "Error";
	echo "<br />";
	
	$url_str = "crop-tool.php";
	echo "<a href='".$url_str."'>Please GO BACK</a>";
	exit;
}

$temp_cropped = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/tmp/new_cropped".time().".jpg";

$canvas = imagecreatetruecolor($new_width, $new_height);
$src = imagecreatefromjpeg($orig_img_path.$orig_img_fn);
imagecopy($canvas, $src, 0, 0, $x1, $y1, $x2, $y2);
imagejpeg($canvas, $temp_cropped);

$src_w = $new_width;
$src_h = $new_height;

$preview = '';

if(strpos($_SESSION['img_type'], 'hero') !== false){

$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;
	
	$dst_w = $new_width;
	$dst_h = $new_height;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);	
	imagejpeg($dst_img,$new_path_fn,88);

	//copy($orig_img_path.$orig_img_fn, $new_path_fn);

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, profile_account_id) 
			VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$_SESSION['img_id'] = $db->insert_id; 					

	
}

if(strpos($_SESSION['img_type'], 'spec') !== false){

$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;

	$dst_w = 620;
	$dst_h = 620;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, profile_account_id) 
			VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$_SESSION['img_id'] = $db->insert_id; 					

}


if(strpos($_SESSION['img_type'], 'cart') !== false){

	if($_SESSION['crop_n'] == 1){

		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		
		
		$sql = "INSERT INTO image (file_name, profile_account_id) 
			VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
		$r = $dbCustom->getResult($db,$sql);
		
		$_SESSION['img_id'] = $db->insert_id;

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


		$_SESSION['crop_n'] = 2;
		$url_str = SITEROOT."manage/crop-tool.php?cart_crop_n=1"; 
		
		header("Location: ".$url_str);
		exit;

	
	}elseif($_SESSION['crop_n'] == 2){
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



		$_SESSION['crop_n'] = 3;
		$url_str = SITEROOT."manage/crop-tool.php?cart_crop_n=2"; 
		
		header("Location: ".$url_str);
		exit;

	}else{
		// do extra wide
		
$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$orig_img_fn;
		$dst_w = 1030;
		$dst_h = 515; 
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


		$_SESSION['crop_n'] = 0;
		
		$url_str = SITEROOT."/manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php?img_id=".$_SESSION['img_id']; 
		
	
		header("Location: ".$url_str);

	}

	

}


if(strpos($_SESSION['img_type'], 'spec_gal') !== false){

	if(!isset($_SESSION['spec_id'])) $_SESSION['spec_id'] = 0;
	if(!is_numeric($_SESSION['spec_id']))$_SESSION['spec_id'] = 0;
	if($_SESSION['crop_n'] == 1){
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "INSERT INTO image (file_name, profile_account_id) 
			VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
		$r = $dbCustom->getResult($db,$sql);
		$_SESSION['gal_img_id'] = $db->insert_id;
	
		$sql = "INSERT INTO spec_to_img (img_id, spec_id) 
			VALUES ('".$_SESSION['gal_img_id']."', '".$_SESSION['spec_id']."')";
		$r = $dbCustom->getResult($db,$sql);
		$_SESSION['gal_img_id'] = $db->insert_id;
	
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


		$_SESSION['crop_n'] = 2;
		$url_str = SITEROOT."manage/crop-tool.php?cart_crop_n=1"; 
		
		header("Location: ".$url_str);
		exit;

	}elseif($_SESSION['crop_n'] == 2){
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



		$_SESSION['crop_n'] = 3;
		$url_str = SITEROOT."manage/crop-tool.php?cart_crop_n=2"; 
		
		header("Location: ".$url_str);
		exit;

	}else{
		// do extra wide
		
$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$orig_img_fn;
		$dst_w = 1030;
		$dst_h = 515; 
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


		$_SESSION['crop_n'] = 0;
		
		$url_str = SITEROOT."/manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php?img_id=".$_SESSION['img_id']; 
		
	
		header("Location: ".$url_str);

	}

	


}


if(strpos($_SESSION['img_type'], 'gallery') !== false){

	if($_SESSION['crop_n'] == 1){

		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "INSERT INTO image (file_name, profile_account_id) 
			VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
		$r = $dbCustom->getResult($db,$sql);
		

		$_SESSION['gal_img_id'] = $db->insert_id;

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


		$_SESSION['crop_n'] = 2;
		$url_str = SITEROOT."manage/crop-tool.php?cart_crop_n=1"; 
		
		header("Location: ".$url_str);
		exit;

	
	}elseif($_SESSION['crop_n'] == 2){
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



		$_SESSION['crop_n'] = 3;
		$url_str = SITEROOT."manage/crop-tool.php?cart_crop_n=2"; 
		
		header("Location: ".$url_str);
		exit;

	}else{
		// do extra wide
		
$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$orig_img_fn;
		$dst_w = 1030;
		$dst_h = 515; 
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


		$_SESSION['crop_n'] = 0;
		
		$url_str = SITEROOT."/manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php?img_id=".$_SESSION['img_id']; 
		
	
		header("Location: ".$url_str);

	}

}


imagedestroy($src);
imagedestroy($canvas);


//echo SITEROOT."manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php";


header('Location: '.SITEROOT."manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php");

?>












