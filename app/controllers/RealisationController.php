<?php

/**
 * MD Design - RealisationController
 * 
 * Handles front-office display of realizations (portfolio) and back-office CRUD management.
 */
class RealisationController extends Controller {

    private Realisation $realisationModel;
    private Service $serviceModel;

    public function __construct() {
        $this->realisationModel = new Realisation();
        $this->serviceModel = new Service();
    }

    // =========================================================================
    // FRONT-OFFICE ACTIONS
    // =========================================================================

    /**
     * Display portfolio page with realizations. Supports filtering by service.
     */
    public function index(): void {
        $services = $this->serviceModel->allActive();
        
        // Check if filtering by service
        $selectedServiceId = isset($_GET['service']) ? (int)$_GET['service'] : 0;
        
        if ($selectedServiceId > 0) {
            $realisations = $this->realisationModel->getByService($selectedServiceId);
        } else {
            $realisations = $this->realisationModel->allActiveWithService();
        }

        $this->view('realisations/index', [
            'title'             => 'Nos Réalisations',
            'services'          => $services,
            'realisations'      => $realisations,
            'selectedServiceId' => $selectedServiceId
        ]);
    }

    // =========================================================================
    // BACK-OFFICE (ADMIN) ACTIONS
    // =========================================================================

    /**
     * Admin: List all realizations
     */
    public function adminIndex(): void {
        check_admin();

        $realisations = $this->realisationModel->allWithService();
        $this->view('admin/realisations/index', [
            'title'        => 'Gestion des Réalisations',
            'realisations' => $realisations,
        ]);
    }

    /**
     * Admin: Create realization record
     */
    public function create(): void {
        check_admin();

        $services = $this->serviceModel->all();
        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = [
                'titre'            => trim($_POST['titre'] ?? ''),
                'description'      => trim($_POST['description'] ?? ''),
                'date_realisation' => trim($_POST['date_realisation'] ?? ''),
                'id_service'       => isset($_POST['id_service']) ? (int)$_POST['id_service'] : 0,
                'actif'            => isset($_POST['actif']) ? 1 : 0,
            ];

            // Validation
            if (empty($old['titre'])) {
                $errors[] = 'Le titre de la réalisation est obligatoire.';
            }
            if (mb_strlen($old['titre']) > 100) {
                $errors[] = 'Le titre ne doit pas dépasser 100 caractères.';
            }
            if ($old['id_service'] <= 0) {
                $errors[] = 'Veuillez sélectionner un service associé.';
            }

            // Image validation (required on creation)
            $file = $_FILES['image'] ?? null;
            if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
                $errors[] = 'L\'image de la réalisation est obligatoire.';
            } else {
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
                if ($this->realisationModel->create($old, $file)) {
                    $session = new Session();
                    $session->set('flash_success', 'Réalisation ajoutée avec succès.');
                    $this->redirect('admin/realisations');
                    return;
                } else {
                    $errors[] = 'Erreur lors de la création de la réalisation.';
                }
            }
        }

        $this->view('admin/realisations/create', [
            'title'    => 'Ajouter une Réalisation',
            'services' => $services,
            'errors'   => $errors,
            'old'      => $old,
        ]);
    }

    /**
     * Admin: Edit realization record
     */
    public function edit(string $id): void {
        check_admin();

        $realisation = $this->realisationModel->find((int)$id);
        if (!$realisation) {
            $this->redirect('admin/realisations');
            return;
        }

        $services = $this->serviceModel->all();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titre'            => trim($_POST['titre'] ?? ''),
                'description'      => trim($_POST['description'] ?? ''),
                'date_realisation' => trim($_POST['date_realisation'] ?? ''),
                'id_service'       => isset($_POST['id_service']) ? (int)$_POST['id_service'] : 0,
                'actif'            => isset($_POST['actif']) ? 1 : 0,
            ];

            // Validation
            if (empty($data['titre'])) {
                $errors[] = 'Le titre de la réalisation est obligatoire.';
            }
            if (mb_strlen($data['titre']) > 100) {
                $errors[] = 'Le titre ne doit pas dépasser 100 caractères.';
            }
            if ($data['id_service'] <= 0) {
                $errors[] = 'Veuillez sélectionner un service associé.';
            }

            // Image validation (optional on edit)
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
                if ($this->realisationModel->update((int)$id, $data, $imageFile)) {
                    $session = new Session();
                    $session->set('flash_success', 'Réalisation modifiée avec succès.');
                    $this->redirect('admin/realisations');
                    return;
                } else {
                    $errors[] = 'Erreur lors de la modification de la réalisation.';
                }
            }

            // Keep submitted data on validation error
            $realisation = array_merge($realisation, $data);
        }

        $this->view('admin/realisations/edit', [
            'title'       => 'Modifier la Réalisation',
            'realisation' => $realisation,
            'services'    => $services,
            'errors'      => $errors,
        ]);
    }

    /**
     * Admin: Delete realization record
     */
    public function deleteRealisation(string $id): void {
        check_admin();

        $session = new Session();

        if ($this->realisationModel->delete((int)$id)) {
            $session->set('flash_success', 'Réalisation supprimée avec succès.');
        } else {
            $session->set('flash_error', 'Erreur lors de la suppression du projet.');
        }

        $this->redirect('admin/realisations');
    }

    /**
     * Admin: Toggle active status
     */
    public function toggleActive(string $id): void {
        check_admin();

        $session = new Session();

        if ($this->realisationModel->toggleActive((int)$id)) {
            $session->set('flash_success', 'Statut de la réalisation mis à jour.');
        } else {
            $session->set('flash_error', 'Erreur lors de la mise à jour du statut.');
        }

        $this->redirect('admin/realisations');
    }
}
