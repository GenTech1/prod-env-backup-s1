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
 
          <title>Coffee Cups & Mugs</title>
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
        </nav>
      </header>
    <noscript>You need to enable JavaScript to run this app.</noscript>

                <div class="all">
        <section class="home-section">
          <div class="hero-text">
              <h1>Coffee Cups<br />& Mugs</h1>
              <p>Shop our collection of coffee cups and mugs with unique designs.</p>
              <button class="btn"onclick="window.location.href='shop.php'">Shop Now</button>
          </div>

          <div class="hero-image box">
              <img src="" alt="Mug Icon" />
          </div>
      </section>
      
      <section class="featured">
              <h2 class="featuredName">Featured Products</h2>

              <div class="product-grid">
                  <div class="product box"></div>
                  <div class="product box"></div>
                  <div class="product box"></div>
              </div>
          </section>
          
          <section class="about">
              <div class="about-left">
                  <h2>About Us</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut arcu sed velit.</p>
              </div>
              <div class="about-right">
                  <button class="btn"onclick="window.location.href='about.php'">Learn More</button>
              </div>
          </section>

      <section class="signup-section">
              <button class="btn light">Sign Up</button>
          </section>
      </div>
  </body>
</html>
