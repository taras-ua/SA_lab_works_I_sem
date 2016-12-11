<?php

    function psi_A_matrix($lams, $polinom, $p, $data) {
        $matrix = array();
        for($m = 1; $m <= count($data); $m++) {
            $matrix[$m - 1] = array();
            $position_counter = 0;
            $position_in_matrix = 0;
            for($i = 1; $i <= count($data[1]['x']); $i++) {
                for($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
                    $sum = 0.0;
                    for($k = 0; $k <= $p[$i]; $k++) {
                        //$sum += $polinom($k, $lams[$position_counter]);
                        $sum += $lams[$position_counter]*$polinom($k, $data[$m]['x'][$i][$j]);
                        $position_counter++;
                    }
                    $matrix[$m - 1][$position_in_matrix] = $sum;
                    $position_in_matrix++;
                }
            }
        }
        return $matrix;
    }

    function phi_A_matrix($a, $lams, $polinom, $p, $data) {
        $matrix = array();
        for($m = 1; $m <= count($data); $m++) {
            $matrix[$m - 1] = array();
            $position_counter = 0;
            $position_in_matrix = 0;
            $bla = -1;
            for($i = 1; $i <= count($data[1]['x']); $i++) {
                $sum = 0.0;
                for($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
                    $bla+=1;
                    for($k = 0; $k <= $p[$i]; $k++) {
                        //$sum += $polinom($k, $lams[$position_counter]);
                        $sum += $a[$bla] * $lams[$position_counter] * $polinom($k, $data[$m]['x'][$i][$j]);
                        $position_counter++;
                    }
                }
                $matrix[$m - 1][$position_in_matrix] = $sum;
                $position_in_matrix++;
            }
        }
        return $matrix;
    }
