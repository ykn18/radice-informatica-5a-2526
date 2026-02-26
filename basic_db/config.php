<?php
// CONFIG - Connessione al Database MySQL

// Dati di connessione
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "anagrafica_basic";

// Connessione al database
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Controllo della connessione
if (!$conn) {
    die("Errore di connessione: " . mysqli_connect_error());
}

// Imposta UTF-8
mysqli_set_charset($conn, "utf8mb4");
?>
