<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Account</title>
		<?php 
			if(!isset($_COOKIE["utente"])) {
				header("location: login.php?err=1");
				die();
			}
		?> 
	</head>
	<body>
		<a href="home.php?logout=1"><button>Logout</button></a>
	</body>
</html>