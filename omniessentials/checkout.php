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
                if($product){
                  $fullProducts[] = $product;
                }
                    
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
      cardButton.addEventListener('click', async function (e) {
      e.preventDefault();
        try {
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const fname = document.getElementById('first-name').value;
    const lname = document.getElementById('last-name').value;
    const address = document.getElementById('address').value;
    const city = document.getElementById('city').value;
    const state = document.getElementById('state').value;
    const zip = document.getElementById('zip').value;
          const token = await tokenize(card);
          const response = await fetch('charge.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nonce: token, email: email, phone: phone, price: <?php echo json_encode($price); ?> })
          });

          let result = await response.json();
          if(result.success){
            document.getElementById('payment-status').textContent ='Payment successful!';

            if (<?php echo json_encode(!empty($item)); ?>) {
              var items = <?php echo json_encode($items ?? []); ?>;
             const response2 = await fetch('sendOrder.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nonce: token, email: email, phone: phone, fname: fname, lname: lname, address: address, city: city, state: state, zip: zip, image:<?php echo json_encode($product['image']); ?>, print: <?php echo json_encode($product['print']); ?>, sku: <?php echo json_encode($product['sku']); ?>, price: <?php echo json_encode($price); ?> })
          });

          let result2 = await response2.json();
          // console.log("single" + JSON.stringify(result2));
          if(result2.success){
                    window.location.href = 'success.php';
          }
            }
            else if (<?php echo json_encode(!empty($items)); ?>) {
              var items = <?php echo json_encode($items ?? []); ?>;
              for(let i = 0; i < items.length; i++){
                const response3 = await fetch('sendOrder.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nonce: token, email: email, phone: phone, fname: fname, lname: lname, address: address, city: city, state: state, zip: zip, image: items[i].image, print: items[i].print, sku: items[i].sku, price: <?php echo json_encode($price); ?> })
          });
          let result3 = await response3.json();
          // console.log("multiple" + JSON.stringify(result3));
          if(result3.success){
                    window.location.href = 'success.php';
}
                              }
          }
            } else {
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
</body>
</html>