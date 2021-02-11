<?php
error_reporting(0);
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.admin_login.php');

// This class depends on user being logged in
// All properties are dependent on the current logged in user
class AdminAccess
{
    // property declarations
    public $admin_group_ids = array();
    public $cms_level;
    public $product_catalog_level;
    public $ecommerce_level;
    public $customers_level;
	public $orders_level;
	public $administration_level;
	public $design_level;
	public $master_level;
	public $tool_level;
	

	function __construct(){


		$this->admin_group_ids = $this->getAdminGroupIDs();
		$this->cms_level = $this->getCmsLevel();		
		$this->product_catalog_level = $this->getProductCatalogLevel();		
		$this->ecommerce_level = $this->getEcommerceLevel();		
		$this->customers_level = $this->getCustomersLevel();	
		$this->orders_level = $this->getOrdersLevel();			
		$this->administration_level = $this->getAdministrationSectionLevel();	
		$this->design_level = $this->getDesignLevel();
		$this->master_level = $this->getMasterLevel();
		$this->tool_level = $this->getToolLevel();	
	
	}

	function allowAll(){

		$this->admin_group_ids = 2;
		$this->cms_level = 2;		
		$this->product_catalog_level = 2;		
		$this->ecommerce_level = 2;		
		$this->customers_level = 2;	
		$this->orders_level = 2;
		$this->administration_level = 2;	
		$this->design_level = 2;
		$this->master_level = 2;
		$this->design_tool = 2;
			
	}


	public function getAdminGroupIDs(){
		
		//if(!isset($_SESSION['admin_access']['admin_group_ids'])){
			$_SESSION['admin_access']['admin_group_ids'] = array();
			$aLgn = new AdminLogin;
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT admin_group_id
					FROM admin_user_to_admin_group
					WHERE user_id = '".$aLgn->getUserId()."'";					
			$result = $dbCustom->getResult($db,$sql);			
			$i = 0;
			while($row = $result->fetch_object()){
				$_SESSION['admin_access']['admin_group_ids'][$i] = $row->admin_group_id;	
				$i++;
			}
		//}
		
		return $_SESSION['admin_access']['admin_group_ids'];
	}
	
	public function getCmsLevel() {
		//if(!isset($_SESSION['admin_access']['cms_level'])){	
			$_SESSION['admin_access']['cms_level'] = 0;					
			foreach($_SESSION['admin_access']['admin_group_ids'] as $val){
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT admin_section_level
						FROM admin_access, admin_section
						WHERE admin_access.admin_section_id = admin_section.id
						AND admin_section.section_name = 'cms'
						AND admin_access.admin_group_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					if($_SESSION['admin_access']['cms_level'] < $object->admin_section_level){
						 $_SESSION['admin_access']['cms_level'] = $object->admin_section_level;
					}
				}
			}			
		//}
		
		$_SESSION['admin_access']['cms_level'] = 5;
		return $_SESSION['admin_access']['cms_level'];
	}

	public function getProductCatalogLevel() {
		//if(!isset($_SESSION['admin_access']['product_catalog_level'])){
			$_SESSION['admin_access']['product_catalog_level'] = 0;
			foreach($_SESSION['admin_access']['admin_group_ids'] as $val){
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT admin_section_level
						FROM admin_access, admin_section
						WHERE admin_access.admin_section_id = admin_section.id
						AND admin_section.section_name = 'product_catalog'
						AND admin_access.admin_group_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					if($_SESSION['admin_access']['product_catalog_level'] < $object->admin_section_level){
						$_SESSION['admin_access']['product_catalog_level'] = $object->admin_section_level;
					}
				}
			}			
		//}
		$_SESSION['admin_access']['product_catalog_level'] = 5;
		return $_SESSION['admin_access']['product_catalog_level'];
	}

 	
	public function getEcommerceLevel() {
		//if(!isset($_SESSION['admin_access']['ecommerce_level'])){
			$_SESSION['admin_access']['ecommerce_level'] = 0;
			foreach($_SESSION['admin_access']['admin_group_ids'] as $val){
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT admin_section_level
						FROM admin_access, admin_section
						WHERE admin_access.admin_section_id = admin_section.id
						AND admin_section.section_name = 'ecommerce'
						AND admin_access.admin_group_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					if($_SESSION['admin_access']['ecommerce_level'] < $object->admin_section_level){
						 $_SESSION['admin_access']['ecommerce_level'] = $object->admin_section_level;
					}
				}
			}			
		//}
		$_SESSION['admin_access']['ecommerce_level'] = 5;
		return $_SESSION['admin_access']['ecommerce_level'];
	}

	public function getCustomersLevel() {
		//if(!isset($_SESSION['admin_access']['customers_level'])){
			$_SESSION['admin_access']['customers_level'] = 0;
			foreach($_SESSION['admin_access']['admin_group_ids'] as $val){
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT admin_section_level
						FROM admin_access, admin_section
						WHERE admin_access.admin_section_id = admin_section.id
						AND admin_section.section_name = 'customers'
						AND admin_access.admin_group_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					if($_SESSION['admin_access']['customers_level'] < $object->admin_section_level){
						 $_SESSION['admin_access']['customers_level'] = $object->admin_section_level;
					}
				}
			}			
		//}
		$_SESSION['admin_access']['customers_level'] = 5;
		return $_SESSION['admin_access']['customers_level'];
	}

	public function getOrdersLevel() {
		//if(!isset($_SESSION['admin_access']['orders_level'])){
			$_SESSION['admin_access']['orders_level'] = 0;
			foreach($_SESSION['admin_access']['admin_group_ids'] as $val){
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT admin_section_level
						FROM admin_access, admin_section
						WHERE admin_access.admin_section_id = admin_section.id
						AND admin_section.section_name = 'customers_orders'
						AND admin_access.admin_group_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					if($_SESSION['admin_access']['orders_level'] < $object->admin_section_level){
						 $_SESSION['admin_access']['orders_level'] = $object->admin_section_level;
					}
				}
			}			
		//}
		$_SESSION['admin_access']['orders_level'] = 5;
		return $_SESSION['admin_access']['orders_level'];
	}

	public function getAdministrationSectionLevel() {
		//if(!isset($_SESSION['admin_access']['administration_level'])){
			$_SESSION['admin_access']['administration_level'] = 0;
			foreach($_SESSION['admin_access']['admin_group_ids'] as $val){
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT admin_section_level
						FROM admin_access, admin_section
						WHERE admin_access.admin_section_id = admin_section.id
						AND admin_section.section_name = 'administration'
						AND admin_access.admin_group_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					if($_SESSION['admin_access']['administration_level'] < $object->admin_section_level){
						 $_SESSION['admin_access']['administration_level'] = $object->admin_section_level;
					}
				}
			}			
		//}
		$_SESSION['admin_access']['administration_level'] = 5;
		return $_SESSION['admin_access']['administration_level'];
	}


	public function getDesignLevel() {
		//if(!isset($_SESSION['admin_access']['design_level'])){
			$_SESSION['admin_access']['design_level'] = 0;
			foreach($_SESSION['admin_access']['admin_group_ids'] as $val){
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT admin_section_level
						FROM admin_access, admin_section
						WHERE admin_access.admin_section_id = admin_section.id
						AND admin_section.section_name = 'design'
						AND admin_access.admin_group_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					if($_SESSION['admin_access']['design_level'] < $object->admin_section_level){
						 $_SESSION['admin_access']['design_level'] = $object->admin_section_level;
					}
				}
			}			
		//}
		$_SESSION['admin_access']['design_level'] = 5;
		return $_SESSION['admin_access']['design_level'];
	}


	public function getToolLevel() {
		//if(!isset($_SESSION['admin_access']['tool_level'])){
			$_SESSION['admin_access']['tool_level'] = 0;
			foreach($_SESSION['admin_access']['admin_group_ids'] as $val){
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT admin_section_level
						FROM admin_access, admin_section
						WHERE admin_access.admin_section_id = admin_section.id
						AND admin_section.section_name = 'tool'
						AND admin_access.admin_group_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					if($_SESSION['admin_access']['tool_level'] < $object->admin_section_level){
						 $_SESSION['admin_access']['tool_level'] = $object->admin_section_level;
					}
				}
			}			
		//}
		$_SESSION['admin_access']['design_level'] = 5;
		return $_SESSION['admin_access']['design_level'];
	}


	public function getMasterLevel() {
		//if(!isset($_SESSION['admin_access']['master_level'])){
			$_SESSION['admin_access']['master_level'] = 0;
			foreach($_SESSION['admin_access']['admin_group_ids'] as $val){
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT admin_section_level
						FROM admin_access, admin_section
						WHERE admin_access.admin_section_id = admin_section.id
						AND admin_section.section_name = 'master'
						AND admin_access.admin_group_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					if($_SESSION['admin_access']['master_level'] < $object->admin_section_level){
						 $_SESSION['admin_access']['master_level'] = $object->admin_section_level;
					}
				}
			}			
		//}
		$_SESSION['admin_access']['master_level'] = 5;
		return $_SESSION['admin_access']['master_level'];
	}



}

?>