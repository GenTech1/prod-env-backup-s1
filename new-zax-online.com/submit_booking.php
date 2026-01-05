<?php
date_default_timezone_set('America/Chicago');

$host = getenv('DATABASE_HOST');
$dbname = getenv('Messages_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
die("Connection failed " .$e->getMessage());
}

//set variables from form
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';
$dateTime = $date . ' ' . $time . ':00';
$service = $_POST['service'] ?? '';
$submitted_at = date('Y-m-d H:i:s');
echo $name;
echo $email;
echo $phone;
echo $date;
echo $time;
echo $service;
echo $submitted_at;    

//validate required fields
if ($name === '' || $email === '' || $phone === '' || $date === '' || $time === '' || $service === '' || $submitted_at === '') {
    die("Error: All required fields must be filled out.");
    header("Location: /404.php");
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email format.");
    header("Location: /404.php");
}elseif (!preg_match('/^[0-9\-\(\)\/\+\s]*$/', $phone)) {
    die("Error: Invalid phone number format.");
    header("Location: /404.php");
}else{
    //insert data into database
    $stmt = $pdo->prepare("INSERT INTO messages (Name, Email, Phone, date_time, service_type, submitted_at) VALUES (:Name, :Email, :Phone, :date_time, :service_type, :submitted_at)");
    $stmt->execute([
        ':Name' => $name,
        ':Email' => $email,
        ':Phone' => $phone,
        ':date_time' => $dateTime,
        ':service_type' => $service,
        ':submitted_at' => $submitted_at
    ]);
    header("Location: /ty.php");
}

?>