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



$page_title = "Item Gallery";
$page_group = "item-gallery";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


$showroom_item_id = $_REQUEST['showroom_item_id']; 

//echo "showroom_item_id: ".$showroom_item_id;


if(isset($_POST['upload_to_gallery'])){

	include('../admin-includes/class.upload.php');	

	$dir_dest = "../uploads";
	$handle = new Upload($_FILES['uploadedfile']);
				
	if ($handle->uploaded) {
				
		// The file is on the server, now do stuff to it 
		// see http://www.verot.net/res/sources/class.upload.html        

		$handle->file_max_size = 1024*1024*2;		
		
		//echo $img_height."  ".$img_width;
		//exit;

			$handle->image_x                 = 250;			
			$handle->image_y                 = 240;
			$handle->image_resize            = true;
			//$handle->image_crop  	 		 = array($img_height,$img_width);
		
		$handle->allowed = array('image/jpeg','image/gif', 'image/bmp','image/x-windows-bmp','image/tiff','image/x-tiff');
		$handle->jpeg_quality = 50;
			
		// copy the uploaded file from its temporary location to the wanted location
		$handle->Process($dir_dest);
		// check if everything went OK
		if ($handle->processed) {
			$message = "Upload Successful";

			//$img_name = $handle->file_src_name;
			$img_name = $handle->file_dst_name;

			$sql = sprintf("INSERT INTO showroom_item_gallery  (file_name, showroom_item_id, profile_account_id) 
			VALUES ('%s','%u','%u')", 
			$img_name, $showroom_item_id, $_SESSION['profile_account_id']);			
			$result = $dbCustom->getResult($db,$sql);
			//

		}else{	
			$message = "  Error: " . $handle->error;        
		}
		
		// delete the temporary files
		$handle->clean();
	} else {
		$message = "  Error: " . $handle->error;        
	}
		//echo "img_name:".$img_name."<br />";
		//echo "message:".$message;
		//exit;	
}


if(isset($_POST["del_img"])){

	$img_id = $_POST["del_img_id"];

	$sql = sprintf("SELECT file_name FROM showroom_item_gallery WHERE showroom_item_gallery_id = '%u'", $img_id);
	$result = $dbCustom->getResult($db,$sql);
	$object = $result->fetch_object();
	$myFile = "../uploads/".$object->file_name;
	//echo $img_id."<br/>";
	//echo $myFile;
	//exit;


	$sql = sprintf("DELETE FROM showroom_item_gallery WHERE showroom_item_gallery_id = '%u'", $img_id);
	$result = $dbCustom->getResult($db,$sql);
	//

	// remove from dir
	if(file_exists($myFile)) unlink($myFile);


}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>



<script>
$(document).ready(function() {
	

	$(".inline").click(function(){ 

		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_img_id").val(f_id);
			
		}
		
	})
	
	$("a.inline").fancybox();
	
	//$("#view_desc").click(function(){ $.fancybox.close;  })

});


</script>
</head>

	<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');


?>





<div class="manage_page_container">


    <div class="manage_side_nav">
        <?php 
        require_once("../admin-includes/manage-side-nav.php");
        ?>
    </div>	

	<?php 	if(in_array(2,$user_functions_array)){ ?>
    <div class="top_link">
       	<a href='gallery-upload.php?showroom_item_id=<?php echo $showroom_item_id; ?>'>Image Upload</a>
    </div>
	<?php } ?>




    <div class="manage_main">
    
    
<?php 

		$add_to_title = '';
		
		if($showroom_item_id){
			$sql = "SELECT name, showroom_sub_cat_id 
					FROM showroom_item
					WHERE showroom_item_id = '".$showroom_item_id."'";
	$result = $dbCustom->getResult($db,$sql);			$object = $result->fetch_object();
			$add_to_title = "For ".$object->name;
		}
        
        echo "<div class='manage_main_page_title'>".$page_title." ".$add_to_title."</div>";
    
        $bc = $bread_crumb->output();
        echo $bc; 



    $sql = sprintf("SELECT * FROM showroom_item_gallery WHERE showroom_item_id = '%u'", $showroom_item_id);
    $img_res = $dbCustom->getResult($db,$sql);
    $i = 1;
    while($img_row = $img_res->fetch_object()) {
    	$block = ''; 
        $block .= "<div class='img_box'>";
        $block .= "<img src='../uploads/".$img_row->file_name."'  width='200px'  />";
    	
		if(in_array(2,$user_functions_array)){	
			$block .= "<br /><a class='inline' href='#delete' style='color:#3f6e84;'>
			<img src='../images/button_delete.jpg'/><div class='e_sub' id='".$img_row->showroom_item_gallery_id."' style='display:none'></div> </a>";
		}
		
        $block .= "</div>";
        if($i % 4 == 0) $block .= "<div class='clear'></div>";
        $i++;
		echo $block;
    }
    
	?>
    
    <div class="clear"></div>
    
    <div style="display:none">
        <div id="delete" style="width:200px; height:100px;">			        
            Are you sure you want to delete this gallery image?<br /><br />
            <form name="del_img_form" action="item-gallery.php" method="post">
           		<input id="showroom_item_id" type="hidden" name="showroom_item_id" value="<?php echo $showroom_item_id;  ?>" />
           		<input type="hidden" name="ret_page" value="<?php echo $ret_page;  ?>" />
                <input id="del_img_id" type="hidden" name="del_img_id" />    
                <input name="del_img" type="submit" value="DELETE" />
            </form>
            
        </div>
    </div>
    <!--
    <div style="display:none">
        <div id="upload" style="width:280px; height:200px;">
        <form name="upload_to_gallery_form" action="item-gallery.php" method="post" enctype="multipart/form-data">
            <input id="showroom_item_id" type="hidden" name="showroom_item_id" value="<?php echo $showroom_item_id;  ?>" />
        	<input type="hidden" name="ret_page" value="<?php echo $ret_page;  ?>" />

            <input id="img_width" type="hidden" name="img_width" value="<?php echo $img_width;  ?>" />
            <input id="img_height" type="hidden" name="img_height" value="<?php echo $img_height;  ?>" />
            <br /><br />Upload an Image to add to this item's gallery<br /><br />
            <input type="file" name="uploadedfile"><br /><br />             
            <input name="upload_to_gallery" type="submit" value="Submit" />
        </form>
        </div>
    </div>
	-->
</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>

</div>

</body>
</html>



