<?php 
    include 'php/connect.php';
    $_SESSION['page'] = 'gallery.php';
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

			<div class="main-text">
					<p class="gg_text">Coffee & Donuts - большая семья. <br>Мы приготовим для вас самый вкусный кофе и десерты.<br> От нас никогда не захочется уходить. <br>Мы находимся в одном месте и в самом сердце Белгорода.</p>
					<h2 class="g_text">Фотографии нашей любимой кофейни</h2>
			</div>


    <div class="gallery" id="gallery">
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g01.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g02.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g03.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g04.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g05.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g06.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g07.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g08.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g09.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g10.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g11.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g12.jpeg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/gallery/g13.jpg" alt=""></div>
        </div>
        <div class="gallery-item">
            <div class="content"><img src="img/img-01.jpg" alt=""></div>
        </div>
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
	<script src="js/gallery.js"></script>

</body>
</html>