<?php
    $copUser = getenv('Auto_Mail');
    $copPass = getenv('Auto_Pass');
    $host = getenv('DATABASE_HOST') ?? '';
    $dbname = getenv('Products_DB') ?? '';
    $user = getenv('Site_USER') ?? '';
    $pass = getenv('Site_PASS') ?? '';

    ?>


    <?php

    try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

    if (isset($_POST["delete_item_id"])) {

        $deleteId = intval($_POST["delete_item_id"]);

        $sql = $pdo->prepare("DELETE FROM products WHERE id = ?");

            $idDeleted = $sql->execute([$deleteId]);

        if ($idDeleted) {
            header("Location: login.php");
        } else {
            // header("Location: login.php");
            echo "failed to delete item";
                exit;
        }
    }else if(isset($_POST["edit_product_id"])){
  
        $editId = intval($_POST["edit_product_id"]);

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$editId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $currency = $_POST['currency'];
        $tags = $_POST['tags'];
        $stock = $_POST['stock'];
        $sku = $_POST['sku'];
        $visible = $_POST['visible'];

        $image = $product['image'];
        $print = $product['print'];

        $uploadDir = './public/assets/';

        // Handle print upload
        if (isset($_FILES['print']) && $_FILES['print']['error'] === UPLOAD_ERR_OK) {
            $rand = bin2hex(random_bytes(8));
            $extension = pathinfo($_FILES['print']['name'], PATHINFO_EXTENSION);
            $newFileName = $rand . "." . $extension;
            $uploadFile = $uploadDir . $newFileName;
            if (move_uploaded_file($_FILES['print']['tmp_name'], $uploadFile)) {
                $print = $uploadFile;
            }
        }

        // Handle image uploads
        $newImagesUploaded = false;
        for ($i = 1; $i <= 4; $i++) {
            if (isset($_FILES["image$i"]) && $_FILES["image$i"]['error'][0] !== UPLOAD_ERR_NO_FILE) {
                $newImagesUploaded = true;
                break;
            }
        }

        if ($newImagesUploaded) {
            $imagePath = [];
            for ($i = 1; $i <= 4; $i++) {
                $imageName = "image$i";
                if (isset($_FILES[$imageName])) {
                    foreach ($_FILES[$imageName]['name'] as $key => $name) {
                        if ($_FILES[$imageName]['error'][$key] === UPLOAD_ERR_OK) {
                            $tmp_name = $_FILES[$imageName]['tmp_name'][$key];
                            $rand2 = bin2hex(random_bytes(8));
                            $extension2 = pathinfo($name, PATHINFO_EXTENSION);
                            $newFileName2 = $rand2 . "." . $extension2;
                            $uploadFile2 = $uploadDir . $newFileName2;
                            if (move_uploaded_file($tmp_name, $uploadFile2)) {
                                $imagePath[] = str_replace("/", "\\\\", $uploadFile2);
                            }
                        }
                    }
                }
            }
            $imageJson = [];
            foreach ($imagePath as $index => $path) {
                $imageJson[$index + 1] = $path;
            }
            $image = json_encode($imageJson);
        }

        $time_updated = date('Y-m-d H:i:s');

        $sql = $pdo->prepare("UPDATE products SET name = ?, description = ?, image = ?, print = ?, price = ?, currency = ?, tags = ?, stock = ?, sku = ?, `time updated` = ?, visible = ? WHERE id = ?");
        
        $changed = $sql->execute([
            $name,
            $description,
            $image,
            $print,
            $price,
            $currency,
            $tags,
            $stock,
            $sku,
            $time_updated,
            $visible,
            $editId
        ]);

        if ($changed) {
            header("Location: owner_create_product.php");
            exit;
        } else {
            header("Location: owner_create_product.php");
            exit;
        };
    }else {

    

    
    if (isset($_FILES['print']) && $_FILES['print']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = './public/assets/';
                    $rand = bin2hex(random_bytes(8)); // Generate a random string for the filename
                    $extension = pathinfo($_FILES['print']['name'], PATHINFO_EXTENSION);// Get the file extension
                    $newFileName = $rand . "." . $extension;
                    $uploadFile = $uploadDir . $newFileName;
                    
                    if (move_uploaded_file($_FILES['print']['tmp_name'], $uploadFile)) {
                        // echo "File is valid, and was successfully uploaded.";
                        $printPath = $uploadFile; // Store the path to save in the database
                    } else {
                        // echo "Possible file upload attack!\n";
                        // $printPath = null; // Handle the error as needed
                        var_dump($_FILES['print']['error']);
                    }

                    $imagePath = [];

                    for ($i = 1; $i <= 4; $i++) {
                        $imageName = "image$i";

                        if (isset($_FILES["$imageName"])) {

                            foreach ($_FILES[$imageName]['name'] as $key => $name) {
                                if ($_FILES[$imageName]['error'][$key] === UPLOAD_ERR_OK) {

                                $tmp_name = $_FILES[$imageName]['tmp_name'][$key];
                            
                            $rand2 = bin2hex(random_bytes(8)); // Generate a random string for the filename
                            $extension2 = pathinfo($name, PATHINFO_EXTENSION);// Get the file extension
                            $newFileName2 = $rand2 . "." . $extension2;
                            $uploadFile2 = $uploadDir . $newFileName2;
                            
                            if (move_uploaded_file($tmp_name, $uploadFile2)) {
                                // echo "File is valid, and was successfully uploaded.";
                                $imagePath[] = str_replace("/", "\\\\", $uploadFile2); // Store the path to save in the database
                            } else {
                                echo "Possible file upload attack!";
                                // Handle the error as needed
                                $imagePath = null; // Store the path to save in the database
                            }
                                }
                            }
                        }
                    }

                    $imageJson = [];
                    foreach ($imagePath as $index => $path) {
                        $imageJson[$index + 1] = $path; // Store the path with keys image1, image2, etc.
                    }
                    $image = json_encode($imageJson); // Convert the array to JSON for database storage


    $name = $_POST['name'];

    $description = $_POST['description'];
    
    $image = $image;
    
    $print = $printPath;
    
    $price = $_POST['price'];
    
    $currency = $_POST['currency'];
    
    $tags = $_POST['tags'];
    
    $stock = $_POST['stock'];
    
    $sku = $_POST['sku'];

    $time_created = date('Y-m-d H:i:s');

    $time_updated = date('Y-m-d H:i:s');
    
    $visible = $_POST['visible'];
    
    $sql = $pdo->prepare("INSERT INTO products (name, description, image, print, price, currency, tags, stock, sku, `time created`, `time updated`, visible)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

           $bingPlace = $sql->execute([
                $name,
                $description,
                $image, 
                $print, 
                $price, 
                $currency, 
                $tags, 
                $stock, 
                $sku,
                $time_created,
                $time_updated, 
                $visible
            ]);
    }
            if ($bingPlace) {
                header("Location: owner_create_product.php");
                exit;
            } else {
                header("Location: owner_create_product.php");
                exit;
            };
        }
?>
