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

$page_title = "Select CMS Image";
$page_group = "select-image";

//	

$msg = '';


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


$sql = "UPDATE image
		SET slug = 'kwlp' 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		AND slug = ''";
$result = $dbCustom->getResult($db,$sql);	




if(isset($_POST["del_img_id"])){

	$img_id = $_POST["del_img_id"];
	
	
		
	$sql = sprintf("SELECT file_name FROM image WHERE img_id = '%u'", $img_id);
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
			
		//echo $object->file_name;
			
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$object->file_name;
		if(file_exists($p)) unlink($p);

		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/large/".$object->file_name;
		if(file_exists($p)) unlink($p);
			
		$sql = sprintf("DELETE FROM image WHERE img_id = '%u'", $img_id);
		$result = $dbCustom->getResult($db,$sql);
			
		$msg = "Image deleted.";
		
	}


}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>


function test(){
	alert("test");
}


function select_img(img_id){

	//alert(img_id);
	
	document.getElementById("r"+img_id).checked = true;
	
	//alert("lll");
		
}



</script>
</head>
<body class="lightbox">
<div class="lightboxholder">

<br />

<?php
$img_type = (isset($_GET['img_type'])) ? $_GET['img_type'] : '';

$img_slug = (isset($_GET['img_slug'])) ? $_GET['img_slug'] : '';

$ret_dir = (isset($_GET['ret_dir'])) ? $_GET['ret_dir'] : '';

$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';

$url_str = $ret_dir;

$url_str .= '/'.$ret_page.'.php';

?>


<br /><br />
<span style="color:#F00;">Warning: deleting an image can break apage that uses that image.</span> 
<br /><br />
<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>


<form name="add_image"  action="<?php echo $url_str; ?>" method="post"  enctype="multipart/form-data" target="_top">

<input type="hidden" name="add_selected_img" value="1">

<input type="hidden" name="img_type" value="<?php echo $img_type; ?>">

<input type="submit" name="submit" value="Submit">


    <table border="1" cellpadding="4">
    <tr>
    <td>Image</td>
    <!--<td>File Name</td>-->
    <td>&nbsp;</td>
    <td>Used at</td>
    <td>&nbsp;</td>
    </tr>
    
    <?php
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
    $sql = "SELECT img_id, file_name, slug 
			FROM image
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	
	if($img_slug != ''){
		$sql .= " AND slug = '".$img_slug."'";
	}
	
	$sql .= " ORDER BY file_name"; 
		
	$result = $dbCustom->getResult($db,$sql);	
	
	$block = "<tr>"; 
    while($row = $result->fetch_object()) {
			
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$row->file_name)){	
				
			$block .= "<td valign='top'>";
	
			//$sel = ($_SESSION['img_id']) ? "checked" : ''; 
			$sel = '';
			$block .= "<a onClick='select_img(".$row->img_id.")' >";	
			$block .= "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$row->file_name."'  />";
			//$block .= $row->img_id;
			$block .= "</a>";
			$block .= "</td>";
				
			//$row->file_name
			$block .= "<td valign='top'>";	
			$block .= "<input id='r".$row->img_id."' type='radio' name='sel_img_id' value='".$row->img_id."'/>";
			$block .= "</td>";


			$block .= "<td valign='top'>";	
			$block .= $row->slug;
			$block .= "</td>";
			
			
			$block .= "<td valign='top'>";
			if($row->slug == 'kwlp'){

				$block .= "<a class='btn btn-danger confirm '>
				<i class='icon-remove icon-white'></i>
				<input type='hidden' id='".$row->img_id."' class='itemId' value='".$row->img_id."' /></a>";
				
				
			}
			$block .= "</td>";
			
			
			/*
			$block .= "<td valign='top'>";	
			$image_is_used = 0;	
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
			*/
	
	
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

?>

<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>


<?php

$url_str = "select-cms-image.php";
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

