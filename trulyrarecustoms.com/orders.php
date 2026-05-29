<?php
// Load database credentials from environment
$host = getenv('DATABASE_HOST');
$dbname = getenv('Products_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

// Read the incoming JSON
$input = file_get_contents('php://input');
header('Content-Type: application/json');
// echo $input;
echo '{
  "status": "success",
  "message": "Your order has been received."
}';

$data = json_decode($input, true);

//set each data type to a variable
$sku = $data['sku'];
$skus = $data['cartSkus'];
$email = $data['email'];
$phone = $data['phone'];
$price = $data['price'];
$fname = $data['fname'];
$lname = $data['lname'];

//add order to database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("Insert Into orders (sku,order_date,status, payment_status,payment_method, total_amount,subtotal_amount,tax_amount, shipping_amount,discount_amount,coupon_code,shipping_name,shipping_phone,shipping_email,shipping_address,shipping_city,shipping_state,shipping_zip,shipping_country,shipping_method,updated_at)Values (?,?,?,?,?,?,?,?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");  
    $stmt->execute([
        $skus ? $skus : $sku,
        date('Y-m-d H:i:s'),
        'pending',
        'paid',
        'square',
        $price,
        $price,
        0.00,
        0.00,
        0.00,
        'not null',
        $fname . ' ' . $lname,
        $phone,
        $email,
        'not null',
        'not null',
        'not null',
        'not null',
        'not null',
        'not null',
        date('Y-m-d H:i:s')
    ]);
} catch (PDOException $e) {
    // die("Database error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>
