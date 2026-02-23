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

        $firstName = $_POST['first_name'] ?? '';
        $lastName = $_POST['last_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $message = $_POST['message'] ?? '';

        if ($firstName === '' || $lastName === '' || $email === '' || $phone === '' || $message === '') {
            die("Error: All required fields must be filled out.");
        }
        $stmt = $pdo->prepare("Insert Into oe_contact (first_name, last_name, email, phone, message) Values(?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $email, $phone, $message]);

        header("Location: /submitTy.php");
}

?>