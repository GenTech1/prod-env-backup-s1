<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />

    <title>Omni Essentials - Login</title>
    <link rel="stylesheet" href="public/css/App.css" />
    <link rel="stylesheet" href="public/css/index.css" />
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
    <noscript>You need to enable JavaScript to run this app.</noscript>

    <section class="signup-section">
      <div class="login-box">
        <h2>Sign In</h2>
        <form method="post" action="owner_create_product.php">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" required />

          <label for="password">Password</label>
          <input id="password" name="password" type="password" required />

          <button type="submit">Sign In</button>
        </form>
      </div>
    </section>
  </body>
</html>