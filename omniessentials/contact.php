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
    <!-- For confetti on the Submit button -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script src="public/js/contact.js"></script>
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
    <div class="section contact-section">
      <h1 class="contactName">Contact</h1>

      <div class="contact-content">

        <div class="contact-info">
          <p class="placeholder-line">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ullamcorper ante vestibulum erat bibendum tincidunt. Suspendisse condimentum urna magna, nec hendrerit risus maximus et. Duis sed tempor risus. Praesent non sapien elementum, mattis leo eu, feugiat arcu. Etiam eu leo commodo, suscipit felis convallis, porttitor risus. Vivamus auctor dui hendrerit neque tempor mattis. Sed tristique nibh id tincidunt facilisis. Phasellus et ultrices est. In blandit erat nec orci aliquet, ut feugiat sapien mollis. Nulla felis sem, efficitur a enim in, rhoncus efficitur massa.
          </p>
          <p class="placeholder-line"></p>
          <p class="placeholder-line short"></p>
          <p class="placeholder-line"></p>
          <p class="placeholder-line"></p>
        </div>

        <div class="contact-image-placeholder">
          <img class="product-image" src="./public/assets/Gold.jpeg" alt="Mug Icon" />
        </div>
      </div>


      <form class="contact-form" action="submit.php" method="POST">
        <input type="text" id="first_name" placeholder="Your First Name" name="first_name" class="form-input" required/>
        <input type="text" id="last_name" placeholder="Your Last Name" name="last_name" class="form-input" required/>
        <input type="email" id="email" placeholder="Your Email" name="email" class="form-input" required/>
        <input type="text" id="phone_number" placeholder="Your Phone number ex: 1231234567" name="phone_number" class="form-input" required/>
        <textarea id="message" placeholder="Your Message" name="message" class="form-textarea" required></textarea>

        <button class="primary-btn">Submit</button>
      </form>
    </div>
    </div>
      <section class="signup-section">
              
          </section>
      </div>
      <script>
        document.querySelector('.contact-form').addEventListener('submit', function(event){
          event.preventDefault(); 
          const first_name = document.getElementById('first_name').value;
          const last_name = document.getElementById('last_name').value;
          const email = document.getElementById('email').value; 
          const phone_number = document.getElementById('phone_number').value;
          const message = document.getElementById('message').value;

          if (first_name.length < 3 || last_name.length < 3 || !email.includes('@') || phone_number.length < 10 || message.length < 10) {
            alert('Please fill out all fields correctly before submitting.');
            return;
          }else if (first_name.length >= 3 && last_name.length >= 3 && email.includes('@') && phone_number.length >= 7 && message.length >= 10) {
            this.submit();
            }
          });

      </script>
  </body>
</html>



