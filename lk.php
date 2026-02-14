<?php 
    include 'php/connect.php';
    $_SESSION['page'] = 'lk.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title> Coffee & Donuts </title>
	<link href="css/style.css" rel="stylesheet" />
    <link href="css/log.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
</head>
<body id="top"> 

	<div class="container">
        <?php include 'php/header.php';?>
	    <main>
        <?php
        if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){
            echo '<div class="main-text">
                <h2 class="g_text">Личный кабинет</h2>
            </div>';
            echo '<div class="lk">
                <form class="lk-block" action="lk.php" method="post">
                    <input type="text" hidden name="data" value="true">
                    <button>
                        <img src="img/login.png" alt="not found">
                        <p>Личные данные</p>
                    </button>
                </form>
                <form class="lk-block hist" action="lk.php" method="post">
                    <input type="text" hidden name="history" value="true">
                    <button>
                        <img src="img/book.png" alt="not found">
                        <p>История заказов</p>
                    </button>
                </form>
                <form class="lk-block" action="busket.php" method="post">
                    <button>
                        <img src="img/shopping.png" alt="not found">
                        <p>Корзина</p>
                    </button>
                </form>
            </div>';
            if(isset($_POST['data'])){
                if(isset($_POST['set'])){
                    if(!empty($_POST['fio'])){
                        $_SESSION['fio'] = $_POST['fio'];
                    }
                    if(!empty($_POST['email'])){
                        $_SESSION['user_email'] = $_POST['email'];
                    }
                    if(!empty($_POST['phone'])){
                        $_SESSION['user_phone'] = $_POST['phone'];
                    }
                    if(!empty($_POST['sms'])){
                        $_SESSION['sms'] = $_POST['sms'];
                    }
                }
                echo '<form action="lk.php" method="post" class="ldata">';
                    echo '<label>Фамилия Имя Отчество </label>';
                    echo '<div>';
                        if(isset($_SESSION['fio']) && !empty($_SESSION['fio'])){
                            echo '<input type="text" name="fio" value="'.$_SESSION['fio'].'">';
                        }
                        else{
                            echo '<input type="text" name="fio">';
                        }            
                        echo '<p>Заполните, чтобы мы знали как к Вам побращаться</p>';
                    echo '</div>';
                    echo '<label>E-mail</label>';
                    echo '<div>';
                        if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
                            echo '<input type="text" name="email" value="'.$_SESSION['user_email'].'">';
                        }
                        else{
                            echo '<input type="email" name="email">';
                        }
                        echo '<p>Для отправки уведомлений о статусе заказа.</p>';
                    echo '</div>';
                    echo '<label>Телефон</label>';
                    echo '<div>';
                        if(isset($_SESSION['user_phone']) && !empty($_SESSION['user_phone'])){
                            echo '<input type="text" name="phone" value="'.$_SESSION['user_phone'].'" pattern="\+7\s?9[0-9]{2}\d{3}\d{2}\d{2}">';
                        }
                        else{
                            echo '<input type="text" name="phone" pattern="\+7\s?9[0-9]{2}\d{3}\d{2}\d{2}" placeholder="+7XXXXXXXXXX">';
                        }
                        echo '<p>Необходим для уточнения деталей заказа.</p>';
                    echo '</div>';
                    echo '<label>Номер телефона для получения СМС с кодом</label>';
                    echo '<div>';
                        if(isset($_SESSION['sms']) && !empty($_SESSION['sms'])){
                            echo '<input type="text" name="sms" value="'.$_SESSION['sms'].'" pattern="\+7\s?9[0-9]{2}\d{3}\d{2}\d{2}">';
                        }
                        else{
                            echo '<input type="text" name="sms" pattern="\+7\s?9[0-9]{2}\d{3}\d{2}\d{2}" placeholder="+7XXXXXXXXXX">';
                        }
                        echo '<p>Для авторизации на сайте и восстановления доступа к сайту</p>';
                    echo '</div>';
                    echo '<button>Сохранить изменения</button>';
                    echo '<input type="text" hidden name="data" value="true">';
                    echo '<input type="text" hidden name="set" value="true">';
                echo '</form>';
            }
            else if(isset($_POST['history'])){
                $set = "SELECT * FROM orders WHERE user_id='".$_SESSION['user_id']."'";
                $result = mysqli_query($link, $set) or die(mysqli_error($link));
                for ($orders = []; $row = mysqli_fetch_assoc($result); $orders[] = $row);

                if(empty($orders)){
                    echo '<div class="history">';
                        echo '<p>Вы еще ничего не зыказывали у нас</p>';
                    echo '</div>';
                }
                else{
                    echo '<div class="history_y">';
                        echo '<div class="ord_menu">';
                            echo '<p>Фамилия Имя Отчество</p>';
                            echo '<p>Дата заказа</p>';
                            echo '<p>Список покупок</p>';
                        echo '</div>';
                        echo '<hr>';
                        echo '<div>';
                        foreach($orders as $key => $value){
                                echo '<p>'.$orders[$key]['fio'].'</p>';
                                echo '<p>'.$orders[$key]['date'].'</p>';
                                if(isset($orders[$key]['products'])){
                                    $p_arr = $orders[$key]['products'];
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
                                echo '<div class="ord_tov">';
                                foreach($data as $key => $value){
                                    $k = $key + 1;
                                    $res = $data[$key]['price'] * $data[$key]['quantity_tov'];
                                    echo '<p>'.$k.'. '.$data[$key]['title'].' - '.$res.' руб. за '.$data[$key]['quantity_tov'].' шт. </p>';
                                }
                                echo '</div>';
                        }
                        echo '</div>';
                    echo '</div>';
                }
            }
        }
        else{
            echo '<div class="main-text">
                    <h2 class="g_text">Личный кабинет</h2>
                    <p class="gg_text">Вы не авторизовались. Необходимо <a href="signin.php">войти</a> чтобы посмотреть личные данные.</p>
            </div>';
        }
        ?>
	    </main>

        <div class="topp"><a href="#top" class="scroll"><img src="img/scroll.png" class="scroll"></a></div>

		<footer class="tm-footer text-center">
			<p>«Coffee & Donuts» &copy; 2022
            | г. Белгород, ул. Свято-Троицкий бул., 7</p>
		</footer>
	</div>
	
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>
	<script src="js/gallery.js"></script>
    <script src="js/check.js"></script>

</body>
</html>