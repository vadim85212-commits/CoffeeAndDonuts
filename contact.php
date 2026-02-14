<?php 
    include 'php/connect.php';
    $_SESSION['page'] = 'contact.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title> Coffee & Donuts </title>
	<link href="css/style.css" rel="stylesheet" />
	<link href="php/form.php">
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
</head>
<body id="top"> 

	<div class="container">
        <?php include 'php/header.php';?>
		<main>

            <p class="t_con">Контакты</p>

            <div class="connection">
                <a href="https://www.instagram.com/kitchen.coffee.donuts/" title="_blank"><img src="img/inst.png" class="conn"></a>
                <a href="https://vk.com/kitchen.coffee.donuts" title="_blank"><img src="img/vk.png" class="conn"></a>
            </div>


            <div class="cont">

            <div class="wrapper">
                <div class="descript-wrapper">
                    <h4 class="aio-icon-title">Наш фактический адрес:</h4>
                    <div class="aio-icon-description">
                        г. Белгород, ул. Свято-Троицкий бул., 7</div>
                </div>
                <span class="clearfix"></span>
                <div class="descript-wrapper">
                    <h4 class="aio-icon-title">Время работы:</h4>
                    <div class="aio-icon-description">
                        пн-пт 7:30 - 22:00, без перерыва.
                        <br>сб-вскр 9:00 - 23:00</div>
                </div>
                <span class="clearfix"></span>
                <div class="descript-wrapper">
                    <h4 class="aio-icon-title">Электронная почта:</h4>
                    <div class="aio-icon-description">
                        kitchencoffeedonuts@gmail.com</div>
                </div>
                <span class="clearfix"></span>
                <div class="descript-wrapper">
                    <h4 class="aio-icon-title">Телефон:</h4>
                    <div class="aio-icon-description"><a href="+74722370550" class="tel">
                        +7 (4722) 37-05-50</a></div>
                </div>
                <span class="clearfix"></span>
            </div>
            <!-- Форма обратной связи -->
            <form class="obratnuj-zvonok" autocomplete="off" action='' method='post'>
                <div class="form-zvonok"> 
                <?php
                    echo '<div>';
                        echo '<label>Имя <span>*</span></label>';
                        if(isset($_SESSION['fio']) && !empty($_SESSION['fio'])){
                            echo '<input type="text" name="username" required value="'.$_SESSION['fio'].'">';
                        }
                        else{
                            echo '<input type="text" name="username" required>';
                        }
                    echo '</div>';
                    echo '<div>';
                        echo '<label>Номер телефона <span>*</span></label>';
                        if(isset($_SESSION['user_phone']) && !empty($_SESSION['user_phone'])){
                            echo '<input type="text" name="usernumber" required value="'.$_SESSION['user_phone'].'" >';
                        }
                        else{
                            echo '<input type="text" name="usernumber" required>';
                        }
                    echo '</div>';
                ?>
                <div>
                    <label>Сообщение</label>
                    <input type='text' name='question'>
                </div>
                <input class="bot-send-mail" type='submit' value='Послать заявку'>
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    // Поочередно проверяем или были переданные параметры формы, или они не пустые
                    if(isset($_POST["username"])){
                      //Если параметр есть, присваеваем ему переданое значение
                      $name = trim(strip_tags($_POST["username"]));
                    }
                    if(isset($_POST["usernumber"]))
                    {
                      $number = trim(strip_tags($_POST["usernumber"]));
                    }
                    if (isset( $_POST["question"])) {
                      $question = trim(strip_tags($_POST["question"]));
                    }
                    $set = "INSERT INTO request SET  user_name='$name', phone='$number', mess='$question'";
                    $result = mysqli_query($link, $set) or die(mysqli_error($link));
                    echo '<p class="success">Сообщение отправлено</p>';
                }
                ?>
                </div>
                
                
            </form>
            </div>
                <p class="t_con">Отзывы о нас</p>
                <div class="reviews"><iframe style="width:100%;height:100%;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box" src="https://yandex.ru/maps-reviews-widget/38210606012?comments"></iframe><a href="https://yandex.ru/maps/org/kitchen_coffee_donuts/38210606012/" target="_blank" style="box-sizing:border-box;text-decoration:none;color:#b3b3b3;font-size:10px;font-family:YS Text,sans-serif;padding:0 20px;position:absolute;bottom:8px;width:100%;text-align:center;left:0">Kitchen coffee & donuts на карте Белгорода — Яндекс.Карты</a>
                </div>
		</main>

<div class="topp"><a href="#top" class="scroll"><img src="img/scroll.png" class="scroll"></a></div>

		<footer class="tm-footer text-center">
			<p>«Coffee & Donuts» &copy; 2022
            | г. Белгород, ул. Свято-Троицкий бул., 7</p>
		</footer>
	</div>
	

	
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>


</body>
</html>