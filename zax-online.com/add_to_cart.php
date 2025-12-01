<?php
// Database connection credentials
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the product ID from the submitted form data
    $productID = $_POST['product_id'];

    // Check if the product already exists in the cart
    $sql = "SELECT id FROM cart_products WHERE id = '$productID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Product already exists in the cart, so update the quantity
        $updateSQL = "UPDATE cart_products SET quantity = quantity + 1 WHERE id = '$productID'";
        if ($conn->query($updateSQL) === TRUE) {
            echo "Product quantity updated successfully.";
        } else {
            echo "Error updating product quantity: " . $conn->error;
        }
    } else {
        // Product does not exist in the cart, so add it with a quantity of 1
        $insertSQL = "INSERT INTO cart_products (id, quantity) VALUES ('$productID', 1)";
        if ($conn->query($insertSQL) === TRUE) {
            echo "Product added to cart successfully.";
        } else {
            echo "Error adding product to cart: " . $conn->error;
        }
    }
}


// Close the database connection
$conn->close();
?>

