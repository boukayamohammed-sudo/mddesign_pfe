<?php

/**
 * MD Design - ServiceController
 * 
 * Handles front-office display of services and back-office CRUD management.
 */
class ServiceController extends Controller {

    private Service $serviceModel;

    public function __construct() {
        $this->serviceModel = new Service();
    }

    // =========================================================================
    // FRONT-OFFICE ACTIONS
    // =========================================================================

    /**
     * Display all active services on the public page
     */
    public function index(): void {
        $services = $this->serviceModel->allActive();
        $this->view('services/index', [
            'title'    => 'Nos Services',
            'services' => $services,
        ]);
    }

    /**
     * Display a single service detail
     */
    public function detail(string $id): void {
        $service = $this->serviceModel->find((int)$id);

        if (!$service || !$service['actif']) {
            $this->redirect('services');
            return;
        }

        $this->view('services/detail', [
            'title'   => $service['nom'],
            'service' => $service,
        ]);
    }

    // =========================================================================
    // BACK-OFFICE (ADMIN) ACTIONS
    // =========================================================================

    /**
     * Admin: List all services
     */
    public function adminIndex(): void {
        check_admin();

        $services = $this->serviceModel->all();
        $this->view('admin/services/index', [
            'title'    => 'Gestion des Services',
            'services' => $services,
        ]);
    }

    /**
     * Admin: Show create service form & handle POST submission
     */
    public function create(): void {
        check_admin();

        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = [
                'nom'         => trim($_POST['nom'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'actif'       => isset($_POST['actif']) ? 1 : 0,
            ];

            // Validation
            if (empty($old['nom'])) {
                $errors[] = 'Le nom du service est obligatoire.';
            }
            if (mb_strlen($old['nom']) > 100) {
                $errors[] = 'Le nom ne doit pas dépasser 100 caractères.';
            }

            // Image validation (optional but if provided, must be valid)
            $file = $_FILES['image'] ?? null;
            if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    $errors[] = 'Erreur lors de l\'upload de l\'image.';
                } elseif (!in_array($file['type'], $allowedTypes)) {
                    $errors[] = 'Format d\'image non autorisé. Formats acceptés : JPG, PNG, WebP, GIF.';
                } elseif ($file['size'] > 5 * 1024 * 1024) {
                    $errors[] = 'L\'image ne doit pas dépasser 5 Mo.';
                }
            }

            if (empty($errors)) {
                $imageFile = ($file && $file['error'] === UPLOAD_ERR_OK) ? $file : null;
                if ($this->serviceModel->create($old, $imageFile)) {
                    $session = new Session();
                    $session->set('flash_success', 'Service créé avec succès.');
                    $this->redirect('admin/services');
                    return;
                } else {
                    $errors[] = 'Erreur lors de la création du service.';
                }
            }
        }

        $this->view('admin/services/create', [
            'title'  => 'Ajouter un Service',
            'errors' => $errors,
            'old'    => $old,
        ]);
    }

    /**
     * Admin: Show edit service form & handle POST submission
     */
    public function edit(string $id): void {
        check_admin();

        $service = $this->serviceModel->find((int)$id);
        if (!$service) {
            $this->redirect('admin/services');
            return;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'         => trim($_POST['nom'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'actif'       => isset($_POST['actif']) ? 1 : 0,
            ];

            // Validation
            if (empty($data['nom'])) {
                $errors[] = 'Le nom du service est obligatoire.';
            }
            if (mb_strlen($data['nom']) > 100) {
                $errors[] = 'Le nom ne doit pas dépasser 100 caractères.';
            }

            // Image validation
            $file = $_FILES['image'] ?? null;
            if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    $errors[] = 'Erreur lors de l\'upload de l\'image.';
                } elseif (!in_array($file['type'], $allowedTypes)) {
                    $errors[] = 'Format d\'image non autorisé. Formats acceptés : JPG, PNG, WebP, GIF.';
                } elseif ($file['size'] > 5 * 1024 * 1024) {
                    $errors[] = 'L\'image ne doit pas dépasser 5 Mo.';
                }
            }

            if (empty($errors)) {
                $imageFile = ($file && $file['error'] === UPLOAD_ERR_OK) ? $file : null;
                if ($this->serviceModel->update((int)$id, $data, $imageFile)) {
                    $session = new Session();
                    $session->set('flash_success', 'Service modifié avec succès.');
                    $this->redirect('admin/services');
                    return;
                } else {
                    $errors[] = 'Erreur lors de la modification du service.';
                }
            }

            // Keep submitted data on validation error
            $service = array_merge($service, $data);
        }

        $this->view('admin/services/edit', [
            'title'   => 'Modifier le Service',
            'service' => $service,
            'errors'  => $errors,
        ]);
    }

    /**
     * Admin: Delete a service
     */
    public function deleteService(string $id): void {
        check_admin();

        $session = new Session();

        if ($this->serviceModel->delete((int)$id)) {
            $session->set('flash_success', 'Service supprimé avec succès.');
        } else {
            $session->set('flash_error', 'Erreur lors de la suppression du service.');
        }

        $this->redirect('admin/services');
    }

    /**
     * Admin: Toggle active status
     */
    public function toggleActive(string $id): void {
        check_admin();

        $session = new Session();

        if ($this->serviceModel->toggleActive((int)$id)) {
            $session->set('flash_success', 'Statut du service mis à jour.');
        } else {
            $session->set('flash_error', 'Erreur lors de la mise à jour du statut.');
        }

        $this->redirect('admin/services');
    }
}
