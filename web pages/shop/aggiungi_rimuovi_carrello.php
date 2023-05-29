<?php 
	if(isset($_POST['id_articolo'])) {
		// funzione di aggiungimento al carrello
		// header("Access-Control-Allow-Origin: *");
		$db = new mysqli("localhost", "root", "", "accessport");
		$query_aggiungi_al_carrello = "INSERT INTO `acquistare`(`id_articolo`, `email_utente`, `data/ora_acquisto` , `carrello`) VALUES ('" . $_POST['id_articolo'] . "', '" . $_POST['email_utente'] . "', CURRENT_TIMESTAMP, '1');";
		$db->query($query_aggiungi_al_carrello);
		$db->close();
		echo 1;
		die();
	}

	if(isset($_POST['rimuovi'])) {
		$db = new mysqli("localhost", "root", "", "accessport");
		$query = "DELETE FROM acquistare WHERE carrello = 1 AND email_utente LIKE '" . $_COOKIE["utente"] . "' AND id_articolo = " . $_POST['id_articolo'] . ";";
		$db->query($query);
		$db->close();
		header("location: carrello.php");
	}
?>