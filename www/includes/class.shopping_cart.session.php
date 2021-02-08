<?php

// add function to merge carts if cust ids are different at loggin
// ... mergeCart(old_cust_id, new_cust_id) 


// store arrays in session
//store objects in the $_SESSION

class ShoppingCart {

	public $customer_id;
	public $anonymous_shopper_id;
	
	function __construct() {
    
	   $this->customer_id = (isset($_SESSION['ctg_cust_id']))? $_SESSION['ctg_cust_id'] : 0;
	   $this->anonymous_shopper_id = (isset($_SESSION['anonymous_shopper_id']))? $_SESSION['anonymous_shopper_id'] : 0;	
	      
	   $t = '';
	   $load = 0;
	  
	  	// temp fix
	   //unset($_SESSION["cart"]);
	  
	   if(!isset($_SESSION['cart'])){
			
			$this->reloadCart();
			
	   }else{
				   
		   $this->saveCart();
		   //$this->reloadCart();
	   }
	   
	   
	}
	
	function saveCart(){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);


		if(!isset($_SESSION['cart'])) $_SESSION['cart'] = array();


		if(count($_SESSION['cart']) > 0){
		
		
			if($this->customer_id > 0){
				$sql = sprintf("DELETE FROM saved_cart WHERE customer_id = '%u'", $this->customer_id);
				$result = $dbCustom->getResult($db,$sql);				
				//if(is_array($_SESSION['cart'])){
					foreach($_SESSION['cart'] as $val)
					{
								$sql = "INSERT INTO saved_cart 
									(item_id, qty, customer_id)
									VALUES
									('".$val['item_id']."','".$val['qty']."','".$this->customer_id."')";
								$res = $dbCustom->getResult($db,$sql);						
					}
				//}
					
							
			
			}elseif($this->anonymous_shopper_id > 0){
				
				
				$sql = sprintf("DELETE FROM saved_cart WHERE anonymous_shopper_id = '%u'", $this->anonymous_shopper_id);
				$result = $dbCustom->getResult($db,$sql);				
				
				//if(is_array($_SESSION['cart'])){
					foreach($_SESSION['cart'] as $val)
					{
							$sql = "INSERT INTO saved_cart 
								(item_id, qty, anonymous_shopper_id)
								VALUES
								('".$val["item_id"]."','".$val["qty"]."','".$this->anonymous_shopper_id."')";
							$res = $dbCustom->getResult($db,$sql);						
					}
				//}
		
			
			}else{
			
			
			

			
			
				
			}
			
		}else{

			$this->reloadCart();
			
		}
	
	
	
		
	}
	
	
	
	function reloadCart(){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$load = 0;
		
		$_SESSION['cart'] = array();
		
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
			//echo "<br />anonymous_shopper_id---        ".$this->anonymous_shopper_id."<br />";
		}
			
		
		if($load){
			//$cart_subtotal = 0;
			$i = 0;
			while($row = $result->fetch_object()) {
				$t[$i]['cat_id'] = $this->getCat($row->item_id);
				$t[$i]['item_id'] = $row->item_id;				
				$t[$i]['profile_item_id'] = $this->getProfileItemId($row->item_id);				
				$t[$i]['name'] = $this->getName($row->item_id);
				$t[$i]['qty'] = $row->qty;
				$t[$i]['price'] = $this->getItemPrice($row->item_id);
				$t[$i]['image_file'] = $this->getItemPic($row->item_id);
				$t[$i]['seo_url'] = $this->getItemSeoUrl($row->item_id);
				$t[$i]['weight'] = $this->getItemWeight($row->item_id);
				
				//$cart_subtotal += $this->getItemPrice($row->item_id)*$row->qty;
				$i++;
			}
			$_SESSION['cart'] = $t;			
			//$_SESSION['cart_subtotal'] = $cart_subtotal;
		}

		
	}
	


	function hasItems()
	{
		//if(is_array($_SESSION['cart'])){
			
			if(count($_SESSION['cart']) > 0){
						
				return 1;			
			}
			
		//}
		return 0;			
		
	}


	function itemInCart($item_id)
	{
		$ret = 0;	
		//if(is_array($_SESSION['cart'])){
			foreach($_SESSION["cart"] as $val)
			{
				if($val['item_id'] == $item_id) $ret = 1;
			}
		//}
		return $ret;
	}

	function itemExists($item_id)
	{
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = sprintf("SELECT item_id FROM item WHERE item_id = '%u'", $item_id);
		$result = $dbCustom->getResult($db,$sql);		
		
		return ($result->num_rows > 0)? 1 : 0;
		
	}

	function addItem($item_id, $qty = 1)
	{
		
		
		
		if($this->itemExists($item_id)){
		
			
			if($this->itemInCart($item_id)){
				foreach($_SESSION['cart'] as $key => $val)
				{
					if($val['item_id'] == $item_id){ 
						$_SESSION['cart'][$key]['qty'] += $qty;
						break;
					}
				}
			}else{
		
				$i = count($_SESSION['cart']); 
					
				$_SESSION['cart'][$i]['item_id'] = $item_id;
				$_SESSION['cart'][$i]['qty'] = $qty;
				$_SESSION['cart'][$i]['weight'] = $this->getItemWeight($item_id);
				$_SESSION['cart'][$i]['cat_id'] =  $this->getCat($item_id);
				$_SESSION['cart'][$i]['name'] =  $this->getName($item_id);
				$_SESSION['cart'][$i]['image_file'] = $this->getItemPic($item_id);
				$_SESSION['cart'][$i]['seo_url'] =  $this->getItemSeoUrl($item_id); 				
				$_SESSION['cart'][$i]['price'] =  $this->getItemPrice($item_id);
				$_SESSION['cart'][$i]['profile_item_id'] = $this->getProfileItemId($item_id);
			
			}
			
			
			
			$this->saveCart();
			
			return $item_id;
			
		}

		

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
		//$ret = ($_SESSION['cart'] != '') ? count($_SESSION['cart'])  : 0; 
		return count($_SESSION['cart']);
		
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


	function getContents()
	{ 
		if(count($_SESSION['cart']) == 0){
			$_SESSION['cart'] = array();
		}
		return $_SESSION['cart'];
	} 


	function removeItem($item_id)
	{

		$t = array();	
		$i = 0;
		
		if($_SESSION['cart'] != ''){
			
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
		
			if($this->customer_id > 0){
				$sql = sprintf("DELETE FROM saved_cart 
				WHERE customer_id = '%u'
				AND item_id = '%u'"
				,$this->customer_id, $item_id);
				$result = $dbCustom->getResult($db,$sql);				
			}else{
			
				$sql = sprintf("DELETE FROM saved_cart 
				WHERE anonymous_shopper_id = '%u'
				AND item_id = '%u'"
				,$this->anonymous_shopper_id, $item_id);
				$result = $dbCustom->getResult($db,$sql);				
			}
			
						
			
			foreach($_SESSION['cart'] as $val){
				if($val['item_id'] != $item_id){
					if(is_numeric($val['item_id'])){
						$t[$i]['item_id'] = $val['item_id'];
						$t[$i]['qty'] = $val['qty'];
						$t[$i]['cat_id'] =  $val['cat_id'];
						$t[$i]['name'] =  $val['name'];
						$t[$i]['image_file'] = $this->getItemPic($item_id);					
						$t[$i]['seo_url'] =  $val['seo_url']; 				
						$t[$i]['price'] =  $val['price'];
						$t[$i]['weight'] =  $val['weight'];
						$t[$i]['profile_item_id'] = $val['item_id'];
						$i++;
					}
				}
			}
		}
		$_SESSION['cart'] = $t;
		
		
		return $item_id;
	}


	function getCartTotalWeight()
	{ 
	
		$weight = 0;
		//if(is_array($_SESSION['cart'])){
			foreach($_SESSION["cart"] as $val)
			{
				$weight += $val['weight'] * $val['qty'];
			}	
		//}
		
		return $weight;
	}


	function emptyCart()
	{ 
		$_SESSION['cart'] = '';
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);		
		if($this->customer_id > 0){
			$sql = sprintf("DELETE FROM saved_cart WHERE customer_id = '%u'", $this->customer_id);
			$result = $dbCustom->getResult($db,$sql);			
		}else{
			$sql = sprintf("DELETE FROM saved_cart WHERE anonymous_shopper_id = '%u'", $this->anonymous_shopper_id);
			$result = $dbCustom->getResult($db,$sql);			
		}

	} 
	
	
	function getName($item_id)
	{	
		$dbCustom = new DbCustom();
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
	
	
	function getItemWeight($item_id){
		
		$dbCustom = new DbCustom();
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
	
	
	function getItemSeoUrl($item_id)
	{
		$dbCustom = new DbCustom();
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
	
	
	function getCat($item_id)
	{		
		$ret = 0;
		$dbCustom = new DbCustom();
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

	function getItemPic($item_id)
	{	
	
	
	
		$ret = '';
		$dbCustom = new DbCustom();
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
	
	
	
	function getItemPrice($item_id){
		
		$dbCustom = new DbCustom();	
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
	
	
	function getProfileItemId($item_id)
	{
		$dbCustom = new DbCustom();
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

}

?>
