<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anagrafica Scolastica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }
        h3 {
            color: #555;
            margin-top: 30px;
        }
        .menu-section {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .menu-section a {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px 5px 5px 0;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .menu-section a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Anagrafica Scolastica</h1>
    
    <div class="menu-section">
        <h3>Operazioni Classi</h3>
        <a href="inserisci_classe.php">Inserisci Classe</a>
        <a href="visualizza_classi.php">Visualizza Classi</a>
        <a href="ricerca_classe.php">Ricerca Classe</a>
    </div>
    
    <div class="menu-section">
        <h3>Operazioni Alunni</h3>
        <a href="inserisci_alunno.php">Inserisci Alunno</a>
        <a href="visualizza_alunni.php">Visualizza Alunni</a>
        <a href="ricerca_alunno.php">Ricerca Alunno</a>
    </div>
</body>
</html>