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



//require_once($_SERVER['DOCUMENT_ROOT']."/includes/braintree/lib/Braintree.php");


$page_title = "SaaS Customer Payment";
$page_group = "sas";
$msg = '';

	




if(isset($_POST["pay"])){
	
	$profile_account_id = $_POST['profile_account_id'];
	$billing_name_first = trim(addslashes($_POST["billing_name_first"])); 
	$billing_name_last = trim(addslashes($_POST["billing_name_last"])); 
	$billing_address_one = trim(addslashes($_POST["billing_address_one"])); 
	$billing_address_two = trim(addslashes($_POST["billing_address_two"])); 
	$billing_city = trim(addslashes($_POST["billing_city"])); 
	$billing_state = trim($_POST["billing_state"]); 
	$billing_zip = trim(addslashes($_POST["billing_zip"])); 
	$card_num = trim(addslashes($_POST["card_num"])); 
	$card_auth_code = trim(addslashes($_POST["card_auth_code"])); 
	$exp_month = trim($_POST["exp_month"]); 
	$exp_year = trim($_POST["exp_year"]); 
	
	
	$msg = "need ";	
	

}





require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script>

function validate(theform){	

/*
	var card_num = jQuery.trim(theform.card_num.value);
	var exp_month = theform.exp_month.value;
	var exp_year = theform.exp_year.value;
	var card_auth_code = jQuery.trim(theform.card_auth_code.value);
	var amount = jQuery.trim(theform.amount.value);
	var d=new Date(); 
	var year2digit = parseInt(d.getFullYear().toString().substring(2));
	
	
	//if(card_num.length < 15)
	
	
	if((parseInt(exp_year) <= year2digit) && (parseInt(exp_month)<(d.getMonth()+1))){
		alert("The expiration date is expired");
		return false;
	}
	


	if(!IsNumeric(amount)){
		alert("Please enter a valid number for charge amount");
		return false;
		
	}

*/

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
function checkPercent(elem){
	
	var ret = 1;
	
	elem = jQuery.trim(elem.value);
	
	if(!IsNumeric(elem.value)){
		alert("Please enter valid numbers only");
		ret = 0;	
	}else{	
		if(elem.value != 0 && elem.value <= 1){
			alert("Please enter 0 or a number greater than 1");
			ret = 0;
		}
		
		if(elem.value >= 100){
			alert("Please enter a number less than 100");
			ret = 0;
		}
	}
	
	return ret;
}



tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",	
	content_css : "../css/mce.css"
});


</script>
</head>


<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	

    <div class="manage_main">
    
<?php



echo "<div class='manage_main_page_title'>".$page_title." </div>";
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
echo $bread_crumb->output();


$profile_account_id = $_REQUEST['profile_account_id']; 





$db = $dbCustom->getDbConnect(USER_DATABASE); 
$sql = sprintf("SELECT * FROM profile_account WHERE id = '%u'", $profile_account_id);
$result = $dbCustom->getResult($db,$sql);

$object = $result->fetch_object();


?>
    
        <form name="sas_cust_payment_form" action="sas-cust-payment.php " method="post" onSubmit="return validate(this);">
       	<input id="profile_account_id" type="hidden" name="profile_account_id" value="<?php echo $profile_account_id;  ?>" />
        	
		<table border="0" cellpadding="8">

        <tr>
        	<td><div class="head">Company name</div></td>
	        <td><?php echo $object->company; ?></td>
        </tr> 
        
        
        <tr>
        	<td><div class="head">Billing first name</div></td>
	        <td><input type="text" name="billing_name_first" value="<?php echo $object->billing_name_first; ?>"  maxlength="160" size="30" /></td>
        </tr> 
        <tr>
        	<td><div class="head">Billing last name</div></td>
	        <td><input type="text" name="billing_name_last"  value="<?php echo $object->billing_name_first; ?>" maxlength="160" size="30" /></td>
        </tr> 

        <tr>
        	<td><div class="head">Billing address</div></td>
	        <td><input type="text" name="billing_address_one"  value="<?php echo $object->billing_address_one; ?>" maxlength="160" size="30" /></td>
        </tr> 
        
        <tr>
        	<td><div class="head">Billing address</div></td>
	        <td><input type="text" name="billing_address_two"  value="<?php echo $object->billing_address_two; ?>" maxlength="160" size="30" /></td>
        </tr> 
        <tr>
        	<td><div class="head">Billing city</div></td>
	        <td><input type="text" name="billing_city" value="<?php echo $object->billing_city; ?>" maxlength="160" size="30" /></td>
        </tr> 
        <tr>
        	<td><div class="head">Billing state</div></td>
	        <td>
            <select name="billing_state" style="width:120px;">
            <?php 
                $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
                $sql = "SELECT state, state_abr 
						FROM states 
						WHERE hide = '0'
						AND profile_account_id = '1' 
						ORDER BY country DESC, state"; 
                $result = $dbCustom->getResult($db,$sql);                
                 $block = '';
	             $block .= "<option value=''>----select----</option>";			 
                 while($row = $result->fetch_object()) {
					 
					$selected = ($row->state_abr == $object->billing_state) ? "selected" : ''; 
					$block .= "<option value='".$row->state_abr."' $selected>$row->state</option>";
                 }
                echo $block;
            ?>
            </select>
            </td>
        </tr> 
        <tr>
        	<td><div class="head">Billing zip</div></td>
	        <td><input type="text" name="billing_zip" value="<?php echo $object->billing_zip; ?>" maxlength="160" size="30" /></td>
        </tr> 


        <tr>
        	<td><div class="head">Charge amount</div></td>
	        <td><input type="text" name="amount" value='' maxlength="160" size="30" /></td>
        </tr> 


        <tr>
        	<td><div class="head">Credit card number</div><br />
            <?php
				if(strlen($object->cc_hash) > 0){
					echo "The cc number has been stored<br />Leave this blank unless change is needed";	
				}
			?>
            </td>
	        <td><input type="text" name="card_num"  maxlength="160" size="30" /></td>
        </tr> 
        <tr>
        	<td><div class="head">Credit card code</div></td>
	        <td><input type="text" name="card_auth_code"  value="<?php echo $object->card_auth_code; ?>" maxlength="160" size="30" /></td>
        </tr> 
        <tr>
        	<td><div class="head">Credit card expiration</div></td>
	        <td>

		<select id="input_exp_m" name="exp_month">
           <option value="01" <?php if($object->exp_month == "01") echo "selected"?>>01</option>
           <option value="02" <?php if($object->exp_month == "02") echo "selected"?>>02</option>
           <option value="03" <?php if($object->exp_month == "03") echo "selected"?>>03</option>
           <option value="04" <?php if($object->exp_month == "04") echo "selected"?>>04</option> 
           <option value="05" <?php if($object->exp_month == "05") echo "selected"?>>05</option>
           <option value="06" <?php if($object->exp_month == "06") echo "selected"?>>06</option>
           <option value="07" <?php if($object->exp_month == "07") echo "selected"?>>07</option>
           <option value="08" <?php if($object->exp_month == "08") echo "selected"?>>08</option>
           <option value="09" <?php if($object->exp_month == "09") echo "selected"?>>09</option>
           <option value="10" <?php if($object->exp_month == "10") echo "selected"?>>10</option>
           <option value="11" <?php if($object->exp_month == "11") echo "selected"?>>11</option>
           <option value="12" <?php if($object->exp_month == "12") echo "selected"?>>12</option>
         </select>
        
        
         <select id="input_exp_y" name="exp_year" >
			<?php
            $year_4digit =  date("Y");
            $year_2digit =  date("y");
            $year_array = '';
            for($i = 0; $i < 8; $i++){
				$selected = ($year_2digit == $object->exp_year) ? "selected" : '';
				echo "<option value='".$year_2digit."' $selected>".$year_4digit."</option>";      
				$year_2digit++;
				$year_4digit++;
            }
            ?>
         </select>
            </td>
        </tr> 

        <td colspan="2">
		<div style="float:left; padding-left:1px; padding-right:60px; padding-top:33px;">		
	        <input name="pay" type="submit" value="Pay" />
        </div>
        <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input type="button" value="Cancel" onClick="location.href = 'sas-cust.php'; " />
        </div>
        </td>
        </tr>
        </table>
        </form>



	<table border="0" cellpadding="8"> 

<?php

                $db = $dbCustom->getDbConnect(USER_DATABASE);
                $sql = "SELECT * 
						FROM profile_account_payment 
						WHERE profile_account_id = '".$profile_account_id."'";
                $result = $dbCustom->getResult($db,$sql);                
                 $block = '';
                 while($row = $result->fetch_object()) {
					
					$block .= "<tr>";
					$block .= "<td>".$row->trans_id."</td>";
					$block .= "<td>$".$row->amount."</td>";
					$block .= "<td>$".date("m/d/Y",$row->trans_date)."</td>";
					
					
					
					$block .= "</tr>";
					
				 }
?>

</table>







</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>       

</div>
</body>
</html>



