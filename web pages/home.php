<!-- TOMMASI -->
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.css">
		<link rel="stylesheet" href="css/home.css">
		<!--link per le librerie necessarie per supportare le icone-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
		integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" 
		referrerpolicy="no-referrer" />
		<title>ACCESSPORT -HOME</title>
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
			if(isset($_GET['err'])) {
				echo "<script>window.alert('";
				switch($_GET['err']) {
					case 5:
						echo "Ricontrolla i dati";
						break;
					default:
						echo "Errore generico";
						break;
				}
				echo "')</script>";
			}
		?> 
	</head>
	
	<!-- CIGANA -->
	<body>
		<header class="header clearfix">
			<a href="" class="header__logo"><img src="immagini/logoNegoziSportivi.png" alt="Logo" width="50px" /></a>
			<a href="" class="header__icon-bar">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<div class="header__menu animate">
				<div class="header__menu__item"><a href="shop/basketballPassion.php">BASKETBALL PASSION</a></div>
				<div class="header__menu__item"><a href="shop/pallavoloEverywhere.php">PALLAVOLO EVERYWHERE</a></div>
				<div class="header__menu__item"><a href="shop/racingSpirit.php">RACING SPIRIT</a></div>
				<div class="header__menu__item"><a href="shop/soccerEvolution.php">SOCCER EVOLUTION</a></div>
				<div class="header__menu__item"><a href="shop/tennisClash.php">TENNIS CLASH</a></div>
				<div class="header__menu__item"><a href="login.php">LOGIN</a></div>
				<div class="header__menu__item"><a href="account.php">ACCOUNT</a></div>
				<div class="header__menu__item"><a href="shop/carrello.php"><img src="immagini/carrello.png" alt="Carrello" width="20px" /></a></div>
			</div>
		</header>
		
		<!--
		<section class="cover">
			<div class="cover__filter"></div>
			<div class="cover__caption">
				<div class="cover__caption__copy">
					<h1>BENVENUTI IN ACCESSPORT</h1>
					<a href="" class="button"> Gift</a>	
				</div>
			</div>
		</section>

		
		<section class="banner clearfix">
			<div class="banner__image"></div>
			<div class="banner__copy">
				<div class="banner__copy__text">
					<h3>HAI BISOGNO DI UN CAPO DI ABBIGLIAMENTO SPORTIVO?</h3>
					<h4>Visita il nostro negozio ora!</h4>
					<p><b>Da noi trovi capi di solo alta qualità, vieni a trovarci.</b></p>
				</div>
			</div>
		</section>

		
		<section class="banner clearfix">
			<div class="banner__copy">
				<div class="banner__copy__text">
					<h3>NECESSITI DI PROTEZIONI PER GODERTI AL MEGLIO IL TUO SPORT PREFERITO?</h3>
					<h4>Visita il nostro negozio ora!</h4>
					<p><b>Da noi solo prodotti di qualità.</b></p>
				</div>
			</div>
			<div class="banner__image"></div>
		</section>
		-->
		<!-- TANASE -->
		<form action="home.php" method="post">
			<h1>Registrati alla nostra newsletter!</h1>
			<input type=email name=email maxlength="100" placeholder="Email" required/>
			<input type="text" name="nome" maxlength="30" placeholder="Nome" required/>
			<input type="text" name="cognome" maxlength="15" placeholder="Cognome" required/>
			<input type=text name=provincia maxlength="2" placeholder="Provincia" required/>
			<input type=text name=citta max="100" placeholder="Città" required/>
			<input type=text name=via maxlength="50" placeholder="Via" required/>
			<input type=number name=civico placeholder="Civico" min=1 max=999 required/>
			<input type=submit name=registrati value=Iscriviti />
		</form>
		<?php // TOMMASI
			if(isset($_POST['registrati'])) { // newsletter
				$db = new mysqli("localhost", "root", "", "accessport");
				$query_ricerca = "SELECT * FROM newsletter WHERE email LIKE '" . $_POST['email'] . "';";
				$utente = $db->query($query_ricerca);
				if($utente->num_rows === 0) {
					$email = $_POST['email'];
					$nome = $_POST['nome'];
					$cognome = $_POST['cognome'];
					$provincia = $_POST['provincia'];
					$citta = $_POST['citta'];
					$via = $_POST['via'];
					$numero_civico = $_POST['civico'];
					if(is_numeric($nome) || is_numeric($cognome) || is_numeric($provincia) || is_numeric($citta) || is_numeric($via) || is_numeric($email)) {
						header("location: home.php?err=5");
						die();
					}
					$query_inserimento = "INSERT INTO newsletter(`email`,`nome`,`cognome`,`provincia`,`citta`,`via`,`numero_civico`) VALUES ('$email','$nome','$cognome','$provincia','$citta','$via','$numero_civico');";
					$db->query($query_inserimento);
					$db->close();
				}
			}
		?>

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