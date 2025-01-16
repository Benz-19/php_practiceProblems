<?php

$books = [
    "Prog_Fundamentals" => ["Author" => "Kingsley", "Copies" => 4],
    "Differential_Rules" => ["Author" => "Aiden", "Copies" => 1],
    "Testing_Methods" => ["Author" => "Charlie", "Copies" => 12],
    "Arrangement_Technique" => ["Author" => "Anthony Rutherford", "Copies" => 16]
];

$borrowRequests = [
    ["Title" => "Testing_Methods", "Borrower" => "Alex"],
    ["Title" => "Testing_Methods", "Borrower" => "Bob"],
    ["Title" => "Prog_Fundamentals", "Borrower" => "Stephenie"],
    ["Title" => "Prog_Fundamentals", "Borrower" => "Alex"],
    ["Title" => "Arrangement_Technique", "Borrower" => "Alex"],
    ["Title" => "Differential_Rules", "Borrower" => "Alex"]
];

$borrowedBooks = [];

ksort($books);
sort($borrowRequests);

foreach ($borrowRequests as $request) {
    $borrowerName = $request["Borrower"];
    $title = $request["Title"];

    if (isset($books[$title]) && $books[$title]["Copies"] >= 0) {
        $borrowedBooks[$title][] = $borrowerName; //Dynamically append a new value to the end of the array
        $books[$title]["Copies"]--;
    }
}


// Updated Books
echo "<pre>";
print_r($books);
echo "</pre>";


// Borrowed books
echo "<pre>";
print_r($borrowedBooks);
echo "</pre>";
