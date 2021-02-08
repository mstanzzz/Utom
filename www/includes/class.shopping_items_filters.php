<?php
// INCOMPLETE. README:
// The product attributes are in multiple tables, and 
// the custom and built-in attributes are not interacting
// with the item table properly. Therefore, the filters
// below and in application in class.shopping_items_list assume
// that the table to filter by is just 'item'. HOWEVER:
// I have built a table value into the filter array,
// so once the DB tables for attributes are all completed
// and reference items in the item table, the filters class
// and shopping items list classes can be extended without much
// difficulty.
class Filters {
	function __construct() {
		unset($_SESSION["filter_options"]);
		if(!isset($_SESSION["filter_options"])){
			//	'range' items have multiple values; single items have a single value
			//					filter name, section's display title, type, db table, value(s)
			$this->addFilterOption('price','Price Ranges','range','item',array(0,50));
			$this->addFilterOption('price','Price Ranges','range','item',array(50,100));
			$this->addFilterOption('price','Price Ranges','range','item',array(100,200));
			$this->addFilterOption('price','Price Ranges','range','item',array(200,500));
			$this->addFilterOption('price','Price Ranges','range','item',array(500,1000));
			$this->addFilterOption('price','Price Ranges','range','item',array(1000,5000));
			// these should really just be added dynamically based on the category_to_attr contents, but for now
			// I am setting them manually.
			$this->addFilterOption('finish','Finishes','single','item',array('Wood'));
			$this->addFilterOption('finish','Finishes','single','item',array('Chrome'));
			$this->addFilterOption('finish','Finishes','single','item',array('Satin Nickel'));
			$this->addFilterOption('finish','Finishes','single','item',array('Aluminum'));
		}
	}
	
	
	function addFilterOption($name = 'default', $title = 'default', $type = 'single', $table = 'item', $vals)
	{
		
		$i = 0;
		if(isset($_SESSION["filter_options"])){
			$i = count($_SESSION["filter_options"]);
		}
		$_SESSION["filter_options"][$i]['name'] = $name;
		$_SESSION["filter_options"][$i]['title'] = $title;
		$_SESSION["filter_options"][$i]["type"] = $type;
		$_SESSION["filter_options"][$i]["table"] = $table;
		if (count($vals)>1 && $type == 'range'){
			$j = 0;
			foreach ($vals as $val){
				$_SESSION["filter_options"][$i]["values"][$j] = $val;
				$j++;
			}
		}
		else {
			$_SESSION["filter_options"][$i]["values"][0] = $vals[0];
		}
	}
		
	function updateFilterArray($filter_array,$new_filter){
		if(is_array($filter_array) && is_array($new_filter)){
			$i = count($filter_array)+1;
			$j = 0;
			foreach ($new_filter as $filter){
				$filter_array[$i]['name'] = $filter[$j]['name'];
				$filter_array[$i]['title'] = $filter[$j]['title'];
				$filter_array[$i]["type"] = $filter[$j]["type"];
				$filter_array[$i]["table"] = $filter[$j]["table"];
				if (count($filter[$j]["values"])>1 && $filter[$j]["type"] == "range"){
					$k = 0;
					foreach ($filter[$j]["values"] as $val){
						$filter_array[$i]["values"][$k] = $val;
						$k++;
					}
				}
				else {
					$filter_array[$i]["values"][0] = $filter[$j]["values"][0];
				}
				$j++;
				$i++;
			}
		}
		unset($_SESSION["filter_array"]);
		$_SESSION["filter_array"] = $filter_array;
		return $filter_array;
	}
	function createFilterArray($name = 'default', $title = 'default', $type = 'single', $table = 'item', $vals) {
		$new_filter = array("name"=>$name,"title"=>$title,"type"=>$type,"table"=>$table,"values"=>array($vals));
		//if (isset($_SESSION["filter_array"])){
		//	$filter_array = $this->updateFilterArray($_SESSION["filter_array"], $new_filter);
		//}
		//else {
			$_SESSION["filter_array"][0] = $new_filter;
			$filter_array[0] = array($new_filter);
		//}
		return $filter_array;
	}
	function createFilterList($id,$id_type,$sort_type,$current_page,$page_rows,$view_type){
		$filter_list = '';
		if (isset($_SESSION["filter_options"])){
			$i = 0;
			$name = $_SESSION["filter_options"][$i]['name'];
			$title = $_SESSION["filter_options"][$i]['title'];
			
			$base_ajax_url = "addFilter('".$_SERVER['DOCUMENT_ROOT']."/pages/cart/ajax-product-list.php?id=".$id."&id_type=".$id_type."&pagenum=".$current_page."&sort_type=".$sort_type."&page_rows=".$page_rows."&view_type=".$view_type;
			//$filter_qstr = is_array($filter_array) ? "&".http_build_query($filter_array,"filter_") : '';			
			
			$filter_list .= "<ul class='nested-links'><li><h5>".$title."</h5><ul>";
			foreach($_SESSION["filter_options"] as $filter_option){
				if ($_SESSION["filter_options"][$i]['name'] != $name) {
					$name = $_SESSION["filter_options"][$i]['name'];
					$title = $_SESSION["filter_options"][$i]['title'];
					$filter_list .= "</ul></li><li><h5>".$title."</h5><ul>";
				}
				else{
					$current_filter_array = $this->createFilterArray(
						$_SESSION["filter_options"][$i]['name'],
						$_SESSION["filter_options"][$i]['title'],
						$_SESSION["filter_options"][$i]["type"],
						$_SESSION["filter_options"][$i]["table"],
						$_SESSION["filter_options"][$i]["values"]);
					$filter_qstr = array("filter_qstr"=>$current_filter_array);
					$value = ($_SESSION["filter_options"][$i]["type"] == "range" && $_SESSION["filter_options"][$i]['name'] == "price") ? "$".number_format($_SESSION["filter_options"][$i]["values"][0],2) : $_SESSION["filter_options"][$i]["values"][0];
					$value_range = ($_SESSION["filter_options"][$i]["type"] == "range") ? " - $".number_format($_SESSION["filter_options"][$i]["values"][1],2) :'';
					$filter_name = $_SESSION["filter_options"][$i]['name'].": ".$value.$value_range;
					$current_ajax_url = $base_ajax_url."&".http_build_query($filter_qstr,"filter_")."','".$filter_name."')";
					
					$filter_list .= "<li><a onclick=\"".$current_ajax_url."\">".$value.$value_range."</a></li>";
				}
				$i++;
			}
			$filter_list .="</ul></li></ul>";
		}
		else {
			$filter_list = "No Filters Available";
		}
		return $filter_list;
	}
}
?>