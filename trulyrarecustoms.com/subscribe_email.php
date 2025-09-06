<?php

//Step 1 Build data as PHP associative array
$data = [
	"data" => [
		"type" => "profile",
		"attributes" => [
			"email" => "quintontaylor29@gmail.com"
]
]
];
	
//Step 2 Convert PHP array to JSON
$jsonData = json_encode($data);

//Step 3 Initialize cURL
$ch = curl_init('https://a.klaviyo.com/
?>

