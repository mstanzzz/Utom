<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){  
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; }elseif(strpos($_SERVER['REQUEST_URI'], "designitpro" )){  
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']."/designitpro"; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){  
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site'; 
}else{
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
}


require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php"); 
$msg = '';
$success = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/mce.css" />

<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/ui/jquery.ui.datepicker.js"></script>


<script>

$(document).ready(function() {
	
	//$("#datepicker1").datepicker();


	$( "#datepicker1" ).datepicker({ dateFormat: "yymmdd" });
	

});


function close_fancybox(){

	//alert("kkkkhhhhssss");
	
	//$.fancybox.close;
	//window.parent.jQuery.fn.fancybox.close();
	//parent.$.fancybox.close();
}



</script>
</head>

<body>





<div class="manage_page_container">

    

    <div class="manage_main">
    <?php
    

	//echo $msg;

    
	$costco_save_data_id = (isset($_GET["costco_save_data_id"])) ? $_GET["costco_save_data_id"] : 0;
	
	
	//$costco_save_data_id
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT shippingCode 
			FROM costco_save_data
			WHERE costco_save_data_id = '".$costco_save_data_id."'";
	 $result = $dbCustom->getResult($db,$sql);	 
	 if($result->num_rows){
	 	$object = $result->fetch_object();	
		$shippingCode = $object->shippingCode; 
	 }else{
		$shippingCode = '';
	 }
	 
	
	
    ?>

	<form name="upload_shipped_form" action="costco-order-list.php" method="post" target="_parent" enctype="multipart/form-data">
		<input type="hidden" name="costco_save_data_id" value="<?php echo $costco_save_data_id;?>" />
        
    
    <div style="float:left; width:340px;  padding-top:20px;">

        <div style="width:200px; float:right; padding-bottom:20px;">
            <input id="datepicker1" type="test" name="shipDate" value="yyyymmdd" />    
        </div>
        
        <div style="width:100px; float:right; padding-bottom:20px;">
            Ship Date
        </div>
        <div class="clear"></div>
    
        

        <div style="width:200px; float:right; padding-bottom:20px;">
            
            <?php
            require_once("costco-shippng-codes.php");	
			echo "<select id='shippingCode' name='shippingCode'>";
			echo "<option value=''>Select Code</option>";
			echo "<option value='NA'>N/A</option>";

			/*
			foreach($ship_code_array as $val){
				$sel = ($shippingCode == $val["code"])? "selected" : '';
				echo "<option value='".$val["code"]."' $sel>".$val['name']."</option>"; 	
			}
			*/

			foreach($ship_code_array as $key => $val){
				$sel = ($shippingCode == $key)? "selected" : '';				
				echo "<option value='".$key."' $sel>".$val."</option>"; 	
			}

			echo "</select>";				
            ?>
            
        </div>
        
        <div style="width:100px; float:right; padding-bottom:20px;">
            shippingCode
        </div>
        <div class="clear"></div>

        
        
        <div style="width:200px; float:right; padding-bottom:20px;">
            <input type="text" name="trackingNumber" />    
        </div>
        
        <div style="width:100px; float:right; padding-bottom:20px;">
            Tracking # 
        </div>
        <div class="clear"></div>
        
        <div style="width:100px; float:right; padding-right:10px;">
        
        <input type="submit" name="do_upload" value="Submit"  />
    	</div>
        
        <div class="clear"></div>
    
    </div>    
    
    </form>

	</div>
    
</div>


</body>
</html>



