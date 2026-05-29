<!-- <?php
$api_key = getenv('KLAVIYO_API_KEY');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://a.klaviyo.com/api/lists"); // or /api/account
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Klaviyo-API-Key '.$api_key,
    'Revision: 2023-10-01',
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?> -->


