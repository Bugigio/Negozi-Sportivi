<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Basketball Passion</title>
        <link rel=stylesheet href="../css/styleLR.css">
        <script src="../JS/shop.js"></script>
    </head>

    <body style="margin: 0px;" background="">
        <header>
			<div>
				<a href="basketballPassion.php"><button>Basketball Passion</button></a>
			</div> 
			<div><a href="shop2.php"><button>shop 2</button></a></div>
			<div><a href="shop3.php"><button>shop 3</button></a></div>
			<div><a href="shop4.php"><button>shop 4</button></a></div>
			<div>
				<a href="login.php"><button>Login</button></a>
			</div>
			<div>
				<a href="registrati.php"><button>Registrati</button></a>
			</div>
		</header>

            <?php

                $db = new mysqli("localhost", "root", "", "accessport");
                $query = "SELECT nome_articolo FROM articolo;";
                $dati = $db->query($query);
                ?>
                
                <form action="ordina.php?user=" method="post">
                    <?php
                        
                        foreach($dati as $r) {
                            $i=0;
                            ?>
                                <div><h3 class="titolo"><?php echo $r["nome_articolo"]; ?></h3></div>
                            <?php
                            $i++;
                        }

                    ?>
                </form>

                <?php
            ?>
        
            <footer>
                <div class="footer"><input name="submit" type="submit" value="ORDINA"><input type="text" name="prezzo_totale" id="prezzo_totale" value="0.00" readonly></div>
            </footer>
        </form>
    </body>
</html>