<?php 
require_once('config.php');

if(!isset($_SESSION['enable_tool'])) $_SESSION['enable_tool'] = 1;

if($_SESSION['enable_tool']){
	
	//Constant Definitions
	//require 'parameterConstants.php';
	//require 'sessionParameterConstants.php';
	
	class DesignCart {
		public $customer_id;
		public $anonymous_shopper_id;	
		public $design_cart_array;
		public $total_price;

		
		function __construct() {
                
		   $this->customer_id = (isset($_SESSION['ctg_cust_id']))? $_SESSION['ctg_cust_id'] : 0;
		   $this->anonymous_shopper_id = (isset($_SESSION['anonymous_shopper_id']))? $_SESSION['anonymous_shopper_id'] : rand();	
			
			if(!isset($_SESSION['design_cart'])){
				$_SESSION['design_cart'] = array();
			}
		   
			$this->design_cart_array = $_SESSION['design_cart'];
			  
			$this->reloadDesignCart();
		}
		
	
		/***************************************************
		This function is not used anywhere. The tool has it's own API that does this
		***************************************************/
		/*
		function addDesign($sendToCartRequestData){
			
				global $_ERROR_MESSAGES;
					
				if(count($sendToCartRequestData) == 0){
					array_push($_ERROR_MESSAGES, 'No cart parameters were sent to be queued.');
					return false;
				}
					
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		
				if(isset($db) == false || !$db){
					array_push($_ERROR_MESSAGES, 'Unable to establish connection with database.');
					return false;
				}
		
				$stmt = $db->prepare("INSERT INTO design_purchases(
							 user_id
							,purchased
							,design_id
							,in_cart
							,current_status
							,project_id
							,conversation_id
							,deleted
							,design_price
							,file_name
							,file_description
							,thumbnail_image_data								
							,create_date
							,purchase_date								
							,design_xml
							,custom_units_ids
							,custom_toe_plates_ids
							,custom_cleats_ids
							,custom_backing_ids
							,custom_panels_ids
							,custom_components_ids
							,custom_parts_ids
							,saas_id
						)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
					);
	
				if(isset($stmt) == false || $stmt == false){
                                        array_push($_ERROR_MESSAGES, $db->error);
					array_push($_ERROR_MESSAGES, 'Unable to bind parameters to purchases.');
					return false;
				}
	
				$bindParameterSuccess = $stmt->bind_param("iiiiiiiissssssssssssss",
					$sendToCartRequestData[PARAM_USER_ID],
					$sendToCartRequestData[PARAM_PURCHASED],
					$sendToCartRequestData[PARAM_FILE_ID],
					$sendToCartRequestData[PARAM_IN_CART],
					$sendToCartRequestData[PARAM_CURRENT_STATUS],
					$sendToCartRequestData[PARAM_PROJECT_ID],
					$sendToCartRequestData[PARAM_CONVERSATION_ID],
					$sendToCartRequestData[PARAM_DELETED],
					$sendToCartRequestData[PARAM_DESIGN_PRICE],
					$sendToCartRequestData[PARAM_FILE_NAME],
					$sendToCartRequestData[PARAM_FILE_DESCRIPTION],
					$sendToCartRequestData[PARAM_THUMBNAIL_IMAGE_DATA],
					$sendToCartRequestData[PARAM_CREATION_DATE],
					$sendToCartRequestData[PARAM_PURCHASE_DATE],
					$sendToCartRequestData[PARAM_DESIGN_FILE_DATA_XML],
					$sendToCartRequestData[PARAM_CABINETRY_SECTION_UNIT_IDS],
					$sendToCartRequestData[PARAM_CABINETRY_SECTION_TOE_PLATE_IDS],
					$sendToCartRequestData[PARAM_CABINETRY_SECTION_CLEAT_IDS],
					$sendToCartRequestData[PARAM_CABINETRY_SECTION_BACKING_IDS],
					$sendToCartRequestData[PARAM_CABINETRY_SECTION_PANEL_IDS],
					$sendToCartRequestData[PARAM_CABINETRY_COMPONENT_IDS],
					$sendToCartRequestData[PARAM_COMPONENT_PART_IDS],
					$_SESSION['profile_account_id']);
				
				if(!isset($bindParameterSuccess) || !$bindParameterSuccess){
					array_push($_ERROR_MESSAGES, 'Unable to bind parameter values to purchases.');
					return false;
				}
		
				if($stmt->execute() == false){
					array_push($_ERROR_MESSAGES, $stmt->error);
					$stmt->close();
					return $db->insert_id;
				}
			
			*/
			
			
		
		
			function reloadDesignCart(){
				
				$this->total_price = 0;
				
				$dbCustom = new DbCustom();				
				$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		
				$t = array();
				$i = 0;
						
				$sql = "SELECT 	cart_design_id
								,design_price
								,file_name
								,thumbnail_image_data
								,design_id
						FROM design_purchases
						WHERE user_id = '".$this->customer_id."'
						AND purchased = '0'
						AND deleted = '0'";
				$result = $dbCustom->getResult($db,$sql);		
					
				while($row = $result->fetch_object()) {
					
					$t[$i]['cartDesign_id'] = $row->cart_design_id;
					$t[$i]['designID'] = $row->design_id;
									
					$t[$i]['name'] = $row->file_name;
					
					$tmp = str_replace('$', '', $row->design_price);
					
					$this->total_price += $tmp;

					$t[$i]['designPrice'] = $tmp;
					$t[$i]['thumbnail_image_data'] = $row->thumbnail_image_data;					
					$t[$i]['qty'] = 1;
					
					$i++;
				}
				
				$_SESSION['design_cart'] = $t;
				$this->design_cart_array = $_SESSION['design_cart'];
				
				return 1;
				
			
			}
		
			function removeDesign($cartDesign_id = 0)
			{
		
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
				
				$sql = "UPDATE design_purchases
						SET deleted = '1', in_cart = '0'
						WHERE cart_design_id = '".$cartDesign_id."'";	
				$result = $dbCustom->getResult($db,$sql);	
				
				$this->reloadDesignCart();
				
				return 1;
			}
			
			function getItemCount(){
				return count($_SESSION['design_cart']);
			}
		
			function hasItems()
			{
				return (count($_SESSION['design_cart']) > 0) ? 1 : 0;	
			}
			
			function setDesignPurchased($cartDesign_id = 0){
				
				
				
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
				$sql = "UPDATE design_purchases
						SET purchased = '1'
							,current_status = '1'
							,in_cart = '0'
							,purchase_date = NOW()
						WHERE cart_design_id = '".$cartDesign_id."'";
				$result = $dbCustom->getResult($db,$sql);
				
				
				
			}
			
			function setCartPurchased(){
				foreach($this->design_cart_array as $val){					
					$this->setDesignPurchased($val['cartDesign_id']);					
				}
				$this->reloadDesignCart();
				
			}
			
			function emptyCart()
			{ 
				return 0;
		
			} 
			
			function getContents(){
				
				return $_SESSION['design_cart'];
			}
	
			function saveCart(){
				return 1;
			}

			function inCart($design_id){
				
				foreach($this->design_cart_array as $val){					
					
					if($design_id == $val['designID']){ 
					
						return 1;
					}
				}
				
				return 0;
			}
			
			function getHeaderBlock(){
				
				$block = '';
				
				foreach ($this->design_cart_array as $val) {
					
					$itemDetailsLink = $_SERVER['DOCUMENT_ROOT']."/app/#direct=".$val['designID'];
					
					
					$qty_price = $val['designPrice'] * $val['qty']; 
					
					$block .= '<tr>';
					$block .= "<td><a href='".$itemDetailsLink."'>";
							
					$block .= "<img src='/images/custom-item-in-cart.jpg' alt='' /></a>";
							
					$block .= '</td>';
					$block .= "<td><a href='".$itemDetailsLink."'>";
							
							
					if(strlen($val['name']) > 12){	
						$block .=  stripslashes(substr($val['name'], 0 , 12));
						$block .= "...";
					}else{
						$block .= stripslashes($val['name']);	
					}
					$block .= '</a></td>';
					$block .= "<td><a href='".$itemDetailsLink."'>";
					$block .= $val['qty'];
					$block .= '</a></td>';
					$block .= "<td><a href='".$itemDetailsLink."'>";
					$block .= '$'.number_format($qty_price,2);
					$block .= '</td>';
					$block .= '</tr>';
				}	
				
				return $block;	
				
			}
			
	
	}

}else{

	class DesignCart {
	
		public $customer_id;
		public $anonymous_shopper_id;	
		public $design_cart_array;
		public $total_price = 0;	
			
		function __construct() {
		
		}
		
	
		function addDesign($sendToCartRequestData){
			return false;			
		}
			
		
		
		function reloadDesignCart(){
				
			$t = array();
			return $t;	
			
		}
		
		function removeDesign($cartDesign_id = 0)
		{
		
			return 0;
		}
			
		function getItemCount(){
			return 0;
		}
		
		function hasItems()
		{
			return 0;	
		}
		
		function setDesignPurchased($cartDesign_id = 0){
		
			return 0;
				
		}
			
		function setCartPurchased(){
			
			return 0;
			
		}

			
		function emptyCart()
		{ 
			return 0;
		
		} 
			
		function getContents(){
				
			return '';		
		}
		
		function saveCart(){
			return 0;
		}
		
		function inCart($design_id = 0){
			return 0;	
		}
	
		function getHeaderBlock(){
			return '';
		}
	
	}
	
		
}
