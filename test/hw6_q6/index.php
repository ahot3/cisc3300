<?php
$products = [
    "Apple" => 1.50,
    "Banana" => 0.75,
    "Cherry" => 2.00
];

foreach ($products as $name => $price) {
    echo "The price of $name is \$$price <br>";
}

function getDiscountedPrice(string $item, float $discount = 0.1): string {
    global $products;
    if (!isset($products[$item])) {
        return "Item not found.";
    }
    $newPrice = $products[$item] - ($products[$item] * $discount);
    return "Discounted price of $item: \$$newPrice";
}

echo getDiscountedPrice("Apple", 0.2);
?>
