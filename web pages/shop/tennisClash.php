<!-- CIGANA -->
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TENNIS CLASH</title>
		<link rel="stylesheet" href="../css/shop.css">
		<script src="../JS/jquery.js"></script>
		<script src="../JS/prezzo_totale.js"></script>
	</head>
	<body>
		<header class="header clearfix">
			<a href="" class="header__logo"><img src="../immagini/logoNegoziSportivi.png" alt="Logo" width="50px" /></a>
			<a href="" class="header__icon-bar">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<div class="header__menu animate">
				<div class="header__menu__item"><a href="basketballPassion.php">BASKETBALL PASSION</a></div>
				<div class="header__menu__item"><a href="pallavoloEverywhere.php">PALLAVOLO EVERYWHERE</a></div>
				<div class="header__menu__item"><a href="racingSpirit.php">RACING SPIRIT</a></div>
				<div class="header__menu__item"><a href="soccerEvolution.php">SOCCER EVOLUTION</a></div>
				<div class="header__menu__item"><a href="../account.php">ACCOUNT</a></div>
				<div class="header__menu__item"><a href="../home.php?logout=1">LOGOUT</a></div>
				<div class="header__menu__item"><a href="../shop/carrello.php"><img src="../immagini/carrello.png" alt="Carrello" width="20px" /></a></div>
			</div>
		</header>

		<!-- TOMMASI -->
		<div class="container">
			<?php 
				$db = new mysqli("localhost", "root", "", "my_negozisportivi");
				$query = "SELECT *\n"

				. "FROM articolo\n"
			
				. "LEFT JOIN offerte ON offerte.ID_offerta = articolo.cod_offerta\n"
			
				. "WHERE articolo.nome_magazzino LIKE 'TENNIS CLASH'\n"
			
				. "ORDER BY IF(offerte.data_fine IS NULL, 1, 0), offerte.data_fine;";
				$articoli = $db->query($query);
				foreach($articoli as $a) {
					?>
					<div class="articolo">
						<h3><?php echo $a["nome_articolo"]; ?></h3>
						<p><?php echo $a["tipo_articolo"]; ?></p>
						<p><?php // prezzo articolo se offerta o meno
							if($a["cod_offerta"] == NULL) { // verifica se un'offerta è associata all'articolo
								echo number_format(($a["prezzo_vendita"] + ($a["prezzo_vendita"]/100*$a["rincaro"])), 2, ".", ","); 
							} else {
								$query_offerta = "SELECT * FROM offerte WHERE ID_offerta = " . $a["cod_offerta"] . " AND data_fine >= CURRENT_DATE;"; // verifica se l'offerta è scaduta
								$offerta = $db->query($query_offerta);
								if($offerta->num_rows !== 0) {
									foreach($offerta as $o) {
										echo number_format(($a["prezzo_vendita"] - ($a["prezzo_vendita"]/100*$o["percentuale_sconto"])), 2, ".", ",") . " <s>" . $a["prezzo_vendita"] . "</s><br>";
										echo "Questa offerta è valida fino al " . $o["data_fine"];
									}
								} else { // nel caso sia scaduta l'offerta
									echo number_format(($a["prezzo_vendita"] + ($a["prezzo_vendita"]/100*$a["rincaro"])), 2, ".", ",");
									$query_rimozione_offerta = "UPDATE articolo SET cod_offerta = NULL WHERE ID_articolo = " . $a["ID_articolo"] . ";";
									$db->query($query_rimozione_offerta);
								}
							}
						?></p>
						<input type="hidden" value="<?php echo $a["ID_articolo"]; ?>" />
						<input type="button" class="aggiungi-al-carrello" onclick="<?php echo "aggiungiAlCarrello('" . $a["ID_articolo"] .  "', '" . $_COOKIE["utente"] . "')"; ?>" value="Aggiungi al carrello" />
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