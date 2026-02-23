<?php
// Anagrafica Demo - Visualizzazione Dati (usa GET per ricerca)

// Dati di esempio - Array di array
$persone = array(
    array(
        "id" => 1,
        "nome" => "Mario",
        "cognome" => "Rossi",
        "email" => "mario.rossi@email.com",
        "telefono" => "333-1234567",
        "data_nascita" => "1990-05-15",
        "comune" => "Milano"
    ),
    array(
        "id" => 2,
        "nome" => "Anna",
        "cognome" => "Bianchi",
        "email" => "anna.bianchi@email.com",
        "telefono" => "334-9876543",
        "data_nascita" => "1988-03-22",
        "comune" => "Roma"
    ),
    array(
        "id" => 3,
        "nome" => "Giovanni",
        "cognome" => "Verdi",
        "email" => "giovanni.verdi@email.com",
        "telefono" => "335-5555555",
        "data_nascita" => "1995-11-08",
        "comune" => "Napoli"
    )
);

// Gestione GET per ricerca
$ricerca = "";
if (isset($_GET['cognome'])) {
    $ricerca = $_GET['cognome']; // Leggi il parametro GET
}

// Filtraggio dei dati
$risultati = array();
if (empty($ricerca)) {
    // Se nessuna ricerca, mostra tutti
    $risultati = $persone;
} else {
    // Filtra per cognome (case-insensitive)
    foreach ($persone as $persona) {
        if (stripos($persona['cognome'], $ricerca) !== false) {
            $risultati[] = $persona;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Dati - Anagrafica</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📋 Visualizza Dati</h1>
            <p>Esempio di utilizzo di GET per ricerca</p>
        </header>

        <nav class="menu">
            <a href="index.php" class="btn-home">🏠 Home</a>
            <a href="dati.php" class="btn-view">👥 Visualizza Dati</a>
            <a href="form.php" class="btn-add">➕ Aggiungi Persona</a>
        </nav>

        <main>
            <section class="search-section">
                <h2>Ricerca per Cognome</h2>
                <p><strong>Metodo:</strong> GET | <strong>Parametro:</strong> ?cognome=xxx</p>
                
                <form method="GET" action="dati.php" class="search-form">
                    <input 
                        type="text" 
                        name="cognome" 
                        placeholder="Inserisci cognome..." 
                        value="<?php echo htmlspecialchars($ricerca); ?>"
                    >
                    <button type="submit" class="btn-search">🔍 Cerca</button>
                    <a href="dati.php" class="btn-reset">↻ Resetta</a>
                </form>

                <p class="info-url">
                    <strong>URL della ricerca:</strong><br>
                    <code>dati.php?cognome=<?php echo urlencode($ricerca); ?></code>
                </p>
            </section>

            <section class="results-section">
                <h2>Risultati (<?php echo count($risultati); ?> trovati)</h2>
                
                <?php
                // Verifica se ci sono risultati
                if (count($risultati) > 0) {
                    ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Data Nascita</th>
                                <th>Comune</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop foreach per mostrare ogni persona
                            foreach ($risultati as $persona) {
                                ?>
                                <tr>
                                    <td><?php echo $persona['id']; ?></td>
                                    <td><?php echo htmlspecialchars($persona['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($persona['cognome']); ?></td>
                                    <td><?php echo htmlspecialchars($persona['email']); ?></td>
                                    <td><?php echo htmlspecialchars($persona['telefono']); ?></td>
                                    <td><?php echo $persona['data_nascita']; ?></td>
                                    <td><?php echo htmlspecialchars($persona['comune']); ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    // Se nessun risultato
                    ?>
                    <div class="no-results">
                        <p>❌ Nessuna persona trovata con il cognome: <strong><?php echo htmlspecialchars($ricerca); ?></strong></p>
                        <p><a href="dati.php">Visualizza tutte le persone</a></p>
                    </div>
                    <?php
                }
                ?>
            </section>

            <section class="code-section">
                <h2>💻 Codice Importante</h2>
                <div class="code-box">
                    <pre><code>// Leggi il parametro GET
if (isset($_GET['cognome'])) {
    $ricerca = $_GET['cognome'];
}

// Loop foreach per i risultati
foreach ($risultati as $persona) {
    echo $persona['nome'];
}</code></pre>
                </div>
            </section>
        </main>

        <footer>
            <p>Demo PHP - Metodo GET per ricerca</p>
        </footer>
    </div>
</body>
</html>
