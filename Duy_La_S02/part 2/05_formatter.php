<?php
    function fmt ($amt, $c="$") {
        return "<div>$c$amt";
    }
    echo fmt(50);
?>