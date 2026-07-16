<?php
$host = getenv('DATABASE_HOST');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');
$sitedb = getenv('Categories_DB');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
try{
    $pdo = new PDO("mysql:host=$host;dbname=$sitedb;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt =$pdo->prepare("UPDATE site_settings SET setting_value =1");
    $stmt2 = $pdo->prepare("UPDATE site_settings SET setting_value = 0");
    
    if($data['lock'] ==1)
{
    $stmt->execute();
}else if($data['lock'] ==0)
{
    $stmt2->execute();
}
else
{
    die("Connection failed: Invalid lock value");
}
echo json_encode([
    "success" => true,
    "message" => "Site lock status updated successfully." . $data['lock']
]);
}catch(PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
?>