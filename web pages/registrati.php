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
            <input type=text name=nome placeholder="Nome" required/>
            <input type=text name=cognome placeholder="Cognome" required/>
            <input type=text name=password placeholder="Password" required/>
            <input type=email name=email placeholder="Email" required/>
            <input type=text name=città placeholder="Città" required/>
            <input type=text name=via placeholder="Via" required/>
            <input type=number name=civico placeholder="Civico" required/>
            <input type=text name=provincia placeholder="Provincia" required/>
            <input type=submit name=registrati value=Registrati />
        </form>
        <div class=registrati>Hai già l'account? <a href=login.php>Loggati</a></div>
    </body>
</html>
