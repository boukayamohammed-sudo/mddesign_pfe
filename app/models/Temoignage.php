<?php

/**
 * MD Design - Temoignage Model
 * 
 * Manages CRUD operations for client testimonials/feedback.
 * Handles client photo uploads and cleanups on deletion.
 */
class Temoignage extends Model {
    protected string $table = 'temoignage';

    /**
     * Upload directory path relative to public/
     */
    private string $uploadDir = __DIR__ . '/../../public/assets/uploads/temoignages/';

    /**
     * Retrieve all active testimonials (for front-office homepage display)
     * 
     * @return array
     */
    public function allActive(): array {
        $sql = "SELECT * FROM `{$this->table}` WHERE `actif` = 1 ORDER BY `date_creation` DESC";
        return $this->db->all($sql);
    }

    /**
     * Retrieve all testimonials ordered by date (for admin panel list)
     * 
     * @return array
     */
    public function all(): array {
        $sql = "SELECT * FROM `{$this->table}` ORDER BY `date_creation` DESC";
        return $this->db->all($sql);
    }

    /**
     * Count total testimonials
     * 
     * @return int
     */
    public function count(): int {
        $sql = "SELECT COUNT(*) as total FROM `{$this->table}`";
        $result = $this->db->row($sql);
        return (int)($result['total'] ?? 0);
    }

    /**
     * Count active testimonials
     * 
     * @return int
     */
    public function countActive(): int {
        $sql = "SELECT COUNT(*) as total FROM `{$this->table}` WHERE `actif` = 1";
        $result = $this->db->row($sql);
        return (int)($result['total'] ?? 0);
    }

    /**
     * Create a new testimonial record
     * 
     * @param array $data keys: nom_client, fonction_client, message, actif
     * @param array|null $file The $_FILES['photo'] array
     * @return bool
     */
    public function create(array $data, ?array $file = null): bool {
        $photoName = null;

        // Handle profile photo upload if provided
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $photoName = $this->uploadImage($file);
            if (!$photoName) {
                return false;
            }
        }

        $sql = "INSERT INTO `{$this->table}` (`nom_client`, `fonction_client`, `message`, `photo`, `actif`) 
                VALUES (:nom_client, :fonction_client, :message, :photo, :actif)";

        $this->db->query($sql, [
            'nom_client'      => $data['nom_client'],
            'fonction_client' => $data['fonction_client'] ?? '',
            'message'         => $data['message'],
            'photo'           => $photoName,
            'actif'           => isset($data['actif']) ? (int)$data['actif'] : 1,
        ]);

        return true;
    }

    /**
     * Update an existing testimonial record
     * 
     * @param int $id Testimonial ID
     * @param array $data keys: nom_client, fonction_client, message, actif
     * @param array|null $file The $_FILES['photo'] array
     * @return bool
     */
    public function update(int $id, array $data, ?array $file = null): bool {
        $existing = $this->find($id);
        if (!$existing) {
            return false;
        }

        $photoName = $existing['photo']; // Keep current photo by default

        // Handle new photo upload
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $newPhoto = $this->uploadImage($file);
            if ($newPhoto) {
                // Delete old photo if it exists
                $this->deleteImage($existing['photo']);
                $photoName = $newPhoto;
            }
        }

        $sql = "UPDATE `{$this->table}` 
                SET `nom_client` = :nom_client, `fonction_client` = :fonction_client, 
                    `message` = :message, `photo` = :photo, `actif` = :actif 
                WHERE `id` = :id";

        $this->db->query($sql, [
            'id'              => $id,
            'nom_client'      => $data['nom_client'],
            'fonction_client' => $data['fonction_client'] ?? '',
            'message'         => $data['message'],
            'photo'           => $photoName,
            'actif'           => isset($data['actif']) ? (int)$data['actif'] : 1,
        ]);

        return true;
    }

    /**
     * Delete a testimonial by ID and remove its image file
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $existing = $this->find($id);
        if (!$existing) {
            return false;
        }

        // Delete associated avatar photo file
        $this->deleteImage($existing['photo']);

        $sql = "DELETE FROM `{$this->table}` WHERE `id` = :id";
        $this->db->query($sql, ['id' => $id]);

        return true;
    }

    /**
     * Toggle the active status of a testimonial
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
     * Upload an image file to the testimonials upload directory
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

        // Validate file size (max 2MB for avatars)
        $maxSize = 2 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            return null;
        }

        // Create upload directory if it doesn't exist
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }

        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'testimonial_' . uniqid() . '.' . strtolower($extension);

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
