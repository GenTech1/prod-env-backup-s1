<?php
session_start();

// Check if user is authenticated via token
if (!isset($_COOKIE['token'])) {
    header("Location: 404.php");
    exit;
}

$host = getenv('DATABASE_HOST');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');
$siteDb = getenv('Site_DB');
$usersDb = getenv('Users_DB');

try {
    // Connect to users database to verify admin permissions
    $pdo = new PDO("mysql:host=$host;dbname=$usersDb;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $token = $_COOKIE['token'];
    $stmt = $pdo->prepare("SELECT * FROM tokens WHERE token = ? AND expires_at > NOW()");
    $stmt->execute([$token]);
    $tokenRow = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tokenRow) {
        header("Location: sessionExpired.php");
        exit;
    }

    $userEmail = $tokenRow['user_email'];
    $userStmt = $pdo->prepare("SELECT * FROM internal_users WHERE email = ?");
    $userStmt->execute([$userEmail]);
    $userRow = $userStmt->fetch(PDO::FETCH_ASSOC);

    if (!$userRow) {
        header("Location: 404.php");
        exit;
    }

    $permissions = json_decode($userRow['permissions'], true);

    // Check if user has site permissions
    if (!isset($permissions['site']) || $permissions['site'] != 1) {
        header("Location: 404.php");
        exit;
    }

    // Connect to site database to update setting
    $sitePdo = new PDO("mysql:host=$host;dbname=$siteDb;charset=utf8mb4", $user, $pass);
    $sitePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $currentStatus = $_POST['current_status'];
        $newStatus = ($currentStatus === '1') ? '0' : '1';

        $updateStmt = $sitePdo->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = 'password_protection_enabled'");
        $updateStmt->execute([$newStatus]);

        // Clear all authentication sessions if disabling protection
        if ($newStatus === '0') {
            session_destroy();
        }
    }

} catch (PDOException $e) {
    error_log("Database error in toggle_protection.php: " . $e->getMessage());
    header("Location: 404.php");
    exit;
}

// Redirect back to user page
header("Location: user_page.php");
exit;
?>