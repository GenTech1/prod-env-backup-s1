<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/development.css">
    <title>Zax | Development</title>
</head>
<body> 
    <script src="js/ResearchReport.js"></script>
    <section class="top-section">
        <video autoplay muted loop id="bg-video">
            <source src="../images/spaceEarth.mp4" type="video/mp4">
        </video>

        <div class="overlay-content">
            <a href="#" class="fa fa-bars" id="HbMenu"></a>
                      <nav class="navbar" id="nav">
             
                    <a href="index.php">Home</a>
                    <a href="development.php">Development</a>
                    <!-- <a href="gaming.php">Gaming</a>
                    <a href="workstations.php">Workstations</a> -->
                
            </nav>

    
            <div class="content"> <!-- content is hero-text -->
                <div class="content-left">
                    <h1 class="page-title">Reinvent Wheelz</h1>
                </div>
                <div class="cobtent-right">
                    <h4 class="page-subtitle">Develop And Defend</h4>
                    <p class="page-description">
                     Protecting your online presence is crucial. We help clients develop and protect crucial systems
                    </p>
                </div>
            </div>
        </div>    
    </section>

    <section class="bottom-section">
        
     <div class="carousel-inner">
        <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel">
        <?php

$host = getenv('DATABASE_HOST');
$dbname = getenv('research_reports_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

try {
    // Using query() since we’re selecting everything
    $stmt = $pdo->query("SELECT * FROM reports");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
// Putting cards in a gorup of 3
$chunks = array_chunk($products, 3);
$isActive = true;

foreach ($chunks as $group):
?>
    <!-- Where the carousel start -->
    <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
        <div class="d-flex justify-content-center gap-4">

<!-- Making card loop -->
<?php foreach ($group as $product):
echo '<a href="ResearchReport.php?report='. urlencode($product["Slug"]) .'">';
    echo '<div class="card text-bg-dark custom-card" id="'. htmlspecialchars($product["id"]) .'">';
         echo '<img src="' . htmlspecialchars($product["Image"]) . '" class="card-img" alt="Research Reports">';
            echo '<div class="card-img-overlay">';
                echo '<h5 class="card-title">Research Report</h5>';
                    echo '<div class="card-hover-text">';
                        echo '<p class="card-text">'. htmlspecialchars($product["Name"]) .'</p>';
                        echo '<p class="card-text">'. htmlspecialchars($product["Preview"]) .'</p>';
                    echo '</div>';
            echo '</div>';
    echo '</div>';
echo '</a>';
endforeach; 
?>

</div>
</div>

<?php
$isActive = false;
endforeach;
?>

</div>

<!-- Controls for Carousel -->
<button class="carousel-control-prev" type="button" data-bs-target="#cardCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
</button>

<button class="carousel-control-next" type="button" data-bs-target="#cardCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
</button>




        </div>
    </section>
<script src="js/script.js"></script>
</body>
</html>