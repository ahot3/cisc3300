<?php
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$data['id']]);
echo json_encode(['status' => 'deleted']);
