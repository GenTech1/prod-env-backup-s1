<?php
$a = $_POST['a'] ?? false;
if ($a == "true"){
  echo "Hi world";
} 
// 1) Setup DB variables and POST variable;
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
  if (!empty($authenticated)) { // Allow access regardless of authentication, needs to be fixed later. redirecting from adding or removing products is currently broken, so this is a temporary solution.
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
      $ostmt = $pdo->query('SELECT * FROM orders');
      $orders = $ostmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) { $orders = []; }

    try {
           $prodDb = getenv('Users_DB') ?? '';
      $pdo = new PDO("mysql:host=$host;dbname=$prodDb;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
      // Try to fetch from orders table
      $estmt = $pdo->query('SELECT * FROM contact');
      $contact = $estmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) { $contact = []; }
  }
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
    <noscript>You need to enable JavaScript to run this app.</noscript>

    <div class="tabs-container">
      <div class="tabs-header">
        <button class="tab-button active" onclick="switchTab(event, 'products-tab')">Products</button>
        <button class="tab-button" onclick="switchTab(event, 'orders-tab')">Orders</button>
        <button class="tab-button" onclick="switchTab(event, 'contact-tab')">Contact</button>
      </div>

      <!-- Products Tab -->
      <div style="text-align:center; margin:8px 0;">
        <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="addButton">Add</button></td>
      </div>
      <div id="products-tab" class="tab-content active">
        <!-- Store products data for edit modal -->
        <script>
          const productsData = <?php echo json_encode($products); ?>;
        </script>
        <?php if (!empty($products) && is_array($products)): ?>
                <table border="1">
            <thead>
              <tr>
                <th>Image</th>
                <?php foreach (array_keys($products[0]) as $h): ?>
                  <th><?php echo htmlspecialchars($h); ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $p): ?>
              <tr>
                <!-- <td><img src="<?php echo htmlspecialchars($p['image'] ?? ''); ?>" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td> -->
                 <?php
                      $images = json_decode($p['image'], true);

                    // fallback if empty
                      $firstImage = $images ? reset($images) : '';

                      $firstImage = str_replace("\\", "/", $firstImage);
                  ?>
                <td><img src="<?php echo htmlspecialchars($firstImage); ?>" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>
                <?php foreach ($p as $c): ?>

                  <td><?php echo htmlspecialchars((string)$c); ?></td>
                <?php endforeach; ?>
                <td><button type="submit" class="btn btn-edit" data-id="<?php echo htmlspecialchars($p['id']); ?>" onclick="editPop()">Edit</button></td>
                <form action="move_product.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                  <input type="hidden" name="delete_item_id" value="<?php echo htmlspecialchars($p['id']); ?>">
                <td><button type="submit" class="btn btn-remove">Remove</button></td>
                </form>
              </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="<?php echo count($products[0]) + 1; ?>">
                  <div style="text-align:center; margin:8px 0;">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="addButton">Add</button></td>
                  </div>
                </td>
              </tr>
            </tfoot>
         
        <?php else: ?>
          <p>No products to show.</p>
          <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="addButton">Add</button></td>
        <?php endif; ?>
        <!-- Adding Modal to add information -->

                    <?php

                    $host = getenv('DATABASE_HOST') ?? '';
                    $db = getenv('Products_DB') ?? '';
                    $user = getenv('Site_USER') ?? '';
                    $pass = getenv('Site_PASS') ?? '';

                    try {
                    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        die("Connection failed: " . $e->getMessage());
                    }

                    try {
                        // Using query() since we’re selecting everything
                        $stmt = $pdo->query("SELECT * FROM products");
                        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        die("Query failed: " . $e->getMessage());
                    }
                    ?>
      
                     <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h2 class="modal-title">Add Information</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            <form id="addForm" action="move_product.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Description</label>
                              <textarea name="description" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Image</label>
                              <input type="file" name="image1[]" class="form-control" multiple required>
                              <input type="file" name="image2[]" class="form-control" multiple>
                              <input type="file" name="image3[]" class="form-control" multiple>
                              <input type="file" name="image4[]" class="form-control" multiple>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Print</label>
                              <input type="file" name="print" class="form-control" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Price</label>
                              <input type="text" name="price" class="form-control" required>
                            </div>

                            <label class="form-label">Currency</label>
                            <div class="dropdown mb-3" id="currencyDropdown">
                              <button id="currencyBtn" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                USD
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-value="USD">USD</a></li>
                              </ul>
                            </div>
                            <input type="hidden" name="currency" id="currencyInput" value="USD">

                            <div class="mb-3">
                              <label class="form-label">Tags</label>
                              <textarea name="tags" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Stock</label>
                              <input type="text" name="stock" class="form-control" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Sku</label>
                              <textarea name="sku" class="form-control" required></textarea>
                            </div>

                            <label class="form-label">Visible</label>
                            <div class="dropdown mb-3" id="visibleDropdown">
                              <button id="visibleBtn" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Yes
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-value="Yes">Yes</a></li>
                                <li><a class="dropdown-item" href="#" data-value="No">No</a></li>
                              </ul>
                            </div>
                            <input type="hidden" name="visible" id="visibleInput" value="Yes">


                            <button type="submit" class="btn btn-primary" value="Submit" id="submitProduct">Submit</button>

                            </form>
                          </div>

                        </div>
                      </div>
                     </div>
                     
                     <script>
                      function editPop() {
                        const productId = event.target.getAttribute('data-id');
                        const product = productsData.find(p => p.id == productId);
                        
                        if (product) {
                          // Populate edit form with product data
                          document.getElementById('editProductId').value = product.id;
                          document.getElementById('editName').value = product.name || '';
                          document.getElementById('editDescription').value = product.description || '';
                          document.getElementById('editPrice').value = product.price || '';
                          document.getElementById('editCurrencyBtn').innerText = product.currency || 'USD';
                          document.getElementById('editCurrencyInput').value = product.currency || 'USD';
                          document.getElementById('editTags').value = product.tags || '';
                          document.getElementById('editStock').value = product.stock || '';
                          document.getElementById('editSku').value = product.sku || '';
                          document.getElementById('editVisibleBtn').innerText = product.visible || 'Yes';
                          document.getElementById('editVisibleInput').value = product.visible || 'Yes';
                          
                          // Populate current images
                          const images = JSON.parse(product.image || '{}');
                          let imageHtml = '';
                          for (let key in images) {
                            imageHtml += `<img src="${images[key]}" alt="Product Image" style="max-width: 100px; max-height: 100px; margin: 5px;">`;
                          }
                          document.getElementById('currentImages').innerHTML = imageHtml;
                          
                          // Populate current print
                          const printPath = product.print || '';
                          document.getElementById('currentPrint').innerHTML = printPath ? `<a href="${printPath}" target="_blank">View Print</a>` : 'No print file';
                          
                          // Open the edit modal
                          const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                          editModal.show();
                        }
                      }
                      
                      document.querySelectorAll('.dropdown').forEach(dropdown => {
                        const button = dropdown.querySelector('button');
                        const items = dropdown.querySelectorAll('.dropdown-item');

                        items.forEach(item =>{
                          item.addEventListener('click', function (e) {
                            e.preventDefault();

                            const value = this.getAttribute('data-value');

                            button.innerText = value;

                            if (button.id === "currencyBtn") {
                              document.getElementById("currencyInput").value = value;
                            }

                            if (button.id === "visibleBtn") {
                              document.getElementById("visibleInput").value = value;
                            }

                            if (button.id === "editCurrencyBtn") {
                              document.getElementById("editCurrencyInput").value = value;
                            }

                            if (button.id === "editVisibleBtn") {
                              document.getElementById("editVisibleInput").value = value;
                            }
                          });
                        });
                      });
                     </script>

                     <!-- Edit Modal to edit product information -->
                     <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h2 class="modal-title">Edit Product</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            <form id="editForm" action="move_product.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="edit_product_id" id="editProductId" value="">

                            <div class="mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" id="editName" class="form-control" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Description</label>
                              <textarea name="description" id="editDescription" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Current Images</label>
                              <div id="currentImages"></div>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Image (Upload new to replace)</label>
                              <input type="file" name="image1[]" class="form-control" multiple>
                              <input type="file" name="image2[]" class="form-control" multiple>
                              <input type="file" name="image3[]" class="form-control" multiple>
                              <input type="file" name="image4[]" class="form-control" multiple>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Current Print</label>
                              <div id="currentPrint"></div>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Print (Upload new to replace)</label>
                              <input type="file" name="print" class="form-control">
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Price</label>
                              <input type="text" name="price" id="editPrice" class="form-control" required>
                            </div>

                            <label class="form-label">Currency</label>
                            <div class="dropdown mb-3" id="editCurrencyDropdown">
                              <button id="editCurrencyBtn" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                USD
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-value="USD">USD</a></li>
                              </ul>
                            </div>
                            <input type="hidden" name="currency" id="editCurrencyInput" value="USD">

                            <div class="mb-3">
                              <label class="form-label">Tags</label>
                              <textarea name="tags" id="editTags" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Stock</label>
                              <input type="text" name="stock" id="editStock" class="form-control" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Sku</label>
                              <textarea name="sku" id="editSku" class="form-control" required></textarea>
                            </div>

                            <label class="form-label">Visible</label>
                            <div class="dropdown mb-3" id="editVisibleDropdown">
                              <button id="editVisibleBtn" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Yes
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-value="Yes">Yes</a></li>
                                <li><a class="dropdown-item" href="#" data-value="No">No</a></li>
                              </ul>
                            </div>
                            <input type="hidden" name="visible" id="editVisibleInput" value="Yes">

                            <button type="submit" class="btn btn-primary" value="Submit" id="submitEditProduct">Submit</button>

                            </form>
                          </div>

                        </div>
                      </div>
                     </div>

                     <!-- Where adding Modal ends -->
         </table>
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
      </div>

      <!-- Contact tab -->
      <div id="contact-tab" class="tab-content">
        <?php if (!empty($contact) && is_array($contact)): ?>
          <table border="1">
            <thead>
              <tr>
                <?php foreach (array_keys($contact[0]) as $h): ?>
                  <th><?php echo htmlspecialchars($h); ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($contact as $c): ?>
              <tr>
                <?php foreach ($c as $d): ?>
                  <td><?php echo htmlspecialchars((string)$d); ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>No contact messages to show.</p>
        <?php endif; ?>
      
      
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