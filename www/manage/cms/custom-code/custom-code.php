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

$page_title = "Custom Code and Meta Tags";
$page_group = "seo";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();
// add if not exist
$sql = "SELECT custom_code_id FROM custom_code WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO custom_code 
		(profile_account_id)VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
}


if(isset($_POST['submit'])){


	$head_block = trim(addslashes($_POST['head_block']));
	$body_block = trim(addslashes($_POST['body_block']));

	$sql = sprintf("UPDATE custom_code 
					SET  head_block = '%s', body_block = '%s' 
					WHERE profile_account_id = '%u'", 
					$head_block, $body_block, $_SESSION['profile_account_id']);
$result = $dbCustom->getResult($db,$sql);	


	$sql = "DELETE FROM custom_meta_tags 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	


	//$excludes = trim(addslashes($_POST['excludes']));	
	$tags = (isset($_POST['tags'])) ? $_POST['tags'] : array();

	if(count($tags) > 0){

	
		foreach($tags as $value){
			
			$tag = trim(addslashes($value));
			$sql = sprintf("INSERT INTO custom_meta_tags (tag, profile_account_id) 
			VALUES ('%s','%u')", 
			$value, $_SESSION['profile_account_id']);		
	$result = $dbCustom->getResult($db,$sql);			

		}
	}

	
	unset($_SESSION['input_count']);
	unset($_SESSION['tag_values']);
	// customer facing vars	
	unset($_SESSION['custom_code_head_block']);
	unset($_SESSION['custom_code_body_block']);
	unset($_SESSION['custom_meta_tags']);
	
	

}

$firstload =  (isset($_GET['firstload'])) ? $_GET['firstload'] : 0;
if($firstload){
	unset($_SESSION['input_count']);
	unset($_SESSION['tag_values']);
}


if(!isset($_SESSION['tag_values'])){

	$_SESSION['tag_values'] = array();
	$sql = "SELECT tag
			FROM custom_meta_tags
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()){
		$_SESSION['tag_values'][] = $row->tag;
	}
	
	//print_r($_SESSION['tag_values']);
	
	$_SESSION['input_count'] = count($_SESSION['tag_values']);
	if($_SESSION['input_count'] == 0) $_SESSION['input_count'] = 1;
	
}



$_SESSION['input_count'] = (isset($_SESSION['input_count'])) ? $_SESSION['input_count'] :1;
$_SESSION['exclude_values'] = (isset($_SESSION['exclude_values'])) ? $_SESSION['exclude_values'] :array();

$sql = "SELECT head_block, body_block
		FROM custom_code
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$head_block = $object->head_block;
	$body_block	= $object->body_block;
}else{
	$head_block = '';
	$body_block = '';	
	
}

//print_r($_SESSION['exclude_values']);





require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>
$(document).ready(function() {

	q_str = '?action=0';
	set_form(q_str);

});

function set_form(q_str){
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_meta_tags.php'+q_str,
	  success: function(data) {			
			
		$('#form_content').html(data);
		  
	  }
	});		
}


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
		$bread_crumb->add("Custom Code", '');
        echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//SEO section tabbed sub-navigation
        //require_once($real_root."/manage/admin-includes/seo-section-tabs.php");
 		?>
        
        Warning: Adding custom code or meta tags can cause your site to stop working correctly.
        <br /><br /> 
        <form name="form" action="custom-code.php" method="post" enctype="multipart/form-data">
        
        
                
                <label>Head Block</label>
				<textarea name="head_block" cols="110" rows="40"><?php echo trim(stripslashes($head_block)); ?></textarea>	
                <br /><br />        
                <label>Body Block</label>
				<textarea name="body_block" cols="110" rows="40"><?php echo trim(stripslashes($body_block)); ?></textarea>	
				<br /><br />
            	<legend>Custom Meta Tags</legend>
				<div id='form_content'></div>
				<a style="cursor:pointer;" onClick="add_input();">Add Another Meta Tag</a>
				<br />
                <br />

    	



		<?php 

        if($admin_access->cms_level > 1){
            echo "<button class='btn btn-success btn-large' name='submit' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
        </form>


  	</div>
	<br /><br />
        
    <p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	?>
</div>
</body>
</html>

