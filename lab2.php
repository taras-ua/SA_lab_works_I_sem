<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SA Lab 2</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main-lab2.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">System Analysis Labs</h1>
                <nav>
                    <ul>
                        <a href="/lab3.php">Lab 3</a>
                    </ul>
                    <ul>
                        <a href="/lab4.php">Lab 4</a>
                    </ul>
                </nav>
            </header>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">

        		<aside>
                    <h3>Восстановление функциональных зависимостей по дискретно заданным выборкам.</h3>
                    <p>Построить по заданной дискретной выборке приближающие функции Ф<sub>і</sub>(x<sub>1</sub>, x<sub>2</sub>, x<sub>3</sub>), i=[1,m]  (аналитические и графически представленные функциональные зависимости), которые с практически приемлемой погрешностью в смысле Чебышевского приближения характеризуют истинные функциональные зависимости y<sub>i</sub> = f<sub>i</sub>(x<sub>1</sub>, x<sub>2</sub>, x<sub>3</sub>), i=[1,m].</p>

        			<p>Размерности векторов x<sub>1</sub>, x<sub>2</sub>, x<sub>3</sub> соответственно равны: n<sub>1</sub> = 2, n<sub>2</sub> = 2, n<sub>3</sub> = 2; объем выборки q<sub>0</sub> = [1,40]; количество целевых функций m = 5.</p>

        		    <p>b<sub>i<sub>q<sub>0</sub></sub></sub> принимаются равными нормированным значениям Y<sub>i</sub>[q], i=[1,m]; метод решения несовместной системы уравнений: <b><i>Градиентный метод</i></b></p>
                </aside>
                    
                <article>

                    <h1>Лабораторна робота №2</h1>

        		    <header>
        			    <b>Вхідні дані</b><br><br>
        		    </header>

                    <section>

        				<form action="/lab2.php" method="post" enctype="multipart/form-data" name="input_form">

                            <input type="radio" id="default" name="input_type" value="default" checked /> Вибірка для КА-12<br>
                            <input type="radio" id="custom" name="input_type" value="custom" /> Вибірка з файлу:
        				    <input type="file" name="file" id="file"/> <br>
                            <br>
                            <table style="border: 0;">
                                <tr>
                                    <td>Розмірність x<sub>1</sub>:</td>
                                    <td><input type="number" name="dim_x1" min="1" max="10" value="2" disabled="disabled"/></td>
                                </tr>
                                <tr>
                                    <td>Розмірність x<sub>2</sub>:</td>
                                    <td><input type="number" name="dim_x2" min="1" max="10" value="2" disabled="disabled"/></td>
                                </tr>
                                <tr>
                                    <td>Розмірність x<sub>3</sub>:</td>
                                    <td><input type="number" name="dim_x3" min="1" max="10" value="2" disabled="disabled"/></td>
                                </tr>
                                <tr>
                                    <td>Розмірність y:</td>
                                    <td><input type="number" name="dim_y" min="1" max="10" value="5" disabled="disabled"/></td>
                                </tr>
                            </table>
                            <br>
                            <input type="radio" name="polynom" value="Chebyshev" checked /> Поліном Чебишева<br>
                            <input type="radio" name="polynom" value="Lagger" /> Поліном Лаґґера<br>
                            <input type="radio" name="polynom" value="Ermit" /> Поліном Ерміта<br>
                            <input type="radio" name="polynom" value="Lejandr" /> Поліном Лежандра<br>
                            <br>
                            <table style="border: 0;">
                                <tr>
                                    <td>Ступінь полінома при x<sub>1</sub>:</td>
                                    <td><input type="number" name="pol_x1" min="1" max="10" value="5"/></td>
                                </tr>
                                <tr>
                                    <td>Ступінь полінома при x<sub>2</sub>:</td>
                                    <td><input type="number" name="pol_x2" min="1" max="10" value="5"/></td>
                                </tr>
                                <tr>
                                    <td>Ступінь полінома при x<sub>3</sub>:</td>
                                    <td><input type="number" name="pol_x3" min="1" max="10" value="5"/></td>
                                </tr>
                            </table>
                            <br>
                            <input type="radio" name="lambda" value="1" checked/> ||&lambda;|| через одну систему<br>
                            <input type="radio" name="lambda" value="3" /> ||&lambda;|| через три системи<br>
                            <br>
                            <input type="radio" name="b0" value="nrm" checked/> b<sub>0</sub> через нормовані <i>y<sub>i</sub></i><br>
                            <input type="radio" name="b0" value="avg" /> b<sub>0</sub> через середнє арифметичне<br>
                            <br>
        				    <input type="submit" name="submit" value="Submit" />

        				</form>

                    </section>

                </article>

                <?php

                    include 'process_input.php';
                    include 'output.php';
                    include 'gradient_method.php';
                    include 'polinoms.php';
                    include 'plotter.php';
                    ini_set('max_execution_time', 6000);
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                        echo '<article><section>';

                        if($_POST['input_type'] === 'custom') {
                            $input_values = getInput(3,
                                array('1' => $_POST['dim_x1'],
                                      '2' => $_POST['dim_x2'],
                                      '3' => $_POST['dim_x3']),
                                $_POST['dim_y']);
                        } elseif($_POST['input_type'] === 'default') {
                            $input_values = getDefaultInput();
                        }
                        if(isset($input_values['error'])) {
                            echo '<br><div style="color: red;">Помилка завантаження файлу.</div>';
                        } elseif(isset($input_values['broken_file'])) {
                            echo '<br><div style="color: red;">Неправильна структура файлу або помилково вказані розмірності.</div>'.fileError();
                        } else {
                            echo '<br><b>Результат роботи</b><br><br>';
                            echo 'Step 0. Вхідна вибірка.';
                            printInput($input_values);
                            echo 'Step 1. Нормування.';
                            $norm_data = normalizeInput($input_values);
                            printInput($norm_data);
                            echo 'Step 2. ||&lambda;||.<br><br>';
                            $polinom_size = array('1' => $_POST['pol_x1'],
                                                  '2' => $_POST['pol_x2'],
                                                  '3' => $_POST['pol_x3']);
                            switch($_POST['polynom']) {
                                case 'Chebyshev':
                                    $chosen_pol = function ($p, $x) {
                                        return Chebyshev($p, $x);
                                    }; break;
                                case 'Lagger':
                                    $chosen_pol = function ($p, $x) {
                                        return Lagger($p, $x);
                                    }; break;
                                case 'Ermit':
                                    $chosen_pol = function ($p, $x) {
                                        return Ermit($p, $x);
                                    }; break;
                                case 'Lejandr':
                                    $chosen_pol = function ($p, $x) {
                                        return Lejandr($p, $x);
                                    }; break;

                            }
                            if($_POST['lambda'] == '1') {
                                $all_lam = solve_all_lambdas($chosen_pol,
                                    $polinom_size, $norm_data);
                            } else {
                                $all_lam = solve_separate_lambdas($chosen_pol,
                                    $polinom_size, $norm_data);
                            }
                            outLambdas($all_lam, $polinom_size, $norm_data);
                            echo 'Step 3. ||a||.<br><br>';
                            outPsi($all_lam, $polinom_size, $norm_data, $chosen_pol);
                            $a_matrices = solve_a_matrices($all_lam, $polinom_size, $norm_data, $chosen_pol);
                            outA($a_matrices, $norm_data);
                            echo 'Step 4. ||c||.<br><br>';
                            $c_matrices = solve_c_matrices($a_matrices, $all_lam, $polinom_size, $norm_data, $chosen_pol);
                            outC($c_matrices, $norm_data);
                            $c_matrices = make_magic($c_matrices);
                            func_parts_by_chebyshev_pols($a_matrices, $all_lam, $polinom_size, $norm_data);
                            func_by_chebyshev_pols($a_matrices, $c_matrices, $all_lam, $polinom_size, $norm_data);

                            echo 'Step 5. Plots.<br><br>';
                            for($i = 2; $i <= 2; $i++) {
                                echo 'Графік для y<sub>'.$i.'</sub>:<br>';
                                $approximated_values = plot($i, $a_matrices, $c_matrices, $all_lam, $polinom_size, $norm_data, $chosen_pol);
                                print_mismatch($norm_data, $i, $approximated_values);
                            }

                        }

                        echo '</section></article>';
                    }

                ?>


            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                (c) 2014 ESC "IASA" NTUU "KPI"<br>Valerii Dzhunkovs'kyi<br>Yurii Dzhunkovs'kyi<br>Taras Rogov
            </footer>
        </div>

        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        <script src="js/main-lab2.js"></script>
    </body>
</html>
