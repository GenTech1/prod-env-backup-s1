  <?php
  try{
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$sku   = $data['sku'];
$fname = $data['fname'];
$lname = $data['lname'];
$email = $data['email'];
$phone = $data['phone'];
$image = $data['image'];
$print = $data['print'];
                    // Order product from printed mint
                    $url = "https://api.madely.com/pm/v1/orders.json";
                    $apiKey = "o3cxzababnTKhy72oK4YHcPHWZH2jPxg";

                    /**
                     * Generates a 24-character hex string similar to a MongoDB ObjectId
                     */
                    function generateMongoId() {
                        return bin2hex(random_bytes(12));
                    }

                    $orderId = generateMongoId(); // Create the top-level ID
                    $staticOrderId = "TEST_ORDER_OMNI_001"; // Static order ID for testing
                    $itemId  = substr(bin2hex(random_bytes(4)), 0, 8); // Create an 8-char ID for the item

                    $orderData = [
                        "id" => $orderId, 
                        "sample" => true,
                        "address_to" => [
                            "first_name" => $fname,
                            "last_name" => $lname,
                            "address1" => "123 Test Lane",
                            "city" => "New York",
                            "region" => "NY",
                            "zip" => "10001",
                            "country" => "US",
                            "email" => $email,
                            "phone" => $phone
                        ],
                        "shipping" => [
                            "carrier" => "FedEx",
                            "priority" => "Ground"
                        ],
                        "items" => [
                            [
                                "id" => $itemId, // The item needs its own ID too
                                "sku" => $sku, 
                                "quantity" => 1,
                                "preview_files" => [
                                    "front" => "https://zaxtest.xyz/".$image
                                ],
                                "print_files" => [
                                    "front" => "https://zaxtest.xyz/".$print
                                ]
                            ]
                        ]
                    ];
                //      $host = getenv('DATABASE_HOST');
                // $dbname = getenv('Products_DB');
                // $user = getenv('Site_USER');
                // $pass = getenv('Site_PASS');
                        
                // try{
                //   $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //   $stmt = $conn->prepare();
                //   $stmt->execute([$items[$i]]);
                // $product = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                // echo json_encode(['success' => true, 'order' => $orderData]);
                // }catch(PDOException $e){
                //   echo "Connection failed: " . $e->getMessage();
                // }

  } catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Invalid input']);;
    exit;
    }
                    ?>