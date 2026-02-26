ANAGRAFICA - BASIC VERSION
==========================

Questa è una versione semplificata del sistema anagrafica, progettata per 
gli studenti che si avvicinano per la prima volta a PHP e MySQL.

CARATTERISTICHE:
- Codice pulito e facile da capire
- Connessione MySQL semplice
- PHP procedurale con MySQLi
- Tre funzioni base: visualizzare, aggiungere, cercare
- Senza CSS o layout complessi
- Tabella HTML semplice per i risultati

FILE:
- config.php: Configurazione della connessione al database
- dati.php: Visualizza tutte le persone (SELECT * all)
- form.php: Form per aggiungere una nuova persona (INSERT)
- ricerca.php: Ricerca persone per cognome (SELECT WHERE LIKE)
- database.sql: Script per creare il database e la tabella
- index.php: Homepage con menu di navigazione

COME INIZIARE:
1. Assicurati che XAMPP sia avviato (Apache + MySQL)
2. Apri phpMyAdmin: http://localhost/phpmyadmin
3. Copia il contenuto di database.sql nella sezione SQL di phpMyAdmin
4. Esegui lo script
5. Apri nel browser: http://localhost/radice-informatica-5a-2526/basic/

CONCETTI INSEGNATI:
- Connessione a MySQL da PHP con mysqli
- Query SQL dirette (SELECT, INSERT, WHERE LIKE)
- Prepared Statements per sicurezza (prevenzione SQL Injection)
- mysqli_bind_param per passare parametri in sicurezza
- Gestione dei risultati con mysqli_fetch_assoc
- HTML forms con metodo POST
- Array e cicli PHP

STRUTTURA DEL CODICE:
- mysqli_query(): Esegue query semplici (SELECT)
- mysqli_prepare(): Prepara una query
- mysqli_stmt_bind_param(): Lega parametri alla query
- mysqli_stmt_execute(): Esegue la query preparata
- mysqli_stmt_get_result(): Ottiene i risultati
- mysqli_fetch_assoc(): Legge una riga di risultati
