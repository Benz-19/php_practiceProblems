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
    ["product_id" => 1, "type" => "remove", "quantity" => 50], //failed
    ["product_id" => 1, "type" => "add", "quantity" => 40],
    ["product_id" => 0, "type" => "add", "quantity" => 990],
    ["product_id" => 1, "type" => "add", "quantity" => 44],
    ["product_id" => 3, "type" => "remove", "quantity" => 120],
    ["product_id" => 0, "type" => "add", "quantity" => 12],
    ["product_id" => 4, "type" => "add", "quantity" => 5000],
    ["product_id" => 2, "type" => "add", "quantity" => 100]
];


$failedTransactions = [];

$productsKey = array_keys($products);

foreach ($transactions as $transaction) {
    $product_id = $transaction["product_id"];
    $type = $transaction["type"];
    $transQuantity = $transaction["quantity"];
    $product = &$products[$product_id];

    if ($type === "add") {
        // process addition of products

        $state = array_key_exists($product_id, $products);
        if ($state === true) {
            $product["stock"] += $transQuantity;
        }
    } else {
        // process removal of products
        if ($product["stock"] < $transQuantity) {
            $failedTransactions[] = [
                "Transaction Status" => "Failed",
                "Reason" => "insufficient stock",
                "Name" => $product["name"],
                "Current Stock" => $product["stock"]
            ];
            continue;
        } else {
            $product["stock"] -= $transQuantity;
        }
    }
}



echo "<h1> Failed Transactions </h1>";
echo "<pre>";
print_r($failedTransactions);
echo "</pre>";

// Updated Inventory
echo "<h1> Updated Inventory </h1>";
foreach ($products as $product) {
    $totalValue = number_format($product["stock"] * $product["price"]);
    echo "Name: {$product["name"]}, Stock: {$product["stock"]}, price: {$product["price"]}, Total Value: {$totalValue} <br>";
}

echo "<h1> Current Stock </h1>";
echo "<pre>";
print_r($products);
echo "</pre>";
