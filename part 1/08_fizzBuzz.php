<?php
    for ($i = 0; $i <= 50; $i++) {
        if ($i % 3 === 0) {
            echo "<div>Fizz</div>";
        } else if ($i % 5 === 0) {
            echo "<div>Buzz</div>";
        } else if ($i % 3 === 0 && $i % 5 === 0) {
            echo "<div>FizzBuzz</div>";
        } else {
            echo "<div>$i</div>";
        }   
    }
?>