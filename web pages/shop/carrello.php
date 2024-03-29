<!-- TOMMASI -->
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CARRELLO</title>
		<link rel="stylesheet" href="../css/shop.css">
		<script src="../JS/jquery.js"></script>
		<script src="../JS/prezzo_totale.js"></script>
		<?php

			if(!isset($_COOKIE['utente'])) {
				header("location: ../login.php?err=1");
			}

			if(isset($_GET['err']) && isset($_GET['nome'])) {
				echo "<script>";
				switch ($_GET['err']) {
					case 1:
						echo "window.alert('La quantità acquistata dell'articolo " . $_GET['nome'] . " non è disponibile');";
						break;
					default:
						echo "window.alert('Errore generico');";
						break;
				}
				echo "</script>";
			}

			if(isset($_GET['success'])) {
				echo "<script>";
				switch ($_GET['success']) {
					case 1:
						echo "window.alert('Acquisto completato');";
						break;
				}
				echo "</script>";
			}

			if(isset($_GET['acquista'])) {
				$db = new mysqli("localhost", "root", "", "my_negozisportivi");

				$query_conteggio_articoli = "SELECT ar.ID_articolo, ar.nome_articolo , COUNT(*) AS quantita FROM acquistare as a\n"

				. "JOIN articolo as ar on ar.ID_articolo = a.id_articolo\n"

				. "WHERE a.email_utente LIKE '" . $_COOKIE['utente'] . "' AND a.carrello = 1\n"
			
				. "GROUP BY ar.ID_articolo, ar.nome_articolo;";

				$articoli = $db->query($query_conteggio_articoli);

				foreach($articoli as $a) { // controllo se la quantità dell'articolo nel database è maggiore a quella da acquistare
					$query_verifica_quantità = "SELECT * FROM articolo AS a WHERE a.ID_articolo = " . $a["ID_articolo"] . ";";
					$quantita = $db->query($query_verifica_quantità);
					foreach($quantita as $q) {
						if($q["quantita"] < $a["quantita"]) {
							header("location: carrello.php?err=1&nome=" . $a["nome_articolo"]);
							die();
						}
						$quantita_da_aggiornare = $q["quantita"] - $a["quantita"];
						$query_aggiornamento_quantita = "UPDATE articolo SET quantita = " . $quantita_da_aggiornare . " WHERE ID_articolo = " . $a["ID_articolo"] . ";";
						$db->query($query_aggiornamento_quantita);
					}
				}

				$query_acquista = "UPDATE acquistare SET carrello = 0 WHERE email_utente LIKE '" . $_COOKIE["utente"] . "' AND carrello = '1';";
				$db->query($query_acquista);
				header("location: carrello.php?success=1");
				$db->close();
			}
		?>
	</head>

	<!-- CIGANA -->
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
				<div class="header__menu__item"><a href="tennisClash.php">TENNIS CLASH</a></div>
				<div class="header__menu__item"><a href="../account.php">ACCOUNT</a></div>
				<div class="header__menu__item"><a href="../index.php?logout=1">LOGOUT</a></div>
			</div>
		</header>

		<!-- TOMMASI -->
		<div class="container">
			<?php 
				$db = new mysqli("localhost", "root", "", "my_negozisportivi");
				$query = "SELECT * FROM articolo
				JOIN acquistare AS a ON a.id_articolo = articolo.ID_articolo WHERE a.email_utente LIKE '" . $_COOKIE["utente"] . "' AND a.carrello = 1;";
				$articoli = $db->query($query);
				foreach($articoli as $a) {
					?>
					<div class="articolo">
						<form action="aggiungi_rimuovi_carrello.php" method="post">
							<h3><?php echo $a["nome_articolo"]; ?></h3>
							<p><?php echo $a["tipo_articolo"]; ?></p>
							<p><?php // prezzo articolo se offerta o meno
								$prezzo = 0;
								if($a["cod_offerta"] == NULL) {
									$prezzo = number_format(($a["prezzo_vendita"] + ($a["prezzo_vendita"]/100*$a["rincaro"])), 2, ",", "."); 
									echo $prezzo;
								} else {
									$query_offerta = "SELECT * FROM offerte WHERE ID_offerta = " . $a["cod_offerta"] . " AND data_fine >= CURRENT_DATE;"; // verifica se l'offerta è scaduta
									$offerta = $db->query($query_offerta);
									if($offerta->num_rows !== 0) {
										foreach($offerta as $o) {
											echo number_format(($a["prezzo_vendita"] - ($a["prezzo_vendita"]/100*$o["percentuale_sconto"])), 2, ".", ",") . " <s>" . $a["prezzo_vendita"] . "</s><br>";
											$prezzo = number_format(($a["prezzo_vendita"] - ($a["prezzo_vendita"]/100*$o["percentuale_sconto"])), 2, ".", ",");
											echo "Questa offerta è valida fino al " . $o["data_fine"];
										}
									} else { // nel caso sia scaduta l'offerta
										$prezzo = number_format(($a["prezzo_vendita"] + ($a["prezzo_vendita"]/100*$a["rincaro"])), 2, ".", ",");
										echo $prezzo;
										$query_rimozione_offerta = "UPDATE articolo SET cod_offerta = NULL WHERE ID_articolo = " . $a["ID_articolo"] . ";";
										$db->query($query_rimozione_offerta);
									}
								}
								$query_prezzo_pagato = "UPDATE acquistare SET prezzo_pagato = '" . $prezzo . "' WHERE id_articolo = " . $a["ID_articolo"] . ";";
								$db->query($query_prezzo_pagato);
							?></p>
							<input type="hidden" name="prezzo_pagato" value="<?php echo $prezzo; ?>">
							<input type="hidden" name="data/ora_acquisto" value="<?php echo $a["data/ora_acquisto"]?>">
							<input type="hidden" name="id_articolo" value="<?php echo $a["ID_articolo"]; ?>"/>
							<input type="submit" class="rimuovi-dal-carrello" name="rimuovi" value="Rimuovi articolo"/>
						</form>
					</div>
					<?php
				}
			?>
			<a href="<?php echo $_SERVER['PHP_SELF']; ?>?acquista=1"><input type="button" class="acquista-articoli" name="acquista" value="Acquista"/></a>
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