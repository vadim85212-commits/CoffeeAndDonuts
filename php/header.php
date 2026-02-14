<div class="placeholder">
    <div class="parallax-window" data-parallax="scroll" data-image-src="img/background.jpg">
		<div class="tm-header">
			<div class="row tm-header-inner">
				<div class="col-md-6 col-12">
					<img src="img/simple-house-logo.png" alt="Logo" class="tm-site-logo" /> 
					<div class="tm-site-text-box">
						<h1 class="tm-site-title">Coffee & Donuts</h1>
						<h6 class="tm-site-description">Начни свой день с ароматного кофе!</h6>	
					</div>
				</div>
				<nav class="col-md-6 col-12 tm-nav">
					<ul class="tm-nav-ul">
						<?php
						 	echo '<li class="tm-nav-li"><a href="index.php" class="tm-nav-link';
							if($_SESSION['page'] == 'index.php'){
								echo ' active';
							}
							echo '">Главная</a></li>';
							echo '<li class="tm-nav-li"><a href="gallery.php" class="tm-nav-link';
							if($_SESSION['page'] == 'gallery.php'){
								echo ' active';
							}
							echo '">Галерея</a></li>';
							echo '<li class="tm-nav-li"><a href="contact.php" class="tm-nav-link';
							if($_SESSION['page'] == 'contact.php'){
								echo ' active';
							}
							echo '">Контакты</a></li>';
							if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){
								echo '<div class="login-on" id="login-on">
									<img src="img/login.png" class="login" alt="Личный кабинет" title="Войти" >
									<div class="sub" id="sub">
										<a href="lk.php">Личный кабинет</a>
										<a href="signout.php">Выйти</a>
									</div>
								</div>';
								echo '<script src="./js/logOn.js"></script>';
							}
							else{
								echo '<a href="signin.php"><img src="img/login.png" class="login" alt="Личный кабинет" title="Войти"></a>';
							}
						?>
						
							
							<a href="busket.php"><img src="img/shopping.png" class="shopping" alt="Корзина" title="Корзина"></a>
							
					</ul>
				</nav>	
			</div>
		</div>
	</div>
</div>			