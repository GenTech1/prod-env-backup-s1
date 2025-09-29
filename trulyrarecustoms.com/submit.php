<?php
date_default_timezone_set('America/Chicago');

$host = getenv('DATABASE_HOST');
$dbname = getenv('Messages_DB');
$user = getenv('Site_USER');
$pass = getenv('Site_PASS');

try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
die("Connection failed " .$e->getMessage());
}


//send data to database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $table = $_POST['table'] ?? '';

                if ($table === "1w4") {
                        
                        $first_name = $_POST['first_name'] ?? '';
                        $last_name = $_POST['last_name'] ?? '';
                        $email = $_POST['email'] ?? '';
                        $phone = $_POST['phone'] ?? '';
                        $services = $_POST['services'] ?? '';
                        $items = $_POST['items'] ?? '';
                        $date = $_POST['deadline'] ?? '';
                        $time = $_POST['consultation_time'] ?? '';
                        $details = $_POST['details'] ?? '';
                        $submitted_at = date('Y-m-d H:i:s');
			$file_paths = [];
			
			for ($i = 0; $i < 5; $i++) {
    if (isset($_FILES["file$i"]) && $_FILES["file$i"]['error'] === UPLOAD_ERR_OK) {
        $original_name = $_FILES["file$i"]['name'];
	$tmp_name = $_FILES["file$i"]['tmp_name'];
	
	$safe_first_name = preg_replace('/[^a-zA-Z0-9]/', '', $first_name);
	$safe_last_name = preg_replace('/[^a-zA-Z0-9]/', '', $last_name);
	$timestamp = date("Ymd_Hi"); // e.g., 20250715_153045
	$salt = bin2hex(random_bytes(4)); // 8-character hex string
	$extension = pathinfo($original_name, PATHINFO_EXTENSION);
		
	$new_filename = "{$safe_first_name}_{$safe_last_name}_{$timestamp}_{$salt}." . strtolower($extension);
	move_uploaded_file($tmp_name,__DIR__ . '/uploads/' . $new_filename);
	$file_paths [] = '/uploads/' . $new_filename;
    } else {
        continue;
    }
}
			$file_path = json_encode($file_paths);
			

		
			
                        $stmt = $pdo->prepare("Insert Into customs (first_name, last_name,file_path, email, phone, services_requested, service_count, meeting_date, meeting_time, design_info, submitted_at)Values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");  
                        $stmt->execute([$first_name, $last_name, $file_path, $email, $phone, $services, $items, $date, $time, $details, $submitted_at]);
header("Location: /customize.php");			                
}


		       if ($table === "6l7") {
			$first_name = $_POST['first_name'] ?? '';
                        $last_name = $_POST['last_name'] ?? '';
                        $email = $_POST['email'] ?? '';
                        $phone = $_POST['phone'] ?? '';
			$message = $_POST['message'] ?? '';
			$submitted_at = date('Y-m-d H:i:s');

			$stmt = $pdo->prepare("Insert Into contact (first_name, last_name, email, phone, message, submitted_at) Values(?, ?, ?, ?, ?, ?)");
			$stmt->execute([$first_name, $last_name, $email, $phone, $message, $submitted_at]);

header("Location: /contact.php");
                }

}
?>
