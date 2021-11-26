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

$progress = new SetupProgress;
$module = new Module;


$page_title = "Add header support menu label";
$page_group = "navbar";

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
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
	<?php } ?>
	<form name="add_header_support_menu_label_form" action="header-support-menu.php?<?php echo $qs_strip; ?>" method="post" <?php if(!$strip) echo "target='_top'"; ?> >
		<div class="lightboxcontent">
			<h2>Add New Header Nav Item</h2>
			<fieldset class="colcontainer">
				<div class="twocols">
						<label>Label</label>
						<input type="text" name="label"  style="width: 200px">
				</div>
				<div class="twocols">
					<label>Page Name</label>
                    <?php 
                    $pages = new Pages;
                    $available_pages_array = $pages->getAvailableNavPages($_SESSION['profile_account_id']);  
                    $block = "<select name='page_seo_id'>";
                    foreach($available_pages_array as $value){
						$block .= "<option value='".$value['page_seo_id']."' >".ucwords($value['visible_name'])."<option>";
					}
					$block .= "</select>";
					echo $block;
                    ?>
				</div>
			</fieldset>
			<a class="btn btn-large" href="header-support-menu.php?<?php echo $qs_strip; ?>" <?php if(!$strip) echo "target='_top'"; ?> >Cancel</a>
		</div>
		<br /><br />
		<div class="savebar">		
            <button class="btn btn-large btn-success" name="add_header_support_menu_label" type="submit" ><i class="icon-ok icon-white"></i> Add Nav Item </button>
		</div>
	</form>
</div>

</body>
</html>


