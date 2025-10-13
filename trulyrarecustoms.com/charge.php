<?php
$payload = [
    "idempotency_key" => uniqid(),
    "source_id" => "cnon:card-nonce-ok",//fake nonce for testing
    "accept_partial_authorization" => false,
    "amount_money" =>[
      "amount" => 20,//20 cents for testing
      "currency" => "USD"
    ],
    "autocomplete" => false,
    "buyer_email_address" => "quintontaylor29@gmail.com",//dummy email
    "buyer_phone_number"=> "+13145034597",//dummy phone number
    "customer_id" => ""
];
try{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://connect.squareupsandbox.com/v2/payments");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Square-Version: 2025-09-24', 
    'Authorization: Bearer EAAAlzQ_SE7Td2kYtb4QtGWtA7tllAaOSa6CyDerQGVIAfywXJxUcAcxpWqjpVF6',
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $response;
if($code>=200 && $code<300){
echo json_encode([
  "success" => true,
  "message" => "",
]);
}else{
  echo json_encode([
    "success" => false,
    "message" => " Transaction failed, Please try again.",
  ]);
}
}catch(Exception $e){
  http_response_code(500);
  echo json_encode(['error' => 'Internal Server Error']);
  exit;
}
?>