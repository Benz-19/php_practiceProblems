<?php

$students = [
    "Alice" => ["Maths" => 85, "Science" => 78, "English" => 92],
    "Bob" => ["Maths" => 56, "Science" => 65, "English" => 71],
    "Charlie" => ["Maths" => 95, "Science" => 89, "English" => 96],
    "Syndey" => ["Maths" => 95, "Science" => 89, "English" => 96],
    "Alex" => ["Maths" => 14, "Science" => 12, "English" => 2]
];

$averageScore = [];
$result = [];
$grades = [];


foreach ($students as $student => $subject) {

    $totalMark = array_sum($subject);
    $totalSubjects = count($subject);
    $avg = ceil($totalMark / $totalSubjects);
    $averageScore[ucfirst($student)] = $avg;

    if ($avg > 90) {
        $grades[$student] = "A";
    } elseif ($avg >= 80 && $avg < 90) {
        $grades[$student] = "B";
    } elseif ($avg >= 70 && $avg < 80) {
        $grades[$student] = "C";
    } elseif ($avg >= 60 && $avg < 70) {
        $grades[$student] = "D";
    } else {
        $grades[$student] = "F";
    }

    $result[$student] = "Average: $avg, Grade: $grades[$student]";
}

// results
echo "<pre>";
print_r($averageScore);
echo "</pre>";

echo "<pre>";
print_r($grades);
echo "</pre>";

echo "<pre>";
print_r($result);
echo "</pre>";

// Get the TOP Performer(s)

$maxScore = max($averageScore);
$topPerformers = array_keys($averageScore, $maxScore);

if (count($topPerformers) > 1) {
    echo "The Top performers in the class are " . implode(" , ", $topPerformers) . " with the score " . $maxScore;
} else {
    echo "The Top performer is " . $topPerformers[0] . " with a score of " . $maxScore;
}
