<?php
function rollDive($throws) {
    while($throws) {
        $results[] = random_int(1,6);
        $throws--;
    }
    return $results;
}

print_r(rollDice(5));