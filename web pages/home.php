<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel=stylesheet href="../css/styleLR.css"></style>
		<title>Home</title>
		<style>
			header {
				display: flex;
				flex-direction: row;
			}
		</style>
	</head>
	<body>
		<header>
			<div>
				<a href="shop1.php"><button>shop 1</button></a>
			</div>
			<div><a href="shop2.php"><button>shop 2</button></a></div>
			<div><a href="shop3.php"><button>shop 3</button></a></div>
			<div><a href="shop4.php"><button>shop 4</button></a></div>
			<div>
				<a href="login.php"><button>Login</button></a>
			</div>
			<div>
				<a href="signIn.php"><button>Registrati</button></a>
			</div>
		</header>
		<h1>Benvenuto</h1>
		<form action="home.php" method="post">
			<h1>Registrati alla nostra newsletter!</h1>
			<input type=email name=email placeholder="Email" style="width: 170px;" required/><br/>
			<input type=text name=provincia placeholder="Provincia" style="width: 170px;" required/><br/>
			<input type=text name=città placeholder="Città" style="width: 170px;" required/><br/>
			<input type=text name=via placeholder="Via" style="width: 170px;" required/><br/>
			<input type=number name=civico placeholder="Civico" min=1 max=999 style="width: 170px;" required/><br/>
			<input type=submit name=registrati value=Registrati />
		</form>
	</body>
</html>