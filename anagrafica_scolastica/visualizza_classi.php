<?php
require_once 'config.php';

$query = "SELECT id, nome, piano, note FROM Classi ORDER BY nome";
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

$classi = array();
while ($row = mysqli_fetch_assoc($result)) {
    $classi[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Classi</title>
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
    
    <h1>Elenco Classi</h1>
    
    <?php
    if(!empty($delete_message)) {
        $classe_messaggio = (strpos($delete_message, 'successo') !== false) ? 'messaggio-success' : 'messaggio-error';
        echo "<div class='messaggio $classe_messaggio'>$delete_message</div>";
    }
    ?>
    
    <?php
    if (count($classi) > 0) {
        ?>
        <table>
            <tr>
                <th>Nome</th>
                <th>Piano</th>
                <th>Note</th>
                <th>Azioni</th>
            </tr>
            
            <?php
            foreach ($classi as $c) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($c['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($c['piano']) . "</td>";
                echo "<td>" . htmlspecialchars($c['note']) . "</td>";
                echo "<td><a class='delete-link' href='cancella_classe.php?id=" . $c['id'] . "'>Elimina</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        
        <div class="totale">
            Totale classi: <?php echo count($classi); ?>
        </div>
        <?php
    } else {
        ?>
        <div class="no-results">
            <p>Nessuna classe trovata.</p>
        </div>
        <?php
    }
    ?>
