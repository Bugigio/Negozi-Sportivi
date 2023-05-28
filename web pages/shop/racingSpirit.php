<!-- CIGANA -->
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>RACING SPIRIT</title>
		<link rel="stylesheet" href="../../css/shop.css">
	</head>
	<body>
		<header class="header clearfix">
			<a href="" class="header__logo">Logo</a>
			<a href="" class="header__icon-bar">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<div class="header__menu animate">
				<div class="header__menu__item"><a href="basketballPassion.php">BASKETBALL PASSION</a></div>
				<div class="header__menu__item"><a href="pallavoloEverywhere.php">PALLAVOLO EVERYWHERE</a></div>
				<div class="header__menu__item"><a href="soccerEvolution.php">SOCCER EVOLUTION</a></div>
				<div class="header__menu__item"><a href="tennisClash.php">TENNIS CLASH</a></div>
				<div class="header__menu__item"><a href="../account.php">ACCOUNT</a></div>
				<div class="header__menu__item"><a href="../home.php?logout=1">LOGOUT</a></div>
			</div>
		</header>

		<!-- TOMMASI -->
		<div class="container">
			<?php 
				$db = new mysqli("localhost", "root", "", "accessport");
				$query = "SELECT * FROM articolo WHERE nome_magazzino LIKE 'RACING SPIRIT';";
				$articoli = $db->query($query);
				foreach($articoli as $a) {
					?>
					<div class="articolo">
						<h3><?php echo $a["nome_articolo"]; ?></h3>
						<img src="<?php echo $a["percorso_immagine"]; ?>" alt="immagine articolo">
						<p><?php echo $a["tipo_articolo"]; ?></p>
						<input type="button" value="<?php echo $a["ID_articolo"]; ?>">
					</div>
					<?php
				}
			?>
		</div>

		<!-- CIGANA -->
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