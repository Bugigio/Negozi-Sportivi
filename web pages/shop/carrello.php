<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>BASKETBALL PASSION</title>
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
	<body>
		<header class="header clearfix">
			<a href="" class="header__icon-bar">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<div class="header__menu animate">
				<div><a href="pallavoloEverywhere.php"><button>PALLAVOLO EVERYWHERE</button></a></div>
				<div><a href="racingSpirit.php"><button>RACING SPIRIT</button></a></div>
				<div><a href="soccerEvolution.php"><button>SOCCER EVOLUTION</button></a></div>
				<div><a href="tennisClash.php"><button>TENNIS CLASH</button></a></div>
				<div><a href="../account.php"><button>ACCOUNT</button></a></div>
				<div><a href="../home.php?logout=1"><button>LOGOUT</button></a></div>
			</div>
		</header>
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
	</body>
</html>