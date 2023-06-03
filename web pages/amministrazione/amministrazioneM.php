<!-- TANASE -->
<!-- TOMMASI -->
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.css">
		<link rel="stylesheet" href="../css/shop.css">
		<!--link per le librerie necessarie per supportare le icone-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
		integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" 
		referrerpolicy="no-referrer" />
        <title>AMMINISTRAZIONE MAGAZZINO</title>
    </head>
    

<!-- TOMMASI -->
<?php 
    if(!isset($_COOKIE["dipendente"])) {
        header("location: login.php?err=5");
        die();
    }
    if(!isset($_POST['magazzino'])) {
        header("location: amministrazione.php");
        die();
    }
?>
<html>
	<body>
        <!-- CIGANA -->
        <header class="header clearfix">
            <a href="" class="header__logo"><img src="../immagini/logoNegoziSportivi.png" alt="Logo" width="50px" /></a>
			<a href="" class="header__icon-bar">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<div class="header__menu animate">
                <div class="header__menu__item"><a href="../home.php?logout=0">LOGOUT</a></div>
			</div>
		</header>
        <h1>AMMINISTRAZIONE MAGAZZINO</h1>
		<form action="#" method="post">
			<input type="hidden" name="magazzino" value="<?php if(isset($_POST['magazzino'])) echo $_POST['magazzino']; ?>">
			<input type="submit" name="submit" value="Articoli">
			<input type="submit" name="submit" value="Utenti">
			<input type="submit" name="submit" value="Ordini">
			<input type="submit" name="submit" value="Fornitori">
			<input type="submit" name="submit" value="Offerte">
			<input type="submit" name="submit" value="Bilancio">
			<input type="submit" name="submit" value="Newsletter">
		</form>
		<?php 
			if(isset($_POST['submit'])) {
				$db = new mysqli("localhost", "root", "", "accessport");
				switch ($_POST['submit']) {
					case 'Articoli':
						?>
						<form action="#" method="post">
							<table border="1">
								<tr><td>Articoli</td></tr>
								<tr><td>ID_articolo</td><td>nome_articolo</td><td>tipo_articolo</td><td>quantita</td><td>prezzo acquisto</td><td>prezzo vendita</td><td>rincaro</td><td>codice offerta</td></tr>
								<?php 
								$query_articoli = "SELECT * FROM articolo WHERE nome_magazzino LIKE '" . $_POST['magazzino'] . "';";
								$articoli = $db->query($query_articoli);
								$i = 1;
								foreach($articoli as $a) {
									echo "<tr><td><input type='number' name='ID_articolo_$i' value='" . $a["ID_articolo"] . "' readonly /></td><td><input type='text' name='nome_articolo_$i' value='" . $a["nome_articolo"] . "'/></td><td><input type='text' name='tipo_articolo_$i' value='" . $a["tipo_articolo"] . "'/></td><td><input type=number name='quantita_$i' value='" . $a["quantita"] . "'/></td><td><input type=text name='prezzo_acquisto_$i' value='" . $a["prezzo_acquisto"] . "' readonly/></td><td><input type=text name='prezzo_vendita_$i' value='" . $a["prezzo_vendita"] . "'/></td><td><input type=number min=0 max=100 name=rincaro value='" . $a["rincaro"] . "'/></td><td><input type=number value='" . $a["cod_offerta"] . "' readonly/></td></tr>";
									$i++;
								}
								?>
							</table>
						</form>

						<?php
						break;
					case 'Utenti':
						# code...
						break;
					case 'Ordini':
						# code...
						break;
					case 'Fornitori':
						# code...
						break;
					case 'Offerte':
						# code...
						break;
					case 'Bilancio':
						# code...
						break;
					case 'Newsletter':
						# code...
						break;
				}
			}
		?>
    </body>
</hmtl>