<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $fruit = isset($_POST['fruit']) ? trim($_POST['fruit']) : '';

    if (empty($name) || empty($fruit)) {
        echo json_encode(["success" => false, "message" => "Please fill in all fields."]);
        exit();
    }

    echo json_encode([
        "success" => true,
        "message" => "Thank you, $name! Your favorite fruit is $fruit. 🍓🍌🍎"
    ]);
    exit();
}

echo json_encode(["success" => false, "message" => "Invalid request."]);
exit();
?>
