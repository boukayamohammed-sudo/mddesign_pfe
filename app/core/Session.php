<?php

/**
 * MD Design - Session Management Class
 * 
 * Provides safe abstractions to initiate sessions, read, write
 * session values, and destroy active sessions during logout.
 */
class Session {
    /**
     * Initialize the session securely if not already active
     * 
     * @return void
     */
    public function init(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start([
                'cookie_httponly' => true,
                'use_only_cookies' => true,
            ]);
        }
    }

    /**
     * Set a session parameter
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, $value): void {
        $this->init();
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session parameter value
     * 
     * @param string $key
     * @return mixed
     */
    public function get(string $key) {
        $this->init();
        return $_SESSION[$key] ?? null;
    }

    /**
     * Check if a session parameter is set
     * 
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool {
        $this->init();
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a session parameter
     * 
     * @param string $key
     * @return void
     */
    public function remove(string $key): void {
        $this->init();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroy the current session context
     * 
     * @return void
     */
    public function destroy(): void {
        if (session_status() !== PHP_SESSION_NONE) {
            $_SESSION = [];
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(), 
                    '', 
                    time() - 42000,
                    $params["path"], 
                    $params["domain"],
                    $params["secure"], 
                    $params["httponly"]
                );
            }
            session_destroy();
        }
    }
}
