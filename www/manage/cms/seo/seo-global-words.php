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

$page_title = "SEO Global SEO Words";
$page_group = "seo";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST["edit_global_word"])){

	$url_word = trim(addslashes($_POST["url_word"])); 
	$html_title_word = trim(addslashes($_POST["html_title_word"])); 

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	
	$sql = "SELECT global_seo_words_id FROM global_seo_words 
	WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows < 1){
		$sql = "INSERT INTO global_seo_words 
				(profile_account_id)VALUES('".$_SESSION['profile_account_id']."')"; 
		$result = $dbCustom->getResult($db,$sql);
						
	}
	
	
	$sql = sprintf("UPDATE global_seo_words 
			SET url_word = '%s', html_title_word = '%s'
			WHERE profile_account_id = '%u'", 
			$url_word, $html_title_word, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	
	$msg = "Changes Saved.";	
	
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>


</head>
<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
		
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("SEO Global Words", '');
        echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//SEO section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/seo-section-tabs.php");
        $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		?>
		
            <?php
			// get total number of rows
			$sql = "SELECT url_word, html_title_word FROM global_seo_words 
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					";
			$result = $dbCustom->getResult($db,$sql);
			
			if($result->num_rows){
				$object = $result->fetch_object();
				$url_word = $object->url_word;
				$html_title_word = $object->html_title_word;	
			}else{
				$url_word = '';	
				$html_title_word = '';
			}
			?>		
	
    	
        
       	<form name="form" action="seo-global-words.php" method="post" enctype="multipart/form-data" target="_top">
        	<input type="hidden" name="edit_global_word" value="1">
			<fieldset class="colcontainer">
			    <div class="threecols">
					<label>URL Word</label>
					<input type="text" name="url_word" value="<?php echo $url_word; ?>" maxlength="250" />
				</div>
			    <div class="threecols">
					<label>HTML Title Word</label>
					<input type="text" name="html_title_word" value="<?php echo $html_title_word; ?>" maxlength="250" />
				</div>

			</fieldset>
		
		
		<?php 

        if($admin_access->cms_level > 1){
            echo "<button class='btn btn-success btn-large' name='edit_global_word' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
  	</div>

        </form>
        
    <p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	?>
</div>
</body>
</html>

