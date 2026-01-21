<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gaming.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <title>Zax | Development</title>
</head>
<body> 
    <?php
$host = getenv('DATABASE_HOST');
$dbname = getenv('Products_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

try {
    $stmt = $pdo->prepare("SELECT * FROM Products WHERE tags LIKE ?");
    $stmt->execute(['%gaming pc%']);
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
    <section class="top-section">
        <video autoplay muted loop id="bg-video">
            <source src="../images/playingGames.mp4" type="video/mp4">
        </video>

        <div class="overlay-content">
       <body>
            <a href="#" class="fa fa-bars" id="HbMenu"></a>
                      <nav class="navbar" id="nav">
             
                    <a href="index.php">Home</a>
                    <a href="development.php">Development</a>
                    <a href="gaming.php">Gaming</a>
                    <a href="workstations.php">Workstations</a>
                
            </nav>

    
            <div class="content"> <!-- content is hero-text -->
                    <h1 class="page-title">Dreams Start Here</h1><br/>
                    <div id="buttons" ><button id="shopButton" onclick="shop()">Shop</button><button id="customizeButton" onclick="book()">Customize</button></div>

            </div>
        </div>    
    </section>

    <section class="bottom-section">
      <div class="productContainer">
<div class="product">
    <?php foreach ($products as $product): ?>
        <?php $images = array_values(json_decode($product['image'], true));
?>
      <div class="productSetup">
        <a href="product.php?sku=<?php echo urlencode($product['sku']); ?>">
          <img class="productImages" src="<?php echo htmlspecialchars($images[0]); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
        </a>
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
      </div>
    <?php endforeach; ?>
</div>
</div>
    </section>
<script src="js/script.js"></script>
</body>
</html>