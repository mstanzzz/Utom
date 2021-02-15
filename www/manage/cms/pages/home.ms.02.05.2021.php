<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;
$pages = new Pages;

$page_title = "Home Page";
$page_group = "home-page";
$page = "home";

	

$action = (isset($_GET['action'])) ? $_GET['action'] : '';

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

// add if not exist
$sql = "SELECT home_id FROM home WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO home 
		(top_1, profile_account_id) 
		VALUES ('Add Content', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
}else{
	$_SESSION['home_id'] = (isset($_REQUEST['home_id'])) ? $_REQUEST['home_id'] : 0;
}

if(!is_numeric($_SESSION['home_id'])) $_SESSION['home_id'] = 0;
		
if(isset($_POST['update_home'])){
	
	$_SESSION['home_id'] = isset($_POST['home_id'])? $_POST['home_id'] : 0;

	$img_1_id = isset($_POST['img_1_id'])? $_POST['img_1_id'] : 0;
	$img_2_id = isset($_POST['img_2_id'])? $_POST['img_2_id'] : 0;
	$img_3_id = isset($_POST['img_3_id'])? $_POST['img_3_id'] : 0;

	if(!is_numeric($home_id)) $home_id = 0;
	if(!is_numeric($img_1_id)) $img_1_id = 0;
	if(!is_numeric($img_2_id)) $img_2_id = 0;
	if(!is_numeric($img_3_id)) $img_3_id = 0;

	$top_1 = isset($_POST['top_1'])? addslashes(trim($_POST['top_1'])) : '';
	$top_2 = isset($_POST['top_2'])? addslashes(trim($_POST['top_2'])) : '';
	$top_3 = isset($_POST['top_3'])? addslashes(trim($_POST['top_3'])) : '';
	
	$p_1_head = isset($_POST['p_1_head'])? addslashes(trim($_POST['p_1_head'])) : '';
	$p_1_text = isset($_POST['p_1_text'])? addslashes(trim($_POST['p_1_text'])) : '';
	
	$p_2_head = isset($_POST['p_2_head'])? addslashes(trim($_POST['p_2_head'])) : '';
	$p_2_text = isset($_POST['p_2_text'])? addslashes(trim($_POST['p_2_text'])) : '';

	$p_3_head = isset($_POST['p_3_head'])? addslashes(trim($_POST['p_3_head'])) : '';
	$p_3_text = isset($_POST['p_3_text'])? addslashes(trim($_POST['p_3_text'])) : '';

	$p_4_head = isset($_POST['p_4_head'])? addslashes(trim($_POST['p_4_head'])) : '';
	$p_4_text = isset($_POST['p_4_text'])? addslashes(trim($_POST['p_4_text'])) : '';

	$p_5_head = isset($_POST['p_5_head'])? addslashes(trim($_POST['p_5_head'])) : '';
	$p_5_text = isset($_POST['p_5_text'])? addslashes(trim($_POST['p_5_text'])) : '';

	$p_6_head = isset($_POST['p_6_head'])? addslashes(trim($_POST['p_6_head'])) : '';
	$p_6_text = isset($_POST['p_6_text'])? addslashes(trim($_POST['p_6_text'])) : '';

	$p_7_head = isset($_POST['p_7_head'])? addslashes(trim($_POST['p_7_head'])) : '';
	$p_7_text = isset($_POST['p_7_text'])? addslashes(trim($_POST['p_7_text'])) : '';

	$p_8_head = isset($_POST['p_8_head'])? addslashes(trim($_POST['p_8_head'])) : '';
	$p_8_text = isset($_POST['p_8_text'])? addslashes(trim($_POST['p_8_text'])) : '';
	

	$_SESSION['temp_page_fields']['top_1'] = $top_1;	
	$_SESSION['temp_page_fields']['top_2'] = $top_2;	
	$_SESSION['temp_page_fields']['top_3'] = $top_3;	
	$_SESSION['temp_page_fields']['p_1_head'] = $p_1_head;	
	$_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;	
	$_SESSION['temp_page_fields']['p_2_head'] = $p_2_head;	
	$_SESSION['temp_page_fields']['p_2_text'] = $p_2_text;	
	$_SESSION['temp_page_fields']['p_3_head'] = $p_3_head;	
	$_SESSION['temp_page_fields']['p_3_text'] = $p_3_text;	
	$_SESSION['temp_page_fields']['p_4_head'] = $p_4_head;	
	$_SESSION['temp_page_fields']['p_4_text'] = $p_4_text;	
	$_SESSION['temp_page_fields']['p_5_head'] = $p_5_head;	
	$_SESSION['temp_page_fields']['p_5_text'] = $p_5_text;	
	$_SESSION['temp_page_fields']['p_6_head'] = $p_6_head;	
	$_SESSION['temp_page_fields']['p_6_text'] = $p_6_text;	
	$_SESSION['temp_page_fields']['p_7_head'] = $p_7_head;	
	$_SESSION['temp_page_fields']['p_7_text'] = $p_7_text;	
	$_SESSION['temp_page_fields']['p_8_head'] = $p_8_head;	
	$_SESSION['temp_page_fields']['p_8_text'] = $p_8_text;	
	$_SESSION['temp_page_fields']['img_1_id'] = $img_1_id;	
	$_SESSION['temp_page_fields']['img_2_id'] = $img_2_id;	
	$_SESSION['temp_page_fields']['img_3_id'] = $img_3_id;	
	
	$stmt = $db->prepare("UPDATE home
						SET
						top_1 = ?
						,top_2 = ?
						,top_3 = ?						
						,p_1_head = ?
						,p_1_text = ? 												
						,p_2_head = ?
						,p_2_text = ? 						
						,p_3_head = ?
						,p_3_text = ? 						
						,p_4_head = ?
						,p_4_text = ? 						
						,p_5_head = ?
						,p_5_text = ? 
						,p_6_head = ?
						,p_6_text = ? 
						,p_7_head = ?
						,p_7_text = ? 
						,p_8_head = ?  
						,p_8_text = ?								
						WHERE home_id = ?");
						
		//echo 'Error-1 UPDATE   '.$db->error;
		
	if(!$stmt->bind_param("sssssssssssssssssssi"
						,$top_1
						,$top_2
						,$top_3
						,$p_1_head
						,$p_1_text									
						,$p_2_head
						,$p_2_text									
						,$p_3_head
						,$p_3_text								
						,$p_4_head
						,$p_4_text							
						,$p_5_head
						,$p_5_text						
						,$p_6_head
						,$p_6_text						
						,$p_7_head
						,$p_7_text
						,$p_8_head  
						,$p_8_text
						,$_SESSION['home_id'])){
							
		echo 'Error-2 UPDATE   '.$db->error;
		
	}else{
		$stmt->execute();
		$stmt->close();				
		$msg = "Updated";
	}
	
}	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
$sql = "SELECT * 
		FROM home 
		WHERE home_id = '".$_SESSION['home_id']."'";
$result = $dbCustom->getResult($db,$sql);	

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_1_id = $object->img_1_id;
	$img_2_id = $object->img_2_id;
	$img_3_id = $object->img_3_id;
	$top_1 = $object->top_1;
	$top_2 = $object->top_2;
	$top_3 = $object->top_3;
	$p_1_head = $object->p_1_head;
	$p_1_text = $object->p_1_text;
	$p_2_head = $object->p_2_head;
	$p_2_text = $object->p_2_text;
	$p_3_head = $object->p_3_head; 
	$p_3_text = $object->p_3_text;
	$p_4_head = $object->p_4_head;
	$p_4_text = $object->p_4_text; 
	$p_5_head = $object->p_5_head;  
	$p_5_text = $object->p_5_text; 
	$p_6_head = $object->p_6_head;  
	$p_6_text = $object->p_6_text; 
	$p_7_head = $object->p_7_head;  
	$p_7_text = $object->p_7_text;
	$p_8_head = $object->p_8_head;  
	$p_8_text = $object->p_8_text;
		
}else{
	$img_1_id = 0;
	$img_2_id = 0;
	$img_3_id = 0;
	$top_1 = 'Designer closets up to 50% off';
	$top_2 = 'Our Pre-Assembly service reduces installation time to just 4-6 hours for a 10 x 10 closet';
	$top_3 = 'Perfect Fit Guarantee';
	$p_1_head = 'WHY CLOSETS TO GO';
	$p_1_text = 'We design every organizer based on your exact measurements and specifications; nothing is pre-made. We use only the finest wood panel products from Roseburg Forest Products Panolam, Flakeboard...';
	$p_2_head = 'YOU DESIGN';
	$p_2_text = 'Lorem ipsum dolor sit amet, consetetur gggggg  uuuuuu yyyyyyy...';
	$p_3_head = 'WE DESIGN'; 
	$p_3_text = 'dolor sit amet, consetetur zzzzz  xxxxxx  eeeeee';
	$p_4_head = 'CLOSETS TO GO - EASY PROCESS';
	$p_4_text = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit'; 
	$p_5_head = 'COMPANY';  
	$p_5_text = 'We manufacture all our closet organizers with top quality materials right here in the USA. And we\'ve been doing it nearly three decades.'; 
	$p_6_head = 'PRODUCTS';  
	$p_6_text = 'We design every organizer based on your exact measurements and specifications; nothing is pre-made. We use only the fin wood panel'; 
	$p_7_head = 'SERVICES';  
	$p_7_text = 'Our in-home consultations provide you with assistance measuring your space and determining your needs. From start to finish your designer is with you to answer questions and help maximize your space. Once your order is placed and manufactured, our installation team will call to schedule your';

	$p_8_head = 'CHOICES';  
	$p_8_text = '>>>>> For our valued customers around the country, we offer. All closet organizers installed by our company. Visit America’s largest closet organizer showroom wand design center to view a wide variety of organizers for your home or office. Located in Tigard, Oregon, it’s the perfect place to design';

}
	$_SESSION['temp_page_fields']['top_1'] = $top_1;	
	$_SESSION['temp_page_fields']['top_2'] = $top_2;	
	$_SESSION['temp_page_fields']['top_3'] = $top_3;	

	$_SESSION['temp_page_fields']['p_1_head'] = $p_1_head;	
	$_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;	

	$_SESSION['temp_page_fields']['p_2_head'] = $p_2_head;	
	$_SESSION['temp_page_fields']['p_2_text'] = $p_2_text;	

	$_SESSION['temp_page_fields']['p_3_head'] = $p_3_head;	
	$_SESSION['temp_page_fields']['p_3_text'] = $p_3_text;	

	$_SESSION['temp_page_fields']['p_4_head'] = $p_4_head;	
	$_SESSION['temp_page_fields']['p_4_text'] = $p_4_text;	

	$_SESSION['temp_page_fields']['p_5_head'] = $p_5_head;	
	$_SESSION['temp_page_fields']['p_5_text'] = $p_5_text;	

	$_SESSION['temp_page_fields']['p_6_head'] = $p_6_head;	
	$_SESSION['temp_page_fields']['p_6_text'] = $p_6_text;	

	$_SESSION['temp_page_fields']['p_7_head'] = $p_7_head;	
	$_SESSION['temp_page_fields']['p_7_text'] = $p_7_text;	

	$_SESSION['temp_page_fields']['p_8_head'] = $p_8_head;	
	$_SESSION['temp_page_fields']['p_8_text'] = $p_8_text;	

	$_SESSION['temp_page_fields']['img_1_id'] = $img_1_id;	
	$_SESSION['temp_page_fields']['img_2_id'] = $img_2_id;	
	$_SESSION['temp_page_fields']['img_3_id'] = $img_3_id;	



/*
if(!isset($_SESSION['temp_page_fields']['top_1'])) $_SESSION['temp_page_fields']['top_1'] = $top_1;	
if(!isset($_SESSION['temp_page_fields']['top_2'])) $_SESSION['temp_page_fields']['top_2'] = $top_2;	
if(!isset($_SESSION['temp_page_fields']['top_3'])) $_SESSION['temp_page_fields']['top_3'] = $top_3;	
if(!isset($_SESSION['temp_page_fields']['p_1_head'])) $_SESSION['temp_page_fields']['p_1_head'] = $p_1_head;	
if(!isset($_SESSION['temp_page_fields']['p_1_text'])) $_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;	
if(!isset($_SESSION['temp_page_fields']['p_2_head'])) $_SESSION['temp_page_fields']['p_2_head'] = $p_2_head;	
if(!isset($_SESSION['temp_page_fields']['p_2_text'])) $_SESSION['temp_page_fields']['p_2_text'] = $p_2_text;	
if(!isset($_SESSION['temp_page_fields']['p_3_head'])) $_SESSION['temp_page_fields']['p_3_head'] = $p_3_head;	
if(!isset($_SESSION['temp_page_fields']['p_3_text'])) $_SESSION['temp_page_fields']['p_3_text'] = $p_3_text;	
if(!isset($_SESSION['temp_page_fields']['p_4_head'])) $_SESSION['temp_page_fields']['p_4_head'] = $p_4_head;	
if(!isset($_SESSION['temp_page_fields']['p_4_text'])) $_SESSION['temp_page_fields']['p_4_text'] = $p_4_text;	
if(!isset($_SESSION['temp_page_fields']['p_5_head'])) $_SESSION['temp_page_fields']['p_5_head'] = $p_5_head;	
if(!isset($_SESSION['temp_page_fields']['p_5_text'])) $_SESSION['temp_page_fields']['p_5_text'] = $p_5_text;	
if(!isset($_SESSION['temp_page_fields']['p_6_head'])) $_SESSION['temp_page_fields']['p_6_head'] = $p_6_head;	
if(!isset($_SESSION['temp_page_fields']['p_6_text'])) $_SESSION['temp_page_fields']['p_6_text'] = $p_6_text;	
if(!isset($_SESSION['temp_page_fields']['p_7_head'])) $_SESSION['temp_page_fields']['p_7_head'] = $p_7_head;	
if(!isset($_SESSION['temp_page_fields']['p_7_text'])) $_SESSION['temp_page_fields']['p_7_text'] = $p_7_text;	
if(!isset($_SESSION['temp_page_fields']['p_8_head'])) $_SESSION['temp_page_fields']['p_8_head'] = $p_8_head;	
if(!isset($_SESSION['temp_page_fields']['p_8_text'])) $_SESSION['temp_page_fields']['p_8_text'] = $p_8_text;	
if(!isset($_SESSION['temp_page_fields']['img_1_id'])) $_SESSION['temp_page_fields']['img_1_id'] = $img_1_id;	
if(!isset($_SESSION['temp_page_fields']['img_2_id'])) $_SESSION['temp_page_fields']['img_2_id'] = $img_2_id;	
if(!isset($_SESSION['temp_page_fields']['img_3_id'])) $_SESSION['temp_page_fields']['img_3_id'] = $img_3_id;	
*/

	
$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$_SESSION['temp_page_fields']['img_1_id']."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_1_file_name = $img_obj->file_name;
}else{
	$img_1_file_name = '';
}	

$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$_SESSION['temp_page_fields']['img_2_id']."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_2_file_name = $img_obj->file_name;
}else{
	$img_2_file_name = '';
}	

$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$_SESSION['temp_page_fields']['img_3_id']."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_3_file_name = $img_obj->file_name;
}else{
	$img_3_file_name = '';
}	

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
<script>

tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});

$(document).ready(function() {
	$(".set_session").click(function(){
		//alert('set_session');	
		set_page_session();
	});	

	$(".fancybox").click(function(){
		//alert('fancybox');
		set_page_session();
	});	

});


function set_page_session(){

	var q_str = "?action=1"+get_query_str();
		
	//alert(q_str);
		
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

	query_str += "&content_short3="+escape(tinyMCE.get('content_short3').getContent());
	
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	
	query_str += "&p_right_head_content_type="+document.form.p_right_head_content_type.value; 

	query_str += "&p_right_head_text="+escape(tinyMCE.get('p_right_head_text').getContent());
	
	return query_str;
	
}

function validate(){
	
	return 1;

}


function regularSubmit() {
  
  if(validate() > 0){
	  document.form.action = "home.php?home_id=<?php echo $_SESSION['home_id']; ?>";
	  document.form.target = "_self"; 
	  document.form.submit();
  }
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


<!--

		
		<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_home" value="1">     

            <input type="hidden" name="home_id" value="<?php echo $_SESSION['home_id']; ?>">     

			

     		<div class="page_actions edit_page">
            	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
				<hr />
				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>
				
			<div class="colcontainer">                
				<label>top_1</label>
				<input type="text" name="top_1"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['top_1']); ?>">
                    
				<label>top_2</label>
				<input type="text" name="top_2"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['top_2']); ?>">

				<label>top_3</label>
				<input type="text" name="top_3"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['top_3']); ?>">


				<label>p_1_head</label>
				<input type="text" name="p_1_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_1_head']); ?>">
	<label>p_1_text</label>
	<textarea id="p_1_text" class="wysiwyg" name="p_1_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_1_text']); ?></textarea>
	
				<label>p_2_head</label>
				<input type="text" name="p_2_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_2_head']); ?>">
				
	<label>p_2_text</label>
	<textarea id="p_2_text" class="wysiwyg" name="p_2_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_2_text']); ?></textarea>

				<label>p_3_head</label>
				<input type="text" name="p_3_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_3_head']); ?>">
				
	<label>p_3_text</label>
	<textarea id="p_3_text" class="wysiwyg" name="p_3_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_3_text']); ?></textarea>
	
				<label>p_4_head</label>
				<input type="text" name="p_4_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_4_head']); ?>">

	<label>p_4_text</label>
	<textarea id="p_4_text" class="wysiwyg" name="p_4_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_4_text']); ?></textarea>

	
				<label>p_5_head</label>
				<input type="text" name="p_5_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_5_head']); ?>">
	<label>p_5_text</label>
	<textarea id="p_5_text" class="wysiwyg" name="p_5_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_5_text']); ?></textarea>

	
				<label>p_6_head</label>
				<input type="text" name="p_6_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_6_head']); ?>">
	<label>p_6_text</label>
	<textarea id="p_6_text" class="wysiwyg" name="p_6_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_6_text']); ?></textarea>

				<label>p_7_head</label>
				<input type="text" name="p_7_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_7_head']); ?>">
	<label>p_7_text</label>
	<textarea id="p_7_text" class="wysiwyg" name="p_7_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_7_text']); ?></textarea>


				<label>p_8_head</label>
				<input type="text" name="p_8_head"  style="width:520px" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['p_8_head']); ?>">

	<label>p_8_text</label>
	<textarea id="p_8_text" class="wysiwyg" name="p_8_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_8_text']); ?></textarea>
		
		
		<fieldset class="edit_content">
	

	<legend>Upper Right Sidebar Content <i class="icon-minus-sign icon-white"></i></legend>

						
			            
					<div class="colcontainer">
                        <div class="twocols">
							<label>Upper right heading image</label>
						</div>
                        <div class="twocols">


						<?php
						
					/*	
							$sql = "SELECT file_name  
									FROM image
									WHERE img_id = '".$_SESSION['img_2_id']."'";
									
					$result = $dbCustom->getResult($db,$sql);							
							if($result->num_rows > 0){
								$img_obj = $result->fetch_object();
								echo "<img width='200' src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."' />";
							}else{
								echo "no image";	
							}
					*/						
						?>

						<br /><br />
                        <!--  fancybox fancybox.iframe -->
                        <a  class='btn btn-primary set_session' 
                        href='<?php echo $ste_root; ?>/manage/upload-pre-crop.php?ret_page=home&ret_dir=cms/pages&img_type=2'>Upload new Image</a>		            

                        </div>
                        
                        
                        
                        
                        

                        
                        
					</fieldset>



			</div>


		</form>




	</div>
</div>


<!-- New Delete Dialogue -->
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this banner?</h3>
	<form name="del_banner" action="home.php" method="post" target="_top">
		<input id="del_banner_id" class="itemId" type="hidden" name="del_banner_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_banner" type="submit" >Yes, Delete</button>
	</form>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this submit button?</h3>
	<form name="del_submit_button" action="home.php" method="post" target="_top">
		<input id="del_submit_button_id" class="itemId2" type="hidden" name="del_submit_button_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_submit_button" type="submit" >Yes, Delete</button>
	</form>
</div>


<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
<!-- New Edit Dialogue 
<div id="content-edit" class="confirm-content">
	<form name="edit_faq_cat" action="faq-category.php" method="post" target="_top">
		<input id="faq_cat_id" type="hidden" class="itemId" name="faq_cat_id" value='' />
		<fieldset class="colcontainer">
			<label>Edit Banner</label>
			<input type="text" class="contentToEdit"  name="added_category" value=''>
		</fieldset>
		<a class="btn btn-large dismiss"> Cancel </a>
		<button name="edit_faq_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
	</form>
</div>
-->
	


</body>
</html>
