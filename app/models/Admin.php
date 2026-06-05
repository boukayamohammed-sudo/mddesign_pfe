<?php

/**
 * MD Design - Admin Model
 * 
 * Manages authentication and session initialization for administrators.
 */
class Admin extends Model {
    protected string $table = 'admin';

    /**
     * Authenticate an admin by verifying credentials against stored hash
     * 
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function authenticate(string $username, string $password): bool {
        $sql = "SELECT * FROM `{$this->table}` WHERE `identifiant` = :username LIMIT 1";
        $admin = $this->db->row($sql, ['username' => $username]);

        if ($admin && password_verify($password, $admin['mot_de_passe'])) {
            // Set session variables upon successful authentication
            $session = new Session();
            $session->set('admin_logged', true);
            $session->set('admin_id', (int)$admin['id']);
            $session->set('admin_username', $admin['identifiant']);
            return true;
        }

        return false;
    }
}
