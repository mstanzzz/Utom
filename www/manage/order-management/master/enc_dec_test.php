<?php


$gpgkeydir = "/home/organize/.gnupg"; 
$gpg = '/usr/bin/gpg'; 
$uid = "mike@closetstogo.com"; 
$passphrase = "Ctg18765Ghblk8%gh"; 

$file = "/home/organize/public_html/costco/newencryptedfile.gpg"; 

//$file2 = "/home/organize/public_html/test/filetoencrypt.file"; 

$file2 = "/home/organize/public_html/costco/enc_this.txt"; 


putenv("GNUPGHOME=$gpg"); 


$test = "KKKK";

$msg = <<<EOD

<?xml version="1.0" encoding="UTF-8"?>
<ConfirmMessageBatch xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="S:\VENDOR~1\XSD's\Costco\Costco_confirm.xsd">
	<partnerID roleType="vendor">testvendor</partnerID>
	<hubConfirm>
		<!-- This hubConfirm contains a shipment for a single line purchase order that ships in the same package -->
		<participatingParty participationCode="To:">costco</participatingParty>
		<partnerTrxID>00012</partnerTrxID>
		<partnerTrxDate>20091216</partnerTrxDate>
		<poNumber>$test</poNumber>
		<trxData>
			<vendorsInvoiceNumber>01221100</vendorsInvoiceNumber>
		</trxData>
		<hubAction>
			<action>v_ship</action>
			<merchantLineNumber>2</merchantLineNumber>
			<trxVendorSKU>0012554</trxVendorSKU>
			<trxMerchantSKU>8847447</trxMerchantSKU>
			<trxQty>2</trxQty>
			<packageDetailLink packageDetailID="A_000021A" />
		</hubAction>
		<packageDetail packageDetailID="A_000021A">
			<shipDate>200912016</shipDate>
			<serviceLevel1>UPSN_CG</serviceLevel1>
			<trackingNumber>1Z0093774898494</trackingNumber>
			<shippingWeight weightUnit="LB">1.0</shippingWeight>
		</packageDetail>
	</hubConfirm>
<messageCount>1</messageCount>
</ConfirmMessageBatch>


EOD;

?>

<?php

$df = fopen($file2, "w") or die ("Couldn't open $file");
fwrite($df,$msg); 
fclose($df); 


$encrypted = shell_exec("$gpg --batch --no-secmem-warning --no-tty --yes -ea --always-trust --homedir $gpgkeydir -r $uid -o - $file2");

echo "you encoded message is:<br>";

echo "<form><textarea NAME=txt ROWS=20 COLS=75 WRAP=VIRTUAL>$encrypted</textarea><br>";  


// Save encrypted file... this will be uploaded later. Filename will be set to something like a datetime.gpg. 

// after we upload file you can delete it using the unlink method. 

// for testing I am deleting existing file, creating it and decrypting same file to show its working

//unlink("/home/organize/public_html/test/newencryptedfile.gpg"); 

// if file exists
if(file_exists ($file)){
unlink($file);
}
$df = fopen($file, "w") or die ("Couldn't open $file");

fwrite($df,$encrypted); 

fclose($df); 


//putenv("GNUPGHOME=$gpg"); 

//global $gnupghome; 

//global $path_to_gpg; 

$decrypted = shell_exec("echo $passphrase| $gpg --passphrase-fd 0 --batch --no-secmem-warning --no-tty --yes --homedir $gpgkeydir -d $file");



//$decrypted = base64_decode($decrypted);

echo "your decoded message is:<br>"; 

echo " <textarea cols=80 rows=20 name=plaintext>$decrypted</textarea>"; 



// delete file 

//unlink($file); 



// ****** END WORKING EXAMPLE ******

















































// set path to keyring directory

//putenv('GNUPGHOME=/home/organize/.gnupg');



// create new GnuPG object

//$gpg = new gnupg();



// throw exception if error occurs

//$gpg->seterrormode(gnupg::ERROR_EXCEPTION); 



// recipient's email address

//$recipient = 'mike@closetstogo.com';



// ciphertext message

//$ciphertext = file_get_contents('test/ciphertext.gpg');



// register secret key by providing passphrase

// decrypt ciphertext with secret key

// display plaintext message

try {

  //$gpg->adddecryptkey($recipient, 'Ctg18765Ghblk8%gh');

  //$plaintext = $gpg->decrypt($ciphertext);



  //echo '<pre>' . $plaintext . '</pre>';

} catch (Exception $e) {

  die('ERROR: ' . $e->getMessage());

}

// $gpg = '/usr/bin/gpg';



//    $passphrase = 'Ctg18765Ghblk8%gh'; 

 //   $encrypted_file = 'test/ciphertext.gpg';



//    $unencrypted_file = 'test/foo.txt';

//echo 'sdfds';

 //   echo shell_exec("echo $passphrase | $gpg --passphrase-fd 0 -o $unencrypted_file -d $encrypted_file");



//$gpg = '/usr/bin/gpg';

//$passphrase = 'test/passphrase.txt';

//$encrypted_file = 'test/ciphertext.gpg';

//$unencrypted_file = 'test/foo.txt';



//$cmd = "echo $gpg --passphrase-fd 0 -o $unencrypted_file -d $encrypted_file < $passphrase";

//echo "<br/>cmd: ".$cmd;

//echo "<br/>output: ".shell_exec($cmd);

//echo "<br/>file: ".(file_exists($unencrypted_file)?"yes":"no");



function xml_entities($text, $charset = 'Windows-1252'){

     // Debug and Test

    // $text = "test &amp; &trade; &amp;trade; abc &reg; &amp;reg; &#45;";

    

    // First we encode html characters that are also invalid in xml

    $text = htmlentities($text, ENT_COMPAT, $charset, false);

    

    // XML character entity array from Wiki

    // Note: &apos; is useless in UTF-8 or in UTF-16

    $arr_xml_special_char = array("&quot;","&amp;","&apos;","&lt;","&gt;");

    

    // Building the regex string to exclude all strings with xml special char

    $arr_xml_special_char_regex = "(?";

    foreach($arr_xml_special_char as $key => $value){

        $arr_xml_special_char_regex .= "(?!$value)";

    }

    $arr_xml_special_char_regex .= ")";

    

    // Scan the array for &something_not_xml; syntax

    $pattern = "/$arr_xml_special_char_regex&([a-zA-Z0-9]+;)/";

    

    // Replace the &something_not_xml; with &amp;something_not_xml;

    $replacement = '&amp;${1}';

    return preg_replace($pattern, $replacement, $text);

}

?>