<?php 
    include 'php/connect.php';
    $_SESSION['page'] = 'signup.php';
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
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
                echo '<div class="main-text">
                    <h2 class="g_text">Регистрация</h2>
                    <p class="gg_text">Регистрация позволит Вам отслеживать заказы из нашего магазина, а также в будущем 
                    получать приятные бонусы и сюрпризы!</p>
                </div>';
                echo "<form method='post' action='signup.php' class='sign'>
                    <label>Введите логин или номер телефона <span class='red'>*</span></label>
                    <input type='text' name='user_name' required>
                    <label>E-mail <span class='red'>*</span></label>
                    <input type='email' name='user_email' required>
                    <label>Телефон</label>
                    <input type='text' name='user_phone' pattern='\+7\s?9[0-9]{2}\d{3}\d{2}\d{2}' placeholder='+7XXXXXXXXXX'>
                    <label>Введите пароль <span class='red'>*</span></label>
                    <input type='password' name='user_pass' required>
                    <label class='und'>Длина пароля не менее 6 символов.</label>
                    <label>Подтвердите пароль <span class='red'>*</span></label>
                    <input type='password' name='user_pass_check' required>
                    <div class='mem-block-2'>
                    <button class='reg'>Зарегистрироваться</button>
                    </div>
                    </form>";
            }
            else{
                echo '<div class="main-text">
                    <h2 class="g_text">Регистрация</h2>
                </div>';
                $errors = array();
                if(isset($_POST['user_name'])){         
                    if(!ctype_alnum($_POST['user_name'])){
                        $errors[] = 'Имя пользователя может содержать только буквы и цифры!';
                    }
                    if(strlen($_POST['user_name']) > 30){
                        $errors[] = 'Имя пользователя не может быть более 30-ти символов!';
                    }
                }
                else {
                    $errors[] = 'Поле "Имя пользователя" не может быть пустым!';
                }
                if(isset($_POST['user_pass'])){
                    if($_POST['user_pass'] != $_POST['user_pass_check']){
                        $errors[] = 'Введенные пароли не совпадают!';
                    }
                    if(strlen($_POST['user_pass']) < 6){
                        $errors[] = 'Длина пароля не может быть менее 6-ти символов.';
                    }
                }
                else {
                    $errors[] = 'Поле "Пароль" не может быть пустым!';
                }
                if(isset($_POST['user_name']) && isset($_POST['user_pass'])){
                    $sql = "SELECT * FROM users WHERE user_name='".mysqli_real_escape_string($link, $_POST['user_name'])."'";
                    $result = mysqli_query($link, $sql);
                    $row = mysqli_fetch_assoc($result);
                    if(!empty($row)){
                        $errors[] = 'Пользователь с таким именем уже существует.';
                    }   
                }
                if(!empty($errors)){
                    echo '<p class="gg_text">Некоторые поля заполнены неверно!</p>';
                    echo '<ul class="error_mess">';
                    foreach ($errors as $key => $value) {
                        echo '<li>' . $value . '</li>';
                    }
                    echo '<li><a href="signup.php"> Попробовать еще раз.</a></li>';
                    echo '</ul>';
                }
                else{
                    $us_n = mysqli_real_escape_string($link, $_POST['user_name']);
                    $us_p = sha1($_POST['user_pass']);
                    $us_e = mysqli_real_escape_string($link, $_POST['user_email']);
                    $us_phone = mysqli_real_escape_string($link, $_POST['user_phone']);
                    $us_busket = '0';
                    $sql = "INSERT INTO users SET role='user', user_name='$us_n', user_pass='$us_p', user_email='$us_e', user_phone='$us_phone', user_busket='$us_busket'";
                    $result = mysqli_query($link, $sql);
                    if(!$result){
                        echo '<p class="gg_text">Во время регистрации что-то пошло не так. <a href="signup.php"> Попробовать еще раз.</a></p>';
                    }            
                    else{
                        echo '<p class="gg_text">Успешная регистрация. Теперь вы можете <a href="signin.php"> войти.</a></p>';
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

</body>
</html>