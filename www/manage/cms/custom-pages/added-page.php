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

$page_title = "Added Page";
$page_group = "added-page";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	$added_page_id = (isset($_REQUEST['added_page_id'])) ? $_REQUEST['added_page_id'] : 0;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT * 
			FROM added_page 
			WHERE added_page_id = '".$added_page_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$content1 = $object->content1;
		$page_name = $object->page_name;
		

	}else{
		$content1 = '';
		$page_name = '';
	}
	
	$page = $page_name;
	
	if(!isset($_SESSION['temp_page_fields']['content1'])) $_SESSION['temp_page_fields']['content1'] = $content1;
	if(!isset($_SESSION['temp_page_fields']['page_name'])) $_SESSION['temp_page_fields']['page_name'] = $page_name;
	
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");
	
	if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
	if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name;
	if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;
	if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;
	if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;
	



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>

function validate(theform){
		
	return true;
}

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


$(document).ready(function() {
	
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900	
	});
	
	$('.fancybox').click(function(){		
		
		ajax_set_page_session();
	
	});
	
});



function ajax_set_page_session(){
	
	var q_str = "?page=terms"+get_query_str();
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
	  success: function(data) {
		//alert(data);
	  }
	});
}


function get_query_str(){
	
	var query_str = '';
	
	query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26'); 
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	
	query_str += "&seo_name="+document.form.seo_name.value; 
	query_str += "&title="+document.form.title.value.replace('&', '%26'); 
	query_str += "&keywords="+document.form.keywords.value.replace('&', '%26'); 
	query_str += "&description="+document.form.description.value.replace('&', '%26'); 
	
	return query_str;
}




function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	


function setRegularSubmit() {
  document.form.action = 'page.php';
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
    
    
    
    
	<?php
   		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add($page_name, '');
	 	 echo $bread_crumb->output();
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
 
 
 		//require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/custom-page-tabs.php");

      
 
 
        ?>
	<form name="form" action="<?php echo $ste_root."manage/cms/pages/page.php" ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="edit_added_page" value="1">        
		<input type="hidden" name="added_page_id" value="<?php echo $added_page_id; ?>">
		<input type="hidden" name="ret_page" value="added-page">
		<input type="hidden" name="ret_dir" value="manage/cms/pages">
		<input type="hidden" name="page" value="<?php echo $page; ?>"> 
		<input type="hidden" name="content_table" value="added_page"> 
    
        
		<input type="hidden" name="original_page_name" value="<?php echo $page_name; ?>"> 
        
        
               
        
        
		<div class="page_actions edit_page"> 
            <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>

            <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
            <i class="icon-eye-open icon-white"></i> Add to Navigation </a>
            
			<!--<button onClick="setRegularSubmit();" id="save" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>-->
            
            <button type="submit" id="save" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
            
			<hr />
			<?php 
			if($_SESSION['is_ssl']){ 
				$checked = ($mssl)? "checked=checked" : ''; 		
			?>
			<label>Set Page as SSL</label>
			<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
				<input type="checkbox" class="checkboxinput" name="mssl" value="1" <?php echo $checked; ?> />
			</div>
			<?php } ?>
			<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>
		<div class="page_content edit_page">
		<fieldset class="edit_content">
			
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Name</label>
                            </div>
                            <div class="twocols">
                                <input type="text" id="page_name" name="page_name" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['page_name']); ?>" />
                            </div>
                        </div>
            
            
            
            <legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
					
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Heading</label>
                            </div>
                            <div class="twocols">
                                <input type="text" id="page_heading" name="page_heading" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['page_heading']); ?>" />
                            </div>
                        </div>



			<div class="colcontainer"> 
				<textarea id="content" class="wysiwyg" name="content1"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['content1']); ?></textarea>
			</div>
		</fieldset>
        
	        <?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/pages/edit_page_seo.php"); ?>
    	    <?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/edit_page_breadcrumb.php"); ?>



		</div>
	</form>
</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
<div style="display:none">
	<div id="edit" style="width:800px; height:660px;"> </div>
</div>
<div style="display:none">
	<div id="upload" style="width:280px; height:200px;"> </div>
</div>
<div style="display:none">
	<div id="delete" style="width:250px; height:100px;"> <br />
		Are you sure you want to delete this bread crumb?
		<form name="del_bc" action="edit-about-us.php" method="post">
			<input id="del_bc_id" type="hidden" name="del_bc_id" />
			<input name="del_bc" type="submit" value="DELETE" />
		</form>
	</div>
</div>
</body>
</html>
