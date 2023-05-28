<!-- TOMMASI -->
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CARRELLO</title>
		<link rel="stylesheet" href="../../css/shop.css">
		<script src="../JS/prezzo_totale.js"></script>
		<?php 
			if(isset($_POST['rimuovi'])) {} // trovare un metodo per rimuovere gli articoli

			if(isset($_POST['acquista'])) {
				$db = new mysqli("localhost", "root", "", "accessport");
				$query_acquista = "UPDATE acquistare SET carrello = 0 WHERE email_utente LIKE '" . $_COOKIE["utente"] . "' AND carrello = 1;";
				$db->query($query_acquista);
				header("location: carrello.php");
			}
		?>
	</head>

	<!-- CIGANA -->
	<body>
		<header class="header clearfix">
			<a href="" class="header__icon-bar">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<div class="header__menu animate">
				<div class="header__menu__item"><a href="../home.php">HOME</a></div>
				<div class="header__menu__item"><a href="basketballPassion.php">BASKETBALL PASSION</a></div>
				<div class="header__menu__item"><a href="pallavoloEverywhere.php">PALLAVOLO EVERYWHERE</a></div>
				<div class="header__menu__item"><a href="racingSpirit.php">RACING SPIRIT</a></div>
				<div class="header__menu__item"><a href="soccerEvolution.php">SOCCER EVOLUTION</a></div>
				<div class="header__menu__item"><a href="tennisClash.php">TENNIS CLASH</a></div>
				<div class="header__menu__item"><a href="../account.php">ACCOUNT</a></div>
			</div>
		</header>

		<!-- TOMMASI -->
		<div class="container">
			<form action="carrello.php" method="post">
				<?php 
					$db = new mysqli("localhost", "root", "", "accessport");
					$query = "SELECT * FROM articolo
					JOIN acquistare AS a ON a.id_articolo = articolo.ID_articolo WHERE a.email_utente LIKE '" . $_COOKIE["utente"] . "' AND a.carrello = 1;";
					$articoli = $db->query($query);
					foreach($articoli as $a) {
						?>
						<div class="articolo">
							<h3><?php echo $a["nome_articolo"]; ?></h3>
							<img src="<?php echo $a["percorso_immagine"]; ?>" alt="immagine articolo">
							<p><?php echo $a["tipo_articolo"]; ?></p>
							<p><?php echo $a["prezzo_vendita"]; ?></p>
							<input type="hidden" value="<?php echo $a["ID_articolo"]; ?>">

						</div>
						<?php
					}
				?>
				<input type="submit" name="acquista" value="Acquista">
			</form>
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