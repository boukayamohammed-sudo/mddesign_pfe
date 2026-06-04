# MD Design - Phase 1.4: Pages & Navigation Structure (Pages)

This document maps out the user interface page structure, detailing the layout sections and navigation paths for both the public site (Front Office) and the admin dashboard (Back Office).

---

## 1. Front Office Pages (Public Website)

All public pages share a common layout structure:
* **Header/Navbar:** Contains the logo (dynamic), main navigation links (Accueil, Services, Réalisations, À Propos, Contact), and call-to-action buttons.
* **Footer:** Contains company details, business hours, social media links (dynamic from parameters), and copyright block.
* **Floating CTA:** Bottom-right floating WhatsApp button.

### Page 1.1: Home (Accueil)
* **URL Routing:** `/` or `/home`
* **Sections:**
  1. **Hero Banner:** Premium image slider, high-impact heading ("Votre Image, Notre Métier"), and CTA button to services.
  2. **Agency Bio:** Brief intro of MD Design Tangier.
  3. **Popular Services Grid:** Showcases 3 main services with "Savoir Plus" links.
  4. **Recent Projects Showcase:** Grid showing the latest 4 realizations.
  5. **Stats Counters:** Animated metrics (e.g. "10+ Years Experience", "500+ Projects Completed").
  6. **Testimonials Grid/Slider:** Dynamic list of approved client reviews.

### Page 1.2: Services List & Details (Services)
* **URL Routing:** `/services` or `/services/detail?id=X`
* **Sections:**
  1. **Services Directory:** Listing of all active services with descriptions.
  2. **Service Details:** Interactive sub-page displaying detailed text, dynamic photo, and a large Orange CTA button: "Demander un devis par WhatsApp".

### Page 1.3: Portfolio Gallery (Réalisations)
* **URL Routing:** `/realisations`
* **Sections:**
  1. **Category Navigation Menu:** Tabs showing "Tous" and individual service names (e.g., Covering, Enseignes).
  2. **Portfolio Grid:** Interactive grid showing project images, titles, and service categories. Handled via client-side filters (JavaScript).

### Page 1.4: Contact (Contact)
* **URL Routing:** `/contact`
* **Sections:**
  1. **Inquiry Form:** Inputs for full name, email, phone, subject, and message text.
  2. **Coordinates Box:** Phone number, WhatsApp connection, physical address, and social links.
  3. **Interactive Map:** Embedded Google Maps iframe centered on Tangier.

### Page 1.5: About (À Propos)
* **URL Routing:** `/about`
* **Sections:**
  1. **Our Story:** The history and values of MD Design.
  2. **Quality Guarantee:** Why clients in Tangier choose MD Design (high quality wrapping, professional signage).

---

## 2. Back Office Pages (Admin Dashboard)

All admin pages share a layout:
* **Admin Header:** Displaying logged user and "Voir le Site" quick link.
* **Admin Sidebar:** Navigation links (Tableau de bord, Services, Réalisations, Témoignages, Messages, Paramètres, Déconnexion).

### Page 2.1: Login (Connexion)
* **URL Routing:** `/login`
* **Layout:** Clean centered card, inputs for login credentials (Username & Password), and PHP validation error warnings.

### Page 2.2: Admin Dashboard Overview (Tableau de Bord)
* **URL Routing:** `/admin/dashboard`
* **Sections:**
  1. **Statistic Cards:** Total services count, total realizations, total testimonials, and count of unread messages.
  2. **Quick Actions Panel:** Buttons to add a project, toggle service status, or edit configuration.

### Page 2.3: Services Management (Gestion des Services)
* **URL Routing:** `/admin/services`
* **Views:**
  * **Index:** Table listing all services (image, name, status indicator, action buttons: Edit, Delete, Toggle Active).
  * **Create/Edit Form:** Input fields for Name, Description, Active checkbox, and image file upload browser.

### Page 2.4: Realizations Management (Gestion des Réalisations)
* **URL Routing:** `/admin/realisations`
* **Views:**
  * **Index:** Table list of projects showing thumbnail image, project title, category name (joined with services), and actions (Edit, Delete).
  * **Create/Edit Form:** Title input, Description, Category selector (drop-down loaded dynamically from `SERVICE`), and image upload.

### Page 2.5: Testimonials Management (Gestion des Témoignages)
* **URL Routing:** `/admin/temoignages`
* **Views:**
  * **Index:** List of reviews showing client name, role, review excerpt, and actions.
  * **Create/Edit Form:** Name, Business Role, Testimonial Text, and optional client photo upload.

### Page 2.6: Message Center (Messages Reçus)
* **URL Routing:** `/admin/messages`
* **Views:**
  * **Index:** List of inquiries with unread messages highlighted. Showing sender, date, subject.
  * **Detail View:** Modal or panel reading full message, sender phone/email links, and a button to mark as read.

### Page 2.7: Corporate Settings Panel (Paramètres)
* **URL Routing:** `/admin/parametres`
* **Layout:** Tabbed configurations form containing fields to update company logo, phone, WhatsApp number, email, address coordinates, Maps URL, social handles, and site SEO description.
