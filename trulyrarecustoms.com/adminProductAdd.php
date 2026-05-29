
<?php
// adminAddProducts.php

// --- DEBUG BLOCK: Remove this once your "File Not Found" issue is fixed ---
$assetsPath = __DIR__ . "/assets";
if (!is_dir($assetsPath)) {
    die("CRITICAL ERROR: The directory 'assets' does not exist at: " . $assetsPath);
}
if (!is_writable($assetsPath)) {
    die("PERMISSION ERROR: The 'assets' folder is not writable by: " . exec('whoami'));
}
// --------------------------------------------------------------------------

// adminAddProducts.php
echo exec('whoami');
$host = getenv('DATABASE_HOST');
$db   = getenv('Products_DB');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
echo "<script>console.log(" . json_encode($_FILES) . ");</script>";
try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

  $uploadedFiles = [];

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
        // This assumes your assets folder is in the same directory as this script
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
            // This is what you will insert into your database
            $uploadedFiles[] = $webRelativePath; 
        } else {
            // Handle move error
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
        (name, description, image, price, currency, tags, stock, sku, visible)
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
