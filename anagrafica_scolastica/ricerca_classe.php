<?php
require_once 'config.php';

$piano_ricerca = isset($_POST['piano']) ? trim($_POST['piano']) : '';
$nome_ricerca = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$classi = array();
$messaggio_ricerca = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "SELECT id, nome, piano, note FROM Classi WHERE 1=1";
    
    $params = array();
    $types = '';
    
    if(!empty($piano_ricerca)){
        $query .= " AND piano LIKE ?";
        $params[] = '%' . $piano_ricerca . '%';
        $types .= 's';
    }
    
    if(!empty($nome_ricerca)){
        $query .= " AND nome LIKE ?";
        $params[] = '%' . $nome_ricerca . '%';
        $types .= 's';
    }
    
    $query .= " ORDER BY nome";
    
    $stmt = mysqli_prepare($conn, $query);
    
    if(!empty($params)){
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $classi[] = $row;
        }
        
        $messaggio_ricerca = "Trovate " . count($classi) . " classi";
    } else {
        $messaggio_ricerca = "Errore nella ricerca: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca Classe</title>
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
        input[type="text"] {
            padding: 8px;
            margin: 5px 5px 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .messaggio {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .messaggio-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .no-results {
            text-align: center;
            color: #666;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="torna-home">
        <a href="index.php">← Torna alla home</a>
    </div>
    
    <h1>Ricerca Classe</h1>
    
    <form method="POST">
        <h3>Criteri di Ricerca</h3>
        
        <div>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome_ricerca); ?>" placeholder="Inserisci il nome">
        </div>
        
        <div>
            <label for="piano">Piano:</label><br>
            <input type="text" id="piano" name="piano" value="<?php echo htmlspecialchars($piano_ricerca); ?>" placeholder="Inserisci il piano">
        </div>
        
        <br><button type="submit">Cerca</button>
        <button type="reset">Cancella</button>
    </form>
    
    <?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        ?>
        <div class="messaggio messaggio-info">
            <?php echo $messaggio_ricerca; ?>
        </div>
        
        <?php
        if(count($classi) > 0){
            ?>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Piano</th>
                    <th>Note</th>
                </tr>
                <?php
                foreach($classi as $classe){
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($classe['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($classe['piano']) . "</td>";
                    echo "<td>" . htmlspecialchars($classe['note']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <?php
        } else if($_SERVER["REQUEST_METHOD"] === "POST"){
            ?>
            <div class="no-results">
                <p>Nessuna classe trovata con i criteri di ricerca inseriti.</p>
            </div>
            <?php
        }
    }
    ?>
</body>
</html>
