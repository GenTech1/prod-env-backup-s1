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

// Check if the product ID is provided
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Prepare the SQL query to remove the product from the cart
    $sql = "DELETE FROM cart_products WHERE id = '$productId'";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Product removed successfully.";
    } else {
        echo "Error removing product: " . $conn->error;
    }
} else {
    echo "Product ID not provided.";
}

// Close the database connection
$conn->close();
?>

