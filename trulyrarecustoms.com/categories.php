
<?php
$host = getenv('DATABASE_HOST');
$user = getenv('AD_USER');
$pass = getenv('AD_PASS');
$productsdb = getenv('Products_DB');
$usersdb = getenv('Users_DB');
$messagesdb = getenv('Messages_DB');
$sitedb = getenv('Categories_DB');



$section = $_POST['section'] ?? '';

switch ($section) {
  case 'products':
	$conn = new mysqli($host, $user, $pass, $productsdb);
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
    $sql = "SELECT * FROM products";
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
    $sql = "SELECT * FROM orders";
    break;
  case 'messages':
	$conn = new mysqli($host, $user, $pass, $messagesdb);
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
   $sql = "Select * FROM customs UNION Select * FROM contact";
	break;
    case 'site':
  $conn = new mysqli($host, $user, $pass, $sitedb);
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
  $lockSQL ="SELECT setting_value FROM site_settings";
  $lockResult = $conn->query($lockSQL);
  $finalLockResult = $lockResult->fetch_assoc();
  $lockResult = $finalLockResult['setting_value'];

      echo "Site Lock";
      if($lockResult == 0){
      echo "<input type='checkbox' id='siteLock' onclick='siteLocker()'>";
}elseif($lockResult == 1){
      echo "<input type='checkbox' id='siteLock' onclick='siteLocker()' checked>";
}

   $sql = "SELECT * FROM headers";
	break;
    case 'discounts':
	$conn = new mysqli($host, $user, $pass, $sitedb);
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
   $sql = "SELECT * FROM discounts";
	break;
  default:
    echo "Invalid section.";
    exit;
}

$result = $conn->query($sql);


if ($result->num_rows > 0) {
  echo "<div class='record'>";
      echo "<button class='edit-button' id='add_" . $section . "' >Add New " . ucfirst($section) . "</button>";
      echo "</div>";
  while ($row = $result->fetch_assoc()) {


    // Start record div with data attributes
    echo "<div class='record' id='" . $section . "_{$row['id']}'";

    // Add each database field as a data-* attribute
    foreach ($row as $key => $value) {
      $escapedValue = htmlspecialchars($value, ENT_QUOTES);
      echo " data-$key=\"$escapedValue\"";
      
    }

    echo ">";
// Handle image field if it exists
if (isset($row['image']) && !empty($row['image'])) {
  $images = json_decode($row['image'], true);
  
  if (is_array($images)) {
    $firstImage = reset($images); // safely get first value
    if ($firstImage) {
      echo "<div><img src='$firstImage' alt='$row[name]' height='300' width='300'></div>";
    }
  }
}

    // Visible output
    foreach ($row as $key => $value) {
      if ($key === 'password_hash') {
        // For security, do not display password hashes
        echo "<div><strong>$key:</strong> ********</div>";
     
      }else {

         echo "<div><strong>$key:</strong> $value</div>";
      }
    }

    // Add edit button
    echo "<button id='" . $section . "_" . $row['id'] . "' class='edit-button'>Edit</button>";
    echo "</div><hr>"; // Close record + line break
  }
} else {
  echo "No data found." ;
}


$conn->close();
?>

