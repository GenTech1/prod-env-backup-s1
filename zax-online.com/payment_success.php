<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        .icon-check {
            font-size: 40px;
            color: #1abc9c;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            margin-bottom: 10px;
            color: #555;
        }

        .button {
            display: inline-block;
            background-color: #1abc9c;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #16a085;
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="icon-check">✔️</i>
        <h1>Payment Successful</h1>
        
        <?php
        require_once('vendor/stripe/stripe-php/init.php');

        \Stripe\Stripe::setApiKey('sk_test_51MJBLfSHkO0ZaOd0oNW5vvrKE9enhATtWrjlDzGOLVGDdu86Xln7nuVvEkRGYdWB1HI6I6OFQmacWiq60VkwN8590015YxUyVh');

        // Retrieve the session ID from the query parameters
        $session_id = $_GET['session_id'];

        // Retrieve the Checkout Session using the session ID
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        // Check if the payment was successful
        if ($session->payment_status === 'paid') {
            // Access the session data
            $price = $session->amount_total / 100; // Convert price from cents to dollars

            // Display the payment success information
            echo "<p>Thank you for your payment.</p>";
            echo "<p>Your order has been processed successfully.</p>";
            echo "<p>Amount: $" . $price . "</p>";
            echo "<p>Transaction ID: " . $session->payment_intent . "</p>";

            // Additional code for updating your database or performing other actions

        } else {
            // Payment was not successful
            echo "<p>Payment Failed!</p>";
        }
        ?>
        
        <a href="./shop.php" class="button">Continue Shopping</a>
    </div>
</body>
</html>

