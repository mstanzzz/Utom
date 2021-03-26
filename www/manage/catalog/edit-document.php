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

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Document";
$page_group = "doc";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';




if($_POST){
	


	$ret_page = $_POST['ret_page'];
	$ret_dir = $_POST['ret_dir'];	
	$parent_cat_id = $_POST['ret_dir'];
	$cat_id	= $_POST['ret_dir'];
	$fromfancybox = $_POST['fromfancybox'];
	$document_id = $_POST['document_id'];

	$name = addslashes($_POST['name']);

	$new_vend_man_id = isset($_POST['vend_man_id']) ? $_POST['vend_man_id'] : '';


	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$existing_file_name = '';
	$existing_common_path = '';
	$old_vm_path = '';
	$new_vm_path = '';
	$old_vend_man_id = 0;

	$sql = "SELECT vend_man_id, file_name 
			FROM document 
			WHERE document_id = '".$document_id."'";									
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$existing_file_name = $object->file_name;			
		$old_vend_man_id = $object->vend_man_id;
		$existing_common_path = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/docs";
		
		if($old_vend_man_id > 0){
			$sql = "SELECT name FROM vend_man 
					WHERE vend_man_id = '".$old_vend_man_id."'";									
			$result = $dbCustom->getResult($db,$sql);
			
			if($result->num_rows > 0){
				
				if($existing_file_name != ''){
					$oldvm_object = $result->fetch_object();
					$oldvm_name = getUrlText($oldvm_object->name);
					$old_vm_path = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/docs/".$oldvm_name;
					
				}
			}
		}
	}
	
	
	if($existing_file_name != ''){
	
		// new vend_man name		
		$sql = "SELECT name FROM vend_man 
				WHERE vend_man_id = '".$new_vend_man_id."'";									
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			
			$object = $result->fetch_object();			
			$newvm_name = getUrlText($object->name);
			$new_vm_path = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/docs/".$newvm_name;
			
		}
	}

	if($existing_file_name != ''){

		if (file_exists($old_vm_path)) {
			if($new_vm_path != ''){
				
				if(!file_exists($new_vm_path)){
					mkdir($new_vm_path);	
				}
				
				rename($old_vm_path.'/'.$existing_file_name, $new_vm_path.'/'.$existing_file_name);
			}else{
				rename($old_vm_path.'/'.$existing_file_name,$existing_common_path.'/'.$existing_file_name);
			}
		}
	}


	$sql = sprintf("UPDATE document 
					SET name = '%s', vend_man_id = '%u' 
					WHERE document_id = '%u'", 
					$name, $new_vend_man_id, $document_id);
	$r = $dbCustom->getResult($db,$sql);


	if($fromfancybox == 0){
		$header_str = $ret_dir."/".$ret_page.".php";
		$header_str .= "?parent_cat_id=".$parent_cat_id;	
		$header_str .= "&cat_id=".$cat_id;		
		$header_str .= "&document_id=".$document_id;
		$header_str .= "&action=update_document";
		
		echo("<script language='javascript'>");
		echo("top.location.href = '".$header_str."';");
		echo("</script>");
	}else{
		$header_str = "Location: ".$ret_dir."/".$ret_page.".php";
		$header_str .= "?parent_cat_id=".$parent_cat_id;	
		$header_str .= "&cat_id=".$cat_id;		
		$header_str .= "&document_id=".$document_id;
		$header_str .= "&action=update_document";

		header($header_str);
	}

}





require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body class="lightbox">
<div class="lightboxholder">


<?php

$document_id = (isset($_GET['document_id'])) ? $_GET['document_id'] : 0;
$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : 'edit-item';
$ret_dir = (isset($_GET['ret_dir'])) ? $_GET['ret_dir'] : 'product';

$parent_cat_id = (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;


$fromfancybox = (isset($_GET['fromfancybox'])) ? $_GET['fromfancybox'] : 0;


$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = sprintf("SELECT * 
			FROM document 
			WHERE document_id = '%u'", $document_id);
$result = $dbCustom->getResult($db,$sql);if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name;
	$vend_man_id = $object->vend_man_id;
}else{
	$name = '';
	$vend_man_id = 0;
}

?>

	<form name="edit_doc" action="edit-document.php" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data">
            <input type="hidden" name="document_id" value="<?php echo $document_id; ?>" />
            <input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
			<input type="hidden" name="ret_dir" value="<?php echo $ret_dir; ?>" />
			<input type="hidden" name="parent_cat_id" value="<?php echo $parent_cat_id; ?>" />
			<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
			<input type="hidden" name="fromfancybox" value="<?php echo $fromfancybox; ?>" />
            
			<fieldset>  
                <div class="center">      
                    <div class="colcontainer">
                        <label>Document Name</label>
                        <input type="text" name="name" value="<?php echo stripslashes($name); ?>"/>
                    </div> 
                    <div class="colcontainer">
                        <label>Vendor Manufacturer</label>
                        <select name="vend_man_id">
                        <option value="0">None</option> 
                        <?php
                        
                        $sql = "SELECT * FROM vend_man 
                        WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
                                                
                        $db = $dbCustom->getDbConnect(CART_DATABASE);
                        $result = $dbCustom->getResult($db,$sql);
                        
                        
                        while($row = $result->fetch_object()){						
                            $selected = ($row->vend_man_id == $vend_man_id)? 'selected' : '';						
                            echo "<option value='".$row->vend_man_id."' $selected>".$row->name."</option>";	
                        }
                        ?>
                        </select>
                    </div> 
                </div>
                    
                           
			</fieldset>
        
       <div class="savebar">
			<button type="submit" name="edit_document" class="btn btn-success"><i class="icon-ok icon-white"></i> Submit Change </button>
		</div>
    </form>
	
</div>
</div>
</body>
</html>


