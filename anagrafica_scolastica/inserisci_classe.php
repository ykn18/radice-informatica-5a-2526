<?php

$message = "";
require_once("config.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST['nome'];
    $piano = $_POST['piano'];
    $note= $_POST['note'];
    
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci classe</title>
</head>
<body>
    <h1>Inserimento classe</h1>
    <a href="index.php">Torna alla home</a>
    <table>
        <form method="POST">
        <tr>
            <td>
                Nome:
            </td>
            <td>
                <input type="text" name="nome" required>
            </td>
        </tr>
        <tr>
            <td>
                Piano:
            </td>
            <td>
                <input type="text" name="piano" required>
            </td>
        </tr>
        <tr>
            <td>
                Note:
            </td>
            <td>
                <textarea name="note"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit">
            </td>
        </tr>
        </form>
    </table>
    <?php
        echo "<h3>$message</h3"
    ?>
</body>
</html>