-- SOURCE /var/www/html/htdocs/gestion_scolaire/database/gestion_ecole.sql;
DROP DATABASE `gestion_ecole`;
CREATE DATABASE IF NOT EXISTS `gestion_ecole`;
USE `gestion_ecole`;

-- creation de la table eleves

CREATE TABLE IF NOT EXISTS `eleves`
(
 `eleve_id`          INT NOT NULL AUTO_INCREMENT,
 `eleve_nom`         VARCHAR(80) NOT NULL,
 `eleve_prenom`      VARCHAR(80) NOT NULL,
 `date_de_naissance` DATE NOT NULL,
 PRIMARY KEY(`eleve_id`)
);

-- Insertion dans la table eleves

INSERT INTO `eleves`(`eleve_nom`, `eleve_prenom`, `date_de_naissance`)
VALUES('Jeudy', 'Raphael', '2008-11-03');

-- creation de la table classes

CREATE TABLE IF NOT EXISTS `classes`
(
 `classe_id`  INT NOT NULL AUTO_INCREMENT,
 `classe_nom` VARCHAR(80) NOT NULL,
 PRIMARY KEY(`classe_id`)
);

-- Insertion dans la table classes
INSERT INTO `classes`(`classe_nom`)
VALUES('secondaire I (NS1)');

-- creation de la table inscriptions

CREATE TABLE IF NOT EXISTS `inscriptions`
(
 `id`        INT NOT NULL AUTO_INCREMENT,
 `eleve_id`  INT NOT NULL,
 `classe_id` INT NOT NULL,
 `date_inscription` DATE NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY(`id`),
 CONSTRAINT ins_eleve  FOREIGN KEY(`eleve_id`)   REFERENCES `eleves`(`eleve_id`) ON DELETE CASCADE,
 CONSTRAINT ins_classe FOREIGN KEY(`classe_id`) REFERENCES `classes`(`classe_id`) ON DELETE CASCADE
);

-- Insertion dans la table inscriptions
INSERT INTO `inscriptions`(`eleve_id`, `classe_id`, `date_inscription`)
VALUES(1, 1, '2025-01-10');