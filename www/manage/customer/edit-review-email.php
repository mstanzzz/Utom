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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.saas_customer.php');

$saas_cust = new SaasCustomer;

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Review Email";
$page_group = "review";
$page = '';

	


$ts = time();

$edit_review_email_id = (isset($_GET['edit_review_email_id'])) ? $_GET['edit_review_email_id'] : 0;


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT review_req_email_text_id 
		FROM review_req_email_text
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows == 0){
	
	$initial_content = '';
	$initial_content .= "Hi,<br /><br />";
	$initial_content .= "I personally wanted to reach out and thank you for your recent purchase from Closets To Go.<br /><br />";
	$initial_content .= "You've put your trust in us to assist you in creating what we hope was a great experience as reflected in our customer service on through the finished product. "; 
	$initial_content .= "So that we may continue to provide you and others with outstanding products and customer service we would greatly appreciate"; 
	$initial_content .= "if you could fill out a review from the link below. "; 
	$initial_content .= "We know everyone has busy lives and we really are grateful for your time.<br /><br />";	
	$initial_content .= "<br /><br />Kindest Regards,<br /><br />";
	$initial_content .= $saas_cust->company; 
	$initial_content = addslashes($initial_content);
	
	
	$sql = "INSERT INTO review_req_email_text
			(content_auto, content_manual, profile_account_id)
			VALUES
			('".$initial_content."', '".$initial_content."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
}

if(isset($_POST['edit_review_email'])){

	$content_auto = trim(addslashes($_POST['content_auto']));
	$content_manual = trim(addslashes($_POST['content_manual']));
	
	$review_req_email_text_id = $_POST['review_req_email_text_id'];
	
	$sql = sprintf("UPDATE review_req_email_text 
					SET  content_auto = '%s', content_manual = '%s'
					WHERE review_req_email_text_id = '%u'", 
					$content_auto, $content_manual,$review_req_email_text_id);
		
	$result = $dbCustom->getResult($db,$sql);

	$msg = "Your change is now live.";

}
	

$sql = "SELECT *
		FROM review_req_email_text 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$review_req_email_text_id = $object->review_req_email_text_id;
	$content_auto = $object->content_auto;
	$content_manual = $object->content_manual;
		
}else{
	$edit_review_email_id = 0;
	$content_auto = '';
	$content_manual = '';
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>

function validate(theform){
			
	return true;
}

$(document).ready(function() {
	$('.fancybox').click(function(){		
		ajax_set_page_session();
	});
});
	
	
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
	



function ajax_set_page_session(){
	
	/*
	var q_str = "?page=about-us"+get_query_str();
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
	  success: function(data) {
			//alert(data);
	  }
	});
	*/
}

function get_query_str(){
	
	var query_str = '';
	
	query_str += "&intro="+escape(tinyMCE.get('intro').getContent());
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	return query_str;
}

function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/manage/customer/preview-email-text.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
  document.form.action = '<?php echo $current_page; ?>';
  document.form.target = '_self';
  document.form.submit(); 
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
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php'); ?>
	</div>
	<div class="manage_main">
	<?php 
	
	
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        ?>
	<form name="form" action="edit-review-email.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="edit_review_email" value="1">        
		<input type="hidden" name="review_req_email_text_id" value="<?php echo $review_req_email_text_id; ?>">
        
		<div class="page_actions edit_page"> 
            <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
            <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
            
			<hr />
			<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>
		<div class="page_content edit_page">
            
            <fieldset class="edit_content">
                <legend>Content For Auto Review Request Email <i class="icon-minus-sign icon-white"></i></legend>
                	
                    <label>Hi [customer name]</label>
                
                    <textarea id="content_auto" class="wysiwyg" name="content_auto"><?php echo stripAllSlashes($content_auto); ?></textarea>
            </fieldset>

            <fieldset class="edit_content">
            	
                <legend>Content For Manual Review Request Email <i class="icon-minus-sign icon-white"></i></legend>
                <label>Hi [customer name]</label>
                    <textarea id="content_manual" class="wysiwyg" name="content_manual"><?php echo stripAllSlashes($content_manual); ?></textarea>
            </fieldset>
            

		</div>
	</form>
<p style="height:100px;" ></p>

</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>

<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>
