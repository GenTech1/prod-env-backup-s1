<!DOCTYPE html>
<html>
  <!--header-->
  <head>
    <title>Truly Rare Customs - Access</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="starter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  </head>
  <body>
    <!--Access Page-->
    <main class="starter-main">
      <div class="logo-background">
        <img src="assets/logo1.png" alt="Truly Rare Customs Logo" class="background-logo">
        <div class="white-overlay"></div>
        <div class="starter-content">
          <h1>Truly Rare Customs</h1>
          <p>Enter the access password to continue</p>

          <?php
          session_start();

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = $_POST['password'];
            $correct_password = getenv('SITE_ACCESS_PASSWORD');

            if ($password === $correct_password) {
              $_SESSION['authenticated'] = true;
              header("Location: index.php");
              exit();
            } else {
              echo "<div class='error-message'>Incorrect password. Please try again.</div>";
            }
          }
          ?>

          <form action="starter.php" method="POST" class="starter-form">
            <input type="password" name="password" placeholder="Enter access password" required class="password-input">
            <button type="submit" class="submit-btn">Access Site</button>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>