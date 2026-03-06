<?php
// RICERCA TELEFONI - Cerca telefoni per numero e/o persona
require_once 'config.php';

$numero_ricerca = "";
$persona_id_ricerca = "";
$telefoni = array();

// Carica persone per la select dinamica
$query_persone = "SELECT id, nome, cognome FROM persone ORDER BY cognome, nome";
$result_persone = mysqli_query($conn, $query_persone);

if (!$result_persone) {
    die("Errore nel caricamento persone: " . mysqli_error($conn));
}

$persone = array();
while ($row = mysqli_fetch_assoc($result_persone)) {
    $persone[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_ricerca = trim($_POST['numero']);
    $persona_id_ricerca = $_POST['persona_id'];

    $sql = "SELECT t.id, t.numero, t.tipo, p.nome, p.cognome
            FROM telefoni t
            INNER JOIN persone p ON t.persona_id = p.id
            WHERE t.numero LIKE ?";

    $search_term = "%" . $numero_ricerca . "%";

    if ($persona_id_ricerca !== "") {
        $sql .= " AND t.persona_id = ?";
    }

    $sql .= " ORDER BY p.cognome, p.nome, t.tipo";

    $stmt = mysqli_prepare($conn, $sql);

    if ($persona_id_ricerca !== "") {
        $persona_id_int = (int)$persona_id_ricerca;
        mysqli_stmt_bind_param($stmt, "si", $search_term, $persona_id_int);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $search_term);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $telefoni[] = $row;
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Telefoni</title>
</head>
<body>
    <h1>Ricerca Telefoni</h1>

    <p><a href="index.php">&lt; Torna alla home</a></p>

    <form method="POST">
        <label>Cerca per Numero (anche parziale):</label><br>
        <input type="text" name="numero" value="<?php echo htmlspecialchars($numero_ricerca); ?>">
        <br><br>

        <label>Filtra per Persona (opzionale):</label><br>
        <select name="persona_id">
            <option value="">-- Tutte le persone --</option>
            <?php
            foreach ($persone as $persona) {
                $selected = ((string)$persona_id_ricerca === (string)$persona['id']) ? "selected" : "";
                echo "<option value='" . (int)$persona['id'] . "' " . $selected . ">";
                echo htmlspecialchars($persona['cognome'] . " " . $persona['nome']);
                echo "</option>";
            }
            ?>
        </select>
        <br><br>

        <button type="submit">Cerca</button>
    </form>

    <hr>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h2>Risultati ricerca telefoni</h2>";

        if (count($telefoni) > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID</th><th>Persona</th><th>Numero</th><th>Tipo</th></tr>";

            foreach ($telefoni as $telefono) {
                echo "<tr>";
                echo "<td>" . (int)$telefono['id'] . "</td>";
                echo "<td>" . htmlspecialchars($telefono['cognome'] . " " . $telefono['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($telefono['numero']) . "</td>";
                echo "<td>" . htmlspecialchars($telefono['tipo']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "<p><strong>Risultati trovati:</strong> " . count($telefoni) . "</p>";
        } else {
            echo "<p>Nessun telefono trovato con i filtri selezionati.</p>";
        }
    }
    ?>
</body>
</html>