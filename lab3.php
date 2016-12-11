<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SA Lab 3</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main-lab3.css">

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
                        <a href="/lab2.php">Lab 2</a>
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
                    <h3>Восстановление функциональных зависимостей в мультипликативной форме по дискретной выборке.</h3>
                    <p>Построить по заданной дискретной выборке (тестовая выборка приведена в таблице) и для реальной физической задачи оценивания составляющих солнечных бурь Dst  в мультипликативной форме приближающие функции Ф<sub>і</sub>(x<sub>1</sub>, x<sub>2</sub>, x<sub>3</sub>), i=[1,m]  (аналитически и графически представленные функциональные зависимости), которые с практически приемлемой погрешностью в смысле Чебышевского приближения характеризуют истинные функциональные зависимости y<sub>i</sub> = f<sub>i</sub>(x<sub>1</sub>, x<sub>2</sub>, x<sub>3</sub>), i=[1,m].</p>

        			<p>&phi;<sub>p<sub>k</sub></sub>(x<sub>j<sub>k</sub></sub>) => L<sub>n</sub>(x);<br>
                        &phi;<sub>0 j<sub>k</sub></sub> = &lambda;<sub>0 j<sub>k</sub></sub> ln(1+L<sub>0</sub>) = &lambda;<sub>0 j<sub>k</sub></sub> ln 1.5;<br>k=[1, K<sub>0</sub>]; j<sub>k</sub> = [1, n<sub>k</sub>]</p>

                </aside>
                

                    
                <article>

                    <h1>Лабораторна робота №3</h1>

        		    <header>
        			    <b>Вхідні дані</b><br><br>
        		    </header>

                    <section>

        				<form action="/lab3.php" method="post" enctype="multipart/form-data" name="input_form">

                            <input type="radio" id="default" name="input_type" value="default" checked /> Своя вибірка<br>
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
                                    <td><input type="number" name="dim_y" min="1" max="10" value="2" disabled="disabled"/></td>
                                </tr>
                            </table>
                            <br>
                            <input type="radio" name="polynom" value="Lagger" checked/> Поліном Лаґґера<br>
                            <input type="radio" name="polynom" value="Lagger2" /> Поліном Лаґґера зміщ.<br>
                            <br>
                            <table style="border: 0;">
                                <tr>
                                    <td>Ступінь полінома при x<sub>1</sub>:</td>
                                    <td><input type="number" name="pol_x1" min="0" max="10" value="5"/></td>
                                </tr>
                                <tr>
                                    <td>Ступінь полінома при x<sub>2</sub>:</td>
                                    <td><input type="number" name="pol_x2" min="0" max="10" value="5"/></td>
                                </tr>
                                <tr>
                                    <td>Ступінь полінома при x<sub>3</sub>:</td>
                                    <td><input type="number" name="pol_x3" min="0" max="10" value="5"/></td>
                                </tr>
                            </table>
                            <br>
                            <input type="radio" name="function" value="given" checked/> Дана структура функцій<br>
                            <input type="radio" name="function" value="own" /> Власна структура функцій<br>
                            <br>
        				    <input type="submit" name="submit" value="Submit" />

        				</form>

                    </section>

                </article>

                <?php

                error_reporting(E_ALL);
                ini_set('display_errors','On');

                include 'gradient_method.php';
                include 'output.php';
                include 'polinoms.php';
                include 'process_input_lab3.php';
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
                        $polinom_size = array('1' => $_POST['pol_x1'],
                                                '2' => $_POST['pol_x2'],
                                                '3' => $_POST['pol_x3']);
                        switch($_POST['polynom']) {
                            case 'Lagger':
                                $chosen_pol = function ($p, $x) {
                                    return Lagger($p, $x);
                                }; break;
                            case 'Lagger2':
                                $chosen_pol = function ($p, $x) {
                                    return Lagger($p, 2 * $x - 1 );
                                }; break;
                        }
                        switch($_POST['function']) {
                            case 'given':
                                $chosen_f = function ($x) {
                                    return log(1+$x);
                                }; break;
                            case 'own':
                                $chosen_f = function ($x) {
                                    return sinh($x);
                                }; break;
                        }
                        echo 'Step 2. ||&lambda;||.<br><br>';
                        $all_lam = solve_all_lambdas($chosen_pol,
                                $polinom_size, $norm_data);
                        outLambdas($all_lam, $polinom_size, $norm_data);
                        echo 'Step 3. ||a||.<br><br>';
                        $psi = psi_matrix_lab3($all_lam, $polinom_size, $norm_data, $chosen_pol, $chosen_f);
                        out_psi_lab3($psi);
                        $a_matr = solve_a_lab3($psi, $norm_data, $chosen_f);
                        outA($a_matr, $norm_data);
                        $phi_k = definition_of_Phi_k($a_matr, $psi, $norm_data, $chosen_f);
                        $c_matr = solve_c_lab3($phi_k, $norm_data, $chosen_f);
                        outC($c_matr, $norm_data);
                        $c_matr = make_magic($c_matr);
                        func_parts_by_chebyshev_pols($a_matr, $all_lam, $polinom_size, $norm_data);
                        func_by_chebyshev_pols($a_matr, $c_matr, $all_lam, $polinom_size, $norm_data);

                        echo 'Step 5. Plots.<br><br>';
                        for($i = 1; $i <= 1; $i++) {
                            echo 'Графік для y<sub>'.$i.'</sub>:<br>';
                            $approximated_values = plot_lab3($i, $phi_k, $c_matr, $norm_data,
                                $_POST['input_type'] === 'custom',
                                $_POST['function'] === 'own' ? 600000000 : 1000000000);
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

        <script src="js/main-lab3.js"></script>
    </body>
</html>
