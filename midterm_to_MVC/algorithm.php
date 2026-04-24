<?php
    $conditions = [
        "where" => [
            "name" => "Harry Potter and Soccerer's Stone",
            "copies" => 3
        ],
        "limit" => 1,
        "order by" => "desc"
    ];
    $tableName = "books";

    $keys = array_keys($conditions);
    $vals = array_values($conditions);
    foreach ($keys as $key) {
        echo "<div>{$key}</div>";
    }
    foreach ($vals as $val) {
        echo "<div>{$val}</div>";
    }

    $where = implode(" and ", array_map(function ($key) {return "{$key} = {$key}";}, $keys));
    echo "<div>{$where}</div>";

    $check = gettype($conditions["where"]);
    echo "<div>{$check}</div>";
    $components = [];
    foreach ($keys as $key) {
        if (gettype($conditions[$key]) == "array") {
            echo "<div>{$key} -> multiple</div>";
            $subKeys = array_keys($conditions[$key]);
            $subVals = array_values($conditions[$key]);
            for ($i = 0; $i < count($subKeys); $i++) {
                echo "<div>{$subKeys[$i]} -> {$subVals[$i]}</div>";
            }
            $subQuery = implode(" and ", array_map(function ($key) {return "{$key} = :{$key}";}, $subKeys));
            echo "<div>{$subQuery}</div>";
            $components[$key] = $key . " " . $subQuery;
        } else {
            $subQuery = "{$key} {$conditions[$key]}";
            $components[$key] = $subQuery;
        }
    }
    echo "</br></br>";

    $query = "select
                *
            from {$tableName}";
    for ($i = 0; $i < count($keys); $i++) {
        echo "<div>{$components[$keys[$i]]}</div>";
        $query .= " ";
        $query .= $components[$keys[$i]];
    }
    echo "<div>$query</div>";
?>