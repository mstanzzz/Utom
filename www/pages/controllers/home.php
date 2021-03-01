<?php

//$db = $dbCustom->getDbConnect(CART_DATABASE);
//$sql = "UPDATE category SET show_on_home_page = '1'";
//$sql = "UPDATE category SET active = '1'";
//$sql = "UPDATE item SET active = '1'";
//$result = $dbCustom->getResult($db,$sql);


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

//echo SITE_N_DATABASE;
//echo "<br />";

$sql = "SELECT *
		FROM home
		WHERE home.home_id = (SELECT MAX(home_id) 
							FROM home 
							WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);


//echo "<br />";
//echo $result->num_rows;
//echo "<br />";


if($result->num_rows > 0){
	$object = $result->fetch_object();
	
	$img_1_id = $object->img_1_id;
	$img_2_id = $object->img_2_id;
	$img_3_id = $object->img_3_id;
	$top_1 = stripslashes($object->top_1);
	$top_2 = stripslashes($object->top_2);
	$top_3 = stripslashes($object->top_3);
	$p_1_head = stripslashes($object->p_1_head);
	$p_1_text = stripslashes($object->p_1_text);
	$p_2_head = stripslashes($object->p_2_head);
	$p_2_text = stripslashes($object->p_2_text);
	$p_3_head = stripslashes($object->p_3_head); 
	$p_3_text = stripslashes($object->p_3_text);
	$p_4_head = stripslashes($object->p_4_head);
	$p_4_text = stripslashes($object->p_4_text); 
	$p_5_head = stripslashes($object->p_5_head);  
	$p_5_text = stripslashes($object->p_5_text); 
	$p_6_head = stripslashes($object->p_6_head);  
	$p_6_text = stripslashes($object->p_6_text); 
	$p_7_head = stripslashes($object->p_7_head);  
	$p_7_text = stripslashes($object->p_7_text);
	$p_8_head = stripslashes($object->p_8_head);  
	$p_8_text = stripslashes($object->p_8_text);
	
	
}else{
	$img_1_id = 0;
	$img_2_id = 0;
	$img_3_id = 0;
	$top_1 = '';
	$top_2 = '';	
	$top_3 = '';
	$p_1_head = '';
	$p_1_text = '';
	$p_2_head = '';
	$p_2_text = '';
	$p_3_head = ''; 
	$p_3_text = '';
	$p_4_head = '';
	$p_4_text = ''; 
	$p_5_head = '';  
	$p_5_text = ''; 
	$p_6_head = '';  
	$p_6_text = ''; 
	$p_7_head = '';  
	$p_7_text = '';
	$p_8_head = '';  
	$p_8_text = '';
	
}




					
$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_1_id."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_1_file_name = $img_obj->file_name;
}else{
	$img_1_file_name = '';
}	

$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_2_id."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_2_file_name = $img_obj->file_name;
}else{
	$img_2_file_name = '';
}	

$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_3_id."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_3_file_name = $img_obj->file_name;
}else{
	$img_3_file_name = '';
}	

$shop_by2_hide = 0;
$shop_by2_block = '';
$shop_by1_hide = 0;
$shop_by1_block = '';

/*
if(!$shop_by1_hide){

	$cats = $nav->getHomePageCats('cart', 8);

	$i = 1;

	foreach($cats as $val){

	$img = "./saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
	$url_str = $nav->getCatUrl($val['name'],$val['profile_cat_id'],'showroom');			

	$shop_by1_block .= "<div 
	style='float:left;
	background-color:#A8B1B8;	
	width:300px; 
	height:300px;
	border-style: solid;'>";
	$shop_by1_block .= "<a href='".$url_str."'>";	
	$shop_by1_block .= "<br />";
	$shop_by1_block .= "<img src='".$img."' />";
	$shop_by1_block .= "<br />";
	$shop_by1_block .= $val['name'];			
	
	$shop_by1_block .= "<br />";
	$shop_by1_block .= "</a>";
	$shop_by1_block .= "</div>";
			
	$i++;
		
	}
}
$shop_by1_block .= "<div style='clear:both;'> </div>";	
*/


/*
if(!$shop_by2_hide){
	$cats = array();
	$cats = $nav->getHomePageCats('showroom',8);	
	$i = 1;
	$n = 0;
	foreach($cats as $val){
		$url_str = $nav->getCatUrl($val['name'],$val['profile_cat_id'],'showroom');			
		if ($n % 2 == 1){
			$shop_by2_block .= "<div style='float:left; 
							background-color:#BBDAE3;
							width:525px; 
							height:406px;
							border-style:solid;'>";
			$shop_by2_block .= "<a href='".$url_str."'>";	
			$img = "./saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$val['file_name'];
			$shop_by2_block .= "<img width='525' height='406' src='".$img."' />";
		}else{
			$shop_by2_block .= "<div style='float:left; 
								background-color:#BBDAE3;
								width:460px; 
								height:406px;
								border-style:solid;'>";
			$shop_by2_block .= "<a href='".$url_str."'>";		
			$img = "./saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
			$shop_by2_block .= "<img width='460' height='406'src='".$img."' />";
		
		}	
		$n++;
		$shop_by2_block .= "<br />".$val['name'];
	}
	$shop_by2_block .= "</a>";
	$shop_by2_block .= "</div>";
	$i++;	
}
$shop_by2_block .= "<div style='clear:both;'> </div>";	
*/

			/*
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);

			$sql = "SELECT cat_id, name FROM category WHERE profile_account_id = '1'";
			$result = $dbCustom->getResult($db,$sql);
	
			while($row = $result->fetch_object()) {
				echo $row->cat_id;
				echo "<br />";
			}
			exit;
			*/

$cats = array();
$cats = $nav->getHomePageCats('showroom',6);	

$i = 0;
foreach($cats as $val){
	
	$i++;
	
	//$url_str = $nav->getCatUrl($val['name'],$val['profile_cat_id'],'showroom');			
	$nm = stripSlashes($val['name']);	
	$nm = $nav->getUrlText($nm);
	
	// THIS FUNCTIONS ALSO ADDS DOTS 
	//$name = get_shorter($nm, 20);
	//$name = str_replace (".." ,"." ,$name);
	
	$name = substr($nm,0,60);	

	//....com/showroom-category-120/kitchen.html
	$url_str = $ste_root."showroom-category-".$val['cat_id']."/".$name.".html";
		

	if($i % 5 == 1){		
		$shoroom_images .= "<div class='col-12 col-lg-6 hidden-box open'>";
		$img = "./saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$val['file_name'];
		
	}else{
		$shoroom_images .= "<div class='col-12 col-lg-3 hidden-box open'>";
		$img = "./saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
	}
	
	$shoroom_images .= "<figure class='showroom-block__item'>";
	$shoroom_images .= "<img src='".$img."' alt='' class='showroom-block__item--img'>";
	$shoroom_images .= "<figcaption class='showroom-block__item--wrapper'>";
	$shoroom_images .= "<div class='showroom-block__item--content'>";
	$shoroom_images .= "<h2>".$val['name']."</h2>";
	$shoroom_images .= "<div class='showroom-block__item--images'>";
	$shoroom_images .= "<img src='images/Group174.svg' alt=''>";
	$shoroom_images .= "<p>10k 214</p>";
	$shoroom_images .= "</div>";
	$shoroom_images .= "<p>Current users in ".$val['name']."</p>";
	$shoroom_images .= "<a href='".$url_str."'>";	
	$shoroom_images .= "view category";
	$shoroom_images .= "<svg xmlns='http://www.w3.org/2000/svg' 
					width='20.8' 
					height='14.623' 
					viewBox='0 0 20.8 14.623'>";
	$shoroom_images .= "<path id='left-arrow_3_' data-name='left-arrow(3)'
	d='M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z'
	transform='translate(0.001 -4.676)'/>";
	$shoroom_images .= "</svg>";
	$shoroom_images .= "</a>";
	$shoroom_images .= "</div>";
	$shoroom_images .= "</figcaption>";
	$shoroom_images .= "</figure>";
	
	
	$shoroom_images .= "</div>";


}



?>

