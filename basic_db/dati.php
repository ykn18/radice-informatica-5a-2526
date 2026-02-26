<?php
// DATI - Visualizza tutte le persone
require_once 'config.php';

// Query SQL per ottenere tutte le persone
$query = "SELECT id, nome, cognome, email FROM persone ORDER BY cognome, nome";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Errore nella query: " . mysqli_error($conn));
}

// Leggi i dati dal risultato
$persone = array();
while ($row = mysqli_fetch_assoc($result)) {
    $persone[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Visualizza Persone</title>
</head>
<body>
    <h1>Elenco Persone</h1>
    
    <p><a href="index.php">&lt; Torna alla home</a></p>
    
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Email</th>
        </tr>
        
        <?php
        if (count($persone) > 0) {
            foreach ($persone as $persona) {
                echo "<tr>";
                echo "<td>" . $persona['id'] . "</td>";
                echo "<td>" . $persona['nome'] . "</td>";
                echo "<td>" . $persona['cognome'] . "</td>";
                echo "<td>" . $persona['email'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='text-align:center'>Nessuna persona trovata</td></tr>";
        }
        ?>
    </table>
    
    <p><strong>Totale persone:</strong> <?php echo count($persone); ?></p>
</body>
</html>
