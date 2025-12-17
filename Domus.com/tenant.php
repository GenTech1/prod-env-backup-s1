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

                <div class="section" style="margin-top: 24px;">
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

                <div class="section" style="margin-top: 24px; margin-bottom: 0;">
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
                        <div class="empty-state"><p>You haven't submitted any maintenance requests yet.</p></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>