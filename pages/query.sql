-- Table Utilisateurs
CREATE TABLE Utilisateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    email TEXT NOT NULL,
    motDePasse TEXT NOT NULL
);

-- Table Livres
CREATE TABLE Livres (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titre TEXT NOT NULL,
    auteur TEXT NOT NULL,
    annee INTEGER NOT NULL,
    status TEXT NOT NULL,
    genre TEXT NOT NULL,
    location TEXT NOT NULL
);

-- Table Collections
CREATE TABLE Collections (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_utilisateurs INTEGER NOT NULL,
    FOREIGN KEY (id_utilisateurs) REFERENCES Utilisateurs(id)
);

-- Table CollectionLivres
CREATE TABLE CollectionLivres (
    id_collection INTEGER NOT NULL,
    id_livre INTEGER NOT NULL,
    PRIMARY KEY (id_collection, id_livre),
    FOREIGN KEY (id_collection) REFERENCES Collections(id),
    FOREIGN KEY (id_livre) REFERENCES Livres(id)
);

-- Table Prets
CREATE TABLE Prets (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_utilisateur INTEGER NOT NULL,
    id_livre INTEGER NOT NULL,
    nom TEXT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id),
    FOREIGN KEY (id_livre) REFERENCES Livres(id)
);

-------------------------

INSERT INTO Utilisateurs (nom, email, motDePasse) VALUES
('Awa Diop', 'awa.diop@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS'),
('Cheikh Ndiaye', 'cheikh.ndiaye@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS'),
('Fatou Sy', 'fatou.sy@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS'),
('Mamadou Ba', 'mamadou.ba@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS'),
('Aminata Faye', 'aminata.faye@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS'),
('Abdoulaye Sow', 'abdoulaye.sow@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS'),
('Marieme Seck', 'marieme.seck@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS'),
('Ibrahima Diallo', 'ibrahima.diallo@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS'),
('Sokhna Kane', 'sokhna.kane@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS'),
('Serigne Diagne', 'serigne.diagne@example.com', '$2y$10$OWNvkNOwDdtKxw9FwHS6Ge5lo5Vq.GFrobqgF.fNWyGARDvg3VhCS');

-------------------------

INSERT INTO Livres (titre, auteur, annee, status, genre, location) VALUES
('Les Soleils des Indépendances', 'Ahmadou Kourouma', 1970, 'Disponible', 'Roman', 'A1'),
('L\'Aventure ambiguë', 'Cheikh Hamidou Kane', 1961, 'Disponible', 'Roman', 'B2'),
('Une si longue lettre', 'Mariama Bâ', 1979, 'Emprunté', 'Roman', 'C3'),
('L\'Enfant noir', 'Camara Laye', 1953, 'Disponible', 'Autobiographie', 'D4'),
('Le Vieux Nègre et la Médaille', 'Ferdinand Oyono', 1956, 'Disponible', 'Roman', 'E5'),
('Le Baobab fou', 'Ken Bugul', 1982, 'Emprunté', 'Roman', 'F6'),
('Les Bouts de bois de Dieu', 'Ousmane Sembène', 1960, 'Disponible', 'Roman', 'G7'),
('Le Pleurer-rire', 'Henri Lopes', 1982, 'Disponible', 'Roman', 'H8'),
('La Vie et demie', 'Sony Labou Tansi', 1979, 'Emprunté', 'Roman', 'I9'),
('L\'Étrange Destin de Wangrin', 'Amadou Hampâté Bâ', 1973, 'Disponible', 'Roman', 'J10');

-------------------------

INSERT INTO Collections (id_utilisateurs) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-------------------------



-------------------------



-------------------------



-------------------------
