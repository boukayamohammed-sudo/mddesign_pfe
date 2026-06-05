<?php

/**
 * MD Design - Base Model Class
 * 
 * Sets up the shared database connection and defines standard
 * database operations inherited by specific entity models.
 */
class Model {
    protected Database $db;
    protected string $table;

    /**
     * Constructor initializes connection instance
     */
    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Retrieve all records from the table
     * 
     * @return array
     */
    public function all(): array {
        $sql = "SELECT * FROM `{$this->table}`";
        return $this->db->all($sql);
    }

    /**
     * Find a single record by its primary key ID
     * 
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array {
        $sql = "SELECT * FROM `{$this->table}` WHERE `id` = :id LIMIT 1";
        return $this->db->row($sql, ['id' => $id]);
    }
}
