<?php
$appId = getenv('Square_App');
$locId = getenv('Square_Location_ID');
$price = 100; // Default price in cents
if (isset($_GET['items'])) {
    $items = explode(',', $_GET['items']);

     $host = getenv('DATABASE_HOST');
                $dbname = getenv('Products_DB');
                $user = getenv('Site_USER');
                $pass = getenv('Site_PASS');
        for ($i = 0; $i < count($items); $i++) {
                        
                try{
                  $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM Products where name like ?");
                  $stmt->execute([$items[$i]]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                }catch(PDOException $e){
                  echo "Connection failed: " . $e->getMessage();
                }
            }
}else if (isset($_GET['item'])) {
  $item = $_GET['item'];
        // echo $item . "<br>";
                $host = getenv('DATABASE_HOST');
                $dbname = getenv('Products_DB');
                $user = getenv('Site_USER');
                $pass = getenv('Site_PASS');
                try{
                  $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM Products where name like ?");
                  $stmt->execute([$item]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                    // echo $product['name'] . "<br>";

                }catch(PDOException $e){
                  echo "Connection failed: " . $e->getMessage();
                }
}

    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Checkout| Omni Essentials</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Page not found" />

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/App.css" />
    <link rel="stylesheet" href="public/css/checkout.css" />
  </head>

  <body>
    <header class="navbar">
      <div class="logo">LOGO</div>
        <nav>
          <button class="nav-btn" onclick="window.location.href='index.php'">Home</button>
          <button class="nav-btn" onclick="window.location.href='about.php'">About</button>
          <button class="nav-btn" onclick="window.location.href='shop.php'">Shop</button>
          <button class="nav-btn" onclick="window.location.href='contact.php'">Contact</button>
          <button class="nav-btn" onclick="window.location.href='login.php'">Login</button>
        </nav>
    </header>
  <body>
    <h1>Buy Now</h1>

<form id="payment-form">
  <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
  <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
  <input type="email" id="email" name="email" placeholder="Email" required>
  <input type="text" id="address" name="address" placeholder="Address" required>
  <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>

  <div id="card-container"></div>

  <button type="submit" id="card-button">Pay Now</button>
  <div id="payment-status"></div>
</form>


<p></p>







    </main>
  </body></html>
<script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<script>

  const payment_form = document.getElementById("payment-form");
  document.addEventListener("DOMContentLoaded", async () => {
    // alert("started Square JS SDK");
    const applicationId = "<?php echo htmlspecialchars($appId);?>";
    const locationId = "<?php echo htmlspecialchars($locId);?>";
    //  alert("App ID: " + applicationId + " Location ID: " + locationId);
    async function initializeCard(payments) {
      // alert("initializing card");
      const card = await payments.card();
      await card.attach('#card-container');
      return card;
    }
    async function tokenize(paymentMethod) {
      // alert("tokenizing payment method");
      const result = await paymentMethod.tokenize();
      if (result.status === 'OK') {
        return result.token;
      } else {
        throw new Error(result.errors ? result.errors[0].message : 'Tokenization failed');
      }
    }
    async function main() {
      // alert("starting main payment function");
      const payments = Square.payments(applicationId, locationId);
      const card = await initializeCard(payments);

      const cardButton = document.getElementById('card-button');
      cardButton.addEventListener('click', async function () {
      event.preventDefault()
        try {
          const email = document.getElementById('email').value;
          const phone = document.getElementById('phone').value;
          const fname = document.getElementById('first-name').value;
          const lname = document.getElementById('last-name').value;
          const token = await tokenize(card);
          const response = await fetch('charge.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nonce: token, email: email, phone: phone, price: <?php echo json_encode($price); ?> })
          });

          let result = await response.json();
          if(result.success){
            document.getElementById('payment-status').textContent ='Payment successful!';

             const response = await fetch('sendOrder.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nonce: token, email: email, phone: phone, fname: fname, lname: lname, image:<?php echo json_encode($product['image']); ?>, print: <?php echo json_encode($product['print']); ?>, sku: <?php echo json_encode($product['sku']); ?> })
          });

          let result2 = await response.json();
          if(result2.success){
                    window.location.href = 'success.php';
}
                              }else{
                                document.getElementById('payment-status').textContent = 'Payment failed: ' + result.message;
                              }
                            } catch (err) {
                              document.getElementById('payment-status').textContent = 'Error: ' + err.message;
                            }
                          });
                        }
              

    main();
  });
  
  if (!window.Square) {
    console.error("❌ Square JS SDK not loaded.");
    document.getElementById("payment-status").textContent = "Error: Square SDK not loaded.";

  }
</script>