<?php
require_once($real_root."/includes/class.field_calculate.php");

class Formula {  

    public $final_price;
    
    public function __construct(){     
        $this->final_price = 0;
    }
	
	function is_val_1_free($formula_id = 0){

		if($formula_id > 0){

			$dbCustom = new DbCustom();

			$db = $dbCustom->getDbConnect(SHEETS_DATABASE);
			
			$sql = "SELECT	value_1_is_free
				FROM formula
				WHERE formula_id = '".$formula_id."'";
			$result = $dbCustom->getResult($db,$sql);
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				return $object->value_1_is_free; 
			}
			
			
		}
		
		return 0;
		
	}
	
	
	// used to calulate based on value 1 free
    function insert_val_1($formula_id = 0, $val_1 = 0){
				
		if($this->is_val_1_free($formula_id)){
		
			$dbCustom = new DbCustom();

			$db = $dbCustom->getDbConnect(SHEETS_DATABASE);
			
			$sql = "UPDATE formula
				SET number_value_1 = '".$val_1."', value_1_is_free = 0
				WHERE formula_id = '".$formula_id."'";
			$result = $dbCustom->getResult($db,$sql);
		}

	}


    function calculate_item_set($formula_id, $base_price){


		$this->insert_val_1($formula_id, $base_price);

		$ret_array = array();
		$ret_array['c_1'] = 0;
		$ret_array['c_2'] = 0;
		$ret_array['c_3'] = 0;
		$ret_array['c_4'] = 0;
		$ret_array['c_5'] = 0;
        

        $calc = new Field_calculate();

        $dbCustom = new DbCustom();

        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $sql = "SELECT *
			FROM formula
        WHERE formula_id = '".$formula_id."'";
        $result = $dbCustom->getResult($db,$sql);
        if($result->num_rows > 0){
            $object = $result->fetch_object();
			$number_value_1 = $object->number_value_1;
			$number_value_2 = $object->number_value_2;
			$number_value_3 = $object->number_value_3;
			$number_value_4 = $object->number_value_4;
			$number_value_5 = $object->number_value_5;
			$number_value_6 = $object->number_value_6;


			echo "<br />number_value_1  ".$number_value_1;
			echo "<br />number_value_2  ".$number_value_2;
			echo "<br />number_value_3  ".$number_value_3;
			echo "<br />number_value_4  ".$number_value_4;
			echo "<br />number_value_5  ".$number_value_5;
			echo "<br />number_value_6  ".$number_value_6;



				
			$operator_1 = $object->operator_1;
			$operator_2 = $object->operator_2;
			$operator_3 = $object->operator_3;
			$operator_4 = $object->operator_4;
			$operator_5 = $object->operator_5;
			
			
		
		$c_1 = $calc->calculate($number_value_1.$operator_1.$number_value_2);
		$c_2 = $calc->calculate($c_1.$operator_2.$number_value_3);
		$c_3 = $calc->calculate($c_2.$operator_3.$number_value_4);
		$c_4 = $calc->calculate($c_3.$operator_4.$number_value_5);
		$c_5 = $calc->calculate($c_4.$operator_5.$number_value_6);


		$ret_array['c_1'] = $c_1;
		$ret_array['c_2'] = $c_2;
		$ret_array['c_3'] = $c_3;
		$ret_array['c_4'] = $c_4;
		$ret_array['c_6'] = $c_6;


//$str = $number_value_1.$operator_1.$number_value_2.$operator_2.$number_value_3.$operator_3.$number_value_4.$operator_4.$number_value_5;	
//echo $str;
//echo "<br />";
//$final = $calc->calculate($str);


		return $ret_array;
	
		}
	}


    function do_calculate($formula_id){

        $calc = new Field_calculate();

        $dbCustom = new DbCustom();

        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $final = 0;

        $sql = "SELECT *
         FROM formula
        WHERE formula_id = '".$formula_id."'";
        $result = $dbCustom->getResult($db,$sql);

        if($result->num_rows > 0){
            $object = $result->fetch_object();

            $value_1_is_free = $object->value_1_is_free;
            $value_2_is_free = $object->value_2_is_free;
            $value_3_is_free = $object->value_3_is_free;
            $value_4_is_free = $object->value_4_is_free;
            $value_5_is_free = $object->value_5_is_free;
            $value_6_is_free = $object->value_6_is_free;
    
			$number_value_1 = $object->number_value_1;
			$number_value_2 = $object->number_value_2;
			$number_value_3 = $object->number_value_3;
			$number_value_4 = $object->number_value_4;
			$number_value_5 = $object->number_value_5;
			$number_value_6 = $object->number_value_6;
                
			if(!is_numeric($number_value_1)) $number_value_1 = '';
			if(!is_numeric($number_value_2)) $number_value_2 = '';
			if(!is_numeric($number_value_3)) $number_value_3 = '';
			if(!is_numeric($number_value_4)) $number_value_4 = '';
			if(!is_numeric($number_value_5)) $number_value_5 = '';
			if(!is_numeric($number_value_6)) $number_value_6 = '';

			if($number_value_1 == 0) $number_value_1 = '';
			if($number_value_2 == 0) $number_value_2 = '';
			if($number_value_3 == 0) $number_value_3 = '';
			if($number_value_4 == 0) $number_value_4 = '';
			if($number_value_5 == 0) $number_value_5 = '';
			if($number_value_6 == 0) $number_value_6 = '';


			$operator_1 = $object->operator_1;
			$operator_2 = $object->operator_2;
			$operator_3 = $object->operator_3;
			$operator_4 = $object->operator_4;
			$operator_5 = $object->operator_5;
                                
			$value_1_is_percent = $object->value_1_is_percent;
			$value_2_is_percent = $object->value_2_is_percent;
			$value_3_is_percent = $object->value_3_is_percent;
			$value_4_is_percent = $object->value_4_is_percent;
			$value_5_is_percent = $object->value_5_is_percent;
			$value_6_is_percent = $object->value_6_is_percent;

			if($value_1_is_percent) $number_value_1 = $number_value_1 / 100;
			if($value_2_is_percent) $number_value_2 = $number_value_2 / 100;
			if($value_3_is_percent) $number_value_3 = $number_value_3 / 100;
			if($value_4_is_percent) $number_value_4 = $number_value_4 / 100;
			if($value_5_is_percent) $number_value_5 = $number_value_4 / 100;
			if($value_6_is_percent) $number_value_6 = $number_value_6 / 100;

			$paren_1 = $object->paren_1;
			$paren_2 = $object->paren_2;
			$paren_3 = $object->paren_3;
			$paren_4 = $object->paren_4;
			$paren_5 = $object->paren_5;
			$paren_6 = $object->paren_6;

			$condition_1 = $object->condition_1;
			$condition_2 = $object->condition_2;
			$condition_3 = $object->condition_3;
			$condition_4 = $object->condition_4;
			$condition_5 = $object->condition_5;
			$condition_6 = $object->condition_6;

			$condition_value_1 = $object->condition_value_1;
			$condition_value_2 = $object->condition_value_2;
			$condition_value_3 = $object->condition_value_3;
			$condition_value_4 = $object->condition_value_4;
			$condition_value_5 = $object->condition_value_5;
			$condition_value_6 = $object->condition_value_6;
        
			$number_value_1 = $this->apply_condition($number_value_1, $condition_1, $condition_value_1);
			$number_value_2 = $this->apply_condition($number_value_2, $condition_2, $condition_value_2);
			$number_value_3 = $this->apply_condition($number_value_3, $condition_3, $condition_value_3);
			$number_value_4 = $this->apply_condition($number_value_4, $condition_4, $condition_value_4);
			$number_value_5 = $this->apply_condition($number_value_5, $condition_5, $condition_value_5);
			$number_value_6 = $this->apply_condition($number_value_6, $condition_6, $condition_value_6);
                				
				

			if($number_value_1 == ''){
				$paren_1 = '';
				$operator_1 = '';
			}
			if($number_value_2 == ''){
				$paren_2 = '';
				$operator_2 = '';
			}
			if($number_value_3 == ''){
				$paren_3 = '';
				$operator_3 = '';
			}
			if($number_value_4 == ''){
				$paren_4 = '';
				$operator_4 = '';    
			}
			if($number_value_5 == ''){
				$paren_5 = '';
				$operator_5 = '';    
			}
			if($number_value_6 == ''){
				$paren_6 = '';
			}

			$ele1 = '';
			$ele2 = '';
			$ele3 = '';
			$ele4 = '';
			$ele5 = '';
			$ele6 = '';

		if(is_numeric($number_value_1)){
			if($paren_1 == '('){
				$ele1 = $paren_1.$number_value_1;
				$ele1 = $number_value_1;        		
			}else{
				$ele1 = $number_value_1;        
			}
		}

		if(is_numeric($number_value_2)){
			if($paren_2 == '('){
				$ele2 = $paren_2.$number_value_2;
			}elseif($paren_2 == ')'){ 
				$ele2 = $number_value_2.$paren_2;        
			}else{
				$ele2 = $number_value_2;
			}
		}

		if(is_numeric($number_value_3)){
			if($paren_3 == '('){
				$ele3 = $paren_3.$number_value_3;
			}elseif($paren_3 == ')'){ 
				$ele3 = $number_value_3.$paren_3;        
			}else{
				$ele3 = $number_value_3;
			}
		}

		if(is_numeric($number_value_4)){
			if($paren_4 == '('){
				$ele4 = $paren_4.$number_value_4;
			}elseif($paren_4 == ')'){ 
				$ele4 = $number_value_4.$paren_4;        
			}else{
				$ele4 = $number_value_4;
			}
		}

		if(is_numeric($number_value_5)){
			if($paren_5 == '('){
				$ele5 = $paren_5.$number_value_5;
			}elseif($paren_5 == ')'){ 
				$ele5 = $number_value_5.$paren_5;        
			}else{
				$ele5 = $number_value_5;
			}
		}

		if(is_numeric($number_value_5)){
			if($paren_6 == ')'){
				$ele6 = $number_value_6.$paren_6;
			}else{
				$ele6 = $number_value_6;
			}
		}    
	
		$str = $ele1.$operator_1.$ele2.$operator_2.$ele3.$operator_3.$ele4.$operator_4.$ele5.$operator_5.$ele6;
				
		echo $str;
		
		$final = $calc->calculate($str);
    

	}

	return $final;
}



    function do_calculate_no_free($formula_id){

        $calc = new Field_calculate();

        $dbCustom = new DbCustom();

        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $final = 0;

        $sql = "SELECT number_value_1
                    ,number_value_2
                    ,number_value_3
                    ,number_value_4
                    ,number_value_5
                    ,number_value_6
                    ,paren_1
                    ,paren_2
                    ,paren_3
                    ,paren_4
                    ,paren_5
                    ,paren_6
                    ,value_1_is_percent
                    ,value_2_is_percent
                    ,value_3_is_percent
                    ,value_4_is_percent
                    ,value_5_is_percent
                    ,value_6_is_percent
                    ,value_1_is_free
                    ,value_2_is_free
                    ,value_3_is_free
                    ,value_4_is_free
                    ,value_5_is_free
                    ,value_6_is_free 
                    ,operator_1
                    ,operator_2
                    ,operator_3
                    ,operator_4
                    ,operator_5
                    ,condition_1
                    ,condition_2
                    ,condition_3
                    ,condition_4
                    ,condition_5
                    ,condition_6
                    ,condition_value_1
                    ,condition_value_2
                    ,condition_value_3
                    ,condition_value_4
                    ,condition_value_5
                    ,condition_value_6
        FROM formula
        WHERE formula_id = '".$formula_id."'";
        $result = $dbCustom->getResult($db,$sql);

        if($result->num_rows > 0){
            $object = $result->fetch_object();

            $value_1_is_free = $object->value_1_is_free;
            $value_2_is_free = $object->value_2_is_free;
            $value_3_is_free = $object->value_3_is_free;
            $value_4_is_free = $object->value_4_is_free;
            $value_5_is_free = $object->value_5_is_free;
            $value_6_is_free = $object->value_6_is_free;


            if($value_1_is_free == 0 
               && $value_2_is_free == 0
               && $value_3_is_free == 0
               && $value_4_is_free == 0
               && $value_5_is_free == 0
               && $value_6_is_free == 0){

     
                $number_value_1 = $object->number_value_1;
                $number_value_2 = $object->number_value_2;
                $number_value_3 = $object->number_value_3;
                $number_value_4 = $object->number_value_4;
                $number_value_5 = $object->number_value_5;
                $number_value_6 = $object->number_value_6;
                
                if(!is_numeric($number_value_1)) $number_value_1 = '';
                if(!is_numeric($number_value_2)) $number_value_2 = '';
                if(!is_numeric($number_value_3)) $number_value_3 = '';
                if(!is_numeric($number_value_4)) $number_value_4 = '';
                if(!is_numeric($number_value_5)) $number_value_5 = '';
                if(!is_numeric($number_value_6)) $number_value_6 = '';

                $operator_1 = $object->operator_1;
                $operator_2 = $object->operator_2;
                $operator_3 = $object->operator_3;
                $operator_4 = $object->operator_4;
                $operator_5 = $object->operator_5;
                
                
                if($operator_1 == 'x') $operator_1 = '*';
                if($operator_2 == 'x') $operator_2 = '*';
                if($operator_3 == 'x') $operator_3 = '*';
                if($operator_4 == 'x') $operator_4 = '*';
                if($operator_5 == 'x') $operator_5 = '*';
                
                
                $value_1_is_percent = $object->value_1_is_percent;
                $value_2_is_percent = $object->value_2_is_percent;
                $value_3_is_percent = $object->value_3_is_percent;
                $value_4_is_percent = $object->value_4_is_percent;
                $value_5_is_percent = $object->value_5_is_percent;
                $value_6_is_percent = $object->value_6_is_percent;

                if($value_1_is_percent) $number_value_1 = $number_value_1 / 100;
                if($value_2_is_percent) $number_value_2 = $number_value_2 / 100;
                if($value_3_is_percent) $number_value_3 = $number_value_3 / 100;
                if($value_4_is_percent) $number_value_4 = $number_value_4 / 100;
                if($value_5_is_percent) $number_value_5 = $number_value_4 / 100;
                if($value_6_is_percent) $number_value_6 = $number_value_6 / 100;


                $paren_1 = $object->paren_1;
                $paren_2 = $object->paren_2;
                $paren_3 = $object->paren_3;
                $paren_4 = $object->paren_4;
                $paren_5 = $object->paren_5;
                $paren_6 = $object->paren_6;

                $condition_1 = $object->condition_1;
                $condition_2 = $object->condition_2;
                $condition_3 = $object->condition_3;
                $condition_4 = $object->condition_4;
                $condition_5 = $object->condition_5;
                $condition_6 = $object->condition_6;

                $condition_value_1 = $object->condition_value_1;
                $condition_value_2 = $object->condition_value_2;
                $condition_value_3 = $object->condition_value_3;
                $condition_value_4 = $object->condition_value_4;
                $condition_value_5 = $object->condition_value_5;
                $condition_value_6 = $object->condition_value_6;
        
                $number_value_1 = $this->apply_condition($number_value_1, $condition_1, $condition_value_1);
                $number_value_2 = $this->apply_condition($number_value_2, $condition_2, $condition_value_2);
                $number_value_3 = $this->apply_condition($number_value_3, $condition_3, $condition_value_3);
                $number_value_4 = $this->apply_condition($number_value_4, $condition_4, $condition_value_4);
                $number_value_5 = $this->apply_condition($number_value_5, $condition_5, $condition_value_5);
                $number_value_6 = $this->apply_condition($number_value_6, $condition_6, $condition_value_6);
                

                if($number_value_1 == ''){
                    $paren_1 = '';
                    $operator_1 = '';
                }

                if($number_value_2 == ''){
                    $paren_2 = '';
                    $operator_2 = '';
                }
                if($number_value_3 == ''){
                    $paren_3 = '';
                    $operator_3 = '';
                }
                if($number_value_4 == ''){
                    $paren_4 = '';
                    $operator_4 = '';    

                }
                if($number_value_5 == ''){
                    $paren_5 = '';
                    $operator_5 = '';    
                }
                if($number_value_6 == ''){
                    $paren_6 = '';
                }

                $ele1 = '';
                $ele2 = '';
                $ele3 = '';
                $ele4 = '';
                $ele5 = '';
                $ele6 = '';
    
                if($paren_1 == '('){
                    $ele1 = $paren_1.$number_value_1;
                }else{
                    $ele1 = $number_value_1;        
                }
    
                if($paren_2 == '('){
                    $ele2 = $paren_2.$number_value_2;
                }elseif($paren_2 == ')'){ 
                    $ele2 = $number_value_2.$paren_2;        
                }else{
                    $ele2 = $number_value_2;
                }
    
                if($paren_3 == '('){
                    $ele3 = $paren_3.$number_value_3;
                }elseif($paren_3 == ')'){ 
                    $ele3 = $number_value_3.$paren_3;        
                }else{
                    $ele3 = $number_value_3;
                }
    
                if($paren_4 == '('){
                    $ele4 = $paren_4.$number_value_4;
                }elseif($paren_4 == ')'){ 
                    $ele4 = $number_value_4.$paren_4;        
                }else{
                    $ele4 = $number_value_4;
                }

                if($paren_5 == '('){
                    $ele5 = $paren_5.$number_value_5;
                }elseif($paren_5 == ')'){ 
                    $ele5 = $number_value_5.$paren_5;        
                }else{
                    $ele5 = $number_value_5;
                }

                if($paren_6 == ')'){
                    $ele6 = $number_value_6.$paren_6;
                }else{
                    $ele6 = $number_value_6;
                }
    
                $str = $ele1.$operator_1.$ele2.$operator_2.$ele3.$operator_3.$ele4.$operator_4.$ele5.$operator_5.$ele6;
                $final = $calc->calculate($str);
    
            }   
        }

        return $final;
    }

    
    public function apply_condition($number_value, $condition, $condition_value){
     
        if($number_value != '' && $condition_value != ''){
            if($condition == '<'){
                if($number_value >= $condition_value){
                    $number_value = '';
                }
            }
            if($condition == '<='){
                if($number_value > $condition_value){
                    $number_value = '';
                }
            }
            if($condition == '>'){
                if($number_value <= $condition_value){
                    $number_value = '';
                }
            }
            if($condition == '>='){
                if($number_value < $condition_value){
                    $number_value = '';
                }
            }
        }

        return $number_value;
        
        
    }
    
    public function get_operands(){
        
        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $sql = "SELECT op_id, name
                FROM formula_operand
                WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
                ORDER BY name";
        $result = $dbCustom->getResult($db,$sql);
        $op_array = array();
        $i = 0;
        while($row = $result->fetch_object()){
            $op_array[$i]['op_id'] = $row->op_id;		
            $op_array[$i]['name'] = $row->name;	
            $i++;
        }
        
        return $op_array;
        
    }

    
    public function add_operand($name){
        
        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $sql = "INSERT INTO formula_operand 
            (name, profile_account_id)
            values
            ('".$name."', '".$_SESSION['profile_account_id']."')";
        $result = $dbCustom->getResult($db,$sql);    
        
        return $db->insert_id;
    }
    
    public function update_operand($op_id, $name){

        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $sql = "UPDATE formula_operand
                SET name = '".$name."'
                WHERE op_id = '".$op_id."'"; 
        $result = $dbCustom->getResult($db,$sql);
        
        
    }

    
    public function delete_operand($op_id){
        
        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $sql = "DELETE FROM formula_operand
                WHERE op_id = '".$op_id."'"; 
        $result = $dbCustom->getResult($db,$sql);
    }
    
    public function get_operand_name($op_id){
        
        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $name = '';
        $sql = "SELECT name
                FROM formula_operand
                WHERE op_id = '".$op_id."'";
        $result = $dbCustom->getResult($db,$sql);
        if($result->num_rows > 0){
            $object = $result->fetch_object();
            $name = $object->name; 
            
        }
        
        return $name;
    }

    public function get_cat_name($cat_id){
        
        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $name = '';
        $sql = "SELECT name
                FROM formula_category
                WHERE cat_id = '".$cat_id."'";
        $result = $dbCustom->getResult($db,$sql);
        if($result->num_rows > 0){
            $object = $result->fetch_object();
            $name = $object->name; 
            
        }
        
        return $name;
    }

    public function get_cats(){
        
        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $sql = "SELECT cat_id, name
                FROM formula_category
                WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
                ORDER BY name";
        $result = $dbCustom->getResult($db,$sql);
        $cat_array = array();
        $i = 0;
        while($row = $result->fetch_object()){
            $cat_array[$i]['cat_id'] = $row->cat_id;		
            $cat_array[$i]['name'] = $row->name;	
            $i++;
        }
        
        return $cat_array;
        
    }
    
    public function add_category($name, $formula_ids){
        
        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);

        $sql = "INSERT INTO formula_category
            (name, profile_account_id)
            values
            ('".$name."', '".$_SESSION['profile_account_id']."')";
        $result = $dbCustom->getResult($db,$sql);    
        $cat_id = $db->insert_id;
		if(is_array($formula_ids)){
			foreach($formula_ids as $val){		
				
				$sql = "UPDATE formula
						SET cat_id = '".$cat_id."'
						WHERE formula_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);
			}
		}
        
    }
    
    public function delete_category($cat_id){
        
        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);
        
        $sql = "DELETE FROM formula_category
                WHERE cat_id = '".$cat_id."'"; 
        $result = $dbCustom->getResult($db,$sql);
        
    }
    
    
    public function update_category($cat_id, $name, $formula_ids){
        
        $dbCustom = new DbCustom();
        $db = $dbCustom->getDbConnect(SHEETS_DATABASE);
        $sql = "UPDATE formula_category
                SET name = '".$name."'
                WHERE cat_id = '".$cat_id."'"; 
        $result = $dbCustom->getResult($db,$sql);
			
		if(is_array($formula_ids)){
			
			$sql = "UPDATE formula
					SET cat_id = '0'
					WHERE cat_id = '".$cat_id."'";
			$result = $dbCustom->getResult($db,$sql);
			
			foreach($formula_ids as $val){
				
				$sql = "UPDATE formula
						SET cat_id = '".$cat_id."'
						WHERE formula_id = '".$val."'";
				$result = $dbCustom->getResult($db,$sql);
			}
			
		}
		
					

	}
    

}

?>