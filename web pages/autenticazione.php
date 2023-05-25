<?php 
	if(isset($_POST['accedi'])) {
		$db = new mysqli("localhost", "root", "", "accessport");

		$email = $_POST['email'];
		$password = $_POST['password'];

		//controllo tabella utenti
		$query = "SELECT utenti.`email`, utenti.`password` FROM utenti WHERE utenti.`email` = '$email';";
		$dati = $db->query($query);

		foreach($dati as $r) {
			if($r["email"] == $email) 
				if($r["password"] == $password) {
					// cookie
					setcookie("utente", $r["email"], time() + (86400 * 30), "/");
					header("location: account.php");
					die();
				} else {
					header("location: login.php?err=5");
					die();
				}
		}

		// controllo tabella dipendenti
		$query = "SELECT dipendenti.`email`, dipendenti.`password` FROM dipendenti WHERE dipendenti.`email` = '$email';";
		$dati = $db->query($query);

		foreach($dati as $r) {
			if($r["email"] == $email) 
				if($r["password"] == $password) {
					// cookie
					setcookie("dipendente", $r["email"], time() + (86400 * 30), "/");
					header("location: amministrazione.php");
					die();
				} else {
					header("location: login.php?err=5");
					die();
				}
		}

		$db->close();
		header("location: login.php?err=2");
		die();
		
	} else if(isset($_POST['registrati'])) {
		$db = new mysqli("localhost", "root", "", "accessport");

		
		$nome = $_POST['nome'];
		$cognome = $_POST['cognome'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$citta = $_POST['citta'];
		$via = $_POST['via'];
		$civico = $_POST['civico'];
		$provincia = $_POST['provincia'];

		$query = "INSERT INTO utenti(nome, cognome, `password`, email, citta, via, numero_civico, provincia) values 
				('$nome', '$cognome', '$password','$email', '$citta', '$via', '$civico', '$provincia');";

		$db->query($query);
		$db->close();
		header("location: login.php");
		die();
	} else {
		header("location: login.php?err=1");
		die();
	}
?>