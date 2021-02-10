<?php
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/manage-includes.php");
$progress   = new SetupProgress;
$module     = new Module;
$page_title = "Global Discount";
$page_group = "discount";
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/set-page.php");
$db = $dbCustom->getDbConnect(CART_DATABASE);
$msg         = (isset($_GET['msg'])) ? $_GET['msg'] : '';
// current unix time stamp
$ts          = time();

$user_level = (isset($_GET['user_level'])) ? $_GET['user_level'] : "0";


$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";

$this_global_discount_id =  (isset($_GET['global_discount_id'])) ? $_GET['global_discount_id'] : 0;
if(!isset($_SESSION['global_discount_id'])) $_SESSION['global_discount_id'] = $this_global_discount_id;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = sprintf("SELECT * FROM global_discount 
				WHERE global_discount_id = '%u'
				AND profile_account_id = '%u'", $_SESSION['global_discount_id'], $_SESSION['profile_account_id']);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$hide = $object->hide;
	$when_active = $object->when_active; 
	$when_expired = $object->when_expired;
	$name = $object->name;
	$description = $object->description;
	$type = $object->type;
	$coupon_code = $object->coupon_code;
	$percent_off = $object->percent_off;
	$amount_off = $object->amount_off;
	$if_greater_than = $object->if_greater_than;
	$if_less_than = $object->if_less_than;
	$can_use_with_other_discounts = $object->can_use_with_other_discounts;
	$stored_img_id = $object->img_id;
	
	//echo $object->name;	
	
}else{
	$hide = 0;
	$when_active = 0; 
	$when_expired = 0;
	$name = "";
	$description = "";
	$type = "";
	$coupon_code = "";
	$percent_off = "";
	$amount_off = "";
	$if_greater_than = "";
	$if_less_than = "";
	$can_use_with_other_discounts = 0;
	$stored_img_id = 0;	
	
}


if(!isset($_SESSION['temp_page_fields']['hide'])) $_SESSION['temp_page_fields']['hide'] = $hide;
if(!isset($_SESSION['temp_page_fields']['when_active'])) $_SESSION['temp_page_fields']['when_active'] = $when_active;
if(!isset($_SESSION['temp_page_fields']['when_expired'])) $_SESSION['temp_page_fields']['when_expired'] = $when_expired;
if(!isset($_SESSION['temp_page_fields']['name'])) $_SESSION['temp_page_fields']['name'] = $name;
if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;
if(!isset($_SESSION['temp_page_fields']['type'])) $_SESSION['temp_page_fields']['type'] = $type;
if(!isset($_SESSION['temp_page_fields']['coupon_code'])) $_SESSION['temp_page_fields']['coupon_code'] = $coupon_code;
if(!isset($_SESSION['temp_page_fields']['percent_off'])) $_SESSION['temp_page_fields']['percent_off'] = $percent_off;
if(!isset($_SESSION['temp_page_fields']['amount_off'])) $_SESSION['temp_page_fields']['amount_off'] = $amount_off;
if(!isset($_SESSION['temp_page_fields']['if_greater_than'])) $_SESSION['temp_page_fields']['if_greater_than'] = $if_greater_than;
if(!isset($_SESSION['temp_page_fields']['if_less_than'])) $_SESSION['temp_page_fields']['if_less_than'] = $if_less_than;
if(!isset($_SESSION['temp_page_fields']['can_use_with_other_discounts'])) $_SESSION['temp_page_fields']['can_use_with_other_discounts'] = $can_use_with_other_discounts;

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $stored_img_id;

require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/doc_header.php"); 

?>

<script>

tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});

$(document).ready(function () {
	
    $("#datepicker1").datepicker();
    $("#datepicker2").datepicker();
    $('#clear_dates').click(function () {
        $('#datepicker1').val("");
        $('#datepicker2').val("");
    });
    $("#type").change(function () {
        //alert($(this).val());
        //alert($(this).val().indexOf("coupon"));
        var htmlstr;
        if ($(this).val().indexOf("coupon") >= 0) {
            htmlstr = "<label>Coupon Code</label><input type='text' name='coupon_code' value='<?php echo $_SESSION['temp_page_fields']['coupon_code']; ?>' />";
            $("#coupon_code_container").html(htmlstr);
        } else {
            htmlstr = "<input type='hidden' name='coupon_code' value='' />";
            $("#coupon_code_container").html(htmlstr);
        }
    });
	
	
	$("#submit_form").click(function () {

		if(validate(document.form)){
				
				document.form.submit();
		}
    
	});
	
});

function goto_isfancybox(url, save_session){


	if (window.top.location != window.location) {
		url+="&fromfancybox=1";
	}

	if(save_session){
		q_str = "?action=1"+get_query_str();

		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_ecom_session.php'+q_str,
		  success: function(data) {
			location.href = url;
		  }
		});
	}else{
		location.href = url;		
	}
}


function get_query_str(){
	
//name, tool_tip, show_on_home_page, restricted_attributes[]	
	var query_str = "";

	query_str += "&when_active="+document.form.when_active.value; 
	query_str += "&when_expired="+document.form.when_expired.value; 
	query_str += "&name="+document.form.name.value; 
	query_str += "&description="+escape(tinyMCE.get('wysiwyg').getContent());	
	query_str += "&type="+document.form.type.value; 
	query_str += "&coupon_code="+document.form.coupon_code.value; 
	query_str += "&percent_off="+document.form.percent_off.value; 
	query_str += "&amount_off="+document.form.amount_off.value; 
	query_str += "&if_greater_than="+document.form.if_greater_than.value; 
	query_str += "&if_less_than="+document.form.if_less_than.value; 
	query_str += (document.form.hide.checked)? "&hide=1" : "&hide=0"; 
	query_str += (document.form.can_use_with_other_discounts.checked)? "&can_use_with_other_discounts=1" : "&can_use_with_other_discounts=0"; 

	//alert(query_str); 	
	return query_str;

}





function validate(theform) {
    if (theform.percent_off.value != "" && theform.amount_off.value != "") {
        if (theform.percent_off.value > 0 && theform.amount_off.value > 0) {
            alert("You cannot have values for both percent off and amount off \n Please enter only one value.");
            return false;
        }
    }
	
	if(theform.when_active.value != "" ){
		
	
		alert(theform.when_active.value.split("str").length - 1);
		
	}
	
	
	//when_active
	//when_expired
	
	
	
	
    return true;
}

function checkPercent(elem) {
    if (!IsNumeric(elem.value)) {
        alert("Please enter valid numbers only");
    } else {
        if (elem.value != 0 && elem.value <= 1) {
            alert("Please enter 0 or an integer greater than 1");
        }
        if (elem.value >= 100) {
            alert("Please enter a number less than 100");
        }
    }
}

function checkNum(elem) {
    if (!IsNumeric(elem.value)) {
        alert("Please enter valid numbers only");
    }
}

function IsNumeric(sText) {
    var ValidChars = "0123456789.";
    var IsNumber = true;
    var Char;
    for (i = 0; i < sText.length && IsNumber == true; i++) {
        Char = sText.charAt(i);
        if (ValidChars.indexOf(Char) == -1) {
            IsNumber = false;
        }
    }
    return IsNumber;
}

function show_msg(msg) {
    alert(msg);
}
</script>
</head><body>
<div class="lightboxholder">
	<?php if($msg != ""){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		}  
	
	
	$url_str = "global-discount.php";
	$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
	$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
	$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
 
	?>
	<form name="form" action="<?php echo $url_str; ?>" method="post"  enctype="multipart/form-data" target="_top">
		<input id="global_discount_id" type="hidden" name="global_discount_id" value="<?php echo $_SESSION['global_discount_id'];  ?>" />
		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
		<div class="lightboxcontent">
			<h2>Edit '<?php echo $_SESSION['temp_page_fields']['name']; ?>' Discount</h2>
			<fieldset class="colcontainer">
				<legend>Set Current Status</legend>
                <input type="hidden" name="hide" value="<?php echo $_SESSION['temp_page_fields']['hide']; ?>">
                <!--
				<div class="threecols">
					<label>Switch On/Off</label>
                    <?php
					/*
						$status = ($hide == 1)? '' : "checked='checked'";
						echo "<div class='checkboxtoggle on'> <span class='ontext'>ON</span>
						<a class='switch on' href='#'></a><span class='offtext'>OFF</span>
						<input type='checkbox' class='checkboxinput' name='hide' value='1' $status /></div>";
					*/
					?>
                </div>
                -->
				<div class="threecols">
					<label>When to activate</label>
					<?php $w_d =  ($_SESSION['temp_page_fields']['when_active'] > 0) ? date("m/d/Y",$_SESSION['temp_page_fields']['when_active']) : ""; ?>
					<input type="text" name="when_active" id="datepicker1" value="<?php echo $w_d; ?>" />
					&nbsp;<span >12:00am</span> 
                </div>
				<div class="threecols">
					<label>When to expire</label>
					<?php $w_d =  ($_SESSION['temp_page_fields']['when_expired'] > 0) ? date("m/d/Y",$_SESSION['temp_page_fields']['when_expired']) : ""; ?>
					<input type="text" name="when_expired" id="datepicker2" value="<?php echo $w_d; ?>" />
					&nbsp;<span >11:59pm</span> <a class="btn fltrt" href="#" id="clear_dates">Clear Dates</a> 
               </div>
			</fieldset>
			<fieldset>
				<legend>Details</legend>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Name</label>
					</div>
					<div class="twocols">
						<input type="text" name="name"  value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['name']) ?>" />
					</div> 
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Description</label>
					</div>
					<div class="twocols">
<!--
<textarea id="wysiwyg" class="wysiwyg" name="description"><?php echo stripslashes($_SESSION['temp_page_fields']['description']); ?></textarea> 
-->	
<textarea name="description"><?php echo stripslashes($_SESSION['temp_page_fields']['description']); ?></textarea> 

					</div> 
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Banner Image:</label>
					</div>
					<div class="twocols">
					<?php 
					if ($_SESSION['img_id'] > 0){
						$db_selected = dbSelect(CART_DATABASE);
						$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
						$img_result = mysql_query ($sql);
						if(!$img_result)die(mysql_error());
						if(mysql_num_rows($img_result) > 0){
							$img_obj = mysql_fetch_object($img_result);
							echo "<img src='".$ste_root."/ul_cart/".$domain."/banner/".$img_obj->file_name."' />";
						}
					}

					$url_str = $ste_root."manage/upload-pre-crop.php";
					$url_str .= "?ret_page=edit-global-discount";
					$url_str .= "&ret_dir=ecomsettings";

					?>
       				<a onClick="goto_isfancybox('<?php echo $url_str; ?>', '1')" class="btn btn-primary"><i class="icon-plus icon-white"></i>Upload new Image</a>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Discount Settings</legend>
				<div class="colcontainer">
					<div class="twocols">
						<label>Type</label>

						<select id='type' name="type">
                        
							<option value="discount" <?php if($_SESSION['temp_page_fields']['type'] == "discount") echo "selected" ?>>auto discount all products</option>
							<option value="coupon" <?php if($_SESSION['temp_page_fields']['type'] == "coupon") echo "selected" ?>>coupon all products</option>
							<option value="discount_closet" <?php if($_SESSION['temp_page_fields']['type'] == "discount_closet") echo "selected" ?>>auto discount closet only</option>
							<option value="coupon_closet" <?php if($_SESSION['temp_page_fields']['type'] == "coupon_closet") echo "selected" ?>>coupon closet only</option>
							<option value="discount_accessory" <?php if($_SESSION['temp_page_fields']['type'] == "discount_accessory") echo "selected" ?>>auto discount accessory only</option>
							<option value="coupon_accessory" <?php if($_SESSION['temp_page_fields']['type'] == "coupon_accessory") echo "selected" ?>>coupon accessory only</option>
						</select>
					</div>
					<div class="twocols" id="coupon_code_container">
						<?php if($_SESSION['temp_page_fields']['coupon_code'] != "" || $_SESSION['temp_page_fields']['type'] == "coupon"){ ?>
						<label>Coupon Code</label>
						<input type="text" name="coupon_code"  value="<?php echo $_SESSION['temp_page_fields']['coupon_code']; ?>" />
						<?php }else{ ?>
						<input type="hidden" name="coupon_code" value="<?php echo $_SESSION['temp_page_fields']['coupon_code']; ?>" />
						<?php } ?>
					</div>
				</div>
				<div class="colcontainer">
					<div class="twocols">
						<label>Percent Off</label>
						<input type="text" name="percent_off"  value="<?php echo $_SESSION['temp_page_fields']['percent_off']; ?>" onBlur="checkPercent(this)" 
                        class="appended"/><span class="append-input">%</span>
<span class="input_note">Integers bewteen 1 and 100 (cannot use with amount off)</span>
					</div>
					<div class="twocols">
						<label>Amount Off</label>
						<span class="prepend-input">$</span><input type="text" name="amount_off" class="prepended" value="<?php echo $_SESSION['temp_page_fields']['amount_off']; ?>" 
                        onBlur="checkNum(this)" />
						<span class="input_note">dollar amount (cannot use with percent off)</span>
					</div>
				</div>
			</fieldset>


<?php //echo "hide:".$_SESSION['temp_page_fields']['hide']; ?>

			<fieldset class="colcontainer">
				<legend>Conditions</legend>
					<div class="twocols">
						<label>Apply if <strong>Greater</strong> Than:</label>
						<span class="prepend-input">$</span><input type="text" class="prepended" name="if_greater_than"  value="<?php echo $_SESSION['temp_page_fields']['if_greater_than']; ?>" 
                        onBlur="checkNum(this)" />
						<span class="input_note">dollar amount</span>
						<label>Apply if <strong>Less</strong> Than:</label>
						<span class="prepend-input">$</span><input type="text" class="prepended" name="if_less_than"  value="<?php echo $_SESSION['temp_page_fields']['if_less_than']; ?>" 
                        onBlur="checkNum(this)" />
						<span class="input_note">dollar amount</span>
					</div>
					<div class="twocols">
						<label>Can be used with other discounts?</label>
						<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
                        <input type="checkbox" class="checkboxinput" name="can_use_with_other_discounts" value="1" 
						<?php if($_SESSION['temp_page_fields']['can_use_with_other_discounts'] > 0) echo "checked"; ?> /></div>
					</div>
			</fieldset>
		</div>



        
		<div class="savebar">
		<?php 
        if($admin_access->ecommerce_level > 1){
            echo "<button class='btn btn-success btn-large' id='submit_form' name='edit_global_discount' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this discount.</div>
        <?php } 
		
		$url_str = "global-discount.php";
		$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
		
		?>
        <button class="btn btn-large" type="button" value="Cancel" onClick="top.location.href = '<?php echo $url_str ?>'" >Cancel</button>
		</div>
	</form>
</div>


</body>
</html><?php $db_dis = dbDisconnect(); ?>
