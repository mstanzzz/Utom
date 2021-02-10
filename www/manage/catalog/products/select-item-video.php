<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Select Image";
$page_group = "select-image";

//	

$msg = '';




if(isset($_POST["del_vid_id"])){

	$video_id = $_POST["del_vid_id"];
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
		
	$sql = "DELETE FROM item_to_video 
			WHERE video_id = '".$video_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM video 
			WHERE video_id = '".$video_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
			
	$msg = "Video deleted.";
		
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

$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';
$ret_dir = (isset($_GET['ret_dir'])) ? $_GET['ret_dir'] : '';
$parent_cat_id = (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : '';
$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : '';


$url_str= $ret_page.'.php';
$url_str.= '?parent_cat_id='.$parent_cat_id;
$url_str.= '?cat_id='.$cat_id;

?>

<a href="<?php echo $url_str; ?>" class="btn" target="_top"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>


<form name="add_video"  action="<?php echo $url_str; ?>" method="post"  enctype="multipart/form-data" target="_top">

	<input type="hidden" name="selected_video" value="1">


    <table border="1" cellpadding="4">
    <tr>
    <td width="35%">Placeholder</td>
    <td width="35%">Video</td>    
    <td>Used at</td>
    <td>&nbsp;</td>
    </tr>
    
    <?php
	$db = $dbCustom->getDbConnect(CART_DATABASE);
    $sql = "SELECT video_id, youtube_id 
			FROM video
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY video_id";
$result = $dbCustom->getResult($db,$sql);	
	
	$block = "<tr>"; 
    while($row = $result->fetch_object()) {

			$block .= "<td valign='top'>";
			$block .= "<img width='240' height='240' src='http://img.youtube.com/vi/".$row->youtube_id."/0.jpg' onClick='select_img(".$row->video_id.")' >";
			$block .= "</td>";
			
			
			
			
			$block .= "<td valign='top'>";	
			$block .= "<iframe src='https://www.youtube.com/embed/".$row->youtube_id."' ";
			$block .= "width='100%' height='100%' allowfullscreen>";
			$block .= "</iframe>";
			
			$block .= "</td>";	


			$block .= "<td valign='top'>";	
			$image_is_used = 0;	

			$sql = "SELECT item.name
			FROM item_to_video, item
			WHERE item_to_video.item_id = item.item_id
			AND item_to_video.video_id = '".$row->video_id."'";
			
			$res = $dbCustom->getResult($db,$sql);
			
			while($t_row = $res->fetch_object()){
				$block .= "Product: ".$t_row->name."<br />";
				$image_is_used++;
	
			}
		
			if($image_is_used == 0){
				$block .= "Not used";
			}
		
			$block .= "</td>";
	
			$block .= "<td valign='top'>";	
			$block .= "<input id='r".$row->video_id."' type='radio' name='video_id' value='".$row->video_id."' />";
			$block .= "</td>";
	
			
	
	
			$block .= "</tr>";
			
    }
    echo $block;
    ?>
    </table>
 		
		<div class="savebar">
			<button type="submit" name="select_video" class="btn btn-success"><i class="icon-ok icon-white"></i> Submit </button>
		</div>
        
	</form>
</div>

<?php
$url_str= $ret_dir;
$url_str.= '/'.$ret_page.'.php';
$url_str.= '?parent_cat_id='.$parent_cat_id;
$url_str.= '?cat_id='.$cat_id;

?>

<a href="<?php echo $url_str; ?>" class="btn" target="_top"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>


<?php

$url_str= "select-image.php";
$url_str.= "?ret_dir=".$ret_dir;
$url_str.= "&ret_page=".$ret_page;


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

