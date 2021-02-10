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


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Select Document";
$page_group = "select";

//	

$msg = '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
</head>
<body class="lightbox">
<div class="lightboxholder">

<?php

$ret_dir = (isset($_GET['ret_dir'])) ? $_GET['ret_dir'] : '';
$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';
$parent_cat_id = (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : '';
$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : '';


$url_str = $ret_dir;
$url_str .= '/'.$ret_page.'.php';

?>
<form name="add_doc"  action="<?php echo $url_str; ?>" method="get"  enctype="multipart/form-data" target="_top">

<input type="hidden" name="parent_cat_id" value="<?php echo $parent_cat_id; ?>">
<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">


    <table border="1" width="100%" cellpadding="18">
    <tr>
    <td>Document Name</td>    
    <td>File Name</td>
    <td>Select</td>    
    <td>Used at</td>
    </tr>
    
    <?php
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
    $sql = "SELECT document_id, file_name, name 
			FROM document
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	
	
	$block = "<tr>"; 
    while($row = $result->fetch_object()) {
				
		$block .= "<td>$row->name</td>";	
		
		$block .= "<td>$row->file_name</td>";
			
		$block .= "<td><input type='radio' name='sel_doc_id' value='".$row->document_id."' /></td>";
		
		$block .= "<td valign='top'>";	
		$doc_is_used = 0;	
		$sql = "SELECT item.name
		FROM item_to_document, item
		WHERE item_to_document.item_id = item.item_id
		AND item_to_document.document_id = '".$row->document_id."'";
		
		$res = $dbCustom->getResult($db,$sql);
		while($t_row = $res->fetch_object()){
			$block .= "Item: ".$t_row->name."<br />";
			$doc_is_used++;
		}
	
		if($doc_is_used == 0){
			$block .= "Not used";
		}
	
		$block .= "</td>";
        $block .= "</tr>";
		
/*		
		if($row->name == "testtest"){
			
			$sql = "DELETE FROM document
					WHERE document_id = '".$row->document_id."'";
			$res = $dbCustom->getResult($db,$sql);	
			
		}
	
	*/	
		/*
		if(!$doc_is_used){
			
			$sql = "DELETE FROM document
					WHERE document_id = '".$row->document_id."'";
			$res = $dbCustom->getResult($db,$sql);	
			
							
		}
		*/
		
		
    }
    echo $block;
    ?>
    </table>
 		</div>
		<div class="savebar">
			<button type="submit" name="select_doc" class="btn btn-success"><i class="icon-ok icon-white"></i> Submit </button>
		</div>
	</form>
</div>
   
</body>
</html>

