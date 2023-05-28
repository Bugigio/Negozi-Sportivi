<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>BASKETBALL PASSION</title>
		<link rel="stylesheet" href="../../css/shop.css">
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
			<?php 
				$db = new mysqli("localhost", "root", "", "accessport");
				$query = "SELECT * FROM articolo WHERE nome_magazzino LIKE 'TENNIS CLASH';";
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