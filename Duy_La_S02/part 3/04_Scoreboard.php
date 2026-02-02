<?php
    $arr = [4, 1, 5, 6, 9, 7, 3, 2, 96, 69];

    $avg = 0;
    $max = -999999;
    $min = 9999999;
    for ($i = 0; $i < count($arr); $i++) {
        $avg += $arr[$i];
        if ($max < $arr[$i]) {
            $max = $arr[$i];
        }
        if ($min > $arr[$i]) {
            $min = $arr[$i];
        }
    }
    $avg /= count($arr);

    echo "<div>Avg: $avg, Top: [$min, $max]</div>";
?>