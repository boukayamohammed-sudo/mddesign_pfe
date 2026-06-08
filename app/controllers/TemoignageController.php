<?php

/**
 * MD Design - TemoignageController
 * 
 * Handles back-office CRUD management for client testimonials.
 */
class TemoignageController extends Controller {

    private Temoignage $temoignageModel;

    public function __construct() {
        $this->temoignageModel = new Temoignage();
    }

    // =========================================================================
    // BACK-OFFICE (ADMIN) ACTIONS
    // =========================================================================

    /**
     * Admin: List all testimonials
     */
    public function adminIndex(): void {
        check_admin();

        $temoignages = $this->temoignageModel->all();
        $this->view('admin/temoignages/index', [
            'title'       => 'Gestion des Témoignages',
            'temoignages' => $temoignages,
        ]);
    }

    /**
     * Admin: Show create testimonial form & handle POST submission
     */
    public function create(): void {
        check_admin();

        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = [
                'nom_client'      => trim($_POST['nom_client'] ?? ''),
                'fonction_client' => trim($_POST['fonction_client'] ?? ''),
                'message'         => trim($_POST['message'] ?? ''),
                'actif'           => isset($_POST['actif']) ? 1 : 0,
            ];

            // Validation checks
            if (empty($old['nom_client'])) {
                $errors[] = 'Le nom du client est obligatoire.';
            } elseif (mb_strlen($old['nom_client']) > 100) {
                $errors[] = 'Le nom du client ne doit pas dépasser 100 caractères.';
            }

            if (empty($old['message'])) {
                $errors[] = 'Le message du témoignage est obligatoire.';
            }

            if (!empty($old['fonction_client']) && mb_strlen($old['fonction_client']) > 100) {
                $errors[] = 'La fonction/entreprise ne doit pas dépasser 100 caractères.';
            }

            // Client photo upload validation (optional)
            $file = $_FILES['photo'] ?? null;
            if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    $errors[] = 'Erreur lors de l\'upload de la photo.';
                } elseif (!in_array($file['type'], $allowedTypes)) {
                    $errors[] = 'Format d\'image non autorisé. Formats acceptés : JPG, PNG, WebP, GIF.';
                } elseif ($file['size'] > 2 * 1024 * 1024) {
                    $errors[] = 'La photo ne doit pas dépasser 2 Mo.';
                }
            }

            if (empty($errors)) {
                $photoFile = ($file && $file['error'] === UPLOAD_ERR_OK) ? $file : null;
                if ($this->temoignageModel->create($old, $photoFile)) {
                    $session = new Session();
                    $session->set('flash_success', 'Témoignage ajouté avec succès.');
                    $this->redirect('admin/temoignages');
                    return;
                } else {
                    $errors[] = 'Erreur lors de la création du témoignage.';
                }
            }
        }

        $this->view('admin/temoignages/create', [
            'title'  => 'Ajouter un Témoignage',
            'errors' => $errors,
            'old'    => $old,
        ]);
    }

    /**
     * Admin: Show edit testimonial form & handle POST submission
     */
    public function edit(string $id): void {
        check_admin();

        $temoignage = $this->temoignageModel->find((int)$id);
        if (!$temoignage) {
            $this->redirect('admin/temoignages');
            return;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom_client'      => trim($_POST['nom_client'] ?? ''),
                'fonction_client' => trim($_POST['fonction_client'] ?? ''),
                'message'         => trim($_POST['message'] ?? ''),
                'actif'           => isset($_POST['actif']) ? 1 : 0,
            ];

            // Validation checks
            if (empty($data['nom_client'])) {
                $errors[] = 'Le nom du client est obligatoire.';
            } elseif (mb_strlen($data['nom_client']) > 100) {
                $errors[] = 'Le nom du client ne doit pas dépasser 100 caractères.';
            }

            if (empty($data['message'])) {
                $errors[] = 'Le message du témoignage est obligatoire.';
            }

            if (!empty($data['fonction_client']) && mb_strlen($data['fonction_client']) > 100) {
                $errors[] = 'La fonction/entreprise ne doit pas dépasser 100 caractères.';
            }

            // Client photo upload validation (optional)
            $file = $_FILES['photo'] ?? null;
            if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    $errors[] = 'Erreur lors de l\'upload de la photo.';
                } elseif (!in_array($file['type'], $allowedTypes)) {
                    $errors[] = 'Format d\'image non autorisé. Formats acceptés : JPG, PNG, WebP, GIF.';
                } elseif ($file['size'] > 2 * 1024 * 1024) {
                    $errors[] = 'La photo ne doit pas dépasser 2 Mo.';
                }
            }

            if (empty($errors)) {
                $photoFile = ($file && $file['error'] === UPLOAD_ERR_OK) ? $file : null;
                if ($this->temoignageModel->update((int)$id, $data, $photoFile)) {
                    $session = new Session();
                    $session->set('flash_success', 'Témoignage modifié avec succès.');
                    $this->redirect('admin/temoignages');
                    return;
                } else {
                    $errors[] = 'Erreur lors de la modification du témoignage.';
                }
            }

            // Keep submitted data on validation error
            $temoignage = array_merge($temoignage, $data);
        }

        $this->view('admin/temoignages/edit', [
            'title'      => 'Modifier le Témoignage',
            'temoignage' => $temoignage,
            'errors'     => $errors,
        ]);
    }

    /**
     * Admin: Delete a testimonial
     */
    public function delete(string $id): void {
        check_admin();

        $session = new Session();

        if ($this->temoignageModel->delete((int)$id)) {
            $session->set('flash_success', 'Témoignage supprimé avec succès.');
        } else {
            $session->set('flash_error', 'Erreur lors de la suppression du témoignage.');
        }

        $this->redirect('admin/temoignages');
    }

    /**
     * Admin: Toggle active status
     */
    public function toggleActive(string $id): void {
        check_admin();

        $session = new Session();

        if ($this->temoignageModel->toggleActive((int)$id)) {
            $session->set('flash_success', 'Statut du témoignage mis à jour.');
        } else {
            $session->set('flash_error', 'Erreur lors de la mise à jour du statut.');
        }

        $this->redirect('admin/temoignages');
    }
}
