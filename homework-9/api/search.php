<?php
require 'db.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);
$search = strtolower(trim($input['search'] ?? ''));

if ($search === '') {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("SELECT name, description FROM products WHERE LOWER(type) LIKE ?");
$stmt->execute(["%$search%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
?>
