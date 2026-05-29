<!-- Orginal code -->
 <?php
                // $host = getenv('DATABASE_HOST');
                // $dbname = getenv('Products_DB');
                // $user = getenv('Site_USER');
                // $pass = getenv('Site_PASS');
                try{
                //   $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //   $stmt = $conn->prepare("SELECT * FROM products where tags like '%featured%'");
                //   $stmt->execute();
                //   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // $images = json_decode($parent['image'], true) ?: []; // this is diffrent
                // $firstImage = (!empty($images) && isset($images['1'])) ? $images['1'] : './public/assets/default.jpg'; // this dose not exsit
                // $firstImage = str_replace("\\", "/", $firstImage);
                $imagesJson = htmlspecialchars(json_encode($images));

                  foreach($result as $row){
                    // echo '<div class="product">';
                    // echo '<div class="box">';
                    // echo '<img class="product-image" src="' . htmlspecialchars($firstImage) . '" alt="' . htmlspecialchars($row['name']) . ' Icon" />';
                    echo '</div>';
                    echo '<p name="product-name" class="product-name">' . htmlspecialchars($row['name']) . '</p>';
                    echo '<p class="product-price">$' . htmlspecialchars($row['price']) . '</p>';
                    echo '<button class="atc">Add to Cart</button>';
                    echo '</div>';
                  }
                }catch(PDOException $e){
                  echo "Connection failed: " . $e->getMessage();
                }
                  ?>

                  <!-- New code -->

                  <?php
// $host = getenv('DATABASE_HOST');
// $dbname = getenv('Products_DB');
// $user = getenv('Site_USER');
// $pass = getenv('Site_PASS');

try{
    // $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $stmt = $conn->prepare("SELECT * FROM products WHERE tags LIKE '%featured%'");
    // $stmt->execute();

    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $row){

        $images = json_decode($row['image'], true) ?: []; // instend of $parent it is $row

        $firstImage = (
            !empty($images) && isset($images['1'])
        )
            ? $images['1']
            : './public/assets/default.jpg';

        // $firstImage = str_replace("\\", "/", $firstImage);

        // echo '<div class="product">';
        // echo '<div class="box">';
        // echo '<img class="product-image" src="' . htmlspecialchars($firstImage) . '" alt="' . htmlspecialchars($row['name']) . ' Icon" />';
        echo '</div>';
        echo '<p class="product-name">' . htmlspecialchars($row['name']) . '</p>';
        echo '<p class="product-price">$' . htmlspecialchars($row['price']) . '</p>';
        echo '<button class="atc">Add to Cart</button>';
        echo '</div>';
    }

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>