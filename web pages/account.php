<!-- TOMMASI -->
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.css">
		<link rel="stylesheet" href="css/shop.css">
		<title>ACCOUNT</title>
		<?php 
			if(!isset($_COOKIE["utente"])) {
				header("location: login.php?err=1");
				die();
			}
		?> 
	</head>

	<!-- CIGANA -->
	<body>
		<header class="header clearfix">
			<a href="" class="header__logo"><img src="immagini/logoNegoziSportivi.png" alt="Logo" width="50px" /></a>
			<a href="" class="header__icon-bar">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<div class="header__menu animate">
				<div class="header__menu__item"><a href="home.php">HOME</a></div>
				<div class="header__menu__item"><a href="shop/basketballPassion.php">BASKETBALL PASSION</a></div>
				<div class="header__menu__item"><a href="shop/pallavoloEverywhere.php">PALLAVOLO EVERYWHERE</a></div>
				<div class="header__menu__item"><a href="shop/racingSpirit.php">RACING SPIRIT</a></div>
				<div class="header__menu__item"><a href="shop/soccerEvolution.php">SOCCER EVOLUTION</a></div>
				<div class="header__menu__item"><a href="shop/tennisClash.php">TENNIS CLASH</a></div>
				<div class="header__menu__item"><a href="home.php?logout=1">LOGOUT</a></div>
				<div class="header__menu__item"><a href="shop/carrello.php"><img src="immagini/carrello.png" alt="Carrello" width="20px" /></a></div>
			</div>
		</header>
		
		<!-- TOMMASI -->
		<div class="container">
			<?php 
				$db = new mysqli("localhost", "root", "", "my_negozisportivi");
				$query = "SELECT * FROM articolo
				JOIN acquistare AS a ON a.id_articolo = articolo.ID_articolo
				WHERE a.email_utente LIKE '" . $_COOKIE["utente"] . "' AND a.carrello = 0
				ORDER BY a.`data/ora_acquisto`;";
				$articoli = $db->query($query);
				foreach($articoli as $a) {
					?>
					<div class="articolo">
						<form action="aggiungi_rimuovi_carrello.php" method="post">
							<h3><?php echo $a["nome_articolo"]; ?></h3>
							<p><?php echo $a["tipo_articolo"]; ?></p>
							<p><?php
								echo $a["prezzo_pagato"] . "<br> "
							?></p>
							<p><?php echo $a["data/ora_acquisto"]?></p>
						</form>
					</div>
					<?php
				}
			?>
		</div>

		<!-- FOOTER -->
        <footer class="footer">
            <p>©Copyright 2023 Gabriele Tommasi, Lorenzo Barattin, Alexandru Tanase & Andrea Cigana</p>
            <p>Sede Legale Motta di Livenza - Presso l'Istituto Antonio Scarpa</p>
	    </footer>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script>
			$(document).ready(function(){

					$(".header__icon-bar").click(function(e){

						$(".header__menu").toggleClass('is-open');
						e.preventDefault();

					});
			});
		</script>
	</body>
</html>