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
    <script src="/public/js/script.js"></script>
    <script src="/public/js/shop.js"></script>
    <header class="navbar">
      <div class="logo">LOGO</div>
      <nav>
        <button class="nav-btn" onclick="window.location.href='index.php'">
          Home
        </button>
        <button class="nav-btn" onclick="window.location.href='about.php'">
          About
        </button>
        <button class="nav-btn" onclick="window.location.href='shop.php'">
          Shop
        </button>
        <button class="nav-btn" onclick="window.location.href='contact.php'">
          Contact
        </button>
      </nav>
    </header>

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
                try{
                  $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM Products");
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result as $row){
                    echo '<div class="product">';
                    echo '<div class="product box">';
                    echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . ' Icon" />';
                    echo '<p class="product-name">' . htmlspecialchars($row['name']) . '</p>';
                    echo '<p class="product-price">$' . htmlspecialchars($row['price']) . '</p>';
                    echo '</div>';
                    echo '<p class="product-name">' . htmlspecialchars($row['name']) . '</p>';
                    echo '<p class="product-price">$' . htmlspecialchars($row['price']) . '</p>';
                    echo '<button class="atc" >Add to Cart</button>';
                    echo '</div>';
                  }
                }catch(PDOException $e){
                  echo "Connection failed: " . $e->getMessage();
                }
                  ?>
          </div>

          <div class="cart-box">
            <h2 class="section-title">Cart</h2>

            <div class="cart-lines">
              <div class="cart-line"></div>
              <div class="cart-line short"></div>
            </div>


                <?php
                $total = 0;
                  foreach ($_COOKIE as $name => $value){
                  $cleared_name = str_replace('Cart_', '', $name);
                  $cleared_name = str_replace('_', ' ', $cleared_name);
                  $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM Products where name = ?");
                  $stmt->execute([$cleared_name]);
                  $product = $stmt->fetch(PDO::FETCH_ASSOC);
	                  if(strpos($name, 'Cart_')===0){
                      echo $cleared_name .": ".$product['price'] ."  <button class='buy' data-item-name='$name'> Buy </button><button class='X' data-item-name='$name'> X </button> <br>";
                      $total += $product['price'];
                    }
                  }
                ?>
                <h2 class="section-title">Total</h2>
                <p>$<?php echo $total; ?></p>
            <div class="cart-lines">
              <div class="cart-line"></div>
              <div class="cart-line short"></div>
            </div>
                  
            <button class="checkout-button">Checkout</button>
          </div>
        </div>
      </div>
    </div>

    <section class="signup-section"></section>
  </body>
</html>
