<?php	
setcookie('ctg_store_view','list',time() + (86400 * 360), '/');								
require_once("../../includes/config.php");
require_once("../../includes/db_connect.php"); 
require_once("../../includes/accessory_cart_functions.php");
require_once("../../includes/class.shopping_cart.php");
require_once("../../includes/class.shopping_cart_item.php");
require_once("../../includes/class.search.php");
require_once("../../includes/class.module.php");
$module = new Module;

$cart = new ShoppingCart;

$search = new Search;

$item = new ShoppingCartItem;

$_SESSION["ctg_store_view"] = "list";

$search_string = (isset($_GET["search_string"])) ? $_GET["search_string"] : '';

$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

$page_rows = (isset($_GET['page_rows'])) ? addslashes($_GET['page_rows']) : 4;

$added_items  = (isset($_GET['added_items'])) ? addslashes($_GET['added_items']) : '';
$added_items = "-".$added_items;

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
	for(i=1;i<=list_ol_len;i++){
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
				t_url = "<?php echo SITEROOT; ?>/closet-accessory-details/closets-accessory-item/";
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

//echo $search_string;



$long_array = $search->GetSearchResultsCartItems($search_string, 1);

$total_products = count($long_array); 



$last = ceil($total_products/$page_rows); 
if ($pagenum < 1){ 
	$pagenum = 1; 
}elseif ($pagenum > $last){ 
	$pagenum = $last; 
} 

$start_elmt = ($pagenum - 1) * $page_rows;

$max_elmt = $page_rows;

$clean_items_array = array();

if(count($long_array) > 0){
	$clean_items_array = array_slice($long_array, $start_elmt, $max_elmt);
}

//echo getStoreItemBar($total_products, 0, 1, $pagenum, $last);


$has_accessories = 0;
foreach($clean_items_array as $val) {
	if(isClosetSystem($val["item_id"])){
		$has_accessories = 1;
		break;	
	}
}



//print_r($clean_items_array);

//echo "ppppp".count($clean_items_array);

if(count($clean_items_array) > 0){
		
	//echo "There are no accessory items in this search";
	
	echo getStoreItemBar($total_products, 0, 0, $pagenum, $last, 0, 0, '', 0, 0, "search");
	
	//$block ="KKKK:<div id='t'></div>";
	$block ='';
	$block .="<div class='accessories_list_head_row'>";
		$block .="<div style='padding-left:148px; float:left;'>Name</div>";
		$block .="<div style='padding-left:346px; float:left;'>Price</div>";
		$block .="<div style='padding-right:18px; float:right;'>Qty</div>";
		$block .="<div class='clear'></div>";
	$block .="</div>";
	$block .="<div class='clear'></div>";
	echo $block;

	$i = 0;

	$block = '';			

	
	if($has_accessories){
		$block .= "<div style='position:relative; top:-14px;'>";	
		$block .= "<img onclick='add_items()' src='".SITEROOT."/images/button_add_cart_sm.jpg' style='outline:none;' />";
		$block .= "</div>";	
		$block.="<form name='add_with_qty_form' action='".SITEROOT."/storage-shop/closet-item-w-qty.html' method='post'>";
		$block.="<input type='hidden' name='str_items'>";	
	}else{
		$block.="<div style='height:22px;'>&nbsp;</div>";
	}


	
	$block .= "<div id='list_under_lay'></div>";// this fixes bug in chrome and ie

	foreach ($clean_items_array as $item_id) {


		//echo "<br />".$item_id; 

		
	//for($i=0; $i<count($clean_items_array); $i++){	
		
		$item_array = $item->getItem($item_id);
		$i++;
		
		
		
		$block .= "<div id='list_under_lay".$i."' class='list_rol_outer_box'>";
		
			$block .= "<div class='e_sub' id='".$item_id."' style='display:none'></div>";
			$block .= "<div class='n_sub' id='".getUrlText($item_array['name'])."' style='display:none'></div>";
			$block .= "<div class='c_sub' id='0' style='display:none'></div>";

			$block .= "<div class='accessories_list_row'>";

				//$block .= "<div style='float:left; position:relative; top:34px; left:-10px;'>";
				//	$block .= "<input name='item_ids' type='checkbox' value='".$val."'/>";
				//$block .= "</div>";
			
				$block .= "<div style='float:left; position:relative;'>";
					$block .= "<a href='".SITEROOT."/closet-accessory-details/closets-accessory-item/";
					$block .= getUrlText($item_array['name'])."/".$item_id."/0' style='text-decoration:none;'>";
					$block .= "<img src='".SITEROOT."/ul_cart/".$domain."/cart/list/".$item_array['file_name']."' alt='closet organizers'/>";
					$block .= "</a>";
				$block .= "</div>";

				$block .= "<div style='float:left; padding-left:40px;'>";
					$block .= "<div style='font-weight:bold; padding-top:6px; width:180px;'>".$item_array['name']."</div>";					
					$block .= "<div style='padding-top:6px;'>Product ID:  ".$item_id."</div>";
					//$block .= "<div style='padding-top:6px;'><img src='".SITEROOT."/images/5-star.png' alt='closet organizers'/></div>";
				$block .= "</div>";

				$block .= "<div style='float:left; padding-left:182px; font-weight:bold; padding-top:6px;'>";
					$block .= "$".number_format($cart->getItemPrice($item_id),2);			
				$block .= "<span style='font-weight:normal;'>/ per ea</span>";
				$block .= "</div>";
				$block .= "<div class='clear'></div>";
	
				$block .= "<div style='float:right; position:relative; top:-80px;'>";	
				
				if(isClosetSystem($item_id)){
					//$block .= "<a href='".SITEROOT."/closet-design-online.html'>Start Design</a>";
					$block .= "<a href='".SITEROOT."/app/'>Start Design</a>";
				}elseif(strpos($added_items, $item_id) > 0){
					$block .= "added";				
				}else{
					if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){
						$block .= "QTY&nbsp;&nbsp;<input id='qty".$item_id."' type='text'  name='qtys'  value='' style='width:30px; height:22px;'>";
						$block .= "<br /><br /><a style='cursor:pointer;' onclick='add_item(".$item_id.")'>Add To Cart</a>";
					}
				
				}
				$block .= "</div>";	
					
			$block .= "</div>";
		$block .= "</div>";	

		

	}
	

	if($has_accessories){
		$block .= "<div style='position:relative; top:10px; left:0'>";	
		$block .= "<img onclick='add_items()' src='".SITEROOT."/images/button_add_cart_sm.jpg' style='outline:none;' />";
		$block .= "</div>";	
	}
	
	$block .= "</form>";	
	echo $block;
	
	
	
	
	
				
}
	
	
				
			
?>			

