<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta
      name="description"
      content="Web site created using create-react-app"
    />

    <title>Omni Essentials</title>
    <link rel="stylesheet" href="public/css/App.css" />
    <link rel="stylesheet" href="public/css/shop.css" />
  </head>

  <body>
    <script src="public/js/script.js"></script>
    <script src="public/js/shop.js"></script>
    <header class="navbar">
        <div class="logo">Omni Essentials</div>

        <div class="hamburger" onclick="toggleMenu()">☰</div>

        <nav id="navMenu">
          <button class="nav-btn" onclick="window.location.href='index.php'">Home</button>
          <button class="nav-btn" onclick="window.location.href='about.php'">About</button>
          <button class="nav-btn" onclick="window.location.href='shop.php'">Shop</button>
          <button class="nav-btn" onclick="window.location.href='contact.php'">Contact</button>
          <button class="nav-btn" onclick="window.location.href='login.php'">Login</button>
        </nav>
      </header>

      <script>
        function toggleMenu() {
          document.getElementById('navMenu').classList.toggle('active');
        }
      </script>

    <noscript>You need to enable JavaScript to run this app.</noscript>

<div class="all">
  <div class="shop-section">
    <h1 class="section-title">Shop</h1>

    <div class="shop-content">
      <div class="product-grid">
        <?php
        $host = getenv('DATABASE_HOST');
        $dbname = getenv('Products_DB');
        $user = getenv('Site_USER');
        $pass = getenv('Site_PASS');

        try {
            $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch Parent products
            $stmt = $conn->prepare("SELECT * FROM products WHERE sku2 IS NULL OR sku2 = ''");
            $stmt->execute();
            $parents = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($parents as $parent) {
                $parentID = $parent['id'];
                $parentSKU = $parent['sku'];
                $name = htmlspecialchars($parent['name']);
                
                // Fetch variations
                $vStmt = $conn->prepare("SELECT id, name, price FROM products WHERE sku2 = ?");
                $vStmt->execute([$parentSKU]);
                $variations = $vStmt->fetchAll(PDO::FETCH_ASSOC);

                $images = json_decode($parent['image'], true) ?: [];
                $firstImage = (!empty($images) && isset($images['1'])) ? $images['1'] : './public/assets/default.jpg';
                $firstImage = str_replace("\\", "/", $firstImage);
                $imagesJson = htmlspecialchars(json_encode($images));

                echo "<div class='product' data-id='{$parentID}' data-images='{$imagesJson}' data-print='".htmlspecialchars($parent['print'])."'>";
                echo "  <div class='box'>";
                echo "      <img class='product-image' src='".htmlspecialchars($firstImage)."' alt='{$name}' />";
                echo "      <div class='overlay'>Click to View</div>";
                echo "  </div>";
                echo "  <p class='product-name'>{$name}</p>";

                if (count($variations) > 0) {
                    echo "<select class='variant-select'>";
                    echo "  <option value='{$parent['price']}' data-id='{$parentID}'>Default - \${$parent['price']}</option>";
                    foreach ($variations as $v) {
                        echo "  <option value='{$v['price']}' data-id='{$v['id']}'>".htmlspecialchars($v['name'])." - \${$v['price']}</option>";
                    }
                    echo "</select>";
                }

                echo "  <p class='product-price'>$<span class='price-num'>{$parent['price']}</span></p>";
                echo "  <button class='atc'>Add to Cart</button>";
                echo "</div>";
            }
        } catch(PDOException $e) { echo "Error: " . $e->getMessage(); }
        ?>
      </div>

      <div class="cart-box">
        <h2 class="section-title">Cart</h2>
        <div class="cart-items">
            <?php
            $total = 0;
            $host = getenv('DATABASE_HOST');
            $dbname = getenv('Products_DB');
            $user = getenv('Site_USER');
            $pass = getenv('Site_PASS');
            try {
                $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Loop through cookies to show what's REALLY in the cart
                foreach ($_COOKIE as $key => $value) {
                    if (strpos($key, 'Cart_') === 0) {
                        $parts = explode('|', $value);
                        if (count($parts) >= 3) {
                            $id = intval($parts[0]);
                            $price = floatval($parts[1]);
                            $qty = intval($parts[2]);
                            $stmt = $conn->prepare("SELECT name FROM products WHERE id = ?");
                            $stmt->execute([$id]);
                            $product = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($product) {
                                $displayName = htmlspecialchars($product['name']);
                                $total += $price * $qty;
                                echo "<div class='cart-item-row'>";
                                echo "  <span>{$displayName} (x{$qty}) - \${$price}</span>";
                                echo "  <button class='X' data-item-name='{$key}'>&times;</button>";
                                echo "</div>";
                            }
                        }
                    }
                }
            } catch(PDOException $e) { echo "Error: " . $e->getMessage(); }
            ?>
        </div>
        
        <h2 class="section-title">Total</h2>
        <p>$<span id="cart-total-display"><?php echo number_format($total, 2); ?></span></p>
        <button class="checkout-button">Checkout</button>
      </div>
    </div>
  </div>
</div>

    <section class="signup-section"></section>

    <div id="imageModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>

        <div id="gallery"></div>
        <h3>Print</h3>
        <img id="printImage" style="max-width:300px">
      </div>
    </div>

  </body>
</html>
