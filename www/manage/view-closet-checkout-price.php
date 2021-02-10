<?php
/*
	Use: 
		Closets To Go CMS 
		Display a sample checkout with all discounts and coupons
	Called from 
	Variables:


	Coupons:
		a coupon has a code
		once the customer makes a purchase using a coupon, a record will be stored in used_coupons{cust_id, coupon_code}

*/
require_once("../includes/config.php"); 
require_once("../admin-includes/db_connect.php");
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);




// activate timed discounts if needed  
$sql = "UPDATE global_discount SET hide = '0' 
		WHERE when_active <= '".$ts."' 
		AND when_expired > '".$ts."'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);// expire timed  discounts if needed  
$sql = "UPDATE global_discount SET hide = '1' 
		WHERE (when_expired > '0'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'  
		AND when_expired <= '".$ts."') OR (when_active > '".$ts."')";
$result = $dbCustom->getResult($db,$sql);

function viewArray($arr,$start=0,$forward=0) {
 
 if(count($arr) < 1){
  echo "Empty";
 }else{
 
   if($start > 0 ){
   $t_array = array_slice($arr,$start,$forward);
   
  }else{
   $t_array = $arr;
   
  }
  $count = 0;
  echo '<table cellpadding="0" cellspacing="0" border="1">';
  
  foreach ($t_array as $key1 => $elem1) {
 
   echo '<tr>';
 
   echo '<td>'. $count .'&nbsp;'.$key1.'&nbsp;</td>';
 
   if (is_array($elem1)) { extArray($elem1); }
 
   else { echo '<td>'.$elem1.'&nbsp;</td>'; }
 
   echo '</tr>';
 
   $count ++;
   if($forward > 0){
    if($count > $forward){break;} 
   }
 
  }
 
  echo '</table>';
 }
}
function extArray($arr) {
               echo '<td>';
               echo '<table cellpadding="0" cellspacing="0" border="1">';
       foreach ($arr as $key => $elem) {
                       echo '<tr>';
                       echo '<td>'.$key.'&nbsp;</td>';
         if (is_array($elem)) { extArray($elem); }
   else { echo '<td>'.htmlspecialchars($elem).'&nbsp;</td>'; }
       echo '</tr>';
  }
echo '</table>';
echo '</td>';
}


$showroom_item_id = $_REQUEST['showroom_item_id']; 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Item As Checkout</title>

<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />
</head>

<body>



<?php include("includes/manage-header.php"); ?>

<div class="page_title_top_spacer"></div>
<div class="page_title">
View item as checkout

<div class="top_right_link">
    <?php
	$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "start";
	echo "<a href='".$ret_page.".php'>< BACK</a>";
	?>        
    </div> 
  	<div class="top_link">
  		<a href='global-discount.php?ret_page=list-closets'>global discounts</a>
    </div>
    
</div>

<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>
<div class="page_container">
	
<?php 

/* global coupon types
discount
coupon
discount_closet
coupon_closet
discount_accessory
coupon_accessory
*/

$is_discount = 0;
$is_discount_closet = 0;
$is_coupon = 0;
$is_coupon_closet = 0;

$discount_perc_v = 0;
$discount_closet_perc_v = 0;
$item_perc_v = 0;
$c_perc_v = 0;

//get the all products discount   
$sql = "SELECT * FROM global_discount 
		WHERE type = 'discount'
		AND profile_account_id = '".$_SESSION['profile_account_id']."' 
		AND hide = '0'";
$discount_res = mysql_query ($sql);
if(!$discount_res)die(mysql_error());
if(mysql_num_rows($discount_res)){
	$discount_object = mysql_fetch_object($discount_res);
	$is_discount = 1;
	//echo "<br />".$discount_object->name;
}

//get the closet discount  
$sql = "SELECT * FROM global_discount 
		WHERE type = 'discount_closet'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'
		AND hide = '0'";

$discount_closet_res = mysql_query ($sql);
if(!$discount_closet_res)die(mysql_error());
if(mysql_num_rows($discount_res)){
	$discount_closet_object = mysql_fetch_object($discount_closet_res);
	$is_discount_closet = 1;
	//echo "<br />".$discount_closet_object->name;
}

//get the coupon  
$sql = "SELECT * FROM global_discount 
		WHERE type = 'coupon'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'
		AND hide = '0'";
$coupon_res = mysql_query ($sql);
if(!$coupon_res)die(mysql_error());
if(mysql_num_rows($coupon_res)){
	$coupon_object = mysql_fetch_object($coupon_res);
	$is_coupon = 1;
	//echo "<br />".$coupon_object->name."<br />";
}

//get the closet coupon  
$sql = "SELECT * FROM global_discount 
		WHERE type = 'coupon_closet'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'
		AND hide = '0'";
$coupon_closet_res = mysql_query ($sql);
if(!$coupon_closet_res)die(mysql_error());
if(mysql_num_rows($coupon_res)){
	$coupon_closet_object = mysql_fetch_object($coupon_closet_res);
	$is_coupon_closet = 1;
	//echo "<br />".$coupon_closet_object->name."<br />";
}


$sql = "SELECT * FROM showroom_item 
		WHERE showroom_item_id = '".$showroom_item_id."'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);$object = $result->fetch_object();

$global_discounts_applied_array[0]["id"] = 0; 

// can they both be used together?
if($discount_object->can_use_with_other_discounts && $discount_closet_object->can_use_with_other_discounts){


	if($discount_object->if_greater_than < $object->price && $discount_object->if_less_than > $object->price){ 
	
		$global_discounts_applied_array[0]["id"] = $discount_object->global_discount_id;
		$global_discounts_applied_array[0]["type"] = "discount";
		
		if($discount_object->percent_off > 0){
			$discount_perc_v = ($discount_object->percent_off/100) * $object->price;
		}
		
		$discount_amt_v = $discount_object->amount_off;
		if($discount_perc_v > $discount_amt_v){
			$global_discounts_applied_array[0]["mode"] = "percent";
			$global_discounts_applied_array[0]["p_off"] = $discount_object->percent_off;
			$global_discounts_applied_array[0]["value"] = $discount_perc_v;		
		}else{
			$global_discounts_applied_array[0]["mode"] = "amount";
			$global_discounts_applied_array[0]["value"] = $discount_amt_v;		
		}

	}

	if($discount_closet_object->if_greater_than < $object->price && $discount_closet_object->if_less_than > $object->price){ 
	
		$global_discounts_applied_array[1]["id"] = $discount_closet_object->global_discount_id;
		$global_discounts_applied_array[1]["type"] = "discount_closet";

		if($discount_closet_object->percent_off > 0){
			$discount_closet_perc_v = ($discount_closet_object->percent_off/100) * $object->price;
		}
		$discount_closet_amt_v = $discount_closet_object->amount_off;
		
		if($discount_closet_perc_v > $discount_closet_amt_v){
			$global_discounts_applied_array[1]["mode"] = "percent";
			$global_discounts_applied_array[1]["p_off"] = $discount_closet_object->percent_off;		
			$global_discounts_applied_array[1]["value"] = $discount_closet_perc_v;		
		}else{
			$global_discounts_applied_array[1]["mode"] = "amount";
			$global_discounts_applied_array[1]["value"] = $discount_closet_amt_v;		
		}

	}


}else{


	if($is_discount){
		if($discount_object->if_greater_than < $object->price && $discount_object->if_less_than > $object->price){ 		
			if($discount_object->percent_off > 0){
				$discount_perc_v = ($discount_object->percent_off/100) * $object->price; 
			}
			$discount_amt_v = $discount_object->amount_off; 	
		}
	}else{

		$discount_perc_v = 0; 	
		$discount_amt_v = 0; 	
	}

	if($is_discount_closet){
		if($discount_closet_object->if_greater_than < $object->price && $discount_closet_object->if_less_than > $object->price){
			if($discount_closet_object->percent_off > 0){
				$discount_closet_perc_v = ($discount_closet_object->percent_off/100) * $object->price;
			}
			$discount_closet_amt_v = $discount_closet_object->amount_off; 	
		}
	}else{
		$discount_closet_perc_v = 0;
		$discount_closet_amt_v = 0; 	
	}

	if(($discount_perc_v >= $discount_amt_v) 
		&& ($discount_perc_v >= $discount_closet_perc_v) 
		&& ($discount_perc_v >= $discount_closet_amt_v))
	{
		$global_discounts_applied_array[0]["id"] = $discount_object->global_discount_id;
		$global_discounts_applied_array[0]["type"] = "discount";
		$global_discounts_applied_array[0]["mode"] = "percent";
		$global_discounts_applied_array[0]["p_off"] = $discount_object->percent_off;			
		$global_discounts_applied_array[0]["value"] = $discount_perc_v;		
	}
	
	if(($discount_amt_v >= $discount_perc_v) 
		&& ($discount_amt_v >= $discount_closet_perc_v) 
		&& ($discount_amt_v >= $discount_closet_amt_v))
	{
		$global_discounts_applied_array[0]["id"] = $discount_object->global_discount_id;
		$global_discounts_applied_array[0]["type"] = "discount";
		$global_discounts_applied_array[0]["mode"] = "amount";
		$global_discounts_applied_array[0]["value"] = $discount_amt_v;		
	}

	if(($discount_closet_perc_v >= $discount_perc_v) 
		&& ($discount_closet_perc_v >= $discount_amt_v) 
		&& ($discount_closet_perc_v >= $discount_closet_amt_v))
	{
		$global_discounts_applied_array[0]["id"] = $discount_closet_object->global_discount_id;
		$global_discounts_applied_array[0]["type"] = "discount_closet";
		$global_discounts_applied_array[0]["mode"] = "percent";
		$global_discounts_applied_array[0]["p_off"] = $discount_closet_object->percent_off;					
		$global_discounts_applied_array[0]["value"] = $discount_closet_perc_v;		
	}

	if(($discount_closet_amt_v >= $discount_perc_v) 
		&& ($discount_closet_amt_v >= $discount_amt_v) 
		&& ($discount_closet_amt_v >= $discount_closet_perc_v))
	{
		$global_discounts_applied_array[0]["id"] = $discount_closet_object->global_discount_id;		
		$global_discounts_applied_array[0]["type"] = "discount_closet";
		$global_discounts_applied_array[0]["mode"] = "amount";
		$global_discounts_applied_array[0]["value"] = $discount_closet_amt_v;		
	}	

}



// get the item level discount
if($object->percent_off > 0 || $object->amount_off > 0){
	
	$gda_index = sizeof($global_discounts_applied_array);
	if($object->percent_off > 0){
		$item_perc_v = ($object->percent_off/100) * $object->price;
	}
	$item_amt_v = $object->amount_off;
	
	$global_discounts_applied_array[$gda_index]["type"] = "showroom_item";

	if($item_perc_v > $item_amt_v){
		$global_discounts_applied_array[$gda_index]["mode"] = "percent";
		$global_discounts_applied_array[$gda_index]["p_off"] = $object->percent_off;
		$global_discounts_applied_array[$gda_index]["value"] = $item_perc_v;		
	}else{
		$global_discounts_applied_array[$gda_index]["mode"] = "amount";
		$global_discounts_applied_array[$gda_index]["value"] = $item_amt_v;		
	}
}


if(isset($_POST["coupon_code"])){
	
	$coupon_code = trim(addslashes($_POST["coupon_code"]));

	//get the coupon  
	$sql = "SELECT * FROM global_discount 
			WHERE (type = 'coupon' OR type = 'coupon_closet')
			AND coupon_code = '".$coupon_code."'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'
			AND hide = '0'";
	$c_res = mysql_query ($sql);
	if(!$c_res)die(mysql_error());
	
	$gda_index = sizeof($global_discounts_applied_array);
 	//echo $gda_index;
 	//exit;
	
	if(mysql_num_rows($c_res)){

		$c_object = mysql_fetch_object($c_res);
		
		if($c_object->if_greater_than < $object->price && $c_object->if_less_than > $object->price){ 
				
			$global_discounts_applied_array[$gda_index]["id"] = $c_object->global_discount_id;		
			$global_discounts_applied_array[$gda_index]["type"] = $c_object->type;
				
			if($c_object->percent_off > 0){
				$c_perc_v = ($c_object->percent_off/100) * $object->price;
			}
			$c_amt_v = $c_object->amount_off;
	
			if($c_perc_v > $c_amt_v){
				$global_discounts_applied_array[$gda_index]["mode"] = "percent";
				$global_discounts_applied_array[$gda_index]["p_off"] = $c_object->percent_off;
				$global_discounts_applied_array[$gda_index]["value"] = $c_perc_v;		
	
			}else{
				$global_discounts_applied_array[$gda_index]["mode"] = "amount";
				$global_discounts_applied_array[$gda_index]["value"] = $c_amt_v;					
			}
		}
	}	
}

//print_r($global_discounts_applied_array);
//viewArray($global_discounts_applied_array);

?>

<table border="0" width="100%" cellpadding="10">
    <tr>
		<td width="20%"><div class="head">Type</div></td>
		<td width="15%"><div class="head">Value</div></td>
        <td><div class="head">Total</div></td>
	</tr>
<?php
$t_price = $object->price;
echo "<tr><td colspan='2'>Start Price</td><td> $".$t_price."</td></tr>";
$block = '';
foreach ($global_discounts_applied_array as $v){


	if($v["value"] > 0){
		
		if($v["type"] == "discount" || $v["type"] == "discount_closet"){
			
			if($v["mode"] == "percent"){
				$t_type = "Auto ".$v["p_off"]." % off";
			}else{
				$t_type = "Auto fixed";
			}
		}elseif($v["type"] == "showroom_item"){
			if($v["mode"] == "percent"){
				$t_type = "This closet ".$v["p_off"]." % off";
			}else{
				$t_type = "This closet fixed";
			}
		}else{
			
			if($v["mode"] == "percent"){
				$t_type = "Coupon ".$v["p_off"]." % off";
			}else{
				$t_type = "Coupon fixed";
			}
		}
	
		$t_price -= $v["value"];
		$t_fp = number_format($t_price,2);
		$t_val = number_format($v["value"],2);
		$block .= "<tr>";
		$block .= "<td>".$t_type."</td>";
		$block .= "<td>$".$t_val."</td>";
		$block .= "<td>$".$t_fp."</td>";
		$block .= "</tr>";
	
	}

}


echo $block;

echo "<tr><td colspan='2'>Final Price</td><td> <b>$".$t_fp."</b></td></tr></table><br /><br />";

if($is_coupon || $is_coupon_closet){
	
		//echo "<br />is_coupon:".$is_coupon."<br />";
		//echo "<br />is_coupon_closet:".$is_coupon_closet."<br />";
		
		echo " Enter Coupon Code<br />	
		<form action='view-closet-checkout-price.php' method='post'>
		<input type='hidden' name='showroom_item_id' value='".$showroom_item_id."'>				
		<input type='text' name='coupon_code' />
		<input type='submit'>
		</form>
		";
}


/*
	$amt = 0;
	
	$temp_amt = ($discount_object->percent_off/100) * $object->price;
	if($temp_amt > $amt){
		$amt = $temp_amt;
		$temp_id = $discount_object->global_discount_id;
	}

	$temp_amt = ($discount_object->amount_off;
	if($temp_amt > $amt){
		$amt = $temp_amt; 
		$temp_id = $discount_object->global_discount_id;	
	}
	
	$temp_amt = ($discount_closet_object->percent_off/100) * $object->price;
	if($temp_amt > $amt){
		$amt = $temp_amt;
		$temp_id = $discount_closet_object->global_discount_id;	
	}
	
	$temp_amt = ($discount_closet_object->amount_off;
	if($temp_amt > $amt){
		$amt = $temp_amt;
		$temp_id = $discount_closet_object->global_discount_id;		
	}

	$global_discounts_applied_array[] = $temp_id;

*/


?>





        
</div>
</body>
</html>



