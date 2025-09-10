<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_home";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Access data from the row
        $name = $row["name"];
      

        // Process the data or display it
        echo "title: " . $name;
    }
} else {
    echo "No results found";
}
$conn->close();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>





<div class="">
    <h4>helo</h4>
    <img src="" alt="">
</div>


<form action="upload.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="image">
  <input type="submit" value="Upload">
</form>

<h1>Image Display</h1>

<button id="checkout-button">Checkout</button>

<a href="./image_gallery.php">image</a>
    <form action="./upload_data.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea>
        
        <input type="submit" value="Submit">
    </form>


    <h1>Image Upload Form</h1>
    <form action="upload_image.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input type="submit" value="Upload">
    </form>




<h1>hello</h1>


<script>
    const stripe = Stripe('pk_test_51MJBLfSHkO0ZaOd0iPdAgUX2qMzcVPVh7dY0CEzHktvILJ6Zvq9lDxVo6rC61VdPjuUVvtG0PwWKQdk8JUXVOiRz00pP9QEtRY');

document.getElementById('checkout-button').addEventListener('click', () => {
    fetch('./create_checkout_session.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(session => stripe.redirectToCheckout({ sessionId: session.id }))
    .then(result => {
        if (result.error) {
            console.error(result.error.message);
        }
    })
    .catch(error => {
        console.error(error);
    });
});

</script>
</body>
</html>

