<?php 
if(session_id() == ''){
	session_start();
}

require_once('config.php');
//require_once('class.dbcustom.php');

if(!isset($_SESSION['enable_tool'])) $_SESSION['enable_tool'] = 0;

if($_SESSION['enable_tool']){



	/////////////////////////////
	//Constant Definitions
		require 'parameterConstants.php';
	
		require 'sessionParameterConstants.php';
	
	
	class DesignCart {
	
		public $customer_id;
		public $anonymous_shopper_id;	
		public $design_cart_array;
		public $total_price;

		
		function __construct() {
		   $this->customer_id = (isset($_SESSION[SESSION_PARAM_CTG_CUSTOMER_ID]))? $_SESSION[SESSION_PARAM_CTG_CUSTOMER_ID] : 0;
		   $this->anonymous_shopper_id = (isset($_SESSION[SESSION_PARAM_ANONYMOUS_SHOPPER_ID]))? $_SESSION[SESSION_PARAM_ANONYMOUS_SHOPPER_ID] : rand();
			   
			   
		   if(!isset($_SESSION[SESSION_PARAM_DESIGN_CART])){
				$_SESSION[SESSION_PARAM_DESIGN_CART] = array();
		   }
		   
			$this->design_cart_array = $_SESSION[SESSION_PARAM_DESIGN_CART];
			  
			$this->reloadDesignCart();
		}
		
	
		function addDesign($sendToCartRequestData){
					
			//Global Declarations
				global $_ERROR_MESSAGES;
					
			//Dummy Control
				if(count($sendToCartRequestData) == 0){
					array_push($_ERROR_MESSAGES, 'No cart parameters were sent to be queued.');
					return false;
				}
					
			//Calls to initializes the Database access
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		
			//Error Control
				if(isset($db) == false || !$db){
					array_push($_ERROR_MESSAGES, 'Unable to establish connection with database.');
					return false;
				}
		
			//Calls to prepare a SQL call
				$stmt = $db->prepare("INSERT INTO
						designPurchases(
							 user_id
							,Purchased
							,designID
							,inCart
							,currentStatus
							,project_id
							,conversationID
							,deleted
							,designPrice
							,file_name
							,fileDescription
							,thumbnailImage								
							,create_date
							,purchase_date								
							,design_xml
							,customUnitIDs
							,customToePlateIDs
							,customCleatIDs
							,customBackingIDs
							,customPanelIDs
							,customComponentIDs
							,customPartIDs
							,saas_id
						)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
					);
	
			//Error Control
				if(isset($stmt) == false || $stmt == false){
					array_push($_ERROR_MESSAGES, 'Unable to bind parameters to purchases.');
					return false;
				}
	
			//Calls to bind the above parameters
				$bindParameterSuccess = $stmt->bind_param("iiiiiiiissssssssssssssi",
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
					$sendToCartRequestData[PARAM_SASS_ID]);
				
			//Error Control
				if(!isset($bindParameterSuccess) || !$bindParameterSuccess){
					array_push($_ERROR_MESSAGES, 'Unable to bind parameter values to purchases.');
					return false;
				}
		
			//Calls to executre the call
				if($stmt->execute() == false){
					$stmt->close();
					array_push($_ERROR_MESSAGES, 'Attempting to add the cart entry failed.');
					return false;
				}
						
			//Calls to close the $stmt object
				$stmt->close();
				
			//Calls to reload the design cart
				$this->reloadDesignCart();
		
			//Returns the new entry id
				return $db->insert_id;
			}
			
		
		
			function reloadDesignCart(){
				
				$this->total_price = 0;
				
				$dbCustom = new DbCustom();				
				$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		
				$t = array();
				$i = 0;
					
						
				$sql = "SELECT cartDesign_id
								,designPrice
								,file_name
								,thumbnailImage
								,designID
						FROM designPurchases
						WHERE user_id = '".$this->customer_id."'
						AND Purchased = '0'
						AND deleted = '0'";
				$result = $dbCustom->getResult($db,$sql);		
					
				while($row = $result->fetch_object()) {
					
					$t[$i]['cartDesign_id'] = $row->cartDesign_id;
					$t[$i]['designID'] = $row->designID;
									
					$t[$i]['name'] = $row->file_name;
					
					$tmp = str_replace('$', '', $row->designPrice);
					
					$this->total_price += $tmp;

					$t[$i]['designPrice'] = $tmp;
					$t[$i]['thumbnailImage'] = $row->thumbnailImage;					
					$t[$i]['qty'] = 1;
					
					$i++;
				}
				
				//$this->design_cart_array = $_SESSION[SESSION_PARAM_DESIGN_CART];
				
				$_SESSION[SESSION_PARAM_DESIGN_CART] = $t;
				$this->design_cart_array = $_SESSION[SESSION_PARAM_DESIGN_CART];
				
				//return $this->design_cart_array;	
				return 1;
				//echo '<img src="data:image/jpeg;base64,'.base64_encode( $t[$i]['thumbnailImage'] ).'"/>';
				// The image is 100x100px,
				
			
			}
		
			function removeDesign($cartDesign_id = 0)
			{
		
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
				
				$sql = "UPDATE designPurchases
						SET deleted = '1', inCart = '0'
						WHERE cartDesign_id = '".$cartDesign_id."'";	
				$result = $dbCustom->getResult($db,$sql);	
				
				$this->reloadDesignCart();
				
				return 1;
			}
			
			function getItemCount(){
				return count($_SESSION[SESSION_PARAM_DESIGN_CART]);
			}
		
			function hasItems()
			{
				return (count($_SESSION[SESSION_PARAM_DESIGN_CART]) > 0) ? 1 : 0;	
			}
			
			function setDesignPurchased($cartDesign_id = 0){
				
				
				
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
				$sql = "UPDATE designPurchases
						SET Purchased = '1', currentStatus = '1', purchase_date = NOW()
						WHERE cartDesign_id = '".$cartDesign_id."'";
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
				
				return $_SESSION[SESSION_PARAM_DESIGN_CART];
			}
	
			function saveCart(){
				return 1;
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
	
		function getHeaderBlock(){
			return '';
		}
	
	}
	
		
}

?>
