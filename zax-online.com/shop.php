<!DOCTYPE html>
<html>
<head>
    <title>Shop Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/favicon-32x32.png">

    <!-- fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./style.css">
    <style>
    #shop {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
    }

    .card {
      flex: 1 1 300px;
      max-width: 300px;
      height: auto;
      padding: 20px;
      border: 1px solid #ccc;
      /* border-radius: 5px; */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .card img {
      max-width: 100%;
      max-height: 150px;
      margin-bottom: 20px;
    }

    .card h2 {
      font-size: 1.8rem;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 16px;
      margin-bottom: 20px;
    }

    .card button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      background-color: var(--blue);
      color: #fff;
      border: none;
      /* border-radius: 5px; */
      cursor: pointer;
      border: 1px solid var(--blue);
    }

    h1 {
      text-align: center;
      font-size: 24px;
      margin-top: 20px;
    }

    .card button:hover {
      background-color: var(--white);
      color: #000;

    }

    @media only screen and (max-width: 768px) {
      .card {
        flex-basis: calc(50% - 20px);
        max-width: calc(50% - 20px);
      }
    }

    @media only screen and (max-width: 480px) {
      .card {
        flex-basis: 100%;
        max-width: 100%;
      }
    }



    #myPopup {
      display: none;
      position: absolute;
      top: 12%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 10px;
      background-color: #ffc107;
      border: 1px solid #000000;
      border-radius: 2px;
      color: #000;
    }

    .show {
      display: block;
      animation: fadeOut 1s forwards;
    }

    @keyframes fadeOut {
      0% {
        opacity: 1;
      }

      100% {
        opacity: 0;
      }
    }
  </style>
    <script>
        function addToCart(productId) {
            // Send the product ID to the server-side PHP script to save in the cart database
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Show the response from the server
                }
            };
            var data = "product_id=" + productId;
            xhr.send(data);
        }
    </script>
</head>
<body>

<header class=" header gradient">

<div class="container">

  <nav>
    <div class="logo">
      <a href="./index.php">
        <img src="./images/zax-logo.png" alt="">
      </a>
    </div>


    <div class="nav-items ">


      <ul class="items">

        <li>
          <a href="./index.php">Home</a>
        </li>
        <li> <a href="./shop.php">Shop </a></li>
       <!--<li> <a href="./customise.php">Customise</a></li>-->
       <!--  <li> <a href="./cart.php"> Cart</a></li>-->


      </ul>
    </div>

    <div id="nav-icon1">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

  <hr>

</div>




</header>

<div id="shop">
    <?php
        $servername = getenv("HOST");
    $username = getenv("Site_USER");
    $password = getenv("Site_PASS");
    $database = getenv("Products_DB");
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch products from the database
    $sql = "SELECT id, name, image, description, price FROM shop_products";
    $result = $conn->query($sql);

    // Display the products
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $image = $row['image'];
            $description = $row['description'];
            $price = $row['price'];
    ?>

    <div class="card">
        <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
        <h3><?php echo $name; ?></h3>
        <p><?php echo $description; ?></p>
        <p>Price:$<?php echo $price; ?></p>
	<button onclick="addToCart(<?php echo $id; ?>)">Add to Cart</button> <button onclick="Buy(<?php echo $id; ?>)">Buy</button>
    </div>

    <?php
        }
    } else {
        echo "No products found.";
    }

    // Close the database connection
    $conn->close();
    ?>

</div>

<footer class="footer">
        <!--<p>123 Main Street, City, Country</p>
        <p>Email: info@example.com</p>-->
        <div class="social-links">
            <a href="https://www.facebook.com/people/Zax/100088852040825/?mibextid=LQQJ4d">Facebook</a>
            <a href="">Twitter</a>
            <a href="https://www.instagram.com/zax.tech/?igshid=MzRlODBiNWFlZA%3D%3D">Instagram</a>
        </div>
        <p>
            <a href="./term-of-service.php">Terms of Service</a> |
            <a href="./privacy.php">Privacy Policy</a>
        </p>
        <p>&copy; 2024 Zax-Online. All rights reserved.</p>

    </footer>

<script src="./app.js"></script>

</body>
</html>

