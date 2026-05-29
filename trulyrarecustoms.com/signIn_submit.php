<?php
date_default_timezone_set('America/Chicago');

$host = getenv('DATABASE_HOST');
$dbname = getenv('Users_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
die("Connection failed " .$e->getMessage());
}


//send data to database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$email = $_POST["sgnemail"] ?? '';
$pass = $_POST["sgnpass"] ?? '';
$token = bin2hex(random_bytes(32)); // Generates a 64-character hex token
$purpose = 'login';
$mode = 'timed';
$created_at = date('Y-m-d H:i:s');
$expires_at = date('Y-m-d H:i:s', time() + 900);
$ip = $_SERVER['REMOTE_ADDR'];


if(filter_var($email, FILTER_VALIDATE_EMAIL) === true || strlen($pass) >= 8 || strlen($pass) < 64 || $email !== '' || $pass !== ''){

    //check credentials
try {
	$stmt = $pdo->prepare("Select * from internal_users Where email = ?");
	$stmt->execute([$email]);

	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($user && password_verify($pass, $user['password_hash'])) {
	
	
	setcookie(
    "token",         // Name
    $token,          // Value
    time() + 120,   // Expire in 2 minutes
    "/",             // Path
    "",              // Domain (empty = current)
    true,            // Secure (set true in HTTPS)
    false             // HttpOnly (not accessible by JavaScript)
);
	
	$stmt = $pdo->prepare("INSERT INTO tokens (token, purpose, mode, user_email, created_at, expires_at, used_ip) VALUES (?, ?, ?, ?, ?, ?, ?)");
    	$stmt->execute([$token, $purpose, $mode, $email, $created_at, $expires_at, $ip]);

	header('Location: user_page.php');
	exit;
}else{
header('Location: signInFailed.php');

exit;
}
}catch(PDOException $e){
echo 'DB error: ' . $e->getMessage();
}
}else{
header('Location: signInFailed.php');
}
}else{
header('Location: signInFailed.php');
}
?>
