<?php

// Inventory management system
// system will track products, process stock updates, generate reports

$products = [
    ["name" => "Rice", "stock" => 12, "price" => 45.33],
    ["name" => "Beans", "stock" => 4, "price" => 946.00],
    ["name" => "Garri", "stock" => 2, "price" => 543.55],
    ["name" => "Corn Flakes", "stock" => 200, "price" => 111.29],
    ["name" => "Oreo", "stock" => 32, "price" => 756.99]
];


$transactions = [
    ["product_id" => 1, "type" => "remove", "quantity" => 50],
    ["product_id" => 1, "type" => "add", "quantity" => 40],
    ["product_id" => 0, "type" => "add", "quantity" => 990],
    ["product_id" => 1, "type" => "add", "quantity" => 44],
    ["product_id" => 3, "type" => "remove", "quantity" => 120],
    ["product_id" => 0, "type" => "add", "quantity" => 12],
    ["product_id" => 4, "type" => "add", "quantity" => 5000],
    ["product_id" => 2, "type" => "add", "quantity" => 100]
];


sort($products);
sort($transactions);

$productsKey = array_keys($products);

foreach ($transactions as $transaction) {
    $product_id = $transaction["product_id"];
    $type = $transaction["type"];
    $transQuantity = $transaction["quantity"];
    $product = $products[$product_id];
    $stock = &$product["stock"];

    if ($type === "add") {
        // process addition of products

        $state = array_search($product_id, $products);
        if ($state  === true) {
            $stock += $transQuantity;
            echo $stock . "<br>";
        }
    } else {
        // process removal of products
    }
}


echo "<pre>";
print_r($products);
echo "</pre>";
