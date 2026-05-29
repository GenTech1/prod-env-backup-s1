<?php
$appId = getenv('Square_App');
$locId = getenv('Square_Location_ID');
$price = 100; // Default price in cents

$cartItems = [];
$host = getenv('DATABASE_HOST');
$dbname = getenv('Products_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');
try {
    $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach ($_COOKIE as $key => $value) {
        if (strpos($key, 'Cart_') === 0) {
            $parts = explode('|', $value);
            if (count($parts) >= 3) {
                $id = intval($parts[0]);
                $price = floatval($parts[1]);
                $qty = intval($parts[2]);
                $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
                $stmt->execute([$id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($product) {
                    for ($i = 0; $i < $qty; $i++) {
                        $fullProducts[] = $product;
                    }
                }
            }
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
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
      
    <h1>Buy Now</h1>

<form id="payment-form">
  <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
  <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
  <input type="email" id="email" name="email" placeholder="Email" required>

  <div style="position: relative;">
    <input type="text" id="address" name="address" placeholder="Shipping Address" required autocomplete="off">
    <div id="address-results" style="position: absolute; width: 100%; background: white; border: 1px solid #ccc; z-index: 1000; display: none; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.1);"></div>
  </div>

  <div style="display: flex; gap: 10px; margin-top: 10px;">
    <input type="text" id="city" name="city" placeholder="City" required style="flex: 2;">
    
    <select id="state" name="state" required style="flex: 1;">
      <option value="" disabled selected>State</option>
      <option value="AL">AL</option><option value="AK">AK</option><option value="AZ">AZ</option>
      <option value="AR">AR</option><option value="CA">CA</option><option value="CO">CO</option>
      <option value="CT">CT</option><option value="DE">DE</option><option value="FL">FL</option>
      <option value="GA">GA</option><option value="HI">HI</option><option value="ID">ID</option>
      <option value="IL">IL</option><option value="IN">IN</option><option value="IA">IA</option>
      <option value="KS">KS</option><option value="KY">KY</option><option value="LA">LA</option>
      <option value="ME">ME</option><option value="MD">MD</option><option value="MA">MA</option>
      <option value="MI">MI</option><option value="MN">MN</option><option value="MS">MS</option>
      <option value="MO">MO</option><option value="MT">MT</option><option value="NE">NE</option>
      <option value="NV">NV</option><option value="NH">NH</option><option value="NJ">NJ</option>
      <option value="NM">NM</option><option value="NY">NY</option><option value="NC">NC</option>
      <option value="ND">ND</option><option value="OH">OH</option><option value="OK">OK</option>
      <option value="OR">OR</option><option value="PA">PA</option><option value="RI">RI</option>
      <option value="SC">SC</option><option value="SD">SD</option><option value="TN">TN</option>
      <option value="TX">TX</option><option value="UT">UT</option><option value="VT">VT</option>
      <option value="VA">VA</option><option value="WA">WA</option><option value="WV">WV</option>
      <option value="WI">WI</option><option value="WY">WY</option>
    </select>
  </div>

  <input type="text" id="zip" name="zip" placeholder="Zip Code" required style="margin-top: 10px;">
  <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>

  <div id="card-container"></div>
  <button type="submit" id="card-button">Pay Now</button>
  <div id="payment-status"></div>
</form>


<p></p>







  </body></html>
<script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<script>
document.addEventListener("DOMContentLoaded", async () => {

  const applicationId = "<?php echo htmlspecialchars($appId);?>";
  const locationId = "<?php echo htmlspecialchars($locId);?>";

  if (!window.Square) {
    console.error("❌ Square JS SDK not loaded.");
    document.getElementById("payment-status").textContent = "Error: Square SDK not loaded.";
    return;
  }

  // Initialize card **immediately**
  const payments = Square.payments(applicationId, locationId);
  const card = await payments.card();
  await card.attach('#card-container');

  async function tokenize(paymentMethod) {
    const result = await paymentMethod.tokenize();
    if (result.status === 'OK') return result.token;
    throw new Error(result.errors ? result.errors[0].message : 'Tokenization failed');
  }

  document.getElementById('card-button').addEventListener('click', async (e) => {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const fname = document.getElementById('first-name').value;
    const lname = document.getElementById('last-name').value;
    const address = document.getElementById('address').value;
    const city = document.getElementById('city').value;
    const state = document.getElementById('state').value;
    const zip = document.getElementById('zip').value;

    try {
      // ✅ First create order in your DB
      const orderResponse = await fetch('sendOrder.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({email, phone, fname, lname, address, city, state, zip,price: <?php echo json_encode($price); ?> })
      });
      const orderResult = await orderResponse.json();
      if (!orderResult.success) {
        document.getElementById('payment-status').textContent = "Order creation failed.";
        console.error("Order API error:", orderResult);
        return;
      }

      // ✅ Then tokenize and charge
      const token = await tokenize(card);
      const chargeResponse = await fetch('charge.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nonce: token, email, phone, price: <?php echo json_encode($price); ?> })
      });
      const chargeResult = await chargeResponse.json();
      if (chargeResult.success) {
        document.getElementById('payment-status').textContent = 'Payment successful!';
        window.location.href = 'success.php';
      } else {
        document.getElementById('payment-status').textContent = 'Payment failed: ' + (chargeResult.error || 'Unknown error');
      }
    } catch (err) {
      console.error(err);
      document.getElementById('payment-status').textContent = 'Error: ' + err.message;
    }
  });
});
</script>
</body>
</html>