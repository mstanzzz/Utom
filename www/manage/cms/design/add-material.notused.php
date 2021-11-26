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


require_once($real_root.'/manage/admin-includes/manage-includes.php');

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$progress = new SetupProgress;
$module = new Module;

$page_title = 'Edit material';
$page_group = 'cat';

	


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;



$ret_page =  (isset($_GET['ret_page'])) ? $_GET['ret_page'] : "category";
if($ret_page == '') $ret_page = "category";

$strip =  (isset($_GET['strip'])) ? $_GET['strip'] : 0;
if(!isset($_SESSION['strip'])) $_SESSION['strip'] = $strip;

$search_str = (isset($_GET['search_str'])) ? addslashes($_GET['search_str']) : ''; 
if(!isset($_SESSION['search_str'])) $_SESSION['search_str'] = $search_str;


$this_material_id = (isset($_GET['material_id'])) ? $_GET['material_id'] : 0; 
if(!isset($_SESSION['material_id'])) $_SESSION['material_id'] = $this_material_id;




if(!isset($_SESSION['temp_fields']['material_name'])) $_SESSION['temp_fields']['material_name'] = '';

if(!isset($_SESSION['temp_fields']['tier_id'])) $_SESSION['temp_fields']['tier_id'] = 0;

if(!isset($_SESSION['temp_fields']['material_type_id'])) $_SESSION['temp_fields']['material_type_id'] = 0;

if(!isset($_SESSION['temp_fields']['mat_image'])) $_SESSION['temp_fields']['mat_image'] = '';

if(!isset($_SESSION['temp_fields']['mat_color'])) $_SESSION['temp_fields']['mat_color'] = '';

if(!isset($_SESSION['temp_fields']['mat_alpha'])) $_SESSION['temp_fields']['mat_alpha'] = '';




require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>


$(document).ready(function() {
	
	$("#copy_attr").click(function(e){
		e.preventDefault();
		var q_str = "?action=2"+get_query_str();
		//alert(q_str);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_cat_session.php'+q_str,
		  success: function(data) {			
			
			//alert(data);
			
			location.href = "edit.php?copy_attr=1"; 
		  }
		});		
	});


	$("#upload_pre_crop").click(function(e){
		
		var q_str = "?action=2"+get_query_str();
		//alert(q_str);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_cat_session.php'+q_str,
		  success: function(data) {			
			//alert(data);
		  }
		});		
	});


	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 1060	
	});	

});


function get_query_str(){
	
//name, tool_tip, show_on_home_page, restricted_attributes[]	
	var query_str = '';
	var attr_str = '';
	var cat_str = '';

	query_str += "&name="+document.edit_cat.name.value;
	query_str += "&short_name="+document.edit_cat.short_name.value;
	query_str += "&tool_tip="+document.edit_cat.tool_tip.value; 
	query_str += "&description="+document.edit_cat.description.value; 	

	query_str += "&img_alt_text="+document.edit_cat.img_alt_text.value; 
	query_str += "&key_words="+document.edit_cat.key_words.value;

	query_str += (document.edit_cat.show_on_home_page.checked)? "&show_on_home_page=1" : "&show_on_home_page=0"; 
	query_str += (document.edit_cat.show_in_cart.checked)? "&show_in_cart=1" : "&show_in_cart=0"; 
	query_str += (document.edit_cat.show_in_showroom.checked)? "&show_in_showroom=1" : "&show_in_showroom=0"; 

	attr_str = $("#r_attr option:selected").map(function(){ return this.value }).get().join("|");
	//alert(attr_str);	 
	query_str += "&attr_str="+attr_str; 

	cat_str = $("#cats option:selected").map(function(){ return this.value }).get().join("|");
	query_str += "&cat_str="+cat_str; 

	//alert(query_str); 	
	return query_str;
}

function validate(theform){	

	/*
	if (theform.elements['chosen_categories[]'].selectedIndex == -1) {
	  alert("Please select parent categoty.");
	}
	*/
		
	var name = jQuery.trim(theform.name.value);
	if(name == ''){
		alert("Please enter category name");
		return false;				
	}

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
	content_css : "<?php echo SITEROOT; ?>/../css/mce.css"
	});


/*
function goto_isfancybox(url, save_session){

	if (window.top.location != window.location) {
		url+="&fromfancybox=1";
	}

	if(save_session){
		
		q_str = "?action=2"+get_query_str();
		
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_cat_session.php'+q_str,
		  success: function(data) {
			location.href = url;
		  }
		});
	}else{
		location.href = url;		
	}

}

*/	
	
</script>
</head>
<body>
<?php
if(!$strip){ 
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');

}
?>
<div class="manage_page_container <?php if($strip){ echo "lightbox"; }?>">
	<div class="manage_side_nav">
		<?php
		if(!$strip){  
        	require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
    
    
    
    	<?php 
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add('Edit Material '.$material_name, '');
		echo $bread_crumb->output();

        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		$url_str = "tool.php";
		$url_str .= "?material_id=".$material_id;
		$url_str .= "&strip=".$_SESSION['strip'];		
		$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
		$url_str .= "&search_str=".$_SESSION['search_str'];


		?>
		<form name="edit_material" action="<?php echo $url_str;  ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data">
		  	<input id="cat_id" type="hidden" name="cat_id" value="<?php echo $_SESSION['cat_id'];  ?>" />
		  	<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
			<input type="hidden" name="edit_cat" value="1" />	
            
            <div class="page_actions edit_page">
            	<?php if($admin_access->product_catalog_level > 1){ ?> 
					<button class="btn btn-large btn-success" name='edit_cat' type='submit'><i class="icon-ok icon-white"></i> Save Changes</button>
				<?php }else{ ?>
        			<div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        		<?php } ?>		
                <hr />
				<a class="btn btn-primary toggleFieldsets" href="#"><i class="icon-minus-sign icon-white icon-white"></i> Collapse All Edit Areas </a><br />
				<a href="<?php echo $url_str; ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a>

			</div>
			<div class="page_content edit_page">
			
            <fieldset>
				<legend>Material Details<i class="icon-minus-sign icon-white"></i></legend>


				<div class="colcontainer">
				<label>Material Name</label>
				<input style="width:600px;" name="material_name" type="text" value="<?php echo stripslashes($_SESSION['temp_fields']['material_name']); ?>" />
				</div>                

				<div class="colcontainer">
				<label>Material Name</label>
				<input style="width:600px;" name="mat_color" type="text" value="<?php echo stripslashes($_SESSION['temp_fields']['mat_color']); ?>" />
				</div>                

				<div class="colcontainer">
				<label>Material Name</label>
				<input style="width:600px;" name="mat_alpha" type="text" value="<?php echo stripslashes($_SESSION['temp_fields']['mat_alpha']); ?>" />
				</div>                



			</fieldset>





        
        </div>
    </form>
    
	
  </div>
 <p class="clear"></p>
    <?php
	if(!$strip){  
    	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	}
	?>
</div>
</body>
</html>

