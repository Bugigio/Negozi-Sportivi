 <!-- TANASE -->
<html>
    <head>
        <title>LOGIN</title>
        <link rel=stylesheet href="css/styleLR.css">
    </head>
    <body>
        <?php 
            if(isSet($_REQUEST['err'])) {
                echo "<div class=err>";
                switch ($_REQUEST['err']) {
                    case 1:
                        echo "Errore di accesso";
                        break;
                    case 2:
                        echo "Utente inesistente, vuoi registrarti? <a href=registrati.php>Registrati</a>";
                        break;
                    case 5:
                        echo "Password errata";
                        break;
                    default:
                        echo "Errore generico";
                        break;
                }
                echo "</div>";
            } else if(isset($_COOKIE["utente"])) {
                header("location: account.php");
                die();
            } else if(isset($_COOKIE["dipendente"])) {
                header("location: amministrazione/amministrazione.php");
                die();
            }
        ?>
        <form action=autenticazione.php method=post>
            <h1>Login</h1>
            <input type=email name=email placeholder="Email" required/>
            <input type=password name=password placeholder="Password" required/>
            <input type=submit name=accedi value=Login />
        </form>
        <div class=registrati>Non sei registrato? <a href=registrati.php>Registrati</a></div>
    </body>
</html>
