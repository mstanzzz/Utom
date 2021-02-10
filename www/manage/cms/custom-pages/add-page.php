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

$page_title = "Add New Page";
$page_group = "process";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>
//$(document).ready(function() {	});


function trim(str) {  return str.replace(/^\s+|\s+$/g, '');  } 
		tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "wysiwyg",
        theme : "advanced",
        skin : "o2k7",
        plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
        // Theme options
        theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,styleselect,formatselect,fontsizeselect,|,forecolor,backcolor",
        theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		forced_root_block : false

	});

function validate(theform){	
	
	var pageName = trim(theform.added_page_name.value);
		
	if(pageName == ''){
		alert("Please enter a page name");
		return false;				
	}
	
	if(pageName.indexOf("_") > -1){
		alert("Please use hyphens. No underscores on page name");
		return false;				
	}
	
	if(pageName.indexOf(" ") > -1){
		alert("Please use hyphens. No spaces on page name");
		return false;				
	}
	
	return true;
}


function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function setRegularSubmit() {
  document.form.action = '<?php echo $current_page; ?>';
  document.form.target = '_self'; 
}

</script>
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
		<h1>Add New Page</h1>
		<?php 
		// select database

		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add("About Us", '');
        echo $bread_crumb->output();
		
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/custom-page-tabs.php");


		// put success/error messages on the page instead of a JS alertbox
		if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
		<?php } else {} ?>
    	<form name="add_page_form" action="<?php echo $ste_root."manage/cms/pages/page.php" ?>" method="post" onSubmit="return validate(this)">


			<div class="page_actions edit_page">
                <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
                
                <!--
                <button onClick="setRegularSubmit();" id="save" name="add_page" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
                -->
                
                <button type="submit" id="save" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
                
				<hr />
				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>
			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Heading</label>
                            </div>
                            <div class="twocols">
                                <input type="text" name="page_heading" value='' />
                            </div>
                        </div>
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page file name on URL</label>
                            </div>
                            <div class="twocols">
                                <input type="text" name="page_name" value='' />
                            </div>
                        </div>
                        <div class="colcontainer formcols">
                                <label>Page Content</label>
                                <textarea id="wysiwyg" class="wysiwyg" name="content1"></textarea>
                        </div>
			</fieldset>
	        <?php 
			$from_added_page = 1;
			 require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/pages/edit_page_seo.php"); ?>
		
    	    <?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/edit_page_breadcrumb.php"); ?>
			</div>
    	</form>
    
    <br /><br /><br /><br /><br /><br /><br /><br /><br />
    </div>  
	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	?>  
</div>
</body>
</html>



