<?php
    function safeDivision($x, $y) {
        if ($y === 0) return "<div>null</div>";
        $res = $x / $y;
        return "<div>$x / $y = $res</div>";
    }

    echo safeDivision(10, 0);
?>