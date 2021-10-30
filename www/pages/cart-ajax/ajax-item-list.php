<?php			
setcookie('ctg_store_view','list',time() + (86400 * 360), '/');			
require_once("<?php echo SITEROOT; ?>includes/config.php");
require_once("<?php echo SITEROOT; ?>includes/db_connect.php"); 
require_once("<?php echo SITEROOT; ?>includes/accessory_cart_functions.php");
require_once("<?php echo SITEROOT; ?>includes/class.shopping_cart.php");
require_once("<?php echo SITEROOT; ?>includes/class.module.php");
$module = new Module;

$cart = new ShoppingCart;

$_SESSION["ctg_store_view"] = "list";



$cat_id = (isset($_GET['cat_id'])) ? addslashes($_GET['cat_id']) : 1;

$vend_man_id= (isset($_GET['vend_man_id'])) ? addslashes($_GET['vend_man_id']) : 0;

$brand_id = (isset($_GET['brand_id'])) ? addslashes($_GET['brand_id']) : 0;

//echo $brand_id;

$cat_name = (isset($_GET['cat_name'])) ? addslashes($_GET['cat_name']) : '';

$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

$page_rows = (isset($_GET['page_rows'])) ? addslashes($_GET['page_rows']) : 4;


//echo $page_rows; 

$added_items  = (isset($_GET['added_items'])) ? addslashes($_GET['added_items']) : '';
$added_items = "-".$added_items;

$shop_name = getURLFileName('item-details');

$db = $dbCustom->getDbConnect(CART_DATABASE);

?>

<script>
$(document).ready(function() {

		$('.page_number').hover(
		  function () {
			$(this).removeClass('page_number');
			$(this).addClass('page_number_over');
		  }, 
		  function () {		  
			$(this).removeClass('page_number_over');
			$(this).addClass('page_number');
		  }
		);


	var list_ol_len = $('.list_rol_outer_box').length;
	
	//alert(list_ol_len);
	
	for(i=0;i<list_ol_len;i++){
		$('#list_under_lay'+i).hover(
			function () {		
				$(this).find(".accessories_list_row").css('background', '#cde5f0');
			},			
			function () {
				$(this).find(".accessories_list_row").css('background', 'white');
			}		
		);
	}


	/* ********** to make row clickable ************** */
	for(i=0;i<list_ol_len;i++){
		$('#list_under_lay'+i).click(
			function () {		
				//item id
				var i_id = $(this).find(".e_sub").attr('id');
				// item name
				var n_id = $(this).find(".n_sub").attr('id');
				// cat id
				var c_id = $(this).find(".c_sub").attr('id');
				
				var d_id = $(this).find(".d_sub").attr('id');
				
				t_url = "<?php echo SITEROOT; ?>"+d_id+"/item/";
				t_url += n_id+"/"+i_id+"/"+c_id;
				window.location = t_url;
			}		
		);
	}
	

});

function add_items(){
	var str_items = '';
	if(typeof(document.add_with_qty_form.qtys) != "undefined"){
		for(var i=0; i < document.add_with_qty_form.qtys.length; i++){
			if(IsNumeric(document.add_with_qty_form.qtys[i].value) && document.add_with_qty_form.qtys[i].value != 0){
				str_items += document.add_with_qty_form.qtys[i].id+"|"+document.add_with_qty_form.qtys[i].value+",";
			}
		}	
	}
	document.add_with_qty_form.str_items.value = str_items;
	document.add_with_qty_form.submit();
}

function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;   
}

</script>

<?php
//echo "cat_id".$cat_id."<br />";


// get num rows
if($cat_id > 0){

//echo $cat_id;

	$sql = "SELECT child_cat_to_parent_cat_id
			FROM child_cat_to_parent_cat
			WHERE child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'";
				
$result = $dbCustom->getResult($db,$sql);	

				
	if($result->num_rows > 0){

		$sql = "SELECT DISTINCT item.item_id 
					,item.name
					,image.file_name
					,item.is_closet 
				FROM item, item_to_category, category, child_cat_to_parent_cat, image
				WHERE item.item_id = item_to_category.item_id
				AND item_to_category.cat_id = category.cat_id
				AND child_cat_to_parent_cat.child_cat_id = category.cat_id
                AND item.img_id = image.img_id
				AND (child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'
					OR category.cat_id = '".$cat_id."')
				AND date_inactive > NOW()
				AND date_active <= NOW()
				AND category.show_in_cart = '1'
				AND item.parent_item_id = '0'				
				AND item.show_in_cart = '1'
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
				
	}else{

				
		$sql = "SELECT DISTINCT item.item_id 
						,item.name
						,image.file_name
						,item.is_closet
				FROM item, item_to_category, category, image
				WHERE item.item_id = item_to_category.item_id
				AND item_to_category.cat_id = category.cat_id
				AND item.img_id = image.img_id
				AND category.cat_id = '".$cat_id."'
				AND date_inactive > NOW()
				AND date_active <= NOW()
				AND item.parent_item_id = '0'
				AND item.show_in_cart = '1'
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
						
			}

}elseif($brand_id > 0){

	$sql = "SELECT DISTINCT item.item_id
				,item.name
				,image.file_name
				,item.is_closet
			FROM item, image
			WHERE item.img_id = image.img_id
			AND item.brand_id = '".$brand_id."'
			AND item.parent_item_id = '0'
			AND item.show_in_cart = '1'
			AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
	
}else{
	$sql = "SELECT DISTINCT item.item_id
					,item.name
					,image.file_name
					,item.is_closet
			FROM item, image
			WHERE item.img_id = image.img_id
			AND item.vend_man_id = '".$vend_man_id."'
			AND item.parent_item_id = '0'
			AND item.show_in_cart = '1'
			AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
}

$nmx_res = $dbCustom->getResult($db,$sql);


$has_accessories = 0;
//$has_accessories = 1;

$rows = $nmx_res->num_rows;

$last = ceil($rows/$page_rows); 

if ($pagenum < 1){ 
 	$pagenum = 1; 
}elseif ($pagenum > $last){ 
	$pagenum = $last; 
} 

$limit = ' limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	  
$sql .= "ORDER BY item.item_id".$limit;
 
$result = $dbCustom->getResult($db,$sql);
$num_res = $result->num_rows;

echo getStoreItemBar($rows, 0, 0, $pagenum, $last, $vend_man_id, $cat_id, $cat_name, 0, 0, 'cart', $brand_id);

if(!$num_res){
	
	if($brand_id < 1){
		echo "There are no items in this category<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";		
	}else{
		
		echo "There are no items for this brand.";
		echo "<br />";
		
		$sql = "SELECT web_site
				FROM brand
				WHERE brand_id = '".$brand_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			$brand_web_site_obj = mysql_fetch_object($brand_web_site_res);
			$brand_web_site = $brand_web_site_obj->web_site;
		}else{
			$brand_web_site;	
		}
		
		if($brand_web_site != ''){
			echo "You can visit the brand website at <a href='".$brand_web_site."' target='_blank' >$brand_web_site</a>";
			echo "<br />";	
		}else{
		
			$sql = "SELECT vend_man.web_site
					FROM vend_man, vend_man_brand
					WHERE vend_man.vend_man_id = vend_man_brand.vend_man_id
					AND vend_man_brand.brand_id = '".$brand_id."'";
			
			
			while($vend_row = $result->fetch_object()){
				echo "You can visit this vendor website here: <a href='".$vend_row->web_site."' target='_blank' >$vend_row->web_site</a>";
				echo "<br />";
			}
		}
		
	}
		
	
}else{

	//$block ="HHHH:<div id='t'></div>";
	$block = '';
	$block .="<div class='accessories_list_head_row'>";
		$block .="<div style='padding-left:120px; float:left;'>Name</div>";
		$block .="<div style='padding-left:326px; float:left;'>Price</div>";
		$block .="<div style='padding-right:28px; float:right;'></div>";
		$block .="<div class='clear'></div>";
	$block .="</div>";
	echo $block;

	$block = '';
/*
	if($has_accessories){			
		
		$block .= "<div style='position:relative; top:-22px;'>";	
		$block .= "<img onclick='add_items()' src='".SITEROOT."//images/button_add_cart_sm.jpg' style='outline:none;' />";
		$block .= "</div>";	
		$block.="<form name='add_with_qty_form' action='".SITEROOT."//storage-shop/closet-item-w-qty.html' method='post'>";
		$block.="<input type='hidden' name='cat_id' value='".$cat_id."'>";
		$block.="<input type='hidden' name='str_items'>";	

	}else{
		$block.="<div style='height:22px;'>&nbsp;</div>";
	}
*/	
	
	$block.="<div style='height:22px;'>&nbsp;</div>";
	
	$i = 0;

	$block .= "<div id='list_under_lay'></div>";// this fixes bug in chrome and ie

	while($row = $result->fetch_object()) {	
			
		$block .= "<div id='list_under_lay".$i."' class='list_rol_outer_box'>";
			
			$block .= "<div class='e_sub' id='".$row->item_id."' style='display:none'></div>";
			$block .= "<div class='n_sub' id='".getUrlText($row->name)."' style='display:none'></div>";
			$block .= "<div class='c_sub' id='".$cat_id."' style='display:none'></div>";
			$block .= "<div class='d_sub' id='".$_SESSION["details_name"]."' style='display:none'></div>";
			
			$block .= "<div class='accessories_list_row'>";
				
				//$block .= "<div style='float:left; position:relative; top:34px; left:-10px;'>";
				//	$block .= "<input name='item_ids' type='checkbox' value='".$row->item_id."'/>";
				//$block .= "</div>";
				
				$block .= "<div style='float:left; position:relative;'>";
				
				
					$block .= "<a href='".SITEROOT."//".$_SESSION["details_name"]."/item/";
					$block .= getUrlText($row->name)."/".$row->item_id."/".$cat_id."' style='text-decoration:none;'>";
					$block .= "<img src='".SITEROOT."//ul_cart/".SITEROOT."/cart/list/".$row->file_name."' alt='closet organizers'/>";
					$block .= "</a>";
				$block .= "</div>";
				$block .= "<div style='float:left; padding-left:40px;'>";
					$block .= "<div style='font-weight:bold; padding-top:6px; width:180px;'>".$row->name."</div>";					
					$block .= "<div style='padding-top:6px;'>Product ID:  ".$row->item_id."</div>";
					//$block .= "<div style='padding-top:6px;'><img src='".SITEROOT."//images/5-star.png' alt='closet organizers'/></div>";
				$block .= "</div>";
				$block .= "<div style='float:left; padding-left:182px; font-weight:bold; padding-top:6px;'>";
					$block .= "$".number_format($cart->getItemPrice($dbCustom,$row->item_id),2);			
				$block .= "<span style='font-weight:normal;'>/ per ea</span>";
				$block .= "</div>";
				$block .= "<div class='clear'></div>";
				
				
				$block .= "<div style='float:right; position:relative; top:-80px;'>";	
	
				//if(isClosetSystem($row->item_id)){
					
				if($row->is_closet){	
					//$block .= "<a href='".SITEROOT."//closet-design-online.html'>Start Design</a>";
					$block .= "<a href='".SITEROOT."//app/'>Start Design</a>";
				
				}elseif(strpos($added_items, $row->item_id) > 0){
					$block .= "added";				
				}else{
					if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){
						$block .= "QTY&nbsp;&nbsp;<input id='qty".$row->item_id."' type='text'  name='qtys'  value='1' style='width:30px; height:22px;'>";										
						$block .= "<br /><br /><a style='cursor:pointer;' onclick='add_item(".$row->item_id.")'>Add To Cart</a>";
					}
				}
								
				$block .= "</div>";	
			
			$block .= "</div>";
		$block .= "</div>";	

		$i++;

	}

/*

	if($has_accessories){			
		$block .= "<div style='position:relative; top:10px; left:0'>";	
		$block .= "<img onclick='add_items()' src='".SITEROOT."//images/button_add_cart_sm.jpg' style='outline:none;' />";
		$block .= "</div>";	
		$block .= "</form>";	
	}
*/

	echo $block;

	if($i == 1){
		echo "<div style='height:280px;'></div>";
	}
	if($i == 2){
		echo "<div style='height:200px;'></div>";
		
	}
	if($i == 3){
		echo "<div style='height:120px;'></div>";	
	}
				
}
				
			
?>			

