 <!-- TANASE -->
 <!-- TOMMASI -->
<html>
    <head>
        <title>AMMINISTRAZIONE</title>
    </head>
    <body>
        <h1>Amministrazione</h1>

        <header class="header clearfix">
			<a href="" class="header__logo">Logo</a>
			<a href="" class="header__icon-bar">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<div class="header__menu animate">
				<div class="header__menu__item"><a href="shop/basketballPassion.php">BASKETBALL PASSION</a></div>
				<div class="header__menu__item"><a href="shop/pallavoloEverywhere.php">PALLAVOLO EVERYWHERE</a></div>
				<div class="header__menu__item"><a href="shop/racingSpirit.php">RACING SPIRIT</a></div>
				<div class="header__menu__item"><a href="shop/soccerEvolution.php">SOCCER EVOLUTION</a></div>
				<div class="header__menu__item"><a href="shop/tennisClash.php">TENNIS CLASH</a></div>
                <div class="header__menu__item"><a href="../home.php?logout=0">LOGOUT</a></div>
			</div>
		</header>

        <form action=amministrazioneM.php method=post>
            <select name="magazzino">
                <option value="">Seleziona il negozio/magazzino</option>
                <?php 
                    $db = new mysqli("localhost", "root", "", "accessport");
                    $query = "SELECT * FROM magazzino;";
                    $nomi = $db->query($query);
                    foreach($nomi as $r) {
                        echo '<option value="' . $r["nome"] . '">'. $r["nome"] .'</option><br>';
                    }
                ?>
            </select>
            <input type="submit" name="accedi" value="Accedi">
        </form>
        <div class=logout><a href=home.php></a></div>
    </body>
</hmtl>