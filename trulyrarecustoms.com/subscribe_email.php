<?php
$email = $_POST['email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	die("Invalid Email");
}

$api_key = getenv('WAFFLE');
$list_id = getenv('WAFFLE_KINGDOM');

try{
	$payload = [
		"data" => [
			"type" => "profile",
			"attributes" => [
			"email" => $email
		]
	]
];


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://a.klaviyo.com/api/profiles");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Authorization: Klaviyo-API-Key ' . $api_key,
  'Revision: 2023-10-01',
   'Accept: application/vnd.api+json',
  "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo ($response);
}catch(Exception $e){
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
    exit;
}




if ($code >= 200 && $code < 300) {
	$profileId = json_decode($response, true)['data'][0]['id'];
	$payload = [
		"data" => [
			[
				"type" => "profile",
				"id" => $profileId
			]
		]
	];
	try{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://a.klaviyo.com/api/lists/$list_id/relationships/profiles");
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
  		'Authorization: Klaviyo-API-Key ' . $api_key,
  		'Revision: 2023-10-01',
   		'Accept: application/vnd.api+json',
  		"Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	if($response == NULL){
		echo ' cURL error: ' . curl_error($ch);
	} else {
		echo 'profile added to list';
		$response = curl_exec($ch);
		echo $response;
	}
}catch(Exception $e){
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
    exit;
}
}  else {
	http_response_code($code);
	echo $response;
}

// try {
// 	$payload = [
// 		"data" => [
// 			"type" => "profile",
// 			"attributes" => [
// 			'email' => $email
// 		]
// 	]
// ];
// }
echo $response;

// move it to Master

try {
	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "'https://a.klaviyo.com/api/profiles?filter=equals(email,'$email')'");
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
  		'Authorization: Klaviyo-API-Key ' . $api_key,
  		'Revision: 2023-10-01',
   		'Accept: application/vnd.api+json',
]);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
}catch(Exception $e){
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
    exit;
}
echo $response;
