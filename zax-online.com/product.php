<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y4MCVJ8B5C"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y4MCVJ8B5C');
</script>
</head>
<?php $sku = isset($_GET['sku']) ? $_GET['sku'] : null;
if (!$sku) {
    echo "Product not found";
    exit;
}

// Load database credentials from environment
$host = getenv('DATABASE_HOST');
$dbname = getenv('Products_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Load main product
    $stmt = $pdo->prepare("SELECT * FROM Products WHERE sku = ?");
    $stmt->execute([$sku]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <title>Zax | Product</title>
</head>
<body> 
     <a href="#" class="fa fa-bars" id="HbMenu"></a>
                      <nav class="navbar" id="nav">
             
                    <a href="index.php">Home</a>
                    <a href="development.php">Development</a>
                    <a href="gaming.php">Gaming</a>
                    <a href="workstations.php">Workstations</a>
                
            </nav>
            


<?php

    if (!$product) {
        echo "Product not found.";
        exit;
    }else{
        echo "<div class=\"productContainer\">";
        $images = array_values(json_decode($product['image'], true));
        echo "<img  id=\"productImage\" src='" . $images[0] . "' alt='" . $product['name'] . "'>";
        echo "<div class=\"thumbnailsContainer\">";
        foreach ($images as $img) {
            echo "<img class=\"thumbnail\" src='" . $img . "' alt='" . $product['name'] . "'>";
        }
        echo "</div>";
        echo "<h1 class=\"productName\">" . htmlspecialchars($product['name']) . "</h1>";
        echo "<p class=\"productDescription\">" . htmlspecialchars($product['description']) . "</p>";
        echo "<p class=\"productPrice\">$" . htmlspecialchars($product['price']) . "</p>";
        echo "<button id=\"buyNowButton\">Buy Now</button>";
        echo "</div>";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<form style="display: none;" id="payment-form">
    <h1>Buy Now</h1>
  <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
  <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
  <input type="email" id="email" name="email" placeholder="Email" required>
  <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>

  <div id="card-container"></div>

  <button type="button" id="card-button">Pay Now</button><button type="button" id="cancel-button">Cancel</button>
  <div id="payment-status"></div>
</form>
<script src="js/product.js"></script>
</body>
</html>