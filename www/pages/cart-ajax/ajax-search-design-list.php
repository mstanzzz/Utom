<?php	
//setcookie('ctg_store_view','list',time() + (86400 * 360), '/');								
require_once("<?php echo SITEROOT; ?>includes/config.php");
require_once("<?php echo SITEROOT; ?>includes/db_connect.php"); 
require_once("<?php echo SITEROOT; ?>includes/accessory_cart_functions.php");

require_once("<?php echo SITEROOT; ?>includes/class.search.php");

if(!isset($search)) $search = new Search;

$search_string = (isset($_GET["search_string"])) ? $_GET["search_string"] : '';

$design_pagenum = (isset($_GET['design_pagenum'])) ? addslashes($_GET['design_pagenum']) : 0;

$design_page_rows = (isset($_GET['design_page_rows'])) ? addslashes($_GET['design_page_rows']) : 4;

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

				t_url = "<?php echo SITEROOT; ?>/app/";
				t_url += "#direct="+i_id;
				window.location = t_url;
			}		
		);
	}

	
	
	
	
	
});


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




$long_array = $search->GetSearchResultsDesigns($search_string);

$total_products = count($long_array); 

$last = ceil($total_products/$design_page_rows); 
if ($design_pagenum < 1){ 
	$design_pagenum = 1; 
}elseif ($design_pagenum > $last){ 
	$design_pagenum = $last; 
} 



$start_elmt = ($design_pagenum - 1) * $design_page_rows;

$max_elmt = $design_page_rows;

$clean_items_array = array();

if(count($long_array) > 0){
	$clean_items_array = array_slice($long_array, $start_elmt, $max_elmt);
}


//print_r($clean_items_array);

//echo "ppppp".count($clean_items_array);

if(count($clean_items_array) > 0){


	echo getStoreDesignBar($total_products, 0, 0, $design_pagenum, $last, "search");
	
	//$block ="KHKH:<div id='t'></div>";
	$block ='';
	$block .="<div class='accessories_list_head_row'>";
		$block .="<div style='padding-left:40px; float:left;'>Designs</div>";
		$block .="<div style='padding-left:346px; float:left;'>Price</div>";
		$block .="<div style='padding-right:18px; float:right;'></div>";
		$block .="<div class='clear'></div>";
	$block .="</div>";
	$block .="<div class='clear'></div>";
	echo $block;

	$i = 1;

	$block = '';			

	
	$block.="<div style='height:22px;'>&nbsp;</div>";
	
	$block .= "<div id='list_under_lay'></div>";// this fixes bug in chrome and ie

	foreach ($clean_items_array as $design_id) {


		$db = $dbCustom->getDbConnect(DESIGN_DATABASE);
		$sql = "SELECT price, name 
				FROM design
				WHERE id = '".$design_id."'";
					
$result = $dbCustom->getResult($db,$sql);				
		$object = $result->fetch_object();	
				
		
		$block .= "<div id='list_under_lay".$i."' class='list_rol_outer_box'>";

			$block .= "<div class='e_sub' id='".$design_id."' style='display:none'></div>";

	
			$block .= "<div class='accessories_list_row'>";

				//$block .= "<div style='float:left; position:relative; top:34px; left:-10px;'>";
				//	$block .= "<input name='item_ids' type='checkbox' value='".$val."'/>";
				//$block .= "</div>";
			

				$block .= "<div style='float:left; padding-left:40px;'>";
					$block .= "<div style='font-weight:bold; padding-top:6px; width:180px;'>".$object->name."</div>";					
					$block .= "<div style='padding-top:6px;'>Product ID:  ".$design_id."</div>";
				$block .= "</div>";

				$block .= "<div style='float:left; padding-left:182px; font-weight:bold; padding-top:6px;'>";
					$block .= "$".number_format($object->price,2);			
				$block .= "<span style='font-weight:normal;'>/ per ea</span>";
				$block .= "</div>";
				$block .= "<div class='clear'></div>";
	
				$block .= "<div style='float:right;'>";	
				
				
				$block .= "</div>";	
					
			$block .= "</div>";
		$block .= "</div>";	

		$i++;

	}
	
	echo $block;
	
	
	
	
	
				
}
	
	
				
			
?>			

