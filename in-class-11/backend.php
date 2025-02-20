<?php
$response = [
    "status" => "success",
    "message" => "Hello! - PHP Backend",
    "timestamp" => date("Y-m-d H:i:s")
];

header('Content-Type: application/json');
echo json_encode($response);
?>
