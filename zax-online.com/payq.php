<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/favicon-32x32.png">

    <!-- fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="">


    <title>Zax- Official Site</title>

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

</head>

<body>
    <div class="line"></div>

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
                        <!-- <li> <a href="./cart.php"> Cart</a></li>-->

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
   <form id"payment-form">
<div id="payment-element"> </div>
<button>Pay</button>
<div id="error-messages"></div>
</form>
                    

    </section>

    <footer class="footer">
        <p>123 Main Street, City, Country</p>
        <p>Email: info@example.com</p>
        <div class="social-links">
            <a href="#" target="_blank">Facebook</a>
            <a href="#" target="_blank">Twitter</a>
            <a href="#" target="_blank">Instagram</a>
        </div>
        <p>
            <a href="./term-of-service.php">Terms of Service</a> |
            <a href="./privacy.php">Privacy Policy</a>
        </p>
        <p>&copy; 2023 Zax-Online. All rights reserved.</p>

    </footer>




    
  <script src="https://js.sripe.com/v3/"></script>
<script>
const stripe = Stripr('<?= pk_test_51MDpFCDn3WocbosRYieOaZITfj3jZWaEWVxU3cY7DQCyGX8oLRA1et2mhgUcrTWfpahhG477kGRZBl8wHUG0ge5R00uYj1zWAd ?>')
const element = stripe.elements({
clientSecret: '<?= $paymentIntent->client_secret ?>'
])
const paymentElement = elements.create('payment')
paymentElement.mount(#payment-element')
</script>
<?php
$servername = "localhost";
$username = "root";
$password = "gen123";
$dbname = "cart";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cart_total";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Access data from the row
         $price = $row["totalPrice"];

    }
} else {
    $price = 0; // Set a default price if no record is found
}
$conn->close();
require_once('vendor/stripe/stripe-php/init.php');
//$stripe = new \Stripe\StripeClient('sk_test_51MDpFCDn3WocbosRpeWXuXB4ttpjdzOS6Td0ScT9RJngt3hSaOmd8pEK6ChbcTSs0rPCiUjXgZBG8qi9RrrUwyiL005W2RBrkz');
$stripe->paymentIntents->create([
'amount' => 2000,
'currency' => 'usd',
'automatic_payment_methods' =>[
'enabled' => true,
],
]);

echo $payment_intent->client_secret;
?>

</body>

</html>
