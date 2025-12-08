<?php
date_default_timezone_set('America/Chicago');

$host = getenv('');
$dbname = getenv('');
$user = getenv('');
$pass = getenv('');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    die("Connection failed " .$e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $table = $_POST['table'] ?? '';

    if ($table === "481")
}

?>