<?php

class Wishlist {


	private static $customer_id;
	private static $anonymous_shopper_id;

	function __construct() {
    
	   $this->customer_id = (isset($_SESSION['cust_id']))? $_SESSION['cust_id'] : 0;
	   $this->anonymous_shopper_id = (isset($_SESSION['anonymous_shopper_id']))? $_SESSION['anonymous_shopper_id'] : 0;
	   
	   $t = '';
	   
	   if(!isset($_SESSION["wishlist"])){
		   
		   
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
	
			if($this->customer_id > 0){
				$sql = sprintf("SELECT item_id, qty 
								FROM wishlist 
								WHERE customer_id = '%u'
								AND profile_account_id = '%u'", $this->customer_id, $_SESSION['profile_account_id']);
			}else{
				$sql = sprintf("SELECT item_id, qty 
								FROM wishlist 
								WHERE anonymous_shopper_id = '%u'
								AND profile_account_id = '%u'", $this->anonymous_shopper_id, $_SESSION['profile_account_id']);
			}
			$result = $dbCustom->getResult($db,$sql);		   
			$i = 0;
			while($row = $result->fetch_object()) {
				$t[$i]['item_id'] = $row->item_id;
				$t[$i]['qty'] = $row->qty;
				$i++;
			}
			$_SESSION['wishlist'] = $t;
			
	   }
	}
	
	function saveList(){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		
		// delete from saved_cart
		if($this->customer_id > 0){
			$sql = sprintf("DELETE FROM wishlist WHERE customer_id = '%u'", $this->customer_id);
			$result = $dbCustom->getResult($db,$sql);			if(is_array($_SESSION["wishlist"])){
			foreach($_SESSION["wishlist"] as $val)
			{
				$sql = "INSERT INTO wishlist 
						(item_id, qty, customer_id)
						VALUES
						('".$val["item_id"]."','".$val["qty"]."','".$this->customer_id."')";
				$result = $dbCustom->getResult($db,$sql);					
				}
			}
			
			
		}elseif($this->anonymous_shopper_id > 0){
			$sql = sprintf("DELETE FROM wishlist WHERE anonymous_shopper_id = '%u'", $this->anonymous_shopper_id);
			$result = $dbCustom->getResult($db,$sql);			
			if(is_array($_SESSION["wishlist"])){
				foreach($_SESSION["wishlist"] as $val)
				{
					$sql = "INSERT INTO wishlist 
							(item_id, qty, anonymous_shopper_id)
							VALUES
							('".$val["item_id"]."','".$val["qty"]."','".$this->anonymous_shopper_id."')";
					$result = $dbCustom->getResult($db,$sql);					
				}
			}
		}
	}


	function hasItems()
	{
		if(is_array($_SESSION["wishlist"])){
			$ret = 1;			
		}else{
			$ret = 0;			
		}
		
		return $ret;
	}


	function itemInCart($item_id)
	{
		if($_SESSION["wishlist"] == ''){
			$ret = 0;			
		}else{
			foreach($_SESSION["wishlist"] as $val)
			{
				if($val["item_id"] == $item_id) $ret = 1;
			}
		}
		return $ret;
	}



	function addItem($item_id, $qty = 1)
	{
		
		if($this->itemInCart($item_id)){
			foreach($_SESSION["wishlist"] as $key => $val)
			{
				if($val["item_id"] == $item_id){ 
					$_SESSION["wishlist"][$key]["qty"] += $qty;
					break;
				}
			}
		}else{
		
			$i = ($_SESSION["wishlist"] != '') ? count($_SESSION["wishlist"])  : 0; 	
			$_SESSION["wishlist"][$i]["item_id"] = $item_id;
			$_SESSION["wishlist"][$i]["qty"] = $qty;
		
		}

	} 
	
	function updateQty($item_id, $qty)
	{
		
		if(is_numeric($qty)){
			foreach($_SESSION["wishlist"] as $key => $val)
			{
				if($val["item_id"] == $item_id){ 
					$_SESSION["wishlist"][$key]["qty"] = $qty;
					break;
				}
			}
		}
	}
	

	function getItemCount()
	{ 
		$ret = ($_SESSION["wishlist"] != '') ? count($_SESSION["wishlist"])  : 0; 
		return $ret;
		
	}

	
	function getItemQty($item_id)
	{ 
		$ret = 0;
		foreach($_SESSION["wishlist"] as $val)
		{
			if($val["item_id"] == $item_id) $ret = $val["qty"];
		}
		return $ret;
	}


	function getContents()
	{ 
		return $_SESSION["wishlist"];
	} 


	function removeItem($item_id)
	{
		
		
		//echo $item_id; exit;
		
		$t = '';	
		$i = 0;
		
		if($_SESSION["wishlist"] != ''){
			foreach($_SESSION["wishlist"] as $val){
				if($val["item_id"] != $item_id){
					if(is_numeric($val["item_id"])){
						$t[$i]["item_id"] = $val["item_id"];
						$t[$i]["qty"] = $val["qty"];
						$i++;
					}
				}
			}
		}
		$_SESSION["wishlist"] = $t;
		
		
	}
	
	function emptyCart()
	{ 
		$_SESSION["wishlist"] = '';
	} 




	function addToWishlist($item_id)
	{
		
		
		
		
		
		
		if($this->itemInCart($item_id)){
			foreach($_SESSION["wishlist"] as $key => $val)
			{
				if($val["item_id"] == $item_id){ 
					$_SESSION["wishlist"][$key]["qty"] += $qty;
					break;
				}
			}
		}else{
		
			$i = ($_SESSION["wishlist"] != '') ? count($_SESSION["wishlist"])  : 0; 	
			$_SESSION["wishlist"][$i]["item_id"] = $item_id;
			$_SESSION["wishlist"][$i]["qty"] = $qty;
		
		}
		
		
		
	}
		
		
		
		
		
}






		
		
	/*	
		
		$qty = $this->getItemQty($item_id);

		if($this->customer_id > 0){
			
			$sql = "SELECT qty 
					FROM wishlist
					WHERE item_id = '".$item_id."'
					AND customer_id = '".$this->customer_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			
			if($result->num_rows > 0){
				
				$qty_obj = $result->fetch_object();
				$new_qty = $qty + $qty_obj->qty;  
				$sql = "UPDATE wishlist
						SET qty = '".$new_qty."'
						WHERE item_id = '".$item_id."'
						AND customer_id = '".$this->customer_id."'";
		$result = $dbCustom->getResult($db,$sql);				
				
			}else{
				$sql = "INSERT INTO wishlist 
						(item_id, qty, customer_id)
						VALUES
						('".$item_id."','".$qty."','".$this->customer_id."')";
		$result = $dbCustom->getResult($db,$sql);				
			}
			
		}elseif($this->anonymous_shopper_id > 0){
			
			$sql = "SELECT qty 
					FROM wishlist
					WHERE item_id = '".$item_id."'
					AND anonymous_shopper_id = '".$this->anonymous_shopper_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			
			if($result->num_rows > 0){
				
				$qty_obj = $result->fetch_object();
				$new_qty = $qty + $qty_obj->qty;  
				$sql = "UPDATE wishlist
						SET qty = '".$new_qty."'
						WHERE item_id = '".$item_id."'
						AND anonymous_shopper_id = '".$this->anonymous_shopper_id."'";
		$result = $dbCustom->getResult($db,$sql);				
			
			}else{
			
				$sql = "INSERT INTO wishlist 
						(item_id, qty, anonymous_shopper_id)
						VALUES
						('".$item_id."','".$qty."','".$this->anonymous_shopper_id."')";
		$result = $dbCustom->getResult($db,$sql);				
			}
		}
	*/


?>