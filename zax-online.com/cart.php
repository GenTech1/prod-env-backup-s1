<!DOCTYPE html>
<html>
<head>
<title>Cart Page</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./images/favicon-32x32.png">
  <link rel="stylesheet" type="text/css" href="./style.css">
    <style>
        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
            display:flex;
            /* flex-direction:column; */
            gap:1rem;
            
            
        }
        .product img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }
        .remove-btn {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .cart-product{
            color: #000;
            display:flex;
           flex-direction:column;
           gap:1rem;
        }
          #checkout-button{
            background-color:var(--yellow);
            padding:1rem 3.5rem;
            outline:none;
            
        }
        #checkout-button:hover{
            background-color:var(--blue);
            cursor: pointer;
           
           color:#fff;
       
        }
        .checkout-btn{
            display:flex;
            justify-content:flex-end;
            align-items: flex-end;
            flex-direction:column;
            /* margin-right:3rem; */
            gap:1rem;
            font-size:2rem;

        }
        .checkout-btn p{
            font-size:2rem;
        }
    </style>
        <script>
        function removeProduct(productId) {
            // Send an AJAX request to remove the product from the cart database
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // Reload the page to update the cart
                    location.reload();
                }
            };
            xhttp.open("GET", "remove_product.php?id=" + productId, true);
            xhttp.send();
        }
    </script>
  <script src="https://js.stripe.com/v3/"></script>

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
               <!-- <li> <a href="./customise.php">Customise</a></li>-->
                <li> <a href="./cart.php"> Cart</a></li>

            </ul>
        </div>

        <div  id="nav-icon1">
            <span></span>
            <span></span>
            <span></span>
          </div>
    </nav>

  <hr>

</div>




</header>
    <?php
    // Database connection credentials
    $servername = "localhost";
    $username = "root";
    $password = "gen123";
    $database = "cart";
      $totalPrice =0;
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to retrieve the IDs and quantities from the cart table
    $sql = "SELECT id FROM cart_products";

    // Execute the SQL query
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Create an array to store the IDs
        $ids = array();

        // Initialize total price variable
        $totalPrice = 0;

        // Loop through the results and store the IDs in the array
        while ($row = $result->fetch_assoc()) {
            $ids[] = $row['id'];
        }

        // Iterate over the IDs
        foreach ($ids as $id) {
            // Retrieve the product details for each ID
            // Database connection credentials
            $servername = "localhost";
            $username = "root";
            $password = "gen123";
            $database = "shop_page";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare the SQL query to retrieve product details by ID
            $sql = "SELECT id, name, price,  image FROM shop_products WHERE id = '$id'";

            // Execute the SQL query
            $result = $conn->query($sql);

            // Check if the query returned any rows
            if ($result->num_rows > 0) {
                // Fetch the product details
                $row = $result->fetch_assoc();

                // Output the product details
                ?>
                <div class="container">

                <div class="product ">
                    <div class="cart-product">

                    <img src="<?php echo $row['image']; ?>" alt="Product Image">
                    <p>Product Name: <?php echo $row['name']; ?></p>
                    <p>Price: $<?php echo $row['price']; ?></p>
                
                    </div>

                    <button class="remove-btn" onclick="removeProduct('<?php echo $row['id']; ?>')">Remove</button>
                </div>
                
                </div>

                <?php

                // Add the price to the total
                global $totalPrice;
                $totalPrice += $row['price'];
            } else {
                // No product found with the given ID
                echo "Product not found.";
            }

            // Close the database connection
            $conn->close();
        }

        // Display the total price
       

        

    } else {
        // No IDs found in the cart
        echo "Cart is empty.";
    }

    // Close the database connection
    $servername = "localhost";
    $username = "root";
    $password = "gen123";
    $database = "cart";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare the SQL query to check if a row already exists in the cart_total table
    $checkSql = "SELECT * FROM cart_total LIMIT 1";
    
    // Execute the SQL query
    $checkResult = $conn->query($checkSql);
    
    // Check if a row exists in the cart_total table
    if ($checkResult->num_rows > 0) {
        // A row exists, so update the totalPrice
        $updateSql = "UPDATE cart_total SET totalPrice = '$totalPrice'";
    
        // Execute the SQL query
        if ($conn->query($updateSql) === true) {
            // Update successful
            echo ".";
        } else {
            // Error occurred while updating
            echo "Error: " . $updateSql . "<br>" . $conn->error;
        }
    } else {
        // No row exists, so insert a new row with the totalPrice
        $insertSql = "INSERT INTO cart_total (totalPrice) VALUES ('$totalPrice')";
    
        // Execute the SQL query
        if ($conn->query($insertSql) === true) {
            // Insertion successful
            echo "";
        } else {
            // Error occurred while inserting
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
    ?>
    
   <div class="container">

    <div class="checkout-btn">

<?php echo "<p>Total Price: $" . $totalPrice . "</p>";    ?>
<button id="checkout-button">Checkout</button>

</div>
</div>

    <script>
  document.getElementById('checkout-button').addEventListener('click', function() {
    // Create a new checkout session
    fetch('http://zax-online.com/pay.php', {
      method: 'POST'
      
    })
    .then(function(response) {
	console.log(response.json());
      return response.json();
	    
})
    .then(function(session) {

      // Redirect to Stripe Checkout
      var stripe = Stripe('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');
      stripe.redirectToCheckout({
	
        sessionId: session.sessionId
      });
    })
    .catch(function(error) {
  console.error(error); 
 });
  });
</script>
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

