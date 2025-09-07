<?php
$api_key = getenv('KLAVIYO_API_KEY');
$list_id = getenv('KLAVIYO_LIST_ID_SMS');

$phone = $_POST['phone'] ?? null;
if (!$phone) {
    http_response_code(400);
    echo json_encode(['error' => 'Phone number is required']);
    exit;
}

$payload = [
  "data" => [
    "type" => "profile",
    "attributes" => [
      "phone_number" => $phone
    ]
  ]
];

$ch = curl_init("https://a.klaviyo.com/api/v2/list/$list_id/members");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Bearer $api_key",
  "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($code >= 200 && $code < 300) {
    echo json_encode(['success' => true]);
} else {
    http_response_code($code);
    echo $response;
}
?>

