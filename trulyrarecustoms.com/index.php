<!DOCTYPE html>
<html>
  <!--header-->
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="blackback">
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="index.css">
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
    <a id="searchButton" href="#" class="fa fa-search"></a>
    <a href="signIn.php" class="fa fa-user"></a>
    <a href="cart.php" class="fa fa-shopping-cart"></a>
    </nav>
    <hr/>
    </div>
  </head>
  <script src="script.js?v=0.6"></script>
  <body>

       <svg style="display:none" width="30%" height="50%" id="prompt" viewBox="0 0 60 50" style="border:1px solid black">
    <rect width="100%" height="100%" fill="white"></rect>
  </svg>

<div style="display:none" id="promptText">
  <div id="sms">Get 15% Off Your First Order — Sign Up for Email & SMS Alerts Today!</div>

  <br/><br/><br/><br/><br/><br/><br/>
  <h1>Subscribe Now</h1>

  <form action="/subscribe_phone.php" method="POST">
    <input type="tel" name="phone" placeholder="Phone" required><br/><br/>
    <button type="button" id="smsCancel">Cancel</button>
    <button type="submit">Submit</button>
  </form>
</div>

    
    <!--Caroucel-->
    <main>

<div class="full-banner-wrapper">
  <div class="full-banner-track" id="bannerTrack">
    <svg class="full-slide"><rect width="100%" height="100%" fill="palevioletred"/></svg>
    <svg class="full-slide"><rect width="100%" height="100%" fill="lightblue"/></svg>
    <svg class="full-slide"><rect width="100%" height="100%" fill="palegreen"/></svg>
  </div>
</div>

<div id="arrows">
<button href="#" id="previousArrow" class="fa fa-chevron-left"></button> <button href="#" id="nextArrow" class="fa fa-chevron-right"></button>
</div>
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
    $stmt = $pdo->query("SELECT * FROM Products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>


      <div class="Caroucel">

      </div>
      <!--Store Caroucels-->
<div class="storeCaroucel">
<h1>Truly Rareland Collection</h1>
<div class="product">
    <?php foreach ($products as $product): ?>
      <div class="productSetup">
        <a href="product.php?sku=<?php echo urlencode($product['sku']); ?>">
          <img class="productImages" src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
        </a>
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
      </div>
    <?php endforeach; ?>
</div>
</div>

</div>
<div id="servicesBanner">
<svg id="bannerSVG">
  <rect id="bannerRect"  fill="palevioletred"></rect>
</svg>
</div>
<div class="storeCaroucel">
<h1>Events</h1>
<div class="product">
    <?php foreach ($products as $product): ?>
      <div class="productSetup">
        <a href="product.php?sku=<?php echo urlencode($product['sku']); ?>">
          <img class="productImages" src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
        </a>
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
      </div>
    <?php endforeach; ?>
</div>
</div>



</div>
</div>
  <h1>Customer Reviews</h1>
<div id="reviews">
<svg class="reviewsSVG">
  <rect class="reviewsRect" reviewsRect fill="palevioletred"></rect>
</svg>
<svg class="reviewsSVG">
  <rect class="reviewsRect" reviewsRect fill="palevioletred"></rect>
</svg>
<svg class="reviewsSVG">
  <rect class="reviewsRect" reviewsRect fill="palevioletred"></rect>
</svg>
</div>
<br />
<br />




    </main>
    <script src="index.js"></script>
  </body>
  <footer>
    <div class="blackback"
    <hr/>
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
    <form id="marketingForm" action="/subscribe_email.php" method="POST">
  <input type="email" name="email" placeholder="Email" required>
  <input type="submit" value="Sign Up">
</form>

  </div>
  </footer>
</html>
