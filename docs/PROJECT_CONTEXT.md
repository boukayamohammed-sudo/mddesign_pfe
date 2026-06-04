# MD DESIGN - PROJECT CONTEXT

## 1. Présentation du projet

Nom du projet :

MD Design

Type :

Site Web Professionnel + Dashboard Administrateur

Technologies :

- HTML5
- CSS3
- JavaScript
- PHP 8 Orienté Objet
- MySQL
- PDO
- Architecture MVC
- Git / GitHub
- XAMPP

---

## 2. Contexte métier

MD Design est une agence publicitaire située à Tanger.

Services proposés :

- Enseignes publicitaires
- Habillage véhicules
- Covering automobile
- Film solaire automobile
- Impression numérique
- Signalétique
- Lettres en relief

Objectif du site :

- Présenter l'entreprise
- Présenter les services
- Présenter les réalisations
- Afficher les témoignages
- Faciliter le contact
- Gérer le contenu via un espace administrateur

---

## 3. Charte Graphique

Couleurs principales :

Orange :
#FF7A00

Orange secondaire :
#E86800

Gris foncé :
#2C2C2C

Gris clair :
#E5E5E5

Blanc :
#FFFFFF

Style :

- Moderne
- Professionnel
- Responsive
- Industriel
- Premium

---

## 4. Structure MVC finale

md_design/

app/

controllers/

- HomeController.php
- ServiceController.php
- RealisationController.php
- ContactController.php
- AuthController.php
- DashboardController.php
- ParametreController.php
- TemoignageController.php

models/

- Admin.php
- Service.php
- Realisation.php
- Contact.php
- Temoignage.php
- Parametre.php
- Client.php

views/

layouts/

- header.php
- footer.php
- navbar.php
- admin_header.php
- admin_sidebar.php

home/
service/
realisation/
contact/
auth/
dashboard/
parametre/
temoignage/

core/

- Database.php
- Router.php
- Controller.php
- Model.php
- Session.php

helpers/

- functions.php
- validator.php

public/

assets/

- css/
- js/
- images/
- uploads/

index.php
.htaccess

config/

- config.php

database/

- md_design.sql

docs/

README.md

.gitignore

---

## 5. Base de données officielle

Tables :

### ADMIN

- id
- identifiant
- mot_de_passe
- date_creation

### SERVICE

- id
- nom
- description
- image
- actif
- date_creation

### REALISATION

- id
- titre
- description
- image
- date_realisation
- actif
- id_service

### CONTACT

Table utilisée pour enregistrer les messages envoyés depuis le formulaire Contact.

Champs :

- id
- nom_complet
- telephone
- email
- sujet
- message
- date_envoi
- lu

### CLIENT

Table conservée pour les évolutions futures du projet.

Champs :

- id
- nom
- telephone
- email
- date_creation

### TEMOIGNAGE

- id
- nom_client
- fonction_client
- message
- photo
- actif
- date_creation

### PARAMETRE

Cette table contient toutes les informations dynamiques de l'entreprise.

IMPORTANT :

Les informations de l'entreprise doivent être stockées dans cette table et affichées via fetch PDO.

Aucune information entreprise ne doit être écrite directement dans le HTML.

Contenu :

- nom_agence
- logo
- telephone
- whatsapp
- email
- adresse
- facebook
- instagram
- google_maps_url
- description_agence

### FAQ

- id
- question
- reponse

### STATISTIQUE

- id
- titre
- valeur

---

## 6. Fonctionnement WhatsApp

Pour chaque service :

Le bouton :

"Demander un devis"

doit ouvrir WhatsApp.

Exemple :

Bonjour,

Je souhaite obtenir plus d'informations concernant le service :
Habillage Véhicule.

Le formulaire Contact reste disponible pour les visiteurs qui souhaitent envoyer un message classique.

---

## 7. Fonctionnalités Front Office

Accueil :

- Hero Banner
- Présentation agence
- Services populaires
- Réalisations récentes
- Témoignages
- Statistiques
- Bouton WhatsApp

Services :

- Liste services
- Détails service
- Bouton WhatsApp

Réalisations :

- Galerie dynamique
- Filtrage par service

Contact :

- Formulaire contact
- Google Maps
- Coordonnées entreprise

À propos :

- Présentation entreprise

---

## 8. Fonctionnalités Dashboard

Authentification Admin

Gestion Services :

- Ajouter
- Modifier
- Supprimer
- Désactiver

Gestion Réalisations :

- CRUD complet

Gestion Témoignages :

- CRUD complet

Gestion Messages :

- Consulter
- Marquer comme lu

Gestion Paramètres :

- Modifier informations entreprise

Dashboard :

- Nombre services
- Nombre réalisations
- Nombre messages
- Nombre témoignages

---

## 9. Sécurité

Obligatoire :

- PDO
- Prepared Statements
- Validation des formulaires
- Protection XSS
- Upload sécurisé
- Sessions sécurisées

---

## 10. Etat actuel du projet

Déjà fait :

- Repository GitHub créé
- Structure MVC créée
- Blueprint validé
- Base de données conçue
- MLD validé

Pas encore fait :

- Création réelle de la base
- PDO
- Router
- MVC fonctionnel
- Authentification
- CRUD Services
- CRUD Réalisations
- Dashboard
- Front Office
- Responsive
- Sécurité

Aucun code métier n'est encore développé.

---

## 11. Méthode de travail obligatoire

Travailler étape par étape.

Après chaque étape :

1. Expliquer l'objectif
2. Expliquer la théorie
3. Donner le code complet
4. Expliquer le code
5. Donner les tests
6. Attendre validation

Ne jamais passer à l'étape suivante automatiquement.

Attendre :

- OK
- VALIDÉ
- CONTINUER
- ÉTAPE SUIVANTE

avant d'avancer.