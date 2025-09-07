
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
  <script src="./js/three.module.js"></script>
  <script src="./js/GLTFLoader.js"></script>
  <script src="./js/OrbitControls.js"></script>
  <script src="./js/scene.js"></script>
  <script type="module">
      import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
      const firebaseConfig = {
        apiKey: "AIzaSyBYC3Of2T5KPfanbsDvpNsveX78mja4e_k",
        authDomain: "pc-shell.firebaseapp.com",
        projectId: "pc-shell",
        storageBucket: "pc-shell.appspot.com",
        messagingSenderId: "325923902642",
        appId: "1:325923902642:web:7158f7208867875639a5ab"
      };
      const app = initializeApp(firebaseConfig);
    </script>
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
            <li> <a href="./cart.php">Cart <span>0</span></a></li>

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

<!-- selected-item-show -->
  <h2 style="text-align: center;">Selcted items</h2>
  <ul id="selectedItems">


  </ul>

<!--CPU-->
<div class="customise-main">
<div class="component">
    <label for="cpu">CPU*</label>
    <select name="cpu"  id="cpubrand">
      <option value="default" data-price="0">Default</option>
      <option value ="AMD" id="AmdOption">AMD</option>
      <option id="IntelOption">Intel</option>

    </select>
    
  </div>
  <div class="component" id="amd">
    <label for="cpu"></label>
    <select name="cpu"  id="cpuSelect">
      <option value="default" data-price="0">Default</option>
<!--AMD-->
      <option value="" data-img="./images/cpu-2.jpg" data-price="420.99">AMD Ryzen 5 5600X ($420.99)</option>
      <option value="" data-img="./images/cpu-2.jpg" data-price="420.99">AMD Ryzen 5 5600G ($420.99)</option>

    
      <option value="" data-img="./images/cpu-2.jpg" data-price="420.99">AMD Ryzen 7 7800X3D ($420.99)</option>
      <option value="" data-img="./images/cpu-2.jpg" data-price="420.99">AMD Ryzen 7 5700X ($420.99)</option>
      <option value="" data-img="./images/cpu-2.jpg" data-price="420.99">AMD Ryzen 7 5800X ($420.99)</option>
      <option value="" data-img="./images/cpu-2.jpg" data-price="420.99">AMD Ryzen 7 5800X3D ($420.99)</option>
      <option value="" data-img="./images/cpu-2.jpg" data-price="420.99">AMD Ryzen 7 5700G ($420.99)</option>

      <option value="" data-img="./images/cpu-2.jpg" data-price="420.99">AMD Ryzen 9 7950X3D ($420.99)</option>
    </select>
    <p id="cpuPrice">Price: $0</p>
  </div>

  <div class="component" id="intel">
    <label for="cpu"></label>
    <select name="cpu"  id="cpuSelect">
      <option value="default" data-price="0">Default</option>
<!--Intel-->
      <option  value="" data-img="./images/cpu-2.jpg" data-price="420.99">Core i5-13400F ($420.99)</option>
      <option  value="" data-img="./images/cpu-2.jpg" data-price="420.99">Core i5-14600K ($420.99)</option>
      <option value="" data-img="./images/cpu-2.jpg" data-price="420.99">Core i5-13600K($420.99)</option>

      <option  value="" data-img="./images/cpu-2.jpg" data-price="420.99">Core i7-14700K($420.99)</option>
      <option  value="" data-img="./images/cpu-2.jpg" data-price="420.99">Core i7-13700K($420.99)</option>

      <option  value="" data-img="./images/cpu-2.jpg" data-price="420.99">Core i9-14900K($420.99)</option>
      <option  value="" data-img="./images/cpu-2.jpg" data-price="420.99">Core i9-13900K($420.99)</option>
    </select>
    <p id="cpuPrice">Price: $0</p>
  </div>

<!--GPU-->
  <div class="component" >
    <label for="cpu">GPU*</label>
    <select name="cpu"  id="cpubrand">
      <option value="default" data-price="0">Default</option>
      <option>MSI</option>
      <option>ASUS</option>
      <option>NVIDIA</option>
      <option>Gigabyte</option>

    </select>
    
  </div>
  <div class="component"style="display:none">
    <label for="gpu"></label>
    <select name="gpu" id="gpuSelect">
      <option value="default" data-price="0">Default</option>
<!--MSI -->
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI GeForce RTX 4060 GAMING X 8G with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI GeForce RTX 4060 Ti VENTUS 3X 8G OC with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI GeForce RTX 4060 Ti VENTUS 2X 8G OC with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI GEFORCE RTX 4070 VENTUS 3X 12G OC graphics card with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI GEFORCE RTX 4070 VENTUS 3X 12G OC graphics card with DLSS 3(3fan)($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99"> MSI GeForce RTX 4070 GAMING X TRIO 12G with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI RTX 4080 16GB VENTUS 3X OC with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI GEFORCE RTX 4080 16GB GAMING X SLIM WHITE graphics card($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI Gaming GeForce RTX 4080($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI GeForce RTX 4090 GAMING X TRIO 24G with DLSS 3 ($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">MSI GeForce RTX 4090 SUPRIM LIQUID X 24G with DLSS 3($329.99)</option>

  </select>
    <p id="gpuPrice">Price: $0</p>
  </div>

  <div class="component"style="display:none">
    <label for="gpu"></label>
    <select name="gpu" id="gpuSelect">
      <option value="default" data-price="0">Default</option>
<!--ASUS -->
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS GeForce RTX 4060 Dual White OC Graphics Card($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS GeForce RTX 4060 ProArt OC Graphics Card($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS ROG Strix GeForce RTX 4060 OC Edition 8GB GDDR6 with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS Dual GeForce RTX 4070 12GB GDDR6X with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS Dual GeForce RTX 4070 OC Edition 12GB GDDR6X with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS TUF Gaming TUF-RTX4070-12G-GAMING with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS GeForce RTX 4080 TUF Gaming Graphics Card($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS PROART-RTX 4080-16G with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS TUF Gaming TUF-RTX 4090-O24G-OG-GAMING with DLSS 3($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS GeForce RTX 4090 Republic of Gamers Strix Graphics Card($329.99)</option>
      <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">ASUS GeForce RTX 4090 TUF Gaming Graphics Card($329.99)</option>
  </select>
    <p id="gpuPrice">Price: $0</p>
  </div>

  <div class="component"style="display:none">
    <label for="gpu"></label>
    <select name="gpu" id="gpuSelect">
      <option value="default" data-price="0">Default</option>
<!--NVIDIA -->
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">NVIDIA GeForce RTX 4060 Ti($329.99)</option>
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">NVIDIA GeForce RTX 4070($329.99)</option>
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">NVIDIA GeForce RTX 4080($329.99)</option>
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">NVIDIA GeForce RTX 4090($329.99)</option>
    
  

  </select>
    <p id="gpuPrice">Price: $0</p>
  </div>
  <div class="component"style="display:none">
    <label for="gpu"></label>
    <select name="gpu" id="gpuSelect">
      <option value="default" data-price="0">Default</option>
<!--Gigabyte -->
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">Gigabyte GeForce RTX­­ 4060 Ti GAMING OC 8G with DLSS 3($329.99)</option>
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">Gigabyte GeForce RTX 4060 Ti WINDFORCE OC with DLSS 3($329.99)</option>
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">Gigabyte GeForce RTX 4060 Ti EAGLE 8GB GDDR6 with DLSS 3($329.99)</option>
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">Gigabyte GeForce RTX 4060 Ti EAGLE OC 8GB GDDR6 with DLSS 3($329.99)</option>
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">Gigabyte GeForce RTX 4070 WINDFORCE OC 12G with DLSS 3($329.99)</option>
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">Gigabyte GeForce RTX­­ 4070 GAMING OC 12G with DLSS 3($329.99)</option>
    <option value="" data-img="./images/graphic-2.jpg" data-price="329.99">Gigabyte GeForce RTX 4070 EAGLE OC 12G with DLSS 3($329.99)</option>


  </select>
    <p id="gpuPrice">Price: $0</p>
  </div>
  <div class="component">
    <label for="cpu">RAM *</label>
    <select name="cpu"  id="cpuSelect">
      <option value="default" data-price="0">Default</option>
      <option>Vengance</option>
      <option>Vengance RGB</option>
      <option>Dominator Platinum</option>
      <option>Dominator Titanium</option>

    </select>
    
  </div>
  <div class="component" style="display:none">
    <label for="ram"></label>
<!--AMD-->
    <select name="ram" id="ramSelect">
      <option value="default" data-price="0">Default</option>

      
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="69.99" data-img="./images/ram-1.jpg">16GB($69.99)</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="69.99" data-img="./images/ram-1.jpg">32GB($69.99)</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="69.99" data-img="./images/ram-1.jpg">64GB($69.99)</option>

      </select>
    <p id="ramPrice">Price: $0</p>
  </div>
  
  <div class="component" style="display:none">
    <label for="ram"></label>
<!--Intel-->
    <select name="ram" id="ramSelect">
      <option value="default" data-price="0">Default</option>

      
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="69.99" data-img="./images/ram-1.jpg">16GB($69.99)</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="69.99" data-img="./images/ram-1.jpg">32GB($69.99)</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="69.99" data-img="./images/ram-1.jpg">64GB($69.99)</option>

      </select>
    <p id="ramPrice">Price: $0</p>
  </div>

  <div class="component">
  <label for="cooling">Cooling System*</label>
    <label for="cooling">Heatsink</label>
    <select name="cs" id="coolingSelect">
      <option value="default" data-price="0">Default</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="189.99" data-img="./images/motherboard-1.jpg">Simple</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="189.99" data-img="./images/motherboard-1.jpg">pump/resrvuar</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="189.99" data-img="./images/motherboard-1.jpg">LCD</option>
      </select>
    <p id="coolingPrice">Price: $0</p>
  </div>
  <div class="component">
    <label for="cooling">radiator*</label>
    <select name="cs" id="coolingSelect">
      <option value="default" data-price="0">Default</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="189.99" data-img="./images/motherboard-1.jpg">120mm</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="189.99" data-img="./images/motherboard-1.jpg">240mm</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="189.99" data-img="./images/motherboard-1.jpg">280mm</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="189.99" data-img="./images/motherboard-1.jpg">360mm</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="189.99" data-img="./images/motherboard-1.jpg">420mm</option>
      </select>
    <p id="coolingPrice">Price: $0</p>
  </div>
  
  <div class="component">
    <label for="motherboard">Motherboard *:</label>
    <select name="mb" id="motherboardSelect">
      <option value="default" data-price="0">Default</option>


      <option>Intel</option>
      <option>MSI</option>
      <option>Gigabyte</option>
      <option>ASUS</option>
      </select>
  </div>
  <div class="component" style="display:none">
    <label for="motherboard"></label>
    <select name="mb" id="motherboardSelect">
      <option value="default" data-price="0">Default</option>


      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="189.99" data-img="./images/motherboard-1.jpg">TUF GAMING B760M-PLUS WIFI (Compatible with intel)$(189.99)</option>
      </select>
    <p id="motherboardPrice">Price:$0</p>
  </div>
  <div class="component">
    <label for="hardDrive">SSD:</label>
    <select name="ssd" id="harddriveSelect">
      <option value="default" data-price="0">Default</option>


      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="59.99" data-img="./images/ssd-1.jpg">990 PRO PCIe® 4.0 NVMe®  $($59.99)</option>
      
    </select>
    <p id="harddrivePrice">Price: $0</p>
  </div>
  <div class="component">
    <label for="os">Os:</label>
    <select name="os"id="osSelect">
      <option value="default" data-price="0">Default</option>

      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="19.99" data-img="./images/os-1.jpg">Windows 11 (Reccomended for gming)$($19.99)</option>
      </select>
    <p id="osPrice">Price: $0</p>
  </div>
  <div class="component">
    <label for="shell">Shell:</label>
    <select name="shell" id="shellSelect">
      <option value="default" data-price="0">Default</option>
      <option value="price_1NhkTwDn3WocbosRElLXEgNO" data-price="79.99" data-img="./images/shell-1.jpg">Shell 1($888)</option>
    </select>
    <p id="shellPrice">Price: $0</p>
  </div>


  <style>
      .loader {
        position: absolute;
        /* display: none; */
        margin: auto;
        width: 48px;
        height: 48px;
        border: 5px solid black;
        border-bottom-color: transparent;
        border-radius: 50%;
        /* display: inline-block; */
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
      }
        @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
      } 
      #color_input{
         position: absolute;
         width: 5rem;
         height: 5rem;
         bottom:  20%;
         display: none;
         z-index: 10;
         pointer-events: all;
      }
      #amd{
      display:none;
      }
      #intel{
        display:none;
      }
  </style>
  <div style="display: flex; align-items: center; justify-content: center; position: relative; padding:1rem;">
    <span id="loader" class="loader"></span>
    <input id="color_input" type="color" name="favcolor" value="#ffffff">
    <div style=" width: 100%; height: 100vh; margin: auto;" id="3d_container">
    </div>
  </div>
  
  
  

<!--select changes-->
<script>
 const dropdown = 
 document.getElementById("cpubrand");

 dropdown.addEventListener("change",
 function() {
  let AMDSel = document.getElementById("amd");
  let IntelSel = document.getElementById("intel");
  let IntelOps = document.getElementById("IntelOp");
  if(dropdown.value==="AMD"){
    IntelOps.selected = false;
    IntelSel.style.display = "none";
    AMDSel.style.display = "block";
    
  }else if(dropdown.value==="Intel"){
    IntelSel.style.display = "block";
    AMDSel.style.display = "none";
  }
 })
	</script>
    
</div>


<div class="cart">

<div class="add-to-card-price">
  <h3 id="totalPrice">0</h3>
  <button onclick="buy()"  class="add-to-card">BUY</button>

</div>

</div>

  <footer class="footer">
    <p>123 Main Street, City, Country</p>
    <p>Email: info@example.com</p>
    <div class="social-links">
      <a href="#" target="_blank">Facebook</a>
      <a href="#" target="_blank">Twitter</a>
      <a href="#" target="_blank">Instagram</a>
    </div>
    <p>
      <a href="terms.php">Terms of Service</a> |
      <a href="privacy.php">Privacy Policy</a>
    </p>
    <p>&copy; 2023 Your Website. All rights reserved.</p>
  </footer>

  
  <script>
    // Attach event listener after the page loads
    // Attach event listener after the page loads
    window.addEventListener("DOMContentLoaded", function () {
      let options = document.querySelectorAll(".component select");
      options.forEach(function (option) {
        option.addEventListener("change", updateSelectedItems);
      });
    });

//option select 
    function OptSel(){
      
    }
    function updateSelectedItems() {
      let selectedItemsElement = document.getElementById("selectedItems");
      selectedItemsElement.innerHTML = ""; // Clear previous selection

      let options = document.querySelectorAll(".component select");
      options.forEach(function (option) {
        let selectedOption = option.options[option.selectedIndex];
        if (selectedOption.value !== "default") {
          let li = document.createElement("li");
          let img = document.createElement("img");
          img.src = selectedOption.getAttribute("data-img");
          img.alt = selectedOption.text;

          let h3 = document.createElement("h3");
          h3.textContent = selectedOption.text;
          img.classList.add("selected-item-img");
          li.appendChild(img);
          li.appendChild(h3);
          selectedItemsElement.appendChild(li);
        }
      });
    }



    window.addEventListener("DOMContentLoaded", function () {
      let cpuSelect = document.getElementById("cpuSelect");
      let gpuSelect = document.getElementById("gpuSelect");
      let osSelect = document.getElementById("osSelect");
      let ramSelect = document.getElementById("ramSelect");
      let shellSelect = document.getElementById("shellSelect");
      let coolingSelect = document.getElementById("coolingSelect");
      let motherboardSelect = document.getElementById("motherboardSelect");
      let harddriveSelect = document.getElementById("harddriveSelect");
      // let totalPrice = document.getElementById("totalPrice");

      cpuSelect.addEventListener("change", updateCPUPrice);

      gpuSelect.addEventListener("change", updateGPUPrice);
      osSelect.addEventListener("change", updateOSPrice);

      ramSelect.addEventListener("change", updateRAMPrice);
      coolingSelect.addEventListener("change", updateCoolingPrice);
      shellSelect.addEventListener("change", updateShellPrice);
      motherboardSelect.addEventListener("change", updateMotherboardPrice);
      harddriveSelect.addEventListener("change", updateHardDrivePrice);
      // totalPrice.addEventListener("change", updateTotalPrice);

      updateCPUPrice(); // Call the function initially to set the CPU price
      updateGPUPrice();
      updateOSPrice(); // Call the function initially to set the OS price
      updateRAMPrice(); // Call the function initially to set the RAM price
      // Call the function initially to set the shell price
      updateCoolingPrice();
      updateShellPrice(); // Call the function initially to set the cooling price
      updateMotherboardPrice();
      updateHardDrivePrice()
      // updateTotalPrice()
    });

    function updateCPUPrice() {
      let selectedOption = document.getElementById("cpuSelect").options[document.getElementById("cpuSelect").selectedIndex];
      let cpuPriceElement = document.getElementById("cpuPrice");
      let cpuPrice = parseFloat(selectedOption.getAttribute("data-price"));
      cpuPriceElement.textContent = "Price: $" + cpuPrice.toFixed(2);
      updateTotalPrice();
    }


    function updateGPUPrice() {
      let selectedOption = document.getElementById("gpuSelect").options[document.getElementById("gpuSelect").selectedIndex];
      let gpuPriceElement = document.getElementById("gpuPrice");
      let gpuPrice = parseFloat(selectedOption.getAttribute("data-price"));
      gpuPriceElement.textContent = "Price: $" + gpuPrice.toFixed(2);
      updateTotalPrice();
    }

    function updateShellPrice() {
      let selectedOption = document.getElementById("shellSelect").options[document.getElementById("shellSelect").selectedIndex];
      let shellPriceElement = document.getElementById("shellPrice");
      let shellPrice = parseFloat(selectedOption.getAttribute("data-price"));
      shellPriceElement.textContent = "Price: $" + shellPrice.toFixed(2);
      updateTotalPrice();
    }
    function updateOSPrice() {
      let selectedOption = document.getElementById("osSelect").options[document.getElementById("osSelect").selectedIndex];
      let osPriceElement = document.getElementById("osPrice");
      let osPrice = parseFloat(selectedOption.getAttribute("data-price"));
      osPriceElement.textContent = "Price: $" + osPrice.toFixed(2);
      updateTotalPrice();
    }

    function updateRAMPrice() {
      let selectedOption = document.getElementById("ramSelect").options[document.getElementById("ramSelect").selectedIndex];
      let ramPriceElement = document.getElementById("ramPrice");
      let ramPrice = parseFloat(selectedOption.getAttribute("data-price"));
      ramPriceElement.textContent = "Price: $" + ramPrice.toFixed(2);
      updateTotalPrice();
    }

    function updateCoolingPrice() {
      let selectedOption = document.getElementById("coolingSelect").options[document.getElementById("coolingSelect").selectedIndex];
      let coolingPriceElement = document.getElementById("coolingPrice");
      let coolingPrice = parseFloat(selectedOption.getAttribute("data-price"));
      coolingPriceElement.textContent = "Price: $" + coolingPrice.toFixed(2);
      updateTotalPrice();
    }

    function updateHardDrivePrice() {
      let selectedOption = document.getElementById("harddriveSelect").options[document.getElementById("harddriveSelect").selectedIndex];
      let hardDrivePriceElement = document.getElementById("harddrivePrice");
      let hardDrivePrice = parseFloat(selectedOption.getAttribute("data-price"));
      hardDrivePriceElement.textContent = "Price: $" + hardDrivePrice.toFixed(2);
      updateTotalPrice();
    }
    function updateMotherboardPrice() {
      let selectedOption = document.getElementById("motherboardSelect").options[document.getElementById("motherboardSelect").selectedIndex];
      let motherboardPriceElement = document.getElementById("motherboardPrice");
      let motherboardPrice = parseFloat(selectedOption.getAttribute("data-price"));
      motherboardPriceElement.textContent = "Price: $" + motherboardPrice.toFixed(2);
      updateTotalPrice();
    }

    function updateTotalPrice() {
      let cpuPrice = parseFloat(document.getElementById("cpuSelect").options[document.getElementById("cpuSelect").selectedIndex].getAttribute("data-price"));
      let gpuPrice = parseFloat(document.getElementById("gpuSelect").options[document.getElementById("gpuSelect").selectedIndex].getAttribute("data-price"));
      let shellPrice = parseFloat(document.getElementById("shellSelect").options[document.getElementById("shellSelect").selectedIndex].getAttribute("data-price"));
      let osPrice = parseFloat(document.getElementById("osSelect").options[document.getElementById("osSelect").selectedIndex].getAttribute("data-price"));
      let ramPrice = parseFloat(document.getElementById("ramSelect").options[document.getElementById("ramSelect").selectedIndex].getAttribute("data-price"));
      let coolingPrice = parseFloat(document.getElementById("coolingSelect").options[document.getElementById("coolingSelect").selectedIndex].getAttribute("data-price"));
      let motherboardPrice = parseFloat(document.getElementById("motherboardSelect").options[document.getElementById("motherboardSelect").selectedIndex].getAttribute("data-price"));
      let harddrivePrice = parseFloat(document.getElementById("harddriveSelect").options[document.getElementById("harddriveSelect").selectedIndex].getAttribute("data-price"));
      let totalPrice = cpuPrice + gpuPrice + shellPrice + osPrice + ramPrice + coolingPrice + motherboardPrice + harddrivePrice;
      document.getElementById("totalPrice").textContent = "Total Price: $" + totalPrice.toFixed(2);


    }

 function buy(){
window.location.href="checkoutsess.php";
}
  </script>
  <!-- <script src="pluginJS/jquery.js"></script>
  <script src="pluginJS/three.min.js"></script>
  <script src="pluginJS/OrbitControls.js"></script>
  <script src="pluginJS/GLTFLoader.js"></script>
  <script src="pluginJS/DRACOLoader.js"></script>
  <script src="customJS/canvas.js" type="module"></script> -->
  <script>
     window.onload=()=>{
      initScene();       
     }
    
  </script>

</body>

</html>