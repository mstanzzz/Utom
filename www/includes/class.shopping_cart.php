<?php
require_once('accessory_cart_functions.php');

class ShoppingCart {

	public $customer_id;
	public $anonymous_shopper_id;
	public $cart_array;	
	public $total_price;
	public $total_weight_stock_items;
	
	function __construct($dbCustom){

	   $this->customer_id = (isset($_SESSION['ctg_cust_id']))? $_SESSION['ctg_cust_id'] : 0;
	   $this->anonymous_shopper_id = (isset($_SESSION['anonymous_shopper_id']))? $_SESSION['anonymous_shopper_id'] : rand();	
	   if(!isset($_SESSION['cart'])){
		   	$_SESSION['cart'] = array();
	   }
		$this->cart_array = $_SESSION['cart'];
		$this->reloadCart($dbCustom);
	}
	
	
	function saveCart($dbCustom){
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		if(count($_SESSION['cart']) > 0){
			//echo "this->customer_id:  ".$this->customer_id;
			//echo "<br />";
			//echo "this->anonymous_shopper_id:  ".$this->anonymous_shopper_id;
			//echo "<br />";
			if($this->customer_id > 0){
				$sql = sprintf("DELETE FROM saved_cart WHERE customer_id = '%u'", $this->customer_id);
				$result = $dbCustom->getResult($db,$sql);				
				foreach($_SESSION['cart'] as $val)
				{
					$sql = "INSERT INTO saved_cart 
							(item_id, qty, customer_id)
							VALUES
							('".$val['item_id']."','".$val['qty']."','".$this->customer_id."')";
					$res = $dbCustom->getResult($db,$sql);						
				}
				
			}elseif($this->anonymous_shopper_id > 0){
				$sql = "DELETE FROM saved_cart WHERE anonymous_shopper_id = '".$this->anonymous_shopper_id."'";
				$result = $dbCustom->getResult($db,$sql);
				foreach($_SESSION['cart'] as $val)
				{						
					$sql = "INSERT INTO saved_cart 
							(item_id, qty, anonymous_shopper_id)
							VALUES
							('".$val["item_id"]."','".$val["qty"]."','".$this->anonymous_shopper_id."')";
					$res = $dbCustom->getResult($db,$sql);	
				}
				
			}else{
				
				
			}
		}else{
		}
		$this->reloadCart($dbCustom);
		
	}
	
	function reloadCart($dbCustom){
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$load = 0;
		$this->total_price = 0;
		$this->total_weight_stock_items = 0;
		if($this->customer_id > 0){
			$sql = sprintf("SELECT item_id, qty
							FROM saved_cart 
							WHERE customer_id = '%u'
							ORDER BY saved_cart_id", $this->customer_id);
							
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 0){
				$load = 1;
			}
		}elseif($this->anonymous_shopper_id > 0){
			$sql = sprintf("SELECT item_id, qty
							FROM saved_cart 
							WHERE anonymous_shopper_id = '%u'
							ORDER BY saved_cart_id", $this->anonymous_shopper_id);
			$result = $dbCustom->getResult($db,$sql);	
			if($result->num_rows > 0){
				$load = 1;
			}
		}
		if($load){
			$t = array();
			$i = 0;
			while($row = $result->fetch_object()) {
				$sql = "SELECT profile_item_id
							,name
							,seo_url
							,weight
							,brand_id
							,shipping_flat_charge
							,is_free_shipping
							,is_drop_shipped
						FROM item
						WHERE item_id = '".$row->item_id."'";
				$res = $dbCustom->getResult($db,$sql);
				if($res->num_rows > 0){
					$object = $res->fetch_object();	
					$_SESSION['cart'][$i]['cat_id'] = $this->getCat($dbCustom,$row->item_id);
					$_SESSION['cart'][$i]['item_id'] = $row->item_id;				
					$_SESSION['cart'][$i]['profile_item_id'] = $object->profile_item_id;				
					$_SESSION['cart'][$i]['name'] = $object->name;
					$_SESSION['cart'][$i]['qty'] = $row->qty;
					$tmp_price = $this->getItemPrice($dbCustom,$row->item_id);
					$this->total_price += $row->qty*$tmp_price;
					$_SESSION['cart'][$i]['price'] = $tmp_price;
					$_SESSION['cart'][$i]['image_file'] = $this->getItemPic($dbCustom,$row->item_id);
					$_SESSION['cart'][$i]['seo_url'] = $object->seo_url;
					$_SESSION['cart'][$i]['weight'] = $object->weight;
					$_SESSION['cart'][$i]['is_free_shipping'] = $object->is_free_shipping;
					if(!$object->is_free_shipping && !$object->is_drop_shipped){
						$this->total_weight_stock_items += $object->weight*$row->qty;
					}
					$_SESSION['cart'][$i]['brand_id'] = $object->brand_id;
					$_SESSION['cart'][$i]['shipping_flat_charge'] = $object->shipping_flat_charge;
					$_SESSION['cart'][$i]['is_drop_shipped'] = $object->is_drop_shipped;
					$i++;
				}
			}
			$this->cart_array = $_SESSION['cart'];			
		}
	}

	function mergeCarts($dbCustom)
	{
		$cart_array = array();	
		$i = 0;
		if($this->anonymous_shopper_id > 0){				
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT item_id, qty
					FROM saved_cart 
					WHERE anonymous_shopper_id = '".$this->anonymous_shopper_id."'";
			$result = $dbCustom->getResult($db,$sql);	
			while($row = $result->fetch_object()){				
				$this->addItem($dbCustom,$row->item_id, $row->qty);
			}
			$sql = sprintf("DELETE FROM saved_cart WHERE anonymous_shopper_id = '%u'", $this->anonymous_shopper_id);
			$result = $dbCustom->getResult($db,$sql);				
		}
		$this->reloadCart($dbCustom);
		
	}



	function hasItems()
	{			
		if(count($_SESSION['cart']) > 0){				
			return 1;			
		}			
		return 0;				
	}


	function itemInCart($item_id)
	{
		$ret = 0;	
		foreach($_SESSION['cart'] as $val)
		{
			if($val['item_id'] == $item_id) $ret = 1;
		}
		return $ret;
	}

	function itemExists($dbCustom,$item_id)
	{
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = sprintf("SELECT item_id FROM item WHERE item_id = '%u'", $item_id);
		$result = $dbCustom->getResult($db,$sql);		
		return ($result->num_rows > 0)? 1 : 0;
	}

	function addItem($dbCustom,$item_id, $qty = 1)
	{
		if($this->itemInCart($item_id)){
			foreach($this->cart_array as $key => $val)
			{
				if($val['item_id'] == $item_id){ 
					//$this->cart_array[$key]['qty'] += $qty;
					$_SESSION['cart'][$key]['qty'] += $qty;
					break;
				}
			}
		}else{				
			$db = $dbCustom->getDbConnect(CART_DATABASE);	
			$sql = "SELECT profile_item_id
							,name
							,seo_url
							,weight
							,brand_id
							,shipping_flat_charge
							,is_free_shipping
							,is_drop_shipped
					FROM item
					WHERE item_id = '".$item_id."'";
			$result = $dbCustom->getResult($db,$sql);
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$i = count($this->cart_array); 
				$_SESSION['cart'][$i]['item_id'] = $item_id;
				$_SESSION['cart'][$i]['qty'] = $qty;
				$_SESSION['cart'][$i]['weight'] = $object->weight;
				$_SESSION['cart'][$i]['cat_id'] =  $this->getCat($dbCustom,$item_id);
				$_SESSION['cart'][$i]['name'] =  $object->name;
				$_SESSION['cart'][$i]['image_file'] = $this->getItemPic($dbCustom,$item_id);
				$_SESSION['cart'][$i]['seo_url'] =  $object->seo_url; 				
				$_SESSION['cart'][$i]['price'] =  $this->getItemPrice($dbCustom,$item_id);
				$_SESSION['cart'][$i]['profile_item_id'] = $object->profile_item_id;
				$_SESSION['cart'][$i]['brand_id'] = $object->brand_id;
				$_SESSION['cart'][$i]['shipping_flat_charge'] = $object->shipping_flat_charge;
				$_SESSION['cart'][$i]['is_free_shipping'] = $object->is_free_shipping;
				$_SESSION['cart'][$i]['is_drop_shipped'] = $object->is_drop_shipped;			
			}								
		}
		
		$this->saveCart($dbCustom);			
		
		
		return $item_id;
	} 
	
	function updateQty($item_id, $qty)
	{		
		if(is_numeric($qty)){
			foreach($_SESSION['cart'] as $key => $val)
			{
				if($val['item_id'] == $item_id){ 
					$_SESSION['cart'][$key]['qty'] = $qty;
					break;
				}
			}
		}
	}
	
	function getItemCount()
	{ 
		$num_items = 0;
		foreach($_SESSION['cart'] as $v){
			$num_items += $v['qty'];		
		}
		return $num_items;
	}
	
	function getItemQty($item_id)
	{ 
		$ret = 0;
		foreach($_SESSION['cart'] as $val)
		{
			if($val['item_id'] == $item_id) $ret = $val['qty'];
		}
		return $ret;
	}


	function getDropShipItems()
	{ 
		$drop_ship_array = array();
		$i = 0;
		foreach($_SESSION['cart'] as $val)
		{
			if($val['is_drop_shipped']){ 
				$drop_ship_array[$i]['item_id'] = $val['item_id'];
				$drop_ship_array[$i]['weight'] = $val['weight'];
				$drop_ship_array[$i]['qty'] = $val['qty'];
				$drop_ship_array[$i]['is_free_shipping'] = $val['is_free_shipping'];
				$i++;		
			}
		}
		return $drop_ship_array;
	}

	function getStockedItems()
	{ 
		$stocked_array = array();
		$i = 0;
		foreach($_SESSION['cart'] as $val)
		{
			if(!$val['is_drop_shipped']){ 
				$stocked_array[$i]['item_id'] = $val['item_id'];
				$stocked_array[$i]['weight'] = $val['weight'];
				$stocked_array[$i]['qty'] = $val['qty'];
				$stocked_array[$i]['is_free_shipping'] = $val['is_free_shipping'];
				$i++;		
			}
		}
		return $stocked_array;
	}


	function getContents()
	{ 
		return $_SESSION['cart'];
	} 


	function removeItem($dbCustom,$item_id)
	{
		$t = array();	
		$i = 0;
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		if($this->customer_id > 0){
			$sql = "DELETE FROM saved_cart 
				WHERE customer_id = '".$this->customer_id."'
				AND item_id = '".$item_id."'";
			$result = $dbCustom->getResult($db,$sql);
		}else{
			$sql = "DELETE FROM saved_cart WHERE anonymous_shopper_id = '".$this->anonymous_shopper_id."'
				AND item_id = '".$item_id."'";
			$result = $dbCustom->getResult($db,$sql);
		}
		$_SESSION['cart'] = array();
		$this->cart_array = $_SESSION['cart'];
		$this->reloadCart($dbCustom);
		return $item_id;
	}

	function emptyCart($dbCustom)
	{ 
		$db = $dbCustom->getDbConnect(CART_DATABASE);		
		if($this->customer_id > 0){
			$sql = sprintf("DELETE FROM saved_cart WHERE customer_id = '%u'", $this->customer_id);
			$result = $dbCustom->getResult($db,$sql);			
		}else{
			$sql = sprintf("DELETE FROM saved_cart WHERE anonymous_shopper_id = '%u'", $this->anonymous_shopper_id);
			$result = $dbCustom->getResult($db,$sql);			
		}
		$this->cart_array = array();
		$_SESSION['cart'] = array();
	} 
	
	
	function getName($dbCustom,$item_id)
	{	
		$db = $dbCustom->getDbConnect(CART_DATABASE);	
		$sql = "SELECT name
				FROM item
				WHERE item_id = '".$item_id."'"; 
				
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows){
			$object = $result->fetch_object();
			$ret = $object->name;
		}else{
			$ret = '';
		}
		return $ret;
	}
	
	function getItemWeight($dbCustom,$item_id){
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);	
		$sql = "SELECT weight
				FROM item
				WHERE item_id = '".$item_id."'"; 
				
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows){
			$object = $result->fetch_object();
			$ret = $object->weight;
		}else{
			$ret = '';
		}
		return $ret;
		
	}
	
	function getItemSeoUrl($dbCustom,$item_id)
	{
		$db = $dbCustom->getDbConnect(CART_DATABASE);	
		$sql = "SELECT seo_url
				FROM item
				WHERE item_id = '".$item_id."'"; 
				
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows){
			$object = $result->fetch_object();
			$ret = $object->seo_url;
		}else{
			$ret = '';
		}
		return $ret;
		
	}
	
	function getCat($dbCustom,$item_id)
	{		
		$ret = 0;
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT cat_id
				FROM item_to_category
				WHERE item_id = '".$item_id."'"; 
				
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$ret = ($object->cat_id != '')? $object->cat_id : 0;
		}
		return $ret;
	}

	function getItemPic($dbCustom,$item_id)
	{	
	
		$ret = '';
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT image.img_id, image.file_name 
				FROM item, image
				WHERE item.img_id = image.img_id
				AND item.item_id = '".$item_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows> 0){		
			$obj = $result->fetch_object();
			$ret = $obj->file_name;
		}
		return $ret;	
	}
	
	function getItemPrice($dbCustom,$item_id){

		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT price_flat, price_wholesale, percent_markup 
				FROM item
				WHERE item_id = '".$item_id."'
				";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$object = $result->fetch_object();		
			if($object->price_flat > 0){
				$ret = $object->price_flat;	
			}elseif($object->price_wholesale > 0){
				$ret = $object->price_wholesale + $object->percent_markup; 
			}else{
				$ret = 0;	
			}
		}else{
			$ret = 0;
		}
		return $ret;
	}
	
	function getProfileItemId($dbCustom,$item_id)
	{
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT profile_item_id
				FROM item
				WHERE item_id = '".$item_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			return $object->profile_item_id;		
		}else{
			return 0;	
		}
	}
	
	function getKitAssocItems($dbCustom,$item_id){
		
		$ret_array = array();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT item.item_id
						,item.profile_item_id
						,item.brand_id
						,item.seo_url
						,item.name
						,item.profile_item_id
						,item.img_alt_text
						,item.call_for_pricing
						,item.show_in_cart
						,item.show_doc_tab
						,item.show_meas_form_tab
						,item.show_atc_btn_or_cfp
						,item.weight
						,item.is_free_shipping
						,item.is_drop_shipped
					FROM item_to_kit, item
					WHERE item_to_kit.item_id = item.item_id 
					AND item_to_kit.kit_item_id = '".$item_id."'
					AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);
		$i = 0;					
		while($row = $result->fetch_object()){
			$ret_array[$i]['item_id'] = $row->item_id;
			$ret_array[$i]['profile_item_id'] = $row->profile_item_id;
			$ret_array[$i]['file_name'] = $this->getItemPic($dbCustom,$row->item_id);	
			$ret_array[$i]['brand_id'] = $row->brand_id; 
			$ret_array[$i]['seo_url'] = $row->seo_url; 
			$ret_array[$i]['name'] = $row->name;
			$ret_array[$i]['profile_item_id'] = $row->profile_item_id;
			$ret_array[$i]['img_alt_text'] = $row->img_alt_text;
			$ret_array[$i]['call_for_pricing'] = $row->call_for_pricing;
			$ret_array[$i]['price'] = $this->getItemPrice($dbCustom,$row->item_id);
			$ret_array[$i]['show_in_cart'] = $row->show_in_cart;
			$ret_array[$i]['show_doc_tab'] = $row->show_doc_tab;
			$ret_array[$i]['show_meas_form_tab'] = $row->show_meas_form_tab;
			$ret_array[$i]['show_atc_btn_or_cfp'] = $row->show_atc_btn_or_cfp;
			$ret_array[$i]['weight'] = $row->weight;
			$ret_array[$i]['is_free_shipping'] = $row->is_free_shipping;
			$ret_array[$i]['is_drop_shipped'] = $row->is_drop_shipped;
			$i++;
		}
		return $ret_array;		
	}
	
	function getVideos($dbCustom,$item_id){
		
		$ret_array = array();	
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT video.youtube_id
						,video.title
						,video.description
				FROM item_to_video, video
				WHERE item_to_video.video_id = video.video_id
				AND item_to_video.item_id = '".$item_id."'";	
		
		$result = $dbCustom->getResult($db,$sql);
		$i = 0;					
		while($row = $result->fetch_object()){	
			$ret_array[$i]['youtube_id'] = $row->youtube_id;
			$ret_array[$i]['title'] = $row->title;
			$ret_array[$i]['description'] = $row->description;
			$i++;
		}
		return $ret_array;
	}
}

?>
