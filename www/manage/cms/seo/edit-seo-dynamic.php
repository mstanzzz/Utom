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


require_once($real_root.'/manage/admin-includes/manage-includes.php');

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;



$page_seo_id = (isset($_GET['page_seo_id'])) ? $_GET['page_seo_id'] : 0; 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = sprintf("SELECT * FROM page_seo WHERE page_seo_id = '%u'", $page_seo_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$page_name = $object->page_name;
	$seo_name = $object->seo_name;
	$title = $object->title;
	$mssl = $object->mssl;
	$description = $object->description;
	$keywords = $object->keywords;
	$added_page_id = $object->added_page_id;
	$page_heading = $object->page_heading;
}else{
	$page_name = '';
	$seo_name = '';
	$title = '';
	$mssl = '';
	$description = '';
	$keywords = '';
	$added_page_id = 0;
	$page_heading = '';
}



require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/breadcrumbpreviews.js"></script>
<script>

function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}
</script>

</head>
<body>
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
	
	$url_str = "seo-dynamic.php";
	$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
	$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
	$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
	      
	?>
	<form name="edit_meta" action="<?php echo $url_str; ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data" target="_top">
		<input id="page_seo_id" type="hidden" name="page_seo_id" value="<?php echo $page_seo_id;  ?>" />
		
        <input type="hidden" name="seo_name" value="<?php echo $seo_name; ?>" />
        
        <input type="hidden" name="ret_page" value="edit-seo-dynamic">


		<input type='hidden' name='page_heading' value=''>

		<div class="lightboxcontent">
			<h2>Edit Dynamic Page Seo</h2>
			<fieldset class="colcontainer">
				<?php
				?>
				<div class="threecols">
					<label>Page Name</label>
					<?php echo $page_name; ?> 
                </div>
				<input type="hidden" name="page_name" value="<?php echo $page_name; ?>">
                
                
	           <!--
                <div class="threecols">
					<label>Page name on URL</label>
					<input type="text" name="seo_name" value="<?php//echo $seo_name; ?>" maxlength="250" />
				</div>
                -->

				
				<div class="threecols">
					<label>Page Title</label>
					<input type="text" name="title" value="<?php echo $title; ?>" maxlength="250" />
				</div>
			</fieldset>
			<?php if(($_SESSION['is_ssl']) && ($page_name != "home") && ($admin_access->cms_level > 1)){ ?>
			<fieldset class="colcontainer">
				<legend>SSL</legend>
				<label>SSL ON</label>
				<input type="radio" name="mssl" value="1" <?php if($mssl == 1) echo "checked";?>/>
				<label>SSL OFF</label>
				<input type="radio" name="mssl" value="0" <?php if($mssl == 0) echo "checked";?>/>
			</fieldset>
			<?php }else{ ?>
			<input type="hidden" name="mssl" value="0" />
			<?php } ?>
			<fieldset class="colcontainer">
				<div class="twocols">
					<label>META Description</label>
					<textarea name="description"><?php echo $description; ?></textarea>
					</div>
				<div class="twocols">
					<label>META Keywords</label>
					<textarea name="keywords"><?php echo $keywords; ?></textarea>
					</div>
			</fieldset>

    	    <?php
			if(($page_name != "home") && ($admin_access->cms_level > 1)){ 
				$page = $page_name;
				require_once($real_root."/manage/cms/edit_page_breadcrumb.php"); 
			}
			?>
		<br /><br />
       	<div class="savebar">
		<?php 
        if($admin_access->cms_level > 1){
            echo "<button class='btn btn-success btn-large' name='edit_seo' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
        <button class="btn btn-large" type="button" value="Cancel" onClick="top.location.href = '<?php echo $url_str; ?>'" >Cancel</button>
		</div>

		<div class="disabledMsg">
			<p>Sorry, this item can't be deleted or inactive.</p>
		</div>

</div>
</body>
</html>
