<?php
// adminImageAdd.php

date_default_timezone_set('America/Chicago');

$host = getenv('DATABASE_HOST');
$dbname = getenv('Products_DB');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

$id = $_POST['id'] ?? '';
if (empty($id)) {
    http_response_code(400);
    echo "Missing product ID.";
    exit;
}

if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo "No image uploaded or upload failed.";
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        http_response_code(404);
        echo "Product not found.";
        exit;
    }

    $images = json_decode($product['image'], true);
    if (!is_array($images)) {
        $images = [];
    }

    $originalName = basename($_FILES['image']['name']);
    $tmpName = $_FILES['image']['tmp_name'];
    $randomPrefix = bin2hex(random_bytes(4));
    $fileName = $randomPrefix . '_' . $originalName;
    $serverDestination = __DIR__ . '/assets/' . $fileName;
    $webRelativePath = 'assets/' . $fileName;

    while (file_exists($serverDestination)) {
        $randomPrefix = bin2hex(random_bytes(4));
        $fileName = $randomPrefix . '_' . $originalName;
        $serverDestination = __DIR__ . '/assets/' . $fileName;
        $webRelativePath = 'assets/' . $fileName;
    }

    if (!move_uploaded_file($tmpName, $serverDestination)) {
        http_response_code(500);
        echo "Failed to save uploaded image.";
        exit;
    }

    $images[] = $webRelativePath;
    $imageJson = json_encode($images, JSON_UNESCAPED_SLASHES);

    $update = $pdo->prepare("UPDATE products SET image = ? WHERE id = ?");
    $update->execute([$imageJson, $id]);

    echo "success";
} catch (PDOException $e) {
    http_response_code(500);
    echo "Database error: " . $e->getMessage();
}
