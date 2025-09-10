
<?php

 
require 'vendor/autoload.php';

 \Stripe\Stripe::setApiKey("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");

     //if test mode get the products ID ( price_xyzxyx ) after switching dashboard to test mode
     //if Live mode get the products ID ( price_xyzxyx ) after switching dashboard to Live mode 

      $price_CPU = $_POST['cpu'];
      $price_GPU = $_POST['gpu']; 
      $price_RAM = $_POST['ram'];
      $price_CS = $_POST['cs'];
      $price_SHELL = $_POST['shell'];
      $price_MB = $_POST['mb'];
      $price_SSD = $_POST['ssd'];
      $price_OS = $_POST['os'];

 echo"  $price_CPU,
      $price_GPU,
      $price_RAM,
      $price_CS,
      $price_SHELL, 
      $price_MB,
      $price_SSD,
      $price_OS";
/*
      $session = \Stripe\Checkout\Session::create([
                                        'payment_method_types' => ['card'],

                              'line_items' => [
                                [
                                  'price' => $price_CPU,
                                  'quantity' => 1,
                                ],
                                [
                                  'price' => $price_GPU,
                                  'quantity' => 1,
                                ],
				[
                                  'price' => $price_RAM,
                                  'quantity' => 1,
                                ],
                              ],


                                        'mode' => 'payment',
                                        'success_url' =>'https://stripe.com',
                                        'cancel_url' => 'https://stripe.com',
                                      ]);
                
                $session_json = json_encode( $session);

//echo json_encode(['id' => $session->id]);
*/
   ?>
  /* 
<html>
	<head>
		<meta charset="utf-8">
		<script src="https://js.stripe.com/v3/"></script>
		<link rel="stylesheet" href="style.css">    
	</head>
	<body onload="checkout()">
	    
<script type="text/javascript">

   var stripe = Stripe("pk_live_51MDpFCDn3WocbosRUhRFdsycUbFhIr5vZxtSy3TmsrPt9sLvWGvTDDQWMwFfWAd2CO8jo6SEgUsWM1EX3LFDnonY00wfTkGylu");
   
    function checkout() {
     
        var sess = JSON.parse('<?php echo"$session_json"; ?>');
        
          return stripe.redirectToCheckout({ sessionId: sess.id });
        }
        
    
  </script>	    

	
	</body>
</html>
*/


