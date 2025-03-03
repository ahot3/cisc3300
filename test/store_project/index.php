<?php
namespace Store;

class Item {
    private string $name;
    private float $price;
    private string $category;

    public function __construct(string $name, float $price, string $category) {
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    public function getItemDetails(): string {
        return json_encode([
            "name" => $this->name,
            "price" => $this->price,
            "category" => $this->category
        ]);
    }
}

$item = new Item("Strawberry", 3.99, "Fruit");
echo $item->getItemDetails();
?>
