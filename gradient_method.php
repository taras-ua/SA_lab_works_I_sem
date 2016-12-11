<?php

include 'common.php';
include 'methods_lab2.php';
include 'methods_lab3.php';

define("EPS", 0.001);

function step_length($A, $b, $lams) {
    $mismatch = system_mismatch($A, $b, $lams);
    return vec_mul_vec($mismatch, $mismatch) / vec_mul_vec(array_mul_vec($A, $mismatch), $mismatch);
}

function grad_method($A, $b, $l0) {
    $lam = $l0;
    $r = system_mismatch($A, $b, $lam);
//    $steps = 0;
    while(vec_norm($r) > EPS) {
        $alpha = step_length($A, $b, $lam);
        $lam = vec_minus($lam, const_mul_vec($alpha, $r));
        $r = system_mismatch($A, $b, $lam);
//        echo ++$steps . '. ' . vec_norm($r) . '<br>';
    }
    return $lam;
}

function b_as_avg($data) {
    $result = array();
    for($i = 1; $i <= count($data); $i++) {
        $max = $data[$i]['y'][1];
        $min = $data[$i]['y'][1];
        for ($j = 2; $j <= count($data[$i]['y']); $j++) {
            if ($max < $data[$i]['y'][$j]) {
                $max = $data[$i]['y'][$j];
            }
            if ($min > $data[$i]['y'][$j]) {
                $min = $data[$i]['y'][$j];
            }
        }
        $result[$i - 1] = ($max + $min) / 2;
    }
    return $result;
}

function b_as_y($data, $n) {
    $result = array();
    for($i = 1; $i <= count($data); $i++) {
        $result[$i - 1] = $data[$i]['y'][$n];
    }
    return $result;
}

function A_matrix_for_lamda($polinom, $p, $data) {
    $matrix = array();
    for($m = 1; $m <= count($data); $m++) {
        $matrix[$m - 1] = array();
        $position_counter = 0;
        for($i = 1; $i <= count($data[1]['x']); $i++) {
            for($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
                for($k = 0; $k <= $p[$i]; $k++) {
                    $matrix[$m - 1][$position_counter] = $polinom($k, $data[$m]['x'][$i][$j]);
                    $position_counter++;
                }
            }
        }
    }
    return $matrix;
}

function A_matrix_for_lamda_separete($polinom, $p, $data, $i) {
    $matrix = array();
    for($m = 1; $m <= count($data); $m++) {
        $matrix[$m - 1] = array();
        $position_counter = 0;
        for($j = 1; $j <= count($data[$m]['x'][$i]); $j++) {
            for($k = 0; $k <= $p; $k++) {
                $matrix[$m - 1][$position_counter] = $polinom($k, $data[$m]['x'][$i][$j]);
                $position_counter++;
            }
        }
    }
    return $matrix;
}

function solve_all_lambdas($polinom, $p, $data) {
    $lambdas = array();
    $position_counter = 0;
    for($i = 1; $i <= count($data[1]['x']); $i++) {
        for($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
            for($k = 0; $k <= $p[$i]; $k++) {
                $lambdas[$position_counter] = 0.006;
                $position_counter++;
            }
        }
    }
    $matrix_A = A_matrix_for_lamda($polinom, $p, $data);
    $vector_b = b_as_avg($data);
    $trans_A = trans($matrix_A);
    $At_A = array_mul_array($trans_A, $matrix_A);
    $At_b = array_mul_vec($trans_A, $vector_b);
    $lambdas = grad_method($At_A, $At_b, $lambdas);
    return $lambdas;
}

function solve_separate_lambdas($polinom, $p, $data) {
    $lambdas = array();
    for($i = 1; $i <= count($data[1]['x']); $i++) {
        $position_counter = 0;
        $lambdas[$i] = array();
        for($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
            for($k = 0; $k <= $p[$i]; $k++) {
                $lambdas[$i][$position_counter] = 0.01;
                $position_counter++;
            }
        }
    }

    for($i = 1; $i <= count($data[1]['x']); $i++) {
        $matrix_A = A_matrix_for_lamda_separete($polinom, $p[$i], $data, $i);
        $vector_b = b_as_avg($data);
        $trans_A = trans($matrix_A);
        $At_A = array_mul_array($trans_A, $matrix_A);
        $At_b = array_mul_vec($trans_A, $vector_b);
        $lambdas[$i] = grad_method($At_A, $At_b, $lambdas[$i]);
    }

    $result = array();
    $position_counter = 0;
    for($i = 1; $i <= count($lambdas); $i++) {
        for($j = 0; $j < count($lambdas[$i]); $j++) {
            $result[$position_counter] = $lambdas[$i][$j];
            $position_counter++;
        }
    }

    return $result;
}



function solve_a_matrices($lams, $p, $data, $polinom) {
    $a = array();
    for($i = 1; $i <= count($data[1]['y']); $i++) {
        $a[$i] = array();

        $position = 0;
        for($j = 1; $j <= count($data[1]['x']); $j++) {
            for($k = 1; $k <= count($data[1]['x'][$j]); $k++) {
                $a[$i][$position] = 0.1;
                $position++;
            }
        }
        $matrix_A = psi_A_matrix($lams, $polinom, $p, $data);
        $vector_b = b_as_y($data, $i);
        $trans_A = trans($matrix_A);
        $At_A = array_mul_array($trans_A, $matrix_A);
        $At_b = array_mul_vec($trans_A, $vector_b);
        $a[$i] = grad_method($At_A, $At_b, $a[$i]);

    }
    return $a;
}

function solve_c_matrices($a, $lams, $p, $data, $polinom)
{
    $c = array();
    for ($i = 1; $i <= count($data[1]['y']); $i++) {
        $c[$i] = array();

        for ($j = 1; $j <= count($data[1]['x']); $j++) {
            $c[$i][$j - 1] = 0.1;
        }

        $matrix_A = phi_A_matrix($a[$i], $lams, $polinom, $p, $data);
        $vector_b = b_as_y($data, $i);
        $trans_A = trans($matrix_A);
        $At_A = array_mul_array($trans_A, $matrix_A);
        $At_b = array_mul_vec($trans_A, $vector_b);
        $c[$i] = grad_method($At_A, $At_b, $c[$i]);

    }
    return $c;
}

function solve_a_lab3($psi, $data, $chosen_f) {
    $a = array();
    $matrix_A = Phi_k_A_matrix($psi, $data, $chosen_f);
    $trans_A = trans($matrix_A);
    $At_A = array_mul_array($trans_A, $matrix_A);
    for($i = 1; $i <= count($data[1]['y']); $i++) {
        $a[$i] = array();

        $position = 0;
        for($j = 1; $j <= count($data[1]['x']); $j++) {
            for($k = 1; $k <= count($data[1]['x'][$j]); $k++) {
                $a[$i][$position] = 0.1;
                $position++;
            }
        }
        $vector_b = b_lab3($data, $i);
        $At_b = array_mul_vec($trans_A, $vector_b);
        $a[$i] = grad_method($At_A, $At_b, $a[$i]);

    }
    return $a;
}

function solve_c_lab3($phi, $data, $chosen_f) {
    $c = array();
    for($i = 1; $i <= count($data[1]['y']); $i++) {
        $c[$i] = array();

        $position = 0;
        for($j = 1; $j <= count($data[1]['x']); $j++) {
                $c[$i][$position] = 0.1;
                $position++;
        }
        $matrix_A = phi_A_matrix_lab3($phi, $i, $data, $chosen_f);
        $trans_A = trans($matrix_A);
        $At_A = array_mul_array($trans_A, $matrix_A);
        $vector_b = b_lab3($data, $i);
        $At_b = array_mul_vec($trans_A, $vector_b);
        $c[$i] = grad_method($At_A, $At_b, $c[$i]);

    }
    return $c;
}

function make_magic($c) {
    for($i = 1; $i <= count($c); $i++) {
        $c[$i] = const_mul_vec(50, $c[$i]);
    }
    return $c;
}