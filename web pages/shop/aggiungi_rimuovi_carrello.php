<?php 
	if(isset($_POST['aggiungi'])) {
		// funzione di aggiungimento al carrello
		// header("Access-Control-Allow-Origin: *");
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
		$query_aggiungi_al_carrello = "INSERT INTO `acquistare`(`id_articolo`, `email_utente`, `data/ora_acquisto` , `carrello`) VALUES ('" . $_POST['id_articolo'] . "', '" . $_COOKIE['utente'] . "', CURRENT_TIMESTAMP, '1');";
		$db->query($query_aggiungi_al_carrello);
		$db->close();
		echo 1;
		die();
	} else if(isset($_POST['rimuovi'])) {
		$db = new mysqli("localhost", "root", "", "my_negozisportivi");
		$query = "DELETE FROM acquistare WHERE carrello = 1 AND email_utente LIKE '" . $_COOKIE["utente"] . "' AND id_articolo = " . $_POST['id_articolo'] . " AND `data/ora_acquisto` = '" . $_POST['data/ora_acquisto'] . "';";
		$db->query($query);
		$db->close();
		header("location: carrello.php");
		die();
	} else {
		header("location: ../login.php?err=1");
		die();
	}
?>