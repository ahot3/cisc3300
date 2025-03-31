<?php
require 'db.php';
$posts = $pdo->query("SELECT * FROM posts ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($posts);
