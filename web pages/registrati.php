 <!-- TANASE -->
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
            } else if(isset($_COOKIE["utente"])) {
                header("location: account.php");
                die();
            }
        ?>

        <form action=autenticazione.php method=post>
            <h1>Registrazione</h1>
            <input type=text name=nome placeholder="Nome" maxlength="30" required/>
            <input type=text name=cognome placeholder="Cognome" maxlength=15 required/>
            <input type=text name=password placeholder="Password" maxlength=16 required/>
            <input type=email name=email placeholder="Email" maxlength="100" required/>
            <input type=text name=citta placeholder="Città" maxlength=100 required/>
            <input type=text name=via placeholder="Via" maxlength=50 required/>
            <input type=number name=civico placeholder="Civico" maxlength=3 max="999" min=1 required/>
            <input type=text name=provincia placeholder="Provincia" maxlength="2" required/>
            <input type=submit name=registrati value=Registrati />
        </form>
        <div class=registrati>Hai già l'account? <a href=login.php>Loggati</a></div>
    </body>
</html>
