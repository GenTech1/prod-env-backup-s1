<?php
$host = getenv('DATABASE_HOST') ?: 'localhost';
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');
$dbname = getenv('Site_DB') ?: 'trc_site';

if (!$user || !$pass) {
    die("Missing Site_USER or Site_PASS environment variables.\n");
}

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    $pdo->exec("USE `$dbname`");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS site_settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            setting_key VARCHAR(255) NOT NULL UNIQUE,
            setting_value VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    $stmt = $pdo->prepare("SELECT setting_value FROM site_settings WHERE setting_key = 'password_protection_enabled'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        $insert = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES ('password_protection_enabled', '1')");
        $insert->execute();
    }

    echo "Password protection setup complete.\n";
    echo "Database: $dbname\n";
    echo "Table: site_settings\n";
} catch (PDOException $e) {
    echo "Setup failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>
