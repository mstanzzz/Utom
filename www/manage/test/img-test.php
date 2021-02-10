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

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = 0;


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
if(isset($_GET["nl"])){
	$msg = " ";	
}

$del_img_id = (isset($_GET['del_img_id'])) ? $_GET['del_img_id'] : 0;
$db = $dbCustom->getDbConnect(CART_DATABASE);


//clear_img_files();

function clear_img_files(){

	//$c_dir = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart";
$c_dir = "./saascustuploads/".$_SESSION['profile_account_id']."/cart";


//full
	$p = $c_dir."/full/";
	$files = glob($p.'/*'); // get all file names
	
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}



//large
	$p = $c_dir."/large/";

	$files = glob($p.'/*'); // get all file names
	
	foreach($files as $file){ // iterate files	  
	  if(is_file($file))
		unlink($file); // delete file
	}

	$p = $c_dir."/large/wide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

	$p = $c_dir."/large/exwide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

//medium
	$p = $c_dir."/medium/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

	$p = $c_dir."/medium/wide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

	$p = $c_dir."/medium/exwide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}


//small
	$p = $c_dir."/small/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

	$p = $c_dir."/small/wide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

	$p = $c_dir."/small/exwide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}


//thumb
	$p = $c_dir."/thumb/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

	$p = $c_dir."/thumb/wide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

	$p = $c_dir."/thumb/exwide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

//tiny
	$p = $c_dir."/tiny/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

//print_r($files);

	$p = $c_dir."/tiny/wide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

	$p = $c_dir."/tiny/exwide/";
	$files = glob($p.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}

	//echo $p;

}



if($del_img_id > 0){

	$sql = "SELECT file_name FROM image WHERE img_id = '".$del_img_id."'";
	$res = $dbCustom->getResult($db,$sql);
	if($res->num_rows > 0){

		$object = $res->fetch_object();

// only one
$p = $c_dir."/full/".$object->file_name;
if(file_exists($p)) unlink($p);


$p = $c_dir."/tiny/".$object->file_name;
if(file_exists($p)) unlink($p);

$p = $c_dir."/thumb/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/small/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/medium/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/large/".$object->file_name;
if(file_exists($p)) unlink($p);
			

/* **** wide **** */

$p = $c_dir."/tiny/wide/".$object->file_name;
if(file_exists($p)) unlink($p);

$p = $c_dir."/thumb/wide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/small/wide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/medium/wide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/large/wide/".$object->file_name;
if(file_exists($p)) unlink($p);
			

/* **** extra wide **** */

$p = $c_dir."/tiny/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);

$p = $c_dir."/thumb/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/small/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/medium/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/large/exwide/".$object->file_name;
if(file_exists($p)) unlink($p);


		$sql = "DELETE FROM image WHERE img_id = '".$del_img_id."' ";
		$result = $dbCustom->getResult($db,$sql);
		//echo $sql;



	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<script>

</script>
</head>
<body>

<div class="manage_page_container">

	<div class="manage_main">

<table border="1" cellpadding="10" >
<tr>
<td></td>
<td></td>
<td></td>
</tr>
<?php
$sql = "SELECT img_id, file_name 
		FROM image";
$res = $dbCustom->getResult($db,$sql);
		
while($row = $res->fetch_object()){

	echo "<tr>";
	echo "<td>".$row->img_id."</td>";
	echo "<td>".$row->file_name."</td>";
	echo "<td>";		
	echo "<a href='img-test.php?del_img_id=".$row->img_id."'>DELETE</a>";
	echo "</td>";
	echo "</tr>";

}
?>
</table>






	
		<a href="img-test.php?del_img_id=<?php echo $_SESSION['img_id']; ?>">DELETE</a>
		<br />
		<br />
		<?php
		$url_str = $ste_root."manage/catalog/select-image.php";
		$url_str .= "?ret_page=img-test";
		$url_str .= "&ret_path=test";
		$url_str .= "&ret_dir=test";
		echo "<a href='".$url_str."'>See All Images</a>";
		?>
		<br />
		<br />
		<?php 
		$_SESSION['crop_n'] = 1;
		$_SESSION['img_type'] = 'cart';

		$url_str = $ste_root."manage/upload-pre-crop.php";
		$url_str .= "?ret_page=img-test";
		$url_str .= "&ret_path=test";
		$url_str .= "&ret_dir=test";
		$url_str .= "&img_type=cart";
		
		?>
		<a href="<?php echo $url_str; ?>">Upload-new-image</a>
		<br />
		<br />
		
		<?php	

echo "img_id:  ".$_SESSION['img_id'];
echo "<br />";	
	
		$sql = "SELECT file_name 
		FROM image 
		WHERE img_id = '".$_SESSION['img_id']."'";
		$img_res = $dbCustom->getResult($db,$sql);
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();
echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$img_obj->file_name."'>";	
		}
		?>
		<br />
		<hr />		
		<br />
		<?php
		if($img_res->num_rows > 0){
echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$img_obj->file_name."'>";
		}			
		?>
		<br />
		<hr />		
		<br />
		<?php
		if($img_res->num_rows > 0){
echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$img_obj->file_name."'>";
		}			
		?>
		<br />
		<hr />		
		<br />


		

	</div>

</div>



<?php

/* ***  DELETE ALL IMAGES  *** */

$sql = "SELECT img_id, file_name FROM image"; 
$res = $dbCustom->getResult($db,$sql);

if(0){
	
//while($row = $res->fetch_object()){	

// only one
$p = $c_dir."/full/".$row->file_name;
if(file_exists($p)) unlink($p);


$p = $c_dir."/tiny/".$row->file_name;
if(file_exists($p)) unlink($p);

$p = $c_dir."/thumb/".$row->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/small/".$row->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/medium/".$row->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/large/".$row->file_name;
if(file_exists($p)) unlink($p);
			

/* **** wide **** */

$p = $c_dir."/tiny/wide/".$row->file_name;
if(file_exists($p)) unlink($p);

$p = $c_dir."/thumb/wide/".$row->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/small/wide/".$row->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/medium/wide/".$row->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/large/wide/".$row->file_name;
if(file_exists($p)) unlink($p);
			

/* **** extra wide **** */

$p = $c_dir."/tiny/exwide/".$row->file_name;
if(file_exists($p)) unlink($p);

$p = $c_dir."/thumb/exwide/".$row->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/small/exwide/".$row->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/medium/exwide/".$row->file_name;
if(file_exists($p)) unlink($p);
			
$p = $c_dir."/large/exwide/".$row->file_name;
if(file_exists($p)) unlink($p);


	$sql = sprintf("DELETE FROM image 
					WHERE img_id = '%u'", $row->img_id);
	$result = $dbCustom->getResult($db,$sql);

}

?>



</body>
</html>





