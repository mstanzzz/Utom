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


echo "exit";
exit;
/*
$new_file_name = "some-brand-5-shelf-mens-lazy-shoe-zen-with-shaft-closet";
$new_file_name = cut_name_from_front($new_file_name, 30);
echo "new_file_name:  ".$new_file_name;
exit;
*/

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
	
		$new_file_name = '';
	
		
		$pos = strlen($img_row->file_name) - 3;
		$ext = substr($img_row->file_name,$pos);
		
		if($ext != 'jpg' && $ext != 'png' && $ext != 'gif') $ext = 'jpg';
		
	
	
	
		$sql = "SELECT name, brand_id
				FROM item
				WHERE item.img_id = '".$img_row->img_id."'"; 
		$item_res = $dbCustom->getResult($db,$sql);
		
		if(mysql_num_rows($item_res) > 0){
			$item_obj = $item_res->fetch_object();
			
			$sql = "SELECT name 
					FROM brand
					WHERE brand_id = '".$item_obj->brand_id."'";	
			$brand_res = mysql_query ($sql);
			if(!$brand_res)die(mysql_error());
			if(mysql_num_rows($brand_res) > 0){
				$brand_obj = mysql_fetch_object($brand_res);
				$brand_name = $brand_obj->name.'-';			
			}

			$new_file_name = getUrlText($brand_name.$item_obj->name.'-'.$img_row->img_id);		
		}
		
		$sql = "SELECT item.name, item.brand_id
				FROM item, item_gallery
				WHERE item.item_id = item_gallery.item_id
				AND item_gallery.img_id = '".$img_row->img_id."'";
		$gal_res = mysql_query ($sql);
		if(!$gal_res)die(mysql_error());
		if(mysql_num_rows($gal_res) > 0){
			$gal_obj = mysql_fetch_object($gal_res);
			
			$sql = "SELECT name 
					FROM brand
					WHERE brand_id = '".$gal_obj->brand_id."'";	
			$brand_res = mysql_query ($sql);
			if(!$brand_res)die(mysql_error());
			if(mysql_num_rows($brand_res) > 0){
				$brand_obj = mysql_fetch_object($brand_res);
				$brand_name = $brand_obj->name.'-';			
			}
			
			
			$new_file_name = getUrlText($brand_name.'-'.$gal_obj->name.'-'.$img_row->img_id);		
		}

		$sql = "SELECT name
				FROM category
				WHERE img_id = '".$img_row->img_id."'";
		$cat_res = mysql_query ($sql);
		if(!$cat_res)die(mysql_error());
		if($cat_res->num_rows > 0){
			$cat_obj = $cat_res->fetch_object();
			$new_file_name = getUrlText($cat_obj->name.'-'.$img_row->img_id);		
		}
		
		
		/*
		$sql = "SELECT title
				FROM banner
				WHERE img_id = '".$img_row->img_id."'";
		$banner_res = mysql_query ($sql);
		if(!$banner_res)die(mysql_error());
		if(mysql_num_rows($banner_res) > 0){
			$banner_obj = mysql_fetch_object($banner_res);
			if($banner_obj->title != ''){				
				$new_file_name = getUrlText($banner_obj->title.'-'.$img_row->img_id);		
			}else{
				$new_file_name = getUrlText('banner-'.$img_row->img_id).'.'.$ext;		
	
			}			
		}
		*/


		// limit lenth and remove chars from front of string if needed.


		//$new_file_name = 'aaa-bbb-ccc-ddd-eee-fff-ggg-hhh-iii-jjj-kkk-lll-mmm-nnn-ooo-ppp-qqq-rrr-sss-123456789abcdefghijklmnop';

		if($new_file_name != ''){

			if(strlen($new_file_name) > 100){
				$new_file_name = cut_name_from_front($new_file_name, 100);
			
			}

			$new_file_name.= '.'.$ext;

			echo $i."FROM: ".$img_row->file_name."  TO: ".$new_file_name;
			
			echo "<br />";

			echo $_SERVER['DOCUMENT_ROOT'];
			echo "<br />";
			echo $domain;
			echo "<br />";
			echo "<br />";

			rename_cart_images_in_dirs($img_row->file_name, $new_file_name, $_SERVER['DOCUMENT_ROOT'], $domain);	
			update_cart_image_file_name_in_db($img_row->img_id, $new_file_name);

		}else{
		
			echo $i."NOT USEDr: ".$img_row->file_name;
			echo "<br />";
	
			
		}

	}

//}





?>