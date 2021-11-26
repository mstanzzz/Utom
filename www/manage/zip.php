<?php

$zip = '33140';

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://us-zip-code-information.p.rapidapi.com/?zipcode=".$zip,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: us-zip-code-information.p.rapidapi.com",
		"x-rapidapi-key: 98ffbcd992mshde911fcbed0a352p171177jsn4615509598c3"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	//echo $response;
}

 $json = json_decode($response);
 
 print_r($json);
 
 echo "<br /><br />";
 
 echo $json[0]->City;
 
 echo "<br /><br />";
 
 echo $json[0]->State;
 
// https://rapidapi.com/dkr73/api/us-zip-code-information/
?>