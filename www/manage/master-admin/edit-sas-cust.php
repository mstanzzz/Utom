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

$page_title = "Edit SaaS Customer";
$page_group = "admin-users";
$msg = '';

	

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>


function validate(theform){	

	var domain_name = jQuery.trim(theform.domain_name.value);
	var card_num = jQuery.trim(theform.card_num.value);
	var exp_month = theform.exp_month.value
	var exp_year = theform.exp_year.value
	var billing_name_first = theform.billing_name_first.value
	var billing_name_last = theform.billing_name_last.value

	var fee_fee_payment_method = theform.fee_fee_payment_method.value	
	
	if(domain_name == ''){
		alert("You must enter a domain name");
		return false;
	}


	if(fee_payment_method == "cc"){

		if(card_num != ''){
			if(!IsNumeric(card_num)){
				alert("The credit card number must be numeric");
				return false;
			}
	
			if(card_num.length < 13){
				alert("You must enter a credit card number with at least 13 digits");
				return false;
			}
	
			var d=new Date(); 
			var year2digit = parseInt(d.getFullYear().toString().substring(2));
			
			if((parseInt(exp_year) <= year2digit) && (parseInt(exp_month)<(d.getMonth()+1))){
				alert("Please enter a valid expiration date");
				return false;
			}
			
			if(billing_name_first == '' || billing_name_last == ''){
				alert("You must enter a billing first and last name");
				return false;
			}
	
		}
	}
	
	return true;

}

function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;   
}

function checkPercent(str){
	
	var ret = 1;
	
	if(!IsNumeric(str)){
		alert("Please enter valid numbers only");
		ret = 0;	
	}else{	
		if(str != 0 && str <= 1){
			alert("Please enter 0 or a number greater than 1");
			ret = 0;
		}
		
		if(str >= 100){
			alert("Please enter a number less than 100");
			ret = 0;
		}
	}
	
	return ret;
}


function show_iframe_input(){
	if($("#ifrm").attr('checked')){
		$("#iframes_allowed").show();
	}else{
		$("#iframes_allowed").hide();		
	}
}



</script>
</head>
<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		$e_profile_account_id = $_GET['e_profile_account_id']; 
		
		//echo $e_profile_account_id;
		
		
		$db = $dbCustom->getDbConnect(USER_DATABASE); 
		$sql = sprintf("SELECT * FROM profile_account WHERE id = '%u'", $e_profile_account_id);
$result = $dbCustom->getResult($db,$sql);		$object = $result->fetch_object();
		
		$url_str = "sas-cust.php";
		$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
		
		?>
		<form name="edit_sas_cust_form" action="<?php echo $url_str; ?>" method="post" onSubmit="return validate(this);">
			<input type="hidden" name="e_profile_account_id" value="<?php echo $e_profile_account_id;  ?>" />
			<div class="page_actions edit_page">
				<button  name="edit_account" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </button>
				<hr />
				<a class="btn" href="<?php echo $url_str; ?>"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a><br />
				<a class="btn btn-primary toggleFieldsets" href="#"><i class="icon-minus-sign icon-white icon-white"></i> Collapse All Edit Areas </a><br />

			</div>
			<div class="page_content edit_page">






				<fieldset class="edit_content">
					<legend>Configuration &amp; Permissions<i class='icon-minus-sign icon-white'></i></legend>
					
                    
                    <?php if(getProfileType() == "master"){ ?>
                    <div class="colcontainer formcols">
						<div class="twocols">
							<label>Parent Company</label>
						</div>
						<div class="twocols">
							<select name="parent_id" style="width:120px;">
								<?php
								$sql = "SELECT id, company
										FROM profile_account 
										WHERE active = '1'
										ORDER BY company"; 
								$res = $dbCustom->getResult($db,$sql);
								
								 $block = '';
								 $block .= "<option value='0'>none</option>";			 
								 while($c_row = mysql_fetch_object($c_rest)) {
									$sel =  ($c_row->id == $object->parent_id) ? "selected" : '';
									$block .= "<option value='".$c_row->id."' $sel >$c_row->company</option>";
								 }
								echo $block;
							?>
							</select>
						</div>
					</div>
                    <?php }else{ echo "<input type='hidden' name='parent_id' value='".$_SESSION['profile_account_id']."'>"; }?>
                    
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Profile Type</label>
						</div>
						<div class="twocols">
							<select name="profile_account_type_id" style="width:120px;">
								<?php 
								$sql = "SELECT id, name 
										FROM profile_account_type
										ORDER BY id"; 
								$result = $dbCustom->getResult($db,$sql);
								
								 $block = '';
								 $block .= "<option value='0'>none</option>";			 
								 while($row = $res->fetch_object()) {
									$sel =  ($row->id == $object->profile_account_type_id) ? "selected" : '';	
									$block .= "<option value='".$row->id."' $sel >$row->name</option>";
								 }
								echo $block;
							?>
							</select>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Company</label>
						</div>
						<div class="twocols">
							<input type="text" name="company"  maxlength="160" value="<?php echo stripslashes($object->company);  ?>" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Domain Name</label>
						</div>
						<div class="twocols">
							<input type="text" name="domain_name"  maxlength="160" value="<?php echo $object->domain_name;  ?>" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Administrator name</label>
						</div>
						<div class="twocols">
							<?php
							
							//echo $e_profile_account_id;
							
								$sql = "SELECT name, username 
										FROM user 
										WHERE profile_account_id = '".$e_profile_account_id."'
										AND user_type_id = '7'"; 
								$result = $dbCustom->getResult($db,$sql);
									
								if($result->num_rows > 0){
									$u_obj = $result->fetch_object();	
									$admin_name = $u_obj->name;
									$admin_username = $u_obj->username;
								}else{
									$admin_name = '';
									$admin_username = '';	
								}
							
							?>
							<input type="text" name="admin_name"  maxlength="160"  value="<?php echo stripslashes($admin_name);  ?>"/>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Administrator User Name</label>
						</div>
						<div class="twocols">
							<input type="text" name="admin_username"  maxlength="160"  value="<?php echo $admin_username;  ?>"/>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Administrator Password</label>
						</div>
						<div class="twocols">
							leave this blank if you don't want to change it.
                            <input type="text" name="admin_password" autocomplete="off" maxlength="160"  value=''/>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Enabled Add-Ons</label>
						</div>
						<div class="twocols">
							<div class="data_table">
                                <table border="0" cellpadding="10">
                                    <thead>
                                        <tr>
                                            <th>Enable</th>
                                            <th>Addon Name</th>
                                            <th>Fee</th>
                                        </tr>
                                    </thead>
									<?php
									$sql = "SELECT id, name 
									FROM module ";
							$result = $dbCustom->getResult($db,$sql);									
									$block = '';
								
									while($row = $result->fetch_object()) {
										$block .= "<tr>";
										
										$sql = "SELECT id, fee 
										FROM profile_account_to_module
										WHERE module_id = '".$row->id."'
										AND profile_account_id = '".$e_profile_account_id."'";					
										$res = $dbCustom->getResult($db,$sql);
										
										if($res->num_rows > 0){
											$m_obj = $res->fetch_object();
											//$m_obj = mysql_fetch_object($m_res);
											$fee = $m_obj->fee; 
											$checked = "checked = 'checked'"; 
										
										}else{
											$fee = 0.00;
											$checked = '';
										}
										$block .= "<td>";									
										
										if(strlen(stristr($row->name,"iframe")) > 6){
											$block .= "<input id='ifrm' class='fltlft mR15' name='module_ids[]' type='checkbox' value='".$row->id."' onclick='show_iframe_input()' $checked/>";
										}else{
											$block .= "<input class='fltlft mR15' name='module_ids[]' type='checkbox' value='".$row->id."' $checked />";						
										}
										$block .= "</td>";


									
										$block .= "<td>$row->name</td>";
									
									
										$block .= "<td><input type='text' name='".$row->id."_fee' value='".$fee."' style='width:50px;'> </td>";
										
									
										$block .= "</tr>";
									}
								echo $block;

							?>
								
    							</table>
    						</div>

						</div>
					</div>
					
					<div id="iframes_allowed" style="display:<?php echo ($module->hasIframeModule($e_profile_account_id)) ? "block" : "none"; ?>">
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>IFRAMEs Allowed?</label>
                            </div>
                            <div class="twocols">
                                <input style="width:20px;" type="text" name="iframes_allowed" value="<?php echo $object->iframes_allowed;  ?>" />
                            </div>
                        </div>
                    </div>

               
                	<?php
					if(getProfileType() == "master"){ 
						$pages = new Pages;
						$optional_pages_array = $pages->getOptionalPages($e_profile_account_id);
						if(sizeof($optional_pages_array) > 0){
							$block = '';
							$block .= "<div class='colcontainer formcols'>";
							$block .= "<div class='twocols'><label>Optional Pages</label></div>";
							$block .= "<div class='twocols'>";
							$block .= "<select multiple='multiple' name='available_pages[]' data-placeholder='Check Optional Pages'>";
							foreach($optional_pages_array as $value){
								$sel = ($value['available']) ? "selected" : ''; 
								$block .= "<option value='".$value['page_seo_id']."' $sel>".stripslashes($value['page_name'])."</option>";
							}
							$block .= "</select></div></div>";
							echo $block;
						}
					}
					?>
                    
				</fieldset>
                
                




                
                
                
				<fieldset class="edit_content">
					<legend>Billing Details<i class='icon-minus-sign icon-white'></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Recurring Billing Amount</label>
						</div>
						<div class="twocols"> <span class="prepend-input">$</span>
							<input type="text" class="prepended" name="recurring_billing_amount" value="<?php echo $object->braintree_recurring_billing_amount;  ?>"  maxlength="160"  />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Recurring Billing ID</label>
						</div>
						<div class="twocols">
							<input type="text" name="recurring_billing_id"  maxlength="160"  value="<?php echo $object->recurring_billing_id;  ?>" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Fee Payment Method</label>
						</div>
						<div class="twocols">
							<select name="fee_payment_method">
								<option value="cc" <?php if($object->fee_payment_method == "cc") echo "selected"; ?>>Pay by Credit Card</option>
								<option value="manual" <?php if($object->fee_payment_method == "manual") echo "selected"; ?>>Pay Manually</option>
							</select>
						</div>
					</div>
					<div class="alert alert-info">Leave Credit Card payment detail fields blank unless you want to make changes!</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>First Name</label>
							<input type="text" name="billing_name_first"  value="<?php echo stripslashes($object->billing_name_first);  ?>" maxlength="160"  />
						</div>
						<div class="twocols">
							<label>Last Name</label>
							<input type="text" name="billing_name_last" value="<?php echo stripslashes($object->billing_name_last);  ?>" maxlength="160"  />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Credit card number</label>
						</div>
						<div class="twocols">
							<input type="text" name="card_num" value="4111111111111111" autocomplete="off" maxlength="160"  />
							<br />
						</div>
					</div>
					<div class="colcontainer">
						<label>Credit Card Expiration</label>
						<div class="twocols">
							<select id="input_exp_m" name="exp_month" style="width: 80px;">
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
						</div>
						<div class="twocols">
							<select id="input_exp_y" name="exp_year" style="width: 100px;">
								<?php
							$year_4digit =  date("Y");
							$year_2digit =  date("y");
							$year_array = '';
							for($i = 0; $i < 8; $i++){
								echo "<option value='".$year_2digit."'   >".$year_4digit."</option>";      
								$year_2digit++;
								$year_4digit++;
							}
							?>
							</select>
						</div>
					</div>
					<div class="colcontainer checkboxcols">
						<div class="twocols">
							<label>Charge for Shipping?</label>
							<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
								<input type="checkbox" class="checkboxinput" name="is_shipping_charges" value="1" <?php if($object->is_shipping_charges == 1) echo "checked";?> />
							</div>
						</div>
						<div class="twocols">
							<label>SSL Enabled?</label>
							<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
								<input type="checkbox" class="checkboxinput" name="is_ssl" value="1" <?php if($object->is_ssl == 1) echo "checked";?> />
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset class="edit_content">
					<legend>Contact Info &amp; Billing Address <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer">
						<div class="twocols">
							<label>email</label>
							<input type="text" name="email"  maxlength="160"  value="<?php echo $object->email;  ?>" />
						</div>
						<div class="twocols">
							<label>contact email</label>
							<input type="text" name="contact_email"  maxlength="160"  value="<?php echo $object->email;  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>first name</label>
							<input type="text" name="name_first"  maxlength="160"  value="<?php echo stripslashes($object->name_first);  ?>" />
						</div>
						<div class="twocols">
							<label>last name</label>
							<input type="text" name="name_last"  maxlength="160"  value="<?php echo stripslashes($object->name_last);  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>phone</label>
							<input type="text" name="phone"  maxlength="160"  value="<?php echo $object->phone;  ?>" />
						</div>
						<div class="twocols">
							<label>address</label>
							<input type="text" name="address"  maxlength="160"  value="<?php echo stripslashes($object->address);  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>city</label>
							<input type="text" name="city"  maxlength="160"  value="<?php echo stripslashes($object->city);  ?>" />
						</div>
						<div class="twocols">
							<label>state</label>
							<select name="state" style="width:120px;">
								<?php 
							$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
							$sql = "SELECT state, state_abr 
									FROM states 
									WHERE hide = '0'
									AND profile_account_id = '1' 
									ORDER BY country DESC, state"; 
					$result = $dbCustom->getResult($db,$sql);							//
							 $block = '';
							 $block .= "<option value=''>----select----</option>";			 
							 while($row = $result->fetch_object()) {
								$sel =  ($object->state == $row->state_abr) ? "selected" : '';	
								$block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
							 }
							echo $block;
						?>
							</select>
						</div>
					</div>
                    <div class="colcontainer">
						<label>zip</label>
						<input type="text" name="zip"  maxlength="160"  value="<?php echo $object->zip;  ?>" />
					</div>
				</fieldset>
			</div>
		</form>
	</div>
	<p class="clear"></p>
<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>       
</div>
</body>
</html>
