<?php
// Fix balance column precision to always show .00

$host = getenv('DATABASE_HOST');
$dbname = getenv('Users_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Alter balance column to DECIMAL(10,2) to always show .00
    $sql = "ALTER TABLE users MODIFY balance DECIMAL(10,2) DEFAULT 0.00";
    $pdo->exec($sql);
    
    // Update existing balance values to have decimal precision
    $updateSql = "UPDATE users SET balance = CAST(balance AS DECIMAL(10,2))";
    $pdo->exec($updateSql);
    
    echo "✓ Balance column updated to DECIMAL(10,2) - will always display as X.XX format";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
