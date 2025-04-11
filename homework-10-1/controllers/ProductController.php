<?php

require_once __DIR__ . '/../models/Product.php';

class ProductController {
    public function index() {
        $search = $_GET['search'] ?? '';
        $model = new Product();
        $products = $model->search($search);
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function store() {
        $name = $_POST['name'] ?? '';
        $type = $_POST['type'] ?? '';
        $description = $_POST['description'] ?? '';

        $model = new Product();
        $model->create($name, $type, $description);
        echo json_encode(['status' => 'success']);
    }

    public function update() {
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'] ?? '';
        $type = $_POST['type'] ?? '';
        $description = $_POST['description'] ?? '';

        $model = new Product();
        $model->update($id, $name, $type, $description);
        echo json_encode(['status' => 'updated']);
    }

    public function delete() {
        $id = $_POST['id'] ?? '';
        $model = new Product();
        $model->delete($id);
        echo json_encode(['status' => 'deleted']);
    }
}
