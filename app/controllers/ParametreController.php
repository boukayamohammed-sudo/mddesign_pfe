<?php

/**
 * MD Design - ParametreController
 * 
 * Handles back-office display and update of global agency settings.
 */
class ParametreController extends Controller {

    private Parametre $parametreModel;

    public function __construct() {
        $this->parametreModel = new Parametre();
    }

    /**
     * Show parameters form
     */
    public function index(): void {
        check_admin();

        $settings = $this->parametreModel->get();
        
        $this->view('admin/parametres/index', [
            'title'    => 'Paramètres de l\'Agence',
            'settings' => $settings,
            'errors'   => [],
        ]);
    }

    /**
     * Handle updating parameters via POST
     */
    public function update(): void {
        check_admin();

        $errors = [];
        $settings = $this->parametreModel->get();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom_agence'         => trim($_POST['nom_agence'] ?? ''),
                'telephone'          => trim($_POST['telephone'] ?? ''),
                'whatsapp'           => trim($_POST['whatsapp'] ?? ''),
                'email'              => trim($_POST['email'] ?? ''),
                'adresse'            => trim($_POST['adresse'] ?? ''),
                'facebook'           => trim($_POST['facebook'] ?? ''),
                'instagram'          => trim($_POST['instagram'] ?? ''),
                'google_maps_url'    => trim($_POST['google_maps_url'] ?? ''),
                'description_agence' => trim($_POST['description_agence'] ?? ''),
            ];

            // Validation
            if (empty($data['nom_agence'])) {
                $errors[] = 'Le nom de l\'agence est obligatoire.';
            } elseif (mb_strlen($data['nom_agence']) > 100) {
                $errors[] = 'Le nom de l\'agence ne doit pas dépasser 100 caractères.';
            }

            if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'adresse email saisie n\'est pas valide.';
            }

            if (!empty($data['telephone']) && mb_strlen($data['telephone']) > 20) {
                $errors[] = 'Le numéro de téléphone ne doit pas dépasser 20 caractères.';
            }

            if (!empty($data['whatsapp']) && mb_strlen($data['whatsapp']) > 20) {
                $errors[] = 'Le numéro WhatsApp ne doit pas dépasser 20 caractères.';
            }

            if (!empty($data['facebook']) && !filter_var($data['facebook'], FILTER_VALIDATE_URL)) {
                $errors[] = 'Le lien Facebook doit être une URL valide.';
            }

            if (!empty($data['instagram']) && !filter_var($data['instagram'], FILTER_VALIDATE_URL)) {
                $errors[] = 'Le lien Instagram doit être une URL valide.';
            }

            // Image logo validation
            $file = $_FILES['logo'] ?? null;
            if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    $errors[] = 'Erreur lors de l\'upload du logo.';
                } elseif (!in_array($file['type'], $allowedTypes)) {
                    $errors[] = 'Format de logo non autorisé. Formats acceptés : JPG, PNG, WebP, GIF.';
                } elseif ($file['size'] > 5 * 1024 * 1024) {
                    $errors[] = 'Le logo ne doit pas dépasser 5 Mo.';
                }
            }

            if (empty($errors)) {
                $logoFile = ($file && $file['error'] === UPLOAD_ERR_OK) ? $file : null;
                if ($this->parametreModel->updateSettings($data, $logoFile)) {
                    $session = new Session();
                    $session->set('flash_success', 'Paramètres mis à jour avec succès.');
                    $this->redirect('admin/parametres');
                    return;
                } else {
                    $errors[] = 'Erreur lors de la mise à jour des paramètres.';
                }
            }

            // In case of validation errors, keep values in the form
            $settings = array_merge($settings ?: [], $data);
        }

        $this->view('admin/parametres/index', [
            'title'    => 'Paramètres de l\'Agence',
            'settings' => $settings,
            'errors'   => $errors,
        ]);
    }
}
