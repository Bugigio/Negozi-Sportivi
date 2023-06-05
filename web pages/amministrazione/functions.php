<?php 
	if(isset($_POST['modifica_articolo'])) {
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
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
		$query_conteggio_quantita = "SELECT SUM(quantita) AS conteggio FROM articolo WHERE nome_magazzino LIKE '" . $_POST['nome_magazzino'] . "';";
		$dati = $db->query($query_conteggio_quantita);
		foreach($dati as $d) {
			if($d["conteggio"] > 500) {
				header("location: amministrazioneM.php?err=7");
				die();
			}
		}
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}


	if(isset($_POST['aggiungi_articolo'])) {
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
		
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
		
		$query_conteggio_quantita = "SELECT SUM(quantita) AS conteggio FROM articolo WHERE nome_magazzino LIKE '" . $_POST['nome_magazzino'] . "';";
		$dati = $db->query($query_conteggio_quantita);
		foreach($dati as $d) {
			if($d["conteggio"] + $_POST['quantita'] > 500) {
				header("location: amministrazioneM.php?err=6");
				die();
			}
		}

		$db->query($query_inserimento);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}


	if(isset($_POST['rimuovi_articolo'])) {
		$id_articolo = $_POST['ID_articolo'];
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
		$query_rimozione_acquisti = "DELETE FROM acquistare WHERE id_articolo = $id_articolo;";
		$db->query($query_rimozione_acquisti);
		$query = "DELETE FROM articolo WHERE ID_articolo = $id_articolo;";
		$db->query($query);
		header("location: amministrazioneM.php?err");
		die();
	}


	if(isset($_POST['rimuovi_utente'])) {
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
		$email_utente = $_POST['email'];
		$query_rimozione_acquisti = "DELETE FROM acquistare WHERE email_utente LIKE '$email';";
		$query_rimozione = "DELETE FROM utenti WHERE email LIKE '$email';";
		$db->query($query_rimozione_acquisti);
		$db->query($query_rimozione);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}


	if(isset($_POST['aggiungi_fornitore'])) {
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
		$query_inserimento = "INSERT INTO fornitori(`nome`) VALUES('" . $_POST['nome_fornitore'] . "');";
		$db->query($query_inserimento);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}


	if(isset($_POST['aggiungi_offerta'])) {
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
		$data_iniziale = $_POST['data_iniziale']; // La data originale nel formato "gg/mm/aaaa"
		$data_finale = $_POST['data_finale'];

		// Converto la data nel formato "aaaa-mm-gg"
		$data_iniziale_convertita = date('Y-m-d', strtotime($data_iniziale));
		$data_finale_convertita = date("Y-m-d", strtotime($data_finale));

		echo $data_iniziale_convertita;
		echo $data_finale_convertita;

		$query_inserimento = "INSERT INTO offerte(`percentuale_sconto`, `data_inizio`, `data_fine`) VALUES('" . $_POST['percentuale_sconto'] . "', '" . $data_iniziale_convertita . "', '" . $data_finale_convertita . "');";
		$db->query($query_inserimento);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}

	
	if(isset($_POST['rimuovi_offerta'])) {
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
		$query_rimozione_sconti_articoli = "UPDATE articolo SET cod_offerta = NULL WHERE cod_offerta = " . $_POST['ID_offerta'] . ";";
		$db->query($query_rimozione_sconti_articoli);
		$query_rimozione_offerta = "DELETE FROM offerte WHERE ID_offerta = " . $_POST['ID_offerta'] . ";";
		$db->query($query_rimozione_offerta);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}


	if(isset($_POST['rimuovi_newsletter'])) {
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
		$query_rimozione_newsletter = "DELETE FROM newsletter WHERE email LIKE '" . $_POST['email'] . "';";
		$db->query($query_rimozione_newsletter);
		$db->close();
		header("location: amministrazioneM.php?err");
		die();
	}

?>