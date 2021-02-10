<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');


$page ="cart";


$db = $dbCustom->getDbConnect(CART_DATABASE);
$page ="showroom";
$message = '';

$item_id =  (isset($_REQUEST['item_id'])) ? $_REQUEST['item_id'] : 0;
$cat_id =  (isset($_REQUEST['cat_id'])) ? $_REQUEST['cat_id'] : 0;


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>

function select_img_e(img_id){	
	document.getElementById("e"+img_id).checked = true;		
}


</script>
</head>

	<body>
<?php

$add_to_title = '';

if($item_id){
	$sql = "SELECT name 
			FROM item
			WHERE item_id = '".$item_id."'";
$result = $dbCustom->getResult($db,$sql);	$object = $result->fetch_object();
	
}

?>


<div class="page_title_top_spacer"></div>
<div class="page_title">
	Add Image to Gallery For <?php echo $object->name; ?> 

	<div class="top_right_link">
    <?php
		echo "<a href='item-gallery.php?item_id=".$item_id."&cat_id=".$cat_id."999'>Back</a>";
	?>		
    </div>
    
    
   	<div  class="top_link">
       	<a href='upload.php?img_width=250&img_height=240&ret_page=item-gallery-add&cat_id=<?php echo $cat_id; ?>&item_id=<?php echo $item_id; ?>'>Image Upload</a>
	</div>

    
    
    
</div>
<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>

<div class="page_container">
    
	<form name="add_to_gallery" action="item-gallery.php" method="post">


		<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
		<input type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
		<input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
                
	<?php
    $sql = "SELECT file_name, img_id 
	FROM image
	WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
    $img_res = $dbCustom->getResult($db,$sql);
	;
    $i = 1;
    while($img_row = $img_res->fetch_object()) {
    	$block = ''; 
        $block .= "<div class='img_box'>";
        $block .= "<img src='".$ste_root."/saascustuploads/cart/medium/".$img_row->file_name."' onClick='select_img_e(".$img_row->img_id.")' />";
		
		$block .= "<input id='e".$img_row->img_id."' type='checkbox' name='img_id' value='".$img_row->img_id."' />";
		
        $block .= "</div>";
        if($i % 4 == 0) $block .= "<div class='clear'></div>";
        $i++;
		echo $block;
    }
	?>
    
    	<input type="submit" name="add_to_gallery" value="Add Images" />            
	</form>
    
    
    
<div class="clear"></div>    
    
</div>

</body>
</html>



