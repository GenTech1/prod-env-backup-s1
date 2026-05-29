<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found - Domus</title>
    <link rel="stylesheet" href="assets/index.css">
    <style>
        .error-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            padding: 24px 16px;
        }

        .error-card {
            background: var(--bg-white);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            padding: 48px 32px;
            max-width: 600px;
            width: 100%;
            animation: slideUp 0.5s ease-out;
        }

        .error-code {
            font-size: 120px;
            font-weight: 700;
            color: var(--error-color);
            margin-bottom: 16px;
            line-height: 1;
        }

        .error-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 12px;
        }

        .error-description {
            font-size: 16px;
            color: var(--text-light);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .error-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-error {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary {
            background: var(--bg-lighter);
            color: var(--text-color);
            border: 2px solid var(--border-light);
        }

        .btn-secondary:hover {
            background: var(--border-light);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 80px;
            }

            .error-title {
                font-size: 24px;
            }

            .error-card {
                padding: 32px 24px;
            }

            .error-actions {
                flex-direction: column;
            }

            .btn-error {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-card">
            <div class="error-code">404</div>
            <h1 class="error-title">Page Not Found</h1>
            <p class="error-description">
                Sorry, the page you're looking for doesn't exist or has been moved. Let's get you back on track.
            </p>
            <div class="error-actions">
                <a href="index.php" class="btn-error btn-primary">Back to Home</a>
                <a href="signin.php" class="btn-error btn-secondary">Sign In</a>
            </div>
        </div>
    </div>
</body>
</html>
