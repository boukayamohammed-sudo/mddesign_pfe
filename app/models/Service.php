<?php

/**
 * MD Design - Service Model
 * 
 * Manages CRUD operations for the services offered by the agency.
 * Handles image upload, update, and cleanup on deletion.
 */
class Service extends Model {
    protected string $table = 'service';

    /**
     * Upload directory path relative to public/
     */
    private string $uploadDir = __DIR__ . '/../../public/assets/uploads/services/';

    /**
     * Retrieve all active services (for front-office display)
     * 
     * @return array
     */
    public function allActive(): array {
        $sql = "SELECT * FROM `{$this->table}` WHERE `actif` = 1 ORDER BY `date_creation` DESC";
        return $this->db->all($sql);
    }

    /**
     * Retrieve all services ordered by date (for admin panel)
     * 
     * @return array
     */
    public function all(): array {
        $sql = "SELECT * FROM `{$this->table}` ORDER BY `date_creation` DESC";
        return $this->db->all($sql);
    }

    /**
     * Count total services
     * 
     * @return int
     */
    public function count(): int {
        $sql = "SELECT COUNT(*) as total FROM `{$this->table}`";
        $result = $this->db->row($sql);
        return (int)($result['total'] ?? 0);
    }

    /**
     * Count active services
     * 
     * @return int
     */
    public function countActive(): int {
        $sql = "SELECT COUNT(*) as total FROM `{$this->table}` WHERE `actif` = 1";
        $result = $this->db->row($sql);
        return (int)($result['total'] ?? 0);
    }

    /**
     * Create a new service record
     * 
     * @param array $data Associative array with keys: nom, description, actif
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

        $sql = "INSERT INTO `{$this->table}` (`nom`, `description`, `image`, `actif`) 
                VALUES (:nom, :description, :image, :actif)";

        $this->db->query($sql, [
            'nom'         => $data['nom'],
            'description' => $data['description'] ?? '',
            'image'       => $imageName,
            'actif'       => isset($data['actif']) ? (int)$data['actif'] : 1,
        ]);

        return true;
    }

    /**
     * Update an existing service record
     * 
     * @param int $id Service ID
     * @param array $data Associative array with keys: nom, description, actif
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
                SET `nom` = :nom, `description` = :description, `image` = :image, `actif` = :actif 
                WHERE `id` = :id";

        $this->db->query($sql, [
            'id'          => $id,
            'nom'         => $data['nom'],
            'description' => $data['description'] ?? '',
            'image'       => $imageName,
            'actif'       => isset($data['actif']) ? (int)$data['actif'] : 1,
        ]);

        return true;
    }

    /**
     * Delete a service by ID and remove its image file
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
     * Toggle the active status of a service
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
     * Upload an image file to the services upload directory
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
        $filename = 'service_' . uniqid() . '.' . strtolower($extension);

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
