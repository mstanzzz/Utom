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
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');
ini_set('max_execution_time', 300);

unset($_SESSION['pre_cropped_fn']);
//clearstatcache();

$fromfancybox = (isset($_REQUEST["fromfancybox"])) ? $_REQUEST["fromfancybox"] : 0;
//$_SESSION["fromfancybox"] = $fromfancybox;
	if(isset($_GET['specs_content_id'])) $_SESSION['specs_content_id'] = $_GET['specs_content_id'];

// finish
	if(isset($_GET['finish_name']))	$_SESSION['tmp_vars']['finish_name'] = $_GET['finish_name'];
	if(isset($_GET['type_id']))	$_SESSION['tmp_vars']['type_id'] = $_GET['type_id'];
	if(isset($_GET['tool_color']))	$_SESSION['tmp_vars']['tool_color'] = $_GET['tool_color'];
	if(isset($_GET['tool_alpha']))	$_SESSION['tmp_vars']['tool_alpha'] = $_GET['tool_alpha'];
	//if(isset($_GET['tool_image']))	$_SESSION['tmp_vars']['tool_image'] = $_GET['tool_image'];

// constructed parts
	if(isset($_GET['part_name']))	$_SESSION['tmp_vars']['part_name'] = $_GET['part_name'];
	if(isset($_GET['part_image']))	$_SESSION['tmp_vars']['part_image'] = $_GET['part_image'];
	if(isset($_GET['thumb_image']))	$_SESSION['tmp_vars']['thumb_image'] = $_GET['thumb_image'];
	if(isset($_GET['part_sku']))	$_SESSION['tmp_vars']['part_sku'] = $_GET['part_sku'];
	if(isset($_GET['part_number']))	$_SESSION['tmp_vars']['part_number'] = $_GET['part_number'];
	if(isset($_GET['part_weight']))	$_SESSION['tmp_vars']['part_weight'] = $_GET['part_weight'];
	if(isset($_GET['part_type_id']))	$_SESSION['tmp_vars']['part_type_id'] = $_GET['part_type_id'];
	if(isset($_GET['price_schema_id']))	$_SESSION['tmp_vars']['price_schema_id'] = $_GET['price_schema_id'];
	if(isset($_GET['qty_calc_id']))	$_SESSION['tmp_vars']['qty_calc_id'] = $_GET['qty_calc_id'];
	if(isset($_GET['qty_schema_id']))	$_SESSION['tmp_vars']['qty_schema_id'] = $_GET['qty_schema_id'];
	if(isset($_GET['description']))	$_SESSION['tmp_vars']['description'] = $_GET['description'];
	if(isset($_GET['width']))	$_SESSION['tmp_vars']['width'] = $_GET['width'];
	if(isset($_GET['height']))	$_SESSION['tmp_vars']['height'] = $_GET['height'];
	if(isset($_GET['depth']))	$_SESSION['tmp_vars']['depth'] = $_GET['depth'];
	if(isset($_GET['width_offset']))	$_SESSION['tmp_vars']['width_offset'] = $_GET['width_offset'];
	if(isset($_GET['height_offset']))	$_SESSION['tmp_vars']['height_offset'] = $_GET['height_offset'];
	if(isset($_GET['depth_offset']))	$_SESSION['tmp_vars']['depth_offset'] = $_GET['depth_offset'];

// Materials
	if(isset($_GET['material_name']))	$_SESSION['tmp_vars']['material_name'] = $_GET['material_name'];
	if(isset($_GET['brand_id']))	$_SESSION['tmp_vars']['brand_id'] = $_GET['brand_id'];
	if(isset($_GET['vendor_id']))	$_SESSION['tmp_vars']['vendor_id'] = $_GET['vendor_id'];
	if(isset($_GET['product_num']))	$_SESSION['tmp_vars']['product_num'] = $_GET['product_num'];
	if(isset($_GET['core_id']))	$_SESSION['tmp_vars']['core_id'] = $_GET['core_id'];
	if(isset($_GET['texture_id']))	$_SESSION['tmp_vars']['texture_id'] = $_GET['texture_id'];
	if(isset($_GET['green_id']))	$_SESSION['tmp_vars']['green_id'] = $_GET['green_id'];
	if(isset($_GET['material_weight_unit']))	$_SESSION['tmp_vars']['material_weight_unit'] = $_GET['material_weight_unit'];
	if(isset($_GET['material_width']))	$_SESSION['tmp_vars']['material_width'] = $_GET['material_width'];
	if(isset($_GET['material_thickness']))	$_SESSION['tmp_vars']['material_thickness'] = $_GET['material_thickness'];
	if(isset($_GET['material_length']))	$_SESSION['tmp_vars']['material_length'] = $_GET['material_length'];
	if(isset($_GET['RTF']))	$_SESSION['tmp_vars']['RTF'] = $_GET['RTF'];
	if(isset($_GET['HPL']))	$_SESSION['tmp_vars']['HPL'] = $_GET['HPL'];
	if(isset($_GET['hanging_bracket_cover_color_id']))	$_SESSION['tmp_vars']['hanging_bracket_cover_color_id'] = $_GET['hanging_bracket_cover_color_id'];
	if(isset($_GET['rail_cover_color_id']))	$_SESSION['tmp_vars']['rail_cover_color_id'] = $_GET['rail_cover_color_id'];
	if(isset($_GET['kd_fitting_color_id']))	$_SESSION['tmp_vars']['kd_fitting_color_id'] = $_GET['kd_fitting_color_id'];
	if(isset($_GET['material_stocked']))	$_SESSION['tmp_vars']['material_stocked'] = $_GET['material_stocked'];
	if(isset($_GET['stain_id']))	$_SESSION['tmp_vars']['stain_id'] = $_GET['stain_id'];
	if(isset($_GET['tier_id']))	$_SESSION['tmp_vars']['tier_id'] = $_GET['tier_id'];
	if(isset($_GET['collection_id']))	$_SESSION['tmp_vars']['collection_id'] = $_GET['collection_id'];
	if(isset($_GET['edge_banding_id']))	$_SESSION['tmp_vars']['edge_banding_id'] = $_GET['edge_banding_id'];

// Section Panels
	if(isset($_GET['panel_name']))	$_SESSION['tmp_vars']['panel_name'] = $_GET['panel_name'];
	if(isset($_GET['panel_sku']))	$_SESSION['tmp_vars']['panel_sku'] = $_GET['panel_sku'];
	if(isset($_GET['panel_number']))	$_SESSION['tmp_vars']['panel_number'] = $_GET['panel_number'];
	if(isset($_GET['panel_weight']))	$_SESSION['tmp_vars']['panel_weight'] = $_GET['panel_weight'];
	if(isset($_GET['material_id']))	$_SESSION['tmp_vars']['material_id'] = $_GET['material_id'];
	if(isset($_GET['dim_x']))	$_SESSION['tmp_vars']['dim_x'] = $_GET['dim_x'];
	if(isset($_GET['dim_y']))	$_SESSION['tmp_vars']['dim_y'] = $_GET['dim_y'];
	if(isset($_GET['dim_z']))	$_SESSION['tmp_vars']['dim_z'] = $_GET['dim_z'];
	if(isset($_GET['panel_brand']))	$_SESSION['tmp_vars']['panel_brand'] = $_GET['panel_brand'];
	if(isset($_GET['price_unit']))	$_SESSION['tmp_vars']['price_unit'] = $_GET['price_unit'];
	if(isset($_GET['qty_unit']))	$_SESSION['tmp_vars']['qty_unit'] = $_GET['qty_unit'];

// Unit
	if(isset($_GET['unit_name']))	$_SESSION['tmp_vars']['unit_name'] = $_GET['unit_name'];
	if(isset($_GET['unit_sku']))	$_SESSION['tmp_vars']['unit_sku'] = $_GET['unit_sku'];
	if(isset($_GET['unit_number']))	$_SESSION['tmp_vars']['unit_number'] = $_GET['unit_number'];
	if(isset($_GET['qtyCalcID']))	$_SESSION['tmp_vars']['qtyCalcID'] = $_GET['qtyCalcID'];
	if(isset($_GET['unit_weight']))	$_SESSION['tmp_vars']['unit_weight'] = $_GET['unit_weight'];

// Component
	if(isset($_GET['component_name']))	$_SESSION['tmp_vars']['component_name'] = $_GET['component_name'];
	if(isset($_GET['component_sku']))	$_SESSION['tmp_vars']['component_sku'] = $_GET['component_sku'];
	if(isset($_GET['component_number']))	$_SESSION['tmp_vars']['component_number'] = $_GET['component_number'];
	if(isset($_GET['component_weight']))	$_SESSION['tmp_vars']['component_weight'] = $_GET['component_weight'];
	if(isset($_GET['system_hole_occupancy']))	$_SESSION['tmp_vars']['system_hole_occupancy'] = $_GET['system_hole_occupancy'];
	if(isset($_GET['system_hole_increment']))	$_SESSION['tmp_vars']['system_hole_increment'] = $_GET['system_hole_increment'];
	if(isset($_GET['system_hole_offset']))	$_SESSION['tmp_vars']['system_hole_offset'] = $_GET['system_hole_offset'];
	if(isset($_GET['system_hole_padding_top']))	$_SESSION['tmp_vars']['system_hole_padding_top'] = $_GET['system_hole_padding_top'];
	if(isset($_GET['allow_custom_width']))	$_SESSION['tmp_vars']['allow_custom_width'] = $_GET['allow_custom_width'];
	if(isset($_GET['width_constraints_id']))	$_SESSION['tmp_vars']['width_constraints_id'] = $_GET['width_constraints_id'];


if(isset($_GET['part_id'])) $_SESSION['part_id'] = $_GET['part_id']; 
if(isset($_GET['material_id'])) $_SESSION['material_id'] = $_GET['material_id']; 
if(isset($_GET['panel_id'])) $_SESSION['panel_id'] = $_GET['panel_id']; 
if(isset($_GET['component_id'])) $_SESSION['component_id'] = $_GET['component_id']; 
if(isset($_GET['ret_modal'])) $_SESSION['ret_modal'] = $_GET['ret_modal']; 
if(isset($_GET['parent_cat_id'])) $_SESSION['parent_cat_id'] = $_GET['parent_cat_id']; 
if(isset($_GET['cat_id'])) $_SESSION['cat_id'] = $_GET['cat_id']; 
if(isset($_GET['banner_id'])) $_SESSION['banner_id'] = $_GET['banner_id']; 
if(isset($_GET['action'])) $_SESSION['action'] = $_GET['action']; 

if(!isset($_SESSION['material_id'])) $_SESSION['material_id'] = 0;
if(!isset($_SESSION['ret_modal'])) $_SESSION['ret_modal'] = '';
if(!isset($_SESSION['parent_cat_id'])) $_SESSION['parent_cat_id'] = 0;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = 0;
if(!isset($_SESSION['banner_id'])) $_SESSION['banner_id'] = 0;
if(!isset($_SESSION['action'])) $_SESSION['action'] = '';

if(isset($_GET['img_type'])) $_SESSION['img_type'] = $_GET['img_type']; 
if(isset($_GET['ret_page'])) $_SESSION['ret_page'] = $_GET['ret_page']; 
if(isset($_GET['ret_dir'])) $_SESSION['ret_dir'] = $_GET['ret_dir'];
if(isset($_GET['ret_path'])) $_SESSION['ret_path'] = $_GET['ret_path']; 
if(isset($_GET['crop_n'])) $_SESSION['crop_n'] = $_GET['crop_n']; 


if(isset($_GET['spec_id'])) $_SESSION['spec_id'] = $_GET['spec_id']; 
//echo $_SESSION['spec_id'];

if(!isset($_SESSION['img_type'])) $_SESSION['img_type'] = '';
if(!isset($_SESSION['ret_page'])) $_SESSION['ret_page'] = '';
if(!isset($_SESSION['ret_dir'])) $_SESSION['ret_dir'] = '';
if(!isset($_SESSION['ret_path'])) $_SESSION['ret_path'] = '';
if(!isset($_SESSION['crop_n'])) $_SESSION['crop_n'] = 0;

if(!isset($_SESSION['spec_id'])) $_SESSION['spec_id'] = 0;

$msg = '';

function img_resize($cur_dir, $cur_file, $newwidth, $output_dir, $stretch = 0)
{
	if(!file_exists($output_dir)) {
		mkdir($output_dir);         
	}	
	//$olddir = getcwd();
	$dir = opendir($cur_dir);
	$format='';
	
	if(preg_match("/.jpg/i", $cur_file)){
         $format = 'image/jpeg';
	}
	if(preg_match("/.gif/i", $cur_file)){
		$format = 'image/gif';
	}
	
	if(preg_match("/.png/i", $cur_file)){
		$format = 'image/png';
	}
			
	if($format!=''){	
		if($format == "image/png"){
			$source = imagecreatefrompng($cur_dir.$cur_file);	
		}elseif($format == "image/gif"){
			$source = imagecreatefromgif($cur_dir.$cur_file);		
		}else{

			$source = imagecreatefromjpeg($cur_dir.$cur_file);
		}
	
		list($src_w, $src_h) = getimagesize($cur_dir.$cur_file);

		if($src_w > $newwidth || $stretch == 1){
						
			$newheight=$src_h*$newwidth/$src_w;
			$dst_img = imagecreatetruecolor($newwidth,$newheight);
			$src_image = imagecreatefromjpeg($cur_dir.$cur_file);
			imagecopyresampled($dst_img, $src_image, 0, 0, 0, 0, $newwidth, $newheight, $src_w, $src_h);
			imagejpeg($dst_img, $output_dir.$cur_file, 100);
			imagedestroy($src_image); 
			
			
		}else{
			copy($cur_dir.$cur_file, $output_dir.$cur_file);
		}
	}
}

if(isset($_FILES['uploadedfile'])){
		
	include($real_root.'/includes/class.upload.php');	
	$handle = new Upload($_FILES['uploadedfile']);
	$img_name = '';
	if ($handle->uploaded) {
		// this works but may not get used
		// add watermark
		//$handle->image_watermark = 'watermark/water.png';
		//$handle->image_watermark_position = 'TL';
		//$handle->image_watermark_x = 5;
		//$handle->image_watermark_y = 5;
		//echo "<img src='".$r_path."water.png'>";			
		//exit;
		$handle->image_resize 	= false;
		$handle->file_overwrite	= false;
		$ext  = pathinfo($_FILES['uploadedfile']['name'], PATHINFO_EXTENSION);
		
		//if($ext != 'png' && $ext != 'gif'){
			$handle->image_convert = "jpg";		
			$handle->jpeg_quality  = 100;
		//}

		$dir_dest = "../saascustuploads/".$_SESSION['profile_account_id']."/tmp/pre-crop/";

		$handle->Process($dir_dest);

		if ($handle->processed) {
				
			$msg .= "Upload Successful <br 	/>";
			
			$img_name = $handle->file_dst_name;

			$_SESSION['pre_cropped_fn'] = $img_name;
			
			if(strpos($_SESSION['ret_path'], 'cms') !== false){
				$r_path = "../saascustuploads/".$_SESSION['profile_account_id']."/cms/full/";	
			}else{
				$r_path = "../saascustuploads/".$_SESSION['profile_account_id']."/cart/full/";
			}
		
			//($cur_dir, $cur_file, $newwidth, $output_dir, $stretch = 0)
			
			if(strpos($_SESSION['img_type'], 'hero') !== false){
				img_resize($dir_dest, $img_name, 1920, $r_path);				
			}else{			
				img_resize($dir_dest, $img_name, 1024, $r_path);
			}
			
		
		}else{	
			$msg = "  Error: " . $handle->error;        
		}
		$handle->clean();
		
	} else {
		$msg = "  Error: " . $handle->error;        
	}
	$_SESSION['msg'] = $msg;
	//echo $_SESSION['pre_cropped_fn'];
	//exit;
	
	$header_str = "Location: crop-tool.php?fn=".$_SESSION['pre_cropped_fn'];
	//$header_str .= "?fromfancybox=".$fromfancybox;
	header($header_str);

	//echo "<a href='crop-tool.php'>Continue to Crop Tool</a>";

}
	
require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script language="JavaScript">
/*
var submitted = false;
function doSubmit() {
	if (!submitted) {
		submitted = true;
		ProgressImg = document.getElementById('inprogress_img');
		document.getElementById("inprogress").style.visibility = "visible";
		setTimeout("ProgressImg.src = ProgressImg.src",1000);
		return true;
	}else{
		return false;
	}
}
*/

function check_file(){
	
	var file = $("#uploadedfile").val();	
	if(file == ""){
		alert("Please select a file to upload");
		document.getElementById('inprogress').style.visibility='visible';
		return false;	
	}
	return true;
}

function location_fb(url){
	<?php if($fromfancybox){ ?>
	location.href = url;
	<?php }else{ ?>
	if (window.top.location != window.location) {
		self.parent.location.href=url;
	}
	<?php } ?>
	location.href = url;
}

</script>
</head>
<body>
<center>
<div class="manage_page_container">
<br />
<br />
<form action="upload-pre-crop.php" method="post" enctype="multipart/form-data" 
	onSubmit="return check_file()" target="_self">
	
	<input type="hidden" name="fromfancybox" value="<?php echo $fromfancybox; ?>">
	
	<div class='lightboxcontent'>
	<fieldset>
	<p style="color:blue; font-size:22px;">Image File Upload </p>
	<label>Select a File</label>
	<input type="file" name="uploadedfile" id="uploadedfile">
	<br />
	</fieldset>
	<p style="visibility:hidden" id="inprogress"> 
	<img id="inprogress_img" src="../images/progress.gif"> Please Wait... </p>
	<?php 
$ret_dest = SITEROOT."/manage/".$_SESSION['ret_dir'].'/'.$_SESSION['ret_page'].'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];
	if(isset($_SESSION['ret_path'])){
		if($_SESSION['ret_path'] != ''){
$ret_dest = SITEROOT."/manage/".$_SESSION['ret_path'].'/'.$_SESSION['ret_page'].'.php?is_new_img=1&cat_id='.$_SESSION['cat_id'].'&img_type'.$_SESSION['img_type'];
		}
	}
	?>
	<input type="button" value="Cancel" class="btn btn-large" style="margin-right:30px;" 
	onClick="location_fb('<?php echo $ret_dest; ?>');" />
	<button type="submit" name="submit" class="btn btn-success btn-large" 
	onClick="document.getElementById('inprogress').style.visibility='visible'"><p style="margin:10px;"> Upload </p></button>
	</form>
	<br />
	<br />
	<br />
	<br />
	<br />
</div>
</center>
<?php
/*
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
echo "img_type ".$_SESSION['img_type'];
echo "<br />";
echo "spec_id ".$_SESSION['spec_id'];
*/
?>

</body>
</html>




