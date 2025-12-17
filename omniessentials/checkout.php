<?php
if (isset($_GET['items'])) {
    $items = explode(',', $_GET['items']);

     $host = getenv('DATABASE_HOST');
                $dbname = getenv('Products_DB');
                $user = getenv('Site_USER');
                $pass = getenv('Site_PASS');
        for ($i = 0; $i < count($items); $i++) {
                        echo $items[$i] . "<br>";
                try{
                  $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM Products where name like ?");
                  $stmt->execute([$items[$i]]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo $product['name'];
                }catch(PDOException $e){
                  echo "Connection failed: " . $e->getMessage();
                }
            }
}
    ?>