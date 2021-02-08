<?php
require_once('config.php');

class OrderFulfillment
{
	
	// Call this when purchased
	public function initializeAllLiSteps($order_line_item_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$all_design_steps = $this->getAllSteps();
		
		foreach($all_design_steps as $val){
			
			$sql = "INSERT INTO fulfill_step_to_line_item
					(order_line_item_id
					,order_fulfillment_step_id)
					VALUES
					('".$order_line_item_id."'
					,'".$val['order_fulfillment_step_id']."')";
					
			$result = $dbCustom->getResult($db,$sql);
		}
		
		$min_id =  $this->getMinStepID();
		$this->setStepStart($order_line_item_id, $min_id);
		
	}
	
	public function getMinIdByNumber($step_number){
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT MIN(order_fulfillment_step_id) as min_id
				FROM order_fulfillment_step
				WHERE step_number = '".$step_number."'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			return $object->min_id;	
		}
		return 0;
		
	}
	
	public function getDesignFulfillmentStepData($order_fulfillment_step_id, $order_line_item_id){
        
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$ret_array = array();
		
		$sql = "SELECT fulfill_step_to_line_item.when_started
					,fulfill_step_to_line_item.when_finished
					,fulfill_step_to_line_item.is_parked
					,fulfill_step_to_line_item.not_applicable
					,order_fulfillment_step.step_name
					,order_fulfillment_step.description
					,order_fulfillment_step.single_action
				FROM fulfill_step_to_line_item, order_fulfillment_step
				WHERE fulfill_step_to_line_item.order_fulfillment_step_id = order_fulfillment_step.order_fulfillment_step_id				
				AND fulfill_step_to_line_item.order_line_item_id = '".$order_line_item_id."'
				AND fulfill_step_to_line_item.order_fulfillment_step_id = '".$order_fulfillment_step_id."'";	
		$result = $dbCustom->getResult($db,$sql);		
		
		if($result->num_rows > 0){
			
			$object = $result->fetch_object();			 
			 
			$ret_array['when_started'] = $object->when_started; 
			$ret_array['when_finished'] = $object->when_finished; 
			$ret_array['is_parked'] = $object->is_parked;
			$ret_array['not_applicable'] = $object->not_applicable; 
			$ret_array['step_name'] = $object->step_name; 
			$ret_array['description'] = $object->description;
			$ret_array['single_action'] = $object->single_action; 
			
		}else{
		
			$ret_array['when_started'] = 0; 
			$ret_array['when_finished'] = 0; 
			$ret_array['is_parked'] = 0; 
			$ret_array['not_applicable'] = 0; 
			$ret_array['step_name'] = ''; 
			$ret_array['description'] = ''; 
			$ret_array['single_action'] = 0;
		}
		
		return $ret_array;
		
    }
	
	public function getStepName($step_number = 0, $order_fulfillment_step_id = 0){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		if($order_fulfillment_step_id > 0){
			
			$sql = "SELECT step_name
					FROM order_fulfillment_step
					WHERE order_fulfillment_step_id = '".$order_fulfillment_step_id."'";
			
			
		}else{
			$sql = "SELECT step_name
					FROM order_fulfillment_step
					WHERE step_number = '".$step_number."'";
		}
		
		
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			
			$object = $result->fetch_object();			
			return $object->step_name;
			
		}else{
			return '';	
		}
		
	}
	
	public function hasStepRecord($order_line_item_id, $step_number){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT fulfill_to_line_item_id
				FROM fulfill_step_to_line_item 
				WHERE order_line_item_id = '".$order_line_item_id."'
				AND fulfill_step_number = '".$step_number."'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			return 1; 	
		}
		
		return 0;
		
	}

	public function undoNa($order_line_item_id, $order_fulfillment_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "UPDATE fulfill_step_to_line_item
				SET not_applicable = '0'
				WHERE order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";
				
		$result = $dbCustom->getResult($db,$sql);		
		
	}

	public function stepNa($order_line_item_id, $order_fulfillment_step_id){
		
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "UPDATE fulfill_step_to_line_item
				SET not_applicable = '1'
				WHERE order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";					
		$result = $dbCustom->getResult($db,$sql);		

		
	}

	public function undoParkStep($order_line_item_id, $order_fulfillment_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "UPDATE fulfill_step_to_line_item
				SET is_parked = '0'
				WHERE order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";
				
		$result = $dbCustom->getResult($db,$sql);		
		
	}
	
	public function parkStep($order_line_item_id, $order_fulfillment_step_id){
		
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "UPDATE fulfill_step_to_line_item
				SET is_parked = '1'
				WHERE order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";					
		$result = $dbCustom->getResult($db,$sql);		

		
	}
	
	public function undoStart($order_line_item_id, $order_fulfillment_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		//if($step_number > 1){
			$sql = "UPDATE fulfill_step_to_line_item
					SET when_started = '0', when_finished = '0'
					WHERE order_line_item_id = '".$order_line_item_id."'
					AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";
					
			$result = $dbCustom->getResult($db,$sql);
		//}
		
	}

	public function undoFinish($order_line_item_id, $order_fulfillment_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "UPDATE fulfill_step_to_line_item
				SET when_finished = '0'
				WHERE order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";
				
		$result = $dbCustom->getResult($db,$sql);		
		
	}
	
	public function isStarted($order_line_item_id, $order_fulfillment_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT fulfill_to_line_item_id
				FROM fulfill_step_to_line_item
				WHERE when_started > '0'
				AND order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";
				
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			return 1;	
		}
		
		return 0;
	}

	public function isFinished($order_line_item_id, $order_fulfillment_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT fulfill_to_line_item_id
				FROM fulfill_step_to_line_item
				WHERE when_finished > '0'
				AND order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";
				
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			return 1;	
		}
		
		return 0;
	}

		
	public function setStepStart($order_line_item_id, $order_fulfillment_step_id){
		
		$ts = time();

		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
	
		$sql = "UPDATE fulfill_step_to_line_item
				SET when_started = '".$ts."'
				WHERE order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";				
		$result = $dbCustom->getResult($db,$sql);
		
	}

	public function setFinished($order_line_item_id, $order_fulfillment_step_id){
		
		if($this->isStarted($order_line_item_id, $order_fulfillment_step_id)){
			
			$ts = time();
	
			$dbCustom = new DbCustom();				
			$db = $dbCustom->getDbConnect(CART_DATABASE);
				
			$sql = "UPDATE fulfill_step_to_line_item
					SET when_finished = '".$ts."'
					WHERE order_line_item_id = '".$order_line_item_id."'
					AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";					
			$result = $dbCustom->getResult($db,$sql);
		}
	}


	public function getMaxStartedStepNamePerOrder($order_id){


		$max_step_num = $this->getMaxStartedStepIDPerOrder($order_id); 

		return $this->getStepName($max_step_num);

	}

	public function getMaxStartedStepIDPerOrder($order_id){
		
		$line_items_array = $this->getOrderLineItems($order_id);
		
		$max_step_number = 0;
		
		foreach($line_items_array as $val){
				
			$tmp = $this->getMaxStartedStepNumber($val['design_id']);
			
			if($max_step_number < $tmp){
				$max_step_number = $tmp;
			}
		}
		
		return $max_step_number;
		
	}

	public function getMaxStartedStepNumber($design_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT MAX(fulfill_step_to_line_item.fulfill_step_number) AS max_step
				FROM fulfill_step_to_line_item, order_line_item 
				WHERE fulfill_step_to_line_item.order_line_item_id = order_line_item.order_line_item_id
				AND fulfill_step_to_line_item.when_started > '0'
				AND order_line_item.design_id = '".$design_id."'
				GROUP BY order_line_item.order_line_item_id";
		
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			
			$object = $result->fetch_object();
						
			return $object->max_step;
			
		}else{
			return 0;	
		}
		
	}

	public function getMaxFinishedStepNumber($design_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT order_line_item_id
				FROM order_line_item 
				WHERE order_line_item.design_id = '".$design_id."'";
		$result = $dbCustom->getResult($db,$sql);
		$max_step = 0;
		while($row = $result->fetch_object()){

			$sql = "SELECT MAX(order_fulfillment_step.step_number) AS max_step
					FROM fulfill_step_to_line_item, order_fulfillment_step
					WHERE fulfill_step_to_line_item.order_fulfillment_step_id = order_fulfillment_step.order_fulfillment_step_id 
					AND fulfill_step_to_line_item.order_line_item_id = '".$row->order_line_item_id."'";
			$res = $dbCustom->getResult($db,$sql);
			
			if($res->num_rows > 0){
				$object = $res->fetch_object();	
				//echo "<br />max_step ".$object->max_step;
				if($max_step < $object->max_step){
					$max_step = $object->max_step;
				}
			}
		}
		return $max_step;
	}

	
	public function getMaxStartedStepName($design_id){
		
		$max_step = $this->getMaxStartedStepNumber($design_id);
		
		return $this->getStepName($max_step);	
	}
	
	public function getOrderLineItems($order_id){
		
				
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$ret_array = array();
		
		$sql = "SELECT order_line_item_id 
					,design_id
				FROM order_line_item
				WHERE order_id = '".$order_id."'";	
		$result = $dbCustom->getResult($db,$sql);
		
		$i = 0;
		while($row = $result->fetch_object()){
			
			$ret_array[$i]['order_line_item_id'] = $row->order_line_item_id;
			$ret_array[$i]['design_id'] = $row->design_id;
			$i++;
		}
		
		return $ret_array;
				
	}



	public function getAllSteps(){
	
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$ret_array = array();
		
		$sql = "SELECT order_fulfillment_step_id
					,step_number
					,step_name
					,description
					,active
					,single_action
				FROM order_fulfillment_step
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY step_number";	
		$result = $dbCustom->getResult($db,$sql);		

		$i = 0;
		while($row = $result->fetch_object()){
	
			$ret_array[$i]['order_fulfillment_step_id'] = $row->order_fulfillment_step_id;
			$ret_array[$i]['step_number'] = $row->step_number;
			$ret_array[$i]['step_name'] = $row->step_name;
			$ret_array[$i]['description'] = $row->description;
			$ret_array[$i]['active'] = $row->active;
			$ret_array[$i]['single_action'] = $row->single_action;
			
			$i++;
		}
		
		return $ret_array;

	}
	
		

	public function getDesignName($design_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

		$sql = "SELECT 	file_name
				FROM design_purchases
				WHERE design_id = '".$design_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		
		if($result->num_rows > 0){			
			$object = $result->fetch_object();
			return  $object->file_name;
		}
		
		return '';

	}
	
	public function getDesignNameFromLineItem($order_line_item_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$design_id = 0;
		
		$sql = "SELECT design_id
				FROM order_line_item
				WHERE order_line_item_id = '".$order_line_item_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$design_id = $object->design_id;	
		}
		
		return $this->getDesignName($design_id);
		
	}
		
	public function isEmpAssignedToStep($order_line_item_id, $order_fulfillment_step_id, $employee_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$ret_array = array();
		
		$sql = "SELECT fulfill_step_li_to_emp_id 
				FROM fulfill_step_li_to_employee
				WHERE employee_id = '".$employee_id."'
				AND order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";	
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			return 1; 			
		}
		
		return 0;
		
	}
	
	public function addStepEmployee($order_line_item_id, $order_fulfillment_step_id, $employee_id){

		//echo "<br />order_line_item_id:   ".$order_line_item_id;
		//echo "<br />order_fulfillment_step_id:   ".$order_fulfillment_step_id;
		//echo "<br />employee_id:   ".$employee_id;
		//exit;
		
		if(!$this->isEmpAssignedToStep($order_line_item_id, $order_fulfillment_step_id, $employee_id)){

			$ts = time();
			
			$dbCustom = new DbCustom();				
			$db = $dbCustom->getDbConnect(CART_DATABASE);

			$sql = "INSERT INTO fulfill_step_li_to_employee
					(order_line_item_id
					  ,order_fulfillment_step_id
					  ,employee_id
					  ,when_assigned)
					VALUES
					('".$order_line_item_id."'
					,'".$order_fulfillment_step_id."'
					,'".$employee_id."'
					,'".$ts."')";
			$result = $dbCustom->getResult($db,$sql);
			
		}
		
	}

	public function removeStepEmployee($order_line_item_id, $order_fulfillment_step_id, $employee_id){

			$ts = time();
			
			$dbCustom = new DbCustom();				
			$db = $dbCustom->getDbConnect(CART_DATABASE);

			$sql = "UPDATE fulfill_step_li_to_employee
					SET when_removed = '".$ts."'
					WHERE employee_id = '".$employee_id."' 
					AND order_line_item_id = '".$order_line_item_id."'
					AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";					
			$result = $dbCustom->getResult($db,$sql);
			
			
			
	}

	public function getAllEmpPerStep($order_line_item_id, $order_fulfillment_step_id, $step_number = 0){
		
		
		//echo "<br />order_line_item_id  ".$order_line_item_id;
		//echo "<br />order_fulfillment_step_id  ".$order_fulfillment_step_id;
		//exit;
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$ret_array = array();
		
		$sql = "SELECT 	employee_id
					,when_assigned
					,when_removed
				FROM fulfill_step_li_to_employee
				WHERE order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";
				//AND fulfill_step_number = '".$step_number."'";					

		$result = $dbCustom->getResult($db,$sql);
		$i = 0;

		while($row = $result->fetch_object()){

			$ret_array[$i]['employee_id'] = $row->employee_id;
			$ret_array[$i]['when_assigned'] = $row->when_assigned;
			$ret_array[$i]['when_removed'] = $row->when_removed;
			
			$i++;
		}
		
		return $ret_array;
	}

	public function getAllActiveEmpPerStep($order_line_item_id, $order_fulfillment_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$ret_array = array();
		
		$sql = "SELECT 	employee_id
					,when_assigned
					,when_removed
				FROM fulfill_step_li_to_employee
				WHERE order_line_item_id = '".$order_line_item_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'
				AND when_removed = '0'";					
		$result = $dbCustom->getResult($db,$sql);
		$i = 0;

		while($row = $result->fetch_object()){

			$ret_array[$i]['employee_id'] = $row->employee_id;
			$ret_array[$i]['when_assigned'] = $row->when_assigned;
			$ret_array[$i]['when_removed'] = $row->when_removed;
			
			$i++;
		}
		
		return $ret_array;
	}


	public function getAllProductionEmployees(){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$ret_array = array();

		$sql = "SELECT admin_group.id as group_id 
				FROM  admin_group, admin_access, admin_section
				WHERE admin_group.id = admin_access.admin_group_id
				AND admin_section.id = admin_access.admin_section_id
				AND admin_access.admin_section_level > '1'
				AND admin_section.section_name = 'production'
				AND admin_group.profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);					
		
	
		$i = 0;
		while($row = $result->fetch_object()){
	
			$sql = "SELECT user.name AS employee_name
						,user.id AS employee_id 						
					FROM user, admin_user_to_admin_group					
					WHERE admin_user_to_admin_group.user_id = user.id
					AND admin_user_to_admin_group.admin_group_id = '".$row->group_id."'";
			$res = $dbCustom->getResult($db,$sql);				
	
			while($row = $res->fetch_object()){
				$ret_array[$i]['employee_id'] = $row->employee_id;
				$ret_array[$i]['employee_name'] = $row->employee_name;
				$i++;
			}
		}
		
		return $ret_array;
	}
	
	public function getNumOrderDesigns($order_id){

		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT order_line_item_id
				FROM order_line_item
				WHERE design_id > '0'
				AND order_id = '".$order_id."'";
		$result = $dbCustom->getResult($db,$sql);
			
		return $result->num_rows;	
			
	}
	
	public function isEmpAutoAssigned($employee_id, $order_fulfillment_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT fulfill_step_empl_auto_id
				FROM fulfill_step_empl_auto
				WHERE employee_id = '".$employee_id."'
				AND order_fulfillment_step_id = '".$order_fulfillment_step_id."'";
		
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			return 1;	
		}
			
		return 0;	
		
	}

	public function autoAssignEmp($employee_id, $order_fulfillment_step_id){
		
		if(!$this->isEmpAutoAssigned($employee_id, $order_fulfillment_step_id)){
			$dbCustom = new DbCustom();				
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			
			$sql = "INSERT INTO fulfill_step_empl_auto
					(employee_id, order_fulfillment_step_id, profile_account_id)
					VALUES
					('".$employee_id."', '".$order_fulfillment_step_id."', '".$_SESSION['profile_account_id']."')";
			
			$result = $dbCustom->getResult($db,$sql);
		}
		
	}

	public function setAllAutoAssignPerLI($order_line_item_id, $order_fulfillment_step_id){
			
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT employee_id
				FROM fulfill_step_empl_auto
				WHERE order_fulfillment_step_id = '".$order_fulfillment_step_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";		
		$result = $dbCustom->getResult($db,$sql);
				
		while($row = $result->fetch_object()){

			$this->addStepEmployee($order_line_item_id, $order_fulfillment_step_id, $row->employee_id);
			
		}
		
		
	}
	
	public function getRestriction($condition, $subject_step_id, $condition_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT fulfill_step_restriction_id
				FROM fulfill_step_restriction
				WHERE subject_step_id = '".$subject_step_id."'
				AND condition_step_id = '".$condition_step_id."'";
				
				if($condition == 'must_be_started'){
					$sql .= " AND must_be_started > 0";		
				}else{
					$sql .= " AND must_be_finished > 0";							
				}		
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			
			return 1;

		}		
		return 0;
		
	}


	public function getRestrictionsPerStep($subject_step_id){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$ret_array[0]['condition_step_name'] = '';		
		$ret_array[0]['must_be_started'] = 0;
		$ret_array[0]['must_be_finished'] = 0;
		
		$sql = "SELECT order_fulfillment_step.step_name
					,fulfill_step_restriction.must_be_started
					,fulfill_step_restriction.must_be_finished 
				FROM fulfill_step_restriction, order_fulfillment_step 
				WHERE fulfill_step_restriction.condition_step_id = order_fulfillment_step.order_fulfillment_step_id
				AND fulfill_step_restriction.subject_step_id = '".$subject_step_id."'";
		$result = $dbCustom->getResult($db,$sql);
		$i = 0;		
		while($row = $result->fetch_object()){
			
			$ret_array[$i]['condition_step_name'] = $row->step_name;		
			$ret_array[$i]['must_be_started'] = $row->must_be_started;
			$ret_array[$i]['must_be_finished'] = $row->must_be_finished;
			$i++;
		}
		
		return $ret_array;
	}
	
	public function getMaxStepNumber(){

		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT MAX(step_number) AS max_num
				FROM order_fulfillment_step
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object(); 
			return $object->max_num;	
		}else{
			return 0;	
		}
	}

	public function getMinStepNum(){
		
		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT MIN(step_number) AS min_num
				FROM order_fulfillment_step
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object(); 
			return $object->min_num;	
		}else{
			return 0;	
		}
		

	}

	public function getMinStepID(){
	
		$min_step_num = $this->getMinStepNum();
			
		return $this->getMinIdByNumber($min_step_num);		
		
	}
	
	
	public function isOrderComplete($order_id){

		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$max_step = $this->getMaxStepNumber();
		
		$sql = "SELECT order_line_item_id, design_id
				FROM order_line_item
				WHERE design_id > '0'
				AND order_id = '".$order_id."'";
		$result = $dbCustom->getResult($db,$sql);

		$num_designs = $result->num_rows; 
		
		$num_finished_designs = 0;
				
		while($row = $result->fetch_object()){
		
			if($max_step == $this->getMaxFinishedStepNumber($row->design_id)){
				
				$num_finished_designs++;
			
			}
		}

		if($num_designs == $num_finished_designs){
			return 1;	
		}
		return 0;
		
	}


	public function getNewJobNumber($user_id = 0){

		$dbCustom = new DbCustom();				
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$ts = time();				
		$sql = "INSERT INTO job
				(user_id, profile_account_id, when_created)
				VALUES
				('".$user_id."', '".$_SESSION['profile_account_id']."', '".$ts."')";
		$result = $dbCustom->getResult($db,$sql);
		$_SESSION['job_id'] = $db->insert_id; 
		
		return $_SESSION['job_id'];

	}
	
	
	public function getJobNumber($user_id = 0){
		
		
		
		if(!isset($_SESSION['job_id'])){
			
			$is_num = 0;
			$dbCustom = new DbCustom();				
			$db = $dbCustom->getDbConnect(CART_DATABASE);
		
			
			$sql = "SELECT MAX(job_id) as job_id
					FROM job
					WHERE user_id = '".$user_id."' 
					AND profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);
			if($result->num_rows > 0){
				$object = $result->fetch_object(); 					
				if(is_numeric($object->job_id)){
					$_SESSION['job_id'] = $object->job_id;
					$is_num = 1;
				}
			}
			
			
			if(!$is_num){
				$ts = time();				
				$sql = "INSERT INTO job
						(user_id, profile_account_id, when_created)
						VALUES
						('".$user_id."', '".$_SESSION['profile_account_id']."', '".$ts."')";
				$result = $dbCustom->getResult($db,$sql);
				$_SESSION['job_id'] = $db->insert_id; 
			}
		}
		
		return $_SESSION['job_id'];
		
	}



	
 	

}



?>