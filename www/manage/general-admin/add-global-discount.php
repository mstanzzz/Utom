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


$page_title = "Add Global Discount";
$page_group = "discount";


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);





//$aLgn = new AdminLogin;
/*
if(!$aLgn->isLogedIn()){
	$aLgn->redirect("index.php", "Please Log In");	
}
$user_level = $aLgn->getUserLevel();
$user_id = $aLgn->getUserId();
*/
//$page ="miscellaneous";




require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>

<script>

$(document).ready(function() {
	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();
	
	$('#clear_dates').click(function() {
		$('#datepicker1').val('');
		$('#datepicker2').val('');
	});
	
	$("#type").change(function() {	
		 //alert($(this).val());
		 //alert($(this).val().indexOf("coupon"));
		var htmlstr;			
		if($(this).val().indexOf("coupon")>=0){
			htmlstr = "Coupon Code &nbsp; <input type='text' name='coupon_code' style='width:280px;' />";
			$("#coupon_code_container").html(htmlstr);
		}else{
			htmlstr = "<input type='hidden' name='coupon_code' value='' />";
			$("#coupon_code_container").html(htmlstr);			
		}
	});

});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});

function validate(theform){	

		
		if(theform.percent_off.value != '' && theform.amount_off.value != ''){
			if(theform.percent_off.value > 0 && theform.amount_off.value > 0){
				alert("You cannot have values for both percent off and amount off \n Please enter only one value.");
				return false;
			}
		}

	
	return true;
}

function checkPercent(elem){
	if(!IsNumeric(elem.value)){
		alert("Please enter valid numbers only");
	}else{	
		
		if(elem.value != 0 && elem.value <= 1){
			alert("Please enter 0 or an integer greater than 1");
		}
		
		if(elem.value >= 100){
			alert("Please enter a number less than 100");
		}
	}
}

function checkNum(elem){
		
	if(!IsNumeric(elem.value)){
		alert("Please enter valid numbers only");
	}
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
/*
 */
</script>
</head>

	<body>

<div class="manage_page_container">


	<div class="top_link">
    <?php
	$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "start";
	echo "<a href='".$ret_page.".php'>< BACK</a>";
	?>        
    </div> 


    <div class="manage_main">

	<?php 

		echo "<div class='manage_main_page_title'>Items:  ".$page_title."</div>";
    
        $bc = $bread_crumb->output();
        echo $bc."<br />"; 
	
	?>	


    <form  name="add_global_discount_form" action="global-discount.php" method="post" 
       onsubmit="return validate(this);" enctype="multipart/form-data">
    
    <table width="100%" border="0" cellpadding="8px">
        <tr>
        <td width="25%" height="40">Set Current Status</td>
        <td>
            <div style="float:left; padding-right:60px;">
            Active &nbsp;
            <input type="radio" name="hide" value="0" />
            </div>
            <div style="float:left; padding-right:60px;">
            Not active &nbsp;
            <input type="radio" name="hide"  value="1" />    
            </div>
            <div style="font-size:12px; color:blue;">
            No need to change this if using dates below.
            </div>
        </td>
        </tr>
        <tr>
        <td height="40" valign="top">
        Time Span
        <div style="padding-top:4px;">
        <a href="#" id="clear_dates"><span style="font-size:12px;color:blue;">clear dates</span></a>
        </div>
        </td>
        <td valign="top">
            <div style="float:left; padding-right:60px;">
                When to activate<br />
                <input type="text" name="when_active" id="datepicker1" style="width:80px;"/>
                 &nbsp;<span style="font-size:10px;">12:00am</span> 
            </div>
            <div style=" float:left;">
                When to expire<br /> 
                <input type="text" name="when_expired" id="datepicker2" style="width:80px;"/> 
                &nbsp;<span style="font-size:10px;">11:59pm</span>
            </div>
        </td>
        </tr>
        <tr>
        <td>Name</td>
        <td><input type="text" name="name" style="width:280px;" />&nbsp;&nbsp;
        </td>
        </tr>
        <tr>
        <td>Type</td>
        <td>
            <div style="float:left; padding-right:40px;">
            <select id='type' name="type">
            <option value="discount" >auto discount all products</option>
            <option value="coupon" >coupon all products</option>
            <option value="discount_closet" >auto discount closet only</option>
            <option value="coupon_closet" >coupon closet only</option>
            <option value="discount_accessory" >auto discount accessory only</option>
            <option value="coupon_accessory" >coupon accessory only</option>
            </select>
            </div>
            <div id="coupon_code_container" style="float:left;">    
            <input type="hidden" name="coupon_code" value='' />
            </div>
        </td>
        </tr>
        <tr>
        <td>Percent off</td>
        <td>%<input type="text" name="percent_off" style="width:80px;"  onblur="checkPercent(this)"/>&nbsp;&nbsp;
        <span style="font-size:12px; color:blue">Integers bewteen 1 and 100 (cannot use along with amount off)  </span></td>
        </tr>
        <tr>
        <td>Amount off</td>
        <td>$<input type="text" name="amount_off" style="width:80px;"  onblur="checkNum(this)" />&nbsp;&nbsp;
        <span style="font-size:12px; color:blue">dollar amoung (cannot use along with percent off)</span></td>
        </tr>
        <tr>
        <td>Apply if geater than</td>
        <td>$<input type="text" name="if_greater_than" style="width:80px;" onBlur="checkNum(this)" />&nbsp;&nbsp;
         <span style="font-size:12px; color:blue">dollar amoung</span></td>
        </tr>
        <tr>
        <td>Apply if less than</td>
        <td>$<input type="text" name="if_less_than" style="width:80px;" onBlur="checkNum(this)" />&nbsp;&nbsp;
         <span style="font-size:12px; color:blue">dollar amoung</span></td>
        </tr>    
        <tr>
        <td>Apply with other discounts?</td>
        <td>
        Yes &nbsp;
        <input type="radio" name="can_use_with_other_discounts" value="1" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        No &nbsp;
        <input type="radio" name="can_use_with_other_discounts" checked value="0" />    
        </td>
        </tr>
        <tr>
        <td colspan="2">
        <br />Description<br />
        <textarea name="description" cols="80" rows="2">
        
        </textarea>
        </td>
        </tr>    	
        <tr>
        <td colspan="2">
        <div style="float:left; padding-right:100px; padding-top:15px;">
            <input name='add_global_discount' type='submit' value='Submit' />
        </div>
        <div style="float:left; padding-top:15px;">
        <input type="button" value="Cancel" onClick="location.href = 'global-discount.php'" />
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



