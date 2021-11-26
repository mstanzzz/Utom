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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Cart Categories";
$page_group = "itam-gal";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
$cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
$item_id = $_REQUEST['item_id']; 
$new_img_id = (isset($_GET['new_img_id'])) ? $_GET['new_img_id'] : 0;

$ret_page = (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : ''; 


if(isset($_POST['add_to_gallery'])){
	
	
	
	$img_id = $_POST['img_id']; 
	$sql = "INSERT INTO item_gallery 
			(img_id, item_id) 
			VALUES( '".$img_id."', '".$item_id."')";
$result = $dbCustom->getResult($db,$sql);	
}


if(isset($_POST["del_from_gallery"])){

	$item_gallery_id = $_POST["del_item_gallery_id"];


	$sql = sprintf("DELETE FROM item_gallery WHERE item_gallery_id = '%u'", $item_gallery_id);
	$result = $dbCustom->getResult($db,$sql);
	

}




require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>


<script>
$(document).ready(function() {
	

	$(".inline").click(function(){ 

		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_item_gallery_id").val(f_id);
			
		}
		
	})
	
	$("a.inline").fancybox();
	
	//$("#view_desc").click(function(){ $.fancybox.close;  })

});

</script>
	<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>

<div class="manage_page_container">


    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	


    <div class="top_link">
        <a  href='upload.php?ret_page=edit-item&&item_id=<?php echo $item_id; ?>&parent_cat_id=<?php echo $parent_cat_id; ?>&ret_cat_id=<?php echo $cat_id; ?>'>Upload new Image</a><br>
    </div>


    <div class="top_link">
        <a     href='select-image.php?ret_page=edit-item&item_id=<?php echo $item_id; ?>&parent_cat_id=<?php echo $parent_cat_id; ?>'>Select Image From Existing Images</a><br>
    </div>
    
    <div class="top_link">
        <a href='item.php?parent_cat_id=<?php echo $parent_cat_id; ?>'>back</a>
    </div>


    <div class="manage_main">

	<?php
	
	
	$add_to_title = '';

	if($item_id){
		$sql = "SELECT name 
				FROM item
				WHERE item_id = '".$item_id."'";
$result = $dbCustom->getResult($db,$sql);		$object = $result->fetch_object();
	}

	
	
        echo "<div class='manage_main_page_title'>".$page_title."  ".$add_to_title." </div>";
        $bc = $bread_crumb->output();
        echo $bc."<br />"; 




    $sql = sprintf("SELECT item_gallery.item_gallery_id
				   ,image.file_name
				   FROM item_gallery, image 
				   WHERE item_gallery.img_id = image.img_id 
				   AND item_gallery.item_id = '%u'", $item_id);
	
    $img_res = $dbCustom->getResult($db,$sql);
	;

		//echo $img_res->num_rows;
	
    $i = 1;
    while($img_row = $img_res->fetch_object()) {
		
		
    	$block = ''; 
        $block .= "<div class='img_box'>";
        $block .= "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$img_row->file_name."'   />";
    	
		if(in_array(2,$user_functions_array)){	
			$block .= "<br /><a class='inline' href='#delete'>
			delete
			
			<div class='e_sub' id='".$img_row->item_gallery_id."' style='display:none'></div> </a>";
		}
		
		
        $block .= "</div>";
        if($i % 4 == 0) $block .= "<div class='clear'></div>";
        $i++;
		echo $block;
    }
    
	?>
    
    <div class="clear"></div>

</div>
</div>

    
    <div style="display:none">
        <div id="delete" style="width:200px; height:100px;">			        
            Are you sure you want to delete this gallery image?<br /><br />
            <form name="del_img_form" action="item-gallery.php" method="post">
           		<input type="hidden" name="ret_page" value="<?php echo $ret_page;  ?>" />
           		<input type="hidden" name="cat_id" value="<?php echo $cat_id;  ?>" />
           		<input id="item_id" type="hidden" name="item_id" value="<?php echo $item_id;  ?>" />
           		<input type="hidden" name="ret_page" value="<?php echo $ret_page;  ?>" />
                <input id="del_item_gallery_id" type="hidden" name="del_item_gallery_id" />    
                <input name="del_from_gallery" type="submit" value="DELETE" />
            </form>
            
        </div>
    </div>

</body>
</html>



