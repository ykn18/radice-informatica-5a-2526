-- Database: anagrafica_scolastica
-- Creazione del database
CREATE DATABASE IF NOT EXISTS anagrafica_scolastica;
USE anagrafica_scolastica;

-- Tabella Classi
CREATE TABLE IF NOT EXISTS Classi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    piano VARCHAR(50) NOT NULL,
    note TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabella Alunni
CREATE TABLE IF NOT EXISTS Alunni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    mail VARCHAR(255) NOT NULL UNIQUE,
    id_classe INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_classe) REFERENCES Classi(id) ON DELETE CASCADE
);

-- Dati di test - Classi
INSERT INTO Classi (nome, piano, note) VALUES
('1A Informatica', 'Primo', 'Classe primo anno informatica'),
('1B Informatica', 'Primo', 'Classe primo anno informatica'),
('2A Informatica', 'Secondo', 'Classe secondo anno informatica'),
('2B Informatica', 'Secondo', 'Classe secondo anno informatica'),
('3A Informatica', 'Terzo', 'Classe terzo anno informatica'),
('3B Informatica', 'Terzo', 'Classe terzo anno informatica'),
('4A Informatica', 'Quarto', 'Classe quarto anno informatica'),
('4B Informatica', 'Quarto', 'Classe quarto anno informatica'),
('5A Informatica', 'Quinto', 'Classe quinto anno informatica'),
('5B Informatica', 'Quinto', 'Classe quinto anno informatica');

-- Dati di test - Alunni
INSERT INTO Alunni (nome, cognome, mail, id_classe) VALUES
('Marco', 'Rossi', 'marco.rossi@example.com', 1),
('Luca', 'Bianchi', 'luca.bianchi@example.com', 1),
('Anna', 'Verdi', 'anna.verdi@example.com', 1),
('Sofia', 'Ferrari', 'sofia.ferrari@example.com', 2),
('Giovanni', 'Russo', 'giovanni.russo@example.com', 2),
('Elena', 'Colombo', 'elena.colombo@example.com', 2),
('Andrea', 'Gallo', 'andrea.gallo@example.com', 3),
('Matteo', 'Conti', 'matteo.conti@example.com', 3),
('Francesca', 'De Luca', 'francesca.deluca@example.com', 3),
('Davide', 'Moretti', 'davide.moretti@example.com', 4),
('Sara', 'Rizzo', 'sara.rizzo@example.com', 4),
('Paolo', 'Lombardi', 'paolo.lombardi@example.com', 4),
('Alessia', 'Marini', 'alessia.marini@example.com', 5),
('Riccardo', 'Romano', 'riccardo.romano@example.com', 5),
('Giulia', 'Ferraro', 'giulia.ferraro@example.com', 5),
('Enrico', 'Barone', 'enrico.barone@example.com', 6),
('Chiara', 'Fiorelli', 'chiara.fiorelli@example.com', 6),
('Simone', 'Costa', 'simone.costa@example.com', 6);
