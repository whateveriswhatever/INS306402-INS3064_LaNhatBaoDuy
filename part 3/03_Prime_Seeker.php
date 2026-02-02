<?php
    function isPrime($x) {
        // Calculate the square root
        // $sqrt = sqrt($x);
        if ($x <= 1) return "<div>$x is not prime</div>";
        if ($x === 2) return "<div>$x is prime</div>";

        for ($i = 2; $i <= sqrt($x); $i++) {
            if ($x % $i === 0) {
                return "<div>$x is not prime</div>";
            }
        }

        return "<div>$x is prime</div>";
    }

    // for ($i = 0; $i <= 100; $i++) {

    // }
    $test1 = isPrime(77);
    $test2 = isPrime(83);
    echo $test1;
    echo $test2;
    
?>