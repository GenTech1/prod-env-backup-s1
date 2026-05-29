<?php
date_default_timezone_set('America/Chicago'); // good
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = getenv('DATABASE_HOST'); // good
$dbname = getenv('Users_DB'); // good
$user = getenv('Site_USER'); // good
$pass = getenv('Site_PASS'); // good

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass); // good
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // good
}catch (PDOException $e){
    die("Connection failed " .$e->getMessage()); // good
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

$time_post = date('Y-m-d H:i:s'); // good

        $first_name = $_POST['first_name'] ?? ''; // good
        $last_name = $_POST['last_name'] ?? ''; // good
        $email = $_POST['email'] ?? ''; // good
        $phone_number = $_POST['phone_number'] ?? ''; // good
        $message = $_POST['message'] ?? ''; // good
        // $time_post = $_POST['time_post'] ?? '';


        if ($first_name === '' || $last_name === '' || $email === '' || $phone_number === '' || $message === '') {
            die("Error: All required fields must be filled out.");
        } // good

        $sql = $pdo->prepare("INSERT INTO contact (first_name, last_name, email, phone_number, message, time_post)
            VALUES (?, ?, ?, ?, ?, ?)"); // good

           $success = $sql->execute([
                $first_name,
                $last_name,
                $email,
                $phone_number,
                $message,
                $time_post
            ]); // good

            if ($success) {
                header("Location: submitTy.php");
                exit;
            }; // good
}

?>