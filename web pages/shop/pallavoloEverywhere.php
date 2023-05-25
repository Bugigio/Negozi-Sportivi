<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pallavolo Everywhere</title>
		<link rel="stylesheet" href="../../css/shop.css">
	</head>
	<body>
		<header>
			<div><a href="shop/basketballPassion.php"><button>Basketball Passion</button></a></div>
			<div><a href="shop/racingSpirit.php"><button>Racing Spirit</button></a></div>
			<div><a href="shop/soccerEvolution.php"><button>Soccer Evolution</button></a></div>
			<div><a href="shop/tennisClash.php"><button>Tennis Clash</button></a></div>
			<div><a href="../account.php"><button>ACCOUNT</button></a></div>
			<div><a href="../home.php?logout=1"><button>LOGOUT</button></a></div>
		</header>
		<div class="container">
			<?php 
				$db = new mysqli("localhost", "root", "", "accessport");
				$query = "SELECT * FROM articolo WHERE nome_magazzino LIKE 'Pallavolo Everywhere';";
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
	</body>
</html>