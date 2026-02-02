<?php
    function calculateBMI($kg, $m) {
        $BMI = $kg / ($m * $m);
        
        if ($BMI < 18.5) {
            return "BMI: $BMI (Under)";
        } else if ($BMI >= 18.5 && $BMI <= 24.9) {
            return "BMI: $BMI (Normal)";
        } else {
            return "BMI: $BMI (Over)";
        }
    }

    $test = calculateBMI(63, 168);
    echo $test;
?>