<?php
// adminImageDelete.php

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
$index = isset($_POST['index']) ? intval($_POST['index']) : null;

if (empty($id) || $index === null) {
    http_response_code(400);
    echo "Missing product ID or image index.";
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

    if (!array_key_exists($index, $images)) {
        http_response_code(400);
        echo "Image index not found.";
        exit;
    }

    $deletedImage = $images[$index];
    unset($images[$index]);
    $images = array_values($images);

    $imageJson = json_encode($images, JSON_UNESCAPED_SLASHES);

    $update = $pdo->prepare("UPDATE products SET image = ? WHERE id = ?");
    $update->execute([$imageJson, $id]);

    if (!empty($deletedImage) && strpos($deletedImage, 'assets/') === 0) {
        $filePath = __DIR__ . '/' . $deletedImage;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }

    echo "success";
} catch (PDOException $e) {
    http_response_code(500);
    echo "Database error: " . $e->getMessage();
}
