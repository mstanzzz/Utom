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

require_once($_SERVER['DOCUMENT_ROOT']."/includes/iframe_functions.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.encryption.php");


$progress = new SetupProgress;
$module = new Module;

$converter = new Encryption; 

$page_title = "Add Iframe";
$page_group = "admin";

	

$msg = '';
$iframe_str = '';
$download_file = '';


if(isset($_POST["add_iframe"])){
	
	/*
	echo getUsedIframeCount($_SESSION['profile_account_id']);
	echo "<br />";
	echo getIframeCount($_SESSION['profile_account_id']);
	echo "<br />";
	*/

	if(getUsedIframeCount($_SESSION['profile_account_id']) < getIframeCount($_SESSION['profile_account_id'])){
	
		SITEROOT_name = trim(addslashes($_POST["domain_name"])); 

	
	
	
	
	
		//echo "kkk";
		//exit;
		
		//$patentpid = generateId(); // store in iframe table
		//$patentpid_salt = $aLgn->generateSalt(); // store in iframe table
	
		// get domain and salt from the iframe code
	
		//$patentpid_hash = $aLgn->get_hash($patentpid, $patentpid_salt); 
		
		// put patentpid_salt in the iframe code
		// to verify id
		//if($patentpid_hash == $this->get_hash($patentpid, $patentpid_salt)){  
		
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = sprintf("INSERT INTO iframe 
					(domain_name
					,profile_account_id
					,created
					)
					 VALUES('%s','%u','%u')", 
					SITEROOT_name
					,$_SESSION['profile_account_id']
					,time()
					);
	
		$result = $dbCustom->getResult($db,$sql);
			

		$iframe_id = $db->insert_id;
		// create encryped id-domain
		
		$encoded_domain = $converter->encode(SITEROOT_name); 
 		$encoded_iframe_id = $converter->encode($iframe_id);
		
		$idstr = $encoded_iframe_id."-".$encoded_domain; 

				
		
		$iframe_str = "<iframe src='http://organizetogo.com/app/index.php?idstr=".$idstr."&src=iframe' frameborder='0' width='1000' height='800'></iframe>";

		
		$msg = "Copy this code to be used on the site";	
		
//CHMOD		
		// crate the download file to be placed on cust site for authentication
		$theFileName = "iframe-auth-files/verifysite.htm";
		$handle = fopen($theFileName, 'w') or die("can't open file");
		
		$str = ''.$idstr."-".uniqid(rand());

		fwrite($handle, $str);




		fclose($handle);

		
		
		$download_file = '';
		


	}else{
		$msg = "You have exceeded the number of iframes allowed";	
	}
}



/* THIS IS HOW TO GET THE CONTENT TO VERIFY 

if ($fp = fopen("http://www.sibelstanz.com/verifysite.htm", 'r')) {
   $content = '';
    while ($line = fgets($fp, 1024)) {
      $content .= $line;
   }
	echo $content;
} else {
}

use function verifyIframeSite($idstr) in accessory_cart_functions.php


*/


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>

<script>

function validate(theform){	


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


/*
function set_iframe_input(){
	var block = '';
	block += "<div style='padding-right:20px'><b>Iframes Allowd</b></div>";
	block += "<input type='text' name='iframes_allowed'  size='10' />";
	$("#iframe_input").html(block);
}
*/

</script>

	<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>



<div class="page_title_top_spacer"></div>
<div class="page_title">

	<div class="top_right_link">
    </div> 
</div>


<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	

	<div class="top_link">
       	<a href=''></a>
    </div>

	<div class="manage_main">
	
    <?php
	
	echo "<div class='manage_main_page_title'>".$page_title." </div>";
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	echo $bread_crumb->output();
	echo "<br />";

	if($msg != ''){
		echo $msg."<br />";
	}

	if($iframe_str != ''){
		echo "<textarea cols='80' rows='6'>$iframe_str</textarea>";
	}

	echo "<br /><br />";
	
	
	echo "<a href='".SITEROOT."manage/iframe-auth-files/verifysite.html' target='_blank' style='text-decoration:none'>right click and save download</a>";	
	
	?>
 	</div>



    <p class="clear"></p>
	<?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
    ?>       

    </div>

</body>
</html>



