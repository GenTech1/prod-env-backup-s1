<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/favicon-32x32.png">

    <!-- fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="">


    <title>Zax- Official Site</title>

    <link rel="stylesheet" href="./style.css">

    <style>
        #shop {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
    }

    .card {
      flex: 1 1 300px;
      max-width: 300px;
      height: auto;
      padding: 20px;
      border: 1px solid #ccc;
      /* border-radius: 5px; */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .card img {
      max-width: 100%;
      max-height: 150px;
      margin-bottom: 20px;
    }

    .card h2 {
      font-size: 1.8rem;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 16px;
      margin-bottom: 20px;
    }

    .card button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      background-color: var(--blue);
      color: #fff;
      border: none;
      /* border-radius: 5px; */
      cursor: pointer;
      border: 1px solid var(--blue);
    }

    h1 {
   
      font-size: 24px;
      margin-top: 20px;
    }

    .card button:hover {
      background-color: var(--white);
      color: #000;

    }

    @media only screen and (max-width: 768px) {
      .card {
        flex-basis: calc(50% - 20px);
        max-width: calc(50% - 20px);
      }
    }

    @media only screen and (max-width: 480px) {
      .card {
        flex-basis: 100%;
        max-width: 100%;
      }
    }



    #myPopup {
      display: none;
      position: absolute;
      top: 12%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 10px;
      background-color: #ffc107;
      border: 1px solid #000000;
      border-radius: 2px;
      color: #000;
    }

    .show {
      display: block;
      animation: fadeOut 1s forwards;
    }

    @keyframes fadeOut {
      0% {
        opacity: 1;
      }

      100% {
        opacity: 0;
      }
    }
    </style>
<script>
        function addToCart(productId) {
            // Send the product ID to the server-side PHP script to save in the cart database
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Show the response from the server
                }
            };
            var data = "product_id=" + productId;
            xhr.send(data);
        }

	function Buy(){
	window.location.href = "https://buy.stripe.com/3cs7st3Oga1SaGceUZ";
}
    </script>
</head>

<body>
    <div class="line"></div>

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
                       <!--<li> <a href="./customise.php">Customize</a></li>-->
                        <!-- <li> <a href="./cart.php"> Cart</a></li>-->

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
    <main>
        <!-- Hero-section -->

        <div class=" gradient main">




            <div class="hero-section container">
                <div class="hero-main">
                    <div class="action">
                        <h1>Custom Rigs. No Limts</h1>
                        <p>Elevate your gaming experience to new heights with our cutting-edge hardware and a philosiphy that champions dream fearlessly</p>
                        
                            
                                                  <div class="hero-btn">

                            <a href="./shop.php">See our latest build</a>


                            <a href="./customise.php">
                                Customise Now
                            </a>

                        </div>
                    </div>
                    <div class="hero-img">
                        <img src="./images/hero.jpg" alt="">
                    </div>

                </div>




            </div>




    </main>

    <!-- Category -->


    <!--<section>

        <div class="category">




            <div class="container">

                <div class="Category-heading">
                    <span>Category</span>
                </div>

                <div class="category-type">

                    <div class="categories">
                        <p>Students</p>



                    </div>

                    <div class="categories">
                        <p>Professional</p>


                    </div>

                    <div class="categories">
                        <p>Gamers</p>

                    </div>
                </div>



            </div>

        </div>

    </section>-->


    <!--Products-->

    <section>


        <div class="shop-main" >

            <div class="container">

                <div class="shop">
                    <span>Shop</span>
                </div>
                <div class="product">

    <?php
    $servername = getenv("HOST");
    $username = getenv("Site_USER");
    $password = getenv("Site_PASS");
    $database = getenv("Products_DB");

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch products from the database
    $sql = "SELECT id, name, image, description, price FROM Products LIMIT 8";
    $result = $conn->query($sql);

    // Display the products
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $image = $row['image'];
            $description = $row['description'];
            $price = $row['price'];
    ?>

    <div class="product-items">
        <div class="product-all">
<div class="product-img">

        <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
</div>
<div class="product-info ">

<div class="product-detail">

        <h3><?php echo $name; ?></h3>
        <p><?php echo $description; ?></p>
        </div>
        <div class="price">
        <p>Price: $<?php echo  $price; ?></p>

        </div>
<div class="butt">
       <!-- <button class="btns"  onclick="addToCart(<?php echo $id; ?>)">Add to Cart</button>--> <button class="btns" onclick="Buy()">Buy</button>
</div>
</div>
        </div>

    </div>

    <?php
        }
    } else {
        echo "No products found.";
    }

    // Close the database connection
    $conn->close();
    ?>

</div>
</section>
    <!-- Reviews -->
    <section>

        <div class="reviews-main">

            <div class="customer-says">
                <h2>Customers reviews</h2>
            </div>


            <div class="reviews container slider">



                <div class="review slide">
                    <h2>"ABSOULUTE POWERHOUSE!"</h2>
                    <p class="star">⭐⭐⭐⭐⭐</p>
                    <p>This custom PC build is a true powerhouse! It handles all tasks flawlessly, from gaming to video
                        editing. Impressive performance all around.</p>


                </div>
                <div class="review slide">
                    <h2>"Sleek and Speedy"</h2>
                    <p class="star">⭐⭐⭐⭐⭐</p>
                    <p>I'm loving my new custom PC build. It not only looks sleek but also delivers lightning-fast
                        performance. Great for gaming and multitasking.</p>


                </div>
                <div class="review slide">
                    <h2>"Solid Performance"</h2>
                    <p class="star">⭐⭐⭐⭐⭐</p>
                    <p>I'm impressed with the solid performance of this custom PC build, especially considering the
                        price. It's a great value for the performance it delivers.</p>


                </div>






            </div>


            <div class="indicators">
                <button class="indicator active"></button>
                <button class="indicator"></button>
                <button class="indicator"></button>
                <!-- Add more indicator buttons as needed -->
            </div>


        </div>




    </section>

    <!-- let's connect -->

    <section>


        <div>

            <div class="connect container">

                <div class="touch">
                    <h2>Let's Stay in touch</h2>
                    <p>Get updates on sales special or more</p>
                </div>

                <div class="email-box">
                    <input placeholder="Email" type="text">
                    <a href="">Send</a>
                </div>


            </div>




        </div>




    </section>

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




    </script>

    <script>
        const slides = document.querySelectorAll('.slide');
        const indicators = document.querySelectorAll('.indicator');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide) => {
                slide.classList.remove('active');
            });

            slides[index].classList.add('active');

            indicators.forEach((indicator) => {
                indicator.classList.remove('active');
            });

            indicators[index].classList.add('active');
        }

        function handleIndicatorClick(index) {
            if (index !== currentSlide) {
                showSlide(index);
                currentSlide = index;
            }
        }

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                handleIndicatorClick(index);
            });
        });

        function nextSlide() {
            const nextSlideIndex = (currentSlide + 1) % slides.length;
            showSlide(nextSlideIndex);
            currentSlide = nextSlideIndex;
        }

        setInterval(nextSlide, 4000);
    </script>
  <script src="./app.js"></script>
</body>

</html>
