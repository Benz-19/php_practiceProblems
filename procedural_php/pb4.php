<?php

$products = [
    ["name" => "Gucci Bag", "price" => 434.64],
    ["name" => "Ipad 11 pro", "price" => 1434.64],
    ["name" => "Asus Vivobook", "price" => 123.02],
    ["name" => "Louis Vitton", "price" => 534.99]
];


$cart = [
    ["product_id" => 0, "quantity" => 5],
    ["product_id" => 3, "quantity" => 12],
    ["product_id" => 1, "quantity" => 2],
    ["product_id" => 2, "quantity" => 14]
];

sort($cart); //sorting the $cart array

// Display cart details
$cartDetails = [];

$productKeys = array_keys($products);
$index = 0;


foreach ($cart as $content) {
    $id =  $content["product_id"];
    $quantity =  $content["quantity"];

    $product = $products[$id];

    $productName = $product["name"];
    $productPrice = $product["price"];
    if ($id === $productKeys[$index]) {
        $totalPrice = floatval($quantity * $productPrice);
        $cartDetails[$productName] = ["quantity" => $quantity, "total price" => $totalPrice];
    }
    $index++;
}


//Grand total

$grandTotal = [];
$subtotal = 0;
$tax = 0;
$count = 1;
foreach ($cartDetails as $content) {
    $subtotal += $content["total price"];
    $tax = 0.1 * $subtotal;
    if ($count === count($cartDetails)) {
        $grandTotal["GrandTotal"] = ["Subtotal" => $subtotal, "Tax" => $tax, "GrandTotal" => ($subtotal + $tax)];
    }
    $count++;
}

echo "Products <br>";
echo "<pre>";
print_r($products);
echo "</pre>";


echo "Grand Total <br>";
echo "<pre>";
print_r($grandTotal);
echo "</pre>";



// Possible correction
/*foreach ($cartDetails as $content) {
    $subtotal = array_sum(array_column($cartDetails, "total price"));
    $tax = 0.1 * $subtotal;
    $grandTotal["GrandTotal"] = [
        "Subtotal" => $subtotal,
        "Tax" => $tax,
        "GrandTotal" => $subtotal + $tax
    ];
}
 */