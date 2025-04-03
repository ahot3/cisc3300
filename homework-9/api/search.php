<?php
require_once __DIR__ . '/../.env';

$host = $_ENV['DB_HOST'];
$db = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

header('Content-Type: application/json');

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$searchTerm = $_GET['name'] ?? '';
$searchTerm = trim($searchTerm);

if ($searchTerm === '') {
    echo json_encode([]);
    exit;
}

$query = "SELECT * FROM products WHERE LOWER(name) LIKE LOWER(?)";
$stmt = $pdo->prepare($query);
$stmt->execute(["%$searchTerm%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
