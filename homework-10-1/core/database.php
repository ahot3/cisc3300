<?php

class Database {
    public static function connect() {
        $dotenv = parse_ini_file(__DIR__ . '/../.env');
        $host = $dotenv['DB_HOST'];
        $db = $dotenv['DB_NAME'];
        $user = $dotenv['DB_USER'];
        $pass = $dotenv['DB_PASS'];

        return new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    }
}
