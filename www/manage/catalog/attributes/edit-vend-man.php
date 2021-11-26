<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Edit Vendor";
$page_group = "vend-man";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);


$msg = (isset($_GET['msg']))? $_GET['msg'] : 0; 

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;


function is_in_options($opt_id){
	$ret = 0;
	if(isset($_SESSION['temp_brand_ids'])){
		foreach($_SESSION['temp_brand_ids'] as $opt_v){
			if($opt_id == $opt_v) $ret = 1;	
		}
	}
	return $ret;
}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script type="text/javascript" language="javascript">

$(document).ready(function() {

	$('#add_brand').click(function(){	
		ajax_set_vend_session();
	});
	
});


function ajax_set_vend_session(){
	
		var q_str = "?page=edit-vend-man"+get_query_str();
		//alert(q_str);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_vend_session.php'+q_str,
		  success: function(data) {
				//alert(data);
		  }
		});
}


function get_query_str(){

	//alert("JJJJJJ");
	
	var query_str = '';

	query_str += "&name="+document.edit_vend_man.name.value; 
	query_str += "&parent_vend_man_id="+document.edit_vend_man.parent_vend_man_id.value; 
	query_str += "&web_site="+document.edit_vend_man.web_site.value; 
	query_str += "&contact_name="+document.edit_vend_man.contact_name.value; 
	query_str += "&contact_email="+document.edit_vend_man.contact_email.value; 
	query_str += "&contact_phone="+document.edit_vend_man.contact_phone.value; 
	query_str += "&contact_fax="+document.edit_vend_man.contact_fax.value; 
	query_str += (document.edit_vend_man.is_vendor.checked)? "&is_vendor=1" : "&is_vendor=0"; 
	query_str += (document.edit_vend_man.is_drop_shipper.checked)? "&is_drop_shipper=1" : "&is_drop_shipper=0"; 
	query_str += (document.edit_vend_man.is_manufacturer.checked)? "&is_manufacturer=1" : "&is_manufacturer=0"; 
	query_str += "&description="+escape(tinyMCE.get('wysiwyg1').getContent());
	
	//var brand_list = $("#brand_ids option:selected").map(function(){ return this.value }).get().join("|");
	
	var brand_list = ''; 
	$("#brand_ids option:selected").each(function(){ brand_list += this.value+"|"; });	
	brand_list = brand_list.replace(/(\s+)?.$/, '');	
	
	query_str += "&brand_list="+brand_list; 
	
	//alert(query_str);
	
	return query_str;
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
	content_css : "<?php echo SITEROOT; ?>../css/mce.css"
	});

</script>	
</head>
<body>
<?php
if(!$strip){
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
		if(!$strip){
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');

		$vend_man_id = (isset($_GET['vend_man_id']))? $_GET['vend_man_id'] : 0; 
		//echo $vend_man;
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = sprintf("SELECT * FROM vend_man WHERE vend_man_id = '%u'", $vend_man_id);
		$res = $dbCustom->getResult($db,$sql);
		
		if($res->num_rows > 0){
			$object = $res->fetch_object();
			$name = $object->name;
			$parent_vend_man_id = $object->parent_vend_man_id;
            $is_vendor = $object->is_vendor;
            $is_drop_shipper = $object->is_drop_shipper;
            $is_manufacturer = $object->is_manufacturer;
            $description = $object->description;
            $web_site = $object->web_site;
            $contact_name = $object->contact_name;
            $contact_email = $object->contact_email;
            $contact_phone = $object->contact_phone;
            $contact_fax = $object->contact_fax;
 		}else{
			$name = '';
			$parent_vend_man_id = '';
            $is_vendor = '';
            $is_drop_shipper = '';
            $is_manufacturer = '';
            $description = '';
            $web_site = '';
            $contact_name = '';
            $contact_email = '';
            $contact_phone = '';
            $contact_fax = '';	
		}
		if(!isset($_SESSION["temp_fields"]['name'])) $_SESSION["temp_fields"]['name'] = $name;	
		if(!isset($_SESSION["temp_fields"]["parent_vend_man_id"])) $_SESSION["temp_fields"]["parent_vend_man_id"] = $parent_vend_man_id;	
		if(!isset($_SESSION["temp_fields"]['is_vendor'])) $_SESSION["temp_fields"]['is_vendor'] = $is_vendor;	
		if(!isset($_SESSION["temp_fields"]["is_drop_shipper"])) $_SESSION["temp_fields"]["is_drop_shipper"] = $is_drop_shipper;	
		if(!isset($_SESSION["temp_fields"]["is_manufacturer"])) $_SESSION["temp_fields"]["is_manufacturer"] = $is_manufacturer;	
		if(!isset($_SESSION["temp_fields"]['description'])) $_SESSION["temp_fields"]['description'] = $description;	
		if(!isset($_SESSION["temp_fields"]["web_site"])) $_SESSION["temp_fields"]["web_site"] = $web_site;	
		if(!isset($_SESSION["temp_fields"]["contact_name"])) $_SESSION["temp_fields"]["contact_name"] = $contact_name;	
		if(!isset($_SESSION["temp_fields"]["contact_email"])) $_SESSION["temp_fields"]["contact_email"] = $contact_email;	
		if(!isset($_SESSION["temp_fields"]["contact_phone"])) $_SESSION["temp_fields"]["contact_phone"] = $contact_phone;	
		if(!isset($_SESSION["temp_fields"]["contact_fax"])) $_SESSION["temp_fields"]["contact_fax"] = $contact_fax;	
		if(!isset($_SESSION["temp_fields"]["vend_man_id"])) $_SESSION["temp_fields"]["vend_man_id"] = $vend_man_id;	

		$url_str = "vend-man.php";
		$url_str .= "?strip=".$strip;
		$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
?>
    <form name="edit_vend_man" action="<?php echo $url_str; ?>" method="post">
    	<input type="hidden" name="vend_man_id" value="<?php echo $_SESSION["temp_fields"]["vend_man_id"]; ?>" />
            <div class="page_actions edit_page"> 
            	<?php if($admin_access->product_catalog_level > 1){ 
				
					$url_str = "add-brand.php";
					$url_str .= "?strip=".$strip;
					$url_str .= "&vend_man_id=".$vend_man_id;					
					$url_str .= "&ret_page=edit-vend-man";					
					$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
					$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
					$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
					$url_str .= "&truncate=".$_SESSION['paging']['truncate'];

				?>
                    <a id="add_brand" class="btn btn-large btn-primary fancybox fancybox.iframe" 
                    href='<?php echo $url_str; ?>'>
                    <i class="icon-plus icon-white"></i> Add another brand </a>
				<button type="submit" name="edit_vend_man" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
		        <?php }else{ ?>
                    <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
                <?php } 
					$url_str = "vend-man.php";
					$url_str .= "?strip=".$strip;
					$url_str .= "&pagenum=".$_SESSION['paging']['pagenum'];
					$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
					$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
					$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
				?>		
            	<hr />
            	<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel Changes, Go Back </a>
            </div>
			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<legend>Vendor Details <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Vendor Name</label>
						</div>
						<div class="twocols">
      						<input type="text" name="name" value="<?php echo stripslashes($_SESSION["temp_fields"]['name']); ?>" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Parent Vendor?</label>
						</div>
						<div class="twocols">
							<select name="parent_vend_man_id">
								<option value="0">No parent</option>
								<?php
									$db = $dbCustom->getDbConnect(CART_DATABASE);
									$sql = "SELECT name, vend_man_id 
										FROM vend_man 
										WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
										ORDER BY name";
										
									$res = $dbCustom->getResult($db,$sql);	
									while($v_row = $res->fetch_object()) {
										$selected = ($v_row->vend_man_id == $_SESSION["temp_fields"]["parent_vend_man_id"]) ? "selected" : '';
										echo "<option value='".$v_row->vend_man_id."' $selected>".stripslashes($v_row->name)."</option>";
									}
						
								?>
							</select>
						</div>
					</div>
					<div class="colcontainer radiocols">
						<div class="threecols">
							<label>Is this a Vendor?</label>
							<?php $checked = ($_SESSION["temp_fields"]['is_vendor']) ? "checked='checked'" : ''; ?>
	                        <div class="checkboxtoggle on"> 
                            <span class="ontext">YES</span>
                            <a class="switch on" href="#"></a>
                            <span class="offtext">NO</span>
                            <input type="checkbox" class="checkboxinput" name="is_vendor" value="1" <?php echo $checked ?>/></div>			
                        </div>
						<div class="threecols">
							<label>Is this a DropShipper?</label>
							<?php $checked = ($_SESSION["temp_fields"]["is_drop_shipper"]) ? "checked='checked'" : ''; ?>
	                        <div class="checkboxtoggle on"> 
                            <span class="ontext">YES</span>
                            <a class="switch on" href="#"></a>
                            <span class="offtext">NO</span>
                            <input type="checkbox" class="checkboxinput" name="is_drop_shipper" value="1" <?php echo $checked ?>/></div>			
						</div>
						<div class="threecols">
							<label>Is this a Manufacturer?</label>
							<?php $checked = ($_SESSION["temp_fields"]["is_manufacturer"]) ? "checked='checked'" : ''; ?>
	                        <div class="checkboxtoggle on"> 
                            <span class="ontext">YES</span>
                            <a class="switch on" href="#"></a>
                            <span class="offtext">NO</span>
                            <input type="checkbox" class="checkboxinput" name="is_manufacturer" value="1" <?php echo $checked ?>/></div>			

						</div>
					</div>
                    
					<div class="colcontainer formcols">
						<label>Description</label>
						<textarea class="wysiwyg small" id="wysiwyg1" name="description"><?php echo stripslashes($_SESSION["temp_fields"]['description']); ?></textarea>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Brands:</label>
						</div>
                    
                    
						<?php 
						if(!isset($_SESSION['temp_brand_ids'])){
							$_SESSION['temp_brand_ids'] = array();
							$sql = "SELECT brand.name, brand.brand_id 
									FROM brand, vend_man_brand 
									WHERE brand.brand_id = vend_man_brand.brand_id
									AND vend_man_brand.vend_man_id = '".$_SESSION["temp_fields"]["vend_man_id"]."'			
									AND profile_account_id = '".$_SESSION['profile_account_id']."'
									ORDER BY name";
							$res = $dbCustom->getResult($db,$sql);		
							$i = 0;
							//echo mysql_num_rows($v_res);
							while($v_row = $res->fetch_object()) {
								$_SESSION['temp_brand_ids'][$i] = $v_row->brand_id;
								$i++;
							}
						}
						
						//print_r($_SESSION['temp_brand_ids']);
						
						$block = '';
						$block .= "<label>Brands</label>";
						$block .= "<select id='brand_ids' class='chosen' multiple='multiple' name='brand_ids[]' data-placeholder='Type or Select Brands'>";
						$sql = "SELECT name, brand_id 
								FROM brand 
								WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
								ORDER BY name";
						$res = $dbCustom->getResult($db,$sql);		
						while($v_row = $res->fetch_object()) {
							$sel = (is_in_options($v_row->brand_id))? "selected" : '';
							$block .= "<option value='".$v_row->brand_id."' $sel>".stripslashes($v_row->name)."</option>";
						}
						$block .= "</select>";
						$block .= '';
						echo $block;
						?>
					</div>
				</fieldset>

				<fieldset class="edit_content">
					<legend>Contact Information <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Website</label>
						</div>
						<div class="twocols">
      						<input type="text" name="web_site" value="<?php echo stripslashes($_SESSION["temp_fields"]["web_site"]); ?>" />
						</div>
					</div>
                    <div class="colcontainer formcols">
						<div class="twocols">
							<label>Contact Person's Name</label>
						</div>
						<div class="twocols">
      						<input type="text" name="contact_name" value="<?php echo stripslashes($_SESSION["temp_fields"]["contact_name"]); ?>" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Contact Person's Email Address</label>
						</div>
						<div class="twocols">
      						<input type="text" name="contact_email" value="<?php echo stripslashes($_SESSION["temp_fields"]["contact_email"]); ?>" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Contact Person's Phone</label>
						</div>
						<div class="twocols">
      						<input type="text" name="contact_phone" value="<?php echo $_SESSION["temp_fields"]["contact_phone"]; ?>" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Contact Person's Fax</label>
						</div>
						<div class="twocols">
      						<input type="text" name="contact_fax" value="<?php echo $_SESSION["temp_fields"]["contact_fax"]; ?>" />
						</div>
					</div>
				
                
                </fieldset>
			</div>
		</form>
</div>
    <p class="clear"></p>
    <?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
    ?>

</div>
</body>
</html>

