<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Category";
$page_group = "cat";

	

if(isset($_GET['firstload'])){
	unset($_SESSION['temp_cat_fields']);
	unset($_SESSION['temp_attr_ids']);
	unset($_SESSION['temp_cats']);
	unset($_SESSION['cat_id']);	
	unset($_SESSION['img_id']);
}

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$this_parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
if(!isset($_SESSION['parent_cat_id'])) $_SESSION['parent_cat_id'] = $this_parent_cat_id*1;

$this_cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $this_cat_id*1;

$ret_page =  (isset($_GET['ret_page'])) ? $_GET['ret_page'] : "category";
if($ret_page == '') $ret_page = "category";

$strip =  (isset($_GET['strip'])) ? $_GET['strip'] : 0;
if(!isset($_SESSION['strip'])) $_SESSION['strip'] = $strip;

$search_str = (isset($_GET['search_str'])) ? addslashes($_GET['search_str']) : ''; 
if(!isset($_SESSION['search_str'])) $_SESSION['search_str'] = $search_str;

if(!isset($_SESSION['temp_attr_ids'])) $_SESSION['temp_attr_ids'] = getCatAttrArray($_SESSION['cat_id']);

if(!isset($_SESSION['temp_cats'])) $_SESSION['temp_cats'] = getCatParentCats($_SESSION['cat_id']);

if(isset($_GET['copy_attr'])){
	
	$attr_array = array();	
	$i = 0;
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	foreach($_SESSION['temp_cats'] as $cat_v){
			
		$sql = "SELECT attribute_id 
				FROM category_to_attr 
				WHERE cat_id = '".$cat_v['cat_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		while($row = $result->fetch_object()) {
			$attr_array[$i] = $row->attribute_id;
			$i++;
		}
	}
	
	$_SESSION['temp_attr_ids'] = $attr_array;
}
	

$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = sprintf("SELECT * FROM category WHERE cat_id = '%u'", $_SESSION['cat_id']);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name;
	$short_name = $object->short_name;
	$tool_tip = $object->tool_tip;
	$description = $object->description;
	$show_on_home_page = $object->show_on_home_page;
	$show_in_cart = $object->show_in_cart;
	$show_in_showroom = $object->show_in_showroom;
	$img_id = $object->img_id;
	$img_alt_text = $object->img_alt_text;
	$key_words = $object->key_words;
	$profile_cat_id = $object->profile_cat_id;
	$showroom_item_display_priority = $object->showroom_item_display_priority;

}else{
	$name = '';
	$short_name = '';
	$tool_tip = '';
	$description = '';
	$show_on_home_page = 0;
	$show_in_cart = 1;
	$show_in_showroom = 0;
	$img_id	= 0;
	$img_alt_text = '';
	$key_words = '';
	$profile_cat_id = 0;
	$showroom_item_display_priority = 1;
}

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $img_id;	
if(!isset($_SESSION['temp_cat_fields']['name'])) $_SESSION['temp_cat_fields']['name'] = $name;
if(!isset($_SESSION['temp_cat_fields']['short_name'])) $_SESSION['temp_cat_fields']['short_name'] = $short_name;
if(!isset($_SESSION['temp_cat_fields']['tool_tip'])) $_SESSION['temp_cat_fields']['tool_tip'] = $tool_tip;	
if(!isset($_SESSION['temp_cat_fields']['description'])) $_SESSION['temp_cat_fields']['description'] = $description;	
if(!isset($_SESSION['temp_cat_fields']['show_on_home_page'])) $_SESSION['temp_cat_fields']['show_on_home_page'] = $show_on_home_page;	
if(!isset($_SESSION['temp_cat_fields']['show_in_cart'])) $_SESSION['temp_cat_fields']['show_in_cart'] = $show_in_cart;	
if(!isset($_SESSION['temp_cat_fields']['show_in_showroom'])) $_SESSION['temp_cat_fields']['show_in_showroom'] = $show_in_showroom;	
if(!isset($_SESSION['temp_cat_fields']['img_alt_text'])) $_SESSION['temp_cat_fields']['img_alt_text'] = $img_alt_text;	
if(!isset($_SESSION['temp_cat_fields']['key_words'])) $_SESSION['temp_cat_fields']['key_words'] = $key_words;
if(!isset($_SESSION['temp_cat_fields']['profile_cat_id'])) $_SESSION['temp_cat_fields']['profile_cat_id'] = $profile_cat_id;
if(!isset($_SESSION['temp_cat_fields']['showroom_item_display_priority'])) $_SESSION['temp_cat_fields']['showroom_item_display_priority'] = $showroom_item_display_priority;

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

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
			
			location.href = "edit-category.php?copy_attr=1"; 
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

/*
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 1060	
	});
*/		

});


function get_query_str(){
	
//name, tool_tip, show_on_home_page, restricted_attributes[]	
	var query_str = '';
	var attr_str = '';
	var cat_str = '';

	query_str += "&name="+document.edit_cat.name.value.replace('&', '%26');
	query_str += "&short_name="+document.edit_cat.short_name.value.replace('&', '%26');
	query_str += "&tool_tip="+document.edit_cat.tool_tip.value.replace('&', '%26');
	//query_str += "&description="+document.edit_cat.description.value; 	
	query_str += "&description="+escape(tinyMCE.get('wysiwyg1').getContent());

	query_str += "&img_alt_text="+document.edit_cat.img_alt_text.value.replace('&', '%26');
	query_str += "&key_words="+document.edit_cat.key_words.value.replace('&', '%26');

	query_str += (document.edit_cat.show_on_home_page.checked)? "&show_on_home_page=1" : "&show_on_home_page=0"; 
	query_str += (document.edit_cat.show_in_cart.checked)? "&show_in_cart=1" : "&show_in_cart=0"; 
	query_str += (document.edit_cat.show_in_showroom.checked)? "&show_in_showroom=1" : "&show_in_showroom=0"; 
	
	query_str += (document.edit_cat.showroom_item_display_priority.checked)? "&showroom_item_display_priority=1" : "&showroom_item_display_priority=0"; 
	

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
	content_css : "../../../css/mce.css"
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
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');

}
?>
<div class="manage_page_container <?php if($strip){ echo "lightbox"; }?>">
	<div class="manage_side_nav">
		<?php
		if(!$strip){  
        	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
    
    	<?php 
		echo "cat_id ".$_SESSION['cat_id'];
		echo "<br />";
		echo "id on URL:  ".$_SESSION['temp_cat_fields']['profile_cat_id'];

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
        $url_str = $ste_root."manage/catalog/categories/category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);

		$url_str .= "?parent_cat_id=".$_SESSION['parent_cat_id'];
		$url_str .= "&strip=".$_SESSION['strip'];		
		$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
		$url_str .= "&search_str=".$_SESSION['search_str'];


		?>
		<form name="edit_cat" action="<?php echo $url_str;  ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data">
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
				
                <?php if(!$_SESSION['strip']){ ?>
                <a class="btn btn-primary toggleFieldsets" href="#"><i class="icon-minus-sign icon-white icon-white"></i> Collapse All Edit Areas </a><br />
                <?php } ?>
                
				<a href="<?php echo $url_str; ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a>

			</div>
			<div class="page_content edit_page">
			
            <fieldset>
            	<?php if(!$_SESSION['strip']){ ?>
				<legend>Change Image<i class="icon-minus-sign icon-white"></i></legend>
                <?php } ?>
                <div class="colcontainer">

					<?php 
				$_SESSION['crop_n'] = 1;
				$_SESSION['img_type'] = 'cart';
				
				
					

                    $url_str = "../../upload-pre-crop.php";
					$url_str = preg_replace('/(\/+)/','/',$url_str);

		echo "<br />";
		//echo $url_str;
		echo "<br />";
		echo "<br />";
		
		//exit;					
					
					
                    $url_str .= "?ret_page=edit-category";
                    $url_str .= "&ret_path=catalog/categories";
					?>
                    <!--  fancybox fancybox.iframe -->
                    <div style="float:left;">
                    <a id="upload_pre_crop" class="btn btn-primary" href="<?php echo $url_str; ?>"><i class="icon-plus icon-white"></i>Upload new Image</a>
                    </div>
                    
                    <?php
                        $url_str = $ste_root."manage/catalog/select-image.php"; 
       $url_str = preg_replace('/(\/+)/','/',$url_str);


                        $url_str .= "?ret_page=edit-category";
                        $url_str .= "&ret_dir=categories";
                            
                    ?>                    
                            
                    <div style="float:left; margin-left:10%;">                        
                    <a class="btn btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>"><i class="icon-plus icon-white"></i> Select new Image </a>
                    </div>
                    
                    	<?php 
							$url_str = $ste_root."manage/catalog/select-image.php";
		$url_str = preg_replace('/(\/+)/','/',$url_str);
		
							$url_str .= "?ret_page=edit-category";
							$url_str .= "&parent_cat_id=".$_SESSION['parent_cat_id'];
							$url_str .= "&cat_id=".$_SESSION['cat_id'];
						?>
						<!--<a class="btn btn-primary" href="<?php //echo $url_str; ?>">Select Existing Image</a>-->
					<?php
					
							$db = $dbCustom->getDbConnect(CART_DATABASE);
							$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
							$img_res = $dbCustom->getResult($db,$sql);
							
							if($img_res->num_rows > 0){
								$img_obj = $img_res->fetch_object();
								echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$img_obj->file_name."'>";	
							}
					?>
				</div>   				
                <div class="colcontainer">
					<label>Image Alt Tag text</label>
					<input style="width:520px;" type="text" id="img_alt_text" name="img_alt_text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['img_alt_text']); ?>"/>
				</div>            

			</fieldset>
			<fieldset>
				<legend>Category Details<i class="icon-minus-sign icon-white"></i></legend>


				<div class="colcontainer">
				<label>Category Name</label>
				<input style="width:600px;" name="name" type="text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['name']); ?>" />
				</div>                

				<div class="colcontainer formcols">
					<label>Short name for website navigation</label>
					<input style="width:230px;" type="text" name="short_name" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['short_name']); ?>" />					
                </div>
				<div class="colcontainer formcols">
					<label>Tooltip</label>
					<textarea name="tool_tip" /><?php echo stripslashes($_SESSION['temp_cat_fields']['tool_tip']); ?></textarea>
				</div>
				<div class="colcontainer">
				<label>Key Words</label>
				<input style="width:600px;" name="key_words" type="text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['key_words']); ?>" />
				</div>                
				<div class="colcontainer">
					<label>Description</label>
					<textarea name="description"  class="wysiwyg small" id="wysiwyg1" /><?php echo stripslashes($_SESSION['temp_cat_fields']['description']); ?></textarea>
				</div>
			</fieldset>
			<fieldset>
				<legend>Display Settings<i class="icon-minus-sign icon-white"></i></legend>
				<div class="colcontainer radiocols">
					<div class="threecols">
						<label>Show this category on the home page?</label>
						<div class="checkboxtoggle on"> <span class="ontext">ON</span>
                        <a class="switch on" ></a><span class="offtext">OFF</span>
                        <input type="checkbox" class="checkboxinput" name="show_on_home_page" value="1" <?php if($_SESSION['temp_cat_fields']['show_on_home_page']) echo "checked='checked'"; ?>  />
                        </div>
					</div>
					<div class="threecols">
						<label>Show this category in store section?</label>
						<div class="checkboxtoggle on"> <span class="ontext">ON</span>
                        <a class="switch on" ></a><span class="offtext">OFF</span>
                        <input type="checkbox" class="checkboxinput" name="show_in_cart" value="1" <?php if($_SESSION['temp_cat_fields']['show_in_cart']) echo "checked='checked'"; ?> />
                        </div>
					</div>
					<div class="threecols">
						<label>Show this category in showroom?</label>
						<div class="checkboxtoggle on"> <span class="ontext">ON</span>
                        <a class="switch on" ></a><span class="offtext">OFF</span>
                        <input type="checkbox" class="checkboxinput" name="show_in_showroom" value="1" <?php if($_SESSION['temp_cat_fields']['show_in_showroom']) echo "checked='checked'"; ?> />
                        </div>
					</div>
				</div>
			</fieldset>
            
                        
   			<fieldset class="colcontainer radiocols">
				<legend>Showroom Product Display Settings</legend>
				
				<div class="threecols">
					<label>Priority as Store</label>
					<div class="radiotoggle on"> 
                    <span class="ontext">ON</span>
                    <a class="switch on" href='#'></a>
                    <span class="offtext">OFF</span>
                    <input type="radio" class="radioinput" name="showroom_item_display_priority" value="0" 
                    <?php if(!$_SESSION['temp_cat_fields']['showroom_item_display_priority']) echo "checked='checked'"; ?>/>
                    </div>
				</div>

				<div class="threecols">
					<label>Priority as Showroom</label>
					<div class="radiotoggle on"> 
                    <span class="ontext">ON</span>
                    <a class="switch on" href='#'></a>
                    <span class="offtext">OFF</span>
                    <input type="radio" class="radioinput" name="showroom_item_display_priority" value="1" 
                    <?php if($_SESSION['temp_cat_fields']['showroom_item_display_priority']) echo "checked='checked'"; ?>/>
                    </div>
				</div>

				<div class="threecols">
                
                
				</div>                
			</fieldset>

            
      		<fieldset>
				<legend>Allowed Attributes<i class="icon-minus-sign icon-white"></i></legend>
				<div class="alert alert-info">
                	<span class="fltlft">
                    	<i class="icon-info-sign icon-white"></i>
                    </span>
                    <strong>Restrict which product attributes are available</strong> in this category. Leave blank to allow all attributes for products in this category.
                </div>
				<div class="colcontainer">
					<label>Choose Attributes</label>
						<div class='twocols'>
							<?php 
							$block = '';
							$block .= "<select id='r_attr' multiple='multiple' name='restricted_attributes[]' data-placeholder='Type or Select Attributes' style='width: 220px;' >";
							$db = $dbCustom->getDbConnect(CART_DATABASE);
							$sql = "SELECT attribute_id, attribute_name
									FROM  attribute
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
									ORDER BY attribute_id";
							$res = $dbCustom->getResult($db,$sql);
							while($attr_row = $res->fetch_object()) {
								
								if(in_array($attr_row->attribute_id , $_SESSION['temp_attr_ids'])){
									$sel = "selected";	
								}else{
									$sel = '';
								}
	
								$block .= "<option value='".$attr_row->attribute_id."' $sel>".stripslashes($attr_row->attribute_name)."</option>";
							}
							$block .= "</select>";
							echo $block;
							?>
						</div>
						<div class="twocols">
                			<a class="btn btn-primary" id="copy_attr" href="#"><i class="icon-refresh icon-white"></i> Copy Parent Attributes</a>
						</div>
					</div>

			</fieldset>
            
            
            <fieldset>
				<legend>Parent Categories 
                <div style="font-size:12px;">Note: If all parent categories are de-selected, this category becomes a top category </div>
                </legend>
				<div class="colcontainer">
					<?php
						require_once($_SERVER['DOCUMENT_ROOT']."/manage/catalog/categories/category-tree-snippet.php"); 
					?>
				</div>
			</fieldset>
            
            <legend>One-time Batch Action</legend>
				
				
                	<div style="margin-left:1px;"> 
                	Set all products under this category as "Call for Pricing". This action will affect all products under this category and all it's child categories.
                    </div>
                     <?php
                        $url_str = $ste_root."manage/catalog/batch-action.php";               				
		$url_str = preg_replace('/(\/+)/','/',$url_str);
                        $url_str .= "?action=set_call_for_price";
						$url_str .= "&cat_id=".$_SESSION['cat_id'];
                        $url_str .= "&ret_page=edit-top-category";
                        $url_str .= "&ret_dir=categories";
						   
                    ?>  
                    <div style="margin-left:10%;">                        
                    <a class="btn btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>">Set all as "Call for Price" </a>
                    </div>

					<br /><br />
                    <div style="margin-left:1px;">
                	Set all products under this category as NOT "Call for Pricing". This action will affect all products under this category and all it's child categories.
                    </div>
                     <?php
                        $url_str = $ste_root."manage/catalog/batch-action.php";               				
		$url_str = preg_replace('/(\/+)/','/',$url_str);

                        $url_str .= "?action=remove_call_for_price";
						$url_str .= "&cat_id=".$_SESSION['cat_id'];
                        $url_str .= "&ret_page=edit-top-category";
                        $url_str .= "&ret_dir=categories";
						   
                    ?>  
                    <div style="margin-left:10%;">                        
                    <a class="btn btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>">Un-Set all "Call for Price" </a>
                    </div>
					
				
     
			</fieldset>

        
        </div>
    </form>
    
    <br />
    <br />
    <br />
    
    	<?php  
	
		echo "prodCatId:   ".$profile_cat_id; 
		echo "<br />";
		echo "CatId:   ".$_SESSION['cat_id']; 	
	?>    

	
  </div>
 <p class="clear"></p>
    <?php
	if(!$strip){  
    	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	}
	?>
</div>
</body>
</html>

