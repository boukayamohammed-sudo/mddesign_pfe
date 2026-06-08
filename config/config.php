<?php
/**
 * MD Design - Global Configuration File
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'md_design');
define('DB_CHARSET', 'utf8mb4');

// Application URL configuration (dynamic to handle any local host, port, and subfolder setup)
if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $scriptDir = ($scriptDir === '/') ? '' : $scriptDir;
    define('APP_URL', $protocol . '://' . $host . $scriptDir);
} else {
    define('APP_URL', 'http://localhost/mddesign_pfe/public'); // Fallback for CLI
}

// Application Configuration
define('APP_NAME', 'MD Design');

// Error Reporting (Enable for development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
