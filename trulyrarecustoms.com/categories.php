
<?php
$host = getenv('DATABASE_HOST');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');
$productsdb = getenv('Products_DB');
$usersdb = getenv('Users_DB');
$messagesdb = getenv('Messages_DB');



$section = $_POST['section'] ?? '';

switch ($section) {
  case 'products':
	$conn = new mysqli($host, $user, $pass, $productsdb);
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
    $sql = "SELECT * FROM Products";
    break;
  case 'users':
	$conn = new mysqli($host, $user, $pass, $usersdb);
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
    $sql = "SELECT * FROM internal_users";
    break;
  case 'orders':
	$conn = new mysqli($host, $user, $pass, $productsdb);
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
    $sql = "SELECT * FROM Orders";
    break;
  case 'messages':
	$conn = new mysqli($host, $user, $pass, $messagesdb);
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
   $sql = "Select * FROM customs UNION Select * FROM contact";
	break;
  default:
    echo "Invalid section.";
    exit;
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {

    // Start record div with data attributes
    echo "<div class='record' id='product_{$row['id']}'";

    // Add each database field as a data-* attribute
    foreach ($row as $key => $value) {
      $escapedValue = htmlspecialchars($value, ENT_QUOTES);
      echo " data-$key=\"$escapedValue\"";
    }

    echo ">";

    // Visible output
    foreach ($row as $key => $value) {
      echo "<div><strong>$key:</strong> $value</div>";
    }

    // Add edit button
    echo "<button id='" . $section . "_" . $row['id'] . "' class='edit-button'>Edit</button>";
    echo "</div><hr>"; // Close record + line break
  }
} else {
  echo "No data found.";
}


$conn->close();
?>

