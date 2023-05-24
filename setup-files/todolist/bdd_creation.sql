CREATE DATABASE todolist;

USE todolist;

CREATE TABLE utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    identifiant VARCHAR(20) NOT NULL UNIQUE,
    motDePasse VARCHAR(45) NOT NULL,
    courriel VARCHAR(120) NOT NULL,
    pseudonyme VARCHAR(45)
);


CREATE TABLE liste_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INT NOT NULL,
    CONSTRAINT fk_listeItems_utilisateurs_id FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id),
    intitule VARCHAR(120) NOT NULL,
    etat_valide BOOLEAN NOT NULL DEFAULT FALSE,
    date_creation DATETIME DEFAULT NOW()
);