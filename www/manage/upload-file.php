<?php
ini_set('max_execution_time', 300);
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], '/www/dashboard/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/www/dashboard'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

if(isset($_GET['ret_path'])) $_SESSION['ret_path'] = $_GET['ret_path'];
if(isset($_GET['ret_page'])) $_SESSION['ret_page'] = $_GET['ret_page'];
if(isset($_GET['img_type'])) $_SESSION['img_type'] = $_GET['img_type']; 
if(isset($_GET['ret_modal'])) $_SESSION['ret_modal'] = $_GET['ret_modal'];
if(isset($_GET['ret_id'])) $_SESSION['ret_id'] = $_GET['ret_id'];

if(isset($_GET['img_type'])) $_SESSION['img_type'] = $_GET['img_type'];

if(isset($_GET['doc_type'])) $_SESSION['doc_type'] = $_GET['doc_type'];

$job_id = isset($_GET['job_id']) ? $_GET['job_id'] : 0;

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;


/*
echo "<br />";
echo $_SESSION['ret_path'];
echo "<br />";
echo $_SESSION['ret_page'];
echo "<br />";
exit;
*/

$msg = '';

function img_resize($cur_dir, $cur_file, $newwidth, $output_dir, $stretch = 0)
{
	
	if(!file_exists($output_dir)) {
		mkdir($output_dir);         
	}
	
     //$olddir = getcwd();
     $dir = opendir($cur_dir);

     $format='';
     if(preg_match("/.jpg/i", "$cur_file"))
     {
         $format = 'image/jpeg';
     }
     if (preg_match("/.gif/i", "$cur_file"))
     {
         $format = 'image/gif';
     }
     if(preg_match("/.png/i", "$cur_file"))
     {
         $format = 'image/png';
     }
     if($format!='')
     {

		 switch($format)
		 {
			 case 'image/jpeg':
			 $source = imagecreatefromjpeg($cur_dir.$cur_file);
			 break;
			 case 'image/gif';
			 $source = imagecreatefromgif($cur_dir.$cur_file);
			 break;
			 case 'image/png':
			 $source = imagecreatefrompng($cur_dir.$cur_file);
			 break;
		 }
         
		 
		list($src_w, $src_h) = getimagesize($cur_dir.$cur_file);
			 
		if($src_w > $newwidth || $stretch == 1){	 

			 $newheight=$src_h * $newwidth/$src_w;
						
			 $dst_img = imagecreatetruecolor($newwidth,$newheight);
			 
			 $src_image = imagecreatefromjpeg($cur_dir.$cur_file);
			 
			 imagecopyresampled($dst_img, $src_image, 0, 0, 0, 0, $newwidth, $newheight, $src_w, $src_h);
			 			 
			 imagejpeg($dst_img, $output_dir.$cur_file, 100);
			 imagedestroy($src_image);
			 
			 
		}else{
				
			copy($cur_dir.$cur_file,$output_dir.$cur_file);
			
			
		}
		 
	}
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		
	if(strpos($_FILES['uploadedfile']['name'], '.jpeg') !== false){
		$src = imagecreatefromjpeg($_FILES['uploadedfile']);	
		$_FILES['uploadedfile']['name'] = str_replace('.jpeg', '.jpg', $_FILES['uploadedfile']['name']); 				
	}
		
	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.upload.php');	
	
	$handle = new Upload($_FILES['uploadedfile']);
	
	$f_name = '';

	if ($handle->uploaded) {


		$handle->image_resize 	= false;
		$handle->file_overwrite	= false;
				
		$ext  = strtolower(pathinfo($_FILES['uploadedfile']['name'], PATHINFO_EXTENSION));
		
		
		$file_type = 'doc';
		
		if($ext == 'png' 
		|| $ext == 'gif' 
		|| $ext == 'jpg' 
		|| $ext == 'jpeg'){
			
			$file_type = 'image';
		}
		
		
		$dir_dest = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/tmp/pre-crop/";

		$handle->Process($dir_dest);

		if($handle->processed) {
							
			$f_name = $handle->file_dst_name;
				
			if(strpos($_SESSION['img_type'], 'job') !== false){				
				
				$db = $dbCustom->getDbConnect(CART_DATABASE);
				if($file_type == 'image'){
					$r_path = "../saascustuploads/".$_SESSION['profile_account_id']."/job/";				
					$sql = "INSERT INTO image
							(profile_account_id, file_name)
							VALUES
							('".$_SESSION['profile_account_id']."', '".$f_name."')";
					$r = $dbCustom->getResult($db,$sql);
					$_SESSION['img_id'] = $db->insert_id; 
					$sql = "INSERT INTO job_images
							(job_id, img_id)
							VALUES
							('".$job_id."', '".$_SESSION['img_id']."')";
					
					$r = $dbCustom->getResult($db,$sql);
				}else{
					$r_path = "../saascustuploads/".$_SESSION['profile_account_id']."/docs/";				
					$sql = "INSERT INTO document
							(profile_account_id, file_name)
							VALUES
							('".$_SESSION['profile_account_id']."', '".$f_name."')";
					
					$r = $dbCustom->getResult($db,$sql);
					$_SESSION['doc_id'] = $db->insert_id;
					$sql = "INSERT INTO job_to_document
							(job_id, doc_id)
							VALUES
							('".$job_id."', '".$_SESSION['doc_id']."')";
					
					$r = $dbCustom->getResult($db,$sql);
				}
		
			
			}elseif(strpos($_SESSION['img_type'], 'installer') !== false){
				
				
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				if($file_type == 'image'){
	
					
					$r_path = "../saascustuploads/".$_SESSION['profile_account_id']."/job/";				
	
	
					$sql = "INSERT INTO image
							(profile_account_id, file_name, slug)
							VALUES
							('".$_SESSION['profile_account_id']."', '".$f_name."', 'dashboard')";
					$r = $dbCustom->getResult($db,$sql);
					$_SESSION['img_id'] = $db->insert_id; 
					
					$sql = "INSERT INTO user_gallery
							(user_id, img_id)
							VALUES
							('".$user_id."', '".$_SESSION['img_id']."')";
					
					$r = $dbCustom->getResult($db,$sql);
				
					/*
					if(!file_exists($thumb_path)) {
						mkdir($thumb_path);         
					}								
					$thumb_path = "../saascustuploads/".$_SESSION['profile_account_id']."/job/thumb/";					
					img_resize($dir_dest, $f_name, 1024, $thumb_path);
					*/
					
				}else{


					
					$r_path = "../saascustuploads/".$_SESSION['profile_account_id']."/docs/";				
					$sql = "INSERT INTO document
							(user_id, profile_account_id, file_name, type)
							VALUES
							('".$user_id."', '".$_SESSION['profile_account_id']."', '".$f_name."', '".$ext."')";
					$r = $dbCustom->getResult($db,$sql);
					$_SESSION['img_id'] = $db->insert_id; 


					//echo $ext;
					//echo "<br />";
					//echo $_SESSION['img_type'];
					//exit;

				}
				
					
			}elseif(strpos($_SESSION['img_type'], 'profile') !== false){			
				$r_path = "../saascustuploads/".$_SESSION['profile_account_id']."/admin_profile/";				

			}elseif(strpos($_SESSION['ret_path'], 'cms') !== false){
				$r_path = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/full/";	

			}elseif(strpos($_SESSION['ret_path'], 'tool') !== false){

				$r_path = "../tool-images/".$_SESSION['profile_account_id']."/full/";

			}else{
				$r_path = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/full/";
			}
			
			
			if(!file_exists($r_path)) {
				mkdir($r_path);         
			}			
			
			if($file_type == 'image'){		
				img_resize($dir_dest, $f_name, 1024, $r_path);			
			}else{				
				copy($dir_dest.$f_name, $r_path.$f_name);
			}
			
			
		}else{	
			$msg = "  Error: " . $handle->error;        
		}
			
		$handle->clean();
		
	} else {
		$msg = "  Error: " . $handle->error;        
	}


	$_SESSION['img_name'] = $f_name;

	
	if(!isset($_SESSION['img_id'])){
		$_SESSION['img_id'] = 0;	
	}

	
	
	
	//header('Location: '.$ste_root."manage/".$_SESSION['ret_path'].".php?img_id=".$_SESSION["img_id"]);
	
	header('Location: '.$_SESSION['ret_path'].'?img_id='.$_SESSION['img_id']);	
		
	header($header_str);

}
	

?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>


    
    
</body>
</html>
