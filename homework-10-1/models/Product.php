<?php

require_once __DIR__ . '/../core/database.php';

class Product {
    public static function all($search = '') {
        $db = Database::connect();
        if ($search) {
            $stmt = $db->prepare("SELECT * FROM products WHERE name LIKE ?");
            $stmt->execute(["%$search%"]);
        } else {
            $stmt = $db->query("SELECT * FROM products");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($name, $type, $description) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO products (name, type, description) VALUES (?, ?, ?)");
        $stmt->execute([$name, $type, $description]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }
}
