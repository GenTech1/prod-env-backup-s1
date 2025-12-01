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
    <link rel="stylesheet" href="public/css/shop.css" />
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
    <div className="all">
    <div className="shop-section">

    
      <h1 className="section-title">Shop</h1>

      <div className="shop-content">

 
        <div className="product-grid">
            <div className="product-card">
              <div className="product-image">
                <div className="hero-image box">
              <img src="" alt="Mug Icon" />
          </div>
                <div className="mug-icon"></div>
              </div>
              
              <p className="product-name">Product</p>
              <p className="product-price">$19.99</p>
            </div>
          ))}
        </div>


        <div className="cart-box">
          <h2 className="section-title">Cart</h2>

          <div className="cart-lines">
            <div className="cart-line"></div>
            <div className="cart-line short"></div>
          </div>

          <h2 className="section-title">Total</h2>

          <div className="cart-lines">
            <div className="cart-line"></div>
            <div className="cart-line short"></div>
          </div>

          <button className="checkout-button">Checkout</button>
        </div>
        </div>\
        </div>    
        </div>
      <section class="signup-section">
              <button class="btn light">Sign Up</button>
          </section>
      </div>
  </body>
</html>

