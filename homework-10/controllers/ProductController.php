<?php

require_once(__DIR__ . '/../models/Product.php');

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function index() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $products = $this->productModel->getAll($search);
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['name'], $data['type'], $data['description'])) {
            $this->productModel->create($data['name'], $data['type'], $data['description']);
            echo json_encode(["message" => "Product created"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Missing fields"]);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['name'], $data['type'], $data['description'])) {
            $this->productModel->update($id, $data['name'], $data['type'], $data['description']);
            echo json_encode(["message" => "Product updated"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Missing fields"]);
        }
    }

    public function delete($id) {
        $this->productModel->delete($id);
        echo json_encode(["message" => "Product deleted"]);
    }
}
