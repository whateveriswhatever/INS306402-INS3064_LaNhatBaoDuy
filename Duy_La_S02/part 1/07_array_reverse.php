<?php
    $arr = [1, 2, 3, 4, 5, 6];
    $reversed_arr = [];

    while (count($arr) > 0) {
        $last = array_pop($arr);
        array_push($reversed_arr, $last);
    }
    echo "<div> [";
    for ($i = 0; $i < count($reversed_arr); $i++) {
        if ($i === (count($reversed_arr) - 1)) {
            echo "$reversed_arr[$i]";
        } else {
            echo "$reversed_arr[$i], ";
        }
    }
    echo "]</div>";
?>