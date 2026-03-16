<?php
require_once 'config.php';

$query = "SELECT id, nome, piano, note FROM Classi ORDER BY nome";
$result = mysqli_query($conn, $query);

$delete_message = "";

if(isset($_GET["result"])){
    if($_GET["result"] === "success"){
        $delete_message = "Eliminato con successo";
    } else if ($_GET["result"] === "failure"){
        $delete_message = "Errore nella cancellazione";
    }
}

if (!$result) {
    die("Errore nella query: " . mysqli_error($conn));
}

$classi = array();
while ($row = mysqli_fetch_assoc($result)) {
    $classi[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Visualizza Classi</title>
</head>
<body>
    <h1>Elenco Classi</h1>
    
    <p><a href="index.php">&lt; Torna alla home</a></p>
    
    <table border="1" cellpadding="10">
        <tr>
            <th>Nome</th>
            <th>Piano</th>
            <th>Note</th>
            <th>Elimina</th>
        </tr>
        
        <?php
        if (count($classi) > 0) {
            foreach ($classi as $c) {
                echo "<tr>";
                echo "<td>" . $c['nome'] . "</td>";
                echo "<td>" . $c['piano'] . "</td>";
                echo "<td>" . $c['note'] . "</td>";
                echo "<td><a href='cancella_classe.php?id=" . $c['id'] . "'>X</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='text-align:center'>Nessuna persona trovata</td></tr>";
        }
        ?>
    </table>
    
    <p><strong>Totale classi:</strong> <?php echo count($classi); ?></p>

    <?php
        echo "<h3>$delete_message</h3"
    ?>
</body>
</html>
