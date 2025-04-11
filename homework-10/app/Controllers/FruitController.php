<?php

namespace app\Controllers;

use app\Models\Fruit;

class FruitController {

    private $model;

    public function __construct() {
        $this->model = new Fruit();
    }

    public function getAllFruits() {
        header('Content-Type: application/json');
        echo json_encode($this->model->getAll());
        exit();
    }

    public function searchFruits($color) {
        header('Content-Type: application/json');
        echo json_encode($this->model->search($color));
        exit();
    }

    public function createFruit($data) {
        header('Content-Type: application/json');
        $result = $this->model->create($data['name'], $data['color'], $data['price']);
        echo json_encode(['success' => $result]);
        exit();
    }

    public function deleteFruit($id) {
        header('Content-Type: application/json');
        $result = $this->model->delete($id);
        echo json_encode(['success' => $result]);
        exit();
    }
}
