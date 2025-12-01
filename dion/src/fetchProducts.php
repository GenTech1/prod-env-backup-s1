<?php
header("Access-Control-Allow-Origin: http://localhost:3000");+-p-
header('Content-Type: application/json');

$host = getenv('DATABASE_HOST');
$dbForCategories = getenv('Categories_DB');
$dbname = getenv('Products_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {      
    $pdo = new PDO("mysql:host=$host;dbname=$dbForCategories;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

try {
    $index = 0;
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    $titles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($titles);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>