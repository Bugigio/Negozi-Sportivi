<html>
    <head>
        <title>Login con i file</title>
        <link rel=stylesheet href="../Stili/styleLR.css"></style>
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
                    case 3:
                        echo "Utente creato";
                        break;  
                    case 4:
                        echo "File utenti inesistente";
                        break;
                    case 5:
                        echo "Password errata";
                        break;
                    case 6:
                        echo 'Password errata, <a href="cambiaPassword.php?user=' . $_REQUEST['user'] . '">Cambia password</a>';
                        break;
                    default:
                        echo "Errore generico";
                        break;
                }
                echo "</div>";
            } elseif(isset($_REQUEST['passwChanged'])) {
                echo "<div class=err>";
                echo "Password cambiata";
                echo "</div>";
            }
        ?>
        <form name=login action=autenticazione.php method=post>
            <h1>Login</h1>
            <input type=text name=user placeholder="Nome utente" required/>
            <input type=password name=password placeholder="Password" required/>
            <input type=submit name=login value=Login />
        </form>
        <div class=registrati>Non sei registrato? <a href=registrati.php>Registrati</a></div>
    </body>
</html>
