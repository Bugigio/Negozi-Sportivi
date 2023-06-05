<?php 
	if(isset($_POST['modifica_articolo'])) {
		$db = new mysqli("localhost", "root", "", "accessport");
		if($_POST['cod_offerta']) {
			$query_offerte = "SELECT * FROM offerte WHERE ID_offerta = '" . $_POST['cod_offerta'] . "';";
			$offerte = $db->query($query_offerte);
			if($offerte->num_rows === 0) {
				header("location: amministrazioneM.php?err=1");
				die();
			}
			if($_POST['cod_offerta'] != 0 && $_POST['rincaro'] != 0) {
				header("location: amministrazioneM.php?err=2");
				die();
			}
			$query = "UPDATE articolo SET nome_articolo = '" .  $_POST['nome_articolo'] . "', tipo_articolo = '" . $_POST['tipo_articolo'] . "', quantita = '" . $_POST['quantita'] . "', prezzo_vendita = '" . $_POST['prezzo_vendita'] . "', rincaro = '" . $_POST['rincaro'] . "', cod_offerta = '" . $_POST['cod_offerta'] . "' WHERE ID_articolo = " . $_POST['ID_articolo'] . ";";
		} else {
			$query = "UPDATE articolo SET nome_articolo = '" .  $_POST['nome_articolo'] . "', tipo_articolo = '" . $_POST['tipo_articolo'] . "', quantita = '" . $_POST['quantita'] . "', prezzo_vendita = '" . $_POST['prezzo_vendita'] . "', rincaro = '" . $_POST['rincaro'] . "' WHERE ID_articolo = " . $_POST['ID_articolo'] . ";";
		}
		
		$db->query($query);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}
	if(isset($_POST['aggiungi_articolo'])) {
		$db = new mysqli("localhost", "root", "", "accessport");
		
		if(!is_numeric($_POST['prezzo_acquisto']) || !is_numeric($_POST['prezzo_vendita'])) {
			header("location: amministrazioneM.php?err=3");
			die();
		}
		if($_POST['cod_offerta']) {
			$query_offerte = "SELECT * FROM offerte WHERE ID_offerta = " . $_POST['cod_offerta'] . ";";
			$offerte = $db->query($query_offerte);
			if($offerte->num_rows === 0) {
				header("location: amministrazioneM.php?err=1");
				die();
			}
			if($_POST['cod_offerta'] != 0 && $_POST['rincaro'] != 0) {
				header("location: amministrazioneM.php?err=2");
				die();
			}
			$query_inserimento = "INSERT INTO `articolo` (`quantita`, `tipo_articolo`, `nome_articolo`, `prezzo_acquisto`, `prezzo_vendita`, `rincaro`, `nome_magazzino`, `cod_offerta`) VALUES ('" . $_POST['quantita'] . "','" . $_POST['tipo_articolo'] . "','" . $_POST['nome_articolo'] . "','" . $_POST['prezzo_acquisto'] . "','" . $_POST['prezzo_vendita'] . "','". $_POST['rincaro'] . "','" . $_POST['nome_magazzino'] . "','" . $_POST['cod_offerta'] . "');";
		} else {
			$query_inserimento = "INSERT INTO `articolo` (`quantita`, `tipo_articolo`, `nome_articolo`, `prezzo_acquisto`, `prezzo_vendita`, `rincaro`, `nome_magazzino`) VALUES ('" . $_POST['quantita'] . "','" . $_POST['tipo_articolo'] . "','" . $_POST['nome_articolo'] . "','" . $_POST['prezzo_acquisto'] . "','" . $_POST['prezzo_vendita'] . "','". $_POST['rincaro'] . "','" . $_POST['nome_magazzino'] . "');";
		}
		
		$db->query($query_inserimento);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}
	if(isset($_POST['rimuovi_articolo'])) {
		$id_articolo = $_POST['ID_articolo'];
		$db = new mysqli("localhost", "root", "", "accessport");
		$query_rimozione_acquisti = "DELETE FROM acquistare WHERE id_articolo = $id_articolo;";
		$db->query($query_rimozione_acquisti);
		$query = "DELETE FROM articolo WHERE ID_articolo = $id_articolo;";
		$db->query($query);
		header("location: amministrazioneM.php?err");
		die();
	}
	if(isset($_POST['rimuovi_utente'])) {
		$db = new mysqli("localhost", "root", "", "accessport");
		$email_utente = $_POST['email'];
		$query_rimozione_acquisti = "DELETE FROM acquistare WHERE email_utente LIKE '$email';";
		$query_rimozione = "DELETE FROM utenti WHERE email_utente LIKE '$email';";
		$db->query($query_rimozione_acquisti);
		$db->query($query_rimozione);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}
	if(isset($_POST['aggiungi_fornitore'])) {
		$db = new mysqli("localhost", "root", "", "accessport");
		$query_inserimento = "INSERT INTO fornitori(`nome`) VALUES('" . $_POST['nome_fornitore'] . "');";
		$db->query($query_inserimento);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}
?>