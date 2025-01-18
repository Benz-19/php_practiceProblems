<?php

$failedOrders = []; //Logs potential errors


$stores = [
    [
        "name" => "UK Store Alex-Way",
        "products" => [
            ["name" => "Rice", "price" => 344.22, "stock" => 44],
            ["name" => "Garri", "price" => 864.33, "stock" => 64], //target product
            ["name" => "Beans", "price" => 111.13, "stock" => 12],
            ["name" => "Tomatoe", "price" => 763.23, "stock" => 55],
            ["name" => "Carrot", "price" => 224.21, "stock" => 66], //target product
            ["name" => "Ketchup", "price" => 968.77, "stock" => 8],
            ["name" => "Peanut", "price" => 134, "stock" => 4],
            ["name" => "Mayonnaise", "price" => 65.32, "stock" => 90],
            ["name" => "Cucumber", "price" => 6543, "stock" => 35]
        ]
    ],
    [
        "name" => "UK Store Benzene Avenue",
        "products" => [
            ["name" => "Avocado", "price" => 905.22, "stock" => 44],
            ["name" => "Strawberries", "price" => 234.33, "stock" => 64],
            ["name" => "Grapes", "price" => 124.13, "stock" => 12], //target product
            ["name" => "Tuna", "price" => 163.23, "stock" => 55],
            ["name" => "Yizzy T-shirt", "price" => 2124.21, "stock" => 66],
            ["name" => "Yought", "price" => 9438.77, "stock" => 8], //target product
            ["name" => "Walmal Cookies", "price" => 131, "stock" => 4],
            ["name" => "Dues Wine", "price" => 225.32, "stock" => 90],
            ["name" => "Orange", "price" => 613, "stock" => 35]
        ]
    ],
];


// Customer
$customers = [
    ["name" => "Alexa", "email address" => "alexa@gmail.com", "cart" => []],
    ["name" => "Benson", "email address" => "benson@gmail.com", "cart" => []],
    ["name" => "Marvin", "email address" => "marvin@gmail.com", "cart" => []],
    ["name" => "Kelvin", "email address" => "kelvin@gmail.com", "cart" => []],
    ["name" => "Bob", "email address" => "bob@gmail.com", "cart" => []]
];

// Cusotmers' orders 
// status could be "completed", "pending", "cancelled"
$orders = [
    ["store_id" => 1, "customer_id" => 2, "products" => ["product_id" => 5, "quantity" => 14], "total price" => null, "status" => null], //give error
    ["store_id" => 1, "customer_id" => 0, "products" => ["product_id" => 2, "quantity" => 4], "total price" => null, "status" => null],
    ["store_id" => 0, "customer_id" => 1, "products" => ["product_id" => 1, "quantity" => 4], "total price" => null, "status" => null],
    ["store_id" => 0, "customer_id" => 3, "products" => ["product_id" => 4, "quantity" => 4], "total price" => null, "status" => null],
    ["store_id" => 0, "customer_id" => 3, "products" => ["product_id" => 4, "quantity" => 4], "total price" => null, "status" => null]
];

echo "<h3> Old Store Inventory</h3>";
echo "<pre>";
print_r($stores);
echo "</pre>";

// Obtaining the customer_ids
$processedCustomer_ids = [];
// for ($i = 0; $i < count($orders); $i++) {
//     $storeCustomer_ids[$i] = $orders[$i]["customer_id"];
// }


// cart implementation
$orderKeys = array_keys($orders);
$index = 0;
foreach ($orders as $order) {
    // Considering orders
    $customer_id = $order["customer_id"];
    $customerOrder_products = $order["products"];
    $customerOrder_product_id = $order["products"]["product_id"];
    $customerOrder_product_quantity = $order["products"]["quantity"];

    $total_price = &$orders[$index]["total price"];
    $order_status = &$orders[$index]["status"];

    $order_store_id = $order["store_id"];

    // Considering the customer
    $customer_name = $customers[$customer_id]["name"];
    $customer_email = $customers[$customer_id]["email address"];
    $customer_cart = &$customers[$customer_id]["cart"];


    // Considering the store
    $store = &$stores[$order_store_id]["products"][$customerOrder_product_id];
    $store_prod_name = $store["name"];
    $store_prod_stock = &$store["stock"];
    $store_prod_price = &$store["price"];

    if ($store_prod_stock <= 0) {
        $failedOrders[] = [
            "Product Name" => $store_prod_name,
            "Error Type" => "Failed to carry out the order.",
            "Reason" => "Insufficient stock of the product."
        ];
        continue;
    }

    // Processing the order
    if ($store_prod_stock - $customerOrder_product_quantity < 0) {
        $order_status = "CANCELLED!";
        $failedOrders[] =  [
            "Product Name" => $store_prod_name,
            "Product Stock" => $store_prod_stock,
            "Selected Order Quantity" => $customerOrder_product_quantity,
            "Error Type" => "Failed to carry out the order.",
            "Reason" => "Insufficient stock of the product. Ensure to reduce the quantity of items selected for this product.",
            "Current Order Status" => $order_status
        ];
    } else {
        if (array_search($customer_id, $processedCustomer_ids) === false) {
            $processedCustomer_ids[] = $customer_id; //adds the current customer_id to the list
        }
        $store_prod_stock -= $customerOrder_product_quantity; //processes the reduction of the stock
        if (array_search($customer_id, $processedCustomer_ids)) {
            $total_price += $store_prod_price * $customerOrder_product_quantity;
            $customer_cart[][] = ["Product Name" => $store_prod_name, "Purchased Qauntity" => $customerOrder_product_quantity, "Bill" => $total_price]; //dynamically append into cart if the user has performed a transaction before
            $order_status = "COMPLETED!";
        } else {
            $customer_cart = ["Product Name" => $store_prod_name, "Purchased Qauntity" => $customerOrder_product_quantity];
        }        // echo "Updated Product = " . $store_prod_name . "<br>";
    }

    $index++;
}

echo "<pre>";
print_r($orders);
echo "</pre>";


// echo "<h3> Updated Store Inventory</h3>";
// echo "<pre>";
// print_r($stores);
// echo "</pre>";

// echo "<h3> Failed Orders</h3>";
// echo "<pre>";
// print_r($failedOrders);
// echo "</pre>";

// echo "<pre>";
// print_r($stores[1]["name"]);
// echo "</pre>";
