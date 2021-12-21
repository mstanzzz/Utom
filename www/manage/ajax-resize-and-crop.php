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
require_once($real_root."/includes/config.php"); 

list($width, $height) = getimagesize($_POST["imageSource"]);
$pWidth = $_POST["imageW"];
$pHeight =  $_POST["imageH"];
$ext = end(explode(".",$_POST["imageSource"]));
$function = returnCorrectFunction($ext);  
$image = $function($_POST["imageSource"]);
$width = imagesx($image);    
$height = imagesy($image);
// Resample
$image_p = imagecreatetruecolor($pWidth, $pHeight);
setTransparency($image,$image_p,$ext);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $pWidth, $pHeight, $width, $height);

imagedestroy($image); 
$widthR = imagesx($image_p);
$hegihtR = imagesy($image_p);

if($_POST["imageRotate"]){
    $angle = 360 - $_POST["imageRotate"];
    $image_p = imagerotate($image_p,$angle,0);
    $pWidth = imagesx($image_p);
    $pHeight = imagesy($image_p);
}
if($pWidth > $_POST["viewPortW"]){
    $src_x = abs(abs($_POST["imageX"]) - abs(($_POST["imageW"] - $pWidth) / 2));
    $dst_x = 0;
}else{
    $src_x = 0;
    $dst_x = $_POST["imageX"] + (($_POST["imageW"] - $pWidth) / 2); 
}
if($pHeight > $_POST["viewPortH"]){
    $src_y = abs($_POST["imageY"] - abs(($_POST["imageH"] - $pHeight) / 2));
    $dst_y = 0;
}else{
    $src_y = 0;
    $dst_y = $_POST["imageY"] + (($_POST["imageH"] - $pHeight) / 2); 
}
$viewport = imagecreatetruecolor($_POST["viewPortW"],$_POST["viewPortH"]);

setTransparency($image_p,$viewport,$ext); 
imagecopy($viewport, $image_p, $dst_x, $dst_y, $src_x, $src_y, $pWidth, $pHeight);
imagedestroy($image_p);


if($ext != "png"){
	// sets background to white
	$white = imagecolorallocate($viewport, 255, 255, 255);
	imagefill($viewport, 0, 0, $white);
}

$selector = imagecreatetruecolor($_POST["selectorW"],$_POST["selectorH"]);

setTransparency($viewport,$selector,$ext);
imagecopy($selector, $viewport, 0, 0, $_POST["selectorX"], $_POST["selectorY"],$_POST["viewPortW"],$_POST["viewPortH"]);

$file = "../saascustuploads/".$_SESSION['profile_account_id']."/tmp/cropped".time().".".$ext;

$old_path_fn = $file; // added by ms for CTG 

parseImage($ext,$selector,$file);
imagedestroy($viewport);

//Return value
//echo $file; 

function returnCorrectFunction($ext){
    $function = '';
    switch($ext){
        case "png":
            $function = "imagecreatefrompng"; 
            break;
        case "jpeg":
            $function = "imagecreatefromjpeg"; 
            break;
        case "jpg":
            $function = "imagecreatefromjpeg";  
            break;
        case "gif":
            $function = "imagecreatefromgif"; 
            break;
    }
    return $function;
}

function parseImage($ext,$img,$file = null){
    switch($ext){
        case "png":
            imagepng($img,($file != null ? $file : '')); 
            break;
        case "jpeg":
            imagejpeg($img,($file ? $file : ''),90); 
            break;
        case "jpg":
            imagejpeg($img,($file ? $file : ''),90);
            break;
        case "gif":
            imagegif($img,($file ? $file : ''));
            break;
    }
}

function setTransparency($imgSrc,$imgDest,$ext){
   
        if($ext == "png" || $ext == "gif"){
            $trnprt_indx = imagecolortransparent($imgSrc);
            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {
                // Get the original image's transparent color's RGB values
                $trnprt_color    = imagecolorsforindex($imgSrc, $trnprt_indx);
                // Allocate the same color in the new image resource
                $trnprt_indx    = imagecolorallocate($imgDest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                // Completely fill the background of the new image with allocated color.
                imagefill($imgDest, 0, 0, $trnprt_indx);
                // Set the background color for new image to transparent
                imagecolortransparent($imgDest, $trnprt_indx);
            } 
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($ext == "png") {
               // Turn off transparency blending (temporarily)
               imagealphablending($imgDest, true);
               // Create a new transparent color for image
               
			   $color = imagecolorallocatealpha($imgDest, 0, 0, 0, 127);
               // Completely fill the background of the new image with allocated color.
               imagefill($imgDest, 0, 0, $color);
               // Restore transparency blending
               imagesavealpha($imgDest, true);
            }
            
        }
}


//all below added by ms at CTG
$src_w = $_POST["selectorW"];
$src_h = $_POST["selectorH"];


if($ext != "png"){
	// sets background to white
	$white = imagecolorallocate($selector, 255, 255, 255);
	imagefill($selector, 0, 0, $white);
}



$result_fn = '';

//if(strpos($_SESSION["ret_dir"], "art") > 0){
if(strpos($_SESSION["ret_dir"], "catalog") !== false){


	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "INSERT INTO image (file_name, profile_account_id) 
		VALUES ('".$_SESSION["pre_cropped_fn"]."', '".$_SESSION['profile_account_id']."')";
		
		
	$r = $dbCustom->getResult($db,$sql);
	
	$this_img_id = $db->insert_id; 					

	
	$img_type = (isset($_SESSION['img_type'])) ? $_SESSION['img_type'] : '';
	
	if($img_type == 'gallery'){
		$_SESSION['gal_img_id'] = $this_img_id;
	}else{
		$_SESSION['img_id'] = $this_img_id;
	}

	
	// Tiny
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$_SESSION["pre_cropped_fn"];
	$dst_w = 25;
	$dst_h = 25;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	
	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);




	// thumb
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$_SESSION["pre_cropped_fn"];
	$dst_w = 80;
	$dst_h = 80;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);

	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);

	// small
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$_SESSION["pre_cropped_fn"];
	$dst_w = 240;
	$dst_h = 240;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);

	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);
	
	$result_fn = $new_path_fn;
	
	
	// medium
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$_SESSION["pre_cropped_fn"];
	$dst_w = 460;
	$dst_h = 460;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);	

	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);
	
	
	

	//$result_fn = time();
	

	// large
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$_SESSION["pre_cropped_fn"];
	$dst_w = 520;
	$dst_h = 520;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	
	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);
		



}


if(strpos($_SESSION["ret_page"], "-banner") !== false){


	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$_SESSION["pre_cropped_fn"]."','banner', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	
	$this_img_id = $db->insert_id; 	
	
	
	
	$_SESSION['img_id'] = $this_img_id;
	$_SESSION['new_img_id'] = $this_img_id;
	
	
	//$_SESSION['img_id'] = 999;
		

	

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/".$_SESSION["pre_cropped_fn"];
	copy($old_path_fn, $new_path_fn);

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/large/".$_SESSION["pre_cropped_fn"];
	$dst_w = 860;
	$dst_h = 460;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);
	
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/medium/".$_SESSION["pre_cropped_fn"];
	$dst_w = 700;
	$dst_h = 400;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);
	
	
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/small/".$_SESSION["pre_cropped_fn"];
	$dst_w = 660;
	$dst_h = 340; 
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);
	
	$result_fn = $new_path_fn;

}


if(strpos($_SESSION["ret_page"], "blog") !== false){

	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
				VALUES ('".$_SESSION["pre_cropped_fn"]."','blog', '".$_SESSION['profile_account_id']."')";
		$r = $dbCustom->getResult($db,$sql);
		
		$this_img_id = $db->insert_id; 					

	$_SESSION['img_id'] = $this_img_id;
	$_SESSION['new_img_id'] = $this_img_id; 

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$_SESSION["pre_cropped_fn"];
	copy($old_path_fn, $new_path_fn);
	
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/large/".$_SESSION["pre_cropped_fn"];
	$dst_w = 860;
	$dst_h = 460;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);
	
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/medium/".$_SESSION["pre_cropped_fn"];
	$dst_w = 700;
	$dst_h = 400;
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);
	
	
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/small/".$_SESSION["pre_cropped_fn"];

	$dst_w = 660;
	$dst_h = 340; 
	$dst_img = imageCreateTrueColor($dst_w,$dst_h);
	imagecopyresampled($dst_img, $selector, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	imagejpeg($dst_img,$new_path_fn,90);

	$result_fn = $new_path_fn;

}

if(strpos($_SESSION["ret_page"], "installation") !== false){

	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
				VALUES ('".$_SESSION["pre_cropped_fn"]."','installation', '".$_SESSION['profile_account_id']."')";
		$r = $dbCustom->getResult($db,$sql);
		
		$this_img_id = $db->insert_id; 					

	$_SESSION['img_id'] = $this_img_id;
	$_SESSION['new_img_id'] = $this_img_id; 

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$_SESSION["pre_cropped_fn"];
	copy($old_path_fn, $new_path_fn);

	$result_fn = $new_path_fn;
}

if(strpos($_SESSION["ret_page"], "home") !== false && strpos($_SESSION["ret_page"], "-banner") !== false){ 


	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$_SESSION["pre_cropped_fn"]."','home', '".$_SESSION['profile_account_id']."')";
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
					

	//$_SESSION['img_id'] = $this_img_id;
	$_SESSION['new_img_id'] = $this_img_id; 

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$_SESSION["pre_cropped_fn"];
	copy($old_path_fn, $new_path_fn);

	$result_fn = $new_path_fn;
}


if($_SESSION['ret_page'] == 'add-spec' || $_SESSION['ret_page'] == 'edit-spec' || $_SESSION['ret_page'] == 'specs-side-content'){

	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$_SESSION["pre_cropped_fn"]."','specs', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	
	$this_img_id = $db->insert_id; 					

	$_SESSION['img_id'] = $this_img_id;

	$_SESSION['new_img_id'] = $this_img_id; 

	$new_path_fn = '../saascustuploads/'.$_SESSION['profile_account_id'].'/cms/'.$_SESSION['pre_cropped_fn'];
	copy($old_path_fn, $new_path_fn);

	$result_fn = $new_path_fn;
}


if($_SESSION['ret_page'] == 'we-design-fax'){

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$_SESSION["pre_cropped_fn"]."','we-design-fax', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	
	$this_img_id = $db->insert_id; 					

	$_SESSION['img_id'] = $this_img_id;

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$_SESSION["pre_cropped_fn"];
	copy($old_path_fn, $new_path_fn);

	$result_fn = $new_path_fn;
}

if(strpos($_SESSION['ret_page'], 'about-us') !== false){



	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "INSERT INTO image (file_name, slug, profile_account_id) 
			VALUES ('".$_SESSION["pre_cropped_fn"]."','about-us', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	
	$this_img_id = $db->insert_id; 					

	$_SESSION['img_id'] = $this_img_id;
	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$_SESSION["pre_cropped_fn"];
	copy($old_path_fn, $new_path_fn);

	$result_fn = $new_path_fn;
}



// Added by Sarah
if(strpos($_SESSION["ret_page"], "global-discount") !== false){

	$_SESSION['new_img_id'] = 0;
	$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "INSERT INTO image (file_name, alt_tag, profile_account_id) 
			VALUES ('".$_SESSION["pre_cropped_fn"]."','discount', '".$_SESSION['profile_account_id']."')";
	$r = $dbCustom->getResult($db,$sql);
	
	$this_img_id = $db->insert_id; 					

	$_SESSION['img_id'] = $this_img_id;

	$new_path_fn = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/".$_SESSION["pre_cropped_fn"];
	copy($old_path_fn, $new_path_fn);

	$result_fn = $new_path_fn;
}



/*
if(file_exists("../ul_cart/".SITEROOT."/tmp/pre-crop/".$_SESSION["pre_cropped_fn"])){
	unlink("../ul_cart/".SITEROOT."/tmp/pre-crop/".$_SESSION["pre_cropped_fn"]);
}
*/



	
//if(file_exists($old_path_fn)) unlink($old_path_fn);





//echo $result_fn;

echo $file;

//	copy($old_path_fn, $new_path_fn);

//$header_str = "Location: ".$_SESSION["ret_page"];
//header($header_str);







      
?>