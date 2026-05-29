<?php
// 1. MUST read the raw JSON input from the request body
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// 2. SAFELY extract the expected fields
$email = $data['email'] ?? '';
$phone = "+1".$data['phone'] ?? '';
// 3. FORCE the price to be an integer (Square will reject "100" but accept 100)
$price = isset($data['price']) ? (int)$data['price'] : 0;
$nonce = $data['nonce'] ?? ''; // Example nonce for testing

$access_ID = getenv('Square_Access_ID');
$payload = [
    "idempotency_key" => uniqid(),
    "source_id" => $nonce,
    "accept_partial_authorization" => false,
    "amount_money" =>[
      "amount" => $price,
      "currency" => "USD"
    ],
    "autocomplete" => true,
    "buyer_email_address" => $email,
    "buyer_phone_number"=> $phone,
    "customer_id" => ""
];
try{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://connect.squareup.com/v2/payments");
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