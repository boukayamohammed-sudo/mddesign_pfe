<?php
/**
 * MD Design - Configuration File
 * Contains database credentials and global application settings.
 */

// Database configuration parameters
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'md_design');
define('DB_CHARSET', 'utf8mb4');

// Application URL configuration
define('APP_URL', 'http://localhost/mddesign_pfe');
define('APP_NAME', 'MD Design');

// Error reporting (enabled for development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
