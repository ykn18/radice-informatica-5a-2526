<?php
// Anagrafica Demo - Form Aggiungi Persona (usa POST)

$messaggio = "";
$tipo_messaggio = "";

// Gestione POST per aggiungere persona
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica che tutti i campi siano compilati
    if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) 
        && isset($_POST['telefono']) && isset($_POST['data_nascita']) && isset($_POST['comune'])) {
        
        // Controllo che i campi non siano vuoti
        $nome = trim($_POST['nome']);
        $cognome = trim($_POST['cognome']);
        $email = trim($_POST['email']);
        $telefono = trim($_POST['telefono']);
        $data_nascita = trim($_POST['data_nascita']);
        $comune = trim($_POST['comune']);
        
        if (!empty($nome) && !empty($cognome) && !empty($email) && !empty($telefono) 
            && !empty($data_nascita) && !empty($comune)) {
            
            // Validazione email semplice
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $messaggio = "✅ Persona aggiunta con successo! (In una vera applicazione, sarebbe salvata nel database)";
                $tipo_messaggio = "success";
                
                // Qui in una vera applicazione salveremmo nel database
                // INSERT INTO persone (nome, cognome, email, telefono, data_nascita, comune) 
                // VALUES ('$nome', '$cognome', '$email', '$telefono', '$data_nascita', '$comune');
                
            } else {
                $messaggio = "❌ Email non valida! Inserisci un'email corretta.";
                $tipo_messaggio = "error";
            }
        } else {
            $messaggio = "❌ Errore: Tutti i campi sono obbligatori!";
            $tipo_messaggio = "error";
        }
    } else {
        $messaggio = "❌ Errore: Form non completo!";
        $tipo_messaggio = "error";
    }
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Persona - Anagrafica</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>➕ Aggiungi Persona</h1>
            <p>Esempio di utilizzo di POST per inserimento dati</p>
        </header>

        <nav class="menu">
            <a href="index.php" class="btn-home">🏠 Home</a>
            <a href="dati.php" class="btn-view">👥 Visualizza Dati</a>
            <a href="form.php" class="btn-add">➕ Aggiungi Persona</a>
        </nav>

        <main>
            <?php
            // Mostra il messaggio se disponibile
            if (!empty($messaggio)) {
                ?>
                <div class="message message-<?php echo $tipo_messaggio; ?>">
                    <?php echo $messaggio; ?>
                </div>
                <?php
            }
            ?>

            <section class="form-section">
                <h2>Form di Inserimento</h2>
                <p><strong>Metodo:</strong> POST | I dati vengono inviati in modo sicuro</p>
                
                <form method="POST" action="form.php" class="add-form">
                    <div class="form-group">
                        <label for="nome">Nome *</label>
                        <input 
                            type="text" 
                            id="nome" 
                            name="nome" 
                            placeholder="Inserisci il nome" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="cognome">Cognome *</label>
                        <input 
                            type="text" 
                            id="cognome" 
                            name="cognome" 
                            placeholder="Inserisci il cognome" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="example@email.com" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono *</label>
                        <input 
                            type="tel" 
                            id="telefono" 
                            name="telefono" 
                            placeholder="333-1234567" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="data_nascita">Data di Nascita *</label>
                        <input 
                            type="date" 
                            id="data_nascita" 
                            name="data_nascita" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="comune">Comune *</label>
                        <input 
                            type="text" 
                            id="comune" 
                            name="comune" 
                            placeholder="Inserisci il comune" 
                            required
                        >
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn-submit">✅ Salva Persona</button>
                        <button type="reset" class="btn-reset">↻ Pulisci Form</button>
                    </div>
                </form>
            </section>

            <section class="info-section">
                <h2>ℹ️ Informazioni su POST</h2>
                <div class="info-box">
                    <h3>Vantaggi del POST:</h3>
                    <ul>
                        <li>I dati non visibili nell'URL</li>
                        <li>Più sicuro per dati sensibili</li>
                        <li>Può inviare grandi quantità di dati</li>
                        <li>Più adatto per modifiche ai dati</li>
                    </ul>
                </div>
            </section>

            <section class="code-section">
                <h2>💻 Codice Importante</h2>
                <div class="code-box">
                    <pre><code>// Verifica il metodo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leggi i dati POST
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    
    // Validazione
    if (!empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Dati validi!";
    }
}</code></pre>
                </div>
            </section>
        </main>

        <footer>
            <p>Demo PHP - Metodo POST per inserimento</p>
        </footer>
    </div>
</body>
</html>
