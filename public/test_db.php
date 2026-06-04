<?php
/**
 * MD Design - Database Connection Test Script
 * Verifies that the PHP PDO extension can connect to MySQL
 * using credentials defined in config/config.php.
 */

// Load database configuration parameters
require_once __DIR__ . '/../config/config.php';

try {
    // 1. Build the Data Source Name (DSN) string
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

    // 2. Set PDO options for error handling and data retrieval
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on SQL errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retrieve data as associative arrays
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
    ];

    // 3. Instantiate the PDO database connection
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

    // 4. Output success message
    echo "<div style='padding: 20px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; font-family: sans-serif; max-width: 600px; margin: 40px auto; text-align: center;'>";
    echo "<h2>🎉 Connection Successful!</h2>";
    echo "<p>PHP has successfully established a secure connection to the database <strong>" . DB_NAME . "</strong> using PDO.</p>";
    echo "</div>";

} catch (PDOException $e) {
    // 5. Output error message if connection fails
    echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; font-family: sans-serif; max-width: 600px; margin: 40px auto;'>";
    echo "<h2 style='margin-top: 0;'>❌ Database Connection Failed!</h2>";
    echo "<p><strong>Error Message:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>Error Code:</strong> " . (int)$e->getCode() . "</p>";
    echo "<p>Please verify your configuration parameters in <code>config/config.php</code> and ensure your MySQL server is running in XAMPP.</p>";
    echo "</div>";
}
