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


if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Iframe";
$page_group = "admin";
$msg = '';


$iframe_id = $_GET["iframe_id"];

	



require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>


function validate(theform){	

	var commission_override = jQuery.trim(theform.commission_override.value);
	var domain_name = jQuery.trim(theform.domain_name.value);
	var card_num = jQuery.trim(theform.card_num.value);
	var exp_month = theform.exp_month.value
	var exp_year = theform.exp_year.value
	var billing_name_first = theform.billing_name_first.value
	var billing_name_last = theform.billing_name_last.value
	
	
	if(commission_override != ''){
		if(!checkPercent(commission_override)){
			return false;	
		}
	}
	
	if(domain_name == ''){
		alert("You must enter a domain name");
		return false;
	}

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

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",	
	content_css : "../css/mce.css"
});


</script>
</head>


<body>
<div class="manage_page_container">

    <div class="top_link">
    </div>	

    <div class="manage_main">
    
<?php

echo "<div class='manage_main_page_title'>".$page_title." </div>";
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
echo $bread_crumb->output();

$db = $dbCustom->getDbConnect(USER_DATABASE); 
$sql = sprintf("SELECT * FROM iframe WHERE id = '%u'", $iframe_id);
$result = $dbCustom->getResult($db,$sql);$object = $result->fetch_object();

?>

        <form action="re-generate-iframe.php">
        	<input type="hidden" name="iframe_id" value="<?php echo $iframe_id ?>" />
            <input type="submit" name="submit" value="re-generate code" />	
        
        </form>
	<br /><br />
    
        <form name="edit_iframe_form" action="iframe.php " method="post" onsubmit="return validate(this);">
       	<input id="iframe_id" type="hidden" name="iframe_id" value="<?php echo $iframe_id;  ?>" />
        	
		<table border="0" cellpadding="8">

        <tr>
        	<td><div class="head">Domain Name</div></td>
	        <td><input type="text" name="domain_name"  maxlength="160" size="30" value="<?php echo $object->domain_name;  ?>" /></td>
        </tr>



        <td colspan="2">
		<div style="float:left; padding-left:1px; padding-right:60px; padding-top:33px;">		
	        <input name="edit_iframe" type="submit" value="Save" />
        </div>
        <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input type="button" value="Cancel" onclick="location.href = 'iframe.php'; " />
        </div>
        </td>
        </tr>
        </table>
        </form>
</div>
<p class="clear"></p>

</div>
</body>
</html>



