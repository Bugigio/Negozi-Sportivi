<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.css">
		<link rel="stylesheet" href="../css/home.css">
		<title>Home</title>
		<style>
			header {
				display: flex;
				flex-direction: row;
			}
		</style>
		<?php 
			if(isset($_GET['logout'])) {
				switch($_GET['logout']) {
					case 1:
						setcookie("utente", "", time()-86400, "/");
						break;
					case 0:
						setcookie("dipendente", "", time()-86400, "/");
						break;
				}
			}
		?> 
	</head>
	<body>
		<header>
			<div><a href="shop/basketballPassion.php"><button>BASKETBALL PASSION</button></a></div>
			<div><a href="shop/pallavoloEverywhere.php"><button>PALLAVOLO EVERYWHERE</button></a></div>
			<div><a href="shop/racingSpirit.php"><button>RACING SPIRIT</button></a></div>
			<div><a href="shop/soccerEvolution.php"><button>SOCCER EVOLUTION</button></a></div>
			<div><a href="shop/tennisClash.php"><button>TENNIS CLASH</button></a></div>
			<div><a href="login.php"><button>LOGIN</button></a></div>
			<div><a href="registrati.php"><button>REGISTRATI</button></a></div>
		</header>
		
		<!--
		<header class="header clearfix">
			<a href="" class="header__icon-bar">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<div class="header__menu__item"><a href="shop1.php"><button>SHOP1</button></a></div>
			<div class="header__menu__item"><a href="shop2.php"><button>SHOP 2</button></a></div>
			<div class="header__menu__item"><a href="shop3.php"><button>SHOP 3</button></a></div>
			<div class="header__menu__item"><a href="shop4.php"><button>SHOP 4</button></a></div>
			<div class="header__menu__item"><a href="login.php"><button>LOGIN</button></a></div>
			<div class="header__menu__item"><a href="signIn.php"><button>REGISTRATI</button></a></div>
		</header>
		-->
		<form action="home.php" method="post">
			<h1>Registrati alla nostra newsletter!</h1>
			<input type=email name=email placeholder="Email" required/>
			<input type=text name=provincia placeholder="Provincia" required/>
			<input type=text name=città placeholder="Città" required/>
			<input type=text name=via placeholder="Via" required/>
			<input type=number name=civico placeholder="Civico" min=1 max=999 required/>
			<input type=submit name=registrati value=Iscriviti/>
		</form>



		<!--FOOTER-->
        <footer class="footer">
            <p>© Copyright 2023 Gabriele Tommasi, Lorenzo Barattin, Alexandru Tanase & Andrea Cigana</p>
            <p>Sede Legale Motta di Livenza - Presso l'Istituto Antonio Scarpa</p>
	    </footer>
	</body>
</html>