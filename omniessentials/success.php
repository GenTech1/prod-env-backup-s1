<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Thank You | Omni Essentials</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Page not found" />

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/App.css" />
    <link rel="stylesheet" href="public/css/404.css" />
  </head>

  <body>
    <header class="navbar">
      <div class="logo">LOGO</div>
         <nav>
          <button class="nav-btn" onclick="window.location.href='index.php'">Home</button>
          <button class="nav-btn" onclick="window.location.href='about.php'">About</button>
          <button class="nav-btn" onclick="window.location.href='shop.php'">Shop</button>
          <button class="nav-btn" onclick="window.location.href='contact.php'">Contact</button>
          <button class="nav-btn" onclick="window.location.href='login.php'">Login</button>
        </nav>
    </header>

    <main class="error-container">
        <h2 class="error-title">Transaction Successful</h2>
      <p class="error-text">
        Thank you for your purchase! Your transaction was successful.
      </p>

      <button class="home-btn" id="goHome">Go Home</button>
    </main>

    <!-- JS -->
    <script src="public/js/404.js"></script>
  </body>
</html>