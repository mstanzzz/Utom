<?php


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT *
		FROM we_design_fax
		WHERE we_design_fax.we_design_fax_id = (SELECT MAX(we_design_fax_id) FROM we_design_fax WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);

//echo "num_rows: ".$result->num_rows;
//echo "<br />";
//echo "<br />";

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$content = stripslashes($object->content);
	$we_design_fax_id = $object->we_design_fax_id;
	$design_fax_number = stripslashes($object->design_fax_number);	
	$download_form_file_id = $object->download_form_file_id;
	$form_img_id = $object->form_img_id;
	$img_id = $object->img_id;
		
}else{
	
	$content = '';
	$we_design_fax_id = 0;
	$design_fax_number = '';	
	$download_form_file_id = 0;
	$form_img_id = 0;
	$img_id = 0;

}


?>

