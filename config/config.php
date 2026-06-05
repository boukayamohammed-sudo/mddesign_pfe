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

// Application Configuration
define('APP_NAME', 'MD Design');

// Dynamic base URL detection to support flexible execution paths and ports
$scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) : '/mddesign_pfe';
$scriptDir = rtrim($scriptDir, '/');
define('APP_URL', $scheme . '://' . $host . $scriptDir);

// Error Reporting (Enable for development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
