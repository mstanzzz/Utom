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

	if ($handle->uploaded) {
			
		$handle->image_resize            = false;			
			
		$handle->Process($dir_dest);

		if ($handle->processed) {
			
			$msg = "Upload Successful";
			//$img_name = $handle->file_src_name;
			$img_name = $handle->file_dst_name;
				
			$sql = sprintf("INSERT INTO image 
				(file_name, slug, profile_account_id) 
				VALUES 
				('%s','%s','%u')",
			$img_name, $slug, $_SESSION['profile_account_id']);				
			$r = $dbCustom->getResult($db,$sql);
			$this_img_id = $db->insert_id; 	

			if($slug == "logo"){
				$sql = sprintf("INSERT INTO logo 
				(img_id, profile_account_id) VALUES ('%u', '%u')", 
				$this_img_id, $_SESSION['profile_account_id']);
				$result = $dbCustom->getResult($db,$sql);

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

	header($header_str);
		
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
if($ret_page == 'faq') $slug = 'faq';

//echo $slug;

?>
<div class="lightboxholder">

<form action="upload.php" method="post" enctype="multipart/form-data" target="_top">
    
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
