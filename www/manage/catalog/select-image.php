<?php
/* ms */
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$msg = '';

$ret_dir = (isset($_GET['ret_dir'])) ? $_GET['ret_dir'] : '';
$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';
$img_type = (isset($_GET['img_type'])) ? $_GET['img_type'] : '';
$parent_cat_id = (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;

$ret_dest = $ste_root.'/manage/'.$ret_dir.'/'.$ret_page.'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];



$sel_img_id = (isset($_GET['sel_img_id'])) ? $_GET['sel_img_id'] : 0;

if(isset($_POST["sel_img_id"])){

	echo "sel_img_id ".$sel_img_id;
		
	
}


if(isset($_POST["del_img_id"])){

	$img_id = $_POST["del_img_id"];
	if(!is_numeric($img_id)) $img_id = 0;
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
		
	$sql = sprintf("SELECT file_name FROM image WHERE img_id = '%u'", $img_id);
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
$object = $result->fetch_object();		

// only one
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$object->file_name;
if(file_exists($p)) unlink($p);

$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$object->file_name;
if(file_exists($p)) unlink($p);

$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$object->file_name;
if(file_exists($p)) unlink($p);
			

/* **** wide **** */

$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/wide/".$object->file_name;
if(file_exists($p)) unlink($p);

$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/wide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/wide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$object->file_name;
if(file_exists($p)) unlink($p);
			

/* **** extra wide **** */

$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);

$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);
	

			
$sql = sprintf("DELETE FROM image 
				WHERE img_id = '%u'
				AND profile_account_id = '%u'", $img_id, $_SESSION['profile_account_id']);
$result = $dbCustom->getResult($db,$sql);
			
$msg = "Image deleted.";
		
}
		


}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>


function select_img(img_id){
	
	document.getElementById("r"+img_id).checked = true;
	
	//alert("lll");
		
}



</script>
</head>
<body class="lightbox">
<div class="lightboxholder">

<?php
/*
if(isset($_SESSION['ret_path'])){
	if($_SESSION['ret_path'] != ''){
$ret_dest = $ste_root.'/manage/'.$_SESSION['ret_path'].'/'.$_SESSION['ret_page'].'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];
	}
}
*/
?>
<a href="<?php echo $ret_dest; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>

<?php

?>
<form name="add_image"  action="select-images.php" method="get"  enctype="multipart/form-data" target="_top">

<input type="hidden" name="ret_dir" value="<?php echo $ret_dir; ?>">
<input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>">
<input type="hidden" name="img_type" value="<?php echo $img_type; ?>">


    <table border="1" cellpadding="4">
    <tr>
    <td>Image</td>
    <!--<td>File Name</td>-->
    <td>Used at</td>
    <td>&nbsp;</td>
    </tr>
    
    <?php
	$db = $dbCustom->getDbConnect(CART_DATABASE);
    $sql = "SELECT img_id, file_name 
			FROM image
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY file_name";
$result = $dbCustom->getResult($db,$sql);	
	
	$block = "<tr>"; 
    while($row = $result->fetch_object()) {
			
if(file_exists($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$row->file_name)){	
				
			$block .= "<td valign='top'>";
	
			//$sel = ($_SESSION['img_id']) ? "checked" : ''; 
			$sel = '';
				
			$block .= "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$row->file_name."' onClick='select_img(".$row->img_id.")' />";
			//$block .= $row->img_id;
			$block .= "</td>";
				
			//$row->file_name
			$block .= "<td valign='top'>";	
			$block .= "<input id='r".$row->img_id."' type='radio' name='sel_img_id' value='".$row->img_id."'/>";
			$block .= "</td>";
			
			$block .= "<td valign='top'>";	
			$image_is_used = 0;	
			$sql = "SELECT name
			FROM category
			WHERE img_id = '".$row->img_id."'";
			
			$res = $dbCustom->getResult($db,$sql);
			while($t_row = $res->fetch_object()){
				$block .= "Category: ".$t_row->name."<br />";
				$image_is_used++;
	
			}
			
			$sql = "SELECT name
			FROM item
			WHERE img_id = '".$row->img_id."'";
			
			$res = $dbCustom->getResult($db,$sql);
			
			while($t_row = $res->fetch_object()){
				$block .= "Product: ".$t_row->name."<br />";
				$image_is_used++;
	
			}
	
	
			$sql = "SELECT item.name
			FROM item, item_gallery
			WHERE item.item_id = item_gallery.item_id
			AND item_gallery.img_id = '".$row->img_id."'";
			
			$res = $dbCustom->getResult($db,$sql);
			while($t_row = $res->fetch_object()){
				$block .= "Product: ".$t_row->name."<br />";
				$image_is_used++;
			}
	
	
			$sql = "SELECT banner.title, banner.section
			FROM banner, image
			WHERE banner.img_id = image.img_id
			AND image.img_id = '".$row->img_id."'";
			
			$res = $dbCustom->getResult($db,$sql);
			while($t_row = $res->fetch_object()){
				$block .= "Banner: ".$t_row->title." IN: ".$t_row->section."<br />";
				$image_is_used++;
			}
		
			if($image_is_used == 0){
				$block .= "Not used";
			}
		
			$block .= "</td>";
	
			$block .= "<td valign='middle'>";
			if($image_is_used == 0){
			$block .= "<a class='btn btn-danger confirm '>
				<i class='icon-remove icon-white'></i>
				<input type='hidden' id='".$row->img_id."' class='itemId' value='".$row->img_id."' /></a>";
			}
			$block .= "</td>";
	
			$block .= "</tr>";
			
		}
    }
    echo $block;
    ?>
    </table>
 		
		<div class="savebar">
			<button type="submit" name="select_image" class="btn btn-success"><i class="icon-ok icon-white"></i> Submit </button>
		</div>
        
	</form>
</div>

<?php
$url_str = $ret_dir;
$url_str .= '/'.$ret_page.'.php';
$url_str .= '?parent_cat_id='.$parent_cat_id;
$url_str .= '?cat_id='.$cat_id;

?>

<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>


<?php

$url_str = "select-image.php";
$url_str .= "?ret_dir=".$ret_dir;
$url_str .= "&ret_page=".$ret_page;


?>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this image?</h3>
	<form name="del_img_form" action="<?php echo $url_str; ?>" method="post" >
		<input id="del_img_id" class="itemId" type="hidden" name="del_img_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_img" type="submit" >Yes, Delete</button>
	</form>
</div>

   
</body>
</html>

