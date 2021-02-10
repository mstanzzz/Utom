<?php
require_once("../../../includes/config.php"); 

$ts = time();

$msg = ''; 

//************ decription vars **************/
$gpgkeydir = "/home/organize/.gnupg"; 
$uid = "mike@closetstogo.com"; 
$passphrase = "Ctg18765Ghblk8%gh"; 
$gpg = '/usr/bin/gpg'; 
putenv("GNUPGHOME=$gpg"); 
global $gnupghome; 
global $path_to_gpg; 


/************  ftp get the files ************/
$ftp_server = "ihub1.commercehub.com";
$ftp_user_name = "closetstogo";
$ftp_user_pass = "DxW1246mn";

//$ftp_server = "ftp.organizetogo.com";
//$ftp_user_name = "organize@organizetogo.com";
//$ftp_user_pass = "Org876G54$5t@";

//$ftp_server = "02f8e35.netsolhost.com";
//$ftp_user_name = "bertwaxman1a";
//$ftp_user_pass = "gyxQozg1tf";


//$remote_path = "/htdocs/images/turkey/";
//$remote_path = "/public_html/";

// this is where we put files back
//$remote_path = "/costco/incoming/confirms/";

//$remote_path = "closetstogo\costco\outgoing\orders";
$remote_path = "/costco/outgoing/orders/";


// this is the encrypted files we download. Once they are downloaded, they are removed.
//$remote_path = "/closetstogo/costco/outgoing/orders";


$local_path = "../../../costco/encrypted/";
//$local_path = "../../../test/";



// set up basic connection
$conn_id = ftp_connect($ftp_server); 
// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

//ftp_pasv($conn_id, true);

// check connection

$success = 0;

if ((!$conn_id) || (!$login_result)) { 
    
	$msg.= "FTP connection has failed!<br />Attempted to connect to $ftp_server for user $ftp_user_name";
} else {

	$msg.= "connected<br />";

//echo "<br />".$remote_path;

	$contents = ftp_nlist($conn_id, $remote_path);
	
	print_r($contents);
	
	
	foreach($contents as $val){
		//if(substr($val, strlen($val)-3) == "?????????"){
			//create the local file
			
			//echo $local_path.$val;
			//echo $local_path;
			//echo $val;
			
			$rp_array = explode("/",$val);
			
			$indx = count($rp_array)-1;
			$fn = $rp_array[$indx];
			
			
			//echo $remote_path.$fn;
			//echo "<br />";
			//echo $val;
			//echo "<br />";
			//echo "<br />";		
			//echo "<br />";
			
				$msg.= $remote_path.$fn."<br />";

			
			
			//if(ftp_get($conn_id, $local_path.$fn, $val, FTP_BINARY)){
				
			if(ftp_get($conn_id, $local_path.$fn, $remote_path.$fn, FTP_BINARY)){
				//echo $fn;
				//echo "<br />";	
				
				$msg.= $fn."<br />";
				
				
				$enc_filename = $local_path.$fn;
				
				$dec_filename = "/home/organize/public_html/costco/decrypted/dec_".$fn;
				//$file = "../../../costco/decrypted/dec_".$fn; 
				
				$decrypted = shell_exec("echo $passphrase| $gpg --passphrase-fd 0 --batch --no-secmem-warning --no-tty --yes --homedir $gpgkeydir -d $enc_filename");
	
				$fh = fopen($dec_filename, 'w') or die("can't open file");
				fwrite($fh, $decrypted);
				fclose($fh);
				
				$fh = fopen($dec_filename, 'r') or die("can't open file");
				$dec_file_contents = fread($fh, filesize($dec_filename));
				fclose($fh);
				
				$fh = fopen($enc_filename, 'r') or die("can't open file");
				$en_file_contents = fread($fh, filesize($enc_filename));
				fclose($fh);

				processXml($dec_filename, $dec_file_contents, $en_file_contents);


			}


			
		//}
	}
}

ftp_close($conn_id); 







//$filename ="../../../costco/decrypted/test_file.xml";

/************  Parse the XML and ************/
function processXml($dec_filename, $dec_file_contents, $en_file_contents){
	
	if (file_exists($dec_filename)) {
		$xml = simplexml_load_file($dec_filename);
		//print_r($xml);
		
		foreach($xml as $val){
		
			//print_r($val);
			
			//multi_unique($val);
			/*
			echo "<br />";
			echo "transactionID  ".$val["transactionID"]."<br />";
			echo "orderId  ".$val->orderId."<br />";
			echo "poNumber  ".$val->poNumber."<br />";
			echo "orderDate  ".$val->orderDate."<br />";
			echo "qtyOrdered  ".$val->lineItem->qtyOrdered."<br />";
			echo "description  ".$val->lineItem->description."<br />";
			echo "merchantSKU  ".$val->lineItem->merchantSKU."<br />";
			echo "vendorSKU  ".$val->lineItem->vendorSKU."<br />";
			echo "unitCost  ".$val->lineItem->unitCost."<br />";
			echo "name1  ".$val->personPlace->name1."<br />";
			echo "address1  ".$val->personPlace->address1."<br />";
			echo "city  ".$val->personPlace->city."<br />";
			echo "state  ".$val->personPlace->state."<br />";
			echo "country  ".$val->personPlace->country."<br />";
			echo "postalCode  ".$val->personPlace->postalCode."<br />";
			echo "email  ".$val->personPlace->email."<br />";
			echo "dayPhone  ".$val->personPlace->dayPhone."<br />";
			*/
	
			$transactionID = trim($val["transactionID"]);
			$transactionID = (is_numeric($transactionID))? $transactionID : 0;
			$orderId = trim($val->orderId);
			$orderId = (is_numeric($orderId))? $orderId : 0;
			$poNumber = trim($val->poNumber);
			$orderDate = trim($val->orderDate);
			$qtyOrdered = trim($val->lineItem->qtyOrdered);
			$qtyOrdered = (is_numeric($qtyOrdered))? $qtyOrdered : 0;
			$description = trim($val->lineItem->description);
			$merchantSKU = trim($val->lineItem->merchantSKU);
			$vendorSKU = trim($val->lineItem->vendorSKU);
			$unitCost = trim($val->lineItem->unitCost);
			$unitCost = (is_numeric($unitCost))? $unitCost : 0;
			$name1 = trim($val->personPlace->name1);
			$address1 = trim($val->personPlace->address1);
			$city = trim($val->personPlace->city);
			$state = trim($val->personPlace->state);
			$country = trim($val->personPlace->country);
			$postalCode = trim($val->personPlace->postalCode);
			$email = trim($val->personPlace->email);
			$dayPhone = trim($val->personPlace->dayPhone);
	
			if($transactionID != ''){
	
				$db = $dbCustom->getDbConnect(CART_DATABASE);
	
				$sql = "SELECT cosco_save_data_id
						FROM cosco_save_data
						WHERE transactionID = '".$transactionID."'";
				$result = $dbCustom->getResult($db,$sql);
				
				if($result->num_rows < 1){					
				
					$sql = "INSERT INTO costco_save_data
						(
						filename
						,transactionID
						,orderId
						,poNumber
						,orderDate
						,qtyOrdered
						,description
						,merchantSKU
						,vendorSKU
						,unitCost
						,name1
						,address1
						,city
						,state
						,country
						,postalCode
						,email
						,dayPhone
						,decrypted_xml
						,encrypted_xml
						)VALUES(
						'".$filename."'
						,'".$transactionID."'
						,'".$orderId."'
						,'".$poNumber."'
						,'".$orderDate."'
						,'".$qtyOrdered."'
						,'".$description."'
						,'".$merchantSKU."'
						,'".$vendorSKU."'
						,'".$unitCost."'
						,'".$name1."'
						,'".$address1."'
						,'".$city."'
						,'".$state."'
						,'".$country."'
						,'".$postalCode."'
						,'".$email."'
						,'".$dayPhone."'
						,'".$dec_file_contents."'
						,'".$en_file_contents."'
						)					
						";
					$result = $dbCustom->getResult($db,$sql);
					
				
					$success = 1;
				
				}
			}
		}	
	}
}
	
				
			//AND UNIX_TIMESTAMP(created) > 
			/*
			echo "<br />";
			echo strtotime("20110101");
			echo "<br />";		
			$dd = strtotime("2011-01-01 00:00:00");
			$dd_array = explode(" ",$dd);
			$dd = $dd_array[0];
			echo "<br />-------".$dd; 
			*/
	

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Download Costco Orders</title>

<link rel="stylesheet" href="<?php echo SITEROOT; ?>/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/mce.css" />

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>/js/ui/jquery.ui.datepicker.js"></script>


  


<script>
$(document).ready(function() {


	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();

	
	
	$(".inline").click(function(){ 

		if(this.href.indexOf("view_desc") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("edit"));
						
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'view-item-description.php?item_id='+f_id,
			  success: function(data) {
				$('#view_desc').html(data);
				//alert('Load was performed.');
			  }
			});			
			
		}
		
	})
	
	$("a.inline").fancybox();
	
	$("#view_desc").click(function(){ $.fancybox.close;  })



});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});

function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}

function show_msg(msg){
	alert(msg);
}

</script>
</head>

<?php if($msg != ''){ ?>
	<body onload="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

	require_once("../../includes/manage-header.php");
	require_once("../../includes/manage-top-nav.php");


?>




<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once("../../includes/manage-side-nav.php");
        ?>
    </div>	
    
    <div class="top_link">
	    <a href='download-cosco.php'>Done</a><br>
    </div>

    <div class="manage_main">

<?php

if($success) echo "The files were successfully downloaded and inserted into our system";

?>

	</div>


    <p class="clear"></p>
    <?php 
    require_once("../../includes/manage-footer.php");
    ?>    
    
</div>


</body>
</html>










?>