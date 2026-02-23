<?php
// adminAddProducts.php

$host = getenv('DATABASE_HOST');
$db   = getenv('Products_DB');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

  $uploadedFiles = [];

    for ($i = 0; $i <= 9; $i++) {
    if (!empty($_FILES["file$i"]["name"])) {
        $tmpName = $_FILES["file$i"]["tmp_name"];
        $fileName = $_FILES["file$i"]["name"];
        $destination = "assets//" . $fileName; // adjust path as needed
        if (move_uploaded_file($tmpName, $destination)) {
            $uploadedFiles[] = $destination;
        }
    }
}
    // Get POST values
    $name        = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = json_encode($uploadedFiles, JSON_UNESCAPED_SLASHES);
    $price       = $_POST['price'] ?? 0;
    $currency    = $_POST['currency'] ?? 'USD';
    $tags        = $_POST['tags'] ?? '';
    $stock       = $_POST['stock'] ?? '{"XS":0,"S":0,"M":0,"L":0,"XL":0,"2XL":0,"3XL":0}';
    $sku         = $_POST['sku'] ?? '';
    $visible     = $_POST['visible'] ?? 'yes';

    // Prepare insert query
    $stmt = $pdo->prepare("
        INSERT INTO products
        (name, description, image, price, currency, tags, stock, sku, `visible/not visible`)
        VALUES
        (:name, :description, :image, :price, :currency, :tags, :stock, :sku, :visible)
    ");

    // Execute with bound parameters
    $stmt->execute([
        ':name'        => $name,
        ':description' => $description,
        ':image'       => $image,
        ':price'       => $price,
        ':currency'    => $currency,
        ':tags'        => $tags,
        ':stock'       => $stock,
        ':sku'         => $sku,
        ':visible'     => $visible
    ]);
    header("Location: user_page.php");   

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

?>
