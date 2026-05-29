<?php
try {
$url = "https://api.madely.com/pm/v1/orders.json";
$apiKey = "o3cxzababnTKhy72oK4YHcPHWZH2jPxg";

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Variables from JS
    $sku     = $data['sku'] ?? 'K34-LIDANDSTRAW';
    $price   = $data['price'] ?? ""; // Default price in cents
    $fname   = $data['fname'] ?? "";
    $lname   = $data['lname'] ?? "";
    $email   = $data['email'] ?? "";
    $phone   = $data['phone'] ?? "";
    $address = $data['address'] ?? "";
    $city    = $data['city'] ?? "";
    $state   = $data['state'] ?? "";
    $zip     = $data['zip'] ?? "";
    $image   = $data['image'] ?? "";
    $print   = $data['print'] ?? "";
if (
    !$sku ||
    !$price ||
    strlen($fname) < 3 ||
    strlen($lname) < 3 ||
    !$email ||
    strlen($phone) < 10 ||
    !$address ||
    !$city ||
    !$state ||
    strlen($zip) < 5
) {
    echo json_encode([
        'success' => false,
        'message' =>
            (!$sku ? "SKU is required. " : "") .
            (!$price ? "Price is required. " : "") .
            (strlen($fname) < 3 ? "First name must be at least 3 characters. " : "") .
            (strlen($lname) < 3 ? "Last name must be at least 3 characters. " : "") .
            (!$email ? "Email is required. " : "") .
            (strlen($phone) < 10 ? "Phone number must be at least 10 digits. " : "") .
            (!$address ? "Address is required. " : "") .
            (!$city ? "City is required. " : "") .
            (!$state ? "State is required. " : "") .
            (strlen($zip) < 5 ? "Zip code must be at least 5 digits." : "")
    ]);
    exit;
}

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
        customer_id, sku, order_date, status, payment_status, payment_method, 
        total_amount, subtotal_amount, tax_amount, shipping_amount, 
        discount_amount, coupon_code, shipping_name, shipping_phone, 
        shipping_email, shipping_address, shipping_city, shipping_state, 
        shipping_zip, shipping_country, updated_at
    ) VALUES (
        :customer_id, :sku, NOW(), 'Pending', 'Paid', 'Square', 
        :total, :subtotal, 0.00, 0.00, 0.00, '', 
        :shipping_name, :phone, :email, :address, :city, :state, :zip, 'US', NOW()
    )");

    // ONLY EXECUTE ONCE
    $stmt->execute([
        ':customer_id'   => $orderId,
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
    'success' => false, 
    'order_id' => $orderId, 
    'api_response' => json_decode($response), // This puts the API result in the log
    'http_code' => $httpCode
]);
}
?>