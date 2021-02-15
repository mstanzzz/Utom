<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'onlinecl/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){  
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site'; 
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Add: Keyword Landing Page";
$page_group = "keyword-landing";
$page = "keyword-landing";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();
$keyword_landing_id = (isset($_GET['keyword_landing_id'])) ? $_GET['keyword_landing_id'] : 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';



if(!isset($_SESSION['gal_img_id'])) $_SESSION['gal_img_id'] = 0;
if(!isset($_SESSION['img_type'])) $_SESSION['img_type'] = 0;


if($_SESSION['img_type'] == 'gallery' && $_SESSION['gal_img_id'] > 0){		
	if(!in_array($_SESSION['gal_img_id'],$_SESSION['temp_page_fields']['temp_gallery'])){
		$_SESSION['temp_page_fields']['temp_gallery'][count($_SESSION['temp_page_fields']['temp_gallery'])] = $_SESSION['gal_img_id'];
	}
}

$_SESSION['gal_img_id'] = 0;

if(isset($_GET['delgalleryimgid'])){
	$key = array_search($_GET['delgalleryimgid'],$_SESSION['temp_page_fields']['temp_gallery']);
	if($key!==false){
		unset($_SESSION['temp_page_fields']['temp_gallery'][$key]);
		$_SESSION['temp_page_fields']['temp_gallery'] = array_values($_SESSION['temp_page_fields']['temp_gallery']);
	}
}


if(isset($_POST['set_cat'])){
	$num_cat = $_POST['set_cat'];
	$_SESSION['temp_page_fields']['cat_'.$num_cat.'_id'] = (isset($_POST['cat_id'])) ? $_POST['cat_id'] : 0;
}


if(isset($_POST['add_tab'])){
	
	$tab_text = trim(addslashes($_POST['tab_text']));
	$content = trim(addslashes($_POST['content']));
	$indx = count($_SESSION['temp_page_fields']['temp_tabs']);
	
	$_SESSION['temp_page_fields']['temp_tabs'][$indx]['tab_text'] = $tab_text;
	$_SESSION['temp_page_fields']['temp_tabs'][$indx]['content'] = $content;
	$_SESSION['temp_page_fields']['temp_tabs'][$indx]['active'] = 1;
	$_SESSION['temp_page_fields']['temp_tabs'][$indx]['display_order'] = $indx;
}

if(isset($_POST['edit_tab'])){
	
	$tab_text = trim(addslashes($_POST['tab_text']));
	$content = trim(addslashes($_POST['content']));
	$indx = $_POST['indx'];

	$_SESSION['temp_page_fields']['temp_tabs'][$indx]['tab_text'] = $tab_text;
	$_SESSION['temp_page_fields']['temp_tabs'][$indx]['content'] = $content;

}


if(isset($_POST['del_tab'])){

	$indx = $_POST['del_tab_indx'];
	
	unset($_SESSION['temp_page_fields']['temp_tabs'][$indx]);
	$_SESSION['temp_page_fields']['temp_tabs'] = array_values($_SESSION['temp_page_fields']['temp_tabs']);

}


if(isset($_POST['add_doc'])){
	
	$doc_id = (isset($_POST['doc_id']))? $_POST['doc_id'] : 0;
	$name = (isset($_POST['name_'.$doc_id]))? $_POST['name_'.$doc_id] : '';
	$file_name = (isset($_POST['file_name_'.$doc_id]))? $_POST['file_name_'.$doc_id] : '';
	
	if($doc_id > 0){
		$indx = count($_SESSION['temp_page_fields']['temp_docs']);	
		$_SESSION['temp_page_fields']['temp_docs'][$indx]['doc_id'] = $doc_id;
		$_SESSION['temp_page_fields']['temp_docs'][$indx]['name'] = $name;
		$_SESSION['temp_page_fields']['temp_docs'][$indx]['file_name'] = $file_name;
	}
}


if(isset($_POST['add_video'])){
	
	$video_id = $_POST['video_id'];
	
	$sql = "SELECT youtube_id
				,name
			FROM video
			WHERE video_id = '".$video_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$obj = $result->fetch_object();				
		$indx = count($_SESSION['temp_page_fields']['temp_videos']);
		$_SESSION['temp_page_fields']['temp_videos'][$indx]['video_id'] = $video_id;
		$_SESSION['temp_page_fields']['temp_videos'][$indx]['youtube_id'] = $obj->youtube_id;
		$_SESSION['temp_page_fields']['temp_videos'][$indx]['name'] = $obj->name;
	}
}


if(isset($_GET['remove_video'])){
	foreach($_SESSION['temp_page_fields']['temp_videos'] as $key => $val){
		if($_GET['delvidid'] == $val['video_id']){
			unset($_SESSION['temp_page_fields']['temp_videos'][$key]);
			$_SESSION['temp_page_fields']['temp_videos'] = array_values($_SESSION['temp_page_fields']['temp_videos']);
		}
	}
}

if(isset($_GET['remove_doc'])){

	$doc_id = $_GET['doc_id'];
	foreach($_SESSION['temp_page_fields']['temp_docs'] as $key => $val){
		if($val['doc_id'] = $doc_id){
			unset($_SESSION['temp_page_fields']['temp_docs'][$key]);
			$_SESSION['temp_page_fields']['temp_docs'] = array_values($_SESSION['temp_page_fields']['temp_docs']);
		}
	}
	//print_r($_SESSION['temp_page_fields']['temp_docs']);
}


if(isset($_POST['set_active_and_display_order'])){
	
	$display_orders = $_POST['display_order'];

	$actives = (isset($_POST['active']))? $_POST['active'] : array();
	
	foreach($_SESSION['temp_page_fields']['temp_tabs'] as $k => $v){
		$_SESSION['temp_page_fields']['temp_tabs'][$k]['active'] = 0;
	}
	
	
	foreach($actives as $val){
		$_SESSION['temp_page_fields']['temp_tabs'][$val]['active'] = 1;
	}


	if(is_array($display_orders)){		
		foreach($display_orders as $key => $val){			
			$_SESSION['temp_page_fields']['temp_tabs'][$key]['display_order'] = $val;
		}		
	}
	
	$msg = "Changes Saved.";
}




if(!isset($_SESSION['temp_page_fields'])){
	
	//$_SESSION['temp_page_fields']['intro'] = '';
	$_SESSION['temp_page_fields']['main_img_id'] = 0;
	$_SESSION['temp_page_fields']['video_img_id'] = 0;
	$_SESSION['temp_page_fields']['start_design_img_id'] = 0;
	$_SESSION['temp_page_fields']['specs_img_id'] = 0;
	$_SESSION['temp_page_fields']['cat_1_id'] = 0;
	$_SESSION['temp_page_fields']['cat_2_id'] = 0;
	$_SESSION['temp_page_fields']['cat_3_id'] = 0;
	$_SESSION['temp_page_fields']['cat_4_id'] = 0;
	$_SESSION['temp_page_fields']['url_name'] = '';
	$_SESSION['temp_page_fields']['meta_title'] = '';
	$_SESSION['temp_page_fields']['meta_keywords'] = '';
	$_SESSION['temp_page_fields']['meta_description'] = '';
	$_SESSION['temp_page_fields']['videos_btn_text'] = '';
	$_SESSION['temp_page_fields']['design_btn_text'] = '';
	$_SESSION['temp_page_fields']['specs_btn_text'] = '';
	$_SESSION['temp_page_fields']['cat_1_btn_text'] = '';
	$_SESSION['temp_page_fields']['cat_2_btn_text'] = '';
	$_SESSION['temp_page_fields']['cat_3_btn_text'] = '';
	$_SESSION['temp_page_fields']['cat_4_btn_text'] = '';

	$_SESSION['temp_page_fields']['heading'] = '';
	$_SESSION['temp_page_fields']['sub_heading'] = '';
	
	$_SESSION['temp_page_fields']['description_tab_content'] = '';
	$_SESSION['temp_page_fields']['doc_tab_content'] = '';
	
	$_SESSION['temp_page_fields']['show_on_home_page'] = 0;
	
	$_SESSION['temp_page_fields']['temp_gallery'] = array();
	$_SESSION['temp_page_fields']['temp_tabs'] = array();
	$_SESSION['temp_page_fields']['temp_docs'] = array();
	$_SESSION['temp_page_fields']['temp_videos'] = array();
	
	
}

unset($_SESSION['ret_page']);
unset($_SESSION['ret_dir']);
unset($_SESSION['ret_path']);



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
	
	$('.upload').click(function(){		
		ajax_set_page_session();
	});
	
	$('.save_session').click(function(){		
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
	
	var q_str = "?page=keyword-landing"+get_query_str();
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: '../pages/ajax_set_page_session.php'+q_str,
	  success: function(data) {
			//alert(data);
	  }
	});
}

function get_query_str(){
	
	var query_str = '';
	
	query_str += "&heading="+document.form.heading.value; 
	query_str += "&sub_heading="+document.form.sub_heading.value; 
	
	
	query_str += "&url_name="+document.form.url_name.value;
	
	query_str += "&meta_title="+document.form.meta_title.value;
	query_str += "&meta_keywords="+document.form.meta_keywords.value;
	query_str += "&meta_description="+document.form.meta_description.value;
	query_str += "&videos_btn_text="+document.form.videos_btn_text.value;
	query_str += "&design_btn_text="+document.form.design_btn_text.value;
	query_str += "&specs_btn_text="+document.form.specs_btn_text.value;
	query_str += "&cat_1_btn_text="+document.form.cat_1_btn_text.value;
	query_str += "&cat_2_btn_text="+document.form.cat_2_btn_text.value; 
	query_str += "&cat_3_btn_text="+document.form.cat_3_btn_text.value;
	query_str += "&cat_4_btn_text="+document.form.cat_4_btn_text.value; 
	
	query_str += "&description_tab_content="+escape(tinyMCE.get('wysiwyg1').getContent());
	query_str += "&doc_tab_content="+escape(tinyMCE.get('wysiwyg2').getContent());
	
	query_str += (document.form.show_on_home_page.checked)? "&show_on_home_page=1" : "&show_on_home_page=0"; 
	
	
	//query_str += "&intro="+escape(tinyMCE.get('intro').getContent());	
	//query_str += "&description="+document.form.description.value.replace('&', '%26'); 
	
	return query_str;
}

function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
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
	
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add("About Us", '');
        echo $bread_crumb->output();
	
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        ?>
	
    
    <form name="form" action="keyword-landing-page-list.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="add_keyword_landing" value="1">        
		<input type="hidden" name="keyword_landing_id" value="<?php echo $_SESSION['keyword_landing_id']; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
		<input type="hidden" name="ret_page" value="edit-ketword-landing">
		<input type="hidden" name="ret_dir" value="manage/cms/pages">
		<input type="hidden" name="content_table" value="keyword_landing"> 
        
		<div class="page_actions edit_page"> 
            <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
            <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
            
            <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
            <i class="icon-eye-open icon-white"></i> Edit Navigation </a>
            
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
			<a href="keyword-landing-page-list.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>
    	<div class="page_content">
            <fieldset>
            	<legend> Headings </legend>
				<div class="colcontainer">
                    <label id="label_heading"> Heading </label>
                    <textarea id="input_heading" rows="3" name="heading"><?php echo $_SESSION['temp_page_fields']['heading']; ?></textarea> 
                    <div id="msg_heading">&nbsp;</div>   
                    <br />
                    <label id="label_sub_heading">Sub Heading </label>
                    <textarea id="input_sub_heading" rows="3" name="sub_heading"><?php echo $_SESSION['temp_page_fields']['sub_heading']; ?></textarea> 
                    <div id="msg_sub_heading">&nbsp;</div>
                    <br />
            	</div>
            </fieldset>
            
                       
            <fieldset>
            	<legend> Top Images </legend>
				<div class="colcontainer">
					<?php
					if($_SESSION['temp_page_fields']['main_img_id'] > 0){	

						$sql = "SELECT file_name FROM image
							WHERE img_id = '".$_SESSION['temp_page_fields']['main_img_id']."'";
						$img_res = $dbCustom->getResult($db,$sql);
						if($img_res->num_rows > 0){
							$img_obj = $img_res->fetch_object();
							$file_name = $img_obj->file_name;
						}else{
							$file_name = '';
						}
						echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$file_name."'>";
					}

					$url_str = $ste_root."manage/upload-pre-crop.php";               				
					$url_str .= "?ret_page=add-keyword-landing";
					$url_str .= "&ret_dir=keyword-landing";
					$url_str .= "&ret_path=cms/keyword-landing";
					$url_str .= "&img_type=main";

					?> 
                    
                    <div style="clear:both;"></div>
                    
                    <div class="twocols">
                        <a class="btn btn-large btn-primary upload" href="<?php echo $url_str; ?>">
                        <i class="icon-plus icon-white"></i> Upload New Main Image</a>
                    </div>
                    
                    <div style="clear:both;"></div>
                    
                    <?php       
					foreach($_SESSION['temp_page_fields']['temp_gallery'] as $val){
						$sql = "SELECT file_name FROM image
								WHERE img_id = '".$val."'";
						$img_res = $dbCustom->getResult($db,$sql);
						if($img_res->num_rows > 0){
							$img_obj = $img_res->fetch_object();
							$file_name = $img_obj->file_name;
							echo "<br />";
							echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$file_name."'>";			
							echo "<a href='add-keyword-landing.php?delgalleryimgid=".$val."#img' class='btn btn-small btn-danger'><i class='icon-remove icon-white'></i></a>";
							echo "<br />";
						}
					}

					$url_str = $ste_root."manage/upload-pre-crop.php";               				
					$url_str .= "?ret_page=add-keyword-landing";
					$url_str .= "&ret_dir=keyword-landing";
					$url_str .= "&ret_path=cms/keyword-landing";
					$url_str .= "&img_type=gallery";	
						
					?>
                    <br /><br />
                    </div>
                   	
                    <div class="colcontainer"> 
                       	<a class="btn btn-primary upload" href="<?php echo $url_str; ?>">
                       	<i class="icon-plus icon-white"></i> Upload New Gallery Image </a>
					</div>
                    <div style="clear:both;"></div>
            	</div>
            </fieldset>
            
            
                       
			<fieldset>
				<legend>Video Link Image </legend>
					<div class="colcontainer">
						<?php
						if($_SESSION['temp_page_fields']['video_img_id'] > 0){	
							$sql = "SELECT file_name FROM image
							WHERE img_id = '".$_SESSION['temp_page_fields']['video_img_id']."'";
							$img_res = $dbCustom->getResult($db,$sql);
							if($img_res->num_rows > 0){
								$img_obj = $img_res->fetch_object();
								$file_name = $img_obj->file_name;
							}else{
								$file_name = '';
							}
							echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$file_name."'>";
						}
						
						$url_str = $ste_root."manage/upload-pre-crop.php";               				
						$url_str .= "?ret_page=add-keyword-landing";
						$url_str .= "&ret_dir=keyword-landing";
						$url_str .= "&ret_path=cms/keyword-landing";
						$url_str .= "&img_type=video";
						?>
                        <div class="twocols">
                        <label id="label_videos_btn_text"> Videos Button Text </label>
                        <input style="width:300px;" type="text" id="input_videos_btn_text" name="videos_btn_text" value="<?php echo $_SESSION['temp_page_fields']['videos_btn_text']; ?>" />
                        <div id="msg_videos_btn_text">&nbsp;</div>
                    
                    </div>
                    <div class="colcontainer">
						<a class="btn btn-large btn-primary upload" href="<?php echo $url_str; ?>">
                        <i class="icon-plus icon-white"></i> Upload New Image For Videos</a>
                    </div>
                    <br /><br />
				</div> 
			</fieldset>                                           
			
            <fieldset>	
                <legend>Start Design Link Image </legend>
					<div class="colcontainer">
						<?php
						if($_SESSION['temp_page_fields']['start_design_img_id'] > 0){	

							$sql = "SELECT file_name FROM image
							WHERE img_id = '".$_SESSION['temp_page_fields']['start_design_img_id']."'";
							$img_res = $dbCustom->getResult($db,$sql);
							
							if($img_res->num_rows > 0){
								$img_obj = $img_res->fetch_object();
								$file_name = $img_obj->file_name;
							}else{
								$file_name = '';
							}

							echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$file_name."'>";
									
						}
						
						$url_str = $ste_root."manage/upload-pre-crop.php";               				
						$url_str .= "?ret_page=add-keyword-landing";
						$url_str .= "&ret_dir=keyword-landing";
						$url_str .= "&ret_path=cms/keyword-landing";
						$url_str .= "&img_type=start_design";
						
						
						?>
                    </div>    
					<div class="colcontainer">
                        <label id="label_design_btn_text"> Design Button Text </label>
                        <input style="width:300px;" type="text" id="input_design_btn_text" name="design_btn_text" value="<?php echo $_SESSION['temp_page_fields']['design_btn_text']; ?>" />
                        <div id="msg_design_btn_text">&nbsp;</div>
					</div>
                    <div class="colcontainer">
						<a class="btn btn-large btn-primary upload" href="<?php echo $url_str; ?>">
                        <i class="icon-plus icon-white"></i> Upload New Image For Start Design</a>
                    </div>
                    <br /><br />
				</fieldset>

				<legend>Specifications Link Image </legend>
					<div class="colcontainer">
						<?php
						if($_SESSION['temp_page_fields']['specs_img_id'] > 0){	

							$sql = "SELECT file_name FROM image
							WHERE img_id = '".$_SESSION['temp_page_fields']['specs_img_id']."'";
							$img_res = $dbCustom->getResult($db,$sql);
							
							if($img_res->num_rows > 0){
								$img_obj = $img_res->fetch_object();
								$file_name = $img_obj->file_name;
							}else{
								$file_name = '';
							}

							echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$file_name."'>";
									
						}
						
						$url_str = $ste_root."manage/upload-pre-crop.php";               				
						$url_str .= "?ret_page=add-keyword-landing";
						$url_str .= "&ret_dir=keyword-landing";
						$url_str .= "&ret_path=cms/keyword-landing";
						$url_str .= "&img_type=specs";
						
						
						?>
                        
					</div>                        
                        
					<div class="colcontainer">
    					<label id="label_specs_btn_text"> Specs Button Text </label>
                        <input style="width:300px;" type="text" id="input_specs_btn_text" name="specs_btn_text" value="<?php echo $_SESSION['temp_page_fields']['specs_btn_text']; ?>" />
                        <div id="msg_specs_btn_text">&nbsp;</div>
                        
					</div>
                    
                    <div class="colcontainer">
                        <div class="twocols">
                            <!--  fancybox fancybox.iframe -->
                            <a class="btn btn-large btn-primary upload" href="<?php echo $url_str; ?>">
                            <i class="icon-plus icon-white"></i> Upload New Image For Specifications</a>
                        </div>
                    </div>
                    
                    <br /><br />
				</fieldset>


			<fieldset>
				<legend>Category 1</legend>
				<div class="colcontainer">
                    <?php
					$db = $dbCustom->getDbConnect(CART_DATABASE);	
					$sql = "SELECT category.name
									,image.file_name 
							FROM category, image 
							WHERE category.img_id = image.img_id
							AND category.cat_id = '".$_SESSION['temp_page_fields']['cat_1_id']."'";
					$result = $dbCustom->getResult($db,$sql);			
					if($result->num_rows > 0){
						$object = $result->fetch_object();						
						$file_name = $object->file_name;
						$name = $object->name; 	
					}else{
						$file_name = '';
						$name = ''; 							
					}
					
					echo "<label>Category 1</label>";
					echo $name;
					echo "<br/>";
					echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$file_name."' >";
					echo "<br/>";
                    
					$url_str = $ste_root."manage/cms/radio-all-cats.php";
					$url_str .= '?ret_page=add-keyword-landing';
					$url_str .= "&ret_dir=keyword-landing";
					$url_str .= "&ret_path=cms/keyword-landing";
					$url_str .= '&num_cat=1';
					
					?>
				</div>                    
				<div class="colcontainer">
                	<label id="label_cat_1_btn_text"> Cat 1 Button Text </label>
                        <input style="width:300px;" type="text" id="input_cat_1_btn_text" name="cat_1_btn_text" value="<?php echo $_SESSION['temp_page_fields']['cat_1_btn_text']; ?>" />
                        <div id="msg_cat_1_btn_text">&nbsp;</div>
				</div>
                <div style="clear:both;"></div>
                <div class="colcontainer">    
                <a class="btn btn-large btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>" > Select Category 1</a> 
                </div>
                <br /><br />
            </fieldset>
            
			<fieldset>
				<legend>Category 2</legend>
				<div class="colcontainer">
                    <?php
						
					$sql = "SELECT category.name
									,image.file_name 
							FROM category, image 
							WHERE category.img_id = image.img_id
							AND category.cat_id = '".$_SESSION['temp_page_fields']['cat_2_id']."'";
					$result = $dbCustom->getResult($db,$sql);			
					if($result->num_rows > 0){
						$object = $result->fetch_object();						
						$file_name = $object->file_name;
						$name = $object->name; 	
					}else{
						$file_name = '';
						$name = ''; 							
					}
					
					echo "<label>Category 2</label>";
					echo $name;
					echo "<br/>";
					echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$file_name."' >";
					echo "<br/>";
                    
					$url_str = $ste_root."manage/cms/radio-all-cats.php";
					$url_str .= '?ret_page=add-keyword-landing';
					$url_str .= "&ret_dir=keyword-landing";
					$url_str .= "&ret_path=cms/keyword-landing";
					$url_str .= '&num_cat=2';
					
					?>
				</div>
				<div class="colcontainer">
                	<label id="label_cat_2_btn_text"> Cat 2 Button Text </label>
                        <input style="width:300px;" type="text" id="input_cat_2_btn_text" name="cat_2_btn_text" value="<?php echo $_SESSION['temp_page_fields']['cat_2_btn_text']; ?>" />
                        <div id="msg_cat_2_btn_text">&nbsp;</div>
				</div>
                
                <div style="clear:both;"></div>
					
                <div class="colcontainer">
                 	<a class="btn btn-large btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>" > Select Category 2</a> 
                </div>
                
                <br /><br />
            </fieldset>
            
			<fieldset>
				<legend>Category 3</legend>
				<div class="colcontainer">
                    <?php
						
					$sql = "SELECT category.name
									,image.file_name 
							FROM category, image 
							WHERE category.img_id = image.img_id
							AND category.cat_id = '".$_SESSION['temp_page_fields']['cat_3_id']."'";
					$result = $dbCustom->getResult($db,$sql);			
					if($result->num_rows > 0){
						$object = $result->fetch_object();						
						$file_name = $object->file_name;
						$name = $object->name; 	
					}else{
						$file_name = '';
						$name = ''; 							
					}
					
					echo "<label>Category 3</label>";
					echo $name;
					echo "<br/>";
					echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$file_name."' >";
					echo "<br/>";
                    
					$url_str = $ste_root."manage/cms/radio-all-cats.php";
					$url_str .= '?ret_page=add-keyword-landing';
					$url_str .= "&ret_dir=keyword-landing";
					$url_str .= "&ret_path=cms/keyword-landing";
					$url_str .= '&num_cat=3';
					
					?>
                    
                </div>    
				<div class="colcontainer">
					<label id="label_cat_3_btn_text"> Cat 3 Button Text </label>
                     <input style="width:300px;" type="text" id="input_cat_3_btn_text" name="cat_3_btn_text" value="<?php echo $_SESSION['temp_page_fields']['cat_3_btn_text']; ?>" />
                     <div id="msg_cat_3_btn_text">&nbsp;</div>
				</div>
                <div style="clear:both;"></div>

                <div class="colcontainer">    
                    <a class="btn btn-large btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>" > Select Category 3</a> 
                </div>
                <br /><br />
            </fieldset>
  
 			<fieldset>
				<legend>Category 4</legend>
				<div class="colcontainer">
                    <?php
						
					$sql = "SELECT category.name
									,image.file_name 
							FROM category, image 
							WHERE category.img_id = image.img_id
							AND category.cat_id = '".$_SESSION['temp_page_fields']['cat_4_id']."'";
					$result = $dbCustom->getResult($db,$sql);			
					if($result->num_rows > 0){
						$object = $result->fetch_object();						
						$file_name = $object->file_name;
						$name = $object->name; 	
					}else{
						$file_name = '';
						$name = ''; 							
					}
					
					echo "<label>Category 4</label>";
					echo $name;
					echo "<br/>";
					echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$file_name."' >";
					echo "<br/>";
                    
					$url_str = $ste_root."manage/cms/radio-all-cats.php";
					$url_str .= '?ret_page=add-keyword-landing';
					$url_str .= "&ret_dir=keyword-landing";
					$url_str .= "&ret_path=cms/keyword-landing";
					$url_str .= '&num_cat=4';
					
					?>
				</div>
                <div class="colcontainer">
					<label id="label_cat_4_btn_text"> Cat 4 Button Text </label>
                        <input style="width:300px;" type="text" id="input_cat_4_btn_text" name="cat_4_btn_text" value="<?php echo $_SESSION['temp_page_fields']['cat_4_btn_text']; ?>" />
                        <div id="msg_cat_4_btn_text">&nbsp;</div>
				</div>
				<div style="clear:both;"></div>

				<div class="colcontainer">
                    <a class="btn btn-large btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>" > Select Category 4</a> 
                </div>
                <br /><br />
            </fieldset>

            <fieldset>
				<legend>SEO</legend>
            	<div class="colcontainer">
                    <div class="colcontainer formcols">
                        <div class="twocols">
                            <label>URL Page Name</label>
                        </div>
                        <div class="twocols">
                            <input id="url_name" type="text" name="url_name" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['url_name']); ?>" />
                        </div>
                    </div>
                
                    <div class="colcontainer formcols">
                        <div class="twocols">
                            <label>Meta Title</label>
                        </div>
                        <div class="twocols">
                            <input id="meta_title" type="text" name="meta_title" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['meta_title']); ?>" />
                        </div>
                    </div>

                    <div class="colcontainer formcols">
                        <div class="twocols">
                            <label>Meta Keywords</label>
                        </div>
                        <div class="twocols">
                            <textarea id="meta_keywords" name="meta_keywords" cols="20" rows="6"><?php echo prepFormInputStr($_SESSION['temp_page_fields']['meta_keywords']); ?></textarea>
                        </div>
                    </div>
                
                    <div class="colcontainer formcols">
                        <div class="twocols">
                            <label>Meta Description</label>
                        </div>
                        <div class="twocols">
                            <textarea id="meta_description" name="meta_description" cols="20" rows="6"><?php echo prepFormInputStr($_SESSION['temp_page_fields']['meta_description']); ?></textarea>
                        </div>
                    </div>
            	</div>
            </fieldset>


		<a id="doc"></a>
			<fieldset>

            	<legend> Fixed Tabs </legend>
				<div class="colcontainer">       
	                
                    <label>Description</label>
                    <textarea class="wysiwyg" id="wysiwyg1" name="description_tab_content" style="width:800px!important; height:500px!important;"><?php echo stripslashes($_SESSION['temp_page_fields']['description']); ?></textarea>

					<br /><br />

                    <label>Document Area Text</label>
                    <textarea class="wysiwyg" id="wysiwyg2" name="doc_tab_content" style="width:800px!important; height:300px!important;"><?php echo stripslashes($_SESSION['temp_page_fields']['doc_tab_content']); ?></textarea>
    
                </div> 
                
                <br/>
                
                <?php
				
				$url_str = $ste_root."manage/cms/select-doc.php";
					$url_str .= '?ret_page=add-keyword-landing';
					$url_str .= "&ret_dir=keyword-landing";
					$url_str .= "&ret_path=cms/keyword-landing";
					
				
				?>
                
                <br /><br />
                <label>Documents</label>
                
                <a href="<?php echo $url_str; ?>" 
                class="btn btn-primary upload"><i class="icon-plus icon-white"></i> Select or Add Document </a>
                
                <br />
                
                <div class="colcontainer">
                    <div class="data_table">
                    
                    <table cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="25%">Document Name</th>
                                <th width="40%">File Name</th>
                                <th width="5%">Remove</th>
                            </tr>
                        </thead>
                        <?php
                        foreach($_SESSION['temp_page_fields']['temp_docs'] as $val) {
                            $block = "<tr>";
                            //label
                            $block .= "<td valign='middle'>".$val['name']."</td>";
                            //file name
                            $block .= "<td valign='middle'><a href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/doc/".$val['file_name']."' 
                                target='_blank' style='text-decoration:none'>".$val['file_name']."</a></td>";
                            
                            $block .= "<td valign='middle'><a class='btn btn-danger save_session' href='add-keyword-landing.php?remove_doc=1&doc_id=".$val['doc_id']."#doc'>";						
                            $block .= "<i class='icon-remove icon-white'></i>Remove</a></td>";
                            
                            $block .= "</tr>";
                            
                            echo $block;
                    
                        }
                        
                        
                        ?>
                </table>
                <br /><br />
                
                </div>
			</div>

			</fieldset>

            <fieldset class="edit_videos">
                <legend>Show on Home Page </legend>
                <div class="colcontainer">
					<div class="checkboxtoggle on"> <span class="ontext">ON</span>
                    <a class="switch on" ></a><span class="offtext">OFF</span>
                    <input type="checkbox" class="checkboxinput" name="show_on_home_page" value="1" 
					<?php if($_SESSION['temp_page_fields']['show_on_home_page']) echo "checked='checked'"; ?>/>
                    </div>
				</div>
			</fieldset>

		</form>	
		
        
        <fieldset>
          
        	<legend> Custom Tabs </legend>
	            <div class="colcontainer"> 
                	<br />
               
					<a class='btn btn-primary btn-small fancybox fancybox.iframe' 
					href='add-tab.php?ret_page=add-keyword-landing'> Add Tab </a>
				
                	<br />
                
               	 	<form  name="tabs_form" action="add-keyword-landing.php" method="post" enctype="multipart/form-data" >	           
						<input type="hidden" name="set_active_and_display_order" value="1">
                    
                    	<table cellpadding="10" cellspacing="0">
						<thead>
							<tr>
								<th>Text</th>
								<th>Active</th>
                                <th>Order</th>
								<th width="12%">Edit</th>
								<th width="5%">Delete</th>
							</tr>
						</thead>
						
						<?php
						
						
						$block = "<tr>";
						foreach($_SESSION['temp_page_fields']['temp_tabs'] as $key => $val){
									
							$block .= "<td valign='top'>".stripslashes($val['tab_text'])."</td>";	
									
							$active = ($val['active']) ? "checked='checked'" : '';
										
							$block .= "<td valign='middle' >
									<div class='checkboxtoggle on'> 
									<span class='ontext'>ON</span><a class='switch on' href='#'></a>
									<span class='offtext'>OFF</span>
									<input type='checkbox' class='checkboxinput' name='active[]' value='".$key."' $active  /></div></td>";	


							$block .= "<td valign='middle'>
									<input type='text' name='display_order[]' value='".$val['display_order']."'/></td>";

							$block .= "<td valign='top'>
									<a class='btn btn-primary btn-small fancybox fancybox.iframe' 
									href='edit-tab.php?indx=".$key."&ret_page=add-keyword-landing'><i class='icon-cog icon-white'></i> Edit</a></div></td>";
									
							$block .= "<td valign='middle'>
									<a class='btn btn-danger btn-small confirm'>
									<i class='icon-remove icon-white'></i>
									<input type='hidden' id='".$key."' class='itemId' value='".$key."' /></a></td>";		
									
							$block .= "</tr>";
						}
						echo $block;
						?>
                            
                            
					</table>
            		<button class="btn btn-small btn-success" name="btn" type="submit"> Update Tabs</button>
				</form>
            </div>				
		</fieldset>           

	<a id="vid"></a>
		<fieldset class="edit_videos" id="product_videos">
			<legend>Videos <i class="icon-minus-sign icon-white"></i></legend>
            <div class="colcontainer">
                <?php
				
				$url_str = $ste_root."manage/cms/select-video.php";
					$url_str .= '?ret_page=add-keyword-landing';
					$url_str .= "&ret_dir=keyword-landing";
					$url_str .= "&ret_path=cms/keyword-landing";
				?>
                
                <br /><br />
                <label>Videos</label>
                
                <a href="<?php echo $url_str; ?>" 
                class="btn btn-primary upload"><i class="icon-plus icon-white"></i> Select or Add Video </a>
                
                <br />

            
            	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="30%">Placeholder</th>							
							<th width="30%">Name</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$block = '';       
					foreach($_SESSION['temp_page_fields']['temp_videos'] as $val){						
						$block .= "<tr>";

						$block .= "<td><img width='160' height='160'  src='http://img.youtube.com/vi/".$val['youtube_id']."/0.jpg' /></td>";
						
						$block .= "<td>".stripslashes($val['name'])."</td>";
						
						$block .= "<td><a href='add-keyword-landing.php?remove_video=1&delvidid=".$val['video_id']."#vid' class='btn btn-small btn-danger'><i class='icon-remove icon-white'></i></a></td>";
						
						$block .= "</tr>";
					}

					echo $block;						
					?>
					</tbody>
				</table>
				</div>
                    
			</fieldset>

		</div>


<p style="height:100px;" ></p>

</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>


<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this tab?</h3>
	<form name="del_tab" action="edit-keyword-landing.php" method="post" >
		<input id="del_tab_indx" class="itemId" type="hidden" name="del_tab_indx" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_tab" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>