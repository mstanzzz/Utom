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

$progress = new SetupProgress;
$module = new Module;
$page_title = "Add SAS Customer";
$page_group = "admin";

	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$msg = '';



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<script>

function validate(theform){	

	var commission_override = jQuery.trim(theform.commission_override.value);
	var domain_name = jQuery.trim(theform.domain_name.value);
	
	var admin_name = jQuery.trim(theform.admin_name.value);
	var admin_username = jQuery.trim(theform.admin_username.value);
	var admin_password = jQuery.trim(theform.admin_password.value);
	var email = jQuery.trim(theform.email.value);
	
	
	
	var card_num = jQuery.trim(theform.card_num.value);
	var exp_month = theform.exp_month.value;
	var exp_year = theform.exp_year.value;
	var billing_name_first = theform.billing_name_first.value;
	var billing_name_last = theform.billing_name_last.value;


	var fee_payment_method = theform.fee_payment_method.value
	//alert(fee_payment_method);
	
	
	if(commission_override != ''){
		if(!checkPercent(commission_override)){
			return false;	
		}
	}
	
	if(domain_name == ''){
		alert("You must enter a domain name");
		return false;
	}
	
	if(admin_name == ''){
		alert("You must enter the administrator name");
		return false;
	}
	if(admin_username == ''){
		alert("You must enter the administrator login user name");
		return false;
	}
	if(admin_password == ''){
		alert("You must enter a administrator login password");
		return false;
	}
	if(email == ''){
		alert("You must enter an email");
		return false;
	}
	

	if(fee_payment_method == "cc"){
	
		if(billing_name_first == '' || billing_name_last == ''){
			alert("You must enter a billing first and last name");
			return false;
		}
	
		if(card_num == ''){
			alert("You must enter a credit card number");
			return false;
		}else{
			if(!IsNumeric(card_num)){
				alert("The credit card number must be numeric");
				return false;
			}
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
        
		
		
		?>
		<form name="add_sas_cust_form" action="sas-cust.php " method="post" onSubmit="return validate(this);">
			<div class="page_actions edit_page">
				<button name="add_account" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Add New  Customer </button>
				<hr />
				<a class="btn" href="sas-cust.php"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a><br />
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
								$db = $dbCustom->getDbConnect(USER_DATABASE); 

								$sql = "SELECT id, company
										FROM profile_account 
										WHERE active = '1'
										ORDER BY company"; 
										
								$res = $dbCustom->getResult($db,$sql);
								 $block = '';
								 $block .= "<option value='0'>none</option>";			 
								 while($c_row = $res->fetch_object()) {
									$sel =  ($c_row->id == $_SESSION['profile_account_id']) ? "selected" : '';
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
							<label>Company</label>
						</div>
						<div class="twocols">
							<input type="text" name="company"  maxlength="160" value='' />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Domain Name</label>
						</div>
						<div class="twocols">
							<input type="text" name="domain_name"  maxlength="160" value='' />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Administrator name</label>
						</div>
						<div class="twocols">
							<input type="text" name="admin_name"  maxlength="160"  value=''/>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Administrator User Name</label>
						</div>
						<div class="twocols">
							<input type="text" name="admin_username"  maxlength="160"  value=''/>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Administrator Password</label>
						</div>
						<div class="twocols">
							<input type="password" name="admin_password"  autocomplete="off" maxlength="160"  value=''/>
						</div>
					</div>
   					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Confirm Administrator Password</label>
						</div>
						<div class="twocols">
							<input type="password" name="confirm_admin_password" autocomplete="off" maxlength="160"  value=''/>
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
									$sql = "SELECT id, name, fee 
									FROM module ";
									$result = $dbCustom->getResult($db,$sql);									
									$block = '';
									while($row = $result->fetch_object()) {
										$block .= "<tr>";
										$block .= "<td>";																			
										if(strlen(stristr($row->name,"iframe")) > 6){
											$block .= "<h3><input id='ifrm' class='fltlft mR15' name='module_ids[]' type='checkbox' value='".$row->id."' onclick='show_iframe_input()'>";
										}else{
											$block .= "<h3><input class='fltlft mR15' name='module_ids[]' type='checkbox' value='".$row->id."' >";						
										}
										$block .= "</td>";
										$block .= "<td>$row->name</td>";
										$block .= "<td><input type='text' name='".$row->id."_fee' value='".$row->fee."' style='width:50px;'> </td>";
										$block .= "</tr>";
									}
								echo $block;

							?>
								
    							</table>
    						</div>

						</div>
					</div>

                    
                    <div id="iframes_allowed" style="display:none">
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>IFRAMEs Allowed?</label>
                            </div>
                            <div class="twocols">
                                <input style="width:20px;" type="text" name="iframes_allowed" value='' />
                            </div>
                        </div>
                    </div>
                    
                    
                    
					<?php 
					if(getProfileType() == "master"){
						if(!isset($optional_pages_array)) $optional_pages_array = array();
						if(sizeof($optional_pages_array) > 0){
						$pages = new Pages;
						$optional_pages_array = $pages->getOptionalPageNames();
							$block = '';
							$block .= "<div class='colcontainer formcols'>";
							$block .= "<div class='twocols'><label>Optional Pages</label></div>";
							$block .= "<div class='twocols'>";
							$block .= "<select multiple='multiple' name='available_pages[]' data-placeholder='Check Optional Pages'>";
							foreach($optional_pages_array as $value){
								$block .= "<option value='".$value."'>".$value."</option>";
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
							<input type="text" class="prepended" name="recurring_billing_amount" value=''  maxlength="160"  />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Recurring Billing ID</label>
						</div>
						<div class="twocols">
							<input type="text" name="recurring_billing_id"  maxlength="160"  value='' />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Fee Payment Method</label>
						</div>
						<div class="twocols">
							<select name="fee_payment_method">
								<option value="cc">Pay by Credit Card</option>
								<option value="manual">Pay Manually</option>
							</select>
						</div>
					</div>
					<div class="alert alert-info">Leave Credit Card payment detail fields blank unless you want to make changes!</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>First Name</label>
							<input type="text" name="billing_name_first"  value='' maxlength="160"  />
						</div>
						<div class="twocols">
							<label>Last Name</label>
							<input type="text" name="billing_name_last" value='' maxlength="160"  />
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
							<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span><input type="checkbox" class="checkboxinput" name="is_shipping_charges" value="1" checked="checked" /></div>
						</div>
						<div class="twocols">
							<label>SSL Enabled?</label>
							<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span><input type="checkbox" class="checkboxinput" name="is_ssl" value="1" checked="checked" />
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset class="edit_content">
					<legend>Contact Info &amp; Billing Address <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer">
						<div class="twocols">
							<label>email</label>
							<input type="text" name="email"  maxlength="160"  value='' />
						</div>
						<div class="twocols">
							<label>contact email</label>
							<input type="text" name="contact_email"  maxlength="160"  value='' />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>first name</label>
							<input type="text" name="name_first"  maxlength="160"  value='' />
						</div>
						<div class="twocols">
							<label>last name</label>
							<input type="text" name="name_last"  maxlength="160"  value='' />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>phone</label>
							<input type="text" name="phone"  maxlength="160"  value='' />
						</div>
						<div class="twocols">
							<label>address</label>
							<input type="text" name="address"  maxlength="160"  value='' />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>city</label>
							<input type="text" name="city"  maxlength="160"  value='' />
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
								$block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
							 }
							echo $block;
						?>
							</select>
						</div>
					</div>
					
                    <div class="colcontainer">
						<label>zip</label>
						<input type="text" name="zip"  maxlength="160"  value='' />
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