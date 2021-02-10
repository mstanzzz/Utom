<?php
require_once("../includes/config.php"); 


exit;

$db = $dbCustom->getDbConnect(USER_DATABASE);


$sql = "SELECT id
		FROM profile_account";
$result = $dbCustom->getResult($db,$sql);

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

while($row = $result->fetch_object()) {
	
	echo "<br />";
	echo $row->id;
	
	$sql = "SELECT page_seo_id
			FROM page_seo
			WHERE page_name = 'keyword-landing'
			AND profile_account_id = '".$row->id."'";
	$a_res = $dbCustom->getResult($db,$sql);
	
	if($a_res->num_rows == 0){
		
		$sql = "INSERT INTO page_seo (
			profile_account_id, page_name, seo_name) 
			VALUES ('".$row->id."','keyword-landing','keyword-landing')";
		$res = $dbCustom->getResult($db,$sql);

	}

	$sql = "SELECT keyword_landing_id
			FROM keyword_landing
			WHERE profile_account_id = '".$row->id."'";
	$b_res = $dbCustom->getResult($db,$sql);
	
	if($b_res->num_rows == 0){
		
		$sql = "INSERT INTO keyword_landing (
				profile_account_id) 
				VALUES ('".$row->id."')";
		$res = $dbCustom->getResult($db,$sql);
		
		
	}

	
}


/*
$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-answers','social-network-answers')";
$result = $dbCustom->getResult($db,$sql);



$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-members','social-network-members')";
$result = $dbCustom->getResult($db,$sql);



$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-blog','social-network-blog')";
$result = $dbCustom->getResult($db,$sql);



$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-gallery','social-network-gallery')";
$result = $dbCustom->getResult($db,$sql);


$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-blog-article','social-network-blog-article')";
$result = $dbCustom->getResult($db,$sql);



$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-about','social-network-about')";
$result = $dbCustom->getResult($db,$sql);


$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-answer','social-network-answer')";
$result = $dbCustom->getResult($db,$sql);


$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-before-after','social-network-before-after')";
$result = $dbCustom->getResult($db,$sql);


$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-results','social-network-results')";
$result = $dbCustom->getResult($db,$sql);



$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','search-results','search-results')";
$result = $dbCustom->getResult($db,$sql);


$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','social-network-profile','social-network-profile')";
$result = $dbCustom->getResult($db,$sql);


$sql = "INSERT INTO page_seo (
		profile_account_id, page_name, seo_name) 
		VALUES ('1','signin-form','signin-form')";
$result = $dbCustom->getResult($db,$sql);


*/





/*
$array = array(
"Alabama",
"Alaska",
"Arizona",
"Arkansas",
"California",
"Colorado",
"Connecticut",
"Delaware",
"District of Columbia",
"Florida",
"Georgia",
"Hawaii",
"Idaho",
"Illinois",
"Indiana",
"Iowa",
"Kansas",
"Kentucky",
"Louisiana",
"Maine",
"Maryland",
"Massachusetts",
"Michigan",
"Minnesota",
"Mississippi",
"Missouri",
"Montana",
"Nebraska",
"Nevada",
"New Hampshire",
"New Jersey",
"New Mexico",
"New York",
"North Carolina",
"North Dakota",
"Ohio",
"Oklahoma",
"Oregon",
"Pennsylvania",
"Rhode Island",
"South Carolina",
"South Dakota",
"Tennessee",
"Texas",
"Utah",
"Vermont",
"Virgin Islands",
"Virginia",
"Washington",
"West Virginia",
"Wisconsin",
"Wyoming"
);


foreach ($array as $i => $value) {

$sql = "INSERT INTO states (state) VALUES ('".$value."')";
$result = $dbCustom->getResult($db,$sql);

echo $value."<br />";

}
*/

?>

