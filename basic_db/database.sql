-- ============================================================================
-- DATABASE ANAGRAFICA BASIC
-- Script SQL per creare il database con Stored Procedures
-- ============================================================================

-- Crea il database
CREATE DATABASE IF NOT EXISTS anagrafica_basic;
USE anagrafica_basic;

-- ============================================================================
-- TABELLA PERSONE
-- ============================================================================

DROP TABLE IF EXISTS persone;

CREATE TABLE persone (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    data_inserimento TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================================
-- TABELLA TELEFONI (collegata a persone)
-- ============================================================================

DROP TABLE IF EXISTS telefoni;

CREATE TABLE telefoni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id INT NOT NULL,
    numero VARCHAR(20) NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    data_inserimento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_telefoni_persona
        FOREIGN KEY (persona_id)
        REFERENCES persone(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- ============================================================================
-- INSERISCI DATI DI ESEMPIO
-- ============================================================================

INSERT INTO persone (nome, cognome, email) VALUES
('Mario', 'Rossi', 'mario.rossi@email.com'),
('Anna', 'Bianchi', 'anna.bianchi@email.com'),
('Giovanni', 'Verdi', 'giovanni.verdi@email.com'),
('Laura', 'Neri', 'laura.neri@email.com');

INSERT INTO telefoni (persona_id, numero, tipo) VALUES
(1, '3331112233', 'Cellulare'),
(1, '0299887766', 'Casa'),
(2, '3475551122', 'Cellulare'),
(3, '051334455', 'Ufficio');

-- ============================================================================
-- ISTRUZIONI PER L'USO:
-- ============================================================================
-- 1. Apri phpMyAdmin (http://localhost/phpmyadmin)
-- 2. Vai su "SQL" e copia tutto questo contenuto
-- 3. Clicca "Esegui"
-- 4. Il database con le procedure sarà creato
-- ============================================================================
