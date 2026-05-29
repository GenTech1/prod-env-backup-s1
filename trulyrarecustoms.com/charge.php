<?php
$host = getenv('DATABASE_HOST');
$dbname = getenv('Products_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
    $email = $data['email'] ?? null;
    $phone = $data['phone'] ?? null;
    $phone = "+1" . preg_replace('/\D+/', '', (string)$phone);
    $nonce = $data['nonce'] ?? null;
    $sku = $data['sku'] ?? null;
    $price = $data['price'] ?? null;
    try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }

    try {
      $stmt = $pdo->prepare("SELECT * FROM Products WHERE sku = ?");
      $stmt->execute([$sku]);
      $products = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($price === null){
      $price = (int) round((float)$products['price'] * 100);// in cents no decimals
      }else{
      $price = (int) round((float)$price * 100);// in cents no decimals 
      }
    } catch (PDOException $e) {
      die("Query failed: " . $e->getMessage());
    }
$access_ID = getenv('SQUARE_ACCESS_ID');
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