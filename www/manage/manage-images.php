<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root."/includes/config.php");

require_once($real_root."/manage/admin-includes/manage_functions.php");


$db = $dbCustom->getDbConnect(CART_DATABASE);


if(isset($_GET["del_fn"])){
	$file_name = $_GET["del_fn"];
	
	delete_images_from_files($dbCustom,$file_name,$real_root);
	$msg = "Image deleted.";
}

/*
$sql = "DELETE
		FROM image
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$sql = "SELECT *
FROM category
WHERE img_id = '4239'";
$result = $dbCustom->getResult($db,$sql);
*/

$sql = "DELETE 
		FROM item_gallery";
//$result = $dbCustom->getResult($db,$sql);

/*
$sql = "SELECT img_id
		FROM item_gallery";
$result = $dbCustom->getResult($db,$sql);
while($row = $result->fetch_object()){		
	echo $row->img_id;
	echo "<br />";
	do_gal_re_name_by_id($dbCustom,$row->img_id);
}
*/

if(isset($_GET["rename_fn"])){
	$old_file_name = $_GET["rename_fn"];
	echo "old_file_name::::::  ".$old_file_name;
	echo "<br />";
	$cat_data = get_cat_this_img($dbCustom,$old_file_name,$real_root);	
	$item_data = get_item_this_img($dbCustom,$old_file_name,$real_root);
	
	$cn=sizeof($cat_data);
	$in=sizeof($item_data);
	$tn=$cn+$in;

	echo $cn; 
	echo "<br />";
	echo $in; 	
	echo "<br />";
	echo $tn; 	
	echo "<br />";
	
	print_r($cat_data);
	print_r($item_data);
	
	if($cn>0){
		$don_in_files = rename_cart_images_in_dirs($cat_data['original_fn'], $cat_data['new_file_name'], $real_root);
		if($don_in_files){
		rename_img_in_db($dbCustom,$cat_data['img_id'],$cat_data['new_file_name']);
		}
	}
	if($in>0){
		$don_in_files = rename_cart_images_in_dirs($item_data['original_fn'], $item_data['new_file_name'], $real_root);
		if($don_in_files){
		rename_img_in_db($dbCustom,$item_data['img_id'],$item_data['new_file_name']);
		}
	}
	if($tn<1){
		delete_images_from_files($dbCustom,$old_file_name,$real_root);
	}
	
}

function do_gal_re_name_by_id($dbCustom,$img_id){
	
	$new_file_name = 'organizer';
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "UPDATE image
			SET file_name = '".$new_file_name."'
			WHERE img_id = '".$img_id."'";
	//$result = $dbCustom->getResult($db,$sql);	
	
	//rename_cart_gal_images_in_dirs($old_file_name, $new_file_name, $real_root, $domain=''){
	
	
	
}


function delete_images_from_files($dbCustom,$file_name,$real_root){
	if(strlen($file_name)>4){
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$file_name;
		if(file_exists($p)) unlink($p);
		/* **** wide **** */
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/wide/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/wide/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/wide/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$file_name;
		if(file_exists($p)) unlink($p);
		/* **** extra wide **** */
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/exwide/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/exwide/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/exwide/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/exwide/".$file_name;
		if(file_exists($p)) unlink($p);
		$p = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$file_name;
		if(file_exists($p)) unlink($p);
		$db = $dbCustom->getDbConnect(CART_DATABASE);		
		$sql = "DELETE FROM image 
				WHERE file_name = '".$file_name."'
				AND profile_account_id = '1'";
		$result = $dbCustom->getResult($db,$sql);
	}			
}


function rename_img_in_db($dbCustom,$img_id,$new_file_name){	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "UPDATE image
			SET file_name = '".$new_file_name."'
			WHERE img_id = '".$img_id."'";
	$result = $dbCustom->getResult($db,$sql);	
}




function get_cat_this_img($dbCustom,$fn,$real_root){
	$ret_data = array();
	$ext='';	
	$path = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$fn;
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	if(strlen($ext)>1){
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT img_id
				FROM image
				WHERE file_name = '".$fn."'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object(); 	
			$sql = "SELECT name
					FROM category
					WHERE img_id = '".$object->img_id."'";
			$r = $dbCustom->getResult($db,$sql);
			if($r->num_rows > 0){
				$o=$r->fetch_object(); 	
				$cat_name=$o->name;
				$new_file_name = get_prep_this_img_str($o->name,$ext);
				$ret_data['img_id']=$object->img_id;
				$ret_data['original_fn']=$fn;
				$ret_data['ext']=$ext;
				$ret_data['new_file_name']=$new_file_name;
			}
		}
	}
	return $ret_data;
}

function get_item_this_img($dbCustom,$fn,$real_root){
	$ret_data = array();
	$ext='';	
	$path = $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$fn;
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	if(strlen($ext)>1){
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT img_id
				FROM image
				WHERE file_name = '".$fn."'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object(); 	
			$sql = "SELECT name
					FROM item
					WHERE img_id = '".$object->img_id."'";
			$r = $dbCustom->getResult($db,$sql);
			if($r->num_rows > 0){
				$o=$r->fetch_object(); 	
				$cat_name=$o->name;
				$new_file_name = get_prep_this_img_str($o->name,$ext);
				$ret_data['img_id']=$object->img_id;
				$ret_data['original_fn']=$fn;
				$ret_data['ext']=$ext;
				$ret_data['new_file_name']=$new_file_name;
			}
		}
	}
	return $ret_data;
}

function get_prep_this_img_str($cat_name,$ext){
	$new_file_name = strtolower($cat_name); 
	$new_file_name = str_ireplace(' ','-',$new_file_name);
	$new_file_name = str_ireplace('/','-',$new_file_name);
	$new_file_name = str_ireplace('&','-',$new_file_name);
	$new_file_name = str_ireplace('--','-',$new_file_name);
	$new_file_name = str_ireplace('--','-',$new_file_name);
	$new_file_name = $new_file_name.".".$ext;
	return $new_file_name; 
}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>

</head>
<body>
<br />
<a href="start.php">DONE</a>
<br />
<br 		/>
<a href="rename-images.php">Rename All Cart Images</a>
<br />
<br />

<table cellpadding="20"  border="1"  style="margin-left:80px;">
<tr>
<td width="10%"></td>
<td width="20%"></td>
</tr>
<?php
$dir  = $real_root.'/saascustuploads/1/cart/full/';
$dir  = $real_root.'/saascustuploads/1/cart/large/';
$dir  = $real_root.'/saascustuploads/1/cart/large/wide/';

$files = scandir($dir);
foreach($files as $key => $val){

	echo "<tr>";
	if(strlen($val) > 4){
		$url_str = SITEROOT."manage/manage-images.php?del_fn=".$val;
		echo "<td><a href='".$url_str."' style='color:red;'>Delete</a></td>";
		echo "<td>".$val."</td>";
		$url_str = SITEROOT."manage/manage-images.php?rename_fn=".$val;		
		echo "<td><a href='".$url_str."' style='color:red;'>Rename</a></td>";
		echo "<td><img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$val."' ></td>";		
	}		
	echo "</tr>";
}

?>
</table>



</body>
</html>

