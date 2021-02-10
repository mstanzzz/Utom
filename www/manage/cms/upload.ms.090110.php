<?php
include("../admin-includes/db_connect.php"); 

if($_POST){
	
	include('../admin-includes/class.upload.php');	
	$ret_page = $_POST['ret_page'];
	$slug = $_POST['slug'];
	$img_width = $_POST['img_width'];
	
	$dir_dest = "../uploads";
	$handle = new Upload($_FILES['uploadedfile']);
		
	if ($handle->uploaded) {
				
		// The file is on the server, now do stuff to it 
		// see http://www.verot.net/res/sources/class.upload.html        
		$handle->file_max_size = 1024*1024*2;		
		$handle->image_resize            = true;
		$handle->image_ratio_y           = true;		
		$handle->image_x                 = $img_width;
			
				
		$handle->allowed = array('image/jpeg','image/gif', 'image/bmp','image/x-windows-bmp','image/tiff','image/x-tiff');
		$handle->jpeg_quality = 60;
			
		// copy the uploaded file from its temporary location to the wanted location
		$handle->Process($dir_dest);
		// check if everything went OK
		if ($handle->processed) {
			$message = "OK";
		}else{	
			$message = "  Error: " . $handle->error;        
		}
			
		//$img_name = $handle->file_src_name;
		$img_name = $handle->file_dst_name;
			
		// delete the temporary files
		$handle->clean();
	} else {
		$message = "  Error: " . $handle->error;        
	}
	
	$sql = sprintf("INSERT INTO image (file_name, slug) VALUES ('%s','%s')", $img_name, $directory);
	$result = $dbCustom->getResult($db,$sql);
	//

	$header_str = "Location: ".$ret_page.".php";

	header($header_str);


}







?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Image</title>
</head>

<body>

<?php 

if(isset($_GET['ret_page'])){
	$ret_page = $_GET['ret_page'];
	if($ret_page == "policy") $slug = "policy";
	if($ret_page == "shipping-term") $slug = "shipping-term";
	if($ret_page == "shipping-time") $slug = "shipping-time";
	if($ret_page == "discount") $slug = "discount";
	if($ret_page == "discount-how") $slug = "discount-how";
	if($ret_page == "about-us") $slug = "about-us";
	if($ret_page == "testimonial-page") $slug = "testimonial-page";

}else{
	$ret_page = ''; 
	$slug = '';
}

if(isset($_GET["img_size"])){
	$img_width = $_GET["img_width"];
}else{
	$img_width = '';
}

//echo $slug;
?>

<form action="upload.php" method="post">
    
    <input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
	<input type="hidden" name="img_width" value="<?php echo $img_width; ?>" />
    
    Upload Image<br />
    <input type="file" name="uploadedfile"><br /><br /> 
    
    Page to display this image on<br />
    <select name="slug">
    
	   	<option value="about-us" <?php if($slug == "about-us"){echo "selected";} ?>>Company - about us</option>     	
    	<option value="discount" <?php if($slug == "discount"){echo "selected";} ?>>Company - discount</option>    	        
	   	<option value="discount-how" <?php if($slug == "discount-how"){echo "selected";} ?>>Company - discount how to</option>    	        
        <option value="policy" <?php if($slug == "policy"){ echo "selected";} ?>>Company - policy</option>
	   	<option value="testimonial-page" <?php if($slug == "testimonial-page"){echo "selected";} ?>>Company - testimonial page</option>     	
    	<option value="shipping-term" <?php if($slug == "shipping-term"){echo "selected";} ?>>Company - shipping term</option>    	        
    	<option value="shipping-time" <?php if($slug == "shipping-time"){echo "selected";} ?>>Company - shipping time</option>    	        
	   	<option value="testimonial-page" <?php if($slug == "testimonial-page"){echo "selected";} ?>>Company - testimonial page</option>     	
         
         
        
    </select>
    <br /><br />
    
    
    <input type="submit" value="Submit" />

</form>


</body>
</html>
<?php include("../admin-includes/db_disconnect.php"); ?>