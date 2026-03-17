# Anagrafica Scolastica - Guida all'Installazione

## Configurazione del Database

### Opzione 1: Importare via phpMyAdmin

1. Apri il browser e vai su `http://localhost/phpmyadmin`
2. Accedi con le tue credenziali (di default username: `root`, password: vuota)
3. Clicca su "Importa" dal menu superiore
4. Seleziona il file `database.sql`
5. Clicca su "Esegui"

### Opzione 2: Importare via Terminale

1. Apri il terminale/cmd nella directory del progetto
2. Esegui il comando:
   ```
   mysql -u root -p < database.sql
   ```
   (Se non hai una password, ometti `-p`)

### Opzione 3: Importare via Script PHP

Crea un file `setup.php` nella cartella del progetto e esegui:
```php
<?php
$conn = mysqli_connect("localhost", "root", "", "");
$sql = file_get_contents("database.sql");
$result = mysqli_multi_query($conn, $sql);

if ($result) {
    echo "Database creato e dati importati con successo!";
} else {
    echo "Errore: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
```

## Struttura del Database

### Tabella: Classi
- `id`: ID univoco (PRIMARY KEY)
- `nome`: Nome della classe (es. "1A Informatica")
- `piano`: Piano/Anno (Primo, Secondo, Terzo, ecc.)
- `note`: Note aggiuntive sulla classe
- `created_at`: Data di creazione

### Tabella: Alunni
- `id`: ID univoco (PRIMARY KEY)
- `nome`: Nome dell'alunno
- `cognome`: Cognome dell'alunno
- `mail`: Email (univoca)
- `id_classe`: Riferimento alla classe (FOREIGN KEY)
- `created_at`: Data di creazione

## Dati di Test Inclusi

Il database include:
- **10 classi** (dalla 1A alla 5B Informatica)
- **18 alunni** distribuiti nelle varie classi

## Credenziali di Connessione

Il file `config.php` usa le seguenti credenziali:
- Host: `localhost`
- Username: `root`
- Password: (vuota)
- Database: `anagrafica_scolastica`

Se le tue credenziali sono diverse, modifica il file `config.php`.

## Test dell'Applicazione

1. Assicurati che XAMPP sia in esecuzione
2. Naviga a `http://localhost/radice-informatica-5a-2526/anagrafica_scolastica/`
3. Prova le funzionalità:
   - **Visualizza Alunni**: Vedi tutti gli alunni con le loro classi
   - **Ricerca Alunno**: Cerca per nome, cognome, email o classe
   - **Inserisci Alunno**: Aggiungi un nuovo alunno
   - **Visualizza Classi**: Vedi tutte le classi
   - **Ricerca Classe**: Cerca per nome o piano
   - **Inserisci Classe**: Aggiungi una nuova classe

## Reset del Database

Se vuoi ricominciare da capo con i dati di test, esegui lo script `database.sql` di nuovo.
Nota: Se usi lo stesso file, dovrai prima eliminare il database:

```sql
DROP DATABASE IF EXISTS anagrafica_scolastica;
```
Poi importa di nuovo il file `database.sql`.
