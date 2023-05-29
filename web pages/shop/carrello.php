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

			if(isset($_POST['rimuovi'])) {
				$db = new mysqli("localhost", "root", "", "accessport");
				$query = "DELETE FROM acquistare WHERE carrello = 1 AND email_utente LIKE '" . $_COOKIE["utente"] . "' AND id_articolo = " . $_POST['id_articolo'] . ";";
				$db->query($query);
				$db->close();
				header("location: " . $_SERVER['PHP_SELF']);
			} // trovare un metodo per rimuovere gli articoli

			if(isset($_GET['acquista'])) {
				$db = new mysqli("localhost", "root", "", "accessport");
				$query_acquista = "UPDATE acquistare SET carrello = '0' WHERE email_utente LIKE '" . $_COOKIE["utente"] . "' AND carrello = '1';";
				$db->query($query_acquista);
				header("location: carrello.php");
				$db->close();
			}

			if(isset($_POST['id_articolo'])) {
				// funzione di aggiungimento al carrello
				header("Access-Control-Allow-Origin: *");
				$db = new mysqli("localhost", "root", "", "accessport");
				$query_aggiungi_al_carrello = "INSERT INTO `acquistare`(`id_articolo`, `email_utente`, `carrello`) VALUES ('" . $_POST['id_articolo'] . "', '" . $POST['email_utente'] . "', '1');";
				$db->query($query_aggiungi_al_carrello);
				$db->close();
				echo 1;
				die();
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
				<?php 
					$db = new mysqli("localhost", "root", "", "accessport");
					$query = "SELECT * FROM articolo
					JOIN acquistare AS a ON a.id_articolo = articolo.ID_articolo WHERE a.email_utente LIKE '" . $_COOKIE["utente"] . "' AND a.carrello = 1;";
					$articoli = $db->query($query);
					foreach($articoli as $a) {
						?>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="articolo">
								<h3><?php echo $a["nome_articolo"]; ?></h3>
								<img src="<?php echo $a["percorso_immagine"]; ?>" alt="immagine articolo" />
								<p><?php echo $a["tipo_articolo"]; ?></p>
								<p><?php echo number_format(($a["prezzo_vendita"] + ($a["prezzo_vendita"]/100*$a["rincaro"])), 2, ",", "."); ?></p>
								<input type="hidden" name="id_articolo" value="<?php echo $a["ID_articolo"]; ?>"/>
								<input type="submit" name="rimuovi" value="Rimuovi articolo">
							</div>
						</form>
						<?php
					}
				?>
				<a href="<?php echo $_SERVER['PHP_SELF']; ?>?acquista=1"><input type="button" name="acquista" value="Acquista"/></a>
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