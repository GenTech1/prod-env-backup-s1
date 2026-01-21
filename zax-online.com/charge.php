<?php
$email = 'hi@example.com';
$phone = '+1234567890';
$price = 100; // Default price in cents
$nonce = 'cnon:card-nonce-ok'; // Example nonce for testing

$access_ID = getenv('Square_Access_ID');
$payload = [
    "idempotency_key" => uniqid(),
    "source_id" => $nonce,
    "accept_partial_authorization" => false,
    "amount_money" =>[
      "amount" => $price,
      "currency" => "USD"
    ],
    "autocomplete" => false,
    "buyer_email_address" => $email,
    "buyer_phone_number"=> $phone,
    "customer_id" => ""
];
try{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://connect.squareupsandbox.com/v2/payments");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Square-Version: 2025-09-24', 
    'Authorization: Bearer ' . $access_ID,
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if($code>=200 && $code<300){
echo json_encode([
  "success" => true,
  "message" => "$price",
]);
}else{
  echo json_encode([
    "success" => false,
    "message" => " Transaction failed, Please try again. Error code: " . $code . " Response: " . $response,
  ]);
}
}catch(Exception $e){
  http_response_code(500);
  echo json_encode(['error' => 'Internal Server Error']);
  exit;
}
?>