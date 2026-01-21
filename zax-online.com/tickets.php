<?php
// Must be the first lines in the file
header('Access-Control-Allow-Origin: http://localhost:3000'); 
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');


$host = 'localhost';
$dbname = 'tickets';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sample query
    $stmt = $pdo->query("SELECT id, parties, categories, updated, messages, status FROM tickets");
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tickets);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>