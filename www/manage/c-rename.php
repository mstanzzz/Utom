<?php


//header('Content-type: image/jpeg');

//$image = new Imagick('image.jpg');




if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');



$i=0;
/*
$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "SELECT id FROM profile_account";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){
*/

	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT file_name, img_id 
			FROM image 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$img_res = $dbCustom->getResult($db,$sql);
	
	while($img_row = $img_res->fetch_object()){
		$i++;
	
		$file_name = $img_row->file_name;

		$fn_array = explode('-',$file_name);
		$fn_array_size = count($fn_array);

		if($fn_array_size > 2){
			
			$last_indx = $fn_array_size - 1;
			$imgstr = $fn_array[$last_indx];
			$imgstr_array = explode('.',$imgstr);
			
			if(isset($imgstr_array[0])){
				echo $imgstr_array[0];
				echo "<br />";
				
				str_replace($imgstr_array[0],
								
				
				
			}
			
		}
	}
			
		

		$go = 1;
		if($go != ''){

		
		}
		//rename_cart_images_in_dirs($img_row->file_name, $new_file_name, $_SERVER['DOCUMENT_ROOT'], $domain);	
			//update_cart_image_file_name_in_db($img_row->img_id, $new_file_name);


//}





?>