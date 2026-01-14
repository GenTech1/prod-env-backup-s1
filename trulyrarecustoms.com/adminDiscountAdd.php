<?php

$host = getenv('DATABASE_HOST');
$db   = getenv('Categories_DB');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Get POST values
    $name    = $_POST['name'] ?? '';
    $code    = $_POST['code'] ?? '';
    $exp     = $_POST['exp'] ?? null;         
    $percent = $_POST['percent'];     
    $amount  = $_POST['amount']; 

    echo $name;
    echo $code;
    echo $exp;
    echo $percent;
    echo $amount;     

    //Simple insert using ? placeholders
    $stmt = $pdo->prepare("
        INSERT INTO discounts (name, code, exp, percent, amount)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([$name, $code, $exp, $percent, $amount]);

    header("Location: admin_discounts.php");   
    exit;

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
 }

?>
