<?php
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
$stmt->execute([$data['title'], $data['content']]);
echo json_encode(['status' => 'created']);
