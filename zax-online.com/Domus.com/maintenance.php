<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}

// Only allow maintenance users here
if (strtolower(trim($_SESSION['user_type'] ?? '')) !== 'maintenance') {
    header('Location: user.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance Dashboard</title>
    <link rel="stylesheet" href="assets/index.css">
</head>
<body style="background: linear-gradient(135deg, #0066ff 0%, #6366f1 100%); min-height: 100vh; padding: 32px 16px;">
    <div style="width: 100%; max-width: 1200px; margin: 0 auto;">
        <div class="signin-wrapper">
            <div class="signin-card">
                <div class="header">
                    <div class="header-left">
                        <h1 style="margin: 0;">🔧 Maintenance Dashboard</h1>
                    </div>
                    <div class="header-right">
                        <div class="user-info">
                            <div class="user-name"><?php echo htmlspecialchars($_SESSION['name'] ?? 'Technician'); ?></div>
                            <div class="user-role">maintenance</div>
                        </div>
                        <a href="logout.php" class="logout-btn">Sign Out</a>
                    </div>
                </div>

                <?php
                $host = getenv('DATABASE_HOST');
                $dbname = getenv('Users_DB');
                $user = getenv('Site_USER');
                $pass = getenv('Site_PASS');

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $business_id = $_SESSION['business_id'] ?? 1;

                    // Handle status change
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status']) && !empty($_POST['ticket_id']) && !empty($_POST['new_status'])) {
                        $tid = (int)$_POST['ticket_id'];
                        $new_status = strtolower(trim($_POST['new_status']));
                        $allowed_statuses = ['open', 'in_progress', 'resolved'];
                        if (in_array($new_status, $allowed_statuses, true)) {
                            $u = $pdo->prepare("UPDATE tickets SET status = :status, updated_at = NOW() WHERE id = :id AND business_id = :business_id");
                            $u->execute(['status' => $new_status, 'id' => $tid, 'business_id' => $business_id]);
                        }
                    }

                    // Handle resolve action (simple POST)
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['resolve_id'])) {
                        $tid = (int)$_POST['resolve_id'];
                        $u = $pdo->prepare("UPDATE tickets SET status = 'resolved', updated_at = NOW() WHERE id = :id AND business_id = :business_id");
                        $u->execute(['id' => $tid, 'business_id' => $business_id]);
                    }

                    // Handle adding notes
                    $note_message = '';
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_note']) && !empty($_POST['ticket_id'])) {
                        $tid = (int)$_POST['ticket_id'];
                        $note_text = trim($_POST['note_text'] ?? '');
                        $author_id = $_SESSION['user_id'] ?? null;

                        try {
                            $ins = $pdo->prepare("INSERT INTO ticket_notes (ticket_id, user_id, note, image_path, business_id, created_at) VALUES (:ticket_id, :user_id, :note, NULL, :business_id, NOW())");
                            $ins->execute(['ticket_id'=>$tid,'user_id'=>$author_id,'note'=>$note_text,'business_id'=>$business_id]);
                            $note_message = 'Note added.';
                        } catch (PDOException $e) {
                            $note_message = 'Error adding note: ' . $e->getMessage();
                        }
                    }

                    // Fetch open tickets
                    $stmt = $pdo->prepare("SELECT t.id, t.title, t.status, t.created_at, u.email AS tenant_email FROM tickets t LEFT JOIN users u ON u.id = t.user_id WHERE t.status IN ('open','in_progress') AND t.business_id = :business_id ORDER BY t.created_at ASC LIMIT 50");
                    $stmt->execute(['business_id' => $business_id]);
                    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Fetch notes for tickets
                    $ticket_notes = [];
                    if (!empty($tickets)) {
                        $ids = array_map(function($r){ return (int)$r['id']; }, $tickets);
                        $in = implode(',', $ids);
                        try {
                            $nstmt = $pdo->query("SELECT ticket_id, user_id, note, image_path, created_at FROM ticket_notes WHERE ticket_id IN ($in) AND business_id = $business_id ORDER BY created_at ASC");
                            $rows = $nstmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $r) {
                                $ticket_notes[$r['ticket_id']][] = $r;
                            }
                        } catch (Exception $e) {
                            // ignore
                        }
                    }
                } catch (Exception $e) {
                    $tickets = [];
                    $errorMsg = $e->getMessage();
                }
                ?>

                <div class="section" style="margin-top: 24px;">
                    <div class="card-header">
                        <h3 style="margin: 0;">🎫 Open Tickets</h3>
                    </div>
                    <?php if (!empty($note_message)): ?><div class="success-message" style="margin-bottom: 20px;"><?php echo htmlspecialchars($note_message); ?></div><?php endif; ?>
                    <?php if (!empty($tickets)): ?>
                        <div style="overflow-x: auto;">
                            <form method="POST" enctype="multipart/form-data">
                                <table>
                                    <thead><tr><th>ID</th><th>Title</th><th>Tenant</th><th>Status</th><th>Created</th><th>Action</th></tr></thead>
                                    <tbody>
                                    <?php foreach($tickets as $t): ?>
                                        <tr>
                                            <td data-label="ID"><?php echo htmlspecialchars($t['id']); ?></td>
                                            <td data-label="Title"><?php echo htmlspecialchars($t['title']); ?></td>
                                            <td data-label="Tenant"><?php echo htmlspecialchars($t['tenant_email']); ?></td>
                                            <td data-label="Status">
                                                <form method="POST" style="display: inline;" onchange="this.submit();">
                                                    <select name="new_status" style="padding: 4px 6px; border-radius: 6px; border: 1px solid var(--border-light); font-size: 12px; font-weight: 600; cursor: pointer;">
                                                        <option value="open" <?php if ($t['status'] === 'open') echo 'selected'; ?>>Open</option>
                                                        <option value="in_progress" <?php if ($t['status'] === 'in_progress') echo 'selected'; ?>>In Progress</option>
                                                        <option value="resolved" <?php if ($t['status'] === 'resolved') echo 'selected'; ?>>Resolved</option>
                                                    </select>
                                                    <input type="hidden" name="change_status" value="1">
                                                    <input type="hidden" name="ticket_id" value="<?php echo intval($t['id']); ?>">
                                                </form>
                                            </td>
                                            <td data-label="Created"><?php echo htmlspecialchars($t['created_at']); ?></td>
                                            <td data-label="Action">
                                                <div class="actions">
                                                    <button class="btn btn-success btn-small" type="submit" name="resolve_id" value="<?php echo intval($t['id']); ?>">✓ Quick Resolve</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        // show notes for this ticket
                                        $tn = $ticket_notes[$t['id']] ?? [];
                                        if (!empty($tn)):
                                        ?>
                                        <tr><td colspan="6" style="padding: 16px 16px;">
                                            <div style="background-color: var(--bg-light); padding: 16px; border-radius: 8px; border-left: 4px solid var(--primary-color);">
                                                <strong style="color: var(--text-color); display: block; margin-bottom: 12px;">📝 Ticket Notes:</strong>
                                                <ul style="margin: 0; padding-left: 20px;">
                                                <?php foreach($tn as $note): ?>
                                                    <li style="margin-bottom: 12px; color: var(--text-light);">
                                                        <strong><?php echo htmlspecialchars($note['created_at']); ?></strong> — <?php echo htmlspecialchars($note['note']); ?>
                                                        <?php if (!empty($note['image_path'])): ?>
                                                            <div style="margin-top: 8px;"><img src="/<?php echo htmlspecialchars($note['image_path']); ?>" style="max-width: 250px; max-height: 150px; border-radius: 8px; box-shadow: var(--shadow-sm);"></div>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </td></tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="empty-state"><p><?php if (!empty($errorMsg)) echo 'Database error: ' . htmlspecialchars($errorMsg); else echo 'No open tickets found.'; ?></p></div>
                    <?php endif; ?>
                </div>

                <div class="section" style="margin-top: 24px; margin-bottom: 0;">
                    <div class="card-header">
                        <h3 style="margin: 0;">➕ Add Note to Ticket</h3>
                    </div>
                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group" style="flex: 1;">
                                <label for="ticket_id">Select Ticket</label>
                                <select name="ticket_id" id="ticket_id" required>
                                    <option value="">Choose a ticket...</option>
                                    <?php foreach($tickets as $t): ?>
                                        <option value="<?php echo intval($t['id']); ?>">#<?php echo intval($t['id']); ?> — <?php echo htmlspecialchars(substr($t['title'], 0, 40)); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea name="note_text" placeholder="Add a technical note, observation, or update..." required></textarea>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-success" type="submit" name="add_note" value="1" style="width: auto;">Add Note</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>