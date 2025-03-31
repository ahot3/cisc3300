<?php
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
$stmt->execute([$data['title'], $data['content'], $data['id']]);
echo json_encode(['status' => 'updated']);
