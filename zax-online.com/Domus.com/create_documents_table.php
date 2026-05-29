<?php
// Create documents table

$host = getenv('DATABASE_HOST');
$dbname = getenv('Users_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create documents table
    $sql = "CREATE TABLE IF NOT EXISTS documents (
        id INT PRIMARY KEY AUTO_INCREMENT,
        location VARCHAR(255) NOT NULL,
        user_id INT NOT NULL,
        business_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE,
        INDEX idx_user_business (user_id, business_id)
    )";
    
    $pdo->exec($sql);
    echo "✓ Documents table created successfully";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
