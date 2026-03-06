<?php
// DATI TELEFONI - Visualizza tutti i telefoni con la persona associata
require_once 'config.php';

$query = "SELECT t.id, t.numero, t.tipo, p.nome, p.cognome
          FROM telefoni t
          INNER JOIN persone p ON t.persona_id = p.id
          ORDER BY p.cognome, p.nome, t.tipo";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Errore nella query: " . mysqli_error($conn));
}

$telefoni = array();
while ($row = mysqli_fetch_assoc($result)) {
    $telefoni[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Visualizza Telefoni</title>
</head>
<body>
    <h1>Elenco Telefoni</h1>

    <p><a href="index.php">&lt; Torna alla home</a></p>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Persona</th>
            <th>Numero</th>
            <th>Tipo</th>
        </tr>

        <?php
        if (count($telefoni) > 0) {
            foreach ($telefoni as $telefono) {
                echo "<tr>";
                echo "<td>" . (int)$telefono['id'] . "</td>";
                echo "<td>" . htmlspecialchars($telefono['cognome'] . " " . $telefono['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($telefono['numero']) . "</td>";
                echo "<td>" . htmlspecialchars($telefono['tipo']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='text-align:center'>Nessun telefono trovato</td></tr>";
        }
        ?>
    </table>

    <p><strong>Totale telefoni:</strong> <?php echo count($telefoni); ?></p>
</body>
</html>