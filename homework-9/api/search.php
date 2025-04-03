<?php
require 'db.php';
$type = $_GET['type'] ?? '';

if ($type) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE type LIKE ?");
    $stmt->execute(["%$type%"]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} else {
    echo json_encode([]);
}
?>
