<?php 
    include 'php/connect.php';
    $_SESSION['page'] = 'busket.php';

    if(isset($_SESSION['user_busket'])){
        $p_arr = $_SESSION['user_busket'];
        if($p_arr != '0'){
            $p_arr = substr($p_arr,0,-1);
            $p_arr = substr($p_arr, 1);
            $p_arr1 = explode('.', $p_arr);
            foreach($p_arr1 as $k => $v){
                $p_arr1[$k] = substr($p_arr1[$k],0,-1);
                $p_arr1[$k] = substr($p_arr1[$k], 1);
                $p_arr2[] = explode(',', $p_arr1[$k]);
            }
            $p_arr2 = array_values($p_arr2);
        } 
    }
    if(!empty($p_arr2)){
        $data = [];
        foreach($p_arr1 as $k => $v){
            $id = $p_arr1[$k];
            $set = "SELECT * FROM products WHERE id='$id'";
            $result = mysqli_query($link, $set) or die(mysqli_error($link));
            $row = mysqli_fetch_assoc($result);
            $row['quantity_tov'] = $p_arr2[$k][1];
            $data[] = $row;
        }
    }                           
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title> Coffee & Donuts </title>
	<link href="css/style.css" rel="stylesheet" />
    <link href="css/busket.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
</head>
<body id="top"> 

	<div class="container">
        <?php include 'php/header.php';?>
	    <main>
            <div class="main-text">
					<h2 class="g_text">Корзина</h2>
			</div>
            <div class="main-busket">
                <?php
                    if(empty($data)){
                        echo '<div class="itog-block">';
                            echo '<p>Итого:</p>';
                            echo '<h3>0 руб.</h3>';
                            echo '<form action="form.php" method="post">';
                                echo '<button>Оформить заказ</button>';
                            echo '</form>';
                        echo '</div>';
                        echo '<div class="busket-block">';
                            echo '<div class="busket-nav">';
                                echo '<div class="all">';
                                    echo '<p>В корзине 0 товаров</p>';
                                    echo '<hr>';
                                echo '</div>';
                                echo '<div class="del-all" id="delall" onclick="DelAllTo(this.id)">';
                                    echo '<span class="del-x">x</span>';
                                    echo '<p>очистить</p>';
                                echo '</div>';
                            echo '</div>';
                    }   
                    else{
                        $summ = 0;
                        $count = 0;
                        foreach ($data as $key => $value){
                            $res = $data[$key]['price'] * $data[$key]['quantity_tov'];
                            $summ += $res;
                            $count += 1;
                        }
                        $summ = (string)$summ;
                        if(strlen($summ) > 4){
                            $summ = strrev($summ);
                            $summ = str_split($summ, 3);
                            $summ1 = implode(' ', $summ);
                            $summ = strrev($summ1);
                        }
                        echo '<div class="itog-block">';
                            echo '<p>Итого:</p>';
                            echo '<h3>'.$summ.' руб.</h3>';
                            echo '<form action="form.php" method="post">';
                                echo '<button>Оформить заказ</button>';
                            echo '</form>';
                        echo '</div>';
                        echo '<div class="busket-block">';
                            echo '<div class="busket-nav">';
                                echo '<div class="all">';
                                    if($count > 4){
                                        echo '<p>В корзине '.$count.' товаров</p>';
                                    }
                                    else{
                                        echo '<p>В корзине '.$count.' товара</p>';
                                    }
                                    echo '<hr>';
                                echo '</div>';
                                echo '<div class="del-all" id="delall" onclick="DelAllTo(this.id)">';
                                    echo '<span class="del-x">x</span>';
                                    echo '<p>очистить</p>';
                                echo '</div>';
                            echo '</div>';
                    }
                ?>
                    <div class="busket-tov-block">
                        <?php
                            if(empty($data)){
                                echo '<div class="busket-no">';
                                    echo '<p>В вашей корзине пусто :(</p>';
                                echo '</div>';
                            }
                            else{
                                foreach ($data as $key => $value){
                                    $res = $data[$key]['price'] * $data[$key]['quantity_tov'];
                                        $res = (string)$res;
                                        if(strlen($res) > 4){
                                            $res = strrev($res);
                                            $res = str_split($res, 3);
                                            $res1 = implode(' ', $res);
                                            $res = strrev($res1);
                                        }
                                    echo '<div class="busket-tov">';
                                        echo '<img src="'.$data[$key]['img'].'" alt="not found">';
                                        echo '<p class="tov-name">'.$data[$key]['title'].'</p>';
                                        echo '<div class="tov-cost">';
                                            echo '<h4>'.$data[$key]['price'].' руб.</h4>';
                                            echo '<p>цена за 1 шт.</p>';
                                        echo '</div>';
                                        echo '<div class="tov-qua">';
                                            echo '<div>';
                                                echo '<span class="Plus-minus" id="'.$data[$key]['id'].'" onclick="Minus(this.id)">-</span>';
                                                echo '<p>'.$data[$key]['quantity_tov'].'</p>';
                                                echo '<span class="Plus-minus" id="'.$data[$key]['id'].'" onclick="Plus(this.id)">+</span>';
                                            echo '</div>';
                                            echo '<p>шт.</p>';
                                        echo '</div>';
                                        echo '<h4 class="cost-p">'.$res.' руб.</h4>';
                                        echo '<div class="del">';
                                            echo '<span class="del-x" id="'.$data[$key]['id'].'" onclick="DelTo(this.id)">x</span>';
                                            echo '<span class="del-x375" id="'.$data[$key]['id'].'" onclick="DelTo(this.id)">Удалить</span>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                            }
                        ?>
                    </div>  
                </div>
            </div>
	    </main>

        <div class="topp"><a href="#top" class="scroll"><img src="img/scroll.png" class="scroll"></a></div>

		<footer class="tm-footer text-center">
			<p>«Coffee & Donuts» &copy; 2022
            | г. Белгород, ул. Свято-Троицкий бул., 7</p>
		</footer>
	</div>
	<script src="js/Reload.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>
	<script src="js/gallery.js"></script>
    <script src="js/Plus.js"></script>
    <script src="js/Minus.js"></script>
    <script src="js/DelTo.js"></script>
    <script src="js/DelAllTo.js"></script>
</body>
</html>