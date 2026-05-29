<?php

session_start();


if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}

// Only allow tenant users here
if (strtolower(trim($_SESSION['user_type'] ?? '')) !== 'tenant') {
    header('Location: user.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenant Dashboard</title>
    <link rel="stylesheet" href="assets/index.css">
    <script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
    <style>
        .tab-navigation {
            display: flex;
            gap: 8px;
            border-bottom: 2px solid rgba(255,255,255,0.2);
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .tab-btn {
            padding: 12px 20px;
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }
        .tab-btn:hover {
            color: white;
        }
        .tab-btn.active {
            color: white;
            border-bottom-color: white;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body style="background: linear-gradient(135deg, #0066ff 0%, #6366f1 100%); min-height: 100vh; padding: 32px 16px;">
    <div style="width: 100%; max-width: 1200px; margin: 0 auto;">
        <div class="signin-wrapper">
            <div class="signin-card">
                <div class="header">
                    <div class="header-left">
                        <h1 style="margin: 0;">🏠 Tenant Dashboard</h1>
                    </div>
                    <div class="header-right">
                        <div class="user-info">
                            <div class="user-name"><?php echo htmlspecialchars($_SESSION['name'] ?? 'Tenant'); ?></div>
                            <div class="user-role">tenant</div>
                        </div>
                        <a href="logout.php" class="logout-btn">Sign Out</a>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <div class="tab-navigation">
                    <button class="tab-btn active" onclick="switchTab('home')">🏠 Home</button>
                    <button class="tab-btn" onclick="switchTab('submit')">➕ Submit Request</button>
                    <button class="tab-btn" onclick="switchTab('requests')">📋 Your Requests</button>
                    <button class="tab-btn" onclick="switchTab('payment')">💳 Payment</button>
                    <button class="tab-btn" onclick="switchTab('documents')">📄 Documents</button>
                </div>

                <?php
                $host = getenv('DATABASE_HOST');
                $dbname = getenv('Users_DB');
                $user = getenv('Site_USER');
                $pass = getenv('Site_PASS');

                $pdo = null;
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (Exception $e) {
                    $pdo = null;
                }

                // Handle new ticket submission
                $submitMsg = '';
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticket_title']) && isset($_POST['ticket_desc'])) {
                    if ($pdo) {
                        $business_id = $_SESSION['business_id'] ?? 1;
                        $stmt = $pdo->prepare("INSERT INTO tickets (user_id, business_id, title, description, status, created_at, updated_at) VALUES (:user_id, :business_id, :title, :desc, 'open', NOW(), NOW())");
                        $stmt->execute([
                            'user_id' => $_SESSION['user_id'],
                            'business_id' => $business_id,
                            'title' => $_POST['ticket_title'],
                            'desc' => $_POST['ticket_desc']
                        ]);
                        $submitMsg = 'Maintenance request submitted successfully!';
                    } else {
                        $submitMsg = 'Unable to submit request (Database unavailable).';
                    }
                }

                // Handle payment submission
                $paymentMsg = '';
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process_payment'])) {
                    $paymentMsg = 'Payment processing would be handled here. This is a placeholder for payment gateway integration.';
                }

                // Fetch user's tickets
                $tickets = [];
                if ($pdo) {
                    try {
                        $business_id = $_SESSION['business_id'] ?? 1;
                        $tstmt = $pdo->prepare("SELECT id, title, status, created_at FROM tickets WHERE user_id = :uid AND business_id = :business_id ORDER BY created_at DESC LIMIT 50");
                        $tstmt->execute(['uid' => $_SESSION['user_id'], 'business_id' => $business_id]);
                        $tickets = $tstmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $e) {
                        $tickets = [];
                    }
                }
                ?>

                <!-- HOME TAB -->
                <div id="home" class="tab-content active">
                    <div class="section" style="margin-bottom: 0;">
                        <div class="card-header">
                            <h3 style="margin: 0;">Welcome to Your Tenant Portal</h3>
                        </div>
                        <div style="padding: 24px;">
                            <div style="margin-bottom: 24px;">
                                <h4 style="color: var(--primary-color); margin-top: 0;">Hello, <?php echo htmlspecialchars($_SESSION['name'] ?? 'Tenant'); ?>! 👋</h4>
                                <p style="color: var(--text-light); line-height: 1.6;">Welcome to your tenant portal. This is your central hub for managing maintenance requests, tracking service status, and handling payments.</p>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
                                <div style="background: var(--bg-light); padding: 16px; border-radius: 8px; border-left: 4px solid #ff6b6b;">
                                    <div style="font-weight: 600; color: var(--primary-color); margin-bottom: 8px;">📊 Active Requests</div>
                                    <div style="font-size: 28px; font-weight: bold; color: var(--primary-color);">
                                        <?php 
                                        $active_count = 0;
                                        foreach($tickets as $t) {
                                            if ($t['status'] === 'open' || $t['status'] === 'in_progress') $active_count++;
                                        }
                                        echo $active_count;
                                        ?>
                                    </div>
                                </div>
                                <div style="background: var(--bg-light); padding: 16px; border-radius: 8px; border-left: 4px solid #51cf66;">
                                    <div style="font-weight: 600; color: var(--primary-color); margin-bottom: 8px;">✓ Completed</div>
                                    <div style="font-size: 28px; font-weight: bold; color: var(--primary-color);">
                                        <?php 
                                        $resolved_count = 0;
                                        foreach($tickets as $t) {
                                            if ($t['status'] === 'resolved') $resolved_count++;
                                        }
                                        echo $resolved_count;
                                        ?>
                                    </div>
                                </div>
                                <div style="background: var(--bg-light); padding: 16px; border-radius: 8px; border-left: 4px solid #4c6ef5;">
                                    <div style="font-weight: 600; color: var(--primary-color); margin-bottom: 8px;">📝 Total Requests</div>
                                    <div style="font-size: 28px; font-weight: bold; color: var(--primary-color);"><?php echo count($tickets); ?></div>
                                </div>
                            </div>
                            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--border-light);">
                                <h4 style="color: var(--text-color); margin-top: 0;">Quick Actions</h4>
                                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                                    <button class="btn btn-success" style="width: auto; cursor: pointer;" onclick="switchTab('submit')">➕ Submit New Request</button>
                                    <button class="btn btn-primary" style="width: auto; cursor: pointer; background-color: var(--primary-color); border: 1px solid var(--primary-color);" onclick="switchTab('payment')">💳 Make Payment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT REQUEST TAB -->
                <div id="submit" class="tab-content">
                    <div class="section">
                        <div class="card-header">
                            <h3 style="margin: 0;">➕ Submit a Maintenance Request</h3>
                        </div>
                        <?php if ($submitMsg): ?><div class="success-message" style="margin-bottom: 20px;"><?php echo htmlspecialchars($submitMsg); ?></div><?php endif; ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="ticket_title">Request Title</label>
                                <input id="ticket_title" name="ticket_title" placeholder="e.g., Leaky kitchen faucet" required />
                            </div>
                            <div class="form-group">
                                <label for="ticket_desc">Description</label>
                                <textarea id="ticket_desc" name="ticket_desc" placeholder="Please describe the issue in detail..." required></textarea>
                            </div>
                            <div class="form-actions">
                                <button class="btn btn-success" type="submit" style="width: auto;">Submit Request</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- YOUR REQUESTS TAB -->
                <div id="requests" class="tab-content">
                    <div class="section">
                        <div class="card-header">
                            <h3 style="margin: 0;">📋 Your Maintenance Requests</h3>
                        </div>
                        <?php if (!empty($tickets)): ?>
                            <div style="overflow-x: auto;">
                                <table>
                                    <thead><tr><th>Request ID</th><th>Title</th><th>Status</th><th>Submitted</th></tr></thead>
                                    <tbody>
                                    <?php foreach($tickets as $tk): ?>
                                        <tr>
                                            <td data-label="Request ID"><strong>#<?php echo htmlspecialchars($tk['id']); ?></strong></td>
                                            <td data-label="Title"><?php echo htmlspecialchars($tk['title']); ?></td>
                                            <td data-label="Status">
                                                <span style="padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600; 
                                                    <?php 
                                                        if ($tk['status'] === 'open') echo 'background-color: #fed7d7; color: #742a2a;';
                                                        elseif ($tk['status'] === 'in_progress') echo 'background-color: #fef3c7; color: #92400e;';
                                                        elseif ($tk['status'] === 'resolved') echo 'background-color: #c6f6d5; color: #22543d;';
                                                    ?>">
                                                    <?php echo htmlspecialchars(ucfirst($tk['status'])); ?>
                                                </span>
                                            </td>
                                            <td data-label="Submitted"><?php echo htmlspecialchars($tk['created_at']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-state"><p>You haven't submitted any maintenance requests yet. <a href="javascript:switchTab('submit')" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Submit one now</a></p></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- PAYMENT TAB -->
                <div id="payment" class="tab-content">
                    <div class="section">
                        <div class="card-header">
                            <h3 style="margin: 0;">💳 Payment Management</h3>
                        </div>
                        <div style="padding: 24px;">
                            <div style="margin-bottom: 24px; padding: 16px; background: var(--bg-light); border-radius: 8px; border-left: 4px solid var(--primary-color);">
                                <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">CURRENT BALANCE</div>
                                <div style="font-size: 32px; font-weight: bold; color: var(--primary-color);"><?php
                                try {
                                        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    }catch (PDOException $e){
                                        die("Connection failed " .$e->getMessage());
                                    }
                                    $user_id = $_SESSION['user_id'];
                                    $stmt = $pdo->prepare("SELECT balance FROM users WHERE id = ?");
                                    $stmt->execute([$user_id]);
                                    $balance = $stmt->fetchColumn();
                                    echo '$' . number_format($balance, 2);
                                ?></div>
                            </div>
                            <?php if ($paymentMsg): ?><div class="success-message" style="margin-bottom: 20px;"><?php echo htmlspecialchars($paymentMsg); ?></div><?php endif; ?>
                            <div style="margin-bottom: 24px;">
                                <h4 style="color: var(--text-color); margin-top: 0;">Make a Payment</h4>
                                <div id="payment-form" style="background: var(--bg-light); padding: 20px; border-radius: 8px;">
                                    <div class="form-group">
                                        <label for="payment_amount">Amount ($)</label>
                                        <input id="payment_amount" type="number" step="0.01" min="0.01" placeholder="0.00" required />
                                    </div>
                                    <div id="sq-web-payments-container" style="margin-bottom: 20px; min-height: 60px;"></div>
                                    <button id="sq-payment-button" class="btn btn-success" type="button" style="width: 100%;">Pay Now</button>
                                    <div id="sq-result-container" style="margin-top: 20px;"></div>
                                </div>
                            </div>
                            <div style="padding: 16px; background: var(--bg-light); border-radius: 8px;">
                                <h4 style="color: var(--text-color); margin-top: 0;">Payment History</h4>
                                <div class="empty-state" style="padding: 16px 0;">
                                    <?php
                                    // Fetch payment history from database
                                    try {
                                        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    }catch (PDOException $e){
                                        die("Connection failed " .$e->getMessage());
                                    }
                                    $user_id = $_SESSION['user_id'];
                                    $stmt = $pdo->prepare("SELECT * FROM purchase_history WHERE tenant = ? ORDER BY date DESC");
                                    $stmt->execute([$user_id]);
                                    $purchase_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    if ($purchase_history) {
                                        foreach ($purchase_history as $purchase) {
                                            echo '<div style="padding: 12px; border-bottom: 1px solid var(--border-light);">
                                                <div style="font-weight: 600; color: var(--primary-color);">Amount: $' . htmlspecialchars($purchase['amount']) . '</div>
                                                <div style="font-size: 12px; color: var(--text-light);">Date: ' . htmlspecialchars($purchase['date']) . '</div>
                                            </div>';
                                        }
                                    }else{
                                        echo '<p>No payment history found.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DOCUMENTS TAB -->
                <div id="documents" class="tab-content">
                    <div class="section">
                        <div class="card-header">
                            <h3 style="margin: 0;">📄 Documents</h3>
                        </div>
                        <?php
                        // Fetch tenant documents
                        $documents = [];
                        if ($pdo) {
                            try {
                                $business_id = $_SESSION['business_id'] ?? 1;
                                $dstmt = $pdo->prepare("SELECT id, location FROM documents WHERE user_id = :uid AND business_id = :business_id ORDER BY id DESC");
                                $dstmt->execute(['uid' => $_SESSION['user_id'], 'business_id' => $business_id]);
                                $documents = $dstmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch (Exception $e) {
                                $documents = [];
                            }
                        }
                        ?>
                        <?php if (!empty($documents)): ?>
                            <div style="padding: 24px;">
                                <div style="display: grid; gap: 12px;">
                                    <?php foreach($documents as $doc): 
                                        $filename = basename($doc['location']);
                                    ?>
                                        <div style="padding: 12px; background: var(--bg-light); border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                                            <a href="documents/<?php echo htmlspecialchars($doc['location']); ?>" download style="color: var(--primary-color); text-decoration: none; font-weight: 600;">
                                                📥 <?php echo htmlspecialchars($filename); ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="empty-state" style="padding: 24px;"><p>No documents available.</p></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const squareAppId = '<?php echo getenv("Square_App"); ?>';
        const locationId = '<?php echo getenv("Square_Location_ID"); ?>';
        let payments;
        let card;

        document.addEventListener('DOMContentLoaded', async () => {
            // Initialize Square payments on page load
            try {
                if (!window.Square) {
                    throw new Error('Square SDK not loaded');
                }
                payments = Square.payments(squareAppId, locationId);
                card = await payments.card();
                await card.attach('#sq-web-payments-container');
            } catch (e) {
                console.error('Failed to initialize Square:', e);
            }
        });

        function switchTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked button
            event.target.classList.add('active');
        }

        // Handle payment button click
        document.getElementById('sq-payment-button')?.addEventListener('click', async (e) => {
            e.preventDefault();
            
            const amountInput = document.getElementById('payment_amount');
            const amount = parseFloat(amountInput.value);
            
            if (!amount || amount <= 0) {
                document.getElementById('sq-result-container').innerHTML = 
                    '<div style="color: #d32f2f; padding: 10px; background: #ffebee; border-radius: 4px;">Please enter a valid amount</div>';
                return;
            }

            const button = document.getElementById('sq-payment-button');
            button.disabled = true;
            button.textContent = 'Processing...';

            try {
                // Tokenize the card
                const result = await card.tokenize();
                
                if (result.status !== 'OK') {
                    throw new Error(result.errors ? result.errors[0].message : 'Tokenization failed');
                }

                const token = result.token;

                // Send to charge.php
                const response = await fetch('charge.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        amount: amount,
                        nonce: token,
                        email: '<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>'
                    })
                });

                const result2 = await response.json();

                if (result2.success) {
                    document.getElementById('sq-result-container').innerHTML = 
                        '<div style="color: #2e7d32; padding: 10px; background: #e8f5e9; border-radius: 4px;">Payment of $' + amount.toFixed(2) + ' processed successfully!</div>';
                    amountInput.value = '';
                    
                    // Redirect to clear POST data after success
                    setTimeout(() => window.location.href = window.location.pathname, 1500);
                } else {
                    document.getElementById('sq-result-container').innerHTML = 
                        '<div style="color: #d32f2f; padding: 10px; background: #ffebee; border-radius: 4px;">Payment failed: ' + result2.message + '</div>';
                }
            } catch (error) {
                console.error('Payment error:', error);
                document.getElementById('sq-result-container').innerHTML = 
                    '<div style="color: #d32f2f; padding: 10px; background: #ffebee; border-radius: 4px;">Payment error: ' + error.message + '</div>';
            } finally {
                button.disabled = false;
                button.textContent = 'Pay Now';
            }
        });
    </script>
</body>
</html>