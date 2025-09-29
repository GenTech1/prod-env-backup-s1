<?php
$api_key = getenv('KLAVIYO_API_KEY');
$list_id = getenv('KLAVIYO_LIST_ID_SMS');

$phone = "+1" . $_POST['phone'] ?? null;

if (!$phone) {
    http_response_code(400);
    echo json_encode(['error' => 'Phone number is required']);
    exit;
}// Add phone number to Klaviyo profile
try{
$payload = [
  "data" => [
    "type" => "profile",
    "attributes" => [
      "phone_number" => $phone,
       "subscriptions" => [
        "sms" => [
          "marketing" => [
            "consent" => "SUBSCRIBED"
          ]
        ]
      ]
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
curl_close($ch);
}catch(Exception $e){
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
    exit;
}

//if profile creation is successful, consent for sms marketing

//add profile to master list
try{


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://a.klaviyo.com/api/profiles?filter=equals(phone_number,'$phone')");
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
if ($code >= 200 && $code < 300) {
  echo "signed up";
  $payload = [
    "data" => [
      [
        "type" => "profile",
        "id" => json_decode($response, true)['data'][0]['id']
        
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
$response = curl_exec($ch);
echo $response;
}catch(Exception $e){
    echo json_encode(['error' => 'Internal Server Error']);
    exit;
}
} else {
    http_response_code($code);
    echo $response;
}

?>

