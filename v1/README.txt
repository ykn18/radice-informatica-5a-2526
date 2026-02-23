╔════════════════════════════════════════════════════════════════════════╗
║          DEMO ANAGRAFICA PHP - TUTORIAL PER PRINCIPIANTI                ║
║                  PHP Procedurale, GET e POST                             ║
╚════════════════════════════════════════════════════════════════════════╝

📋 DESCRIZIONE
==============
Questa è una semplice demo di un sistema anagrafica in PHP procedurale.
Mostra come utilizzare GET e POST per interagire con i dati.

IMPORTANTE: I dati NON sono persistenti. Vengono persi al refresh della pagina.
           Questo è voluto per mantenere la demo semplice senza database.


🚀 COME USARE
=============
1. Avvia XAMPP e attiva Apache
2. Accedi da browser: http://localhost/www/radice-informatica-5a-2526/
3. Esplora le tre pagine:
   - index.php      : Homepage e spiegazioni
   - dati.php       : Visualizzazione con GET
   - form.php       : Form con POST


📚 PAGINE DELLA DEMO
====================

1. INDEX.PHP (Homepage)
   ├─ Pagina di benvenuto
   ├─ Spiega i concetti della demo
   └─ Menu di navigazione

2. DATI.PHP (Visualizzazione - GET)
   ├─ Mostra lista di persone in una tabella
   ├─ Contiene un form di ricerca (metodo GET)
   ├─ Filtra per cognome usando il parametro URL
   ├─ Esempio URL: dati.php?cognome=Rossi
   └─ Dimostra: isset(), array, foreach, stripos()

3. FORM.PHP (Inserimento - POST)
   ├─ Form per aggiungere una nuova persona
   ├─ Utilizza il metodo POST (dati nascosti nell'URL)
   ├─ Valida i campi compilati
   ├─ Controlla il formato email
   └─ Dimostra: $_POST, $_SERVER, filter_var(), trim()


💡 CONCETTI PHP DIMOSTRATI
===========================

GET:
────
- Utilizzo: dati.php?cognome=Rossi
- Accesso: $_GET['cognome']
- Visibile nell'URL
- Massimo ~2000 caratteri
- Usato per ricerche e filtri

POST:
─────
- Dati inviati nel corpo della richiesta
- Accesso: $_POST['nome']
- Non visibile nell'URL
- Capacità di trasmissione: illimitata
- Più sicuro per dati sensibili
- Usato per inserimenti e modifiche

Array:
──────
$persone = array(
    array("nome" => "Mario", "cognome" => "Rossi", ...),
    array("nome" => "Anna", "cognome" => "Bianchi", ...),
);

Loop foreach:
──────────────
foreach ($persone as $persona) {
    echo $persona['nome'];
}

Condizionali:
──────────────
if (isset($_GET['cognome'])) {
    // Il parametro GET esiste
}

Funzioni di base:
─────────────────
- isset()           : Controlla se una variabile esiste
- empty()           : Controlla se una variabile è vuota
- trim()            : Rimuove spazi bianchi
- stripos()         : Cerca una stringa (case-insensitive)
- filter_var()      : Valida una variabile
- htmlspecialchars(): Evita XSS escappando i caratteri speciali
- urlencode()       : Codifica stringhe per l'URL
- count()           : Conta elementi di un array


🔍 PUNTI CHIAVE SUL CODICE
===========================

1. PARAMETRI GET:
   $ricerca = $_GET['cognome'] ?? ""; // Leggi GET
   dati.php?cognome=Rossi              // Nell'URL

2. PARAMETRI POST:
   $nome = $_POST['nome'];             // Leggi POST
   Sono nascosti nel corpo della richiesta

3. SICUREZZA:
   htmlspecialchars()  - Previene XSS
   filter_var()        - Valida email
   trim()              - Rimuove spazi

4. VALIDAZIONE:
   if (!empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
       // Dati validi
   }


🎯 ESERCIZI SUGGERITI
=====================

1. Aggiungi un filtro per nome in dati.php
2. Aggiungi la possibilità di ordinare per colonna
3. Crea una pagina di dettaglio con un singolo record
4. Aggiungi validazione per la data di nascita
5. Creami un filtro per comune


📂 STRUTTURA FILE
=================
radice-informatica-5a-2526/
├── index.php          (Homepage)
├── dati.php           (Visualizzazione + GET)
├── form.php           (Form + POST)
├── style.css          (Stile CSS)
└── README.txt         (Questo file)


⚠️ NOTE IMPORTANTI
==================
- NON c'è database: i dati sono solo in memoria
- NON c'è sessione: i dati svaniscono al refresh
- NON c'è upload file: solo dati di testo
- È SOLO una DEMO per imparare i fondamenti
- In produzione, usare sempre: Database, Validazione robusta, OOP, Framework


🛠️ PROSSIMI PASSI
=================
Una vera applicazione dovrebbe includere:

1. Database (MySQL, PostgreSQL, SQLite)
   - Persistenza dei dati
   - Query SQL
   - Connessione con mysqli o PDO

2. Sessioni
   - Login/Logout
   - Autenticazione
   - $_SESSION

3. Upload file
   - $_FILES
   - Validazione file
   - Salvataggio sul server

4. Orientamento agli oggetti (OOP)
   - Classi
   - Oggetti
   - Eredità


📞 CONTATTI/AIUTO
=================
Questa è una semplice demo educativa.
Per problemi, verifica che:
- Apache sia in esecuzione
- Il percorso sia corretto
- PHP sia installato su XAMPP


═══════════════════════════════════════════════════════════════════════════
                        Happy Coding! 🚀 PHP
═══════════════════════════════════════════════════════════════════════════
