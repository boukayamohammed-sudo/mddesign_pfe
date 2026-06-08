<?php

/**
 * MD Design - Realisation Model
 * 
 * Manages CRUD operations for the portfolio items (realizations) of the agency.
 * Handles relations with Services and manages file uploads.
 */
class Realisation extends Model {
    protected string $table = 'realisation';

    /**
     * Upload directory path relative to public/
     */
    private string $uploadDir = __DIR__ . '/../../public/assets/uploads/realisations/';

    /**
     * Retrieve all realizations with their associated service name (for admin panel)
     * 
     * @return array
     */
    public function allWithService(): array {
        $sql = "SELECT r.*, s.nom as service_nom 
                FROM `{$this->table}` r 
                LEFT JOIN `service` s ON r.id_service = s.id 
                ORDER BY r.date_realisation DESC, r.id DESC";
        return $this->db->all($sql);
    }

    /**
     * Retrieve all active realizations with their associated service name (for public pages)
     * 
     * @return array
     */
    public function allActiveWithService(): array {
        $sql = "SELECT r.*, s.nom as service_nom 
                FROM `{$this->table}` r 
                LEFT JOIN `service` s ON r.id_service = s.id 
                WHERE r.actif = 1 
                ORDER BY r.date_realisation DESC, r.id DESC";
        return $this->db->all($sql);
    }

    /**
     * Retrieve active realizations filtered by service ID
     * 
     * @param int $serviceId
     * @return array
     */
    public function getByService(int $serviceId): array {
        $sql = "SELECT r.*, s.nom as service_nom 
                FROM `{$this->table}` r 
                LEFT JOIN `service` s ON r.id_service = s.id 
                WHERE r.actif = 1 AND r.id_service = :id_service
                ORDER BY r.date_realisation DESC, r.id DESC";
        return $this->db->all($sql, ['id_service' => $serviceId]);
    }

    /**
     * Count total realizations
     * 
     * @return int
     */
    public function count(): int {
        $sql = "SELECT COUNT(*) as total FROM `{$this->table}`";
        $result = $this->db->row($sql);
        return (int)($result['total'] ?? 0);
    }

    /**
     * Create a new realization record
     * 
     * @param array $data Associative array with keys: titre, description, date_realisation, actif, id_service
     * @param array|null $file The $_FILES['image'] array, if provided
     * @return bool
     */
    public function create(array $data, ?array $file = null): bool {
        $imageName = null;

        // Handle image upload if provided
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $imageName = $this->uploadImage($file);
            if (!$imageName) {
                return false;
            }
        }

        $sql = "INSERT INTO `{$this->table}` (`titre`, `description`, `image`, `date_realisation`, `actif`, `id_service`) 
                VALUES (:titre, :description, :image, :date_realisation, :actif, :id_service)";

        $this->db->query($sql, [
            'titre'            => $data['titre'],
            'description'      => $data['description'] ?? '',
            'image'            => $imageName,
            'date_realisation' => !empty($data['date_realisation']) ? $data['date_realisation'] : date('Y-m-d'),
            'actif'            => isset($data['actif']) ? (int)$data['actif'] : 1,
            'id_service'       => (int)$data['id_service'],
        ]);

        return true;
    }

    /**
     * Update an existing realization record
     * 
     * @param int $id Realisation ID
     * @param array $data Associative array with keys: titre, description, date_realisation, actif, id_service
     * @param array|null $file The $_FILES['image'] array, if provided
     * @return bool
     */
    public function update(int $id, array $data, ?array $file = null): bool {
        $existing = $this->find($id);
        if (!$existing) {
            return false;
        }

        $imageName = $existing['image']; // Keep current image by default

        // Handle new image upload
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $newImage = $this->uploadImage($file);
            if ($newImage) {
                // Delete old image if it exists
                $this->deleteImage($existing['image']);
                $imageName = $newImage;
            }
        }

        $sql = "UPDATE `{$this->table}` 
                SET `titre` = :titre, `description` = :description, `image` = :image, 
                    `date_realisation` = :date_realisation, `actif` = :actif, `id_service` = :id_service 
                WHERE `id` = :id";

        $this->db->query($sql, [
            'id'               => $id,
            'titre'            => $data['titre'],
            'description'      => $data['description'] ?? '',
            'image'            => $imageName,
            'date_realisation' => !empty($data['date_realisation']) ? $data['date_realisation'] : date('Y-m-d'),
            'actif'            => isset($data['actif']) ? (int)$data['actif'] : 1,
            'id_service'       => (int)$data['id_service'],
        ]);

        return true;
    }

    /**
     * Delete a realization by ID and remove its image file
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $existing = $this->find($id);
        if (!$existing) {
            return false;
        }

        // Delete the associated image file
        $this->deleteImage($existing['image']);

        $sql = "DELETE FROM `{$this->table}` WHERE `id` = :id";
        $this->db->query($sql, ['id' => $id]);

        return true;
    }

    /**
     * Toggle the active status of a realization
     * 
     * @param int $id
     * @return bool
     */
    public function toggleActive(int $id): bool {
        $existing = $this->find($id);
        if (!$existing) {
            return false;
        }

        $newStatus = $existing['actif'] ? 0 : 1;
        $sql = "UPDATE `{$this->table}` SET `actif` = :actif WHERE `id` = :id";
        $this->db->query($sql, ['actif' => $newStatus, 'id' => $id]);

        return true;
    }

    /**
     * Upload an image file to the realizations upload directory
     * 
     * @param array $file The $_FILES entry
     * @return string|null The generated filename, or null on failure
     */
    private function uploadImage(array $file): ?string {
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            return null;
        }

        // Validate file size (max 5MB)
        $maxSize = 5 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            return null;
        }

        // Create upload directory if it doesn't exist
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }

        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'realisation_' . uniqid() . '.' . strtolower($extension);

        // Move uploaded file
        $destination = $this->uploadDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $filename;
        }

        return null;
    }

    /**
     * Delete an image file from the upload directory
     * 
     * @param string|null $filename
     * @return void
     */
    private function deleteImage(?string $filename): void {
        if ($filename) {
            $filepath = $this->uploadDir . $filename;
            if (file_exists($filepath)) {
                unlink($filepath);
            }
        }
    }
}
