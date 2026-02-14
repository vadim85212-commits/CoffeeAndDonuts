<?php 
    include 'php/connect.php';
    $_SESSION['page'] = 'signin.php';
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
                    <h2 class="g_text">Авторизация</h2>
                    <p class="gg_text">Авторизация позволит Вам совершать покупки и отслеживать свои заказы.</p>
            </div>';
            echo 'Вы уже авторизованы, если хотите вы можете <a href="signout.php">выйти</a>.';
        }
        else{
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo '<div class="main-text">
                    <h2 class="g_text">Авторизация</h2>
                    <p class="gg_text">Авторизация позволит Вам совершать покупки и отслеживать свои заказы.</p>
            </div>';
            echo "<form method='post' action='' class='sign'>
                <label>Введите логин или номер телефона <span class='red'>*</span></label>
                <input type='text' name='user_name' required>
                <label>Введите пароль <span class='red'>*</span></label>
                <input type='password' name='user_pass' required>
                <div class='mem-block-1'>
                    <div class='check-block'>
                        <div class='check' id='check' onclick='checkBox()'>
                            <span class='checkbox' id='checkbox'></span>
                        </div>
                        <p>Запомнить меня</p>
                    </div>
                </div>
                <div class='mem-block-2'>
                    <button>Продолжить</button>
                    <a href='signup.php'>Регистрация</a>
                </div>
                </form>";
            }
            else{
                echo '<div class="main-text">
                        <h2 class="g_text">Авторизация</h2>
                </div>';
                    $error = array();
                    if(!isset($_POST['user_name'])){
                        $error[] = 'Поле Имя пользователя не может быть пустым!';
                    }
                    if(!isset($_POST['user_pass'])){
                        $error[] = 'Поле Пароль не может быть пустым!';
                    }
                    if(!empty($error)){
                        echo '<p class="gg_text">Некоторые поля заполнены неверно.</p>';
                        echo '<ul class="error">';
                        foreach ($error as $key => $value) {
                            echo '<li>' . $value . '</li>';
                        }
                        echo '</ul>';
                    }
                    else{
                        $sql = "SELECT * FROM users WHERE user_name= '".mysqli_real_escape_string($link, $_POST['user_name'])."' AND user_pass='".sha1($_POST['user_pass'])."'";
                        $result = mysqli_query($link, $sql);
                        if(!$result){
                            echo '<p class="gg_text">Что-то пошло не так. Попробуйте еще раз позже!<br>
                            Вы можете попробовать <a href="signin.php">войти</a> еще раз.</p>';
                        }
                        else{
                            if(mysqli_num_rows($result) == 0){
                                echo '<p class="gg_text">Неверно введен логин или пароль!<br>
                                Вы можете попробовать <a href="signin.php">войти</a> еще раз.</p>';
                            }
                            else{
                                $_SESSION['signed_in'] = true;
                                while($row = mysqli_fetch_assoc($result)){
                                    $_SESSION['user_id'] = $row['user_id'];
                                    $_SESSION['role'] = $row['role'];
                                    $_SESSION['user_name'] = $row['user_name'];
                                    $_SESSION['user_pass'] = $row['user_pass'];
                                    $_SESSION['user_email'] = $row['user_email'];
                                    $_SESSION['user_phone'] = $row['user_phone'];
                                    if ($row['user_busket'] != '0'){
                                        $_SESSION['user_busket'] = $row['user_busket'];
                                    }
                                    
                                }
                                if ($_SESSION['role'] == 'admin'){
                                    echo '<p class="gg_text">Добро пожаловать, '. $_SESSION['user_name'].'</p>';
                                    echo '<meta http-equiv="refresh" content="0;admin.php">';
                                }
                                else{
                                    echo '<p class="gg_text">Добро пожаловать, '. $_SESSION['user_name'].'</p>';
                                    echo '<meta http-equiv="refresh" content="0;index.php">';
                                }
                            }
                        }
                    }
                }
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