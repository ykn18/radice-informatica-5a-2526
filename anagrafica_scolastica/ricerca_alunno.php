<?php
require_once('config.php');

// Recupera le classi per il dropdown
$query_classi = "SELECT id, nome FROM Classi ORDER BY nome";
$result_classi = mysqli_query($conn, $query_classi);
$classi = array();

while($res = mysqli_fetch_assoc($result_classi)){
    $classi[] = $res;
}

// Variabili per i criteri di ricerca
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$cognome = isset($_POST['cognome']) ? trim($_POST['cognome']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$classe = isset($_POST['classe']) ? $_POST['classe'] : '';

// Array per memorizzare i risultati
$risultati = array();
$messaggio_ricerca = '';

// Se il form è stato inviato
if($_SERVER["REQUEST_METHOD"] === "POST"){
    // Costruire la query dinamicamente in base ai criteri inseriti
    $query = "SELECT Alunni.id, Alunni.nome, Alunni.cognome, Alunni.mail, Classi.nome as classe_nome 
              FROM Alunni 
              JOIN Classi ON Alunni.id_classe = Classi.id 
              WHERE 1=1";
    
    $params = array();
    $types = '';
    
    // Aggiunge i criteri di ricerca se compilati
    if(!empty($nome)){
        $query .= " AND Alunni.nome LIKE ?";
        $params[] = '%' . $nome . '%';
        $types .= 's';
    }
    
    if(!empty($cognome)){
        $query .= " AND Alunni.cognome LIKE ?";
        $params[] = '%' . $cognome . '%';
        $types .= 's';
    }
    
    if(!empty($email)){
        $query .= " AND Alunni.mail LIKE ?";
        $params[] = '%' . $email . '%';
        $types .= 's';
    }
    
    if(!empty($classe)){
        $query .= " AND Alunni.id_classe = ?";
        $params[] = $classe;
        $types .= 'i';
    }
    
    $query .= " ORDER BY Alunni.cognome, Alunni.nome";
    
    // Prepara la query con prepared statement
    $stmt = mysqli_prepare($conn, $query);
    
    // Se ci sono parametri, li associa
    if(!empty($params)){
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    // Esegui la query
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        
        while($row = mysqli_fetch_assoc($result)){
            $risultati[] = $row;
        }
        
        $messaggio_ricerca = "Trovati " . count($risultati) . " risultati";
    } else {
        $messaggio_ricerca = "Errore nella ricerca: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca Alunno</title>
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
        input[type="text"], input[type="email"], select {
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
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
        .torna-home {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="torna-home">
        <a href="index.php">← Torna alla home</a>
    </div>
    
    <h1>Ricerca Alunno</h1>
    
    <form method="POST">
        <h3>Criteri di Ricerca</h3>
        <p><strong>Nota:</strong> Compilare uno o più campi per effettuare la ricerca</p>
        
        <div>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" placeholder="Inserisci il nome">
        </div>
        
        <div>
            <label for="cognome">Cognome:</label><br>
            <input type="text" id="cognome" name="cognome" value="<?php echo htmlspecialchars($cognome); ?>" placeholder="Inserisci il cognome">
        </div>
        
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Inserisci l'email">
        </div>
        
        <div>
            <label for="classe">Classe:</label><br>
            <select id="classe" name="classe">
                <option value="">-- Seleziona una classe --</option>
                <?php
                foreach($classi as $c){
                    $selected = ($c['id'] == $classe) ? 'selected' : '';
                    echo "<option value='" . $c['id'] . "' " . $selected . ">" . htmlspecialchars($c['nome']) . "</option>";
                }
                ?>
            </select>
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
        if(count($risultati) > 0){
            ?>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Email</th>
                    <th>Classe</th>
                </tr>
                <?php
                foreach($risultati as $alunno){
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($alunno['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($alunno['cognome']) . "</td>";
                    echo "<td>" . htmlspecialchars($alunno['mail']) . "</td>";
                    echo "<td>" . htmlspecialchars($alunno['classe_nome']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <?php
        } else if($_SERVER["REQUEST_METHOD"] === "POST"){
            ?>
            <div class="no-results">
                <p>Nessun alunno trovato con i criteri di ricerca inseriti.</p>
            </div>
            <?php
        }
    }
    ?>
</body>
</html>
