<?php

/**
 * MD Design - Base Controller Class
 * 
 * Provides utility methods for controllers to render HTML views
 * and handle HTTP redirection.
 */
class Controller {
    /**
     * Render a view file with passed data variables
     * 
     * @param string $viewName The view path relative to app/views/ (e.g. 'home/index')
     * @param array $data Associative array of data to extract and make available to the view
     * @return void
     */
    protected function view(string $viewName, array $data = []): void {
        // Extract the associative array into active local symbol table
        extract($data);

        $viewFile = __DIR__ . '/../views/' . $viewName . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View template file not found: {$viewName}.php");
        }
    }

    /**
     * Redirect to a specific URL path
     * 
     * @param string $url Relative route (e.g. 'admin/dashboard') or absolute URL
     * @return void
     */
    protected function redirect(string $url): void {
        // If it's a relative path, resolve it relative to the APP_URL
        if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
            $url = APP_URL . '/' . ltrim($url, '/');
        }

        header("Location: " . $url);
        exit();
    }
}
