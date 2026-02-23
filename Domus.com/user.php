<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}

// Decide where to send user based on user_type
$user_type = strtolower(trim($_SESSION['user_type'] ?? 'tenant'));

switch ($user_type) {
    case 'management':
        header('Location: management.php');
        break;
    case 'maintenance':
        header('Location: maintenance.php');
        break;
    case 'tenant':
    default:
        header('Location: tenant.php');
        break;
}
exit;
?>