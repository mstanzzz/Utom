<?php




// ****** THIS IS WORKING EXAMPLE ******

//#!/usr/bin/php 




/* set up some strings */ 

$gpgkeydir = "/home/organize/.gnupg"; 

$gpg = '/usr/bin/gpg'; 

$uid = "mike@closetstogo.com"; 

$msg = "This is a test message"; 

$passphrase = "Ctg18765Ghblk8%gh"; 

$file = "/home/organize/public_html/test/295062254.neworders"; 




putenv("GNUPGHOME=$gpg"); 




/* OK now let's encrypt the $msg */ 

// NOTE: ENCRYPTING WORKS WITH THIS, BUT WE ARE ONLY DECRYPTING

//$encrypted = shell_exec("echo $msg | $gpg --batch --no-secmem-warning --no-tty --yes -ea --always-trust --homedir //$gpgkeydir -r $uid");




//print "<form><textarea NAME=txt ROWS=20 COLS=75 WRAP=VIRTUAL>"; 

//print $encrypted; 

//print "</textarea><br>"; 




/* Now the decrypt part */ 




// this bit makes a file 




//touch($file); 

//$df = fopen($file, "w") or die ("Couldn't open $file"); 

//fwrite($df, $encrypted); 

//fclose($df); 




// now decode that file 




putenv("GNUPGHOME=$gpg"); 

global $gnupghome; 

global $path_to_gpg; 


$decrypted = shell_exec("echo $passphrase| $gpg --passphrase-fd 0 --batch --no-secmem-warning --no-tty --yes --homedir $gpgkeydir -d $file");




print "your decoded message is:<br>"; 





echo " <textarea cols=80 rows=20 name=plaintext>$decrypted</textarea>"; 


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

?>