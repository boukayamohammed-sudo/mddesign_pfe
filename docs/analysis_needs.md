# MD Design - Phase 1.1: Needs Analysis (Analyse des Besoins)

## 1. Business Context
**MD Design** is a professional advertising and signage agency located in Tangier, Morocco. The agency specializes in high-quality outdoor advertising, vehicle wraps, and custom signs. To scale their business and improve customer reach, they need a modern web presence that showcases their premium craftsmanship and makes it easy for potential clients to get in touch.

### Services Offered:
* **Enseignes publicitaires** (Advertising signs)
* **Habillage véhicules** (Vehicle wrapping / branding)
* **Covering automobile** (Car wrapping / detailing)
* **Film solaire automobile** (Car solar/tinted films)
* **Impression numérique** (Digital printing)
* **Signalétique** (Directional and safety signage)
* **Lettres en relief** (3D relief lettering)

---

## 2. Problem Statement
Currently, MD Design has no centralized digital platform. Potential clients cannot view past realizations, browse services, or contact the team easily online. 
To address this, we need a web application split into two parts:
1. **Front Office (Public Website):** A sleek, responsive, premium site displaying services, high-quality realizations, client testimonials, and simple contact gateways.
2. **Back Office (Admin Dashboard):** An easy-to-use control panel allowing the MD Design administration team to update their portfolio, manage service listings, edit contact details, read client messages, and configure basic parameters without editing code.

---

## 3. Requirements Classification

### A. Functional Requirements (Besoins Fonctionnels)
* **FR-1: Service Showcasing:** Display details for each service.
* **FR-2: Dynamic Portfolio (Realizations):** A gallery of past work filterable by service type.
* **FR-3: Quick WhatsApp Redirection:** A floating contact widget and service-specific quote buttons that open WhatsApp with a pre-templated text naming the selected service.
* **FR-4: Contact Form:** Allow users to submit detailed inquiries that are validated and saved in the database.
* **FR-5: Admin Authentication:** Secure login system restricting access to the dashboard.
* **FR-6: Content Management (CRUD):** Complete control (Create, Read, Update, Delete) over services, realizations, and testimonials, including image file uploading.
* **FR-7: Settings Panel:** Centralized location to update corporate info (phone, social media links, address) dynamic throughout the site.

### B. Non-Functional Requirements (Besoins Non-Fonctionnels)
* **NFR-1: Performance:** Fast loading times on images (utilizing optimized uploads).
* **NFR-2: Security:** Shielded against SQL injection (via PDO), Cross-Site Scripting (XSS prevention), and secure session management.
* **NFR-3: Responsiveness:** Mobile-first layout tailored to mobile phones, tablets, and desktops.
* **NFR-4: Maintenance & Extensibility:** Structured around clean MVC architecture to support future expansions (like the Client database extension).
