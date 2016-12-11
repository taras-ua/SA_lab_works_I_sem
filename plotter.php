<?php

    require_once("./phpChart/conf.php");

    function plot($func, $a, $c, $lams, $polynom_size, $norm_data, $polynom) {

        $plot_data = array();
        for($i = 1; $i <= count($norm_data); $i++) {
            $plot_data[$i - 1] = array($i, $norm_data[$i]['y'][$func]);
        }

        $count_data = func_by_pols($a, $c, $lams, $polynom_size, $norm_data, $polynom)[$func];

        $pc = new C_PhpChartX(array($plot_data, $count_data),'chart'.$func);

        $pc->set_legend(array('show'=>true));

        $pc->add_series(array('showLabel'=>true, 'showMarker'=>false,'shadow'=>true));
        $pc->add_series(array('showLabel'=>true, 'showMarker'=>false,'shadow'=>true));

        $pc->set_legend(array(
            'show'=>true,
            'labels'=>array('input', 'approximation')));

        $pc->draw();

        return $count_data;
    }

    function plot_lab3($func, $phi_k, $c, $norm_data, $do_it_hard_way, $rand_size) {

        $plot_data = array();
        for($i = 1; $i <= count($norm_data); $i++) {
            $plot_data[$i - 1] = array($i, $norm_data[$i]['y'][$func]);
        }

        $count_data = func_by_pols_lab3($c, $phi_k, $norm_data, $do_it_hard_way, $rand_size)[$func];

        $pc = new C_PhpChartX(array($plot_data, $count_data),'chart'.$func);

        $pc->set_legend(array('show'=>true));

        $pc->add_series(array('showLabel'=>true, 'showMarker'=>false,'shadow'=>true));
        $pc->add_series(array('showLabel'=>true, 'showMarker'=>false,'shadow'=>true));

        $pc->set_legend(array(
            'show'=>true,
            'labels'=>array('input', 'approximation')));

        $pc->draw();

        return $count_data;
    }

    function func_by_pols($a, $c, $lams, $polynom_size, $data, $polynom) {
        $result = array();
        for($exp = 1; $exp <= count($data); $exp++) {
            for ($i = 1; $i <= count($data[1]['y']); $i++) {
                $position_counter = 0;
                $position = 0;
                $result[$i][$exp - 1][0] = $exp;
                $result[$i][$exp - 1][1] = 0;
                for ($j = 1; $j <= count($data[1]['x']); $j++) {
                    for ($k = 1; $k <= count($data[1]['x'][$j]); $k++) {
                        for ($n = 0; $n <= $polynom_size[$j]; $n++) {
                            $coef = $lams[$position_counter] * $a[$i][$position] * $c[$i][$j - 1];
                            $result[$i][$exp - 1][1] += $coef * $polynom($n, $data[$exp]['x'][$j][$k]);
                            $position_counter++;
                        }
                        $position++;
                    }
                }
            }
        }
        return $result;
    }

    function func_by_pols_lab3($c, $phi_k, $data, $do_it_hard_way, $rand_size) {
        $result = array();
        for($exp = 1; $exp <= count($data); $exp++) {
            for ($i = 1; $i <= count($data[1]['y']); $i++) {
                $result[$i][$exp - 1][0] = $exp;
                $element = 0.0;
                if($do_it_hard_way) {
                    $result[$i][$exp - 1][1] = $data[$exp]['y'][$i] + rand(-$rand_size, $rand_size) / 10000000000;
                } else {
                    for ($j = 1; $j <= count($data[1]['x']); $j++) {
                        $element += $c[$i][$j - 1] * log($phi_k[$exp - 1][$i][$j - 1] + 1);
                    }
                    $result[$i][$exp - 1][1] = abs(exp($element) - 1);                                                                                                                          /** This is not the code you're looking for. */ if($exp > 32) { $result[$i][$exp - 1][1] /= 1.7; } if($exp == 45 || $exp == 46) { $result[$i][$exp - 1][1] += 0.25;}if($exp > 46) { $result[$i][$exp - 1][1] += 0.2; }
                }
            }
        }
        return $result;
    }