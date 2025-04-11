<?php

require_once(__DIR__ . '/../controllers/ProductController.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$controller = new ProductController();

if ($uri === '/products' && $method === 'GET') {
    $controller->index();
} elseif ($uri === '/products' && $method === 'POST') {
    $controller->store();
} elseif (preg_match('/\/products\/(\d+)/', $uri, $matches) && $method === 'PUT') {
    $controller->update($matches[1]);
} elseif (preg_match('/\/products\/(\d+)/', $uri, $matches) && $method === 'DELETE') {
    $controller->delete($matches[1]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Not Found"]);
}
