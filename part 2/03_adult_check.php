<?php
    function isAdult($age) {
        $status = ($age >= 18) ? "adult" : "minor";
        return "<div>$status</div>";
    }
    echo isAdult(20);
?>