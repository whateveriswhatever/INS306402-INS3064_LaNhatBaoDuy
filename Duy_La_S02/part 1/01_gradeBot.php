<?php
    $x = 69;
    $grade = "";
    if ($x >= 90) {
        $grade = "<div>Grade: A</div>";
    } else if ($x >= 80) {
        $grade = "<div>Grade: B</div>";
    } else if ($x >= 70) {
        $grade = "<div>Grade: C</div>";
    } else {
        $grade = "<div>Grade: F</div>";
    }
    echo $grade;
?>