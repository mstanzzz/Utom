<?php 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT *
		FROM showroom
		WHERE showroom.showroom_id = (SELECT MAX(showroom_id) FROM showroom WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);

//echo "num_rows: ".$result->num_rows;
//echo "<br />";
//echo "<br />";

if($result->num_rows > 0){
	$object = $result->fetch_object();

	$img_id = $object->img_id;
	
	$p_1_head = stripslashes($object->p_1_head);
	$p_1_text = stripslashes($object->p_1_text);
	
}else{
	$img_id = 0;
	$p_1_head = "We manufacture all our closet organizers with top quality materials right here in the USA.";
	$p_1_text = "And we've been doing it for nearly three decades. Learn more about our company below or contact us for more information about placing an order or our custom closet systems.";
}

echo $img_id;
echo "<br />";
					
$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_id."'";				
$result = $dbCustom->getResult($db,$sql);

//echo "num_rows ".$result->num_rows;
//echo "<br />";
if($result->num_rows > 0){
	$object = $result->fetch_object();

	$hero_file_name = $object->file_name;
}else{
	$hero_file_name = '';
}	

//echo "hero_file_name  ".$hero_file_name;
//exit;







$cat_id = (isset($_GET['CatId']))? $_GET['CatId'] : 0;
if(!is_numeric($cat_id)) $cat_id = 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$items_array = array();

if($cat_id > 0){

	$items_array = $store_data->getItemsFromCat($dbCustom,$cat_id);
	//print_r($items_array);

}	

//echo $cat_id;
//exit;


$cat_block = '';
$i = 0;
foreach($items_array as $val){

	if($i == 6) $i = 0;

	$i++;			
	//$url_str = $nav->getCatUrl($val['name'], $val['profile_cat_id'], 'showroom');		
	//$url_str = "showroom-detail-view.html";				
	//$url_str = "organizer-landing-page.html";		
	
	$nm = stripSlashes($val['name']);	
	$nm = $nav->getUrlText($nm);
	
	// THIS FUNCTIONS ALSO ADDS DOTS 
	//$name = get_shorter($nm, 20);
	//$name = str_replace (".." ,"." ,$name);
	
	$name = substr($nm,0,60);	
	//echo "name:  ".$name; 
	//echo "<br />";
	//echo $url_str;
	//exit;
		
	// IS THIS A SHOWROOM ITEM 	
	if($val['show_in_cart']){
	//if(0){	
		//...com/closet-organizers/showroom-76/reach-in-craft-closet-organizer.html
		//$url_str = SITEROOT."/category-".$val['item_id']."/".$name.".html";		
		$url_str = SITEROOT."product-".$val['item_id']."/".$name.".html";
		
		//echo $url_str;
		//exit;		
		
	}else{
	
		// IS THIS A SHOWROOM ITEM 
	
		$url_str = SITEROOT."/category-".$val['item_id']."/".$name.".html";
		//$url_str = SITEROOT."product-".$val['item_id']."/".$name.".html";
		
		
	}

	


	if($i % 5 == 1){
			
		$img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$val['file_name'];
		//$img = "<?php echo SITEROOT; ?>images/showroom-1.png";


		$cat_block .= "<div class='col-12 col-lg-6 hidden-box open'>";
		$cat_block .= "<figure class='showroom-block__item'>";
		$cat_block .= "<img src='".$img."' alt='' class='showroom-block__item--img'>";
		$cat_block .= "<figcaption class='showroom-block__item--wrapper'>";
		$cat_block .= "<div class='showroom-block__item--content'>";
		$cat_block .= "<h2>Showroom product preview</h2>";
		$cat_block .= "<a href='".$url_str."' title='' class='link-button'>";
		$cat_block .= "Explore now";
		$cat_block .= "<svg xmlns='http://www.w3.org/2000/svg' width='20.8' height='14.623' viewBox='0 0 20.8 14.623'>";
		$cat_block .= "<path id='left-arrow_3_' data-name='left-arrow(3)'"; 
		$cat_block .= " d='M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z'";
		$cat_block .= " transform='translate(0.001 -4.676)'></path>";
		$cat_block .= "</svg>";
		$cat_block .= "</a>";
		$cat_block .= "<div class='showroom-block__item--images'>";
		$cat_block .= "<img src='<?php echo SITEROOT; ?>images/Group174.svg' alt=''>";
		$cat_block .= "<p>/ 275 views</p>";
		$cat_block .= "</div>";
		$cat_block .= "<button class='save-for-idea' data-img-path='images/showroom-1.png' tabindex='0'>";
		$cat_block .= "</button>";
		$cat_block .= "</div>";
		$cat_block .= "</figcaption>";
		$cat_block .= "</figure>";
		$cat_block .= "</div>";
		
	}else{
		$img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
		//$img = "<?php echo SITEROOT; ?>images/showroom-2.png";			

		$cat_block .= "<div class='col-6 col-lg-3 hidden-box open'>";
		$cat_block .= "<figure class='showroom-block__item'>";
		$cat_block .= "<img src='".$img."' alt='' class='showroom-block__item--img'>";
		$cat_block .= "<figcaption class='showroom-block__item--wrapper'>";
		$cat_block .= "<div class='showroom-block__item--content'>";
		$cat_block .= "<h2>Showroom product preview</h2>";
		$cat_block .= "<a href='".$url_str."' title='' class='link-button'>";
		$cat_block .= "Explore now";
		$cat_block .= "<svg xmlns='http://www.w3.org/2000/svg' width='20.8' height='14.623' viewBox='0 0 20.8 14.623'>";
		$cat_block .= "<path id='left-arrow_3_' data-name='left-arrow(3)'";
		$cat_block .= " d='M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z'"; 
		$cat_block .= " transform='translate(0.001 -4.676)'></path>";
		$cat_block .= "</svg>";
		$cat_block .= "</a>";
		$cat_block .= "<div class='showroom-block__item--images'>";
		$cat_block .= "<img src='<?php echo SITEROOT; ?>images/Group174.svg' alt=''>";
		$cat_block .= "<p>/ 275 views</p>";
		$cat_block .= "</div>";
		$cat_block .= "<button class='save-for-idea' data-img-path='images/showroom-2.png' tabindex='0'>";
		//<!-- <img src="<?php echo SITEROOT; ?>images/icon-save-white.svg" alt="" class="img-fluid"> -->
		$cat_block .= "</button>";
		$cat_block .= "</div>";
		$cat_block .= "</figcaption>";
		$cat_block .= "</figure>";
		$cat_block .= "</div>";

	}
}

//echo $cat_block;

//exit;

?>
