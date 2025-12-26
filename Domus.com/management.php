<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}

// Only allow management users here
if (strtolower(trim($_SESSION['user_type'] ?? '')) !== 'management') {
    header('Location: user.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Dashboard</title>
    <link rel="stylesheet" href="assets/index.css">
</head>
<body style="background: linear-gradient(135deg, #0066ff 0%, #6366f1 100%); min-height: 100vh; padding: 32px 16px;">
    <div style="width: 100%; max-width: 1200px; margin: 0 auto;">
        <div class="signin-wrapper">
            <div class="signin-card">
                <div class="header">
                    <div class="header-left">
                        <h1 style="margin: 0;">📊 Management Dashboard</h1>
                    </div>
                    <div class="header-right">
                        <div class="user-info">
                            <div class="user-name"><?php echo htmlspecialchars($_SESSION['name'] ?? 'Manager'); ?></div>
                            <div class="user-role">management</div>
                        </div>
                        <a href="logout.php" class="logout-btn">Sign Out</a>
                    </div>
                </div>

                <?php
                // Try to show basic stats (requires `Users_DB` and `tickets` table)
                $host = getenv('DATABASE_HOST');
                $dbname = getenv('Users_DB');
                $user = getenv('Site_USER');
                $pass = getenv('Site_PASS');

                $create_message = '';

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Handle create user form submission (after DB connection)
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_user') {
                        $email = trim($_POST['email'] ?? '');
                        $name = trim($_POST['name'] ?? '');
                        $password = $_POST['password'] ?? '';
                        $user_type = strtolower(trim($_POST['user_type'] ?? 'tenant'));
                        $allowed = ['management','maintenance','tenant'];
                        if (!in_array($user_type, $allowed, true)) {
                            $user_type = 'tenant';
                        }

                        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($name) && strlen($password) >= 6) {
                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            $business_id = $_SESSION['business_id'] ?? 1;
                            try {
                                $ins = $pdo->prepare("INSERT INTO users (business_id, email, password, name, user_type, created_at, updated_at) VALUES (:business_id, :email, :password, :name, :user_type, NOW(), NOW())");
                                $ins->execute(['business_id'=>$business_id,'email'=>$email,'password'=>$hash,'name'=>$name,'user_type'=>$user_type]);
                                $create_message = 'User created: ' . htmlspecialchars($email);
                            } catch (PDOException $e) {
                                $create_message = 'Error creating user: ' . $e->getMessage();
                            }
                        } else {
                            $create_message = 'Invalid input for new user.';
                        }
                    }

                    $business_id = $_SESSION['business_id'] ?? 1;

                    // user count (business-filtered)
                    $c = $pdo->prepare("SELECT COUNT(*) FROM users WHERE business_id = :business_id");
                    $c->execute(['business_id' => $business_id]);
                    $c = $c->fetchColumn();

                    // open tickets (business-filtered)
                    $openTickets = 0;
                    try {
                        $ot = $pdo->prepare("SELECT COUNT(*) FROM tickets WHERE business_id = :business_id AND status = 'open'");
                        $ot->execute(['business_id' => $business_id]);
                        $openTickets = $ot->fetchColumn();
                    } catch (Exception $e) {
                        $openTickets = 0;
                    }

                    // recent users (business-filtered)
                    $stmt = $pdo->prepare("SELECT id, email, name, user_type, created_at FROM users WHERE business_id = :business_id ORDER BY created_at DESC LIMIT 6");
                    $stmt->execute(['business_id' => $business_id]);
                    $recentUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // recent logins (business-filtered)
                    $recentLogins = [];
                    try {
                        $stmt = $pdo->prepare("SELECT l.login_time, l.ip_address, u.email FROM login_logs l LEFT JOIN users u ON u.id = l.user_id WHERE l.business_id = :business_id ORDER BY l.login_time DESC LIMIT 8");
                        $stmt->execute(['business_id' => $business_id]);
                        $recentLogins = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $e) {
                        $recentLogins = [];
                    }

                    // fetch all tickets (business-filtered)
                    $allTickets = [];
                    try {
                        $stmt = $pdo->prepare("SELECT t.id, t.title, t.status, t.created_at, u.email AS tenant_email FROM tickets t LEFT JOIN users u ON u.id = t.user_id WHERE t.business_id = :business_id ORDER BY t.created_at DESC LIMIT 50");
                        $stmt->execute(['business_id' => $business_id]);
                        $allTickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $e) {
                        $allTickets = [];
                    }

                } catch (Exception $e) {
                    $c = null; $openTickets = null; $recentUsers = []; $recentLogins = []; $allTickets = [];
                }
                ?>

                <div class="stats">
                    <div class="stat">
                        <div class="stat-label">👥 Total Users</div>
                        <div class="stat-value"><?php echo is_null($c) ? '—' : intval($c); ?></div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">🎫 Open Tickets</div>
                        <div class="stat-value"><?php echo is_null($openTickets) ? '—' : intval($openTickets); ?></div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">📧 Your Email</div>
                        <div style="font-size: 14px; color: var(--text-light); margin-top: 8px; word-break: break-all;"><?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></div>
                    </div>
                </div>

                <div class="section" style="margin-top: 32px;">
                    <div class="card-header">
                        <h3 style="margin: 0;">➕ Create New User</h3>
                    </div>
                    <?php if (!empty($create_message)): ?>
                        <div class="success-message" style="margin-bottom: 20px;"><?php echo $create_message; ?></div>
                    <?php endif; ?>
                    <form method="POST" action="management.php">
                        <input type="hidden" name="action" value="create_user">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" placeholder="user@example.com" required>
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" placeholder="John Doe" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Minimum 6 characters" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select name="user_type" required>
                                    <option value="tenant">Tenant</option>
                                    <option value="maintenance">Maintenance Tech</option>
                                    <option value="management">Management</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-success" type="submit" style="width: auto;">Create User</button>
                        </div>
                    </form>
                </div>

                <div class="section" style="margin-top: 24px;">
                    <div class="card-header">
                        <h3 style="margin: 0;">🎫 All Maintenance Tickets</h3>
                    </div>
                    <?php if (!empty($allTickets)): ?>
                        <div style="overflow-x: auto;">
                            <table>
                                <thead><tr><th>ID</th><th>Title</th><th>Tenant</th><th>Status</th><th>Created</th></tr></thead>
                                <tbody>
                                <?php foreach($allTickets as $at): ?>
                                    <tr>
                                        <td data-label="ID"><strong>#<?php echo htmlspecialchars($at['id']); ?></strong></td>
                                        <td data-label="Title"><?php echo htmlspecialchars($at['title']); ?></td>
                                        <td data-label="Tenant"><?php echo htmlspecialchars($at['tenant_email'] ?? 'Unknown'); ?></td>
                                        <td data-label="Status"><span style="padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600; 
                                            <?php 
                                                if ($at['status'] === 'open') echo 'background-color: #fed7d7; color: #742a2a;';
                                                elseif ($at['status'] === 'in_progress') echo 'background-color: #fef3c7; color: #92400e;';
                                                elseif ($at['status'] === 'resolved') echo 'background-color: #c6f6d5; color: #22543d;';
                                            ?>">
                                            <?php echo htmlspecialchars(ucfirst($at['status'])); ?>
                                        </span></td>
                                        <td data-label="Created"><?php echo htmlspecialchars($at['created_at']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state"><p>No tickets found.</p></div>
                    <?php endif; ?>
                </div>

                <div class="section" style="margin-top: 24px;">
                    <div class="card-header">
                        <h3 style="margin: 0;">👥 Recent Users</h3>
                    </div>
                    <?php if (!empty($recentUsers)): ?>
                        <div style="overflow-x: auto;">
                            <table>
                                <thead><tr><th>ID</th><th>Email</th><th>Name</th><th>Role</th><th>Created</th></tr></thead>
                                <tbody>
                                <?php foreach($recentUsers as $ru): ?>
                                    <tr>
                                        <td data-label="ID"><?php echo htmlspecialchars($ru['id']); ?></td>
                                        <td data-label="Email"><?php echo htmlspecialchars($ru['email']); ?></td>
                                        <td data-label="Name"><?php echo htmlspecialchars($ru['name']); ?></td>
                                        <td data-label="Role"><span class="user-role"><?php echo htmlspecialchars($ru['user_type']); ?></span></td>
                                        <td data-label="Created"><?php echo htmlspecialchars($ru['created_at']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state"><p>No user data available.</p></div>
                    <?php endif; ?>
                </div>

                <div class="section" style="margin-top: 24px; margin-bottom: 0;">
                    <div class="card-header">
                        <h3 style="margin: 0;">🔐 Recent Logins</h3>
                    </div>
                    <?php if (!empty($recentLogins)): ?>
                        <div style="overflow-x: auto;">
                            <table>
                                <thead><tr><th>Login Time</th><th>User Email</th><th>IP Address</th></tr></thead>
                                <tbody>
                                <?php foreach($recentLogins as $rl): ?>
                                    <tr>
                                        <td data-label="Login Time"><?php echo htmlspecialchars($rl['login_time']); ?></td>
                                        <td data-label="User Email"><?php echo htmlspecialchars($rl['email'] ?? 'Unknown'); ?></td>
                                        <td data-label="IP Address"><?php echo htmlspecialchars($rl['ip_address']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state"><p>No recent logins available.</p></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>