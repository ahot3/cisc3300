<?php
$env = parse_ini_file(__DIR__ . '/../.env');
$pdo = new PDO("mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']}", $env['DB_USER'], $env['DB_PASS']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
