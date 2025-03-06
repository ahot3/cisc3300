<?php
require_once __DIR__ . '/Controllers/PostsController.php';
use Controllers\PostsController;

$uri = trim($_SERVER["REQUEST_URI"], "/");
$uriParts = explode("/", $uri);

if (count($uriParts) >= 2 && $uriParts[0] === "test" && $uriParts[1] === "php_project" && isset($uriParts[2]) && $uriParts[2] === "posts" && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new PostsController();
    echo $controller->getPosts();
    exit();
}

echo json_encode(["error" => "Invalid request"]);
exit();
?>
