
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./images/favicon-32x32.png">
  <title>Customise</title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/canvas.css">
  <link rel="stylesheet" href="style.css">

</head>
<body>


  <header class=" header gradient">

    <div class="container">

      <nav>
        <div class="logo">
          <a href="./index.php">
            <img src="./images/zax-logo.png" alt="">
          </a>
        </div>


        <div class="nav-items ">


          <ul class="items">

            <li>
              <a href="./index.php">Home</a>
            </li>
            <li> <a href="./shop.php">Shop </a></li>
            <li> <a href="./customise.php">Customise</a></li>
           <!-- <li> <a href="./cart.php">Cart <span>0</span></a></li>-->

          </ul>
        </div>

        <div id="nav-icon1">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </nav>

      <hr>

    </div>



  </header>



  <h1>Customize Your PC</h1>

        <form id="customForm">
        <input type="text" id="fname" name="name" placeholder="First Name">
        <input type="text" id="fname" name="name" placeholder="Last Name">

        <input type="email" id="email" name="email" placeholder="Email">
        <input type="phone" id="phone" name="phone" placeholder="Phone Number">
	What do you plan on using this rig for?
        <select id="purpose" name="purpose" placeholder="Purpose of the PC">
          <option value="gaming">Gaming</option>
          <option value="work">Work</option>
          <option value="Content">Content Creation</option>
          <option value="other">Other</option>
        </select>
        <input type="number" id="brf" name="brf" placeholder="budget range from">
        <input type="number" id="brt" name="brt" placeholder="budget range to">
	Is there a theme?
        <select id="themeS" name="themeS" placeholder="is there a theme?">
          <option value="yes">yes</option>
          <option value="no">no</option>
        </select>
        <input type="number" id="theme" name="theme" placeholder="Describe the theme">

        <input type="file" id="upload" name="upload" placeholder="image upload">
        <input type="text" id="mh" name="mh" placeholder="must haves">
        <input type="submit" value="Submit">
        <form>

  <footer class="footer">
        <!--<p>123 Main Street, City, Country</p>
        <p>Email: info@example.com</p>-->
        <div class="social-links">
            <a href="https://www.facebook.com/people/Zax/100088852040825/?mibextid=LQQJ4d">Facebook</a>
            <a href="">Twitter</a>
            <a href="https://www.instagram.com/zax.tech/?igshid=MzRlODBiNWFlZA%3D%3D">Instagram</a>
        </div>
        <p>
            <a href="./term-of-service.php">Terms of Service</a> |
            <a href="./privacy.php">Privacy Policy</a>
        </p>
        <p>&copy; 2024 Zax-Online. All rights reserved.</p>

    </footer>



</body>

</html>
