<?php
$sku = $_GET['sku'] ?? null;
if (!$sku) {
	die("Missing SKU");
}

$host = getenv('DATABASE_HOST');
$dbname = getenv('Products_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');
$appId = getenv('SQUARE_APP_ID');
$locId = getenv('SQUARE_LOCATION_ID');

try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
die("Connection failed " .$e->getMessage());
}

    $stmt = $pdo->prepare("SELECT name, price FROM Products WHERE sku = ?");
    $stmt->execute([$sku]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);



    if (!$product) {
        echo "Product not found.";
        exit;
    }

?>

<!DOCTYPE html>
<html>
  <!--header-->
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="blackback">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="signIn.css">
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
  <script src="script.js"></script>
  <body>
    <!--Caroucel-->
    <main>
<h1>Buy Now</h1>

<form id="payment-form">
  <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
  <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
  <input type="email" id="email" name="email" placeholder="Email" required>
  <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>

  <div id="card-container"></div>

  <button id="card-button">Pay Now</button>
  <div id="payment-status"></div>
</form>


<p></p>







    </main>
<script type="text/javascript" src="https://web.squarecdn.com/v1/square.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", async () => {
    const applicationId = "<?php echo htmlspecialchars($appId);?>";
    const locationId = "<?php echo htmlspecialchars($locId);?>";

    async function initializeCard(payments) {
      const card = await payments.card();
      await card.attach('#card-container');
      return card;
    }

    async function tokenize(paymentMethod) {
      const result = await paymentMethod.tokenize();
      if (result.status === 'OK') {
        return result.token;
      } else {
        throw new Error(result.errors ? result.errors[0].message : 'Tokenization failed');
      }
    }

    async function main() {
      const payments = Square.payments(applicationId, locationId);
      const card = await initializeCard(payments);

      const cardButton = document.getElementById('card-button');
      cardButton.addEventListener('click', async function () {
        try {
          const token = await tokenize(card);
          const response = await fetch('charge.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nonce: token, sku: getSkuFromURL() })
          });

          const result = await response.json();
          document.getElementById('payment-status').textContent = result.success
            ? 'Payment successful!'
            : 'Payment failed: ' + result.message;
        } catch (err) {
          document.getElementById('payment-status').textContent = 'Error: ' + err.message;
        }
      });
    }

    function getSkuFromURL() {
      const params = new URLSearchParams(window.location.search);
      return params.get('sku');
    }

    main();
  });
</script>

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
</html>
