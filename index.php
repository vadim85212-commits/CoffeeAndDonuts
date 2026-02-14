<?php 
    include 'php/connect.php';
    $_SESSION['page'] = 'index.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title> Coffee & Donuts </title>
	<link href="css/style.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
</head>
<body id="top"> 

	<div class="container">
		<?php include 'php/header.php';?>

		<main>
			<header class="row tm-welcome-section"> 
					<div class="pr-plase">
						<div class="preim-plase">
							<img src="img/ikon_coffee.png" class="ikon">
							<h2>КОФЕ</h3>
							<div class="opis-plase">
								Лучший ароматный свежеобжаренный кофе именно у нас.
							</div>
						</div>

						<div class="preim-plase">
							<img src="img/icon_donuts.png" class="ikon">
							<h2>ПОНЧИКИ</h3>
							<div class="opis-plase">
								Вкуснейшие воздушные пончики собственного производства.
							</div>
						</div>

						<div class="preim-plase">
							<img src="img/ikon_delivery.png" class="ikon">
							<h2>ДОСТАВКА</h3>
							<div class="opis-plase">
								При заказе от 500р. доставка в черте города - <span class="free">бесплатно</span>.
							</div>
						</div>
					</div>
			</header>

			<div class="buy">
				<a href="#menu" class="tm-btn tm-btn-default tm-right">Перейти к меню</a>
			</div>

			<div class="tm-section tm-container-inner">
				<div class="row">
					<div class="col-md-6">
						<figure class="tm-description-figure">
							<img src="img/img-01.jpg" alt="Family" class="img-fluid" />
						</figure>
					</div>
					<div class="col-md-6">
						<div class="tm-description-box"> 
							<h4 class="tm-gallery-title">МЫ — Coffee & Donuts!</h4>
							<p>Coffee & Donuts — это не просто кофейня, это семья! Изо дня в день мы радуем наших клиентов лучшим ароматным кофе в нашем городе, а также вкуснейшими десертами собственного производства.<br>Скорее забирай свой чудесный кофе, но и не забудь про сладенькое! <br> Мы работаем и радуем тебя ежедневно:
								<p class="ident">пн-пт 7:30 - 22:00 </p><p class="ident">сб-вскр 9:00 - 23:00</p></p>
						</div>
					</div>
				</div>
			</div>

								<div class="map" alt="Map">
									<a href="https://yandex.ru/maps/org/kitchen_coffee_donuts/38210606012/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Kitchen coffee & donuts</a>
									<a href="https://yandex.ru/maps/4/belgorod/category/confectionary/184108017/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Кондитерская в Белгороде</a>
									<a href="https://yandex.ru/maps/4/belgorod/category/coffee_shop/35193114937/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:28px;">Кофейня в Белгороде</a>
									<iframe src="https://yandex.ru/map-widget/v1/-/CCU5mNa7hB" width="90%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
								</div>

								<h1 class="menu" id="menu"> НАШЕ МЕНЮ </h1>
			<div class="tm-paging-links">
				<nav>
					<ul>
						<li class="tm-paging-item"><div class="cf"><a href="#menu" data-f="coffe" class="tm-paging-link active">Кофе</a></div></li>
						<li class="tm-paging-item"><div class="ce"><a href="#cake" data-f="cake" class="tm-paging-link">Десерты</a></div></li>
					</ul>
				</nav>
			</div>

			<!-- Галерея -->
			<div class="row tm-gallery">
				<!-- Галерея страница 1 -->
				<div id="tm-gallery-page-coffee" class="tm-gallery-page">
                <?php
                    $set = "SELECT * FROM products WHERE type='coffee'";
                    $result = mysqli_query($link, $set) or die(mysqli_error($link));
                    for ($coffee = []; $row = mysqli_fetch_assoc($result); $coffee[] = $row);

                    foreach($coffee as $key => $value){
                        echo '<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">';
                            echo '<figure>';
                                echo '<img src="'.$coffee[$key]['img'].'" alt="Image" class="img-fluid tm-gallery-img"/>';
                                echo '<figcaption>';
                                    echo '<h4 class="tm-gallery-title">'.$coffee[$key]['title'].'</h4>';
                                    echo '<p class="tm-gallery-description">'.$coffee[$key]['description'].' <br>Объем: '.$coffee[$key]['volume']. 'ml</p>';
                                    echo '<p class="tm-gallery-price" id="'.$coffee[$key]['id'].'" onclick="AddBusket(this.id)">'.$coffee[$key]['price'].' руб.<img src="img/shop.png" class="shop"></p>';
                                echo '</figcaption>';
                            echo '</figure>';
							echo '<div class="busket-add" id="add-'.$coffee[$key]['id'].'">';
								echo '<p>Добавлено в корзину</p>';
							echo '</div>';
                        echo '</article>';
                    }
                ?>
                </div>
					<!-- Галерея страница 2 -->
				<div id="tm-gallery-page-cakes" class="tm-gallery-page" >

                <?php
                    $set = "SELECT * FROM products WHERE type='cakes'";
                    $result = mysqli_query($link, $set) or die(mysqli_error($link));
                    for ($cakes = []; $row = mysqli_fetch_assoc($result); $cakes[] = $row);

                    foreach($cakes as $key => $value){
                        echo '<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item" id="cake">';
                            echo '<figure>';
                                echo '<img src="'.$cakes[$key]['img'].'" alt="Image" class="img-fluid tm-gallery-img"/>';
                                echo '<figcaption>';
                                    echo '<h4 class="tm-gallery-title">'.$cakes[$key]['title'].'</h4>';
                                    echo '<p class="tm-gallery-description">'.$cakes[$key]['description'].'</p>';
                                    echo '<p class="tm-gallery-price" id="'.$cakes[$key]['id'].'" onclick="AddBusket(this.id)">'.$cakes[$key]['price'].' руб.<img src="img/shop.png" class="shop"></p>';
                                echo '</figcaption>';
                            echo '</figure>';
							echo '<div class="busket-add" id="add-'.$cakes[$key]['id'].'">';
								echo '<p>Добавлено в корзину</p>';
							echo '</div>';
                        echo '</article>';
                    }
                ?>
				</div> 
			</div>
		</main>

<div class="topp"><a href="#top" class="scroll"><img src="img/scroll.png" class="scroll"></a></div>

		<footer class="tm-footer text-center">
			<p>«Coffee & Donuts» &copy; 2022
            | г. Белгород, ул. Свято-Троицкий бул., 7</p>
		</footer>
	</div>
	
	<script src='./js/AddBusket.js'></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>

</body>
</html>