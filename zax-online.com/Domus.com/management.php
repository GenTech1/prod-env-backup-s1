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

                    $business_id = $_SESSION['business_id'] ?? 1;

                    // Handle balance adjustment form submission
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'adjust_balance') {
                        $tenant_id = intval($_POST['tenant_id'] ?? 0);
                        $balance_amount = number_format((float)($_POST['balance_amount'] ?? 0), 2, '.', '');
                        
                        if ($tenant_id > 0 && $balance_amount != 0) {
                            try {
                                $adjStmt = $pdo->prepare("UPDATE users SET balance = balance + :amount WHERE id = :tenant_id AND business_id = :business_id");
                                $adjStmt->execute(['amount' => $balance_amount, 'tenant_id' => $tenant_id, 'business_id' => $business_id]);
                                $create_message = 'Balance adjusted by $' . number_format(abs($balance_amount), 2, '.', '') . ' (' . ($balance_amount > 0 ? 'added' : 'deducted') . ')';
                                // Redirect to clear POST data
                                header('Location: management.php?success=1');
                                exit;
                            } catch (PDOException $e) {
                                $create_message = 'Error adjusting balance: ' . $e->getMessage();
                            }
                        } else {
                            $create_message = 'Invalid tenant or amount.';
                        }
                    }

                    // Fetch all tenants with their address
                    $allTenants = [];
                    try {
                        $stmt = $pdo->prepare("SELECT id, name, address FROM users WHERE business_id = :business_id AND user_type = 'tenant' ORDER BY name ASC");
                        $stmt->execute(['business_id' => $business_id]);
                        $allTenants = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $e) {
                        $allTenants = [];
                    }

                    // Handle document deletion
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_document') {
                        $doc_id = intval($_POST['doc_id'] ?? 0);
                        if ($doc_id > 0) {
                            try {
                                $delStmt = $pdo->prepare("DELETE FROM documents WHERE id = :id AND business_id = :business_id");
                                $delStmt->execute(['id' => $doc_id, 'business_id' => $business_id]);
                                $create_message = 'Document deleted successfully';
                                header('Location: management.php?success=1');
                                exit;
                            } catch (Exception $e) {
                                $create_message = 'Error deleting document: ' . $e->getMessage();
                            }
                        }
                    }

                    // Handle document upload
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload_document') {
                        $user_id = intval($_POST['user_id'] ?? 0);
                        
                        if ($user_id > 0 && isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
                            $uploaded_file = $_FILES['document_file'];
                            $filename = basename($uploaded_file['name']);
                            $upload_dir = __DIR__ . '/documents/';
                            
                            // Create documents directory if it doesn't exist
                            if (!is_dir($upload_dir)) {
                                mkdir($upload_dir, 0755, true);
                            }
                            
                            $file_path = $upload_dir . $filename;
                            
                            if (move_uploaded_file($uploaded_file['tmp_name'], $file_path)) {
                                try {
                                    $uploadStmt = $pdo->prepare("INSERT INTO documents (location, user_id, business_id) VALUES (:location, :user_id, :business_id)");
                                    $uploadStmt->execute(['location' => $filename, 'user_id' => $user_id, 'business_id' => $business_id]);
                                    $create_message = 'Document uploaded successfully';
                                    header('Location: management.php?success=1');
                                    exit;
                                } catch (Exception $e) {
                                    $create_message = 'Error saving document to database: ' . $e->getMessage();
                                    unlink($file_path);
                                }
                            } else {
                                $create_message = 'Error uploading file to server.';
                            }
                        } else {
                            $create_message = 'Invalid tenant or no file selected.';
                        }
                    }

                    // Fetch all documents for management
                    $allDocuments = [];
                    try {
                        $stmt = $pdo->prepare("SELECT d.id, d.location, u.name AS tenant_name FROM documents d LEFT JOIN users u ON u.id = d.user_id WHERE d.business_id = :business_id ORDER BY d.id DESC");
                        $stmt->execute(['business_id' => $business_id]);
                        $allDocuments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $e) {
                        $allDocuments = [];
                    }

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
                            try {
                                $ins = $pdo->prepare("INSERT INTO users (business_id, email, password, name, user_type, created_at, updated_at) VALUES (:business_id, :email, :password, :name, :user_type, NOW(), NOW())");
                                $ins->execute(['business_id'=>$business_id,'email'=>$email,'password'=>$hash,'name'=>$name,'user_type'=>$user_type]);
                                $create_message = 'User created: ' . htmlspecialchars($email);
                                // Redirect to clear POST data
                                header('Location: management.php?success=1');
                                exit;
                            } catch (PDOException $e) {
                                $create_message = 'Error creating user: ' . $e->getMessage();
                            }
                        } else {
                            $create_message = 'Invalid input for new user.';
                        }
                    }

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
                        <h3 style="margin: 0;">💰 Adjust Tenant Balance</h3>
                    </div>
                    <form method="POST" action="management.php">
                        <input type="hidden" name="action" value="adjust_balance">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Select Tenant</label>
                                <select name="tenant_id" required>
                                    <option value="">-- Choose a Tenant --</option>
                                    <?php foreach($allTenants as $tenant): ?>
                                        <option value="<?php echo htmlspecialchars($tenant['id']); ?>">
                                            <?php echo htmlspecialchars($tenant['name'] . ' - ' . ($tenant['address'] ?? 'No address')); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Amount to Add ($)</label>
                                <input type="number" name="balance_amount" step="0.01" placeholder="e.g., 100.00 or -50.00" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-success" type="submit" style="width: auto;">Adjust Balance</button>
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

                <div class="section" style="margin-top: 24px;">
                    <div class="card-header">
                        <h3 style="margin: 0;">📄 Manage Documents</h3>
                    </div>
                    <form method="POST" action="management.php" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="upload_document">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Select Tenant</label>
                                <select name="user_id" required>
                                    <option value="">-- Choose a Tenant --</option>
                                    <?php foreach($allTenants as $tenant): ?>
                                        <option value="<?php echo htmlspecialchars($tenant['id']); ?>">
                                            <?php echo htmlspecialchars($tenant['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Upload Document</label>
                                <input type="file" name="document_file" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-success" type="submit" style="width: auto;">Upload Document</button>
                        </div>
                    </form>

                    <div style="margin-top: 24px;">
                        <h4 style="color: var(--text-color); margin-top: 0;">Documents by Tenant</h4>
                        <?php 
                        // Group documents by tenant
                        $docsByTenant = [];
                        foreach($allDocuments as $doc) {
                            $tenantName = $doc['tenant_name'] ?? 'Unknown';
                            if (!isset($docsByTenant[$tenantName])) {
                                $docsByTenant[$tenantName] = [];
                            }
                            $docsByTenant[$tenantName][] = $doc;
                        }
                        ?>
                        <?php if (!empty($docsByTenant)): ?>
                            <div style="display: grid; gap: 16px;">
                                <?php foreach($docsByTenant as $tenantName => $docs): ?>
                                    <div style="background: var(--bg-light); padding: 16px; border-radius: 8px; border-left: 4px solid var(--primary-color);">
                                        <div style="font-weight: 600; color: var(--primary-color); margin-bottom: 12px;">👤 <?php echo htmlspecialchars($tenantName); ?></div>
                                        <div style="display: grid; gap: 8px;">
                                            <?php foreach($docs as $doc): ?>
                                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px; background: white; border-radius: 4px;">
                                                    <span style="color: var(--text-color);">📄 <?php echo htmlspecialchars($doc['location']); ?></span>
                                                    <form method="POST" action="management.php" style="display: inline;">
                                                        <input type="hidden" name="action" value="delete_document">
                                                        <input type="hidden" name="doc_id" value="<?php echo htmlspecialchars($doc['id']); ?>">
                                                        <button class="btn" type="submit" style="width: auto; padding: 4px 8px; background: #d32f2f; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">Delete</button>
                                                    </form>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="empty-state"><p>No documents available.</p></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>