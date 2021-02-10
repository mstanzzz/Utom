<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Add Category";
$page_group = "cat";

	

$aLgn = new AdminLogin;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$firstload =  (isset($_GET['firstload'])) ? $_GET['firstload'] : 0;
if($firstload){
	unset($_SESSION['temp_cat_fields']);
	unset($_SESSION['temp_attr_ids']);
	unset($_SESSION['temp_cats']);
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


$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
if(!isset($_SESSION['parent_cat_id'])) $_SESSION['parent_cat_id'] = $parent_cat_id;

$cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $cat_id;

$strip =  (isset($_GET['strip'])) ? $_GET['strip'] : 0;
if(!isset($_SESSION['strip'])) $_SESSION['strip'] = $strip;

if(!isset($_SESSION['temp_attr_ids'])) $_SESSION['temp_attr_ids'] = getCatAttrArray($_SESSION['parent_cat_id']);

if(!isset($_SESSION['temp_cats'])) $_SESSION['temp_cats'] = getCatParentCats($_SESSION['parent_cat_id']);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';



if(isset($_GET['sel_img_id']) && isset($_GET['img_type'])){
	$_SESSION['img_id'] = $_GET['sel_img_id'];
}


if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = 0;

if(isset($_GET['copy_attr'])){
	
	$attr_array = array();	
	$i = 0;
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



if(!isset($_SESSION['temp_attr_ids'])) $_SESSION['temp_attr_ids'] = array();
if(!isset($_SESSION['temp_cat_fields']['name'])) $_SESSION['temp_cat_fields']['name'] = '';	
if(!isset($_SESSION['temp_cat_fields']['short_name'])) $_SESSION['temp_cat_fields']['short_name'] = '';	
if(!isset($_SESSION['temp_cat_fields']['tool_tip'])) $_SESSION['temp_cat_fields']['tool_tip'] = '';	
if(!isset($_SESSION['temp_cat_fields']['description'])) $_SESSION['temp_cat_fields']['description'] = '';	
if(!isset($_SESSION['temp_cat_fields']['show_on_home_page'])) $_SESSION['temp_cat_fields']['show_on_home_page'] = 0;	
if(!isset($_SESSION['temp_cat_fields']['show_in_cart'])) $_SESSION['temp_cat_fields']['show_in_cart'] = 1;	
if(!isset($_SESSION['temp_cat_fields']['show_in_showroom'])) $_SESSION['temp_cat_fields']['show_in_showroom'] = 0;	
if(!isset($_SESSION['temp_cat_fields']['img_alt_text'])) $_SESSION['temp_cat_fields']['img_alt_text'] = '';	
if(!isset($_SESSION['temp_cat_fields']['key_words'])) $_SESSION['temp_cat_fields']['key_words'] = '';	

if(!isset($_SESSION['temp_cat_fields']['showroom_item_display_priority'])) $_SESSION['temp_cat_fields']['showroom_item_display_priority'] = 1;

$ste_root = "../../../";


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

function validate(theform){	

	/*
	if (theform.elements['chosen_categories[]'].selectedIndex == -1) {
	  alert("Please select parent categoty.");
	}
	*/
	
	if(added_category == ''){
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
$(document).ready(function(){
	if (window.top.location != window.location) {
		alert("in");
	}else{
		alert("out");
	}
});
*/

$(document).ready(function() {
	
	
/*	
	$("#allow_store_items_yes").click(function(){
		$("#show_in_store_toggle").removeClass("disabled");	
	});
	$("#allow_store_items_no").click(function(){
		$("#show_in_store_toggle").addClass("disabled");
		$("#show_in_cart").val(0);		

		alert($("#show_in_cart").val());

	});
*/
	
	$("#copy_attr").click(function(e){
		e.preventDefault();
		var q_str = "?action=2"+get_query_str();
		//alert(q_str);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_cat_session.php'+q_str,
		  success: function(data) {			
			
			//alert(data);
			
			location.href = "add-category.php?copy_attr=1"; 
		  }
		});		
	});
});


function get_query_str(){
	
	var query_str = '';
	var attr_str = '';
	var cat_str = '';

	query_str += "&name="+document.add_cat.name.value.replace('&', '%26');
	query_str += "&short_name="+document.add_cat.short_name.value.replace('&', '%26');
	query_str += "&tool_tip="+document.add_cat.tool_tip.value.replace('&', '%26');
	//query_str += "&description="+document.add_cat.description.value; 
	query_str += "&description="+escape(tinyMCE.get('wysiwyg2').getContent());
	
	query_str += "&img_alt_text="+document.add_cat.img_alt_text.value.replace('&', '%26');
	query_str += "&key_words="+document.add_cat.key_words.value.replace('&', '%26'); 
		
	query_str += (document.add_cat.show_on_home_page.checked)? "&show_on_home_page=1" : "&show_on_home_page=0"; 
	query_str += (document.add_cat.show_in_cart.checked)? "&show_in_cart=1" : "&show_in_cart=0"; 
	query_str += (document.add_cat.show_in_showroom.checked)? "&show_in_showroom=1" : "&show_in_showroom=0"; 

	attr_str = $("#r_attr option:selected").map(function(){ return this.value }).get().join("|");
	//alert(attr_str);	 
	query_str += "&attr_str="+attr_str; 

	
	cat_str = $("#cats option:selected").map(function(){ return this.value }).get().join("|");

	query_str += (document.add_cat.showroom_item_display_priority.checked)? "&showroom_item_display_priority=1" : "&showroom_item_display_priority=0"; 
	
	
	query_str += "&cat_str="+cat_str; 



	//alert(query_str); 	
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
		
		$url_str = "category.php";
		$url_str .= "?parent_cat_id=".$_SESSION['parent_cat_id'];
		$url_str .= "&strip=".$_SESSION['strip'];		
		$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];

	?>
	<form name="add_cat" action="<?php echo $url_str;  ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data" target="_parent">
		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
        <input type="hidden" name="add_cat" value="1" />	

         <div class="page_actions edit_page">
            	<?php if($admin_access->product_catalog_level > 1){ ?> 
					<button class="btn btn-large btn-success" name='add' type='submit'><i class="icon-ok icon-white"></i> Save Changes</button>
				<?php }else{ ?>
        			<div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        		<?php } ?>		
                <hr />
                
				<?php if(!$strip){ ?>
				<a class="btn btn-primary toggleFieldsets" href="#"><i class="icon-minus-sign icon-white icon-white"></i> Collapse All Edit Areas </a><br />    
				<a href="<?php echo $url_str; ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a>
				<?php } ?>
			
            </div>
			<div class="page_content edit_page">
        
			<h2>Add a New SubCategory</h2>
			<fieldset class="colcontainer">
				<legend>Add Image</legend>
				<?php 
				$_SESSION['crop_n'] = 1;				
				$_SESSION['img_type'] = 'cart';

				$url_str = $ste_root."manage/upload-pre-crop.php";
				$url_str .= "?ret_page=add-category";
				$url_str .= "&ret_path=catalog/categories";
				$url_str .= "&parent_cat_id=".$_SESSION['parent_cat_id'];

				?>
                <div style="float:left;">
 				<a onClick="goto_isfancybox('<?php echo $url_str; ?>', '1')" class="btn btn-primary"><i class="icon-plus icon-white"></i>Upload new Image</a>
				</div>
                
                
                
                
                <?php
					$_SESSION['crop_n'] = 1;
					$url_str = $ste_root."manage/catalog/select-image.php";               				
					$url_str .= "?ret_page=add-category";
					$url_str .= "&ret_dir=categories";
					$url_str .= "&parent_cat_id=".$_SESSION['parent_cat_id'];
						//$url_str .= "&cat_id=".$_SESSION['cat_id'];		

					?>                    
						
				<div style="float:left; margin-left:10%;">                        
				<a class="btn btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>"><i class="icon-plus icon-white"></i> Select new Image </a>
				</div>
                
                
                
                
                
                
				<?php
					
				if($_SESSION['img_id'] > 0){
					
                    $db = $dbCustom->getDbConnect(CART_DATABASE);
					$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
					
					$img_res = $dbCustom->getResult($db,$sql);
					
					
					if($img_res->num_rows > 0){
						$img_obj = $img_res->fetch_object();
						//echo $_SESSION['img_id'];
						echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$img_obj->file_name."'>";	
					}
				}
            	?>
				<div class="colcontainer">
					<label>Image Alt Tag text</label>
					<input style="width:600px;" type="text" id="img_alt_text" name="img_alt_text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['img_alt_text']); ?>"/>
				</div>            
                
                
			</fieldset>
			<fieldset>
				<legend>Description &amp; Info</legend>

				<div class="colcontainer">
				<label>Category Name</label>
				<input style="width:600px;" name="name" type="text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['name']); ?>" />
				</div>

				<div class="colcontainer">
					<label>Short name for website navigation</label>
					<input style="width:230px;" type="text" name="short_name" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['short_name']); ?>"/>
				</div>
				<div class="colcontainer">
					<label>Tool tip</label>
					<input name="tool_tip" type="text" value="<?php echo stripAllSlashes($_SESSION['temp_cat_fields']['tool_tip']); ?>" />
				</div>
				<div class="colcontainer">
				<label>Key Words</label>
				<input style="width:600px;" name="key_words" type="text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['key_words']); ?>" />
				</div>
				<div class="colcontainer">
				<label>Description</label>
				<textarea class="wysiwyg small" id="wysiwyg2"  name="description"><?php echo stripAllSlashes($_SESSION['temp_cat_fields']['description']); ?></textarea>
				</div>
			</fieldset>
            
  
  <!--          
			<fieldset>
				<legend>Category Type</legend>
				<div class="colcontainer">
					<div class="twocols">
						<label>Normal Category (can have products in showroom or store or both)</label>
                        <div class="radiotoggle on"> 
                        <span class="ontext">YES</span>
                        <a class="switch on" href="#"></a>
                        <span class="offtext">NO</span>
                        <input id='allow_store_items_yes' type="radio" class="radioinput" name="allow_store_items" value="1"
						<?php //if($_SESSION["temp_cat_fields"]["allow_store_items"]) echo "checked='checked'";?> /></div>
                    </div>
					<div class="twocols">
						<label>Showroom Category (Can only have showroom products)</label>
                        <div class="radiotoggle on"> 
                        <span class="ontext">YES</span>
                        <a class="switch on" href="#"></a>
                        <span class="offtext">NO</span>
                        <input id='allow_store_items_no' type="radio" class="radioinput" name="allow_store_items" value="0"
						<?php //if(!$_SESSION["temp_cat_fields"]["allow_store_items"]) echo "checked='checked'";?> /></div>
                    </div>
				</div>
			</fieldset>
-->            
            
            
			<fieldset class="colcontainer radiocols">
				<legend>Display Settings</legend>
				<div class="threecols">
					<label>Show this category on the home page?</label>
					<div class="checkboxtoggle on"> <span class="ontext">ON</span>
                    <a class="switch on" ></a><span class="offtext">OFF</span>
                    <input type="checkbox" class="checkboxinput" name="show_on_home_page" value="1" 
					<?php if($_SESSION['temp_cat_fields']['show_on_home_page']) echo "checked='checked'"; ?>/>
                    </div>
				</div>
				<div class="threecols">
					<label>Show this category in store section?</label>
					<div id="show_in_store_toggle" class="checkboxtoggle on"> <span class="ontext">ON</span>
                    <a class="switch on" ></a><span class="offtext">OFF</span>
                    <input id="show_in_cart" type="checkbox" class="checkboxinput" name="show_in_cart" value="1" 
                    <?php if($_SESSION['temp_cat_fields']['show_in_cart']) echo "checked='checked'"; ?>/>                    
                    </div>
				</div>
				<div class="threecols">
					<label>Show this category in showroom?</label>
					<div class="checkboxtoggle on"> <span class="ontext">ON</span>
                    <a class="switch on" ></a><span class="offtext">OFF</span>
                    <input  type="checkbox" class="checkboxinput" name="show_in_showroom" value="1" 
                    <?php if($_SESSION['temp_cat_fields']['show_in_showroom']) echo "checked='checked'"; ?>/>
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
				<div class="alert alert-info">
                <span class="fltlft"><i class="icon-info-sign icon-white"></i></span>
                <strong>Restrict which product attributes are available</strong> in this category. Leave blank to allow all attributes for products in this category.</div>
				<div class="colcontainer">
						<label>Choose Attributes</label>
						<div class='twocols'>
							<?php 
							//print_r($_SESSION['temp_item_fields']);
							
							$block = '';
							$block .= "<select id='r_attr' multiple='multiple' name='restricted_attributes[]' data-placeholder='Type or Select Attributes' style='width:210px;'  >";
							
							$sql = "SELECT attribute_id, attribute_name
									FROM  attribute
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
									ORDER BY attribute_id";
							$result = $dbCustom->getResult($db,$sql);
							while($attr_row = $result->fetch_object()) {
								
								if(in_array ($attr_row->attribute_id , $_SESSION['temp_attr_ids'])){
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
					<?php
						require_once($_SERVER['DOCUMENT_ROOT']."/manage/catalog/categories/category-tree-snippet.php"); 
					?>
			</fieldset>
		</div>
		<div class="savebar">
			<button type="submit" name="add_cat" class="btn btn-success"><i class="icon-ok icon-white"></i> Add Category </button>
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