<?php

$env = parse_ini_file('.env');

define('DBHOST', $env['DB_HOST']);
define('DBNAME', $env['DB_NAME']);
define('DBUSER', $env['DB_USER']);
define('DBPASS', $env['DB_PASS']);

require 'app/Models/Fruit.php';
require 'app/Controllers/FruitController.php';

use app\Controllers\FruitController;

// Create the controller
$fruitController = new FruitController();

$uri = strtok($_SERVER["REQUEST_URI"], '?');
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

// View main page
if ($uri === '/' && $method === 'GET') {
    require 'app/Views/FruitWebStore.html';
    exit();
}

// Fetch all fruits
if ($uri === '/fruits' && $method === 'GET' && $action === 'all') {
    $fruitController->getAllFruits();
}

// Search fruits
if ($uri === '/fruits' && $method === 'GET' && $action === 'search') {
    $color = $_GET['color'] ?? ''; // ✅ must define this first
    $fruitController->searchFruits($color); // ✅ now this will work
}

// Create new fruit
if ($uri === '/fruits' && $method === 'POST' && $action === 'create') {
    $data = json_decode(file_get_contents('php://input'), true);
    $fruitController->createFruit($data);
}

// Delete fruit
if ($uri === '/fruits' && $method === 'POST' && $action === 'delete') {
    $data = json_decode(file_get_contents('php://input'), true);
    $fruitController->deleteFruit($data['id']);
}

exit();
