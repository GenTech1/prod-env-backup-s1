<?php
try {
$url = "https://api.madely.com/pm/v1/orders.json";
$apiKey = "o3cxzababnTKhy72oK4YHcPHWZH2jPxg";

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Variables from JS
    $sku     = $data['sku'] ?? 'K34-LIDANDSTRAW';
    $price   = $data['price'] ?? 1999; // Default price in cents
    $fname   = $data['fname'] ?? "Quinton";
    $lname   = $data['lname'] ?? "Taylor";
    $email   = $data['email'] ?? "example@example.com";
    $phone   = $data['phone'] ?? "555555555";
    $address = $data['address'] ?? "3725 Iowa Ave";
    $city    = $data['city'] ?? "St.louis";
    $state   = $data['state'] ?? "Mo";
    $zip     = $data['zip'] ?? "63118";
    $image   = $data['image'] ?? "./public/assets/GlassCan1.jpeg";
    $print   = $data['print'] ?? "./public/assets/GlassCan1.jpeg";

    // Printed Mint Setup
    function generateMongoId() {
        return bin2hex(random_bytes(12));
    }

    $orderId = generateMongoId(); 
    $itemId  = substr(bin2hex(random_bytes(4)), 0, 8);

    $orderData = [
        "id" => $orderId, 
        "sample" => true,
        "address_to" => [
            "first_name" => $fname,
            "last_name" => $lname,
            "address1" => $address,
            "city" => $city,
            "region" => $state,
            "zip" => $zip,
            "country" => "US",
            "email" => $email,
            "phone" => $phone
        ],
         "shipping" => [
        "carrier" => "FedEx",
        "priority" => "Ground"
    ],
        "items" => [[
            "id" => $itemId,
            "sku" => $sku, 
            "quantity" => 1,
            "preview_files" => ["front" => "https://www.zaxtest.xyz/".$image],
            "print_files" => ["front" => "https://www.zaxtest.xyz/".$print]
        ]]
    ];

    $payload = json_encode($orderData);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-API-Key: $apiKey",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo json_encode([
    'success' => true, 
    'order_id' => $orderId, 
    'api_response' => json_decode($response), // This puts the API result in the log
    'http_code' => $httpCode
]);

curl_close($ch);


    // Database Connection
    $dbname = getenv('Products_DB');
    $user   = getenv('Site_USER');
    $pass   = getenv('Site_PASS');

    $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO orders (
        order_id, sku, order_date, status, payment_status, payment_method, 
        total_amount, subtotal_amount, tax_amount, shipping_amount, 
        discount_amount, coupon_code, shipping_name, shipping_phone, 
        shipping_email, shipping_address, shipping_city, shipping_state, 
        shipping_zip, shipping_country, updated_at
    ) VALUES (
        :order_id, :sku, NOW(), 'Pending', 'Paid', 'Square', 
        :total, :subtotal, 0.00, 0.00, 0.00, '', 
        :shipping_name, :phone, :email, :address, :city, :state, :zip, 'US', NOW()
    )");

    // ONLY EXECUTE ONCE
    $stmt->execute([
        ':order_id'      => $orderId,
        ':sku'           => $sku,
        ':total'         => $price / 100, 
        ':subtotal'      => $price / 100, 
        ':shipping_name' => $fname . " " . $lname,
        ':phone'         => $phone,
        ':email'         => $email,
        ':address'       => $address,
        ':city'          => $city,
        ':state'         => $state,
        ':zip'           => $zip
    ]);



} catch (Exception $e) {
    echo json_encode([
    'success' => true, 
    'order_id' => $orderId, 
    'api_response' => json_decode($response), // This puts the API result in the log
    'http_code' => $httpCode
]);
}
?>