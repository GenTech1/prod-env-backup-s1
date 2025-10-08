<?php
$email = $_POST['email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	die("Invalid Email");
}

$api_key = getenv('WAFFLE');
$list_id = getenv('WAFFLE_KINGDOM');

$payload = [
	"profiles" => [
		['email' => $email]
	]
];

// $endpoint = "https://a.klaviyo.com/api/v2/list/{$list_id}/subscribe?api_key={$api_key}";

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	"Content-Type: application/json"
]);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo $response

if ($httpCode === 200) {
	echo "HI World";
} else {
	echo "It didn't work go back!!!";
}
?>

