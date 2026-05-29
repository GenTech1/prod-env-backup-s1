<?php
session_start();

// Handle Square payment for tenant payments
$host = getenv('DATABASE_HOST');
$dbname = getenv('Users_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

$amount = $data['amount'] ?? null;
$nonce = $data['nonce'] ?? null;
$email = $data['email'] ?? null;

// Validate input
if (!$amount || !$nonce || !$email) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

// Convert amount to cents
$amountCents = (int)round((float)$amount * 100);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$accessID = getenv('Square_Access_ID');
if (!$accessID) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Payment service not configured']);
    exit;
}

$payload = [
    "idempotency_key" => uniqid(),
    "source_id" => $nonce,
    "accept_partial_authorization" => false,
    "amount_money" => [
        "amount" => $amountCents,
        "currency" => "USD"
    ],
    "autocomplete" => true,
    "buyer_email_address" => $email
];

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://connect.squareupsandbox.com/v2/payments");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Square-Version: 2025-09-24',
        'Authorization: Bearer ' . $accessID,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode >= 200 && $httpCode < 300) {
        $responseData = json_decode($response, true);
        
        // Insert payment record into purchase_history
        if (isset($_SESSION['user_id']) && isset($_SESSION['business_id'])) {
            try {
                // Format amount to exactly 2 decimal places - no extra rounding
                $formattedAmount = number_format((float)$amount, 2, '.', '');
                $insertStmt = $pdo->prepare("
                    INSERT INTO purchase_history (date, tenant, business, amount) 
                    VALUES (NOW(), :tenant_id, :business_id, :amount)
                ");
                $insertStmt->execute([
                    ':tenant_id' => $_SESSION['user_id'],
                    ':business_id' => $_SESSION['business_id'],
                    ':amount' => $formattedAmount
                ]);
                
                // Subtract the amount from user's balance
                $updateStmt = $pdo->prepare("
                    UPDATE users 
                    SET balance = balance - :amount 
                    WHERE id = :user_id
                ");
                $updateStmt->execute([
                    ':amount' => $formattedAmount,
                    ':user_id' => $_SESSION['user_id']
                ]);
            } catch (Exception $e) {
                // Log error but don't fail the payment response
                error_log('Failed to record purchase history: ' . $e->getMessage());
            }
        }
        
        echo json_encode([
            'success' => true,
            'message' => 'Payment processed successfully',
            'paymentId' => $responseData['payment']['id'] ?? null
        ]);
    } else {
        $responseData = json_decode($response, true);
        $errorMsg = $responseData['errors'][0]['detail'] ?? 'Payment processing failed';
        echo json_encode([
            'success' => false,
            'message' => $errorMsg
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Internal server error']);
    exit;
}
?>
