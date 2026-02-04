<?php
// 1) Setup DB variables and POST variable
$host = getenv('DATABASE_HOST') ?? '';
$db = getenv('Users_DB') ?? '';
$user = getenv('Site_USER') ?? '';
$pass = getenv('Site_PASS') ?? '';
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $email === '') { header('Location: login.php'); exit; }
//2) DB query
try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
  $stmt = $pdo->prepare('SELECT email, password FROM users WHERE email = ? LIMIT 1');
  $stmt->execute([$email]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // 3) Compare and respond
  if ($row['email'] === $email && password_verify($password, $row['password'])) {
    $authenticated = true;
  } else {
    header('Location: loginfail.php');
  }
} catch (Exception $e) { echo $e->getMessage(); }

  // If authenticated, load products and orders for display
  if (!empty($authenticated)) {
    try {
      $prodDb = getenv('Products_DB') ?? '';
        $pdo = new PDO("mysql:host=$host;dbname=$prodDb;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
      $pstmt = $pdo->query('SELECT * FROM products');
      $products = $pstmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) { $products = []; }
    
    // Load orders if available
    try {
           $prodDb = getenv('Products_DB') ?? '';
      $pdo = new PDO("mysql:host=$host;dbname=$prodDb;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
      // Try to fetch from orders table
      $ostmt = $pdo->query('SELECT * FROM orders ORDER BY id DESC LIMIT 100');
      $orders = $ostmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) { $orders = []; }
  }
?> 
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
    <link rel="stylesheet" href="public/css/owner.css" />
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
    <noscript>You need to enable JavaScript to run this app.</noscript>

    <div class="tabs-container">
      <div class="tabs-header">
        <button class="tab-button active" onclick="switchTab(event, 'products-tab')">Products</button>
        <button class="tab-button" onclick="switchTab(event, 'orders-tab')">Orders</button>
      </div>

      <!-- Products Tab -->
      <div id="products-tab" class="tab-content active">
        <?php if (!empty($products) && is_array($products)): ?>
          <table border="1">
            <thead>
              <tr>
                <?php foreach (array_keys($products[0]) as $h): ?>
                  <th><?php echo htmlspecialchars($h); ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $p): ?>
              <tr>
                <?php foreach ($p as $c): ?>
                  <td><?php echo htmlspecialchars((string)$c); ?></td>
                <?php endforeach; ?>
                <td><button type="button">Remove</button></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="<?php echo count($products[0]) + 1; ?>">
                  <div style="text-align:center; margin:8px 0;">
                    <button type="button" onclick="window.location.href='owner_create_product.php?action=add'">Add</button>
                  </div>
                </td>
              </tr>
            </tfoot>
          </table>
        <?php else: ?>
          <p>No products to show.</p>
        <?php endif; ?>
      </div>

      <!-- Orders Tab -->
      <div id="orders-tab" class="tab-content">
        <?php if (!empty($orders) && is_array($orders)): ?>
          <table border="1">
            <thead>
              <tr>
                <?php foreach (array_keys($orders[0]) as $h): ?>
                  <th><?php echo htmlspecialchars($h); ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $o): ?>
              <tr>
                <?php foreach ($o as $c): ?>
                  <td><?php echo htmlspecialchars((string)$c); ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>No orders to show.</p>
        <?php endif; ?>
      </div>
    </div>
        <br /><br /><br /><br />
  <section class="signup-section">
      </section>
      </div>
      
      <script>
        function switchTab(event, tabName) {
          // Hide all tab contents
          const tabContents = document.querySelectorAll('.tab-content');
          tabContents.forEach(tab => tab.classList.remove('active'));
          
          // Remove active class from all buttons
          const tabButtons = document.querySelectorAll('.tab-button');
          tabButtons.forEach(btn => btn.classList.remove('active'));
          
          // Show the selected tab
          document.getElementById(tabName).classList.add('active');
          
          // Add active class to clicked button
          event.target.classList.add('active');
        }
      </script>
  </body>
</html>