<?php

    function normalizeInput($data) {
        $maxes = array('x' => array(), 'y' => array());
        $mins = array('x' => array(), 'y' => array());
        # Finding mins and maxes ...
        for ($k=1; $k <= count($data); $k++) {
            for ($i=1; $i <= count($data[$k]['x']); $i++) {
                for ($j=1; $j <= count($data[$k]['x'][$i]); $j++) {
                    if(!isset($maxes['x'][$i][$j]) or $maxes['x'][$i][$j] < $data[$k]['x'][$i][$j]) {
                        $maxes['x'][$i][$j] = $data[$k]['x'][$i][$j];
                    }
                    if(!isset($mins['x'][$i][$j]) or $mins['x'][$i][$j] > $data[$k]['x'][$i][$j]) {
                        $mins['x'][$i][$j] = $data[$k]['x'][$i][$j];
                    }
                }
            }
            for ($i=1; $i <= count($data[1]['y']); $i++) {
                if(!isset($maxes['y'][$i]) or $maxes['y'][$i] < $data[$k]['y'][$i]) {
                    $maxes['y'][$i] = $data[$k]['y'][$i];
                }
                if(!isset($mins['y'][$i]) or $mins['y'][$i] > $data[$k]['y'][$i]) {
                    $mins['y'][$i] = $data[$k]['y'][$i];
                }
            }
        }
        # Normalizing ...
        for ($k=1; $k <= count($data); $k++) {
            for ($i=1; $i <= count($data[$k]['x']); $i++) {
                for ($j=1; $j <= count($data[$k]['x'][$i]); $j++) {
                    $data[$k]['x'][$i][$j] = ($data[$k]['x'][$i][$j] - $mins['x'][$i][$j]) / ($maxes['x'][$i][$j] - $mins['x'][$i][$j]);
                }
            }
            for ($i=1; $i <= count($data[$k]['y']); $i++) {
                $data[$k]['y'][$i] = ($data[$k]['y'][$i] - $mins['y'][$i]) / ($maxes['y'][$i] - $mins['y'][$i]);
            }
        }
        return $data;
    }

    function trans($A) {
        $At = array();
        for($i = 0; $i < count($A); $i++) {
            for($j = 0; $j < count($A[$i]); $j++) {
                $At[$j][$i] = $A[$i][$j];
            }
        }
        return $At;
    }

    function array_mul_array($A, $B) {
        $R = array();
        for($i = 0; $i < count($A); $i++) {
            $R[$i] = array();
            for($j = 0; $j < count($B[$i]); $j++) {
                $R[$i][$j] = 0;
                for($k = 0; $k < count($A[$i]); $k++) {
                    for($l = 0; $l < count($B); $l++) {
                        $R[$i][$j] += $A[$i][$k] * $B[$k][$j];
                    }
                }
            }
        }
        return $R;
    }

    function array_mul_vec($A, $x) {
        $result = array();
        for($i = 0; $i < count($A); $i++) {
            $result[$i] = 0;
            for($j = 0; $j < count($A[$i]); $j++) {
                $result[$i] += $A[$i][$j] * $x[$j];
            }
        }
        return $result;
    }

    function vec_minus($x1, $x2) {
        for($i = 0; $i < count($x1); $i++) {
            $x1[$i] -= $x2[$i];
        }
        return $x1;
    }

    function system_mismatch($A, $b, $x) {
        return vec_minus(array_mul_vec($A, $x), $b);
    }

    function vec_norm($x) {
        $norm = 0.0;
        for($i = 0; $i < count($x); $i++) {
            $norm += $x[$i] * $x[$i];
        }
        return sqrt($norm);
    }

    function const_mul_vec($const, $vec) {
        for($i = 0; $i < count($vec); $i++) {
            $vec[$i] *= $const;
        }
        return $vec;
    }

    function vec_mul_vec($x1, $x2) {
        $result = 0.0;
        for($i = 0; $i < count($x1); $i++) {
            $result += $x1[$i] * $x2[$i];
        }
        return $result;
    }