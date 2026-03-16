<?php
require_once 'config.php';

$piano_ricerca = "";
$classi = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $piano_ricerca = $_POST['piano'];
    $nome_ricerca = $_POST['nome'];

    $stmt = mysqli_prepare($conn, "SELECT nome, piano, note FROM Classi WHERE piano LIKE ? AND nome LIKE ? ORDER BY nome");
    $search_term_piano = "%" . $piano_ricerca . "%";
    $search_term_nome = "%" . $nome_ricerca . "%";
    mysqli_stmt_bind_param($stmt, "ss", $search_term_piano, $search_term_nome);


    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $classi[] = $row;
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Classi</title>
</head>
<body>
    <h1>Ricerca Classi</h1>
    
    <p><a href="index.php">&lt; Torna alla home</a></p>
    
    <form method="POST">
        <label>Cerca per Piano e Nome:</label><br>
        <input type="text" name="piano" value="<?php echo htmlspecialchars($piano_ricerca); ?>" >
        <input type="text" name="nome" value="<?php echo htmlspecialchars($nome_ricerca); ?>" >
        <button type="submit">Cerca</button>
    </form>
    
    <hr>
    
    <?php
    echo "<h2>Risultati per: <strong>" . htmlspecialchars($piano_ricerca) . "e " . htmlspecialchars($nome_ricerca)."</strong></h2>";
    
    if (count($classi) > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>Piano</th>";
        echo "<th>Note</th>";
        echo "</tr>";
        
        foreach ($classi as $classe) {
            echo "<tr>";
            echo "<td>" . $classe['nome'] . "</td>";
            echo "<td>" . $classe['piano'] . "</td>";
            echo "<td>" . $classe['note'] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        echo "<p><strong>Risultati trovati:</strong> " . count($classi) . "</p>";
    } else {
        echo "<p>Nessuna classe trovata per il piano: <strong>" . htmlspecialchars($piano_ricerca) . "</strong></p>";
    }
    
    ?>
</body>
</html>
