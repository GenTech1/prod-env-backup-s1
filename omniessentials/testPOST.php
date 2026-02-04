<?php
$url = "https://api.madely.com/pm/v1/orders.json";
$apiKey = "o3cxzababnTKhy72oK4YHcPHWZH2jPxg";

/**
 * Generates a 24-character hex string similar to a MongoDB ObjectId
 */
function generateMongoId() {
    return bin2hex(random_bytes(12));
}

$orderId = generateMongoId(); // Create the top-level ID
$itemId  = substr(bin2hex(random_bytes(4)), 0, 8); // Create an 8-char ID for the item

$orderData = [
    "id" => $orderId, 
    "sample" => true,
    "address_to" => [
        "first_name" => "Test",
        "last_name" => "User",
        "address1" => "123 Test Lane",
        "city" => "New York",
        "region" => "NY",
        "zip" => "10001",
        "country" => "US",
        "email" => "test@example.com",
        "phone" => "5555555555"
    ],
    "shipping" => [
        "carrier" => "FedEx",
        "priority" => "Ground"
    ],
    "items" => [
        [
            "id" => $itemId, // The item needs its own ID too
            "sku" => "K34-LIDANDSTRAW", 
            "quantity" => 1,
            "preview_files" => [
                "front" => "https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg"
            ],
            "print_files" => [
                "front" => "https://images.pexels.com/photos/1629236/pexels-photo-1629236.jpeg"
            ]
        ]
    ]
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

echo "Generated Order ID: $orderId\n";
echo "Status Code: $httpCode\n";
echo "Response: $response";

curl_close($ch);
?>










