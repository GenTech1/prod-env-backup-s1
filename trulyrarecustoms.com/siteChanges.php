<?php
date_default_timezone_set('America/Chicago');


$host = getenv('DATABASE_HOST');
$dbname = getenv('Categories_DB');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');

try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
die("Connection failed " .$e->getMessage());
}

try {
    $stmt = $pdo->query("SELECT * FROM headers");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($products); $i++) {
        $id = $_POST['id'];

        if ($products[$i]['id'] == $id) {

            $stmt = $pdo->prepare("UPDATE headers SET name = ? WHERE id = ?");
            $stmt->execute([$_POST['name'], $_POST['id']]);

            $stmt = $pdo->prepare("UPDATE headers SET page = ? WHERE id = ?");
            $stmt->execute([$_POST['page'], $_POST['id']]);

            header("Location: user_page.php");
        }
    }

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
