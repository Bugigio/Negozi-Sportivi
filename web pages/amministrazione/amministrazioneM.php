<!-- CIGANA -->
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
			$_SESSION['magazzino'] = $_POST['magazzino'];
		}
		if(!isset($_SESSION['magazzino'])) {
			header("location: amministrazione.php?err=1");
			die();
		}
		if(isset($_REQUEST['err'])) {
			echo '<script> window.alert("';
			switch ($_REQUEST['err']) {
				case '1':
					echo 'Offerta non esistente';
					break;
				case '2':
					echo "Un articolo non può avere un'offerta e un rincaro";
					break;
				case '3':
					echo "Inserisci dei numeri in prezzo_acquisto/prezzo_vendita (es. 12.45; la virgola è segnata dal punto)";
					break;
				default:
					echo 'Modifica eseguita con successo';
					break;
			}
			echo '");</script>';
		}

	?>
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
		<form action="amministrazioneM.php" method="post"> <!-- TOMMASI -->
			<input type="hidden" name="nome_magazzino" value="<?php if(isset($_SESSION['magazzino'])) echo $_SESSION['magazzino']; ?>">
			<input type="submit" name="submit" value="Articoli">
			<input type="submit" name="submit" value="Utenti">
			<input type="submit" name="submit" value="Ordini">
			<input type="submit" name="submit" value="Fornitori">
			<input type="submit" name="submit" value="Offerte">
			<input type="submit" name="submit" value="Bilancio">
			<input type="submit" name="submit" value="Newsletter">
		</form>
		<?php 
			if(isset($_REQUEST['submit'])) {
				$db = new mysqli("localhost", "root", "", "accessport");
				switch ($_REQUEST['submit']) {
					case 'Articoli':
						?>
						<table border="1">
							<tr><td>Articoli</td></tr>
							<tr><td>ID_articolo</td><td>nome_articolo</td><td>tipo_articolo</td><td>quantita</td><td>prezzo acquisto</td><td>prezzo vendita</td><td>rincaro</td><td>codice offerta</td></tr>
							<?php 
							$query_articoli = "SELECT * FROM articolo WHERE nome_magazzino LIKE '" . $_SESSION['magazzino'] . "';";
							$articoli = $db->query($query_articoli);
							foreach($articoli as $a) {
								?>
								<form action="functions.php" method="post">
								<?php
								if($a["quantita"] < 10) {
									echo "<script>window.alert('Quantità articolo (ID: " . $a["ID_articolo"] . ") scarsa, rifornirlo');</script>";
								}
								echo "<tr><td><input type='number' name='ID_articolo' value='" . $a["ID_articolo"] . "' readonly /></td><td><input type='text' name='nome_articolo' value='" . $a["nome_articolo"] . "'/></td><td><input type='text' name='tipo_articolo' value='" . $a["tipo_articolo"] . "'/></td><td><input type=number name='quantita' value='" . $a["quantita"] . "'/></td><td><input type=text name='prezzo_acquisto' value='" . $a["prezzo_acquisto"] . "' readonly/></td><td><input type=text name='prezzo_vendita' value='" . $a["prezzo_vendita"] . "'/></td><td><input type=number min=0 max=100 name=rincaro value='" . $a["rincaro"] . "'/></td><td><input type=number min=1 name=cod_offerta value='" . $a["cod_offerta"] . "' /></td><td><input type=submit name=rimuovi_articolo value=Rimuovi /></td><td><input type=submit name=modifica_articolo value=Modifica /></td></tr>";
								?>
								</form>
								<?php
							}
							?>
						</table>
						<form action="functions.php" method="post">
							<table>
								<tr><td>Aggiungi un nuovo articolo</td></tr>
								<input type="hidden" name="nome_magazzino" value="<?php if(isset($_SESSION['magazzino'])) echo $_SESSION['magazzino']; ?>">
								<tr><td><input type="text" name="nome_articolo" placeholder="Nome articolo" required/></td></tr>
								<tr><td><input type="text" name="tipo_articolo" placeholder="Tipo articolo" required/></td></tr>
								<tr><td><input type="number" min=1 name="quantita" placeholder="Quantità" required/></td></tr>
								<tr><td><input type="text" name="prezzo_acquisto" placeholder="Prezzo acquisto" required/></td></tr>
								<tr><td><input type="text" name="prezzo_vendita" placeholder="Prezzo vendita" required/></td></tr>
								<tr><td><input style="width: 100%;" type="number" name="rincaro" min="0" max="100" placeholder="Rincaro (0 default) (%)" required/></td></tr>
								<tr><td><input type="number" name="cod_offerta" min="1" placeholder="Codice offerta" /></td></tr>
								<tr><td><input type="submit" name="aggiungi_articolo" value="Aggiungi"></td></tr>
							</table>
						</form>

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
								<form action="functions.php" method="post">
								<?php
								echo '<tr><td><input type="email" name="email" value="' . $u["email"] . '" readonly /></td><td><input type="text" name="nome" value="' . $u["nome"] . '" readonly /></td><td><input type="text" name="cognome" value="' . $u["cognome"] . '" readonly /></td><td><input type="text" name="citta" value="' . $u["citta"] . '" readonly /></td><td><input type="text" name="via" value="' . $u["via"] . '" readonly /></td><td><input type="number" name="numero_civico" value="' . $u["numero_civico"] . '" readonly /></td><td><input type="text" name="provincia" value="' . $u["provincia"] .'" readonly /></td><td><input type=submit name=rimuovi_utente value=Rimuovi /></td></tr>';
								?>
								</form>
								<?php
							}
							?>
						</table>
						<?php
						break;
					case 'Ordini':

						?>
						<table border="1">
							<tr><td>Ordini</td></tr>
							<tr><td>nome_articolo</td><td>quantità</td><td>costo</td><td>data_ordine</td><td>tipo_articolo</td><td>cod_ordine</td><td>negozio_ordinante</td><td>nome_fornitore</td></tr>
							<?php 
							$query_ordini = "SELECT * FROM ordini;";
							$ordini = $db->query($query_ordini);
							foreach($ordini as $o) {
								?>
								<form action="functions.php" method="post">
								<?php
								echo '<tr><td><input type="text" name="nome_articolo" value="' . $u["nome_articolo"] . '" readonly /></td><td><input type="number" name="quantita" value="' . $u["quantita"] . '" readonly /></td><td><input type="number" name="costo" value="'. $u["costo"] . '" readonly /></td><td><input type="date" name="data_ordine" value="'. $u["data_ordine"] . '" readonly /></td><td><input type="text" name="tipo_articolo" value="'. $u["tipo_articolo"] . '" readonly /></td><td><input type="number" name="cod_ordine" value="'. $u["cod_ordine"] . '" readonly /></td><td><input type="text" name="negozio_ordinante" value="'. $u["negozio_ordinante"]  . '" readonly /></td><td><input type="text" name="nome_fornitore" value="'. $u["nome_fornitore"]   .'" readonly /></td><td><input type=submit name=rimuovi_ordini value=Rimuovi /></td></tr>';
								?>
								</form>
								<?php
							}
							?>
						</table>
						<!-- <form action="functions.php" method="post"> // implementazione futura
							<table>
								<tr><td>Aggiungi un nuovo ordine</td></tr>
								<tr><td><select name="articolo">
									<option value="">Seleziona un articolo</option>
									<?php 
										// $query_magazzino = "SELECT * FROM articol;";
										// $magazzini = $db->query($query_magazzino);
										// foreach($magazzini as $m) {
										// 	echo '<option value="' . $m["nome"] . '">' . $m["nome"] . '</option>';
										// }
									?>
								</select></td></tr>
								<tr><td><input type="number" min=0 max=500 name="quantita" placeholder="Tipo articolo" required/></td></tr>
								<tr><td><input type="text" name="costo" placeholder="Costo" required/></td></tr>
								<tr><td><select name="magazzino">
									<option value="">Seleziona un negozio</option>
									<?php 
										// $query_magazzino = "SELECT * FROM magazzino;";
										// $magazzini = $db->query($query_magazzino);
										// foreach($magazzini as $m) {
										// 	echo '<option value="' . $m["nome"] . '">' . $m["nome"] . '</option>';
										// }
									?>
								</select></td></tr>
								<tr><td><select name="fornitore">
									<option value="">Seleziona un fornitore</option>
									<?php 
										// $query_fornitori = "SELECT * FROM fornitori;";
										// $fornitori = $db->query($query_fornitori);
										// foreach($fornitori as $f) {
										// 	echo '<option value="' . $f["nome"] . '">' . $f["nome"] . '</option>';
										// }
									?>
								</select></td></tr>
								<tr><td><input type="submit" name="nuovo_ordine" value="Aggiungi"></td></tr>
							</table>
						</form> -->
						<?php
						break;
					case 'Fornitori':
						?>
						<table border="1">
							<tr><td>Fornitori</td></tr>
							<tr><td>nome</td></tr>
							<?php 
							$query_fornitori = "SELECT * FROM fornitori;";
							$fornitori = $db->query($query_fornitori);
							foreach($fornitori as $f) {
								?>
								<form action="functions.php" method="post">
								<?php
								echo '<tr><td><input type=text value=' . $f["nome"] . ' readonly/></td></tr>';
								?>
								</form>
								
								<?php
							}
							?>
						</table>
						<form action="functions.php" method="post">
							<table>
								<tr><td>Aggiungi un nuovo fornitore</td></tr>
								<tr><td><input type="text" name="nome_fornitore" placeholder="Nome articolo" required/></td></tr>
								<tr><td><input type="submit" name="aggiungi_fornitore" value="Aggiungi"></td></tr>
							</table>
						</form>
						<?php
						break;
					case 'Offerte':

						?>
						<table border="1">
							<tr><td>Offerte</td></tr>
							<tr><td>ID_offerta</td><td>percentuale_sconto</td><td>data_inizio</td><td>data_fine</td></tr>
							<?php 
							$query_offerte = "SELECT * FROM offerte;";
							$offerte = $db->query($query_offerte);
							foreach($offerte as $o) {
								?>
								<form action="functions.php" method="post">
								<?php
								echo '<tr><td><input type=number name=ID_offerta value=' . $o["ID_offerta"] . ' readonly /></td><td><input type=number name=percentuale_sconto min=1 max=99 value=' . $o["percentuale_sconto"] . ' style="width: 100%;" readonly /></td><td><input type=date name=data_inizio value=' . $o["data_inizio"] . ' readonly /></td><td><input type=date name=data_fine value=' . $o["data_fine"] . ' readonly/></td><td><input type=submit name=rimuovi_offerta value=Rimuovi /></td></tr>';
								?>
								</form>
								<?php
							}
							?>
						</table>
						<form action="functions.php" method="post">
							<table>
								<tr><td>Aggiungi un nuovo articolo</td></tr>
								<tr><td><input type="number" name="percentuale_sconto" placeholder="Percentuale sconto" required/></td></tr>
								<tr><td><input type="date" name="data_inizio" placeholder="Data inizio" required/></td></tr>
								<tr><td><input type="date" name="data_fine" placeholder="Data fine" required/></td></tr>
								<tr><td><input type="submit" name="aggiungi_articolo" value="Aggiungi"></td></tr>
							</table>
						</form>
						<?php
						break;
					case 'Bilancio':

						?>
						<table border="1">
							<tr><td>Bilancio</td></tr>
							<tr><td>costi</td><td>ricavi</td><td>profitti</td><td>rincaro_20</td><td>cod_bilancio</td><td>reddito</td><td>nome_magazzino</td></tr>
							<?php 
							$query_bilancio = "SELECT * FROM bilancio;";
							$bilancio = $db->query($query_bilancio);
							foreach($bilancio as $b) {
								?>
								<form action="functions.php" method="post">
								<?php
								echo '<tr><td><input type="email" name="email" value="' . $u["email"] . '" readonly /></td><td><input type="text" name="nome" value="' . $u["nome"] . '" readonly /></td><td><input type="text" name="cognome" value="' . $u["cognome"] . '" readonly /></td><td><input type="text" name="citta" value="' . $u["citta"] . '" readonly /></td><td><input type="text" name="via" value="' . $u["via"] . '" readonly /></td><td><input type="number" name="numero_civico" value="' . $u["numero_civico"] . '" readonly /></td><td><input type="text" name="provincia" value="' . $u["provincia"] .'" readonly /></td><td><input type=submit name=rimuovi_utente value=Rimuovi /></td></tr>';
								?>
								</form>
								<?php
							}
							?>
						</table>
						<?php
						break;
					case 'Newsletter':
						?>
						<table border="1">
							<tr><td>Newsletter</td></tr>
							<tr><td>email</td><td>nome</td><td>cognome</td><td>citta</td><td>via</td><td>numero_civico</td><td>provincia</td></tr>
							<?php 
							$query_newsletter = "SELECT * FROM newsletter;";
							$newsletter = $db->query($query_newsletter);
							foreach($newsletter as $n) {
								?>
								<form action="functions.php" method="post">
								<?php
								echo '<tr><td><input type="email" name="email" value="' . $u["email"] . '" readonly /></td><td><input type="text" name="nome" value="' . $u["nome"] . '" readonly /></td><td><input type="text" name="cognome" value="' . $u["cognome"] . '" readonly /></td><td><input type="text" name="citta" value="' . $u["citta"] . '" readonly /></td><td><input type="text" name="via" value="' . $u["via"] . '" readonly /></td><td><input type="number" name="numero_civico" value="' . $u["numero_civico"] . '" readonly /></td><td><input type="text" name="provincia" value="' . $u["provincia"] .'" readonly /></td><td><input type=submit name=rimuovi_utente value=Rimuovi /></td></tr>';
								?>
								</form>
								<?php
							}
							?>
						</table>
						<?php
						break;
				}
				$db->close();
			}
		?>
    </body>
</hmtl>