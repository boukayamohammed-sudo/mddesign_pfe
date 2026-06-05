<?php

/**
 * MD Design - Global Helper Functions
 */

/**
 * Escape output for XSS protection
 * 
 * @param string|null $value
 * @return string
 */
function e(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Generate an absolute URL path
 * 
 * @param string $path E.g., 'services/detail/1'
 * @return string
 */
function url(string $path = ''): string {
    return APP_URL . '/' . ltrim($path, '/');
}

/**
 * Generate an absolute URL path for a public asset
 * 
 * @param string $path E.g., 'css/style.css'
 * @return string
 */
function asset(string $path): string {
    return APP_URL . '/assets/' . ltrim($path, '/');
}

/**
 * Dump and die (debugging helper)
 * 
 * @param mixed $value
 * @return void
 */
function dd($value): void {
    echo "<pre style='background-color: #2c2c2c; color: #ff7a00; padding: 15px; border-radius: 5px; font-family: monospace; overflow: auto; max-height: 500px;'>";
    var_dump($value);
    echo "</pre>";
    exit();
}

/**
 * Retrieve corporate settings dynamically from the database
 * 
 * @param string|null $key
 * @return mixed
 */
function settings(?string $key = null) {
    static $settings = null;
    
    if ($settings === null) {
        try {
            $db = Database::getInstance();
            $settings = $db->row("SELECT * FROM `parametre` LIMIT 1") ?: [];
        } catch (Exception $e) {
            $settings = [];
        }
    }
    
    if ($key === null) {
        return $settings;
    }
    
    return $settings[$key] ?? '';
}

/**
 * Enforce administrator authentication
 * 
 * @return void
 */
function check_admin(): void {
    $session = new Session();
    if (!$session->has('admin_logged')) {
        header("Location: " . url('login'));
        exit();
    }
}

/**
 * Generate an absolute URL for an uploaded file
 * 
 * @param string $subdir Subdirectory under uploads/ (e.g., 'services')
 * @param string $filename The filename
 * @return string
 */
function upload_url(string $subdir, string $filename): string {
    return APP_URL . '/assets/uploads/' . $subdir . '/' . $filename;
}

/**
 * Set a flash message in the session
 * 
 * @param string $type 'success' or 'error'
 * @param string $message The message text
 * @return void
 */
function flash(string $type, string $message): void {
    $session = new Session();
    $session->set('flash_' . $type, $message);
}

/**
 * Get and clear a flash message from the session
 * 
 * @param string $type 'success' or 'error'
 * @return string|null
 */
function get_flash(string $type): ?string {
    $session = new Session();
    $message = $session->get('flash_' . $type);
    if ($message) {
        $session->remove('flash_' . $type);
    }
    return $message;
}

