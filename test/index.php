<?php
if (isset($_GET['get_data'])) {
    echo "Greetings from PHP!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP + jQuery Request</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h1>Get a message from PHP:</h1>
    <button id="loadData">Get Message</button>
    <p id="message"></p>

    <script>
        $(document).ready(function() {
            $("#loadData").click(function() {
                $.get("index.php?get_data=1", function(data) {
                    $("#message").text(data);
                });
            });
        });
    </script>

</body>
</html>
