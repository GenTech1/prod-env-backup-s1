<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>404 – Page Not Found | Omni Essentials</title>
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
      </nav>
    </header>

    <main class="error-container">
      <h1 class="error-code">404</h1>
      <h2 class="error-title">Page Not Found</h2>
      <p class="error-text">
        The page you're looking for doesn’t exist or may have been moved.
      </p>

      <button class="home-btn" id="goHome">Go Home</button>
    </main>

    <!-- JS -->
    <script src="public/js/404.js"></script>
  </body>
</html>
