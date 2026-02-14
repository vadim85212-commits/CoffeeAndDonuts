<?php 
    include 'php/connect.php';
    $_SESSION['page'] = 'signin.php';

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
                    <h2 class="g_text">Оформление заказа</h2>
                </div>';
                if(empty($data)){
                    echo '<form action="form.php" method="post" class="ldata" style="text-align:center;">';
                        echo '<label >Чтобы оформить заказ, необходимо что-то добавить в корзину. Вы можете найти кофе и/или десерт <a href="index.php">здесь</a>.</label>';
                    echo '</form>';
                }
                else{
                    echo '<form action="form.php" method="post" class="ldata">';
                        if(isset($_POST['set'])){
                            echo '<div class="mess">';
                                echo '<p>Ваш заказ оформлен</p>';
                            echo '</div>';
                            $user_id = $_SESSION['user_id'];
                            $fio = $_POST['fio'];
                            $email = $_POST['email'];
                            $phone = $_POST['phone'];
                            $products = $_SESSION['user_busket'];
                            $date = date('d-m-Y');
                            $set = "INSERT INTO orders SET  user_id='$user_id', fio='$fio', email='$email', phone='$phone', products='$products' , date='$date'";
                            $result = mysqli_query($link, $set) or die(mysqli_error($link));
                        }
                        else{
                            echo '<input type="text" hidden name="set" value="true">';
                        }
                        echo '<label class="spisok-h">Список покупок:</label>';
                        echo '<div class="spisok">';
                            foreach($data as $key => $value){
                                $k = $key + 1;
                                $res = $data[$key]['price'] * $data[$key]['quantity_tov'];
                                echo '<label>'.$k.'. '.$data[$key]['title'].' - '.$res.' руб. за '.$data[$key]['quantity_tov'].' шт. </label>';
                            }
                        echo '</div>';
                        echo '<label>Фамилия Имя Отчество <span class="red">*</span></label>';
                        echo '<div>';
                            if(isset($_POST['fio']) && !empty($_POST['fio'])){
                                echo '<input type="text" name="fio" value="'.$_POST['fio'].'" required>';
                            }
                            else if(isset($_SESSION['fio']) && !empty($_SESSION['fio'])){
                                echo '<input type="text" name="fio" value="'.$_SESSION['fio'].'" required>';
                            }
                            else{
                                echo '<input type="text" name="fio" required>';
                            }            
                            echo '<p>Заполните, чтобы мы знали как к Вам обращаться.</p>';
                        echo '</div>';
                        echo '<label>E-mail<span class="red">*</span></label>';
                        echo '<div>';
                            if(isset($_POST['email']) && !empty($_POST['email'])){
                                echo '<input type="email" name="phone" value="'.$_POST['email'].'" required>';

                            }
                            else if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
                                echo '<input type="email" name="email" value="'.$_SESSION['user_email'].'" required>';
                            }
                            else{
                                echo '<input type="email" name="email" required>';
                            }
                            echo '<p>Для отправки уведомлений о  статусе заказа.</p>';
                        echo '</div>';
                        echo '<label>Телефон<span class="red">*</span></label>';
                        echo '<div>';
                            if(isset($_POST['phone']) && !empty($_POST['phone'])){
                                echo '<input type="text" name="phone" value="'.$_POST['phone'].'" required>';
                            }
                            else if(isset($_SESSION['user_phone']) && !empty($_SESSION['user_phone'])){
                                echo '<input type="text" name="phone" value="'.$_SESSION['user_phone'].'" required>';
                            }
                            else{
                                echo '<input type="text" name="phone" required>';
                            }
                            echo '<p>Необходим для уточнения деталей заказа.</p>';
                        echo '</div>';
                        if(!isset($_POST['phone'])){
                            echo '<button name="btn">Оформить заказ</button>';
                        }
                        
                    echo '</form>';
                }   
            }
            else{
                echo '<div class="main-text">
                        <h2 class="g_text">Оформление заказа</h2>
                        <p class="gg_text">Вы не авторизовались. Необходимо <a href="signin.php">войти</a> чтобы оформить заказ.</p>
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