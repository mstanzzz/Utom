<?php
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
/*****************************************

TRY THIS http://fengyuanchen.github.io/cropper/

THIS IS BETTER http://dev.vizuina.com/cropper/
-- cannot zoom in or out
-- maybe just force aspect ratio and re-size as needed
-- set min width and min height to 520 for cart images

OR
http://odyniec.net/projects/imgareaselect/

*****************************************/
if(!isset($_SESSION['new_img_id']))$_SESSION['new_img_id'] = 0;
if(!isset($_SESSION['img_id']))$_SESSION['img_id'] = 0;

if(!isset($_SESSION['img_type'])) $_SESSION['img_type'] = 'cart';

if(!isset($_SESSION['crop_1'])) $_SESSION['crop_1'] = 0;
if(!isset($_SESSION['crop_2'])) $_SESSION['crop_2'] = 0;
if(!isset($_SESSION['crop_3'])) $_SESSION['crop_3'] = 0;

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$fromfancybox = (isset($_REQUEST["fromfancybox"])) ? $_REQUEST["fromfancybox"] : 0;


if(strpos($_SESSION['img_type'], 'cart') !== false){

	//$_SESSION['img_type'] = 'cart';

	if($_SESSION['crop_1'] > 0){
	// do square
$op_b = "minWidth: 480, minHeight: 480, maxWidth: 1220, maxHeight: 1220, aspectRatio: '1:1', handles: true,"; 
	}elseif($_SESSION['crop_2'] > 0){		
	// do wide		
$op_b = "minWidth: 700, minHeight: 542, maxWidth: 1220, maxHeight: 946, aspectRatio: '800:620', handles: true,";
	}else{
	// do extra wide	
$op_b = "minWidth: 920, minHeight: 460, maxWidth: 1600, maxHeight: 800, aspectRatio: '2:1', handles: true,";		
	}

	echo $op_b;
	echo "<br />";


}elseif(strpos($_SESSION['ret_page'], 'tool-admin') !== false){

	$op_b = "minWidth: 280, minHeight: 280, maxWidth: 2000, maxHeight: 2000, aspectRatio: '1:1', handles: true,"; 

}else{

	$op_b = "minWidth: 480, minHeight: 480, maxWidth: 1020, maxHeight: 1020, aspectRatio: '1:1', handles: true,"; 

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>CropZoom</title>
<link href="../js/css/ui-lightness/jquery-ui-1.8.7.custom.css" rel="Stylesheet" type="text/css" />
<link href="../js/css/jquery.cropzoom.css" rel="Stylesheet" type="text/css" />
<link href="<?php echo $ste_root; ?>/css/manageStyle.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="jquery.imgareaselect-0.9.10/css/imgareaselect-default.css" />

<script type="text/javascript" src="jquery.imgareaselect-0.9.10/scripts/jquery.min.js"></script>
<script type="text/javascript" src="jquery.imgareaselect-0.9.10/scripts/jquery.imgareaselect.pack.js"></script>

<script type="text/javascript" src="<?php echo $ste_root;?>/js/ctg_form_validation.js"></script>

<style type="text/css">
#img_to_crop {
	-webkit-user-drag: element;
	-webkit-user-select: none;
}

.center_this_block{
	
	display:inline-block;
	
}

body{
	text-align:center;
}


</style>

<script>

$(document).ready(function () {
		
		//alert("ggg");
		
    var ias = $('#pre_cropped').imgAreaSelect({
				 
		<?php echo 	$op_b; ?>
		
		onSelectEnd: function (img, selection) {
			
			$('input[name="x1"]').val(selection.x1);
			$('input[name="y1"]').val(selection.y1);
            $('input[name="x2"]').val(selection.x2);
            $('input[name="y2"]').val(selection.y2);            
        }
		
    });
	
	
	
});

function testt(){
	alert("testttt");
}

function validate(){

	var x1 = $('input[name="x1"]').val();
	var y1 = $('input[name="y1"]').val();
	var x2 = $('input[name="x2"]').val();
	var y2 = $('input[name="y2"]').val();

	ret = 1;
	
	if(!ret){		
		alert("Please click inside the image and select a crop area");
		return false;	
	}

	alert("x1"+x1+"    y1"+y1+"     x2"+x2+"    y2"+y2);
	
	return true;
	
}


</script>

</head>
<body>


<a onClick="testt();">TESTT</a>
<BR />

<!--
<div style="height:22px; background-color:#F0F6F9; padding-top:6px;">
<h3>You must crop the image before it can be saved.</h3>
</div>
-->


<?php

if(strpos($_SESSION['ret_path'], 'cms') !== false){
	$f_path = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/full/";				
}else{
	$f_path = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/full/";
}

if($_SESSION['crop_1'] > 0){
	echo "Doing Square Crop";
}
if($_SESSION['crop_2'] > 0){
	echo "Doing Wide Crop";
}
if($_SESSION['crop_3'] > 0){
	echo "Doing Extra Wide Crop";
}





?>

<div style="margin-top:8px;">
Use the handles in the corners and the sides to enlarge the crop area. Drag the box to the area you want in the final image.
<!--
onsubmit="return validate();"
-->
<form action="crop-set.php" method="post">
  <input type="hidden" name="x1" value="" />
  <input type="hidden" name="y1" value="" />
  <input type="hidden" name="x2" value="" />
  <input type="hidden" name="y2" value="" />
  
  <input type="hidden" name="orig_img_path" 
  value="<?php echo $f_path; ?>" />
  
  <input type="hidden" name="orig_img_fn" value="<?php echo $_SESSION['pre_cropped_fn']; ?>" />
  <input type="submit" name="submit" value=">>>>> Submit <<<<<" />

</form>
</div>

<div style="background:#FFF; margin-top:6px;">

<?php

echo " 
<div class='original'>
<img id='pre_cropped' src='".$f_path.$_SESSION['pre_cropped_fn']."' />
</div>
";
						          
$ret_dest = $_SESSION['ret_dir'].'/'.$_SESSION['ret_page'].'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];

if(isset($_SESSION['ret_path'])){
	if($_SESSION['ret_path'] != ''){
		$ret_dest = $_SESSION['ret_path'].'/'.$_SESSION['ret_page'].'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];
	}
}


echo "<br />";
echo "ret_dir  ".$_SESSION["ret_dir"];
echo "<br />";
echo "ret_page  ".$_SESSION["ret_page"];
echo "<br />";
echo "img_type  ".$_SESSION["img_type"];
echo "<br />";
//echo $ret_dest; 
echo "<br />";

?>
<a href="<?php echo $ret_dest; ?>"> Cancel </a>
           
           
 </div>
</body>
</html>
