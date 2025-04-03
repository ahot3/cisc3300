<?php
header("Content-Type: application/json");

$env = parse_ini_file(__DIR__ . '/../.env');

$host = $env['DB_HOST'];
$db = $env['DB_NAME'];
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $term = $_GET['q'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM products WHERE LOWER(type) LIKE LOWER(?)");
    $stmt->execute(["%$term%"]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);

} catch (PDOException $e) {
    echo json_encode(["error" => "Database error"]);
}
