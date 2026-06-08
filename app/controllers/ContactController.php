<?php

/**
 * MD Design - ContactController
 * 
 * Handles public contact form submissions and back-office message review.
 */
class ContactController extends Controller {

    private Contact $contactModel;
    private Parametre $parametreModel;

    public function __construct() {
        $this->contactModel = new Contact();
        // Load the Parametre model to fetch corporate details (phone, email, maps, address)
        $this->parametreModel = new Parametre();
    }

    // =========================================================================
    // FRONT-OFFICE ACTIONS
    // =========================================================================

    /**
     * Display the contact form page
     */
    public function index(): void {
        // Fetch corporate info dynamically from settings (parametre table)
        $corporateInfo = settings();

        $this->view('contact/index', [
            'title'         => 'Contactez-nous',
            'corporateInfo' => $corporateInfo,
            'errors'        => [],
            'old'           => [],
        ]);
    }

    /**
     * Process contact form submission
     */
    public function submit(): void {
        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = [
                'nom_complet' => trim($_POST['nom_complet'] ?? ''),
                'telephone'   => trim($_POST['telephone'] ?? ''),
                'email'       => trim($_POST['email'] ?? ''),
                'sujet'       => trim($_POST['sujet'] ?? ''),
                'message'     => trim($_POST['message'] ?? ''),
            ];

            // 1. Validation Checks
            if (empty($old['nom_complet'])) {
                $errors[] = 'Le nom complet est obligatoire.';
            } elseif (mb_strlen($old['nom_complet']) > 100) {
                $errors[] = 'Le nom ne doit pas dépasser 100 caractères.';
            }

            if (empty($old['email'])) {
                $errors[] = 'L\'adresse email est obligatoire.';
            } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'adresse email saisie est invalide.';
            }

            if (empty($old['sujet'])) {
                $errors[] = 'Le sujet du message est obligatoire.';
            } elseif (mb_strlen($old['sujet']) > 150) {
                $errors[] = 'Le sujet ne doit pas dépasser 150 caractères.';
            }

            if (empty($old['message'])) {
                $errors[] = 'Le message est obligatoire.';
            }

            // Phone validation (optional but length check if provided)
            if (!empty($old['telephone']) && mb_strlen($old['telephone']) > 20) {
                $errors[] = 'Le numéro de téléphone ne doit pas dépasser 20 caractères.';
            }

            // 2. If validation passes, create contact record
            if (empty($errors)) {
                if ($this->contactModel->create($old)) {
                    $session = new Session();
                    $session->set('flash_success', 'Votre message a été envoyé avec succès. Notre équipe vous répondra très prochainement.');
                    $this->redirect('contact');
                    return;
                } else {
                    $errors[] = 'Erreur serveur lors de l\'envoi du message. Veuillez réessayer plus tard.';
                }
            }
        }

        // If there are validation errors, render the index page with errors and old input data
        $corporateInfo = settings();
        $this->view('contact/index', [
            'title'         => 'Contactez-nous',
            'corporateInfo' => $corporateInfo,
            'errors'        => $errors,
            'old'           => $old,
        ]);
    }

    // =========================================================================
    // BACK-OFFICE (ADMIN) ACTIONS
    // =========================================================================

    /**
     * Admin: List all contact messages
     */
    public function adminIndex(): void {
        check_admin();

        $messages = $this->contactModel->all();
        $this->view('admin/messages/index', [
            'title'    => 'Boîte de Réception',
            'messages' => $messages,
        ]);
    }

    /**
     * Admin: Mark a message as read
     */
    public function markAsRead(string $id): void {
        check_admin();

        $session = new Session();
        if ($this->contactModel->markAsRead((int)$id)) {
            $session->set('flash_success', 'Message marqué comme lu.');
        } else {
            $session->set('flash_error', 'Impossible de mettre à jour le statut du message.');
        }

        $this->redirect('admin/messages');
    }

    /**
     * Admin: Delete a contact message
     */
    public function deleteMessage(string $id): void {
        check_admin();

        $session = new Session();
        if ($this->contactModel->delete((int)$id)) {
            $session->set('flash_success', 'Message supprimé avec succès.');
        } else {
            $session->set('flash_error', 'Impossible de supprimer le message.');
        }

        $this->redirect('admin/messages');
    }
}
