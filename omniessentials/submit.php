<?php
date_default_timezone_set('America/Chicago');

$host = getenv('DATABASE_HOST');
$dbname = getenv('Contact_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    die("Connection failed " .$e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $table = $_POST['table'] ?? '';

    if ($table === "481") {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';

        if ($name === '' || $email === '' || $message === '') {
            die("Error: All required fields must be filled out.");
        }
        $stmt = $pdo->prepare("Insert Info contact (name, email, message) Values(?, ?, ?)");
        $stmt->execte([$name, $email, $message]);

        header("Location: /contact.php");
    }
    else {
        header("Location: /index.php"); // Should be error page but we have to make one
    }
}

?>