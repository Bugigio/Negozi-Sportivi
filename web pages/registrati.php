<html>
    <head>
        <title>Login con i file</title>
        <link rel=stylesheet href="../css/styleLR.css"></style>
    </head>
    <body>
        <?php
            if(isset($_REQUEST['err'])) {
                $err = $_REQUEST['err'];
                echo "<div class='err'>";
                switch ($err) {
                    case 1:
                        echo 'Errore, utente già esistente';
                        break;
                    default:
                        echo 'Errore generico';
                        break;
                }
                echo '</div>';
            }
        ?>
        <form name=registrati action=autenticazione.php method=post>
            <h1>Registrazione</h1>
            <input type=text name=user placeholder="Nome utente" required/>
            <input type=password name=password placeholder="Password" required/>
            <input type=submit name=registrati value=Registrati />
        </form>
        <div class=registrati>Hai già l'account? <a href=login.php>Loggati</a></div>
    </body>
</html>
