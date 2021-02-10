<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$msg = '';
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

if(isset($_FILES['uploadedfile'])){
	
	include($_SERVER['DOCUMENT_ROOT'].'/includes/class.upload.php');	

	$ret_page = $_REQUEST['ret_page'];
	$ret_dir = $_REQUEST['ret_dir'];
	$ret_cat_id = $_REQUEST['ret_cat_id'];
	$action  = $_REQUEST['action'];
	$slug = $_REQUEST['slug'];
	$banner_id = (isset($_REQUEST['banner_id'])) ? $_REQUEST['banner_id'] : 0;
	$page_id = (isset($_REQUEST['page_id'])) ? $_REQUEST['page_id'] : 0;
	$linktype = (isset($_REQUEST['linktype'])) ? $_REQUEST['linktype'] : 1;	
	
	$img_width = (isset($_REQUEST['img_width'])) ? $_REQUEST['img_width'] : 0;
	$img_height = (isset($_REQUEST['img_height'])) ? $_REQUEST['img_height'] : 0;
	
	$img_max_width = (isset($_REQUEST['img_max_width'])) ? $_REQUEST['img_max_width'] : 0;
		
	if($slug == "logo"){
		$dir_dest = "../../saascustuploads/".$_SESSION['profile_account_id']."/logo";
	}elseif($slug == "video"){
		$dir_dest = "../../saascustuploads/".$_SESSION['profile_account_id']."/video";		
	}else{
		$dir_dest = "../../saascustuploads/".$_SESSION['profile_account_id']."/cms";	
	}
	
	$this_uploaded_file_id = 0;
	$this_img_id = 0;
	
	$handle = new Upload($_FILES['uploadedfile']);
	
	//echo $handle->uploaded; 
	//exit;

	if ($handle->uploaded) {
		
		//if(!$slug == "logo"){
			
			if($img_height > 0 && $img_width > 0){
	
				$handle->image_x           = $img_width;
				$handle->image_y           = $img_height;		
				$handle->image_resize            = true;
	
				if(strrpos($ret_page,"banner") > 0){						
					$handle->image_ratio_crop  = true;
				}
			
			}elseif($img_height == 0 && $img_width > 0){
					$handle->image_resize            = true;
					$handle->image_ratio_y           = true;		
					$handle->image_x                 = $img_width;			
	
			}elseif($img_height > 0 && $img_width == 0){
					$handle->image_resize            = true;
					$handle->image_ratio_x           = true;		
					$handle->image_y                 = $img_height;			
						
			}else{
				
				if($img_max_width > 0 && $handle->image_src_x > $img_max_width){
					$handle->image_resize            = true;
					$handle->image_ratio_y           = true;		
					$handle->image_x                 = $img_max_width;								
				}else{
					$handle->image_resize            = false;
					
				}
				
			}
		//}else{
			//$handle->image_resize            = false;			
		//}
		
		/*	
		if($slug == "logo"){
			$ext = end(explode(".",$_FILES['uploadedfile']['name']));
			if($ext != 'png' && $ext != 'gif'){
				$handle->image_convert = "jpg";		
				$handle->jpeg_quality  = 100;
			}
		}
		*/
			
		// copy the uploaded file from its temporary location to the wanted location
		$handle->Process($dir_dest);

		// check if everything went OK
		if ($handle->processed) {
			
			$msg = "Upload Successful";


			//$img_name = $handle->file_src_name;
			$img_name = $handle->file_dst_name;
			
			if($ret_page == 'downloads-page' && $action == 'download'){
				
				$sql = sprintf("INSERT INTO download (file_name, slug, profile_account_id) VALUES ('%s','%s','%u')", $img_name, $slug, $_SESSION['profile_account_id']);
				$r = $dbCustom->getResult($db,$sql);
				
				$this_img_id = $db->insert_id; 		

			}elseif($ret_page == "edit-installation-link" || $ret_page == "add-installation-link"){
				
				$sql = "INSERT INTO uploaded_file 
						(uploaded_file_name)
						VALUES
						('".$img_name."')";
				$r = $dbCustom->getResult($db,$sql);
				
				$this_uploaded_file_id = $db->insert_id; 

			}elseif($ret_page == "video-list"){

				$sql = sprintf("INSERT INTO video (file_name, profile_account_id) 
						VALUES ('%s','%u')", $img_name, $_SESSION['profile_account_id']);
				
				$r = $dbCustom->getResult($db,$sql);
				
				$this_img_id = $db->insert_id; 	

			}elseif($ret_page == "we-design-fax" && $action == 'download'){

				$sql = "INSERT INTO uploaded_file 
						(uploaded_file_name)
						VALUES
						('".$img_name."')";
				$r = $dbCustom->getResult($db,$sql);				
					
				$this_uploaded_file_id = $db->insert_id; 

			}else{
				
				
				
			$sql = sprintf("INSERT INTO image 
			(file_name, slug, profile_account_id) 
			VALUES 
			('%s','%s','%u')",
			$img_name, $slug, $_SESSION['profile_account_id']);				





				echo "img_name ".$img_name;
				echo "<br />";
				echo "slug ".$slug;
				exit;
	

	
//$r = $dbCustom->getResult($db,$sql);
//$this_img_id = $db->insert_id; 	
				
			}
			
		}else{	
			$msg = "  Error: " . $handle->error;        
		}
				
		// delete the temporary files
		$handle->clean();
	} else {
		$msg = "  Error: " . $handle->error;        
	}
	
	if($ret_page != "we-design-fax"){ 
		$_SESSION['img_id'] = $this_img_id;
	}
	
	$header_str = "Location: ".$ret_dir."/".$ret_page.".php";
	$header_str .= "?ret_cat_id=".$ret_cat_id;	
	$header_str .= "&new_img_id=".$this_img_id;
	$header_str .= "&new_uploaded_file_id=".$this_uploaded_file_id;
	$header_str .= "&action=".$action;
	$header_str .= "&banner_id=".$banner_id;
	$header_str .= "&page_id=".$page_id;
	$header_str .= "&linktype=".$linktype;
		
	$header_str .= "&msg=".$msg;



	

	if($slug == "logo"){
		
		$progress->completeStep("logo" ,$_SESSION['profile_account_id']);
		
		echo("<script language='javascript'>");
		echo("top.location.href = 'logo/logo.php?new_img_id=".$this_img_id."&msg=".$msg."';");
		echo("</script>");
	
	}elseif($ret_page == 'video-list'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'video/video-list.php?new_img_id=".$this_img_id."&msg=".$msg."';");
		echo("</script>");
	
	}elseif($ret_page == 'we-design-fax'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/we-design-fax.php?new_img_id=".$this_img_id."&new_uploaded_file_id=".$this_uploaded_file_id."&msg=".$msg."';");
		echo("</script>");

	}elseif($ret_page == 'faq'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/faq.php?msg=".$msg."';");
		echo("</script>");

	}elseif($ret_page == 'policy'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/policy.php?msg=".$msg."';");
		echo("</script>");
	}elseif($ret_page == 'process'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/process.php?msg=".$msg."';");
		echo("</script>");

	}elseif($ret_page == 'testimonial-page'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/testimonial-page.php?msg=".$msg."';");
		echo("</script>");

	}elseif($ret_page == 'downloads-page'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/downloads-page.php?msg=".$msg."';");
		echo("</script>");

	}elseif($ret_page == 'in-home-consultation'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/in-home-consultation.php?msg=".$msg."';");
		echo("</script>");

	}elseif($ret_page == 'guides-tips'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/guides-tips.php?msg=".$msg."';");
		echo("</script>");
	
	}elseif($ret_page == 'contact-us'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/contact-us.php?msg=".$msg."';");
		echo("</script>");

	}elseif($ret_page == 'about-us'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/about-us.php?msg=".$msg."';");
		echo("</script>");

	}elseif($ret_page == 'shipping-term'){
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/shipping-term.php?msg=".$msg."';");
		echo("</script>");


	}elseif(strpos($ret_page, 'discount') !== false){	
		echo("<script language='javascript'>");
		echo("top.location.href = 'pages/".$ret_page.".php?msg=".$msg."';");
		echo("</script>");


		
	}else{
		header($header_str);
		
	}

	
//echo $header_str;
//exit;


}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


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
		
	}else {
		return false;
	}
}
*/

</script>
</head>

<body class="lightbox">
<?php 
//require_once("../admin-includes/manage-header.php");

$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : 'start';
$ret_dir =  (isset($_REQUEST['ret_dir'])) ? $_REQUEST['ret_dir'] : 'pages';

$img_width =  (isset($_REQUEST['img_width'])) ? $_REQUEST['img_width'] : '';
$img_height =  (isset($_REQUEST['img_height'])) ? $_REQUEST['img_height'] : '';

$img_max_width =  (isset($_REQUEST['img_max_width'])) ? $_REQUEST['img_max_width'] : '';

$ret_cat_id =  (isset($_REQUEST['ret_cat_id'])) ? $_REQUEST['ret_cat_id'] : '';
$banner_id = (isset($_REQUEST['banner_id'])) ? $_REQUEST['banner_id'] : 0;
$page_id = (isset($_REQUEST['page_id'])) ? $_REQUEST['page_id'] : 0;

$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
$linktype = (isset($_REQUEST['linktype'])) ? $_REQUEST['linktype'] : 1;

$fromfancybox = (isset($_REQUEST['fromfancybox'])) ? $_REQUEST['fromfancybox'] : 0;


$slug = '';	
if($ret_page == 'logo') $slug = 'logo';
if($ret_page == 'video-list') $slug = 'video';
if($ret_page == 'home') $slug = 'home';
if($ret_page == 'policy') $slug = 'policy';
if($ret_page == 'process') $slug = 'process';
if($ret_page == 'shipping-term') $slug = 'shipping-term';
if($ret_page == 'shipping-time') $slug = 'shipping-time';
if($ret_page == 'discount') $slug = 'discount';
if($ret_page == 'discount-how') $slug = 'discount';
if($ret_page == 'about-us') $slug = 'about-us';
if($ret_page == 'testimonial-page') $slug = 'testimonial-page';
if($ret_page == 'showroom-sub-category') $slug = 'showroom-sub-category';
if($ret_page == 'showroom-item') $slug = 'showroom-item';
if($ret_page == 'guides-tips') $slug = 'guides-tips';
if($ret_page == 'showroom-cat-item') $slug = 'showroom-item';
if($ret_page == 'showroom-category') $slug = 'showroom-category';
if($ret_page == 'downloads-page') $slug = 'downloads-page';
if($ret_page == 'add-home-banner') $slug = 'add-home-banner';
if($ret_page == 'edit-installation-link') $slug = 'installation-link';
if($ret_page == 'add-installation-link') $slug = 'installation-link';
if($ret_page == 'testimonial-page') $slug = 'testimonial-page';
if($ret_page == 'downloads-page') $slug = 'downloads-page';
if($ret_page == 'in-home-consultation') $slug = 'in-home-consultation';
if($ret_page == 'contact-us') $slug = 'contact-us';

//echo $slug;

if($ret_page == 'faq') $slug = 'faq';

?>
<div class="lightboxholder">
	<form action="upload.php" method="post" enctype="multipart/form-data" >
    
    <?php //if($fromfancybox){ echo "target='_self'"; }else{ echo "target='_top'"; } ?>
		
        <div class="lightboxcontent">
			<h2>Upload File</h2>

			<input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
			<input type="hidden" name="ret_dir" value="<?php echo $ret_dir; ?>" />
			<input type="hidden" name="slug" value="<?php echo $slug; ?>" />
			<input type="hidden" name="page_id" value="<?php echo $page_id; ?>" />
			<input type="hidden" name="linktype" value="<?php echo $linktype; ?>" />
            
			<input type="hidden" name="img_width" value="<?php echo $img_width; ?>" />
			<input type="hidden" name="img_height" value="<?php echo $img_height; ?>" />
			<input type="hidden" name="img_max_width" value="<?php echo $img_max_width; ?>" />
                        
			<input type="hidden" name="ret_cat_id" value="<?php echo $ret_cat_id; ?>" />
			<input type="hidden" name="action" value="<?php echo $action; ?>" />
			<input type="hidden" name="banner_id" value="<?php echo $banner_id; ?>" />
			<input type="file" name="uploadedfile">
			<div class="center"><br />
			
            
			<a class="btn btn-large" 
            href="<?php echo $ret_dir."/".$ret_page.".php?ret_cat_id=".$ret_cat_id."&banner_id=".$banner_id."&page_id=".$page_id."&linktype=".$linktype; ?>" 
            <?php if(!$fromfancybox){ echo "target='_top'"; } ?>>Cancel</a> </div>
			<div class="loadinggif" id="inprogress"><img id="inprogress_img" src="<?php echo $ste_root; ?>/images/progress.gif">
				<p>Please Wait...</p>
			</div>
		</div>
		<br />
		<br />
		<div class="savebar">
		
        	<button type="submit" class="btn btn-large btn-success" value="Submit" onClick="document.getElementById('inprogress').style.visibility='visible'"><i class="icon-ok icon-white"></i> Upload File</button>
        
        </div>
	</form>
	
</div>
</body>
</html>
