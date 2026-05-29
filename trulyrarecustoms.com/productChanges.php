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

$id = $_GET['id'] ?? $_POST['id'];

try {
    // Fetch current product
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product not found");
    }

    $uploadedFiles = [];

    // Check if any files uploaded
    $filesUploaded = false;
    for ($i = 0; $i <= 9; $i++) {
        if (!empty($_FILES["file$i"]["name"])) {
            $filesUploaded = true;
            break;
        }
    }

    if ($filesUploaded) {
        for ($i = 0; $i <= 9; $i++) {
            $fileKey = "file$i";
            
            if (!empty($_FILES[$fileKey]["name"])) {
                $tmpName = $_FILES[$fileKey]["tmp_name"];

                // 1. Create a unique filename
                $randomPrefix = bin2hex(random_bytes(4)); 
                $originalName = basename($_FILES[$fileKey]["name"]);
                $fileName = $randomPrefix . "_" . $originalName;

                // 2. Define the absolute path for the SERVER to move the file
                $serverDestination = __DIR__ . "/assets/" . $fileName;

                // 3. Define the relative path for the DATABASE/URL
                $webRelativePath = "assets/" . $fileName;

                // Collision check
                while (file_exists($serverDestination)) {
                    $randomPrefix = bin2hex(random_bytes(4));
                    $fileName = $randomPrefix . "_" . $originalName;
                    $serverDestination = __DIR__ . "/assets/" . $fileName;
                    $webRelativePath = "assets/" . $fileName;
                }

                // 4. Move the file using the SERVER path, store the WEB path
                if (move_uploaded_file($tmpName, $serverDestination)) {
                    $uploadedFiles[] = $webRelativePath; 
                }
            }
        }
        $image = json_encode($uploadedFiles, JSON_UNESCAPED_SLASHES);
    } else {
        $image = $product['image'];
    }

    // Update product
    $stmt = $pdo->prepare("UPDATE products SET 
        name = ?, 
        description = ?, 
        image = ?, 
        price = ?, 
        currency = ?, 
        tags = ?, 
        stock = ?, 
        `visible/not visible` = ? 
        WHERE id = ?");
    $stmt->execute([
        $_POST['name'],
        $_POST['description'],
        $image,
        $_POST['price'],
        $_POST['currency'],
        $_POST['tags'],
        $_POST['stock'],
        $_POST['visible'],
        $id
    ]);

    header("Location: user_page.php");

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
