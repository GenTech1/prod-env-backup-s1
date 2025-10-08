<?php
try{
header('Content-Type: application/json');
$first_name = $_POST['first-name'] ?? '';

if(1==200){
echo json_encode([
  "success" => true,
  "message" => "",
]);
}else{
  echo json_encode([
    "success" => false,
    "message" => " Transaction failed, Please try again $first_name.",
  ]);
}
}catch(Exception $e){
  http_response_code(500);
  echo json_encode(['error' => 'Internal Server Error']);
  exit;
}
?>