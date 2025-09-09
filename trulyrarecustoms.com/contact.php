<!DOCTYPE html>
<html>
  <!--header-->
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="blackback">
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="contact.css">
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
      <div id="top">
      <h1 >Contact us</h1>
<p>Reach out to us and let us know if there is anything we can do for you</p>
</div>

</div>
<form action="/submit.php" method="POST">
  <!--Name-->
  <div id="namesdiv">
    <div class="nameSeparators">
      <input id="names" class="input" type="text" name="first_name" placeholder="First Name *"/>
    </div> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="nameSeparators">
      <input id="names" class="input" type="text" name="last_name" placeholder="Last Name *"/>
    </div><br/>
  </div>

  <input type="hidden" name="table" value="6l7">
  <input class="input" type="email" name="email" placeholder="Email*"/><br/>
  <input class="input" type="tel" name="phone" placeholder="Phone Number *"/>
  <input class="input" id="message" type="text" name="message" placeholder="Message"/><br/>
  <input class="input" type="Submit"  value="Submit"/>
</form>


<section id="bottom">
<p>
  <h1>FAQ's</h1>
<h2>What is the customization process?</h2>
To get started, please submit your design idea through our 'Customize Now' page. You’ll receive an email from us within 2-4 business days to schedule a consultation at a time that works best for you. Once we’ve set a date, we’ll send you an invoice to secure your time slot, which may be applied to your final design price.

During the consultation, we’ll go over your vision, the design process, expected turnaround time, and address any questions or concerns you may have. A 50% deposit will be required before I begin working on your order, with the remaining balance due before or at the time of pickup or delivery.
From there, you can sit back and relax while your Truly Rare Custom design is being created and delivered right to your doorstep!

<h2>Can I bring my own item to get customized or do you supply the item?</h2>
Of course, I’d be happy to help! Please let me know if you plan to bring your own garment for the consultation so we can ensure its approved during that time. Any items you provide must be in good condition, made from a customizable material, and suitable for the design you have in mind.

As for the turnaround time, it varies depending on the complexity of the custom design and the number of projects ahead of yours. Typically, it can take anywhere from 4 days to 4 weeks to complete your order.

<h2>Can I pay to get my item sooner?</h2>
We have 'rush' options available for an additional fee!

<h2>How do I receive my order?</h2>
You have the option to ship directly to you or pick up in store and avoid shipping fees.
</p>
</section>






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
