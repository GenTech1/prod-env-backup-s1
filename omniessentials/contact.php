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
    <link rel="stylesheet" href="public/css/contact.css" />
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
    <div className="section contact-section">
      <h1>Contact</h1>

      <div className="contact-content">

        <div className="contact-info">
          <p className="placeholder-line"></p>
          <p className="placeholder-line"></p>
          <p className="placeholder-line short"></p>
          <p className="placeholder-line"></p>
          <p className="placeholder-line"></p>
        </div>

        <div className="contact-image-placeholder"></div>
      </div>


      <form className="contact-form">
        <input type="text" placeholder="Your Name" className="form-input" />
        <input type="email" placeholder="Your Email" className="form-input" />
        <textarea placeholder="Your Message" className="form-textarea"></textarea>

        <button className="primary-btn">Submit</button>
      </form>
    </div>
    </div>
      <section class="signup-section">

          </section>
      </div>
  </body>
</html>



