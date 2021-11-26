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


//require_once("../admin-includes/braintree/lib/Braintree.php");


$page_title = "SaaS Customer Payment";
$page_group = "sas";
$msg = '';

	

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

	This page isn't yet styled but it might all get changed anyway    
<?php


echo "<div class='manage_main_page_title'>".$page_title." </div>";
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
echo $bread_crumb->output();


$profile_account_id = $_REQUEST['profile_account_id']; 


echo $profile_account_id;

$db = $dbCustom->getDbConnect(USER_DATABASE); 
$sql = sprintf("SELECT * 
				FROM profile_account 
				WHERE id = '%u'", $profile_account_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows){
	$object = $result->fetch_object();
	$company = $object->company;
	$billing_name_first = $object->billing_name_first;
	$billing_name_last = $object->billing_name_first;
}else{
	$company = '';
	$billing_name_first = '';
	$billing_name_last = '';
	
}



?>
    
        <form name="sas_cust_payment_form" action="sas-cust.php " method="post" onSubmit="return validate(this);">
       	<input id="profile_account_id" type="hidden" name="profile_account_id" value="<?php echo $profile_account_id;  ?>" />
        	
		<table border="0" cellpadding="8">

        <tr>
        	<td><div class="head">Company name</div></td>
	        <td><?php echo $company; ?></td>
        </tr> 
        
        
        <tr>
        	<td><div class="head">Billing first name</div></td>
	        <td><input type="text" name="billing_name_first" value="<?php echo $billing_name_first; ?>"  maxlength="160" size="30" /></td>
        </tr> 
        <tr>
        	<td><div class="head">Billing last name</div></td>
	        <td><input type="text" name="billing_name_last"  value="<?php echo $billing_name_last; ?>" maxlength="160" size="30" /></td>
        </tr> 

        <tr>
        	<td><div class="head">Charge amount</div></td>
	        <td><input type="text" name="amount" value='' maxlength="160" size="30" /></td>
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



