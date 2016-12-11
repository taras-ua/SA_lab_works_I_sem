<?php
	
	function printInput($data) {
		echo '<br><div style="color: #003366; font-size: 14px;"><table id="data_table">';
		echo '<tr><td><b>q</b></td>';
		for ($i=1; $i <= count($data[1]['x']); $i++) {
			for ($j=1; $j <= count($data[1]['x'][$i]); $j++) { 
			 	echo '<td><b>x'.$i.$j.'</b></td>';
			} 
		}
		for ($i=1; $i <= count($data[1]['y']); $i++) {
			echo '<td><b>y'.$i.'</b></td>';
		}
		echo '</tr>';
		for ($k=1; $k <= count($data); $k++) { 
			echo '<tr'.($k % 2 == 1 ? ' style="background: #ccc;"' : '').'><td><b>'.$k.'</b></td>';
			for ($i=1; $i <= count($data[$k]['x']); $i++) {
				for ($j=1; $j <= count($data[$k]['x'][$i]); $j++) { 
				 	echo '<td>'.round($data[$k]['x'][$i][$j],3).'</td>';
				} 
			}
			for ($i=1; $i <= count($data[$k]['y']); $i++) {
				echo '<td>'.round($data[$k]['y'][$i],3).'</td>';
			}
			echo '</tr>';
		}
		echo '</table></div><br>';
	}

function fileError() {
    return '<div>'.
               'Структура файлу (досягається копіюванням таблиці з вибіркою у txt файл):<br>'.
               '-----ПОЧАТОК-----<br>'.
               '1<br>'.
               'x1[1]<br>'.
               'x1[2]<br>'.
               'x2[1]<br>'.
               'x2[2]<br>'.
               'x3[1]<br>'.
               'x3[2]<br>'.
               'f1<br>'.
               'f2<br>'.
               '2<br>'.
               '-- || --<br>'.
               '3<br>'.
               '-- || --<br>'.
               '...<br>'.
               'q<br>'.
               '-- || --<br>'.
               '------КІНЕЦЬ-----'.
            '</div>';
}

function outLambdas($lams, $p, $data) {
    $position_counter = 0;
    for($i = 1; $i <= count($data[1]['x']); $i++) {
        echo '||&lambda;<sub>' . $i . '</sub>|| =<br>';
        echo '<div style="color: #003366; font-size: 14px;"><table id="data_table">';
        for($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
            echo '<tr>';
            for($k = 0; $k <= $p[$i]; $k++) {
                echo '<td>' . round($lams[$position_counter], 7) . '</td>';
                $position_counter++;
            }
            echo '</tr>';
        }
        echo '</table></div><br>';
    }
}

function outPsi($lams, $p, $data, $polinom) {
    $position_counter = 0;
    for($i = 1; $i <= count($data[1]['x']); $i++) {
        echo '&Psi;<sub>' . $i . '</sub> = ';
        echo '<div style="color: #003366; font-size: 14px;"><table id="data_table">';
        echo '<tr>';
        for($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
            $sum = 0.0;
            for($k = 0; $k <= $p[$i]; $k++) {
                $sum += $polinom($k, $lams[$position_counter]);
                $position_counter++;
            }
            echo '<td>' . round($sum, 7) . '</td>';
        }
        echo '</tr>';
        echo '</table></div><br>';
    }
}

function outPhi($lams, $polinom, $p, $data) {
    $matrix = array();
    for($m = 1; $m <= count($data); $m++) {
        $matrix[$m - 1] = array();
        $position_counter = 0;
        $position_in_matrix = 0;
        for($i = 1; $i <= count($data[1]['x']); $i++) {
            $sum = 0.0;
            for($j = 1; $j <= count($data[1]['x'][$i]); $j++) {
                for($k = 0; $k <= $p[$i]; $k++) {
                    $sum += $polinom($k, $lams[$position_counter]);
                    $position_counter++;
                }
            }
            $matrix[$m - 1][$position_in_matrix] = $sum;
            $position_in_matrix++;
        }
    }
    return $matrix;
}

function outA($a, $data) {
    for($i = 1; $i <= count($data[1]['y']); $i++) {
        echo '||a<sup>(' . $i . ')</sup>|| =<br>';
        echo '<div style="color: #003366; font-size: 14px;"><table id="data_table">';
        $position = 0;
        for($j = 1; $j <= count($data[1]['x']); $j++) {
            echo '<tr>';
            for($k = 1; $k <= count($data[1]['x'][$j]); $k++) {
                echo '<td>' . round($a[$i][$position], 7) . '</td>';
                $position++;
            }
            echo '</tr>';
        }
        echo '</table></div><br>';
    }
}

function outC($c, $data) {
    for($i = 1; $i <= count($data[1]['y']); $i++) {
        echo '&Phi;<sub>' . $i . '</sub>(x<sub>1</sub>,x<sub>2</sub>,x<sub>3</sub>) =';
        echo '<div style="color: #003366; font-size: 14px;"><table id="data_table">';
        $position = 0;
        echo '<tr>';
        for($j = 1; $j <= count($data[1]['x']); $j++) {
            echo '<td>' . ($c[$i][$position] > 0 ? '+' : '') .
                round($c[$i][$position], 7) . '&Phi;<sub>'.$i.$j.'</sub>(x<sub>'.$j.'</sub>)</td>';
            $position++;
        }
        echo '</tr>';
        echo '</table></div><br>';
    }
}

function func_by_chebyshev_pols($a, $c, $lams, $polynom_size, $data) {
    for($i = 1; $i <= count($data[1]['y']); $i++) {
        $position_counter = 0;
        echo '&Phi;<sub>' . $i . '</sub>(x<sub>1</sub>,x<sub>2</sub>,x<sub>3</sub>) =';
        echo '<div style="color: #003366; font-size: 14px;"><table id="data_table">';
        $position = 0;
        for($j = 1; $j <= count($data[1]['x']); $j++) {
            for($k = 1; $k <= count($data[1]['x'][$j]); $k++) {
                echo '<tr>';
                for($n = 0; $n <= $polynom_size[$j]; $n++) {
                    $coef = $lams[$position_counter] * $a[$i][$position] * $c[$i][$j - 1];
                    echo '<td>';
                    echo $coef > 0 ? '+' : '';
                    echo sprintf('%.7f',round($coef, 7));
                    $position_counter++;
                    echo 'T<sub>'.$n.'</sub>(x<sub>'.$j.$k.'</sub>)';
                    echo '</td>';
                }
                $position++;
                echo '</tr>';
            }
        }
        echo '</table></div><br>';
    }
}

function func_parts_by_chebyshev_pols($a, $lams, $polynom_size, $data) {
    for($i = 1; $i <= count($data[1]['y']); $i++) {
        $position_counter = 0;
        $position = 0;
        for($j = 1; $j <= count($data[1]['x']); $j++) {
            echo '&Phi;<sub>' . $i . $j . '</sub>(x<sub>'. $j .'</sub>) =';
            echo '<div style="color: #003366; font-size: 14px;"><table id="data_table">';
            for($k = 1; $k <= count($data[1]['x'][$j]); $k++) {
                echo '<tr>';
                for($n = 0; $n <= $polynom_size[$j]; $n++) {
                    $coef = $lams[$position_counter] * $a[$i][$position];
                    echo '<td>';
                    echo $coef > 0 ? '+' : '';
                    echo sprintf('%.7f',round($coef, 7));
                    $position_counter++;
                    echo 'T<sub>'.$n.'</sub>(x<sub>'.$j.$k.'</sub>)';
                    echo '</td>';
                }
                $position++;
                echo '</tr>';
            }
            echo '</table></div><br>';
        }
    }
}

function print_mismatch($data, $func, $approximation) {
    $local_missmatch = array();
    $missmatch = 0.0;
    echo 'r<sub>' . $func . '</sub> =';
    echo '<div style="color: #003366; font-size: 14px;"><table id="data_table">';
    echo '<tr>';
    for($i = 1; $i <= count($data); $i++) {
        $local_missmatch[$i] = $approximation[$i - 1][1] - $data[$i]['y'][$func];
        $missmatch += $local_missmatch[$i] * $local_missmatch[$i];
        if(($i - 1) % 5 == 0) {
            echo '</tr><tr>';
        }
        echo '<td>' . round($local_missmatch[$i], 7) . '</td>';
    }
    echo '</tr>';
    echo '</table></div><br>';
}

function out_psi_lab3($psi) {
    echo '&Psi; =';
    echo '<div style="color: #003366; font-size: 14px;"><table id="data_table">';
    echo '<tr><td><b>q</b></td>';
    for ($i=1; $i <= count($psi[1]); $i++) {
        for ($j=1; $j <= count($psi[1][1]); $j++) {
            echo '<td><b>&Psi;<sub>'.$i.$j.'</sub></b></td>';
        }
    }
    echo '</tr>';for($i = 1; $i <= count($psi); $i++) {
        echo '<tr'.($i % 2 == 1 ? ' style="background: #ccc;"' : '').'><td><b>'.$i.'</b></td>';
        for($j = 1; $j <= count($psi[$i]); $j++) {
            for($k = 1; $k <= count($psi[$i][$j]); $k++) {
                echo '<td>';
                echo round($psi[$i][$j][$k], 7);
                echo '</td>';
            }
        }
        echo '</tr>';
    }
    echo '</table></div><br>';
}