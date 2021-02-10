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

$page_title = "Edit Brand";
$page_group = "vend-man";

	

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$msg = '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
</head>
<body class="lightbox">
<div class="lightboxholder">

	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
	$vend_man_id = (isset($_GET['vend_man_id']))? $_GET['vend_man_id'] : 0; 
		
	$brand_id = (isset($_GET['brand_id']))? $_GET['brand_id'] : 0; 
	
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = sprintf("SELECT * FROM brand WHERE brand_id = '%u'", $brand_id);
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
	$object = $result->fetch_object();
	
	$url_str = "brand.php";
	$url_str .= "?strip=".$strip;
	$url_str .= "&vend_man_id=".$vend_man_id;
	$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
	$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
	$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
	
	
	
	$target = ($strip) ? '_self' : '_top';
	
	?>
    
    
    
    <form name="edit_brand" action="<?php echo $url_str; ?>" method="post" target="<?php echo $target; ?>">
		<input type="hidden" name="brand_id" value="<?php echo $brand_id; ?>" />
        
        
        
        
		<div class="lightboxcontent">
			<h2>Edit Brand </h2>
			<fieldset class="colcontainer formcols">
				<div class="colcontainer">
					<label>Brand Name</label>
					<input style="width:600px;" type="text" name="name" value="<?php echo prepFormInputStr($object->name); ?>" />
				</div>
				<div class="colcontainer">
					<label>Short name for website navigation</label>
					<input style="width:230px;" type="text" name="short_name" value="<?php echo prepFormInputStr($object->short_name); ?>" />
				</div>
			</fieldset>
			<fieldset class="colcontainer formcols">
				<div class="twocols">
					<label>Brand Website</label>
				</div>
				<div class="twocols">
					<input type="text" name="web_site" value="<?php echo $object->web_site; ?>" />
				</div>
			</fieldset>
			<fieldset class="colcontainer">
				<legend>Select Vendors</legend>
				<?php
						$sql = "SELECT name, vend_man_id 
						FROM vend_man 
						WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
						ORDER BY name";
						
						$res = $dbCustom->getResult($db,$sql);
						
						$block = '';
						while($v_row = $res->fetch_object()) {
							$sql = "SELECT brand_id, vend_man_id 
							FROM vend_man_brand 
							WHERE brand_id = '".$brand_id."'
							AND vend_man_id = '".$v_row->vend_man_id."'";
							
							$sub_res = $dbCustom->getResult($db,$sql);
							if($sub_res->num_rows){
								$checked = "checked";	
							}else{
								$checked = '';
							}
							$block .= "<div class='threecols'>
							<input name='vend_man_ids[]' class='leftlabel' type='checkbox' value='".$v_row->vend_man_id."' $checked>";
							$block .= "<label class='form_label'>".stripAllSlashes($v_row->name)."</label></div>";
						}
						echo $block;
						?>
			</fieldset>
		</div>
        <div class="savebar">
		<?php if($admin_access->product_catalog_level > 1){ ?>                
			<button name="edit_brand" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save Changes </button>
        <?php }else{ ?>
        	<div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>		
        </div>
			
    </form>
</div>
<?php } ?>
</body>
</html>

