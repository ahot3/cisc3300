<?php

require_once(__DIR__ . '/../core/database.php');

class Product {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($search = null) {
        if ($search) {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE LOWER(name) LIKE ?");
            $stmt->execute(['%' . strtolower($search) . '%']);
        } else {
            $stmt = $this->db->query("SELECT * FROM products");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $type, $description) {
        $stmt = $this->db->prepare("INSERT INTO products (name, type, description) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $type, $description]);
    }

    public function update($id, $name, $type, $description) {
        $stmt = $this->db->prepare("UPDATE products SET name = ?, type = ?, description = ? WHERE id = ?");
        return $stmt->execute([$name, $type, $description, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
