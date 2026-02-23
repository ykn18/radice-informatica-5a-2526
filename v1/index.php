<?php
// Anagrafica Demo - Homepage
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anagrafica - Demo PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📋 Sistema Anagrafica Demo</h1>
            <p>Esempio di PHP procedurale con GET e POST</p>
        </header>

        <nav class="menu">
            <a href="index.php" class="btn-home">🏠 Home</a>
            <a href="dati.php" class="btn-view">👥 Visualizza Dati</a>
            <a href="form.php" class="btn-add">➕ Aggiungi Persona</a>
        </nav>

        <main>
            <section class="intro">
                <h2>Benvenuto!</h2>
                <p>Questa è una demo semplice di un sistema anagrafico in <strong>PHP procedurale</strong>.</p>
                
                <h3>📚 Caratteristiche della demo:</h3>
                <ul>
                    <li><strong>GET:</strong> Utilizzato nella pagina "Visualizza Dati" per cercare persone</li>
                    <li><strong>POST:</strong> Utilizzato nel form per aggiungere nuove persone</li>
                    <li><strong>Array PHP:</strong> I dati sono memorizzati in array (senza database)</li>
                    <li><strong>PHP Procedurale:</strong> Codice semplice senza orientamento agli oggetti</li>
                    <li><strong>Nessuna Sessione:</strong> I dati si perdono al refresh della pagina</li>
                    <li><strong>Nessun Upload:</strong> Demo base senza caricamento file</li>
                </ul>

                <h3>🕹️ Cosa puoi fare:</h3>
                <ol>
                    <li>Vai su <strong>"Visualizza Dati"</strong> per vedere l'uso di GET</li>
                    <li>Usa il form di ricerca per filtrare per cognome</li>
                    <li>Vai su <strong>"Aggiungi Persona"</strong> per usare un form POST</li>
                    <li>Aggiungi dati che vedrai in "Visualizza Dati"</li>
                </ol>

                <h3>💡 Concetti PHP dimostrati:</h3>
                <ul>
                    <li>Array associativi</li>
                    <li>Loop foreach</li>
                    <li>Condizionali if/else</li>
                    <li>Variabili superglobali $_GET e $_POST</li>
                    <li>Funzioni di base (isset, empty, count)</li>
                    <li>String interpolation</li>
                </ul>
            </section>
        </main>

        <footer>
            <p>Demo PHP - 2026</p>
        </footer>
    </div>
</body>
</html>
