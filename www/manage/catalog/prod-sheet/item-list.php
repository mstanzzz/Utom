<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php"); 
$this_script = $this_page.'.php';


$cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$search_str = (isset($_REQUEST['search_str'])) ?  trim(addslashes($_REQUEST['search_str'])) : ''; 



function prod_sheet_get_img($img_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	//echo $img_id;
	//echo "<br />";
	

	$ret = '';
	$sql = "SELECT file_name FROM image WHERE img_id = '".$img_id."'";
	$res = $dbCustom->getResult($db,$sql);
	if($res->num_rows > 0){			
		$obj = $res->fetch_object();
		$ret = $obj->file_name;
	}

//echo "<br />";
//echo $ret;
//echo "<br />";
//echo "<img src='".$ste_root."/saascustuploads/1/cart/thumb/".$ret."' />";
	
	return $ret;
} 

/* not used
function prod_sheet_get_brand($brand_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$ret = 'none';
	$sql = "SELECT name  
            FROM brand 
            WHERE brand_id = '".$brand_id."'";
	$result = $dbCustom->getResult($db,$sql);
    if($result->num_rows >0){
		$object = $result->fetch_object();
		$ret = $object->name; 
	}
	return $ret;
}
*/


$db = $dbCustom->getDbConnect(CART_DATABASE);

$brand_array = array();
$sql = "SELECT brand_id, name  
		FROM brand 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$i = 0;
while($row = $result->fetch_object()){	
	$brand_array[$i]['brand_id'] = $row->brand_id;
	$brand_array[$i]['name'] = $row->name;
	$i++;
}


if(isset($_POST['add_item'])){
	include('../include-add-item.php');
}

if(isset($_POST['edit_item'])){
	include('../include-edit-item.php');
}


if(isset($_POST['del_item_id'])){

	$item_id = $_POST['del_item_id'];
	$sql = "UPDATE item
			SET parent_item_id = '0'
			WHERE parent_item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);		
	$sql = "DELETE FROM item 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);		
	$sql = "DELETE FROM item_to_opt 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);		
	$sql = "DELETE FROM item_to_kit 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM item_to_kit 
			WHERE kit_item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM item_gallery 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM item_rating 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM item_review 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM item_to_category 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM item_to_document 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM item_to_media 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM item_to_opt 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM item_to_vend_man 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$msg = 'Your change is now live.';

}



if($cat_id > 0){
	
	$sql = "SELECT DISTINCT item.name
				,item.description
				,item.item_id
				,item.img_id
				,item.brand_id
				,item.parent_item_id
				,item.show_in_cart
				,item.show_in_showroom
				,item.is_closet
				,item.short_description	
				,item.prod_number
				,item.sku
				,item.upc
				,item.vendor_part_num
				,item.is_drop_shipped
				,item.active
				,item.price_flat
				,item.price_wholesale
				,item.percent_markup
				,item.call_for_pricing
				,item.shipping_flat_charge
				,item.show_in_showroom
				,item.show_in_tool
				,item.show_start_design_btn
				,item.show_design_request_btn
				,item.is_free_shipping
				,item.in_house_price_tool				
				,item.flooring
				,item.added_value				
		FROM  item, item_to_category 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'			
		AND item.item_id = item_to_category.item_id 						
		AND item_to_category.cat_id = '".$cat_id."'";
		
}else{
	
	$sql = "SELECT DISTINCT item.name
				,item.description
				,item.item_id
				,item.img_id
				,item.brand_id
				,item.parent_item_id
				,item.show_in_cart
				,item.show_in_showroom
				,item.is_closet
				,item.short_description	
				,item.prod_number
				,item.sku
				,item.upc
				,item.vendor_part_num
				,item.is_drop_shipped
				,item.active
				,item.price_flat
				,item.price_wholesale
				,item.percent_markup
				,item.call_for_pricing
				,item.shipping_flat_charge
				,item.show_in_showroom
				,item.show_in_tool
				,item.show_start_design_btn
				,item.show_design_request_btn
				,item.is_free_shipping
				,item.in_house_price_tool
				,item.flooring
				,item.added_value
		FROM  item 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			
}
				
if($search_str != ''){
	if(is_numeric($search_str)){
		$sql .= " AND (item.name like '%".$search_str."%' 
					OR item.profile_item_id = '".$search_str."'
					OR item.item_id = '".$search_str."'
					OR item.internal_prod_number = '".$search_str."')";				
	}else{
		$sql .= " AND item.name like '%".$search_str."%'";
	}
}

$sql .= " ORDER BY item_id";
	
$result = $dbCustom->getResult($db,$sql);

$all_item_array = array();

$i = 0;		
while($row = $result->fetch_object()){

	$all_item_array[$i]['item_id'] = $row->item_id;
	$all_item_array[$i]['img_id'] = $row->img_id;
	$all_item_array[$i]['name'] = stripslashes($row->name);
	$all_item_array[$i]['brand_id'] = $row->brand_id;
	$all_item_array[$i]['sku'] = $row->sku;
	$all_item_array[$i]['upc'] = $row->upc;
	$all_item_array[$i]['vendor_part_num'] = $row->vendor_part_num;
	$all_item_array[$i]['is_drop_shipped'] = $row->is_drop_shipped;
	$all_item_array[$i]['active'] = $row->active;
	$all_item_array[$i]['price_flat'] = $row->price_flat;
	$all_item_array[$i]['price_wholesale'] = $row->price_wholesale;
	$all_item_array[$i]['percent_markup'] = $row->percent_markup;
	$all_item_array[$i]['call_for_pricing'] = $row->call_for_pricing;
	$all_item_array[$i]['shipping_flat_charge'] = $row->shipping_flat_charge;	
	$all_item_array[$i]['show_in_showroom'] = $row->show_in_showroom;
	$all_item_array[$i]['show_in_tool'] = $row->show_in_tool;
	$all_item_array[$i]['show_start_design_btn'] = $row->show_start_design_btn;
	$all_item_array[$i]['show_design_request_btn'] = $row->show_design_request_btn;	
	$all_item_array[$i]['is_free_shipping'] = $row->is_free_shipping;	
	$all_item_array[$i]['in_house_price_tool'] = $row->in_house_price_tool;	
	$all_item_array[$i]['flooring'] = $row->flooring;	
	$all_item_array[$i]['added_value'] = $row->added_value;	


	if(!isset($_SESSION["is_active_checked_".$row->item_id])){	
		$_SESSION["is_active_checked_".$row->item_id] = $row->active; 
	}

	if(!isset($_SESSION["is_call_for_pricing_checked_".$row->item_id])){	
		$_SESSION["is_call_for_pricing_checked_".$row->item_id] = $row->call_for_pricing; 
	}

	if(!isset($_SESSION["is_show_in_cart_checked_".$row->item_id])){	
		$_SESSION["is_show_in_cart_checked_".$row->item_id] = $row->show_in_cart; 
	}

	if(!isset($_SESSION["is_show_in_showroom_checked_".$row->item_id])){	
		$_SESSION["is_show_in_showroom_checked_".$row->item_id] = $row->show_in_showroom; 
	}

	if(!isset($_SESSION["is_show_in_tool_checked_".$row->item_id])){	
		$_SESSION["is_show_in_tool_checked_".$row->item_id] = $row->show_in_tool; 
	}

	if(!isset($_SESSION["is_show_start_design_btn_checked_".$row->item_id])){	
		$_SESSION["is_show_start_design_btn_checked_".$row->item_id] = $row->show_start_design_btn; 
	}

	if(!isset($_SESSION["is_show_design_request_btn_checked_".$row->item_id])){	
		$_SESSION["is_show_design_request_btn_checked_".$row->item_id] = $row->show_design_request_btn; 
	}

	if(!isset($_SESSION["is_free_shipping_checked_".$row->item_id])){	
		$_SESSION["is_free_shipping_checked_".$row->item_id] = $row->is_free_shipping; 
	}

	if(!isset($_SESSION["is_in_house_price_tool_checked_".$row->item_id])){	
		$_SESSION["is_in_house_price_tool_checked_".$row->item_id] = $row->in_house_price_tool; 
	}







	if(!isset($_SESSION["brand_id_".$row->item_id])){	
		$_SESSION["brand_id_".$row->item_id] = $row->brand_id;
	}	

	if(!isset($_SESSION["price_flat_".$row->item_id])){	
		$_SESSION["price_flat_".$row->item_id] = $row->price_flat;
	}

	if(!isset($_SESSION["price_wholesale_".$row->item_id])){	
		$_SESSION["price_wholesale_".$row->item_id] = $row->price_wholesale;
	}

	if(!isset($_SESSION["percent_markup_".$row->item_id])){	
		$_SESSION["percent_markup_".$row->item_id] = $row->percent_markup;
	}	
	
	if(!isset($_SESSION["shipping_flat_charge_".$row->item_id])){	
		$_SESSION["shipping_flat_charge_".$row->item_id] = $row->shipping_flat_charge;
	}	
	
	if(!isset($_SESSION["flooring_".$row->item_id])){	
		$_SESSION["flooring_".$row->item_id] = $row->flooring;
	}	
	
	if(!isset($_SESSION["added_value_".$row->item_id])){	
		$_SESSION["added_value_".$row->item_id] = $row->added_value;
	}	
		
	
	$i++; 	
}

$page = (isset($_GET['page']))? $_GET['page'] : 1;
if(!is_numeric($page)) $page = 1;
if($page < 1) $page = 1;

$total = count($all_item_array);    
$limit = 10;    
$totalPages = ceil($total/$limit );
if($page > $totalPages) $page = $totalPages;
$offset = ($page - 1) * $limit;
if($offset < 0 ) $offset = 0;
$item_array = array_slice($all_item_array, $offset, $limit );


?>


<!DOCTYPE html>
<html lang="en">
<head>

<style>
	input.largerCheckbox { 
            width: 20px; 
            height: 20px; 
	} 
	
	input.price_box {
            width: 80px; 
            height: 20px; 
		
	}
	
</style>		

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>

function set_is_item_active(item_id){
	
	var is_checked =  document.getElementById('is_active_check_box_'+item_id).checked; 
	
	var numerate = 0;
	
	if(is_checked) numerate = 1;
	
	alert(is_checked+"  "+numerate);

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-is-checked-box.php";
	url_str += "?item_id="+item_id+"&numerate="+numerate+"&from=item-list&type=IS_ACT";;
	
	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});

}


function set_item_brand(item_id){

	var brand_id =  document.getElementById('item_brand_select_'+item_id).value; 

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-item-brand.php";
	url_str += "?item_id="+item_id+"&brand_id="+brand_id+"&from=item-list";
	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
}


function set_item_call_for_pricing(item_id){
	
	alert(item_id);
	
	var is_checked =  document.getElementById('call_for_pricing_check_box_'+item_id).checked; 
	
	alert(is_checked);
	
	var numerate = 0;
	
	if(is_checked) numerate = 1;
	
	alert(is_checked+"  "+numerate);

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-is-checked-box.php";
	url_str += "?item_id="+item_id+"&numerate="+numerate+"&from=item-list&type=call_FP";
	
	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
	
}

function set_item_show_in_cart(item_id){
	
	alert(item_id);
	
	var is_checked =  document.getElementById('show_in_cart_check_box_'+item_id).checked; 
	
	alert(is_checked);
	
	var numerate = 0;
	
	if(is_checked) numerate = 1;
	
	alert(is_checked+"  "+numerate);

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-is-checked-box.php";
	url_str += "?item_id="+item_id+"&numerate="+numerate+"&from=item-list&type=SHICRT";
	
	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
}


function set_item_show_in_showroom(item_id){
	
	alert(item_id);
	
	var is_checked =  document.getElementById('show_in_cart_check_box_'+item_id).checked; 
	
	alert(is_checked);
	
	var numerate = 0;
	
	if(is_checked) numerate = 1;
	
	alert(is_checked+"  "+numerate);

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-is-checked-box.php";
	url_str += "?item_id="+item_id+"&numerate="+numerate+"&from=item-list&type=SHISRM";
	
	axios.get(url_str).then(function(response){
		console.log(response.data);					
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
}


function set_item_is_show_in_tool_checked(item_id){
	
	alert(item_id);
	
	var is_checked =  document.getElementById('is_show_in_tool_check_box_'+item_id).checked; 
	
	alert(is_checked);
	
	var numerate = 0;
	
	if(is_checked) numerate = 1;
	
	alert(is_checked+"  "+numerate);

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-is-checked-box.php";
	url_str += "?item_id="+item_id+"&numerate="+numerate+"&from=item-list&type=SHITOOL";
	
	axios.get(url_str).then(function(response){
		console.log(response.data);					
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
}



function set_item_is_show_start_design_btn_checked(item_id){

	alert(item_id);
	
	var is_checked =  document.getElementById('is_show_start_design_btn_check_box_'+item_id).checked; 
	
	alert(is_checked);
	
	var numerate = 0;
	
	if(is_checked) numerate = 1;
	
	alert(is_checked+"  "+numerate);

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-is-checked-box.php";
	url_str += "?item_id="+item_id+"&numerate="+numerate+"&from=item-list&type=SSTDESBTN";
	
	axios.get(url_str).then(function(response){
		console.log(response.data);					
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});

}



function set_item_is_show_design_request_btn_checked(item_id){
	
	alert(item_id);
	
	var is_checked =  document.getElementById('is_show_design_request_btn_check_box_'+item_id).checked; 
	
	alert(is_checked);
	
	var numerate = 0;
	
	if(is_checked) numerate = 1;
	
	alert(is_checked+"  "+numerate);

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-is-checked-box.php";
	url_str += "?item_id="+item_id+"&numerate="+numerate+"&from=item-list&type=SSTDEREQSBTN";
	
	axios.get(url_str).then(function(response){
		console.log(response.data);					
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
}


function set_item_is_free_shipping_checked(item_id){

	alert(item_id);
	
	var is_checked =  document.getElementById('is_free_shipping_check_box_'+item_id).checked; 
	
	alert(is_checked);
	
	var numerate = 0;
	
	if(is_checked) numerate = 1;
	
	alert(is_checked+"  "+numerate);

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-is-checked-box.php";
	url_str += "?item_id="+item_id+"&numerate="+numerate+"&from=item-list&type=FREESHIP";
	
	axios.get(url_str).then(function(response){
		console.log(response.data);					
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});

}



function set_item_in_house_price_tool_checked(item_id){
	

	alert(item_id);
	
	var is_checked =  document.getElementById('in_house_price_tool_check_box_'+item_id).checked; 
	
	alert(is_checked);
	
	var numerate = 0;
	
	if(is_checked) numerate = 1;
	
	alert(is_checked+"  "+numerate);

	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-is-checked-box.php";
	url_str += "?item_id="+item_id+"&numerate="+numerate+"&from=item-list&type=INHPRCTOOL";
	
	axios.get(url_str).then(function(response){
		console.log(response.data);					
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
	
}



function set_item_price_flat(item_id){

	var price_flat =  document.getElementById('item_price_flat_'+item_id).value; 
	
	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-item-price-flat.php";
	url_str += "?item_id="+item_id+"&price_flat="+price_flat+"&from=item-list";
	//alert(url_str);
	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		//alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
}


function set_item_price_wholesale(item_id){
	
	var price_wholesale =  document.getElementById('item_price_wholesale_'+item_id).value; 
	
	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-item-price-wholesale.php";
	url_str += "?item_id="+item_id+"&price_wholesale="+price_wholesale+"&from=item-list";
	//alert(url_str);
	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
}

function set_item_percent_markup(item_id){
	
	var percent_markup =  document.getElementById('item_percent_markup_'+item_id).value; 
	
	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-item-percent-markup.php";
	url_str += "?item_id="+item_id+"&percent_markup="+percent_markup+"&from=item-list";
	//alert(url_str);
	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
}

function set_item_shipping_flat_charge(item_id){
	
	var shipping_flat_charge =  document.getElementById('item_shipping_flat_charge_'+item_id).value; 
	
	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-item-shipping-flat-charge.php";
	url_str += "?item_id="+item_id+"&shipping_flat_charge="+shipping_flat_charge+"&from=item-list";
	//alert(url_str);
	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
	
}



	
function set_item_flooring(item_id){
		
	var flooring =  document.getElementById('item_flooring_'+item_id).value; 
	
	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-item-flooring.php";
	url_str += "?item_id="+item_id+"&flooring="+flooring+"&from=item-list";
	//alert(url_str);
	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
		
}
		

function set_item_added_value(item_id){

alert(item_id);
		
		
	var added_value =  document.getElementById('item_added_value_'+item_id).value; 

alert(added_value);


	
	var url_str = "<?php echo $ste_root; ?>/manage/ajax/ajax-set-item-added-value.php";
	url_str += "?item_id="+item_id+"&added_value="+added_value+"&from=item-list";

	axios.get(url_str).then(function(response){
		console.log(response.data);			
		
		alert(response.data);
		
	}).catch(function(error){
		console.log(error);
	});
		
}
	
		


/*
function regularSubmit() {
  document.form.submit(); 
}
*/	

</script>
</head>

<body>

<?php
$link = $this_script."?page=%d";
$pagerContainer = "<div style='width: 300px;'>";   
if($totalPages != 0) 
{
  if($page == 1){ 
    $pagerContainer .= ''; 
  }else{ 
    $pagerContainer .= sprintf("<a href='".$link."' style='color: #c00'> &#171; prev page</a>", $page - 1); 
  }
  $pagerContainer .= "<span style='margin-left:30px; margin-right:10px;'>Page</span>";
  $pagerContainer .= "<span style='margin-right:10px;'>".$page."</span>";
  $pagerContainer .= "<span style='margin-right:10px;'>Of</span>";
  $pagerContainer .= "<span style='margin-right:10px;'>".$totalPages."</span>"; 
  if($page == $totalPages ){ 
    $pagerContainer .= ''; 
  }else{ 
    $pagerContainer .= sprintf("<a href='".$link."' style='color: #c00'>next page &#187; </a>", $page + 1 ); 
  }           
}                   
$pagerContainer .= "</div>";

echo $pagerContainer;

?>
<br />

	<table width="100%" cellspacing="1" cellpadding="1" border="1" style="background: #7499CA; color:white;"> 

	<tr height="60" style="color:#D2E7FC; font-size:18px; background:#5576A3; ">
    <td>&nbsp;</td> 
    <td align="center">Item No</td> 
    <td>Name</td>
	<td align="center">Brand</td>
	<td align="center" width="6%">Active</td>
	<td align="center" width="6%">Call For price</td>
	<td align="center" width="6%">Show in Cart</td>
	<td align="center" width="6%">Show in Showroom</td>
	<td align="center" width="6%">Show in Tool</td>
	<td align="center" width="6%">Show Start Design Button</td>
	<td align="center" width="6%">Show Start Design Request Button</td>	
	<td align="center" width="6%">Free Shipping</td>
	<td align="center" width="6%">In House Price Tool</td>
	
	<td align="center">Flat Price</td>
	<td align="center">Wholesale</td>
	<td align="center">Percent Markup</td>
	<td align="center">Shipping Flat Charge</td>
	<td align="center">Flooring</td>
	<td align="center">Added Value</td>
	
	
	
    <td></td>
    
    </tr>
    <?php
	$block = "";
	
    foreach($item_array as $val){
	
        $fnimg = prod_sheet_get_img($val['img_id']);

		$img = "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$fnimg."'>";
		
		//$brand = prod_sheet_get_brand($val['brand_id']);
        
		$block .= "<tr>";
		$block .= "<td align='center'>".$img."</td>";		
        $block .= "<td align='center'>".$val['item_id']."</td>";
        $block .= "<td>".$val['name']."</td>";

        $block .= "<td align='center'>";
		$block .= "<select name='brand_id' onChange='set_item_brand(".$val['item_id'].");' id='item_brand_select_".$val['item_id']."'>";		
		foreach($brand_array as $brand_val){
			$sel = ($brand_val['brand_id'] == $_SESSION["brand_id_".$val['item_id']])? "selected" : '';
			$block .= "<option value='".$brand_val['brand_id']."' ".$sel.">".$brand_val['name']."</option>"; 			
		}
		$block .= "</select>";				
		$block .= "</td>";
	
		$checked = ($_SESSION["is_active_checked_".$val['item_id']] == 1)? "checked" : "";
		
		$block .= "<td align='center'>";
		$block .= "<input type='checkbox' class='largerCheckbox' ".$checked;
		$block .= " name='is_active' value='1' id='is_active_check_box_".$val['item_id']."'";
		$block .= " onClick='set_is_item_active(".$val['item_id'].");'  />"; 		
		$block .= "</td>";

		$checked = ($_SESSION["is_call_for_pricing_checked_".$val['item_id']] == 1)? "checked" : "";
		$block .= "<td align='center'>";
		$block .= "<input type='checkbox' class='largerCheckbox' ".$checked; 
		$block .= " name='call_for_pricing' value='1' id='call_for_pricing_check_box_".$val['item_id']."'";
		$block .= " onClick='set_item_call_for_pricing(".$val['item_id'].");'  />"; 		
		$block .= "</td>";
		
		
		$checked = ($_SESSION["is_show_in_cart_checked_".$val['item_id']] == 1)? "checked" : "";
		$block .= "<td align='center'>";
		$block .= "<input type='checkbox' class='largerCheckbox' ".$checked; 
		$block .= " name='show_in_cart' value='1' id='show_in_cart_check_box_".$val['item_id']."'";
		$block .= " onClick='set_item_show_in_cart(".$val['item_id'].");'  />"; 		
		$block .= "</td>";
		
		$checked = ($_SESSION["is_show_in_showroom_checked_".$val['item_id']] == 1)? "checked" : "";
		$block .= "<td align='center'>";
		$block .= "<input type='checkbox' class='largerCheckbox' ".$checked; 
		$block .= " name='show_in_showroom' value='1' id='show_in_showroom_check_box_".$val['item_id']."'";
		$block .= " onClick='set_item_show_in_showroom(".$val['item_id'].");'  />"; 		
		$block .= "</td>";


		$checked = ($_SESSION["is_show_in_tool_checked_".$val['item_id']] == 1)? "checked" : "";
		$block .= "<td align='center'>";
		$block .= "<input type='checkbox' class='largerCheckbox' ".$checked; 
		$block .= " name='is_show_in_tool_checked' value='1' id='is_show_in_tool_check_box_".$val['item_id']."'";
		$block .= " onClick='set_item_is_show_in_tool_checked(".$val['item_id'].");'  />"; 		
		$block .= "</td>";


		$checked = ($_SESSION["is_show_start_design_btn_checked_".$val['item_id']] == 1)? "checked" : "";
		$block .= "<td align='center'>";
		$block .= "<input type='checkbox' class='largerCheckbox' ".$checked; 
		$block .= " name='show_start_design_btn' value='1' id='is_show_start_design_btn_check_box_".$val['item_id']."'";
		$block .= " onClick='set_item_is_show_start_design_btn_checked(".$val['item_id'].");'  />"; 		
		$block .= "</td>";


		$checked = ($_SESSION["is_show_design_request_btn_checked_".$val['item_id']] == 1)? "checked" : "";
		$block .= "<td align='center'>";
		$block .= "<input type='checkbox' class='largerCheckbox' ".$checked; 
		$block .= " name='show_design_request_btn' value='1' id='is_show_design_request_btn_check_box_".$val['item_id']."'";
		$block .= " onClick='set_item_is_show_design_request_btn_checked(".$val['item_id'].");'  />"; 		
		$block .= "</td>";


		$checked = ($_SESSION["is_free_shipping_checked_".$val['item_id']] == 1)? "checked" : "";
		$block .= "<td align='center'>";
		$block .= "<input type='checkbox' class='largerCheckbox' ".$checked; 
		$block .= " name='is_free_shipping' value='1' id='is_free_shipping_check_box_".$val['item_id']."'";
		$block .= " onClick='set_item_is_free_shipping_checked(".$val['item_id'].");'  />"; 		
		$block .= "</td>";


		$checked = ($_SESSION["is_in_house_price_tool_checked_".$val['item_id']] == 1)? "checked" : "";
		$block .= "<td align='center'>";
		$block .= "<input type='checkbox' class='largerCheckbox' ".$checked; 
		$block .= " name='in_house_price_tool' value='1' id='in_house_price_tool_check_box_".$val['item_id']."'";
		$block .= " onClick='set_item_in_house_price_tool_checked(".$val['item_id'].");'  />"; 		
		$block .= "</td>";




		$block .= "<td align='center'><input class='price_box' type='text' name='price_flat' id='item_price_flat_".$val['item_id']."'";
		$block .= " value='".$_SESSION["price_flat_".$val['item_id']]."' onBlur='set_item_price_flat(".$val['item_id'].");'  />";
		$block .= "</td>";				

		$block .= "<td align='center'><input class='price_box' type='text' name='price_wholesale' id='item_price_wholesale_".$val['item_id']."'";
		$block .= " value='".$_SESSION["price_wholesale_".$val['item_id']]."' onBlur='set_item_price_wholesale(".$val['item_id'].");'  />";
		$block .= "</td>";
		
		$block .= "<td align='center'><input class='price_box' type='text' name='percent_markup' id='item_percent_markup_".$val['item_id']."'";
		$block .= " value='".$_SESSION["percent_markup_".$val['item_id']]."' onBlur='set_item_percent_markup(".$val['item_id'].");'  />";
		$block .= "</td>";
		
		$block .= "<td align='center'><input class='price_box' type='text' name='shipping_flat_charge' id='item_shipping_flat_charge_".$val['item_id']."'";
		$block .= " value='".$_SESSION["shipping_flat_charge_".$val['item_id']]."' onBlur='set_item_shipping_flat_charge(".$val['item_id'].");'  />";
		$block .= "</td>";
				
		$block .= "<td align='center'><input class='price_box' type='text' name='flooring' id='item_flooring_".$val['item_id']."'";
		$block .= " value='".$_SESSION["flooring_".$val['item_id']]."' onBlur='set_item_flooring(".$val['item_id'].");'  />";
		$block .= "</td>";
	
		$block .= "<td align='center'><input class='price_box' type='text' name='added_value' id='item_added_value_".$val['item_id']."'";
		$block .= " value='".$_SESSION["added_value_".$val['item_id']]."' onBlur='set_item_added_value(".$val['item_id'].");'  />";
		$block .= "</td>";
		

		$block .= "<td></td>";
 				
		$block .= "</tr>";
    }
    
    echo $block; 
	
    ?>
    </table>

 


</body>
</html>
<?php 


unset($_SESSION['ret_page']);
unset($_SESSION['ret_dir']);
unset($_SESSION['ret_path']);
unset($_SESSION['item_id']);
unset($_SESSION['temp_item_fields']);
unset($_SESSION['temp_item_cats']);
unset($_SESSION['temp_attr_opt_ids']);
unset($_SESSION['new_img_id']);
unset($_SESSION['img_id']);
unset($_SESSION['parent_item_id']);
unset($_SESSION['paging']);
unset($_SESSION['search_str']);
unset($_SESSION['temp_gallery']);
unset($_SESSION['temp_documents']);
unset($_SESSION['temp_videos']);
unset($_SESSION['img_type']);
unset($_SESSION['side_nav_showroom_cats']); // frontend class.nav






 ?>
