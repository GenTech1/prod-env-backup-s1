<!DOCTYPE html>
<html>
  <!--header-->
  <head id="header">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="blackback">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
    <a id="searchButton" class="fa fa-search"></a>
    <a href="signIn.php" class="fa fa-user"></a>
    <a href="cart.php" class="fa fa-shopping-cart"></a>
    </nav>
    <hr/>
    </div>
  </head>

  <body>

      <svg style="display:none" width="30%" height="50%" id="prompt" viewBox="0 0 60 50" style="border:1px solid black">
    <rect width="100%" height="100%" fill="white"></rect>
  </svg>

<div style="display:none" id="promptText">
  <div id="sms">Get 15% Off Your First Order — Sign Up for Email & SMS Alerts Today!</div>

  <br/><br/><br/><br/><br/><br/><br/>
  <h1>Subscribe Now</h1>

  <form action="/subscribe_phone.php" method="POST">
    <input type="tel" id="phoneInput" name="phone" placeholder="Phone" required><br/><br/>
    <button type="button" id="smsCancel">Cancel</button>
    <button id="smsSubmit" type="submit">Submit</button>
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
    $stmt = $pdo->prepare("SELECT * FROM Products WHERE tags LIKE ?");
    $stmt->execute(['%Truly Rareland Collection%']);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
try {
    $stmt = $pdo->prepare("SELECT * FROM Products WHERE tags LIKE ?");
    $stmt->execute(['%Event%']);
    $productsEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <?php foreach ($productsEvents as $product): ?>
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
      
    <script>
      document.addEventListener("DOMContentLoaded", function() {
      let smsSubmit = document.getElementById("smsSubmit");
      if (smsSubmit) {
        smsSubmit.addEventListener("click", (event) => {
          let phoneRaw = document.getElementById("phoneInput").value.trim();
          let digits = phoneRaw.replace(/\D/g, "");
          // require exactly 10 digits (change to 11 if you expect country code)
          if (digits.length !== 10) {
            event.preventDefault();
            alert("'" + phoneRaw + "' is not a valid phone number. Please enter a valid 10-digit phone number.");
          }
        });
      }
      });
      </script>
  </body>
  <footer>
    <div class="blackback">
    <hr/>
    <div id="icons">

    <nav id="socials">
      <a data-social="Instagram" style="--accent-color: #fe107c" href="https://www.instagram.com/tru.lyrare/">
        <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077"/></svg>
      </a>
        <a data-social="FaceBook" style="--accent-color: #106bff" href="https://www.facebook.com/people/Truly-Rare-Customs/61566452542361/">
        <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z"/></svg>
      </a>
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
      <input id="emailInput" type="email" name="email" placeholder="Email*" required/>
      <input id="emailSubmit" type="submit" value="Sign Up"/>
    </br>
    </br>
    </br>
    </br>
    </form>
    </div>
  </div>
  <script src="script.js?v=0.6"></script>
  </footer>
</html>
