<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
if(isset($_GET['cart_crop_n'])){
	//echo "cart_crop_n:  ".$_GET['cart_crop_n'];
	//exit;
}

$fn = (isset($_GET['fn']))? $_GET['fn'] : 'none';

if(!isset($_SESSION['pre_cropped_fn'])){
	$_SESSION['pre_cropped_fn'] = $fn;
}

if($_SESSION['pre_cropped_fn'] == ''){
	$_SESSION['pre_cropped_fn'] = $fn;	
}

//echo "pre_cropped_fn ".$_SESSION['pre_cropped_fn'];
//echo "<br />";
//echo "<br />";

/*****************************************

TRY THIS http://fengyuanchen.github.io/cropper/

THIS IS BETTER http://dev.vizuina.com/cropper/
-- cannot zoom in or out
-- maybe just force aspect ratio and re-size as needed
-- set min width and min height to 520 for cart images

OR
http://odyniec.net/projects/imgareaselect/

*****************************************/
if(!isset($_SESSION['crop_n'])) $_SESSION['crop_n'] = 1;
if(!isset($_SESSION['new_img_id']))$_SESSION['new_img_id'] = 0;
if(!isset($_SESSION['img_id']))$_SESSION['img_id'] = 0;
if(!isset($_SESSION['img_type'])) $_SESSION['img_type'] = 'cart';


$fromfancybox = (isset($_REQUEST["fromfancybox"])) ? $_REQUEST["fromfancybox"] : 0;

if(strpos($_SESSION['img_type'], 'cart') !== false){
	// do square
	if($_SESSION['crop_n'] == 1){
$op_b = "minWidth: 380, minHeight: 380, maxWidth: 1220, maxHeight: 1220, aspectRatio: '1:1', handles: true,"; 	
	}
	// do wide		
	if($_SESSION['crop_n'] == 2){
$op_b = "minWidth: 477, minHeight: 336, maxWidth: 1220, maxHeight: 946, aspectRatio: '800:620', handles: true,";
	}
	// do extra wide	
	if($_SESSION['crop_n'] > 2){
$op_b = "minWidth: 600, minHeight: 300, maxWidth: 1600, maxHeight: 800, aspectRatio: '2:1', handles: true,";		
	}

	//echo $op_b;
	//echo "<br />";

}elseif(strpos($_SESSION['ret_page'], 'tool-admin') !== false){
	$op_b = "minWidth: 280, minHeight: 280, maxWidth: 2000, maxHeight: 2000, aspectRatio: '1:1', handles: true,"; 
}else{
	$op_b = "minWidth: 480, minHeight: 480, maxWidth: 1020, maxHeight: 1020, aspectRatio: '1:1', handles: true,"; 
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
<link href="./js/css/ui-lightness/jquery-ui-1.8.7.custom.css" rel="Stylesheet" type="text/css" />
<link href="./js/css/jquery.cropzoom.css" rel="Stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="jquery.imgareaselect-0.9.10/css/imgareaselect-default.css" />
<script type="text/javascript" src="jquery.imgareaselect-0.9.10/scripts/jquery.min.js"></script>
<script type="text/javascript" src="jquery.imgareaselect-0.9.10/scripts/jquery.imgareaselect.pack.js"></script>


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
<!--
<div style="height:22px; background-color:#F0F6F9; padding-top:6px;">
<h3>You must crop the image before it can be saved.</h3>
</div>
-->
<?php
/*
if(!isset($_SESSION['ret_path'])) $_SESSION['ret_path'] = 'catalog/categories';
if($_SESSION['ret_path'] == '') $_SESSION['ret_path'] = 'catalog/categories';
if(!isset($_SESSION['ret_page'])) $_SESSION['ret_path'] = 'top-category.php';
if($_SESSION['ret_page'] == '') $_SESSION['ret_path'] = 'top-category.php';
echo "<br />";
echo "_SESSION['img_type ".$_SESSION['img_type'];
echo "<br />";
echo "_SESSION['ret_page ".$_SESSION['ret_page'];
echo "<br />";
echo "_SESSION['ret_path ".$_SESSION['ret_path'];
echo "<br />";
echo "_SESSION['ret_dir ".$_SESSION['ret_dir'];
echo "<br />";
echo "_SESSION['crop_n ".$_SESSION['crop_n'];
echo "<br />";
echo "<br />";
echo "<br />";
*/
					          
//$ret_dest = $site_root."manage/".$_SESSION['ret_dir'].'/'.$_SESSION['ret_page'].'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];

if($_SESSION['ret_path'] != ""){
$ret_dest = $_SESSION['ret_path'].'/'.$_SESSION['ret_page'].'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];
}else{
$ret_dest = $_SESSION['ret_dir'].'/'.$_SESSION['ret_page'].'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];	
}



if(strpos($_SESSION['ret_path'], 'cms') !== false){
	$f_path = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/full/";				
}else{
	$f_path = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/full/";
}

if($_SESSION['crop_n'] == 1){
	echo "Doing Square Crop";
}
if($_SESSION['crop_n'] == 2){
	echo "Doing Wide Crop";
}
if($_SESSION['crop_n'] > 2){
	echo "Doing Extra Wide Crop";
}
?>

<div style="margin-top:8px;">

<a style="margin-right:30px;" class="btn btn-info"  href="<?php echo $ret_dest; ?>"> Cancel </a>

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
  <input type="submit" name="submit" class="btn btn-primary" value=">>>>> Submit <<<<<" />

</form>
</div>


<div style="background:#FFF; margin-top:6px;">

<?php


//echo "<br />";
//echo $f_path.$_SESSION['pre_cropped_fn'];
//echo "<br />";


echo " 
<div class='original'>
<img id='pre_cropped' src='".$f_path.$_SESSION['pre_cropped_fn']."' />
</div>
";

if(isset($_SESSION['ret_path'])){
	if($_SESSION['ret_path'] != ''){
		$ret_dest = $ste_root."manage/".$_SESSION['ret_path'].'/'.$_SESSION['ret_page'].'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];
		$ret_dest = preg_replace('/(\/+)/','/',$ret_dest);

	
	}
}

/*
echo "<br />";
echo "ret_dir  ".$_SESSION["ret_dir"];
echo "<br />";
echo "ret_page  ".$_SESSION["ret_page"];
echo "<br />";
echo "img_type  ".$_SESSION["img_type"];
echo "<br />";
echo "<br />";

*/


echo "<br />";
echo "<br />";
echo "ret_dest:  ".$ret_dest;
echo "<br />";
echo "<br />";

?>
<a class="btn btn-info"  href="<?php echo $ret_dest; ?>"> Cancel </a>
           
           
 </div>
</body>
</html>




