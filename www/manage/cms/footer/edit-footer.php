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

$page_title = "Edit Footer";
$page_group = "footer";
$msg = '';

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

if(isset($_POST['update_footer'])){

	$footer_id = isset($_POST['footer_id'])? $_POST['footer_id'] : 0;		
	$f_head = isset($_POST['f_head'])? addslashes($_POST['f_head']) : '';		
	$f_text = isset($_POST['f_text'])? addslashes($_POST['f_text']) : '';
	
	$stmt = $db->prepare("UPDATE footer
						SET
						f_head = ?
						,f_text = ?
						WHERE footer_id = ?");
						
		//echo 'Error-1 UPDATE   '.$db->error;
		
	if(!$stmt->bind_param("ssi"
						,$f_head
						,$f_text
						,$footer_id)){
							
		echo 'Error-2 UPDATE   '.$db->error;
		
	}else{
		$stmt->execute();
		$stmt->close();				
		$msg = "Updated";
	}
		

}

	
$sql = "SELECT *
		FROM footer
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);			
	
if($result->num_rows){
	$object = $result->fetch_object();	
	$footer_id = $object->footer_id;		
	$f_head = $object->f_head;
	$f_text = $object->f_text;
}else{
	$footer_id = 0;
	$f_head = '';
	$f_text = '';
}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>


tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});


</script>
</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
        require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT."/manage/cms/cms-landing.php");
		$bread_crumb->add("Footer", '');
        echo $bread_crumb->output();

	?>
		<form name="form" action="edit-footer.php " method="post" onSubmit="return validate(this)">
           
		   <input type="hidden" name="footer_id" value="<?php echo $footer_id; ?>" />
		   
		   <div class="page_actions edit_page">
			<?php if($admin_access->cms_level > 1){ ?>
				<button name="update_footer" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
				<hr />
             <?php }else{ ?>
            	<div class="alert">
                	<i class="icon-warning-sign"></i>         
                    Sorry, you don't have the permissions to edit this information.
                </div>            
			<?php } ?>
			</div>

			<div class="page_content edit_page">
				<fieldset class="edit_content">

					<label>Footer Heading</label>
					<input style="width:100%;" type="text" name="f_head"  value="<?php echo $f_head;  ?>" />
					<label>Footer Text Block</label>
					<textarea style="width:100%;" name="f_text" class="wysiwyg"><?php echo $f_text;  ?></textarea>
				</fieldset>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
