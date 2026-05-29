<?php
// adminProductDelete.php

$host = getenv('DATABASE_HOST');
$db   = getenv('Products_DB');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // ✅ Get the POSTed ID
    $id = $_POST['id'] ?? '';

    if (empty($id)) {
        echo "No ID provided.";
        exit;
    }

    // ✅ Prepare DELETE statement
    $stmt = $pdo->prepare("DELETE FROM Products WHERE id = :id");

    // ✅ Execute deletion
    $stmt->execute([':id' => $id]);

    // ✅ Check if any row was deleted
    if ($stmt->rowCount() > 0) {
        echo "success";
    } else {
        echo "No product found with that ID.";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
