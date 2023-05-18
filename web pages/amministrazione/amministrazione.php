<html>
    <head>
        <title>Amministrazione</title>
    </head>
    <body>
        <h1>Amministrazione</h1>
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