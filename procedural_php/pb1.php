<?php

$employees = ["Alice" => 3000, "Bob" => 2500, "Charlie" => 4000];

$result = [];
$bonus = 0.00;
$total = 0.00;

foreach ($employees as $key => $value) {

    if ($value < 3000) { //Gets the bonus and total value for the salaries of employees below 3000
        $bonus = ceil(0.2 * $value);
        $total = $value + $bonus;
        $string = "Salary: $value, Bonus: $bonus, Total: $total";
        $name = ucfirst($key);
        $result[$name] = $string;
    } else { //Gets the bonus and total value for the salaries of employees above or equal to 3000
        $bonus = ceil(0.1 * $value);
        $total = $value + $bonus;
        $string = "Salary: $value, Bonus: $bonus, Total: $total";
        $name = ucfirst($key);
        $result[$name] = $string;
    }
}

// Displays the result
echo "<pre>";
print_r($result);
echo "</pre>";


/*
Second Variation

<?php

$employees = ["Alice" => 3000, "Bob" => 2500, "Charlie" => 4000];

$result = [];

foreach ($employees as $key => $value) {
    // Calculate bonus
    $bonus = ($value < 3000) ? ceil(0.2 * $value) : ceil(0.1 * $value);
    $total = $value + $bonus;

    // Format output string
    $formattedSalary = number_format($value, 2);
    $formattedBonus = number_format($bonus, 2);
    $formattedTotal = number_format($total, 2);
    $string = "Salary: $formattedSalary, Bonus: $formattedBonus, Total: $formattedTotal";

    // Add to result array with ucfirst name
    $name = ucfirst($key);
    $result[$name] = $string;
}

// Display the result
echo "<pre>";
print_r($result);
echo "</pre>";

 */
