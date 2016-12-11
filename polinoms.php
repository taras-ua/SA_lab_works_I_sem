<?php

function Lejandr($n, $x) {
    if($n === 0) {
        return 0.5;
    } elseif($n === 1) {
        return $x;
    } else {
        $n--;
        return ((2 * $n + 1) * $x * Lejandr($n, $x) - $n * Lejandr($n - 1, $x)) / ($n + 1);
    }
}

function Lagger($n, $x) {
    if($n === 0) {
        return 0.5;
    } elseif($n === 1) {
        return 1 - $x;
    } else {
        $n--;
        return (2 * $n + 1 - $x) * Lagger($n, $x) - $n * $n * Lagger($n - 1, $x);
    }
}

function Ermit($n, $x) {
    if($n === 0) {
        return 1;
    } elseif($n === 1) {
        return 2 * $x;
    } else {
        $n--;
        return 2 * $x * Ermit($n, $x) - 2 * $n * Ermit($n - 1, $x);
    }
}

function Chebyshev($n, $x) {
    if($n === 0) {
        return 0.5;
    } elseif($n === 1) {
        return 2 * $x - 1;
    } else {
        $n--;
        return 2 * (2 * $x - 1) * Chebyshev($n, $x) - Chebyshev($n - 1, $x);
    }
}