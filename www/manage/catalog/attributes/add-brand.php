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

$progress = new SetupProgress;
$module = new Module;

$page_title = "Add Brand";
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

$vend_man_id = (isset($_GET['vend_man_id']))? $_GET['vend_man_id'] : 0;

$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : "brand";

$msg = '';

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


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

	$url_str = "brand.php";
	$url_str .= "?strip=".$strip;
	$url_str .= "&vend_man_id=".$vend_man_id;		
	$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
	$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
	$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
	
	$target = ($strip) ? '_self' : '_top';
	//echo $url_str;
	?>
    <form name="form" action="<?php echo $url_str; ?>" method="post" target="<?php echo $target; ?>">
    
    <input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
    <input type="hidden" name="vend_man_id" value="<?php echo $vend_man_id; ?>" />
    		<div class="lightboxcontent">
			<h2>Add a New Brand</h2>
			<fieldset class="colcontainer formcols">
				<div class="colcontainer">
					<label>Brand Name</label>
					<input style="width:600px;" type="text" name="name" value='' />
				</div>
				<div class="colcontainer">
					<label>Short name for website navigation</label>
					<input style="width:230px;" type="text" name="short_name" value='' />
				</div>

			</fieldset>

   			<fieldset class="colcontainer formcols">
				<div class="twocols">
					<label>Brand Website</label>
				</div>
				<div class="twocols">
					<input type="text" name="web_site" value='' />
				</div>
			</fieldset>

			<fieldset class="colcontainer">
				<legend>Select Vendors</legend>
				<?php
						$db = $dbCustom->getDbConnect(CART_DATABASE);
						$sql = "SELECT name, vend_man_id 
							FROM vend_man 
							WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
							ORDER BY name";
							
							$res = $dbCustom->getResult($db,$sql);
							$block = '';
							while($v_row = $res->fetch_object()) {
								
								$checked = ($v_row->vend_man_id == $vend_man_id) ? "checked" : '';
								
								$block .= "<div class='threecols'><input class='leftlabel' name='vend_man_ids[]' type='checkbox' value='".$v_row->vend_man_id."' $checked>";
								$block .= "<label class='form_label'>".stripslashes($v_row->name)."</label></div>";
							}
			
							echo $block;
						
						?>
			</fieldset>
		</div>
		<div class="savebar">  
		  <button name="add_brand" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save Changes </button>
		</div>
    </form>
</div>
</body>
</html>

