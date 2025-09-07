
<?php
// Get SKU from query parameter
$sku = isset($_GET['sku']) ? $_GET['sku'] : null;
if (!$sku) {
    echo "No product SKU provided.";
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



    if (!$product) {
        echo "Product not found.";
        exit;
    }

    // Load color variants
    $variantPrefix = $sku . '-%';
    $variantStmt = $pdo->prepare("SELECT * FROM Products WHERE sku LIKE ?");
    $variantStmt->execute([$variantPrefix]);
    $variants = $variantStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Sort options
$colors = [];


foreach ($variants as $v) {
    $parts = explode('-', $v['sku']);
    $suffix = strtoupper(end($parts));

    if (preg_match('/^[a-zA-Z]+$/', $suffix)) {
        $colors[] = strtolower($suffix);
    }
}

$colors = array_unique($colors);

?>



<!DOCTYPE html>
<html>
  <!--header-->
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="blackback">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="product.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="homeLogo">
    <img id="logo1" src="assets/logo1.png" alt="Logo1"/>
    </div>
    <!--Nav-->
    <a href="#" class="fa fa-bars" id="HbMenu"></a>
    <nav id="nav">

<a href="index.php">Home</a>
<a href="shop.php">Shop</a>
<a href="customize.php">Customize</a>
<a href="gallery.php">Gallery</a>
<a href="about.php">About</a>
<a href="events.php">Events</a>
    </nav>
    <nav id="usrOps">
    <a href="#" class="fa fa-search"></a>
    <a href="signIn.php" class="fa fa-user"></a>
    <a href="#" class="fa fa-shopping-cart"></a>
    </nav>
    <hr/>
    </div>
  </head>
 
  <body>
    <!--Caroucel-->
    <main>
	

	<div class="productDisplay">
  <h1><?php echo htmlspecialchars($product['name']); ?></h1>

  <img class="productImage" src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width:300px;border:1px solid #ccc;" />
  <div id="productData">
  <p><?php echo htmlspecialchars($product['description']); ?></p>

  <p><strong>Price:</strong> <?php echo htmlspecialchars($product['price']) . ' ' . htmlspecialchars($product['currency']); ?></p>
 <div id="colors">
  <?php if (!empty($colors)): ?>
    <h3>Colors:</h3>
    <div style="display: flex; gap: 10px; margin-bottom: 10px;">
      <?php foreach ($colors as $color): ?>
  <?php $cleanColor = strtoupper(str_replace(' ', '', trim($color))); ?>
  <svg width="30" height="30">
    <a href="product.php?sku=<?php echo $product['sku'] . '-' . $cleanColor; ?>">
      <rect width="30" height="30" style="fill:<?php echo trim($color); ?>;stroke:#000;stroke-width:1;" />
    </a>
  </svg>
<?php endforeach; ?>

    </div>
  <?php endif; ?>
	<h3>Size:</h3>
<div id="sizes">
  <?php

$product['stock'] = '{"XS":0,"S":2,"M":5,"L":0,"XL":0,"2XL":0,"3XL":0}';
	 
	// Decode the JSON stock string into an associative array
$sizes = json_decode($product['stock'], true);

if ($sizes && is_array($sizes)) {
    foreach ($sizes as $size => $quantity) {
        if ($quantity > 0) {
            echo '<button type="button">' . htmlspecialchars($size) . '</button>';
        }
    }
} else {
    echo "No stock data available.";
}
?>
   </div>

<div id="purchaseButtons">
<form id="cart">
  <input type="submit" value="Add to Cart" />
</form>

<form id="buy">
  <input type="submit" value="Buy Now" />
</form>  
</div>
</div>




    </main>
<script src="product.js"></script>
  </body>
  <footer>
    <div class="blackback"
    <hr />
    <div id="icons">
 
    <nav id="socials">
      <a href="https://www.instagram.com/tru.lyrare/" class="fa fa-instagram"></a>
      <a href="https://www.facebook.com/people/Truly-Rare-Customs/61566452542361/" class="fa fa-facebook"></a>
      </nav>
  </div>
  <div id="botLogo">
     <img id="logo2" src="assets/logo2.PNG" alt="logo2"/>
    </div>
    <nav id="footerNav">
      <a href="pp.php">Privacy Policy</a>
      <a href="customize.php">Book</a>
      <a href="contact.php">Contact us</a>
      <a href="about.php">About</a>
    </nav>
    <form id="marketingForm">
      <input type="email" placeholder="Email"/>
      <input type="submit" Placeholder="Sign Up"/>
    </form>
  </div>
  </footer>
