<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Add Top Category";
$page_group = "top-cat";

	

$aLgn = new AdminLogin;


$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;


$firstload =  (isset($_GET['firstload'])) ? $_GET['firstload'] : 0;
if($firstload){
	unset($_SESSION['temp_cat_fields']);
	unset($_SESSION['temp_attr_ids']);
	unset($_SESSION['temp_cats']);
	unset($_SESSION['img_id']);	
}

if(!isset($_SESSION['item_id'])) $_SESSION['item_id'] = 0;
$item_id =  (isset($_REQUEST['item_id'])) ? $_REQUEST['item_id'] : $_SESSION['item_id'];
if($item_id == '') $item_id = 0;

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';



if(isset($_GET['sel_img_id']) && isset($_GET['img_type'])){
	$_SESSION['img_id'] = $_GET['sel_img_id'];
}

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = 0;

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



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script type="text/javascript" language="javascript">

tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

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
	
	query_str += (document.add_cat.showroom_item_display_priority.checked)? "&showroom_item_display_priority=1" : "&showroom_item_display_priority=0"; 
	

	attr_str = $("#r_attr option:selected").map(function(){ return this.value }).get().join("|");
	//alert(attr_str);	 
	query_str += "&attr_str="+attr_str; 

	cat_str = $("#cats option:selected").map(function(){ return this.value }).get().join("|");
		
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
		//alert(q_str);
		
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_cat_session.php'+q_str,
		  success: function(data) {
			//alert(url) 
			location.href = url;
		  	
		  }
		});
	}else{
		location.href = url;		
	}


}

/*
$(document).ready(function() {
	
	
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 1060	
	});	
	
});
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

        $url_str = $ste_root."manage/catalog/categories/top-category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);

	$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
	$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
	$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
	?>

	<form name="add_cat" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
		<input type="hidden" name="add_top_cat" value="1" />
        
         <div class="page_actions edit_page">
            	<?php if($admin_access->product_catalog_level > 1){ ?> 
					<button class="btn btn-large btn-success" name='edit_cat' type='submit'><i class="icon-ok icon-white"></i> Save Changes</button>
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
        
        
        
        
			<h2>Add a New Top Category</h2>
			<fieldset class="colcontainer">
				<legend>Add Image</legend>
				<?php
				$_SESSION['crop_n'] = 1;
				$_SESSION['img_type'] = 'cart';
				
				//$url_str = "upload.php";
				$url_str = $ste_root."manage/upload-pre-crop.php";
		$url_str = preg_replace('/(\/+)/','/',$url_str);

				$url_str .= "?ret_page=add-top-category";
				$url_str .= "&ret_path=catalog/categories";
				$url_str .= "&ret_dir=categories";
				$url_str .= "&img_type=cart";
				?>
                    
                <div style="float:left;">
 				
                <a onClick="goto_isfancybox('<?php echo $url_str; ?>', '1')" class="btn btn-primary"><i class="icon-plus icon-white"></i>Upload new Image</a>
				
                </div>
                
                <?php
					
					$url_str = $ste_root."manage/catalog/select-image.php";               				
		$url_str = preg_replace('/(\/+)/','/',$url_str);

					$url_str .= "?ret_page=add-top-category";
					$url_str .= "&ret_dir=categories";
						
				?>                    
						
				<div style="float:left; margin-left:10%;">                        
				<a class="btn btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>"><i class="icon-plus icon-white"></i> Select new Image </a>
				</div>
				
				
				
				
				
				<?php
   	 			$db = $dbCustom->getDbConnect(CART_DATABASE);        

echo "img_id ".$_SESSION['img_id'];
echo "<br />";
//exit;

				if($_SESSION['img_id'] > 0){	
					$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
					$img_res = $dbCustom->getResult($db,$sql);
					
					$img_obj = $img_res->fetch_object();
					echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$img_obj->file_name."'>";
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
						<input style="width:230px;" type="text" id="short_name" name="short_name" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['short_name']); ?>"/>
				</div>
				<div class="colcontainer">
						<label>Tool tip</label>
						<input type="text" id="tool_tip" name="tool_tip"  value="<?php echo stripslashes($_SESSION['temp_cat_fields']['tool_tip']); ?>" />
				</div>

   				<div class="colcontainer">
				<label>Key Words</label>
				<input style="width:600px;" name="key_words" type="text" value="<?php echo prepFormInputStr($_SESSION['temp_cat_fields']['key_words']); ?>" />
				</div>

				<div class="colcontainer">
				<label>Description</label>
				<textarea class="wysiwyg small" id="wysiwyg2"  name="description"><?php echo stripslashes($_SESSION['temp_cat_fields']['description']); ?></textarea>
				</div>
			</fieldset>
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
					<div class="checkboxtoggle on"> <span class="ontext">ON</span>
                    <a class="switch on" ></a><span class="offtext">OFF</span>
                    <input type="checkbox" class="checkboxinput" name="show_in_cart" value="1" 
                    <?php if($_SESSION['temp_cat_fields']['show_in_cart']) echo "checked='checked'"; ?>/>                    
                    </div>
				</div>
				<div class="threecols">
					<label>Show this category in showroom?</label>
					<div class="checkboxtoggle on"> <span class="ontext">ON</span>
                    <a class="switch on" ></a><span class="offtext">OFF</span>
                    <input type="checkbox" class="checkboxinput" name="show_in_showroom" value="1" 
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
				<div class="alert alert-info"><span class="fltlft"><i class="icon-info-sign icon-white"></i></span><strong>Restrict which product attributes are available</strong> in this category. Leave blank to allow all attributes for products in this category.</div>
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