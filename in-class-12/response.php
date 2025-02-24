<?php
$request = $_SERVER['REQUEST_URI'];

if ($request == "/html") {
    header("Content-Type: text/html");
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <title>HTML Page</title>
    </head>
    <body>
        <h1>HTML Response</h1>
    </body>
    </html>";
}
elseif ($request == "/json") {
    header("Content-Type: application/json");
    $response = ["message" => "JSON Response"];
    echo json_encode($response);
}
else {
    echo "<h1>Invalid request.</h1>";
}
?>
