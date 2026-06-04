# MD Design - Phase 1.6: Relational Database Model (MLD)

This document describes the Logical Relation Model (Modèle Logique de Données - MLD) for the MD Design application.

---

## 1. MLD Definition
The MLD translates the conceptual entities and associations of the MCD into relational database tables, columns, data types, primary keys, and foreign keys. This represents the actual schema structure as implemented in MySQL.

---

## 2. Table Layouts & Data Types

### 1. Table: `admin`
Stores system administrators.
* `id` **INT PRIMARY KEY AUTO_INCREMENT**
* `identifiant` **VARCHAR(50) NOT NULL UNIQUE**
* `mot_de_passe` **VARCHAR(255) NOT NULL** (stored using secure hashing)
* `date_creation` **DATETIME DEFAULT CURRENT_TIMESTAMP**

### 2. Table: `service`
Stores services.
* `id` **INT PRIMARY KEY AUTO_INCREMENT**
* `nom` **VARCHAR(100) NOT NULL**
* `description` **TEXT**
* `image` **VARCHAR(255)** (stores file path to image)
* `actif` **TINYINT(1) DEFAULT 1** (acts as a boolean toggle)
* `date_creation` **DATETIME DEFAULT CURRENT_TIMESTAMP**

### 3. Table: `realisation`
Stores realizations.
* `id` **INT PRIMARY KEY AUTO_INCREMENT**
* `titre` **VARCHAR(100) NOT NULL**
* `description` **TEXT**
* `image` **VARCHAR(255)** (stores file path to image)
* `date_realisation` **DATE**
* `actif` **TINYINT(1) DEFAULT 1**
* `id_service` **INT NOT NULL** (Foreign Key referencing `service.id`)

### 4. Table: `contact`
Stores client messages.
* `id` **INT PRIMARY KEY AUTO_INCREMENT**
* `nom_complet` **VARCHAR(100) NOT NULL**
* `telephone` **VARCHAR(20)**
* `email` **VARCHAR(100)**
* `sujet` **VARCHAR(150)**
* `message` **TEXT NOT NULL**
* `date_envoi` **DATETIME DEFAULT CURRENT_TIMESTAMP**
* `lu` **TINYINT(1) DEFAULT 0** (0 = unread, 1 = read)

### 5. Table: `client`
CRM table reserved for future developments.
* `id` **INT PRIMARY KEY AUTO_INCREMENT**
* `nom` **VARCHAR(100) NOT NULL**
* `telephone` **VARCHAR(20)**
* `email` **VARCHAR(100)**
* `date_creation` **DATETIME DEFAULT CURRENT_TIMESTAMP**

### 6. Table: `temoignage`
Stores client testimonials.
* `id` **INT PRIMARY KEY AUTO_INCREMENT**
* `nom_client` **VARCHAR(100) NOT NULL**
* `fonction_client` **VARCHAR(100)** (company or job title)
* `message` **TEXT NOT NULL**
* `photo` **VARCHAR(255)** (client avatar path)
* `actif` **TINYINT(1) DEFAULT 1**
* `date_creation` **DATETIME DEFAULT CURRENT_TIMESTAMP**

### 7. Table: `parametre`
Stores system configuration parameters (Single row/Singleton).
* `id` **INT PRIMARY KEY AUTO_INCREMENT**
* `nom_agence` **VARCHAR(100) DEFAULT 'MD Design'**
* `logo` **VARCHAR(255)**
* `telephone` **VARCHAR(20)**
* `whatsapp` **VARCHAR(20)**
* `email` **VARCHAR(100)**
* `adresse` **TEXT**
* `facebook` **VARCHAR(255)**
* `instagram` **VARCHAR(255)**
* `google_maps_url` **TEXT**
* `description_agence` **TEXT**

### 8. Table: `faq`
Stores FAQs.
* `id` **INT PRIMARY KEY AUTO_INCREMENT**
* `question` **VARCHAR(255) NOT NULL**
* `reponse` **TEXT NOT NULL**

### 9. Table: `statistique`
Stores stat widgets showing counters.
* `id` **INT PRIMARY KEY AUTO_INCREMENT**
* `titre` **VARCHAR(50) NOT NULL**
* `valeur` **VARCHAR(20) NOT NULL** (e.g. "120+")

---

## 3. Relational Constraints & Rules

1. **Foreign Key (FK) Integrity:**
   * Table `realisation` has a foreign key constraint:
     `FOREIGN KEY (id_service) REFERENCES service(id) ON DELETE CASCADE`
   * This constraint ensures that if a service category is deleted, all realizations associated with that service are automatically removed (`CASCADE`), preventing orphan records in the database.
   
2. **Boolean representation:**
   * MySQL does not have a native BOOLEAN type; it uses `TINYINT(1)`. A value of `0` is false (inactive/unread) and `1` is true (active/read).
