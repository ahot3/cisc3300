<?php
$url = isset($_GET['url']) ? $_GET['url'] : '';

if ($url == "html") {
    header("Content-Type: text/html");
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head><title>HTML Page</title></head>
    <body><h1>This is the HTML response</h1></body>
    </html>";
}
elseif ($url == "json") {
    header("Content-Type: application/json");
    $response = ["message" => "This is the JSON response"];
    echo json_encode($response);
}
else {
    echo "<h1>Invalid request.</h1>";
}
?>
