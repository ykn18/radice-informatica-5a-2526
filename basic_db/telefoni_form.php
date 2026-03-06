<?php
// FORM TELEFONI - Aggiungi un nuovo telefono associato a una persona
require_once 'config.php';

$messaggio = "";
$persona_id = "";
$numero = "";
$tipo = "Cellulare";

// Carica elenco persone per la select dinamica
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
    $persona_id = (int)$_POST['persona_id'];
    $numero = trim($_POST['numero']);
    $tipo = trim($_POST['tipo']);

    $stmt = mysqli_prepare($conn, "INSERT INTO telefoni (persona_id, numero, tipo) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iss", $persona_id, $numero, $tipo);

    if (mysqli_stmt_execute($stmt)) {
        $messaggio = "Telefono aggiunto con successo!";
        $persona_id = "";
        $numero = "";
        $tipo = "Cellulare";
    } else {
        $messaggio = "Errore: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Telefono</title>
</head>
<body>
    <h1>Aggiungi un nuovo Telefono</h1>

    <p><a href="index.php">&lt; Torna alla home</a></p>

    <?php
    if ($messaggio) {
        echo "<p><strong>" . htmlspecialchars($messaggio) . "</strong></p>";
    }
    ?>

    <form method="POST">
        <label>Persona:</label><br>
        <select name="persona_id" required>
            <option value="">-- Seleziona persona --</option>
            <?php
            foreach ($persone as $persona) {
                $selected = ((string)$persona_id === (string)$persona['id']) ? "selected" : "";
                echo "<option value='" . (int)$persona['id'] . "' " . $selected . ">";
                echo htmlspecialchars($persona['cognome'] . " " . $persona['nome']);
                echo "</option>";
            }
            ?>
        </select><br><br>

        <label>Numero:</label><br>
        <input type="text" name="numero" value="<?php echo htmlspecialchars($numero); ?>" required><br><br>

        <label>Tipo:</label><br>
        <select name="tipo" required>
            <option value="Cellulare" <?php echo $tipo === 'Cellulare' ? 'selected' : ''; ?>>Cellulare</option>
            <option value="Casa" <?php echo $tipo === 'Casa' ? 'selected' : ''; ?>>Casa</option>
            <option value="Ufficio" <?php echo $tipo === 'Ufficio' ? 'selected' : ''; ?>>Ufficio</option>
            <option value="Altro" <?php echo $tipo === 'Altro' ? 'selected' : ''; ?>>Altro</option>
        </select><br><br>

        <button type="submit">Aggiungi</button>
        <button type="reset">Pulisci</button>
    </form>

    <?php if (count($persone) === 0) { ?>
        <p><strong>Attenzione:</strong> non ci sono persone. Inserisci prima una persona da <a href="form.php">Aggiungi Persona</a>.</p>
    <?php } ?>
</body>
</html>