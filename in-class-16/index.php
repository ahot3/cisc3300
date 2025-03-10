<?php
function divideNumbers($num1, $num2) {
    try {
        if ($num2 == 0) {
            throw new Exception("Cannot divide by zero.");
        }
        return $num1 / $num2;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

echo divideNumbers(10, 0);
?>
