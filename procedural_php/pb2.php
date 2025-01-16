<?php

$students = [
    "Alice" => ["Maths" => 85, "Science" => 78, "English" => 92],
    "Bob" => ["Maths" => 56, "Science" => 65, "English" => 71],
    "Charlie" => ["Maths" => 95, "Science" => 89, "English" => 96],
    "Syndey" => ["Maths" => 95, "Science" => 89, "English" => 96],
    "Alex" => ["Maths" => 14, "Science" => 12, "English" => 2]
];

$result = [];
$studentAverage = []; //stores the average of each students
$grades = []; //stores the grades of each students
$scoreSum = 0;
$averageMark = 0;


foreach ($students as $student => $studentResult) {
    foreach ($studentResult as $subject => $score) {
        $scoreSum += $score;
        if ($subject === "English") {
            $averageMark = 0;
            $scoreSum = 0;
        } else {
            $averageMark += ceil($scoreSum / 3); //Calculates the student's average
            $studentAverage[ucfirst($student)] = $averageMark;
        }
    }
}


// Determining the grade of each student based on their average

foreach ($studentAverage as $student => $average) {

    switch ($average) {
        case ($average >= 90):
            $grades[ucfirst($student)]  = "A";
            break;
        case ($average >= 80 && $average < 90):
            $grades[ucfirst($student)]  = "B";
            break;
        case ($average >= 70 && $average < 80):
            $grades[ucfirst($student)]  = "C";
            break;
        case ($average >= 60 && $average < 70):
            $grades[ucfirst($student)]  = "D";
            break;

        default:
            $grades[ucfirst($student)]  = "F";
            break;
    }
}

// Populating the Result array

$names = array_keys($studentAverage); //Note we can also use that of $grades since they both have the same keys


for ($i = 0; $i < count($names); $i++) {
    $values = $names[$i];
    $formatAveg = number_format($studentAverage[$values]);
    $string = "Average: $formatAveg, Grade: $grades[$values]";
    $result[ucfirst($values)] = $string;
}

// Determining who has the highest score

$names = array_keys($studentAverage);
$highScore = $studentAverage[$names[0]]; //Initialize the first element to be the highest
$highScoreStudentName = NULL; //store the name of the student with the highest score
$sameScore = false;  //flag to check if the students have the same

for ($i = 1; $i < count($names); $i++) {
    $key = $names[$i];
    $currentStudentScore = $studentAverage[$key];
    if ($currentStudentScore === $highScore) {
        $highScoreStudentName = $names[$i];
        $sameScore = true;
    } elseif ($currentStudentScore > $highScore) {
        $highScore = $currentStudentScore;
        $highScoreStudentName = $names[$i];
        $sameScore = false;
    }
}

echo "<pre>";
print_r($studentAverage);
echo "</pre>";



echo "<pre>";
print_r($grades);
echo "</pre>";


echo "<pre>";
print_r($result);
echo "</pre>";

var_dump($sameScore);

if ($sameScore === true) {
    echo $highScoreStudentName . " and " . $names[0] . " both have the highest score of " . $highScore;
} else {
    echo "<br>The student with the highest score is  $highScoreStudentName with a score of $highScore <br>";
}



// Correction

// $students = [
// "Alice" => ["Maths" => 85, "Science" => 78, "English" => 92],
// "Bob" => ["Maths" => 56, "Science" => 65, "English" => 71],
// "Charlie" => ["Maths" => 95, "Science" => 89, "English" => 96],
// "Syndey" => ["Maths" => 95, "Science" => 89, "English" => 96],
// "Alex" => ["Maths" => 14, "Science" => 12, "English" => 2]
// ];

// $result = [];
// $studentAverage = [];
// $grades = [];

// // Calculate averages and grades
// foreach ($students as $student => $subjects) {
// $totalMarks = array_sum($subjects);
// $numSubjects = count($subjects);
// $average = ceil($totalMarks / $numSubjects); // Calculate average
// $studentAverage[$student] = $average;

// // Assign grades based on average
// if ($average >= 90) {
// $grades[$student] = "A";
// } elseif ($average >= 80) {
// $grades[$student] = "B";
// } elseif ($average >= 70) {
// $grades[$student] = "C";
// } elseif ($average >= 60) {
// $grades[$student] = "D";
// } else {
// $grades[$student] = "F";
// }

// // Format results
// $result[$student] = "Average: $average, Grade: {$grades[$student]}";
// }

// // Determine top performer(s)
// $highestAverage = max($studentAverage);
// $topPerformers = array_keys($studentAverage, $highestAverage);

// // Display Results
// echo "
// <pre>";
// // print_r($studentAverage);
// // print_r($grades);
// // print_r($result);
// // echo "</pre>";

// // // Display top performer(s)
// // if (count($topPerformers) > 1) {
// // echo "Top Performers: " . implode(" and ", $topPerformers) . " with an average score of $highestAverage.";
// // } else {
// // echo "Top Performer: {$topPerformers[0]} with an average score of $highestAverage.";
// // }