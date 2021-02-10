<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Top Category";
$page_group = "top-cat";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_GET['firstload'])){
	unset($_SESSION['temp_cat_fields']);
	unset($_SESSION['temp_attr_ids']);
	unset($_SESSION['temp_cats']);
	unset($_SESSION['cat_id']);	
	unset($_SESSION['img_id']);	
}

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $cat_id;

$search_str = (isset($_GET['search_str'])) ? addslashes($_GET['search_str']) : ''; 
if(!isset($_SESSION['search_str'])) $_SESSION['search_str'] = $search_str;

$strip =  (isset($_GET['strip'])) ? $_GET['strip'] : 0;
if(!isset($_SESSION['strip'])) $_SESSION['strip'] = $strip;

if(isset($_GET['sel_img_id']) && isset($_GET['img_type'])){
	$_SESSION['img_id'] = $_GET['sel_img_id'];
}

function is_in_options($opt_id){
	$ret = 0;
	if(isset($_SESSION['temp_attr_ids'])){
		foreach($_SESSION['temp_attr_ids'] as $opt_v){
			if($opt_id == $opt_v) $ret = 1;	
		}
	}
	return $ret;
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
	$show_on_home_page = '';		
	$show_in_cart = '';
	$show_in_showroom = '';
	$img_id = 0;
	$img_alt_text = '';
	$key_words = '';
	$profile_cat_id = '';
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


if(!isset($_SESSION['temp_attr_ids'])){
	$_SESSION['temp_attr_ids'] = array();
	$sql = "SELECT attribute_id
		FROM category_to_attr 
		WHERE cat_id = '".$_SESSION['cat_id']."'";
$result = $dbCustom->getResult($db,$sql);	
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['temp_attr_ids'][$i] = $row->attribute_id;
		$i++;
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>

/*
$(document).ready(function() {
	
	
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 1060	
	});	
	
});
*/



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


function get_query_str(){
	
	var query_str = '';
	var attr_str = '';
	var cat_str = '';

	query_str += "&name="+document.edit_cat.name.value.replace('&', '%26');
	
	query_str += "&short_name="+document.edit_cat.short_name.value.replace('&', '%26');
	 
	query_str += "&tool_tip="+document.edit_cat.tool_tip.value.replace('&', '%26'); 
	
	query_str += "&img_alt_text="+document.edit_cat.img_alt_text.value.replace('&', '%26');
	 
	query_str += "&key_words="+document.edit_cat.key_words.value.replace('&', '%26');

	query_str += "&description="+escape(tinyMCE.get('wysiwyg1').getContent());
		
	query_str += (document.edit_cat.show_on_home_page.checked)? "&show_on_home_page=1" : "&show_on_home_page=0"; 
	query_str += (document.edit_cat.show_in_cart.checked)? "&show_in_cart=1" : "&show_in_cart=0"; 
	query_str += (document.edit_cat.show_in_showroom.checked)? "&show_in_showroom=1" : "&show_in_showroom=0"; 
	
	query_str += (document.edit_cat.showroom_item_display_priority.checked)? "&showroom_item_display_priority=1" : "&showroom_item_display_priority=0"; 
	

	attr_str = $("#r_attr option:selected").map(function(){ return this.value }).get().join("|");
	query_str += "&attr_str="+attr_str; 

	cat_str = $("#cats option:selected").map(function(){ return this.value }).get().join("|");
	query_str += "&cat_str="+cat_str; 

	
		
	return query_str;
}



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
			  
			  //alert(data);
			  
			location.href = url;
		  }
		});
	}else{
		location.href = url;		
	}

}

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

	
	$url_str = $ste_root."manage/catalog/categories/top-category.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);

	$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
	$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
	$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
	$url_str .= "&search_str=".$_SESSION['search_str'];

?>
<form name="edit_cat" action="<?php echo $url_str; ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data" target="_top">
		<input id="cat_id" type="hidden" name="cat_id" value="<?php echo $_SESSION['cat_id'];  ?>" />
		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
    	<input type="hidden" name="edit_top_cat" value="1">  
        
        
        
		<div class="page_actions edit_page">
            	<?php if($admin_access->product_catalog_level > 1){ ?> 
					<button class="btn btn-large btn-success" name='edit' type='submit'>
					<i class="icon-ok icon-white"></i> Save Changes</button>
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
        
			<h2>Editing <em>"<?php echo $name; ?>"</em></h2>
			<fieldset class="colcontainer">
            	<?php if(!$_SESSION['strip']){ ?>
				<legend>Change Image</legend>
				<?php 
				}

				$_SESSION['crop_n'] = 1;				
				$_SESSION['img_type'] = 'cart';

				$url_str = $ste_root."manage/upload-pre-crop.php";
				$url_str = preg_replace('/(\/+)/','/',$url_str);
				$url_str .= "?ret_page=edit-top-category";
				$url_str .= "&ret_path=catalog/categories";
				$url_str .= "&ret_dir=categories";
				$url_str .= "&img_type=cart";
				$url_str .= "&crop_n=1";
				
				
				//echo "url_str: ".$url_str; 
				//echo "<br />";
				//echo $_SESSION['img_type'];
				//echo "<br />";
				//echo "<br />";
				
				?>

                <div class="colcontainer">
                
                <div style="float:left;">
<!-- 
<a onClick="goto_isfancybox('<?php echo $url_str; ?>', '1')" class="btn btn-primary"><i class="icon-plus icon-white"></i>Upload new Image</a>
--> 	
<a href="<?php echo $url_str; ?>" class="btn btn-primary"><i class="icon-plus icon-white"></i>Upload new Image</a>
			
				</div>
                    
                    <?php


                        $url_str = $ste_root."manage/catalog/select-image.php";               				
				$url_str = preg_replace('/(\/+)/','/',$url_str);

                        $url_str .= "?ret_page=edit-top-category";
                        $url_str .= "&ret_dir=categories";
                            
                    ?>                    
                            
				<div style="float:left; margin-left:10%;">                        
<a class="btn btn-primary" href="<?php echo $url_str; ?>"><i class="icon-plus icon-white"></i> 
Select new Image </a>
				</div>
                
                
                
   				<br /><br />
                <div class="colcontainer">
					<?php
					$db = $dbCustom->getDbConnect(CART_DATABASE);
					$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
					$img_res = $dbCustom->getResult($db,$sql);
							
					if($img_res->num_rows){
						$img_obj = $img_res->fetch_object();
						echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$img_obj->file_name."'>";	
					}
					?>
				</div>
                
   				<div class="colcontainer">
					<label>Image Alt Tag text</label>
					<input style="width:600px;" type="text" id="img_alt_text" name="img_alt_text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['img_alt_text']); ?>"/>
				</div>            

                
			</fieldset>
			<fieldset>
				<legend>Edit Details</legend>

				<div class="colcontainer">
				<label>Category Name</label>
				<input style="width:600px;" name="name" type="text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['name']); ?>" />
				</div>                

				<div class="colcontainer formcols">
						<label>Short name for website navigation</label>
						<input style="width:230px;" type="text" name="short_name" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['short_name']); ?>" />
				</div>

				<div class="colcontainer formcols">

						<label>Tool Tip</label>
						<textarea name="tool_tip" /><?php echo stripAllSlashes($_SESSION['temp_cat_fields']['tool_tip']); ?></textarea>
				</div>
				<div class="colcontainer">
				<label>Key Words</label>
				<input style="width:600px;" name="key_words" type="text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['key_words']); ?>" />
				</div>

				<div class="colcontainer formcols">
					<label>Description</label>
					<textarea name="description"  class="wysiwyg small" id="wysiwyg1" /><?php echo stripAllSlashes($_SESSION['temp_cat_fields']['description']); ?></textarea>
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
				<legend>Allowed Attributes</legend>
				<div class="alert alert-info"><span class="fltlft"><i class="icon-info-sign icon-white"></i></span><strong>Restrict which product attributes are available</strong> in this category. Leave blank to allow all attributes for products in this category.</div>
				<div class="colcontainer formcols">
						<div class="twocols">
							<label>Choose Attributes</label>
						</div>
						<div class='twocols'>
							<?php 
							$block = '';
							$block .= "<select id='r_attr' multiple='multiple' name='restricted_attributes[]' data-placeholder='Type or Select Attributes' style='width:300px;'>";
							$sql = "SELECT attribute_id, attribute_name
									FROM  attribute
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
									ORDER BY attribute_id";
							$result = $dbCustom->getResult($db,$sql);							
							while($attr_row = $result->fetch_object()){
								$sel = (is_in_options($attr_row->attribute_id))? "selected" : ''; 
								$block .= "<option value='".$attr_row->attribute_id."' $sel>".stripslashes($attr_row->attribute_name)."</option>";
							}
							$block .= "</select>";
							echo $block;
							?>
						</div>
					</div>
			</fieldset>
			<fieldset>
				<legend>Parent Categories 
                <div style="font-size:12px;">Note: If parent categories are selected, this category becomes a child category and is no longer a top category </div>
                </legend>
					<?php
						require_once($_SERVER['DOCUMENT_ROOT']."/manage/catalog/categories/category-tree-snippet.php"); 
					?>
			</fieldset>
            
            <fieldset class="colcontainer radiocols">
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