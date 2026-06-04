# MD Design - Phase 1.3: Features Specification (Fonctionnalités)

This document details the functional specifications for the MD Design application, divided into Front Office (public client-facing) and Back Office (administration panel).

---

## 1. Front Office Features (Public Client-Facing)

### F1.1: Dynamic Services List
* **Description:** Displays all active services offered by MD Design (outdoor signs, car wrapping, etc.).
* **Data Sources:** Retrieved dynamically from the `SERVICE` table.
* **Layout:** Grid structure with service title, short description, and dynamic image.

### F1.2: Portfolio Gallery with Category Filtering
* **Description:** A gallery showing recent realizations. Users can view all realizations or click category tabs (linked to services) to filter them dynamically.
* **Data Sources:** Retrieved from `REALISATION` joined with `SERVICE`.
* **Interaction:** Client-side JavaScript handles instant visibility filtering based on selected categories without reloading the page.

### F1.3: Dynamic WhatsApp Quote Redirection
* **Description:** Standardizes customer requests to open WhatsApp.
* **Behavior:** Clicking "Demander un devis" on a specific service page opens a WhatsApp link formatted with the company phone number (from `PARAMETRE`) and a customized message:
  * *Example:* `https://wa.me/2126XXXXXXXX?text=Bonjour,%20je%20souhaite%20obtenir%20plus%20d'informations%20concernant%20le%20service%20:%20Covering%20Automobile`
* **Widget:** A floating WhatsApp chat button fixed on the bottom right corner of the website.

### F1.4: Contact Inquiries Submission
* **Description:** A text form allowing users to submit messages.
* **Fields:** Full Name, Phone, Email, Subject, Message.
* **Validation:** 
  * Server-side PHP validations (valid email structure, required fields, secure telephone format).
  * Data stored securely in `CONTACT` table with current timestamp, set default status to `lu = 0` (unread).

### F1.5: Dynamic Testimonials Display
* **Description:** Displays past client reviews.
* **Data Sources:** Retrieved dynamically from the `TEMOIGNAGE` table.

---

## 2. Back Office Features (Admin Control Panel)

### F2.1: Secure Administrator Authentication
* **Description:** Restricted access to administrative routes.
* **Behavior:** Admins log in using an identifier and password. Password checks are performed using PHP `password_verify()` against salted hashes stored in the `ADMIN` table.
* **Security:** Active sessions check on all Back Office controllers. Unauthenticated access redirects immediately to the login page.

### F2.2: Services CRUD
* **Description:** Panel to manage MD Design services.
* **Operations:**
  * **Create:** Add new services, including title, description, and image upload.
  * **Read:** View active and inactive services in a table layout.
  * **Update:** Edit service text or replace the image file.
  * **Delete:** Remove services or toggle their active status.

### F2.3: Realizations CRUD
* **Description:** Panel to manage portfolio projects.
* **Operations:** Add new projects, write descriptions, upload images, select the category (linked via foreign key to `SERVICE`), and edit or delete existing projects.

### F2.4: Testimonials CRUD
* **Description:** Panel to manage client reviews, including client name, business role, review message, and client photo upload.

### F2.5: Message Center
* **Description:** Lists all inquiries submitted through the contact form.
* **Operations:** View message details (name, phone, email, date, content) and mark them as read (`lu = 1`).

### F2.6: Corporate Settings Management
* **Description:** A single configuration form where the admin edits company details.
* **Fields:** Phone number, WhatsApp redirect number, Email, Address, Logo image, Facebook, Instagram, Google Maps iframe URL, and Company Bio.
* **Data Source:** Updates the single row in the `PARAMETRE` table.
