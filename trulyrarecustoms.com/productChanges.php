<?php
date_default_timezone_set('America/Chicago');


$host = getenv('DATABASE_HOST');
$dbname = getenv('Products_DB');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');

try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
die("Connection failed " .$e->getMessage());
}

try {
$stmt = $pdo->query("SELECT * FROM Products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($products); $i++) {
    $id = $_POST['id'];

    if ($products[$i]['id'] == $id) {

        $stmt = $pdo->prepare("UPDATE Products SET name = ? WHERE id = ?");
        $stmt->execute([$_POST['name'], $_POST['id']]);

        $stmt = $pdo->prepare("UPDATE Products SET description = ? WHERE id = ?");
        $stmt->execute([$_POST['description'], $_POST['id']]);

        $stmt = $pdo->prepare("UPDATE Products SET image = ? WHERE id = ?");
        $stmt->execute([$_POST['image'], $_POST['id']]);

        $stmt = $pdo->prepare("UPDATE Products SET price = ? WHERE id = ?");
        $stmt->execute([$_POST['price'], $_POST['id']]);

        $stmt = $pdo->prepare("UPDATE Products SET currency = ? WHERE id = ?");
        $stmt->execute([$_POST['currency'], $_POST['id']]);

        $stmt = $pdo->prepare("UPDATE Products SET image = ? WHERE id = ?");
        $stmt->execute([str_replace('\\', '\\\\', $_POST['image']), $_POST['id']]);

        $stmt = $pdo->prepare("UPDATE Products SET tags = ? WHERE id = ?");
        $stmt->execute([$_POST['tags'], $_POST['id']]);

        $stmt = $pdo->prepare("UPDATE Products SET stock = ? WHERE id = ?");
        $stmt->execute([$_POST['stock'], $_POST['id']]);

        $stmt = $pdo->prepare("UPDATE Products SET `visible/not visible` = ? WHERE id = ?");
        $stmt->execute([$_POST['visible'], $_POST['id']]);

        header("Location: user_page.php");
    }
}


} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
