-- MD Design Database Creation Script
-- Target: MySQL / MariaDB

CREATE DATABASE IF NOT EXISTS `md_design` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `md_design`;

-- Disable foreign key checks to allow dropping tables with constraints
SET FOREIGN_KEY_CHECKS = 0;

-- Drop tables if they exist (child tables first)
DROP TABLE IF EXISTS `realisation`;
DROP TABLE IF EXISTS `service`;
DROP TABLE IF EXISTS `admin`;
DROP TABLE IF EXISTS `contact`;
DROP TABLE IF EXISTS `client`;
DROP TABLE IF EXISTS `temoignage`;
DROP TABLE IF EXISTS `parametre`;
DROP TABLE IF EXISTS `faq`;
DROP TABLE IF EXISTS `statistique`;
DROP TABLE IF EXISTS `demande`;

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Table: admin
CREATE TABLE `admin` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `identifiant` VARCHAR(50) NOT NULL UNIQUE,
  `mot_de_passe` VARCHAR(255) NOT NULL,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Table: service
CREATE TABLE `service` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `image` VARCHAR(255),
  `actif` TINYINT(1) DEFAULT 1,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Table: realisation
CREATE TABLE `realisation` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `titre` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `image` VARCHAR(255),
  `date_realisation` DATE,
  `actif` TINYINT(1) DEFAULT 1,
  `id_service` INT NOT NULL,
  CONSTRAINT `fk_realisation_service` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Table: contact
CREATE TABLE `contact` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom_complet` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(20),
  `email` VARCHAR(100),
  `sujet` VARCHAR(150),
  `message` TEXT NOT NULL,
  `date_envoi` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `lu` TINYINT(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Table: client
CREATE TABLE `client` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(20),
  `email` VARCHAR(100),
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Table: temoignage
CREATE TABLE `temoignage` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom_client` VARCHAR(100) NOT NULL,
  `fonction_client` VARCHAR(100),
  `message` TEXT NOT NULL,
  `photo` VARCHAR(255),
  `actif` TINYINT(1) DEFAULT 1,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Table: parametre
CREATE TABLE `parametre` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom_agence` VARCHAR(100) DEFAULT 'MD Design',
  `logo` VARCHAR(255),
  `telephone` VARCHAR(20),
  `whatsapp` VARCHAR(20),
  `email` VARCHAR(100),
  `adresse` TEXT,
  `facebook` VARCHAR(255),
  `instagram` VARCHAR(255),
  `google_maps_url` TEXT,
  `description_agence` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Table: faq
CREATE TABLE `faq` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `question` VARCHAR(255) NOT NULL,
  `reponse` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. Table: statistique
CREATE TABLE `statistique` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `titre` VARCHAR(50) NOT NULL,
  `valeur` VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- SEED DATA
-- Default Admin (Password: admin123)
INSERT INTO `admin` (`identifiant`, `mot_de_passe`) VALUES 
('admin', '$2y$10$j/gSZLGWFcrllvyztU/DEe4/PB.XsbEp97Fp1K.0CcfxGK1Yu9zJK');

-- Default Company Settings (parametre)
INSERT INTO `parametre` (`nom_agence`, `logo`, `telephone`, `whatsapp`, `email`, `adresse`, `facebook`, `instagram`, `google_maps_url`, `description_agence`) VALUES 
('MD Design', 'logo.png', '+212 600 000000', '212600000000', 'contact@mddesign.ma', 'Rue de la Liberté, Tanger, Maroc', 'https://facebook.com/mddesign', 'https://instagram.com/mddesign', 'https://www.google.com/maps/embed?...', 'MD Design est une agence publicitaire leader à Tanger, spécialisée dans les enseignes publicitaires, l\'habillage de véhicules, et le covering.');

-- Default Services
INSERT INTO `service` (`nom`, `description`, `image`, `actif`) VALUES 
('Enseignes publicitaires', 'Conception et fabrication d\'enseignes lumineuses, caissons lumineux et lettres en relief pour booster votre visibilité commerciale. Nous réalisons des enseignes sur mesure adaptées à votre identité visuelle.', 'eurotex.jpeg', 1),
('Habillage véhicules', 'Marquage publicitaire partiel ou total pour transformer vos véhicules en supports publicitaires mobiles. Impression haute résistance aux intempéries et UV.', 'v1.jpeg', 1),
('Covering automobile', 'Personnalisation complète de la carrosserie de vos véhicules de fonction avec des films adhésifs haut de gamme. Protection + communication en un seul geste.', 'v3.jpeg', 1),
('Vitrophanie & film adhésif', 'Décoration et communication sur vitrines, portes et surfaces vitrées avec des films adhésifs micro-perforés ou dépolis personnalisés.', 'k.jpeg', 1),
('Impression numérique grand format', 'Impression grand format sur bâche, vinyle autocollant, papier peint personnalisé, affiches et roll-up pour tous vos événements.', 'caff.jpeg', 1),
('Signalétique & décoration intérieure', 'Signalétique intérieure et extérieure, stickers muraux, lettres découpées et habillages de bureaux pour valoriser vos espaces.', 'mhb.jpeg', 1);

-- Default Stats
INSERT INTO `statistique` (`titre`, `valeur`) VALUES 
('Années d\'expérience', '10+'),
('Projets réalisés', '1500+'),
('Clients satisfaits', '98%'),
('Services proposés', '7+');

-- Default FAQs
INSERT INTO `faq` (`question`, `reponse`) VALUES 
('Quels sont vos délais de fabrication pour une enseigne ?', 'Les délais dépendent de la complexité de l\'enseigne, mais comptent généralement entre 5 et 10 jours ouvrés après validation de la maquette.'),
('Le film covering abîme-t-il la peinture d\'origine ?', 'Non, au contraire. Les films adhésifs de haute qualité protègent la carrosserie des micro-rayures et des rayons UV. Ils peuvent être retirés sans laisser de trace.'),
('Proposez-vous des devis gratuits ?', 'Oui, tous nos devis et études de projet sont entièrement gratuits et sans engagement.');

-- Default Realisations (linked by service position - IDs 1-6)
-- NOTE: Run after services are inserted. Uses SET @s1..@s6 to get dynamic IDs.
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Enseigne Eurotex Tanger', 'Réalisation d\'une grande façade publicitaire pour la marque Peintures Eurotex à Tanger. Structure aluminium composite avec lettres en relief rouges et éclairage LED.', 'eurotex.jpeg', '2024-03-15', 1, id FROM service WHERE nom = 'Enseignes publicitaires' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Enseigne MLC Moto Lab Concept', 'Fabrication et pose d\'une enseigne caisson lumineux 3D pour le magasin MLC Moto Lab Concept à Tanger. Lettres découpées inox rétro-éclairées.', 'mlc.jpeg', '2024-05-20', 1, id FROM service WHERE nom = 'Enseignes publicitaires' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Enseigne Hanane Computers', 'Enseigne grand format pour une boutique informatique. Fond tolé laque avec texte en vinyle découpé haute résistance.', 'hanan computers.jpeg', '2024-02-10', 1, id FROM service WHERE nom = 'Enseignes publicitaires' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Enseigne Gatitov Car Rental', 'Réalisation complète de la devanture publicitaire pour l\'agence Gatitov Location de Voitures : enseigne bander, et vitrine imprimée.', 'gatito.jpeg', '2023-11-05', 1, id FROM service WHERE nom = 'Enseignes publicitaires' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Enseigne Jimmy\'s Fitness', 'Enseigne lumineuse néon flex pour la salle de sport Jimmy\'s Fitness. Lettres en tube néon rouge et blanc montage sur cadre mural.', 'jimmy s fitness.jpeg', '2024-01-18', 1, id FROM service WHERE nom = 'Enseignes publicitaires' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Habillage fourgon Ominta', 'Habillage publicitaire complet d\'un fourgon Renault Dokker pour la société Ominta. Impression numérique haute définition sur films adhésifs calandérés.', 'v1.jpeg', '2024-04-12', 1, id FROM service WHERE nom = 'Habillage véhicules' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Marquage véhicule IRT Foot', 'Marquage partiel d\'un SUV Suzuki Jimny pour le club de football IRT Tanger. Logos et informations appliqués en vinyle découpé et imprimé.', 'v2.jpeg', '2024-06-01', 1, id FROM service WHERE nom = 'Habillage véhicules' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Covering Dacia Logan - Isoltec', 'Covering intégral d\'une Dacia Logan pour la société Isoltec Tanger. Film adhésif qualité premium avec éléments graphiques et coordonnées.', 'v3.jpeg', '2023-09-22', 1, id FROM service WHERE nom = 'Covering automobile' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Vitrophanie DK Kam Beauté', 'Décoration de vitrine complète pour le centre de beauté DK Kam Beauté. Film dépoli personnalisé avec logo doré et liste des prestations sur porte.', 'k.jpeg', '2024-03-08', 1, id FROM service WHERE nom = 'Vitrophanie & film adhésif' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Roll-up Alain Afflelou', 'Impression et assemblage d\'un roll-up promotionnel pour la campagne Tchin Tchin de la marque Alain Afflelou à Tanger.', 'alainafflelou.jpeg', '2024-02-25', 1, id FROM service WHERE nom = 'Vitrophanie & film adhésif' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Impression mur Knour - Alto', 'Impression et pose de visuels publicitaires grand format sur les fenêtres d\'un centre commercial à Tanger pour la campagne Knour.', 'alto.jpeg', '2024-01-30', 1, id FROM service WHERE nom = 'Impression numérique grand format' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Poster CAF AFCON Morocco 2025', 'Impression et pose d\'une affiche grand format pour la Coupe d\'Afrique des Nations Morocco 2025 pour le restaurant Terrasse Blvd.', 'caff.jpeg', '2025-12-21', 1, id FROM service WHERE nom = 'Impression numérique grand format' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Habillage mural MHBland', 'Conception et pose d\'un sticker mural avec la charte graphique Company Values pour les bureaux de MHBland. Lettres découpées et pictogrammes.', 'mhb.jpeg', '2024-05-10', 1, id FROM service WHERE nom = 'Signalétique & décoration intérieure' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Décoration murale Wol Gym', 'Habillage intérieur complet de la salle de sport Wol Gym : impression grand format sur bâche tendue avec visuels forts et branding.', 'clup.jpeg', '2024-04-05', 1, id FROM service WHERE nom = 'Signalétique & décoration intérieure' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Signagé VAR Stade Botola Pro', 'Fabrication et installation des panneaux VAR personnalisés aux couleurs de la Botola Pro pour un stade marocain. Impression sur PVC rigide.', 'varr.jpeg', '2025-01-15', 1, id FROM service WHERE nom = 'Signalétique & décoration intérieure' LIMIT 1;
INSERT INTO `realisation` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
SELECT 'Lettres relief Econer', 'Fabrication de lettres en relief en PVC expansé 3D pour le comptoir d\'accueil d\'Econer, magasin informatique.', 'econer.jpeg', '2023-12-18', 1, id FROM service WHERE nom = 'Enseignes publicitaires' LIMIT 1;

-- Default Testimonials
INSERT INTO `temoignage` (`nom_client`, `fonction_client`, `message`, `photo`, `actif`) VALUES 
('Karim Alami', 'Gérant de Restaurant', 'MD Design a réalisé notre enseigne lumineuse à Tanger. Travail impeccable, rapide et équipe très professionnelle. Je recommande vivement !', 'client1.jpg', 1),
('Sofia Benjelloun', 'Responsable Marketing', 'Habillage de notre flotte de 5 véhicules commerciaux réalisé avec succès. Le rendu visuel est superbe et tient parfaitement dans le temps.', 'client2.jpg', 1);
