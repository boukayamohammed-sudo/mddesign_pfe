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
('Enseignes publicitaires', 'Conception et fabrication d\'enseignes lumineuses, caissons lumineux et lettres en relief pour booster votre visibilité.', 'service_enseignes.jpg', 1),
('Habillage véhicules', 'Marquage publicitaire partiel ou total pour transformer vos véhicules en supports publicitaires mobiles.', 'service_habillage.jpg', 1),
('Covering automobile', 'Personnalisation complète de la carrosserie de vos véhicules de fonction avec des films adhésifs haut de gamme.', 'service_covering.jpg', 1),
('Film solaire automobile', 'Pose de vitres teintées homologuées pour la protection solaire, thermique et l\'intimité.', 'service_film_solaire.jpg', 1),
('Impression numérique', 'Impression grand format sur bâche, vinyle autocollant, papier peint personnalisé et affiches.', 'service_impression.jpg', 1),
('Signalétique', 'Signalétique intérieure et extérieure pour guider et informer vos clients (panneaux de chantier, plaques de porte).', 'service_signaletique.jpg', 1);

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

-- Default Testimonials
INSERT INTO `temoignage` (`nom_client`, `fonction_client`, `message`, `photo`, `actif`) VALUES 
('Karim Alami', 'Gérant de Restaurant', 'MD Design a réalisé notre enseigne lumineuse à Tanger. Travail impeccable, rapide et équipe très professionnelle. Je recommande vivement !', 'client1.jpg', 1),
('Sofia Benjelloun', 'Responsable Marketing', 'Habillage de notre flotte de 5 véhicules commerciaux réalisé avec succès. Le rendu visuel est superbe et tient parfaitement dans le temps.', 'client2.jpg', 1);
