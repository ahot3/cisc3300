<?php
header("Access-Control-Allow-Origin: *");

$uri = strtok($_SERVER["REQUEST_URI"], '?');
$uriArray = explode("/", $uri);

if ($uriArray[1] === 'hw5q9' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $fruits = [
        ['name' => 'Apple', 'price' => 1.50],
        ['name' => 'Banana', 'price' => 0.75],
        ['name' => 'Cherry', 'price' => 2.00],
        ['name' => 'Orange', 'price' => 1.25],
        ['name' => 'Grape', 'price' => 2.50]
    ];
    
    echo json_encode($fruits);
    exit();
}

echo json_encode(['error' => 'Invalid request']);
exit();
?>
