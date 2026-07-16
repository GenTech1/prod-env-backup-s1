<?php
session_start();

// Check if password protection is enabled
$host = getenv('DATABASE_HOST');
$dbname = getenv('Site_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT setting_value FROM site_settings WHERE setting_key = 'password_protection_enabled'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // If password protection is disabled (setting_value = '0'), skip authentication
    if ($result && $result['setting_value'] === '0') {
        return; // Allow access without authentication
    }
} catch (PDOException $e) {
    error_log('Password protection auth check failed: ' . $e->getMessage());
    // If database error, default to requiring authentication for security
}

// Check if user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: starter.php");
    exit();
}
?>