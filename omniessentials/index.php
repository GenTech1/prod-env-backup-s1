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
    <link rel="stylesheet" href="public/css/index.css" />
  </head>
  <body>
    <script src="/public/js/script.js"></script>
          <header class="navbar">
        <div class="logo">LOGO</div>
        <nav>
          <button class="nav-btn" onclick="window.location.href='index.php'">Home</button>
          <button class="nav-btn" onclick="window.location.href='about.php'">About</button>
          <button class="nav-btn" onclick="window.location.href='shop.php'">Shop</button>
          <button class="nav-btn" onclick="window.location.href='contact.php'">Contact</button>
        </nav>
      </header>
    <noscript>You need to enable JavaScript to run this app.</noscript>

                <div class="all">
        <section class="home-section">
          <div class="hero-text">
              <h1>The Perfect<br />Gift</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla </p>
              <button class="btn"onclick="window.location.href='shop.php'">Shop Now</button>
          </div>

          <div class="hero-image box">
              <img src="" alt="Mug Icon" />
          </div>
      </section>
      
      <section class="featured">
              <h2 class="featuredName">Featured Products</h2>

              <div class="product-grid">
                <?php
                $host = getenv('DATABASE_HOST');
                $dbname = getenv('Products_DB');
                $user = getenv('Site_USER');
                $pass = getenv('Site_PASS');
                try{
                  $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM Products where tags like '%featured%'");
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result as $row){
                    echo '<div class="product">';
                    echo '<div class="product box">';
                    echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . ' Icon" />';
                    echo '</div>';
                    echo '<p name="product-name" class="product-name">' . htmlspecialchars($row['name']) . '</p>';
                    echo '<p class="product-price">$' . htmlspecialchars($row['price']) . '</p>';
                    echo '<button class="atc">Add to Cart</button>';
                    echo '</div>';
                  }
                }catch(PDOException $e){
                  echo "Connection failed: " . $e->getMessage();
                }
                  ?>
              </div>
          </section>
          
          <section class="about">
              <div class="about-left">
                  <h2>About Us</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut arcu sed velit.</p>
              </div>
              <div class="about-right">
                  <button class="btn"onclick="window.location.href='about.php'">Learn More</button>
              </div>
          </section>

      <section class="signup-section">

          </section>
      </div>
  </body>
</html>
