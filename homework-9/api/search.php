<?php
header("Content-Type: application/json");

$host = "127.0.0.1";
$db = "homework_9";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
$query = strtolower(trim($input["type"] ?? ""));

if ($query === "") {
    echo json_encode([]);
    exit;
}

$sql = "SELECT name, description FROM products 
        WHERE LOWER(name) LIKE ? OR LOWER(type) LIKE ?";
$stmt = $pdo->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->execute([$searchTerm, $searchTerm]);
$results = $stmt->fetchAll();

echo json_encode($results);
