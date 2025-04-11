<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $env = parse_ini_file(__DIR__ . '/../.env');
        $host = $env['DB_HOST'];
        $dbname = $env['DB_NAME'];
        $user = $env['DB_USER'];
        $pass = $env['DB_PASS'];

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die(json_encode(['error' => 'Database connection failed']));
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
