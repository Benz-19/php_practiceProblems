<?php


$seating = [
    ["Available", "Booked", "Booked"],
    ["Available", "Available", "Booked"],
    ["Available", "Available", "Booked"],
    ["Available", "Booked", "Booked"],
    ["Booked", "Available", "Available"],
    ["Available", "Available", "Available"]
];


$requests = [
    ["row" => 2, "seat" => 1, "action" => "book"], //changes to booked
    ["row" => 4, "seat" => 0, "action" => "book"],
    ["row" => 1, "seat" => 1, "action" => "cancel"], //Remains available
    ["row" => 2, "seat" => 2, "action" => "cancel"], //changes to available
    ["row" => 2, "seat" => 0, "action" => "book"], //changes to booked
    ["row" => 0, "seat" => 1, "action" => "book"], //error
    ["row" => 1, "seat" => 0, "action" => "cancel"], //Remains available
    ["row" => 5, "seat" => 1, "action" => "cancel"], //Remains available
    ["row" => 3, "seat" => 2, "action" => "book"], //Remains booked
    ["row" => 4, "seat" => 0, "action" => "cancel"] //changes to available
];


$failedRequests = [];
echo "<h3> Previous Seat Information </h3>";
echo "<pre>";
print_r($seating);
echo "</pre>";
foreach ($requests as $request) {
    $row = $request["row"];
    $seat = $request["seat"];
    $action = $request["action"];

    $planeSeat = &$seating[$row][$seat];

    if (!isset($planeSeat)) {
        $failedRequests[] = [
            "Error Type" => "Failed to carry out booking.",
            "Reason" => "Current Id does not exists!",
        ];
        continue;
    }

    if ($planeSeat === "Booked" && $request["action"] === "book") {
        // means already booked
        $failedRequests[] = [
            "Error Type" => "Failed to carrout booking.",
            "Reason" => "Current seat is already booked! Select another seat.",
            "Requested Row Number" => $row,
            "Requested Seat Number" => $seat,
        ];
        continue;
    } elseif ($planeSeat === "Available" && $request["action"] === "book") {
        $planeSeat = "Booked";
    } elseif ($planeSeat === "Booked" && $request["action"] === "cancel") {
        $planeSeat = "Available";
    } else {
        $failedRequests[] = [
            "Error Type" => "Internal Error.",
            "Reason" => "Something went wrong... Please try again!"
        ];
    }
}




echo "<h3> Updated Seat Information </h3>";
echo "<pre>";
print_r($seating);
echo "</pre>";


echo "<h3> Failed Requests </h3>";
echo "
<pre>";
print_r($failedRequests);
echo "</pre>";
