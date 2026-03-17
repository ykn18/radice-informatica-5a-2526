<?php

$message = "";
require_once("config.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST['nome'];
    $piano = $_POST['piano'];
    $note = $_POST['note'];
    
    $stmt = mysqli_prepare($conn, "INSERT INTO Classi (nome, piano, note) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nome, $piano, $note);
    
    if (mysqli_stmt_execute($stmt)) {
        $message = "✓ Classe aggiunta con successo!";
    } else {
        $message = "✗ Errore: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Classe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }
        .torna-home {
            margin-bottom: 20px;
        }
        .torna-home a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
        .torna-home a:hover {
            text-decoration: underline;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="text"]:focus, textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        button {
            flex: 1;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background-color: #45a049;
        }
        .messaggio {
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
            text-align: center;
        }
        .messaggio-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .messaggio-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="torna-home">
        <a href="index.php">← Torna alla home</a>
    </div>
    
    <h1>Inserimento Classe</h1>
    
    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="piano">Piano:</label>
                <input type="text" id="piano" name="piano" required>
            </div>
            
            <div class="form-group">
                <label for="note">Note:</label>
                <textarea id="note" name="note"></textarea>
            </div>
            
            <div class="button-group">
                <button type="submit">Aggiungi Classe</button>
                <button type="reset">Cancella</button>
            </div>
        </form>
    </div>
    
    <?php
    if(!empty($message)) {
        $classe_messaggio = (strpos($message, '✓') !== false) ? 'messaggio-success' : 'messaggio-error';
        echo "<div class='messaggio $classe_messaggio'>$message</div>";
    }
    ?>
</body>
</html>