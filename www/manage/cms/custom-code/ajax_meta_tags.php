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


require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php"); 
//require_once($_SERVER['DOCUMENT_ROOT']."/includes/db_connect.php");

$action = (isset($_GET['action']))?	$_GET['action'] : '';


if($action != '0'){
	
	for($i = 0; $i < $_SESSION['input_count']; $i++){
		if(isset($_GET["tag_$i"])){
			$_SESSION['tag_values'][$i] = $_GET["tag_$i"]; 
		}else{
			$_SESSION['tag_values'][$i] = '';
		}
	}
}

if($action == 'delete'){

	$del_num = (isset($_GET["del_num"])) ? $_GET["del_num"] : '';

	$t = array();
	
	if($del_num != ''){
		for($i = 0; $i < $_SESSION['input_count']; $i++){

			if($i != $del_num){
				if(isset($_SESSION['tag_values'][$i])){
					if($_SESSION['tag_values'][$i] != ''){
						$t[] = $_SESSION['tag_values'][$i];	
					}
				}
			}
		}
		$_SESSION['tag_values'] = $t; 		
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
	
	<?php for($i = 0; $i < $_SESSION['input_count']; $i++){ ?>	
		query_str += '&tag_<?php echo $i; ?>='+$('#tag_<?php echo $i; ?>').val(); 		
	<?php } ?>
	
	//alert(query_str);
	
	return query_str;
}

function add_input(){
	
	q_str = '?action=add'+get_query_str();
	
	set_form(q_str);	
}


function delete_tag(v){

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
					
		if(!isset($_SESSION['tag_values'][$i])) $_SESSION['tag_values'][$i] = '';					 
										
		$block .= "<div style='float:left;'><input style='width:700px;' id='tag_".$i."' type='text' name='tags[]' value='".trim(stripslashes($_SESSION['tag_values'][$i]))."'></div>";
		$block .= "<div style='float:left;'><a class='btn btn-danger' style='cursor:pointer;' onclick='delete_tag(".$i.")' ><i class='icon-remove icon-white'></i></a></div>";						
		$block .= "<div style='clear:both'></div>";
					
	}			



//echo "input_count".$_SESSION['input_count'];

echo $block;



?>


