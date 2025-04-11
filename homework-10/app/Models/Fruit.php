<?php

namespace app\Models;

use PDO;

class Fruit {

    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            "mysql:host=" . DBHOST . ";dbname=" . DBNAME,
            DBUSER,
            DBPASS
        );
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM fruits")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($color) {
        $stmt = $this->conn->prepare("SELECT * FROM fruits WHERE color LIKE ?");
        $stmt->execute(["%$color%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $color, $price) {
        $stmt = $this->conn->prepare("INSERT INTO fruits (name, color, price) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $color, $price]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM fruits WHERE id=?");
        return $stmt->execute([$id]);
    }
}
