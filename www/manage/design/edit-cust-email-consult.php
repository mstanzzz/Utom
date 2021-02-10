<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'aws/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/aws';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Customer Email in Consultation Request";
$page_group = "design";

	

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;


$msg = '';

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
$strip = (isset($_GET['strip'])) ? $_GET['strip'] : '';
$search_str = (isset($_GET['search_str'])) ? $_GET['search_str'] : '';


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

        $sql = "SELECT consult_email_content_id
				,content
			FROM consult_email_content
			WHERE consult_email_content_id = (SELECT MAX(consult_email_content_id) FROM consult_email_content WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
        $result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
        	$object = $result->fetch_object();
		}else{
			
			
			$sql = "INSERT INTO consult_email_content
				(content,profile_account_id)VALUE('Welcom','".$_SESSION['profile_account_id']."')";
				 $result = $dbCustom->getResult($db,$sql);
			
			
			echo 'Does not exist';
			exit;	
		}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>

<script>

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
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,code",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		forced_root_block : false

	});
	

function validate(theform){	

	/*
	if (theform.elements['chosen_categories[]'].selectedIndex == -1) {
	  alert("Please select parent categoty.");
	}
		
	var name = jQuery.trim(theform.name.value);
	if(name == ''){
		alert("Please enter category name");
		return false;				
	}

	*/


	return true;
}

</script>

</head>
<body>
<?php


	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');

echo $object->consult_email_content_id;
?>

<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
		

        ?>
	</div>
	<div class="manage_main">
		<?php
		$url_str = "in-home-consult.php";	
		$url_str .= "?pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		$url_str .= "&search_str=".$search_str;
		?>
		<form name="edit_part" action="<?php echo $url_str;  ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data">

			<input type="hidden" name="edit_email_content" value="1" />            
			<input type="hidden" name="consult_email_content_id" value="<?php echo $object->consult_email_content_id; ?>" />

			<div class="page_actions edit_page">
            	<?php //if($admin_access->product_catalog_level > 1){ 
					if(1){
				?> 
					<button class="btn btn-large btn-success" name='submit' type='submit'><i class="icon-ok icon-white"></i> Save Changes</button>
				<?php }else{ ?>
        			<div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        		<?php } ?>		
                <hr />
				<a href="<?php echo $url_str; ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a>

			</div>
			 <div class="colcontainer"> 
                	<label>Content</label>
                    <textarea id="content" class="wysiwyg" name="content"><?php echo stripAllSlashes($object->content); ?></textarea>
             </div>
        	
        </form>
    </div>



       

	<p class="clear"></p>
    <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
    ?>




	<p class="clear"></p>
</div>

</body>
</html>