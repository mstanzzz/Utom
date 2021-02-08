<?php 
require_once('config.php');

if(!isset($_SESSION['enable_tool'])) $_SESSION['enable_tool'] = 1;

if($_SESSION['enable_tool']){
	
	
	class DesignPurchase {
		
		public $customer_id;
		public $anonymous_shopper_id;	
		
		function __construct() {
		   $this->customer_id = (isset($_SESSION['ctg_cust_id']))? $_SESSION['ctg_cust_id'] : 0;
		   $this->anonymous_shopper_id = (isset($_SESSION['anonymous_shopper_id']))? $_SESSION['anonymous_shopper_id'] : rand();	
		}
		
		function getAllDesignsPurchased(){
				
			$dbCustom = new DbCustom();				
			$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
			$t = array();
			$i = 0;
						
			$sql = "SELECT file_name
						,purchase_date
						,current_status
						,thumbnail_image_data
						,design_id
					FROM design_purchases
					WHERE user_id = '".$this->customer_id."'
					AND purchased = '1'";
			$result = $dbCustom->getResult($db,$sql);
			while($row = $result->fetch_object()) {
					
				$t[$i]['file_name'] = $row->file_name;
				$t[$i]['purchase_date'] = $row->purchase_date;
				$t[$i]['current_status'] = $row->current_status;
				$t[$i]['thumbnail_image_data'] = $row->thumbnail_image_data;
				$t[$i]['design_id'] = $row->design_id;
									
				$i++;	
			}
			
			return $t;
					
		}
		
		function getDesignsStatus($design_id){
				
			$dbCustom = new DbCustom();				
			$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
			
			$ret_array = array();

			$sql = "SELECT current_status
						,purchase_date
						,purchased
						,deleted
						,in_cart
					FROM design_purchases
					WHERE user_id = '".$this->customer_id."'
					AND design_id = '".$design_id."'";
			$result = $dbCustom->getResult($db,$sql);
			if($result->num_rows > 0){
			
				$object = $result->fetch_object();
				$ret_array['current_status'] = $object->current_status;
				$ret_array['purchase_date'] = $object->purchase_date; 	
				$ret_array['purchased'] = $object->purchased;
				$ret_array['deleted'] = $object->deleted;
				$ret_array['in_cart'] = $object->in_cart;
			}
			
			return $ret_array;
			
			

		}
			
	
	}

}else{

	class DesignPurchase {
	
		public $customer_id;
		public $anonymous_shopper_id;	
			
		function __construct() {
		
		}
		
	
	
	}
	
		
}
