<?php
date_default_timezone_set('America/Chicago');

$host = getenv('DATABASE_HOST');
$dbname = getenv('Memberships_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
die("Connection failed " .$e->getMessage());
}


//send data to database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $table = $_POST['table'] ?? '';
                        
                        $first_name = $_POST['first_name'] ?? '';
                        $last_name = $_POST['last_name'] ?? '';
                        $dob = $_POST['dob'] ?? '';
                        $email = $_POST['email'] ?? '';
                        $phone = $_POST['phone'] ?? '';
                        $submitted_at = date('Y-m-d H:i:s');
        
        if ($first_name === '' || $last_name === '' || $dob === '' || $email === '' || $phone === '' || $submitted_at === '') {
                        die("Error: All required fields must be filled out.");
                        }else {
                        $stmt = $pdo->prepare("INSERT INTO members (first_name, last_name, dob, email, phone, submitted_at) VALUES (:first_name, :last_name, :dob, :email, :phone, :submitted_at)");
                        $stmt->bindParam(':first_name', $first_name);
                        $stmt->bindParam(':last_name', $last_name);
                        $stmt->bindParam(':dob', $dob);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':phone', $phone);
                        $stmt->bindParam(':submitted_at', $submitted_at);
                        $stmt->execute();


// Add to Klaviyo
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	die("Invalid Email");
}

$api_key = getenv('KLAVIYO_API_KEY');
$list_id = getenv('KLAVIYO_MEMBER_LIST');

try{
        $phone = "+1" . $phone;
	$payload = [
		"data" => [
			"type" => "profile",
			"attributes" => [
			"email" => $email,
                        "phone_number" => $phone,
                        "first_name"   => $first_name,
                        "last_name"    => $last_name,
                        "properties" => [
                "birthday" => $dob
                        ],


		]
	]
];


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://a.klaviyo.com/api/profiles");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Authorization: Klaviyo-API-Key ' . $api_key,
  'Revision: 2023-10-01',
   'Accept: application/vnd.api+json',
  "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo ($response);
}catch(Exception $e){
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
    exit;
}

// move it to Master

try {
	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://a.klaviyo.com/api/profiles?filter=equals(email,'$email')");
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
  		'Authorization: Klaviyo-API-Key ' . $api_key,
  		'Revision: 2023-10-01',
   		'Accept: application/vnd.api+json',
]);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
}catch(Exception $e){
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
    exit;
}

if ($code >= 200 && $code < 300) {
	$profileId = json_decode($response, true)['data'][0]['id'];
	$payload = [
		"data" => [
			[
				"type" => "profile",
				"id" => $profileId
			]
		]
	];
	try{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://a.klaviyo.com/api/lists/$list_id/relationships/profiles");
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
  		'Authorization: Klaviyo-API-Key ' . $api_key,
  		'Revision: 2023-10-01',
   		'Accept: application/vnd.api+json',
  		"Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	if($response == NULL){
		echo ' cURL error: ' . curl_error($ch);
	} else {
		echo 'profile added to list';
		$response = curl_exec($ch);
		echo $response;
	}
}catch(Exception $e){
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
    exit;
}
}  else {
	http_response_code($code);
	echo $response;
}

echo $response;

try {
	$payload = [
	"data"=> [
		"type"=> "profile-subscription-bulk-create-job",
		"attributes" => [
			"profiles"=> [
				"data"=> [
					[
						"type"=> "profile",
						"attributes"=> [
							"email"=> "$email",
                                                        "phone_number"=> "$phone",
							"subscriptions"=> [
								"email"=>[
								"marketing"=> [
									"consent"=> "SUBSCRIBED"
									]
								],
                                                                  "sms"=>[
                                                                        "transactional"=>[
                                                                        "consent"=> "SUBSCRIBED"
                                                                        ],
                                                                        "marketing"=>[
                                                                        "consent"=> "SUBSCRIBED"
                                                                        ]
        ],

]

						],
						"id"=> "$profileId"
					]
				]
					],
					"historical_import"=> false
				],
				"relationships"=> [
					"list"=> [
						"data"=> [
							"type"=> "list",
							"id"=> "$list_id"
						]
					]
				]
	]
		];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://a.klaviyo.com/api/profile-subscription-bulk-create-jobs");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Authorization: Klaviyo-API-Key ' . $api_key,
  'Revision: 2025-07-15',
   'Accept: application/vnd.api+json',
  "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo $response;
curl_close($ch);

} catch(Exception $e){
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
    exit;
}
header('Location: /tymem.php');

}
}
?>