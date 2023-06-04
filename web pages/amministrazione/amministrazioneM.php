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
	session_start();
    if(isset($_POST['magazzino'])) {
        $_SESSION['magazzino'] = true;
    }
	if(!isset($_SESSION['magazzino'])) {
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
						<table border="1">
							<tr><td>Articoli</td></tr>
							<tr><td>ID_articolo</td><td>nome_articolo</td><td>tipo_articolo</td><td>quantita</td><td>prezzo acquisto</td><td>prezzo vendita</td><td>rincaro</td><td>codice offerta</td></tr>
							<?php 
							$query_articoli = "SELECT * FROM articolo WHERE nome_magazzino LIKE '" . $_POST['magazzino'] . "';";
							$articoli = $db->query($query_articoli);


							foreach($articoli as $a) {
								?>
								<form action="#" method="post">
								<?php
								echo "<tr><td><input type='number' name='ID_articolo' value='" . $a["ID_articolo"] . "' readonly /></td><td><input type='text' name='nome_articolo' value='" . $a["nome_articolo"] . "'/></td><td><input type='text' name='tipo_articolo' value='" . $a["tipo_articolo"] . "'/></td><td><input type=number name='quantita' value='" . $a["quantita"] . "'/></td><td><input type=text name='prezzo_acquisto' value='" . $a["prezzo_acquisto"] . "' readonly/></td><td><input type=text name='prezzo_vendita' value='" . $a["prezzo_vendita"] . "'/></td><td><input type=number min=0 max=100 name=rincaro value='" . $a["rincaro"] . "'/></td><td><input type=number value='" . $a["cod_offerta"] . "' readonly/></td><td><input type=submit name=rimuovi_articolo value=Rimuovi /></td><td><input type=submit name=modifica_articolo value=Modifica /></td></tr>";
								?>
								</form>
								<?php
							}
							?>
							</form>
						</table>
						

						<?php
						break;
					case 'Utenti':
						?>
						<table border="1">
							<tr><td>Utenti</td></tr>
							<tr><td>Email</td><td>nome</td><td>cognome</td><td>citta</td><td>via</td><td>numero_civico</td><td>provincia</td></tr>
							<?php 
							$query_utenti = "SELECT * FROM utenti;";
							$utenti = $db->query($query_utenti);
							foreach($utenti as $u) {
								?>
								<form action="#" method="post">
								<?php
								echo '<tr><td><input type="email" name="email" value="' . $u["email"] . '" readonly></td><td><input type="text" name="nome" value="' . $u["nome"] . '" readonly></td><td><input type="text" name="cognome" value="' . $u["cognome"] . '" readonly></td><td><input type="text" name="citta" value="' . $u["citta"] . '" readonly></td><td><input type="text" name="via" value="' . $u["via"] . '" readonly></td><td><input type="number" name="numero_civico" value="' . $u["numero_civico"] . '" readonly></td><td><input type="text" name="provincia" value="' . $u["provincia"] .'" readonly></td><td><input type=submit name=rimuovi_utente value=Rimuovi /></td></tr>';
								?>
								</form>
								<?php
							}
							?>
							
						</table>
						<?php
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
			} else if(isset($_POST['rimuovi_articolo'])) {
				$id_articolo = $_POST['ID_articolo'];
				$db = new mysqli("localhost", "root", "", "accessport");
				$query_rimozione_acquisti = "DELETE FROM acquistare WHERE id_articolo = $id_articolo;";
				$db->query($query_rimozione_acquisti);
				$query = "DELETE FROM articolo WHERE ID_articolo = $id_articolo;";
				$db->query($query);
			}
		?>
    </body>
</hmtl>