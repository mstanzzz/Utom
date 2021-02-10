<?php
// ****** THIS IS WORKING EXAMPLE ******

#!/usr/bin/php 
/* set up some strings */ 


$xmlstr = "
<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<ConfirmMessageBatch xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"S:\VENDOR~1\XSD's\Costco\Costco_confirm.xsd\">
<partnerID roleType=\"vendor\">testvendor</partnerID>
	<hubConfirm>
	<participatingParty participationCode=\"To:\">costco</participatingParty>
		<partnerTrxID>00012</partnerTrxID>
		<partnerTrxDate>20091216</partnerTrxDate>
		<poNumber>00154888</poNumber>
		<trxData>
			<vendorsInvoiceNumber>01221100</vendorsInvoiceNumber>
		</trxData>
		<hubAction>
			<action>v_ship</action>
			<merchantLineNumber>2</merchantLineNumber>
			<trxVendorSKU>0012554</trxVendorSKU>
			<trxMerchantSKU>8847447</trxMerchantSKU>
			<trxQty>2</trxQty>
			<packageDetailLink packageDetailID=\"A_000021A\" />
		</hubAction>
		<packageDetail packageDetailID=\"A_000021A\">
			<shipDate>200912016</shipDate>
			<serviceLevel1>UPSN_CG</serviceLevel1>
			<trackingNumber>1Z0093774898494</trackingNumber>
			<shippingWeight weightUnit=\"LB\">1.0</shippingWeight>
		</packageDetail>
	</hubConfirm>
<messageCount>1</messageCount>
</ConfirmMessageBatch>
";	



$msg = "<?xml version=\"1.0\" encoding=\"UTF-8\"?\>";
$msg .= "<ConfirmMessageBatch xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"S:\VENDOR~1\XSD's\Costco\Costco_confirm.xsd\"\>";
$msg .= "<partnerID roleType=\"vendor\">testvendor</partnerID\>";
	$msg .= "<hubConfirm\>";
	$msg .= "<participatingParty participationCode=\"To:\">costco</participatingParty\>";
		$msg .= "<partnerTrxID\>00012</partnerTrxID\>";
		$msg .= "<partnerTrxDate\>20091216</partnerTrxDate\>";
		$msg .= "<poNumber\>00154888</poNumber\>";
		$msg .= "<trxData\>";
			$msg .= "<vendorsInvoiceNumber\>01221100</vendorsInvoiceNumber\>";
		$msg .= "</trxData\>";
		$msg .= "<hubAction\>";
			$msg .= "<action\>v_ship</action\>";
			$msg .= "<merchantLineNumber\>1</merchantLineNumber\>";
			$msg .= "<trxVendorSKU\>0012554</trxVendorSKU\>";
			$msg .= "<trxMerchantSKU\>8847447</trxMerchantSKU\>";
			$msg .= "<trxQty\>1</trxQty\>";
			$msg .= "<packageDetailLink packageDetailID=\"A_000021A\" /\>";
		$msg .= "</hubAction\>";
		$msg .= "<packageDetail packageDetailID=\"A_000021A\"\>";
			$msg .= "<shipDate\>200912016</shipDate\>";
			$msg .= "<serviceLevel1\>UPSN_CG</serviceLevel1\>";
			$msg .= "<trackingNumber\>1Z0093774898494</trackingNumber\>";
			$msg .= "<shippingWeight weightUnit=\"LB\"\>1.0</shippingWeight\>";
		$msg .= "</packageDetail\>";
	$msg .= "</hubConfirm\>";
$msg .= "<messageCount\>1</messageCount\>";
$msg .= "</ConfirmMessageBatch\>";



$gpgkeydir = "/home/organize/.gnupg"; 
$gpg = '/usr/bin/gpg'; 
$uid = "mike@closetstogo.com"; 


//$msg = "This is a test message"; 

//$passphrase = "Ctg18765Ghblk8%gh"; 

//$file = "/home/organize/public_html/test/295062254.neworders"; 




//putenv("GNUPGHOME=$gpg"); 



$encrypted = shell_exec("echo $msg | $gpg --batch --no-secmem-warning --no-tty --yes -ea --always-trust --homedir //$gpgkeydir -r $uid");

//$t_ff = "t_file.txt";

//$encrypted = shell_exec("$gpg --batch --no-secmem-warning --no-tty --yes -ea --always-trust --homedir //$gpgkeydir -r $uid $t_ff");

//$encrypted = shell_exec("$gpg   --batch --no-secmem-warning --no-tty --yes -ea --always-trust --homedir //$gpgkeydir  -r $uid $t_ff");




echo "encrypted  ".$encrypted;

/*
$t_file = "encrypted_test_file.txt";
$df = fopen($file, "w") or die ("Couldn't open $t_file"); 
fwrite($df, $encrypted); 
fclose($df); 
*/



?>