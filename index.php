<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zax Test Site</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 50px;
            max-width: 800px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 40px;
            font-size: 16px;
        }

        .test-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .test-card {
            background: #f8f9fa;
            border: 2px solid #667eea;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .test-card:hover {
            background: #667eea;
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .test-card h2 {
            color: inherit;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .test-card p {
            color: inherit;
            font-size: 14px;
            opacity: 0.9;
        }

        .footer {
            text-align: center;
            color: #999;
            font-size: 12px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .status {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 4px;
        }

        .status p {
            color: #2e7d32;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Zax Test Site</h1>
        <p class="subtitle">Development Testing Environment</p>

        <div class="status">
            <p><strong>Status:</strong> Ready for testing</p>
        </div>

        <div class="test-links">

            <a href="omniessentials/index.php" class="test-card">
                <h2>🛍️ OmniEssentials</h2>
                <p>Test the shop and product display</p>
            </a>

            <a href="Domus.com/index.php" class="test-card">
                <h2>🏠 Domus</h2>
                <p>Test the Domus property management system</p>
            </a>

            <a href="trulyrarecustoms.com/index.php" class="test-card">
                <h2>🎨 Truly Rare Customs</h2>
                <p>Test the Truly Rare Customs site</p>
            </a>

            <a href="zax-online.com/index.php" class="test-card">
                <h2>💻 Zax Online</h2>
                <p>Test the main Zax Online site</p>
            </a>

            <a href="import_products.php" class="test-card">
                <h2>📊 Import Products</h2>
                <p>Import CSV data into the database</p>
            </a>
        </div>

        <div class="footer">
            <p>Zax Test Environment | Last Updated: May 4, 2026</p>
        </div>
    </div>
</body>
</html>
