<?php
date_default_timezone_set('America/Chicago');


$host = getenv('DATABASE_HOST');
$dbname = getenv('Users_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
die("Connection failed " .$e->getMessage());
}
if (isset($_COOKIE['token'])) {
	$token = $_COOKIE['token'];
	

	$stmt = $pdo->prepare("SELECT * FROM tokens WHERE token = ? AND expires_at > NOW()");
	$stmt->execute([$token]);
	$tokenRow = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($tokenRow){
	$userEmail = $tokenRow['user_email'];

	$stmt = $pdo->prepare("SELECT * FROM internal_users WHERE email = ?");
	$stmt->execute([$userEmail]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if($user){
		$permissionsJson = $user['permissions'] ?? '{}';
		$permissionsObj = json_decode($permissionsJson);
		
	}else{
	header("Location: 404.php");
	exit;
	}
	}else{
	header("Location: sessionExpired.php?token=$token");
	exit;
}
} else {
    header("Location: 404.php");
exit;

}

?>
<!DOCTYPE html>
<html>
  <!--header-->
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="blackback">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="user_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="homeLogo">
    <img id="logo1" src="assets/logo1.png" alt="Logo1"/>
    </div>
    <!--Nav-->
    <a href="#" class="fa fa-bars" id="HbMenu"></a>
    <nav id="nav">

<a href="index.php">Home</a>
<a href="shop.php">Shop</a>
<a href="customize.php">Customize</a>
<a href="gallery.php">Gallery</a>
<a href="about.php">About</a>
<a href="events.php">Events</a>
    </nav>
    <nav id="usrOps">
    <a href="#" class="fa fa-search"></a>
    <a href="#" class="fa fa-user"></a>
    <a href="#" class="fa fa-shopping-cart"></a>
    </nav>
    <hr/>
    </div>
  </head>
  <script src="script.js"></script>
  <body>
    <!--Caroucel-->
    <main>

<?php
$stmt = $pdo->prepare("SELECT * FROM tokens WHERE token = ? AND expires_at > NOW()");
$stmt->execute([$token]);
$tokenRow = $stmt->fetch(PDO::FETCH_ASSOC);
$tokenEmail = $tokenRow['user_email'];

$newStmt = $pdo->prepare("SELECT * FROM internal_users WHERE email = ?");
$newStmt->execute([$tokenEmail]);
$userRow = $newStmt->fetch(PDO::FETCH_ASSOC);
$permissions = json_decode($userRow['permissions'], true);
echo '<div id="userCategories">';
foreach($permissions as $key => $value){
	if($key == 'products' && $value == 1){
	echo '<h2 id="products">Products</h2>';
	}elseif($key == 'messages' && $value == 1){
        echo '<h2 id="messages">Messages</h2>';
        }elseif($key == 'site' && $value == 1){
        echo '<h2 id="site">Site</h2>';
        }elseif($key == 'users' && $value == 1){
        echo '<h2 id="users">Users</h2>';
        }elseif($key == 'orders' && $value == 1){
        echo '<h2 id="orders">Orders</h2>';
        }
}
echo '</div>';
?>

<div id="content">
       
Welcome back!
</div>







    </main>
<script src="user_page.js"></script>
  </body>
  <footer>
    <div class="blackback"
    <hr />
    <div id="icons">
 
    <nav id="socials">
      <a href="https://www.instagram.com/tru.lyrare/" class="fa fa-instagram"></a>
      <a href="https://www.facebook.com/people/Truly-Rare-Customs/61566452542361/" class="fa fa-facebook"></a>
      </nav>
  </div>
  <div id="botLogo">
     <img id="logo2" src="assets/logo2.PNG" alt="logo2"/>
    </div>
    <nav id="footerNav">
      <a href="pp.php">Privacy Policy</a>
      <a href="customize.php">Book</a>
      <a href="contact.php">Contact us</a>
      <a href="about.php">About</a>
    </nav>
    <form id="marketingForm">
      <input type="email" placeholder="Email"/>
      <input type="submit" Placeholder="Sign Up"/>
    </form>
  </div>
  </footer>
</html>
