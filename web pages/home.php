<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/home.css">
		<title>Home</title>
		<style>
			header {
				display: flex;
				flex-direction: row;
			}
		</style>
	</head>
	<body>
		<header>
			<div><a href="basketballPassion.php"><button>Basketball Passion</button></a></div>
			<div><a href="pallavoloEverywhere.php"><button>Pallavolo Everywhere</button></a></div>
			<div><a href="racingSpirit.php"><button>Racing Spirit</button></a></div>
			<div><a href="soccerEvolution.php"><button>Soccer Evolution</button></a></div>
			<div><a href="tennisClash.php"><button>Tennis Clash</button></a></div>
			<div>
				<a href="login.php"><button>Login</button></a>
			</div>
			<div>
				<a href="registrati.php"><button>Registrati</button></a>
			</div>
		</header>
		<form action="home.php" method="post">
			<h1>Registrati alla nostra newsletter!</h1>
			<input type=email name=email placeholder="Email" required/>
			<input type=text name=provincia placeholder="Provincia" required/>
			<input type=text name=città placeholder="Città" required/>
			<input type=text name=via placeholder="Via" required/>
			<input type=number name=civico placeholder="Civico" min=1 max=999 required/>
			<input type=submit name=registrati value=Iscriviti />
		</form>



		<!--FOOTER-->
        <footer class="footer">
            <p>© Copyright 2023 Gabriele Tommasi, Lorenzo Barattin, Alexandru Tanase & Andrea Cigana</p>
            <p>Sede Legale Motta di Livenza - Presso l'Istituto Antonio Scarpa</p>
	    </footer>
	</body>
</html>