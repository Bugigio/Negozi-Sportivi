<!-- TANASE -->
<!-- TOMMASI -->
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.css">
		<link rel="stylesheet" href="../css/amministrazione.css">
		<!--link per le librerie necessarie per supportare le icone-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
		integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" 
		referrerpolicy="no-referrer" />
        <title>AMMINISTRAZIONE</title>
    </head>
    <body>
        <!-- CIGANA -->
        <header class="header clearfix">
            <a href="" class="header__logo"><img src="../immagini/logoNegoziSportivi.png" alt="Logo" width="50px" /></a>
            <div class="header__menu animate">
                <div class="header__menu__item"><a href="../index.php?logout=0">LOGOUT</a></div>
			</div>
		</header>

        <h1>AMMINISTRAZIONE</h1>
        <!-- TOMMASI -->
        <form action=amministrazioneM.php method=post>
            <div class="menu-tendina">
                <select name="magazzino">
                    <option value="">Seleziona il negozio/magazzino</option>
                    <?php 
                        $db = new mysqli("localhost", "root", "", "my_negozisportivi");
                        $query = "SELECT * FROM magazzino;";
                        $nomi = $db->query($query);
                        foreach($nomi as $r) {
                            echo '<option value="' . $r["nome"] . '">'. $r["nome"] .'</option><br>';
                        }
                    ?>
                </select>
            <input type="submit" name="accedi" value="Accedi">
        </form>
        <div class=logout><a href=index.php></a></div>

        <!-- CIGANA -->		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script>
			$(document).ready(function(){

					$(".header__icon-bar").click(function(e){

						$(".header__menu").toggleClass('is-open');
						e.preventDefault();

					});
			});
		</script>
    </body>
</hmtl>