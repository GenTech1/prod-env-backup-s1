




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

\Stripe\Stripe::setApiKey('sk_test_51MDpFCDn3WocbosRpeWXuXB4ttpjdzOS6Td0ScT9RJngt3hSaOmd8pEK6ChbcTSs0rPCiUjXgZBG8qi9RrrUwyiL005W2RBrkz');

// Create a new Checkout Session

$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'unit_amount' => $price * 100, // Convert price to cents
      'product_data' => [
        'name' => 'Your Product Name',
        'description' => 'Your Product Description',
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://zax-online.com/payment_success.php?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => 'http://zax-online.com/payment_failed.php',
]);

// Set the response content type to JSON
header('Content-Type: application/json');

// Retrieve the session ID from the query parameters
        $sessionId = $_GET['session_id'];

// Return the session ID as a JSON response
echo $session;
echo $_ENV["STRIPE_PUBLISHABLE_KEY"];

$stripe = new \Stripe\StripeClient('sk_test_51MDpFCDn3WocbosRpeWXuXB4ttpjdzOS6Td0ScT9RJngt3hSaOmd8pEK6ChbcTSs0rPCiUjXgZBG8qi9RrrUwyiL005W2RBrkz');
$stripe->paymentIntents->retrieve(
  'cs_test_a1KV7mkZaK5wzGOIvigqyPzPTjCvNrPBDVTPyLgXVNKJFGA8CkHmulfEX3',
  []
);
?>

