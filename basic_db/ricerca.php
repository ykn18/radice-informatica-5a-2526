<?php
// RICERCA - Cerca persone per cognome
require_once 'config.php';

$cognome_ricerca = "";
$persone = array();

// Se la ricerca è stata inviata
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cognome_ricerca = $_POST['cognome'];
    
    // Prepared statement per cercare persone per cognome
    $stmt = mysqli_prepare($conn, "SELECT id, nome, cognome, email FROM persone WHERE cognome LIKE ? ORDER BY cognome, nome");
    $search_term = "%" . $cognome_ricerca . "%";
    mysqli_stmt_bind_param($stmt, "s", $search_term);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $persone[] = $row;
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Persone</title>
</head>
<body>
    <h1>Ricerca Persone</h1>
    
    <p><a href="index.php">&lt; Torna alla home</a></p>
    
    <form method="POST">
        <label>Cerca per Cognome:</label><br>
        <input type="text" name="cognome" value="<?php echo htmlspecialchars($cognome_ricerca); ?>" required>
        <button type="submit">Cerca</button>
    </form>
    
    <hr>
    
    <?php
    if ($cognome_ricerca) {
        echo "<h2>Risultati per: <strong>" . htmlspecialchars($cognome_ricerca) . "</strong></h2>";
        
        if (count($persone) > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nome</th>";
            echo "<th>Cognome</th>";
            echo "<th>Email</th>";
            echo "</tr>";
            
            foreach ($persone as $persona) {
                echo "<tr>";
                echo "<td>" . $persona['id'] . "</td>";
                echo "<td>" . $persona['nome'] . "</td>";
                echo "<td>" . $persona['cognome'] . "</td>";
                echo "<td>" . $persona['email'] . "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
            echo "<p><strong>Risultati trovati:</strong> " . count($persone) . "</p>";
        } else {
            echo "<p>Nessuna persona trovata con cognome: <strong>" . htmlspecialchars($cognome_ricerca) . "</strong></p>";
        }
    }
    ?>
</body>
</html>
