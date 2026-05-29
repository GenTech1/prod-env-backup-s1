<?php
date_default_timezone_set('America/Chicago');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Get database credentials from environment variables
$host = getenv('DATABASE_HOST');
$dbname = getenv('Users_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

// Initialize error message
$error = '';
$success = false;

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get and sanitize input
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;

    // Validate input
    if (empty($email) || empty($password)) {
        $error = 'Email and password are required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    } else {
        // Check if user exists in database (include user_type and business_id)
        $stmt = $pdo->prepare("SELECT id, email, password, name, user_type, business_id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {
            // Verify password
            if (password_verify($password, $user_data['password'])) {
                // Password is correct
                $success = true;

                // Set session variables
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['email'] = $user_data['email'];
                $_SESSION['name'] = $user_data['name'];
                $_SESSION['logged_in'] = true;
                // store user type for downstream routing
                $_SESSION['user_type'] = $user_data['user_type'] ?? 'tenant';
                // store business_id for data filtering
                $_SESSION['business_id'] = $user_data['business_id'] ?? 1;

                // Handle "Remember Me" functionality
                if ($remember) {
                    // Create a secure token for "remember me"
                    $token = bin2hex(random_bytes(32));
                    $expiry = date('Y-m-d H:i:s', strtotime('+30 days'));

                    // Store token in database
                    $stmt = $pdo->prepare("UPDATE users SET remember_token = :token, remember_expiry = :expiry WHERE id = :id");
                    $stmt->execute([
                        'token' => $token,
                        'expiry' => $expiry,
                        'id' => $user_data['id']
                    ]);

                    // Set cookie
                    setcookie('remember_token', $token, strtotime('+30 days'), '/', '', false, true);
                }

                // Log the login activity
                $stmt = $pdo->prepare("INSERT INTO login_logs (user_id, business_id, login_time, ip_address) VALUES (:user_id, :business_id, NOW(), :ip_address)");
                $stmt->execute([
                    'user_id' => $user_data['id'],
                    'business_id' => $_SESSION['business_id'],
                    'ip_address' => $_SERVER['REMOTE_ADDR']
                ]);

                // Redirect to central user page; that page will decide where to send the user based on `user_type`
                header('Location: user.php');
                exit;
            } else {
                $error = 'Invalid email or password';
            }
        } else {
            $error = 'Invalid email or password';
        }
    }

} catch (PDOException $e) {
    $error = 'Database error: ' . $e->getMessage();
    // Log the error to a file instead of showing it to user
    error_log($e->getMessage(), 3, 'error.log');
}

// If there's an error, redirect back to login with error message
if (!$success && !empty($error)) {
    $_SESSION['signin_error'] = $error;
    header('Location: user.php');
    exit;
}
?>
