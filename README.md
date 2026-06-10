# MD Design - Agence Publicitaire (Tanger)

MD Design est un projet d'application web full-stack (Site Web Vitrine Professionnel + Dashboard Administrateur) conçu pour une agence publicitaire située à Tanger.

L'application permet à l'agence de présenter ses services (enseignes, habillage véhicules, covering, vitrages solaires, impressions) et ses réalisations, de recueillir des témoignages de clients, de recevoir des messages via un formulaire de contact, et d'ouvrir un canal de discussion direct via des boutons de devis WhatsApp dynamiques.

---

## 🚀 Fonctionnalités principales

### 🌐 Front-Office (Site Public)
- **Accueil :** Hero banner percutante, présentation, services populaires, projets récents, statistiques animées et témoignages de clients.
- **Nos Services :** Liste complète des prestations de communication visuelle avec des pages de détails dédiées.
- **Bouton Devis WhatsApp :** Intégration de boutons de devis direct pré-remplis avec le nom du service demandé.
- **Galerie des Réalisations (Portfolio) :** Filtrage dynamique par catégorie de service (via paramètres URL et transitions fluides).
- **Formulaire de Contact :** Transmission sécurisée de messages sauvegardés en base de données.
- **À Propos :** L'histoire, les engagements et la charte qualité de l'agence à Tanger.

### 🔐 Back-Office (Espace Admin)
- **Authentification Sécurisée :** Connexion/déconnexion protégée par session.
- **Tableau de bord (Dashboard) :** Statistiques globales (nombre de services, de réalisations, de témoignages, de messages non lus) et raccourcis rapides.
- **CRUD Services :** Ajout, modification, désactivation, suppression et upload d'images pour les services.
- **CRUD Réalisations :** Gestion complète du portfolio de projets associés aux services.
- **CRUD Témoignages :** Administration des retours clients (messages, avatars, statuts).
- **Gestion des Messages :** Lecture, marquage comme lu et suppression des messages reçus via le formulaire de contact.
- **Paramètres Généraux :** Formulaire de mise à jour des coordonnées de l'agence (téléphone, WhatsApp, email, adresse, réseaux sociaux, description SEO, et remplacement du logo).

---

## 🛠️ Technologies & Architecture

- **Langage :** PHP 8.x (Orienté Objet)
- **Base de données :** MySQL / MariaDB (via PDO et requêtes préparées)
- **Styling :** CSS3 Vanilla (Design Moderne Premium, Glassmorphism, animations fluides, responsive multi-écrans)
- **Scripts :** JavaScript ES6 (toggles de menu mobile, prévisualisation d'uploads de fichiers, etc.)
- **Architecture :** MVC Custom (Model-View-Controller) développé de manière structurée sans framework externe.
- **Sécurité :** Requêtes préparées contre les injections SQL, échappement HTML pour la prévention XSS, validation stricte d'upload d'images (MIME types et dimensions), et sessions d'administration sécurisées.

---

## 📂 Structure du Projet

```
md_design/
├── app/
│   ├── controllers/      # Logique de contrôle (HomeController, ServiceController, etc.)
│   ├── models/           # Interactions Base de données (Service, Realisation, Parametre, etc.)
│   ├── views/            # Fichiers de rendus HTML (layouts/, home/, services/, admin/, etc.)
│   │   └── layouts/      # En-têtes, pieds de page et barres latérales partagées
│   ├── core/             # Coeur du framework (Database, Router, Controller, Model, Session)
│   └── helpers/          # Fonctions utilitaires globales et middlewares (check_admin)
├── config/
│   └── config.php        # Constantes de connexion et paramètres globaux
├── database/
│   └── md_design.sql     # Script de création et données de démo (seeding)
├── public/
│   ├── assets/           # Fichiers statiques (css/style.css, js/main.js, images/)
│   │   └── uploads/      # Dossiers d'uploads d'images (services, realisations, logos, etc.)
│   ├── index.php         # Contrôleur frontal (Point d'entrée unique de l'application)
│   └── .htaccess         # Règles de réécriture d'URL Apache
├── docs/                 # Spécifications d'analyses et cahier des charges
└── README.md             # Guide et documentation technique
```

---

## 📦 Installation & Configuration locale

### 1. Prérequis
Installez un serveur local comme **XAMPP** (comprenant PHP 8.x et MySQL/MariaDB).

### 2. Déploiement des fichiers
Placez le dossier du projet dans le répertoire racine de votre serveur web (ex: `C:/xampp/htdocs/mddesign_pfe/`).

### 3. Base de données
1. Démarrez les modules Apache et MySQL dans le panneau XAMPP.
2. Accédez à `phpMyAdmin` (http://localhost/phpmyadmin/).
3. Créez une base de données nommée `md_design` (encodage `utf8mb4_unicode_ci`).
4. Importez le fichier SQL `database/md_design.sql` pour créer les tables et charger les données de démonstration.

### 4. Configuration applicative
Vérifiez les paramètres de connexion SQL dans le fichier [config.php](file:///c:/xampp/htdocs/mddesign_pfe/config/config.php) :
```php
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'md_design');
```

### 5. Lancement
Ouvrez votre navigateur et accédez à :
```
http://localhost/mddesign_pfe/public/
```

---

## 🔑 Identifiants d'Administration (Défaut)

Pour accéder au Dashboard d'administration :
- **Lien de connexion :** `http://localhost/mddesign_pfe/public/login`
- **Identifiant :** `admin`
- **Mot de passe :** `admin123`
