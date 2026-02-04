<?php
// Load database credentials from environment

$report = isset($_GET['report']) ? $_GET['report'] : null;
if (!$report) {
    echo "Report not found";
    exit;
}

$host = getenv('DATABASE_HOST');
$dbname = getenv('research_reports_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM reports WHERE Slug = ?");
    $stmt->execute([$report]);
    $products = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$products) {
        echo "Report not found.";
        exit;
    }

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/researchReport.css">
    <title>Research Report</title>
</head>
<body>
    <script src="js/ResearchReport.js"></script>
    <a href="#" class="fa fa-bars" id="HbMenu"></a>
                      <nav class="navbar" id="nav">
             
                    <a href="index.php">Home</a>
                    <a href="development.php">Development</a>
                    <!-- <a href="gaming.php">Gaming</a> -->
                    <!-- <a href="workstations.php">Workstations</a> -->
                
            </nav>

            <h1>Research Report</h1>

            <h2><?php echo htmlspecialchars($products["Name"]); ?></h2>

            <div class="reportContent">
                <p>
                    <?php echo htmlspecialchars($products["Content"]); ?>
                </p>

                <img src=<?php echo htmlspecialchars($products["Image"]); ?> class="report-img" alt="Research Reports">
            </div>
</body>
</html>