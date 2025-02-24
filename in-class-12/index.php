<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';

if ($page == "html") {
    header("Content-Type: text/html");
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head><title>HTML Page</title></head>
    <body><h1>This is an HTML response!</h1></body>
    </html>";
}
elseif ($page == "json") {
    header("Content-Type: application/json");
    $response = ["message" => "This is a JSON response!"];
    echo json_encode($response);
}
else {
    echo "<h1>Invalid request.</h1>";
}
?>
