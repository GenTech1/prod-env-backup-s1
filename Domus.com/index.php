<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get error message if exists
$error = '';
if (isset($_SESSION['signin_error'])) {
    $error = $_SESSION['signin_error'];
    unset($_SESSION['signin_error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domus</title>
    <link rel="stylesheet" href="assets/index.css">
</head>
<body>
    <div class="container">
        <div class="signin-wrapper">
            <div class="signin-card">
                <h1>Sign In</h1>
                <p class="subtitle">Welcome back to Domus</p>

                <?php if ($error): ?>
                    <div class="error-message-box">
                        <span><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>
                
                <form id="signinForm" method="POST" action="signin.php">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Enter your email"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password"
                            required
                        >
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-signin">Sign In</button>
                </form>

                <div class="signup-link">
                    <p>Don't have an account? <a href="signup.php">Create one</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/index.js"></script>
</body>
</html>
