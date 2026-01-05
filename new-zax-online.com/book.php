<?php
$appId = getenv('Square_App');
$locId = getenv('Square_Location_ID');
$price = 2000; // Price in cents for consultation
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/book.css">
    <title>Zax | Book A Consultation</title>
</head>
<body>
            <nav>
                <ul class="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="development.php">Development</a></li>
                    <li><a href="gaming.php">Gaming</a></li>
                    <li><a href="workstations.php">Workstations</a></li>
                </ul>
            </nav>

    <form id="bookingForm" action="submit_booking.php" method="POST">
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <h1>Book A Consultation</h1>
        
        <input type="text" placeholder="Name" id="name" name="name" required>
        <label for ="name">Name</label>
        <input type="email" id="email" placeholder="Email" name="email" required>
        <label for="email">Email</label>
        <input type="tel" id="phone" placeholder="Phone" name="phone" required>
        <label for="phone">Phone</label>
        <p for="date">Info about consultation:</p>
        <input type="date" id="date" placeholder="Date" name="date" required>

        <input type="time" id="time" name="time" name="time" required>

        <select id="service" name="service" name="service" required>
            <option value="" disabled selected>Select Service</option>
            <option value="Development">Development</option>
            <option value="Gaming">Gaming</option>
            <option value="Workstations">Workstations</option>
        </select>
        
  <div id="card-container"></div>

  <button type="submit" id="card-button">Pay Now</button>
  *There will be a $20 booking fee for all consultations
  <div id="payment-status"></div>
    </form>




    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<script>

  const payment_form = document.getElementById("bookingForm");
  document.addEventListener("DOMContentLoaded", async () => {
    // alert("started Square JS SDK");
    const applicationId = "<?php echo htmlspecialchars($appId);?>";
    const locationId = "<?php echo htmlspecialchars($locId);?>";
    // alert("App ID: " + applicationId + " Location ID: " + locationId);
    async function initializeCard(payments) {
    //   alert("initializing card");
      const card = await payments.card();
      await card.attach('#card-container');
      return card;
    }
    async function tokenize(paymentMethod) {
    //   alert("tokenizing payment method");
      const result = await paymentMethod.tokenize();
      if (result.status === 'OK') {
        return result.token;
      } else {
        throw new Error(result.errors ? result.errors[0].message : 'Tokenization failed');
      }
    }
    async function main() {
      // alert("starting main payment function");
      const payments = Square.payments(applicationId, locationId);
      const card = await initializeCard(payments);

      const cardButton = document.getElementById('card-button');
      cardButton.addEventListener('click', async function (e) {
        e.preventDefault();
        try {
            const email = document.getElementById('email').value;
          const phone = document.getElementById('phone').value;
          const name = document.getElementById('name').value;
          const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;
            const service = document.getElementById('service').value;
          if(!email || !phone || !name){
            document.getElementById('payment-status').textContent = 'Please fill in all required fields.';
            return;
          }else if(!/^\S+@\S+\.\S+$/.test(email)){
            document.getElementById('payment-status').textContent = 'Please enter a valid email address.';
            return;
            }else if(!/^\+?[0-9]{7,15}$/.test(phone)){
            document.getElementById('payment-status').textContent = 'Please enter a valid phone number.';
            return;
            }else if(name.length < 3){
            document.getElementById('payment-status').textContent = 'Please enter a valid name.';
            return;
            }else if(service === '') {
            document.getElementById('payment-status').textContent = 'Please select a service.';
            return;
            }else if(date === ''){
            document.getElementById('payment-status').textContent = 'Please select a date.';
            return;
            }else if(time === ''){
            document.getElementById('payment-status').textContent = 'Please select a time.';
            return;
            }else{
                
          const token = await tokenize(card);
          const response = await fetch('charge.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nonce: token, email: email, phone: phone, price: <?php echo json_encode($price); ?> })
          });

          let result = await response.json();
          if(result.success){
            document.getElementById('payment-status').textContent ='Payment successful!';
            document.getElementById('bookingForm').submit();
          }else{
            document.getElementById('payment-status').textContent = 'Payment failed: ' + result.message;
          }
        }
        } catch (err) {
          document.getElementById('payment-status').textContent = 'Error: ' + err.message;
        }
      });
    }

    main();
  });
  
  if (!window.Square) {
    console.error("❌ Square JS SDK not loaded.");
    document.getElementById("payment-status").textContent = "Error: Square SDK not loaded.";

  }
  
</script>







    

</body>
</html>