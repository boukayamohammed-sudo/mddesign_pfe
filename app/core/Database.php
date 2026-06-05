<?php

/**
 * MD Design - Database Connection Manager (Singleton)
 * 
 * Manages a single PDO connection to the database and provides
 * convenient query execution wrappers.
 */
class Database {
    private static ?Database $instance = null;
    private PDO $conn;

    /**
     * Private constructor to enforce Singleton pattern
     */
    private function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // In a production environment, log error instead of die
            die("Database connection error: " . $e->getMessage());
        }
    }

    /**
     * Prevent cloning of the instance
     */
    private function __clone() {}

    /**
     * Prevent unserialization of the instance
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }

    /**
     * Get the Singleton instance of the Database
     * 
     * @return Database
     */
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get the underlying PDO connection
     * 
     * @return PDO
     */
    public function getConnection(): PDO {
        return $this->conn;
    }

    /**
     * Prepare and execute an SQL statement
     * 
     * @param string $sql
     * @param array $params
     * @return PDOStatement
     * @throws Exception
     */
    public function query(string $sql, array $params = []): PDOStatement {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage() . " (SQL: $sql)");
        }
    }

    /**
     * Fetch a single row from the database
     * 
     * @param string $sql
     * @param array $params
     * @return array|null
     */
    public function row(string $sql, array $params = []): ?array {
        $stmt = $this->query($sql, $params);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Fetch all rows from the database
     * 
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function all(string $sql, array $params = []): array {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
}
