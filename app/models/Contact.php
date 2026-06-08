<?php

/**
 * MD Design - Contact Model
 * 
 * Manages operations for visitor messages sent via the contact form.
 */
class Contact extends Model {
    protected string $table = 'contact';

    /**
     * Retrieve all messages ordered by submission date (newest first)
     * 
     * @return array
     */
    public function all(): array {
        $sql = "SELECT * FROM `{$this->table}` ORDER BY `date_envoi` DESC, `id` DESC";
        return $this->db->all($sql);
    }

    /**
     * Create a new contact message record
     * 
     * @param array $data keys: nom_complet, telephone, email, sujet, message
     * @return bool
     */
    public function create(array $data): bool {
        $sql = "INSERT INTO `{$this->table}` (`nom_complet`, `telephone`, `email`, `sujet`, `message`, `lu`) 
                VALUES (:nom_complet, :telephone, :email, :sujet, :message, 0)";

        $this->db->query($sql, [
            'nom_complet' => $data['nom_complet'],
            'telephone'   => !empty($data['telephone']) ? $data['telephone'] : null,
            'email'       => $data['email'],
            'sujet'       => $data['sujet'],
            'message'     => $data['message'],
        ]);

        return true;
    }

    /**
     * Mark a message as read
     * 
     * @param int $id
     * @return bool
     */
    public function markAsRead(int $id): bool {
        $sql = "UPDATE `{$this->table}` SET `lu` = 1 WHERE `id` = :id";
        $this->db->query($sql, ['id' => $id]);
        return true;
    }

    /**
     * Delete a message by ID
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $sql = "DELETE FROM `{$this->table}` WHERE `id` = :id";
        $this->db->query($sql, ['id' => $id]);
        return true;
    }

    /**
     * Count the number of unread messages (for dashboard badge)
     * 
     * @return int
     */
    public function countUnread(): int {
        $sql = "SELECT COUNT(*) as total FROM `{$this->table}` WHERE `lu` = 0";
        $result = $this->db->row($sql);
        return (int)($result['total'] ?? 0);
    }

    /**
     * Count total messages
     * 
     * @return int
     */
    public function count(): int {
        $sql = "SELECT COUNT(*) as total FROM `{$this->table}`";
        $result = $this->db->row($sql);
        return (int)($result['total'] ?? 0);
    }
}
