<?php
require 'db.php';

$request = $_GET['url'] ?? '/';

if ($request === 'posts') {
    $stmt = $pdo->prepare("SELECT * FROM posts");
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($posts);
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Not Found']);

