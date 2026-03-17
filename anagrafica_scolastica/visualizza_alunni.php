<?php
require_once 'config.php';

$query = "SELECT Alunni.id as id, Alunni.nome as Nome, Alunni.cognome as Cognome, Alunni.mail as EMail, Classi.nome as Classi FROM Alunni JOIN Classi ON Alunni.id_classe = Classi.id ORDER BY Classi.nome, Alunni.cognome, Alunni.nome;";
$result = mysqli_query($conn, $query);

$delete_message = "";

if(isset($_GET["result"])){
    if($_GET["result"] === "success"){
        $delete_message = "Eliminato con successo";
    } else if ($_GET["result"] === "failure"){
        $delete_message = "Errore nella cancellazione";
    }
}

if (!$result) {
    die("Errore nella query: " . mysqli_error($conn));
}

$alunni = array();
while ($row = mysqli_fetch_assoc($result)) {
    $alunni[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Alunni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .messaggio {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .messaggio-success {
            background-color: #d4edda;
            color: #155724;
        }
        .messaggio-error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .no-results {
            text-align: center;
            color: #666;
            padding: 20px;
        }
        .torna-home {
            margin-bottom: 20px;
        }
        .delete-link {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            display: inline-block;
        }
        .delete-link:hover {
            background-color: #c82333;
        }
        .totale {
            margin-top: 20px;
            font-weight: bold;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="torna-home">
        <a href="index.php">← Torna alla home</a>
    </div>
    
    <h1>Elenco Alunni</h1>
    
    <?php
    if(!empty($delete_message)) {
        $classe_messaggio = (strpos($delete_message, 'successo') !== false) ? 'messaggio-success' : 'messaggio-error';
        echo "<div class='messaggio $classe_messaggio'>$delete_message</div>";
    }
    ?>
    
    <?php
    if (count($alunni) > 0) {
        ?>
        <table>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Classe</th>
                <th>Azioni</th>
            </tr>
            
            <?php
            foreach ($alunni as $a) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($a['Nome']) . "</td>";
                echo "<td>" . htmlspecialchars($a['Cognome']) . "</td>";
                echo "<td>" . htmlspecialchars($a['EMail']) . "</td>";
                echo "<td>" . htmlspecialchars($a['Classi']) . "</td>";
                echo "<td><a class='delete-link' href='cancella_alunno.php?id=" . $a['id'] . "'>Elimina</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        
        <div class="totale">
            Totale alunni: <?php echo count($alunni); ?>
        </div>
        <?php
    } else {
        ?>
        <div class="no-results">
            <p>Nessun alunno trovato.</p>
        </div>
        <?php
    }
    ?>
</body>
</html>
