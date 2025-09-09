<!DOCTYPE html>
<html>
  <!--header-->
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="blackback">
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="customize.css">
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
    <a id="searchButton" href="#" class="fa fa-search"></a>
    <a href="signIn.php" class="fa fa-user"></a>
    <a href="cart.php" class="fa fa-shopping-cart"></a>
    </nav>
    <hr/>
    </div>
  </head>
  <script src="script.js"></script>
  <body>
    <!--Caroucel-->
    <main>

<form action="/submit.php" method="POST" enctype="multipart/form-data">
  <!-- Name -->
  <div id="namesdiv">
    <div class="nameSeparators">
      <input id="names" class="input" type="text" name="first_name" placeholder="First Name *"/>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="nameSeparators">
      <input id="names" class="input" type="text" name="last_name" placeholder="Last Name *"/>
    </div><br/>
  </div>

  <input type="hidden" name="table" value="1w4">
  <input class="input" type="email" name="email" placeholder="Email*"/><br/>
  <input class="input" type="tel" name="phone" placeholder="Phone Number *"/>

  <input class="input" type="text" name="services" placeholder="What services are you requesting?"/><br/>
  <input class="input" type="text" name="items" placeholder="How many items are you getting completed?"/><br/>
  <label>Deadline for this project</label>
  <input class="input" type="date" name="deadline"/>
  <label>Consultation time</label>
  <input class="input" type="time" name="consultation_time" placeholder="Consultation time"/><br/>
  <input class="input" type="text" name="details" placeholder="Tell us a little more about your design"/><br/>
  <label for="file">Choose a file to upload:</label><br>
  <input type="file" name="file0">
<input type="file" name="file1">
<input type="file" name="file2">
<input type="file" name="file3">
<input type="file" name="file4"><br><br>
  <input class="input" type="submit" placeholder="Submit" value="Submit"/>
<p style="font-size:1.5vw;">*$10 submission fee applies*</p>
</form>




<p></p>







    </main>
 

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
