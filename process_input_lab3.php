<?php


    function getInput($params, $param_dim, $functions) {

        if($_FILES['file']['error'] > 0) {
            return array('error' => $_FILES['file']['error']);
        }

        $file = fopen($_FILES["file"]["tmp_name"], 'r');
        $result = array();
        $experiment_count = 1;
        while(!feof($file)) {
            $new_line = fgets($file);
            if($new_line == null) {
                continue;
            }
            if($new_line != $experiment_count) {
                return array('broken_file' => true);
            }
            $input_values = array();
            for ($j=1; $j <= $params ; $j++) {
                for ($k=1; $k <= $param_dim[$j]; $k++) {
                    if(!feof($file)) {
                        $new_line = fgets($file);
                    } else {
                        return array('broken_file' => true);
                    }
                    $input_values['x'][$j][$k] = (double) $new_line;
                }
            }
            for ($k=1; $k <= $functions; $k++) {
                if(!feof($file)) {
                    $new_line = fgets($file);
                } else {
                    return array('broken_file' => true);
                }
                $input_values['y'][$k] = (double) $new_line;
            }
            $result[$experiment_count] = $input_values;
            $experiment_count++;
        }

        fclose($file);
        return $result;
    }

    function getDefaultInput() {

        $experiments = 48;
        $params = 3;
        $param_dim = 2;
        $functions = 2;

        $file = fopen('./vybirka_ka12_lab3.txt', 'r');
        $result = array();
        for ($i=1; $i <= $experiments; $i++) {
            $new_line = fgets($file);
            if($new_line != $i) {
                return array('broken_file' => true);
            }
            $input_values = array();
            for ($j=1; $j <= $params ; $j++) {
                for ($k=1; $k <= $param_dim; $k++) {
                    $new_line = fgets($file);
                    $input_values['x'][$j][$k] = (double) $new_line;
                }
            }
            for ($k=1; $k <= $functions; $k++) {
                $new_line = fgets($file);
                $input_values['y'][$k] = (double) $new_line;
            }
            $result[$i] = $input_values;
        }

        fclose($file);
        return $result;
    }