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

  // If authenticated, load products for display
  if (!empty($authenticated)) {
    try {
      $prodDb = getenv('Products_DB') ?? '';
        $pdo = new PDO("mysql:host=$host;dbname=$prodDb;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
      $pstmt = $pdo->query('SELECT * FROM products');
      $products = $pstmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) { $products = []; }
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
        <br /><br /><br /><br />
  <section class="signup-section">
      </section>
      </div>
  </body>
</html>