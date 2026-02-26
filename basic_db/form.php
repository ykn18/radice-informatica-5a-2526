<?php
// FORM - Aggiungi una nuova persona
require_once 'config.php';

$messaggio = "";

// Se il form è stato inviato (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leggi i dati dal form
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    
    // Prepared statement per aggiungere la persona (previene SQL Injection)
    $stmt = mysqli_prepare($conn, "INSERT INTO persone (nome, cognome, email) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nome, $cognome, $email);
    
    if (mysqli_stmt_execute($stmt)) {
        $messaggio = "✓ Persona aggiunta con successo!";
    } else {
        $messaggio = "✗ Errore: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Persona</title>
</head>
<body>
    <h1>Aggiungi una nuova Persona</h1>
    
    <p><a href="index.php">&lt; Torna alla home</a></p>
    
    <?php
    if ($messaggio) {
        echo "<p><strong>" . $messaggio . "</strong></p>";
    }
    ?>
    
    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>
        
        <label>Cognome:</label><br>
        <input type="text" name="cognome" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <button type="submit">Aggiungi</button>
        <button type="reset">Pulisci</button>
    </form>
</body>
</html>
