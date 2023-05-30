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
    <head>
        <title>Amministrazione magazzino</title>
    </head>
    <body>
        <h1>Amministrazione magazzino</h1>
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