<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

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


//list($orig_width, $orig_height) = getimagesize($orig_img_path.$orig_img_fn);

if(!$ret_err){
	$new_width = $x2 - $x1;
	$new_height = $y2 - $y1;

	if($new_width < 1)$ret_err = 1;
	if($new_height < 1)$ret_err = 1;
}

if($ret_err){
	echo "Error";
	echo "<br />";
	
	$url_str = "crop-tool.php";
	//$url_str = preg_replace('/(\/+)/','/',$url_str);
	//echo $url_str;
	
	echo "<br />";
	echo "<a href='".$url_str."'>GO BACK</a>";
	//exit;
	
}


/*   
echo "img_type ".$_SESSION['img_type'];
echo "<br />";
echo "<br />";

echo "<br />";
echo "crop_n: ".$_SESSION['crop_n'];
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



if(strpos($_SESSION['img_type'], 'hero') !== false){

$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$orig_img_fn;
	
	//10:4
	$dst_w = 1030;
	$dst_h = 412;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $canvas, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,88);

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, profile_account_id) 
			VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	$_SESSION['img_id'] = $db->insert_id; 					

	
}





//echo "<br />";
//echo $_SESSION['img_id'];
//echo "<br />";
//echo $orig_img_fn;
//exit;


	if($_SESSION['crop_n'] == 1){

		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "INSERT INTO image (file_name, profile_account_id) 
			VALUES ('".$orig_img_fn."', '".$_SESSION['profile_account_id']."')";
		$r = $dbCustom->getResult($db,$sql);
		$_SESSION['img_id'] = $db->insert_id; 					

		/*
		$sql = "SELECT file_name
				FROM image
				WHERE img_id = '".$_SESSION['img_id']."'";
		$re = $dbCustom->getResult($db,$sql);
		if($re->num_rows > 0){
			$object = $re->fetch_object();
			$name = $object->name;
			
			echo $object->file_name;
			
		}
		*/

	}	


if(strpos($_SESSION['img_type'], 'cart') !== false){

	if($_SESSION['crop_n'] == 1){

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
		$url_str = $ste_root."manage/crop-tool.php?cart_crop_n=1"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);
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
		$url_str = $ste_root."manage/crop-tool.php?cart_crop_n=2"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);
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
		
$url_str = $ste_root."manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php?img_id=".$_SESSION['img_id']; 
$url_str = preg_replace('/(\/+)/','/',$url_str);

header("Location: ".$url_str);

	}





	


	//echo "crop_n: ".$_SESSION['crop_n'];
	//echo "<br />";
	//exit;


}



imagedestroy($src);
imagedestroy($canvas);

header('Location: '.$ste_root."manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php");

exit;


/*

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

*/

?>












