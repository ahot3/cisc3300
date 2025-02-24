<?php
// Debugging
$request = $_SERVER['REQUEST_URI'];
echo "<p>Debug: Request URI is <strong>$request</strong></p>";

if ($request == "/test/html") {
    header("Content-Type: text/html");
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head><title>HTML Page</title></head>
    <body><h1>This is an HTML response!</h1></body>
    </html>";
}
elseif ($request == "/test/json") {
    header("Content-Type: application/json");
    $response = ["message" => "This is a JSON response!"];
    echo json_encode($response);
}
else {
    echo "<h1>Invalid request.</h1>";
}
?>
