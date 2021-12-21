<?php


if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($real_root."/includes/config.php"); 
//require_once($real_root."/includes/db_connect.php");

$action = (isset($_REQUEST['action']))?	$_REQUEST['action'] : '';


if($action != '0'){
	
	for($i = 0; $i < $_SESSION['input_count']; $i++){
		
		if(isset($_REQUEST["exc_$i"])){
		
			//echo "<br />".$_REQUEST["exc_$i"];	
			
			$_SESSION['exclude_values'][$i] = $_REQUEST["exc_$i"]; 
		}else{
			$_SESSION['exclude_values'][$i] = '';
		}
	}
}

if($action == 'delete'){

	$del_num = (isset($_REQUEST["del_num"])) ? $_REQUEST["del_num"] : '';

	$t = array();
	
	if($del_num != ''){
		for($i = 0; $i < $_SESSION['input_count']; $i++){

			if($i != $del_num){
				if(isset($_SESSION['exclude_values'][$i])){
					if($_SESSION['exclude_values'][$i] != ''){
						$t[] = $_SESSION['exclude_values'][$i];	
					}
				}
			}
		}
		$_SESSION['exclude_values'] = $t; 		
		$_SESSION['input_count'] = count($t);	
	}
}

if($action == 'add'){
	$_SESSION['input_count']++;
}

?>

<script>

function get_query_str(){
	
	query_str = '';
	
	var the_val = ''
	
	<?php for($i = 0; $i < $_SESSION['input_count']; $i++){ ?>	
		
		the_val = $('#exc_<?php echo $i; ?>').val();
		
		the_val = the_val.replace("&", "||");
		
		query_str += '&exc_<?php echo $i; ?>='+the_val;
		
		
		 		
	<?php } ?>
	
	//alert(query_str);
	
	return query_str;
}


function delete_exclude(v){

	q_str = '?action=delete&del_num='+v;
	q_str += get_query_str();
	set_form(q_str);
}


</script>

<?php

//$db = $dbCustom->getDbConnect(CART_DATABASE);

	//if(isset($_GET['name'])) $_SESSION["temp_cat_fields"]['name'] = $_GET['name'];


	$block = '';

	for($i = 0; $i < $_SESSION['input_count']; $i++){
					
		if(!isset($_SESSION['exclude_values'][$i])) $_SESSION['exclude_values'][$i] = '';					 
		
		
		$_SESSION['exclude_values'][$i] = str_replace('||','&', $_SESSION['exclude_values'][$i]);
										
		$block .= "<div style='float:left;'><input id='exc_".$i."' type='text' name='excludes[]' value='".$_SESSION['exclude_values'][$i]."'></div>";
		$block .= "<div style='float:left;'><a onclick='delete_exclude(".$i.")' href='#'>Delete</a></div>";						
		$block .= "<div style='clear:both'></div>";
					
	}			



//echo "input_count".$_SESSION['input_count'];

echo $block;



?>


