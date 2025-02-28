<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$request_uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));

if (end($request_uri) === 'hw5q9' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        ['name' => 'Apple', 'price' => 1.50],
        ['name' => 'Banana', 'price' => 0.75],
        ['name' => 'Cherry', 'price' => 2.00],
        ['name' => 'Orange', 'price' => 1.25],
        ['name' => 'Grape', 'price' => 2.50]
    ]);
    exit();
}

echo json_encode(["error" => "Invalid request"]);
exit();
