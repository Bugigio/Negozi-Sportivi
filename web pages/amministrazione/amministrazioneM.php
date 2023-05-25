<?php 
    if(!isset($_COOKIE["dipendente"])) {
        header("location: login.php?err=5");
        die();
    }
    if(!isset($_POST['accedi'])) {
        header("location: amministrazione.php");
        die();
    }
?>
<html>
    <head>
        <title>Amministrazione magazzino</title>
    </head>
    <body>
        <h1>Amministrazione magazzino</h1>
        <form action=# method=post>
            <select name="fornitori">
                <option value="">Seleziona il negozio/magazzino</option>
                <?php 
                    $db = new mysqli("localhost", "root", "", "accessport");
                    $query = "SELECT * FROM fornitori;";
                    $nomi = $db->query($query);
                    foreach($nomi as $r) {
                        echo '<option value="' . $r["nome"] . '">'. $r["nome"] .'</option><br>';
                    }
                ?>
            </select>
        </form>
        <form action=# method=post>
            <select name="articoli">
                <option value="">Seleziona il negozio/magazzino</option>
                <?php 
                    $db = new mysqli("localhost", "root", "", "accessport");
                    $query = "SELECT * FROM articoli WHERE nome_magazzino = " . $_POST['magazzino'] . ";";
                    $dati = $db->query($query);
                    foreach($dati as $r) {
                        echo '<option value="' . $r["ID_articolo"] . '">'. $r["nome_articolo"] . ' - ' . $r["tipo_articolo"] . ' - ' . $r["quantita"] . ' - ' . $r["prezzo_acquisto"] . ' - ' . $r["prezzo_vendita"] . '</option><br>';
                    }
                ?>
            </select>
        </form>
        <form action=# method=post>
            <select name="ordini">
                <option value="">Seleziona il negozio/magazzino</option>
                <?php 
                    $db = new mysqli("localhost", "root", "", "accessport");
                    $query = "SELECT * FROM ordini WHERE nome_magazzino = " . $_POST['magazzino'] . ";";
                    $dati = $db->query($query);
                    foreach($dati as $r) {
                        echo '<option value="' . $r["cod_ordine"] . '">'. $r["nome_articolo"] . ' - ' . $r["tipo_articolo"] . ' - ' . $r["quantita"] . ' - ' . $r["costo"] . ' - ' . $r["data_ordine"] . '</option><br>';
                    }
                ?>
            </select>
        </form>
        <form action=# method=post>
            <select name="offerte">
                <option value="">Seleziona il negozio/magazzino</option>
                <?php 
                    $db = new mysqli("localhost", "root", "", "accessport");
                    $query = "SELECT * FROM offerte";
                    $dati = $db->query($query);
                    foreach($dati as $r) {
                        echo '<option value="' . $r["ID_offerta"] . '">'. $r["data_inizio"] . ' - ' . $r["data_fine"] . ' - ' . $r["sconto_articolo"] . '</option><br>';
                    }
                ?>
            </select>
        </form>
        <div class="bilancio">
            <?php 
                $db = new mysqli("localhost", "root", "", "accessport");
                $query = "SELECT * FROM bilancio WHERE bilancio.nome_magazzino = " . $_POST['magazzino'] . ";";
                $dati = $db->query($query);
            ?>
            <table>
                <tr><td>Bilancio</td></tr>
                <tr><td></td></tr>
            </table>
        </div>
    </body>
</hmtl>