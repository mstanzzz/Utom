<?php
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT *
		FROM home
		WHERE home.home_id = (SELECT MAX(home_id) 
							FROM home 
							WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);
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

$cats = array();
$cats = $nav->getHomePageCats($dbCustom,'showroom',6);	
$shoroom_images = '';
$i = 0;
foreach($cats as $val){
	
	$i++;
	
	$url_str = $nav->getCatUrl($val['name'],$val['profile_cat_id'],'showroom');	
	$url_str = SITEROOT.$url_str;
	
	$nm = stripSlashes($val['name']);	
	$nm = $nav->getUrlText($nm);
	
	$name = substr($nm,0,60);
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
	
	$shoroom_images .= "<a onClick='click_cat_count(".$val['cat_id'].");'  href='".$url_str."'>";	
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


$svgg = '<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
<path id="left-arrow_3_" data-name="left-arrow(3)"
d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z"
transform="translate(0.001 -4.676)"/>
</svg>';

$item_images = '';
$show_in = 'cart';
$limit = 6;
$items = $store_data->getItems($dbCustom,$show_in, $limit);
//print_r($items);
//exit;
foreach($items as $val){

	$nm = stripSlashes($val['name']);	
	$nm = $nav->getUrlText($nm);
	$name = substr($nm,0,60);	

	$url_str = SITEROOT."product-".$val['item_id']."/".$name.".html";
	$img = "./saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
	$item_img_height = '300';	
	
	$item_images .= "<figure class='col-12 col-lg-6 col-xl-4'>";
	$item_images .= "<div class='catalog-block__content'>";
	$item_images .= "<div class='catalog-block__content--image'>";					
	$item_images .= "<img height='".$item_img_height."' src='".$img."' alt=''>";
	$item_images .= "</div>";

	$item_images .= $svgg;
	
	
	$item_images .= "<figcaption class='desktop-show'>";
	$item_images .= "<p>".$name."</p>";
	$item_images .= "<a onClick='click_item_count(".$val['item_id'].")' href='".$url_str."' title='' class='link-button'>";
	$item_images .= "buy now";	
	$item_images .= "</a>";
	$item_images .= "</figcaption>";
	$item_images .= "</div>";
	$item_images .= "</figure>";

}

/*
$ths = rand(1,998);
$hds = rand(10,998);
$counter_one = $ths." K ".$hds;
echo "<br />";
echo "<br />";
echo "counter_one:  ".$counter_one;
$ths = rand(1,998);
$hds = rand(10,998);
$counter_two = $ths." K ".$hds;
echo "<br />";
echo "<br />";
echo "counter_two:  ".$counter_two;
$ths = rand(1,998);
$hds = rand(10,998);
$counter_three = $ths." K ".$hds;
echo "<br />";
echo "<br />";
echo "counter_three:  ".$counter_three;
$ths = rand(1,998);
$hds = rand(10,998);
$counter_four = $ths." K ".$hds;
echo "<br />";
echo "<br />";
echo "counter_four:  ".$counter_four;
*/

$testimonial_array = array();


$sql = "DELETE FROM testimonial
		WHERE testimonial_id = '355'";
//$result = $dbCustom->getResult($db,$sql);

$sql = "SELECT name, city_state, rating, content, testimonial_id
		FROM testimonial
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row=$result->fetch_object()){
	$cust_str = $row->name." ".$row->city_state;
	$testimonial_array[$i]['testimonial_id']=$row->testimonial_id;
	$testimonial_array[$i]['stars']=$row->rating;	
	$testimonial_array[$i]['cust_str']=$cust_str;
	$testimonial_array[$i]['body']=$row->content;
	//echo $row->content;
	//echo "<hr />";
	//echo "<br />";
	$i++;
}

//print_r($testimonial_array);
//exit;
/*
rand(int $min, int $max): int
$decimals = 0;
$decimal_separator = '.';
$thousands_separator = 'K ';
$counter_one = number_format($num,$decimals,$decimal_separator,$thousands_separator);
number_format(
    float $num,
    int $decimals = 0,
    ?string $decimal_separator = ".",
    ?string $thousands_separator = ","
): string

2K 457
SUCCESSFUL DIY INSTALLATIONS

10K 214
CURRENT USERS IN DESIGN TOOL

6K 873
CURRENT USERS SUBMITTING DESIGNS

10K 214
CURRENT USERS IN DESIGN TOOL
*/


	
?>
