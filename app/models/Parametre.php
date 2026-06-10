<?php

/**
 * MD Design - Parametre Model
 * 
 * Manages configuration settings for the agency, including
 * database read/write actions and logo file uploading.
 */
class Parametre extends Model {
    protected string $table = 'parametre';

    /**
     * Upload directory path relative to public/
     */
    private string $uploadDir = __DIR__ . '/../../public/assets/uploads/logos/';

    /**
     * Fetch the single configuration row
     * 
     * @return array|null
     */
    public function get(): ?array {
        $sql = "SELECT * FROM `{$this->table}` LIMIT 1";
        return $this->db->row($sql);
    }

    /**
     * Update the configuration parameters
     * 
     * @param array $data keys: nom_agence, telephone, whatsapp, email, adresse, facebook, instagram, google_maps_url, description_agence
     * @param array|null $file $_FILES['logo'] upload array
     * @return bool
     */
    public function updateSettings(array $data, ?array $file = null): bool {
        $existing = $this->get();

        if (!$existing) {
            // Insert single fallback record if empty
            $logoName = null;
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                $logoName = $this->uploadLogo($file);
            }

            $sql = "INSERT INTO `{$this->table}` (`nom_agence`, `logo`, `telephone`, `whatsapp`, `email`, `adresse`, `facebook`, `instagram`, `google_maps_url`, `description_agence`) 
                    VALUES (:nom_agence, :logo, :telephone, :whatsapp, :email, :adresse, :facebook, :instagram, :google_maps_url, :description_agence)";
            
            $this->db->query($sql, [
                'nom_agence'         => $data['nom_agence'],
                'logo'               => $logoName,
                'telephone'          => $data['telephone'] ?? null,
                'whatsapp'           => $data['whatsapp'] ?? null,
                'email'              => $data['email'] ?? null,
                'adresse'            => $data['adresse'] ?? null,
                'facebook'           => $data['facebook'] ?? null,
                'instagram'          => $data['instagram'] ?? null,
                'google_maps_url'    => $data['google_maps_url'] ?? null,
                'description_agence' => $data['description_agence'] ?? null,
            ]);
            return true;
        }

        $logoName = $existing['logo'];

        // Handle logo replacement
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $newLogo = $this->uploadLogo($file);
            if ($newLogo) {
                $this->deleteLogo($existing['logo']);
                $logoName = $newLogo;
            } else {
                return false;
            }
        }

        $sql = "UPDATE `{$this->table}` SET 
                `nom_agence` = :nom_agence, 
                `logo` = :logo, 
                `telephone` = :telephone, 
                `whatsapp` = :whatsapp, 
                `email` = :email, 
                `adresse` = :adresse, 
                `facebook` = :facebook, 
                `instagram` = :instagram, 
                `google_maps_url` = :google_maps_url, 
                `description_agence` = :description_agence 
                WHERE `id` = :id";

        $this->db->query($sql, [
            'id'                 => $existing['id'],
            'nom_agence'         => $data['nom_agence'],
            'logo'               => $logoName,
            'telephone'          => $data['telephone'] ?? null,
            'whatsapp'           => $data['whatsapp'] ?? null,
            'email'              => $data['email'] ?? null,
            'adresse'            => $data['adresse'] ?? null,
            'facebook'           => $data['facebook'] ?? null,
            'instagram'          => $data['instagram'] ?? null,
            'google_maps_url'    => $data['google_maps_url'] ?? null,
            'description_agence' => $data['description_agence'] ?? null,
        ]);

        return true;
    }

    /**
     * Upload logo image to directory
     * 
     * @param array $file
     * @return string|null
     */
    private function uploadLogo(array $file): ?string {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            return null;
        }

        // Limit to 5MB
        $maxSize = 5 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            return null;
        }

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'logo_' . uniqid() . '.' . strtolower($extension);
        $destination = $this->uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $filename;
        }

        return null;
    }

    /**
     * Delete a logo image file from storage
     * 
     * @param string|null $filename
     * @return void
     */
    private function deleteLogo(?string $filename): void {
        if ($filename) {
            $filepath = $this->uploadDir . $filename;
            if (file_exists($filepath)) {
                unlink($filepath);
            }
        }
    }
}
