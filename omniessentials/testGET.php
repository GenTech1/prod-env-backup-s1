
<?php
//this does not work
$apiKey = "o3cxzababnTKhy72oK4YHcPHWZH2jPxg";
$orderId = "a0ab4af4e09ad13e100c574c"; // Use the ID from your last success
$url = "https://api.madely.com/pm/v1/pricing/K34-LIDANDSTRAW.json";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-API-Key: $apiKey", 
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Status Code: " . $statusCode . "\n";
echo "Order Details: " . $response;
?>