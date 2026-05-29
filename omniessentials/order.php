<?php
// Check if the product was actually sent
if (isset($_POST['product'])) {
    try{
    $productName = $_POST['product'];
    
  $host = getenv('DATABASE_HOST');
                $dbname = getenv('Products_DB');
                $user = getenv('Site_USER');
                $pass = getenv('Site_PASS');

                
                  $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM products where name like ?");
                  $stmt->execute([$productName]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo $product['name'] . "<br>";
// Order product from printed mint
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
            "sku" => $product['sku'], 
            "quantity" => 1,
            "preview_files" => [
                "front" => "https://zaxtest.xyz/".$product['image']
            ],
            "print_files" => [
                "front" => "https://zaxtest.xyz/".$product['print']
            ]
        ]
    ]
];
echo json_encode(['status' => 'success', 'message' => 'Order placed!']);
}catch(PDOException $e){
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
} 
}else {
    echo json_encode(['status' => 'error', 'message' => 'No product data received.']);
}
?>