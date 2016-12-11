                                                        <?php

                                                            function phi_A_matrix_lab3($Phi, $number_of_y, $data, $chosen_f) {
                                                                $matrix = array();
                                                                for($m = 1; $m <= count($data); $m++) {
                                                                    $matrix[$m - 1] = array();
                                                                    $position_in_matrix = 0;
                                                                    for($i = 1; $i <= count($data[1]['x']); $i++) {
                                                                        $element = $chosen_f($Phi[$m - 1][$number_of_y][$i - 1]);
                                                                        $matrix[$m - 1][$position_in_matrix] = $element;
                                                                        $position_in_matrix++;
                                                                    }
                                                                }
                                                                return $matrix;
                                                            }

                                                            function log_og_b($b){
                                                                for($i=0; $i < count($b); $i++){
                                                                    $b[$i] = log($b[$i]);
                                                                }
                                                            }

                                                            function psi_matrix_lab3($lambdas, $polinom_size, $data, $polinom, $chosen_func) {
                                                                $result = array();
                                                                for($i = 1; $i <= count($data); $i++) {
                                                                    $result[$i] = array();
                                                                    $position_in_lambda = 0;
                                                                    for($j = 1; $j <= count($data[$i]['x']); $j++) {
                                                                        $result[$i][$j] = array();
                                                                        for($k = 1; $k <= count($data[$i]['x'][$j]); $k++) {
                                                                            $sum = 0.0;
                                                                            for($p = 0; $p <= $polinom_size[$j]; $p++) {
                                                                                $sum += $chosen_func($polinom($p, $data[$i]['x'][$j][$k]));
                                                                                $sum *= $lambdas[$position_in_lambda];
                                                                                $position_in_lambda++;
                                                                            }
                                                                            $result[$i][$j][$k] = $sum;
                                                                        }
                                                                    }
                                                                }
                                                                return $result;
                                                            }

                                                            function phi_k_A_matrix($Psi, $data, $chosen_f){
                                                                $matrix = array();
                                                                for($m = 1; $m <= count($data); $m++) {
                                                                    $matrix[$m - 1] = array();
                                                                    $position_in_matrix = 0;
                                                                    for($i = 1; $i <= count($data[1]['x']); $i++) {
                                                                        for ($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
                                                                            $matrix[$m - 1][$position_in_matrix] = $chosen_f($Psi[$m][$i][$j]);
                                                                            $position_in_matrix++;
                                                                        }
                                                                    }
                                                                }
                                                                return $matrix;
                                                            }

                                                            function b_lab3($data, $y) {
                                                                $b = array();
                                                                for($i = 1; $i <= count($data); $i++) {
                                                                    $b[$i - 1] = log($data[$i]['y'][$y] + 1);
                                                                }
                                                                return $b;
                                                            }


                                                            function definition_of_Phi_k($matrix_Of_a, $Psi, $data, $chosen_f){
                                                                $matrix = array();
                                                                for($m = 1; $m <= count($data); $m++) {
                                                                    $matrix[$m - 1] = array();
                                                                    for ($y = 1; $y <= count($data[1]['y']); $y++) {
                                                                        $position_in_matrix = 0;
                                                                        $bla = 0;
                                                                        for ($i = 1; $i <= count($data[1]['x']); $i++) {
                                                                            $sum = 0.0;
                                                                            for ($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
                                                                                $sum += $matrix_Of_a[$y][$bla] * $chosen_f($Psi[$m][$i][$j]);
                                                                                $bla += 1;
                                                                            }
                                                                            $matrix[$m - 1][$y][$position_in_matrix] = $sum;
                                                                            $position_in_matrix++;
                                                                        }
                                                                    }
                                                                }
                                                                return $matrix;
                                                            }