<?php

$message = "";
require_once("config.php");

$query = "SELECT id, nome FROM Classi";
$result = mysqli_query($conn, $query);
$classi = array();

while($res = mysqli_fetch_assoc($result)){
    $classi[] = $res;
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email= $_POST['email'];
    $classe = $_POST['classe'];

    $stmt = mysqli_prepare($conn, "INSERT INTO Alunni (nome, cognome, mail, id_classe) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssi", $nome, $cognome, $email, $classe);
    
    if (mysqli_stmt_execute($stmt)) {
        $message = "✓ Alunno aggiunto con successo!";
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
    <title>Inserisci alunno</title>
</head>
<body>
    <h1>Inserimento alunno</h1>
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
                Cognome:
            </td>
            <td>
                <input type="text" name="cognome" required>
            </td>
        </tr>
        <tr>
            <td>
                Email:
            </td>
            <td>
                <input type="email" name="email" required>
            </td>
        </tr>
        <tr>
            <td>
                <select name="classe">
                    
                    <?php
                    foreach($classi as $classe){
                        echo "<option value=".$classe["id"].">".$classe["nome"]."</option>";
                    }
                    ?>
                </select>
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
        echo "<h3>$message</h3";
    ?>
</body>
</html>