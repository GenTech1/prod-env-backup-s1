<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta
      name="description"
      content="Web site created using create-react-app"
    />
 
          <title>Omni Essentials</title>
    <link rel="stylesheet" href="public/css/App.css" />
    <link rel="stylesheet" href="public/css/about.css" />
  </head>
  <body>
          <header class="navbar">
        <div class="logo">Omni Essentials</div>

        <div class="hamburger" onclick="toggleMenu()">☰</div>

        <nav id="navMenu">
          <button class="nav-btn" onclick="window.location.href='index.php'">Home</button>
          <button class="nav-btn" onclick="window.location.href='about.php'">About</button>
          <button class="nav-btn" onclick="window.location.href='shop.php'">Shop</button>
          <button class="nav-btn" onclick="window.location.href='contact.php'">Contact</button>
          <button class="nav-btn" onclick="window.location.href='login.php'">Login</button>
        </nav>
      </header>

      <script>
        function toggleMenu() {
          document.getElementById('navMenu').classList.toggle('active');
        }
      </script>
      
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div class="all">
    <section class="about-section">

      <div class="about-wrapper">

        <div class="about-text">
          <h1>About</h1>

          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <p>Suspendisse potenti. Donec accumsan risus ut felis euismod.</p>
          <p>Integer vel dui vitae lacus malesuada hendrerit.</p>
          <p>Etiam quis nisl tincidunt, dignissim libero nec, varius arcu.</p>

        </div>

        <div class="about-image box"></div>

      </div>

      <div class="about-lower">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <p>Morbi pharetra lorem non turpis suscipit egestas.</p>
        <p>Donec condimentum libero eget nisl gravida aliquet.</p>
      </div>

    </section>
    </div>
      <section class="signup-section">
              
          </section>
      </div>
  </body>
</html>