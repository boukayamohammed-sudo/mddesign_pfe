<?php

/**
 * MD Design - Front Controller (Application Entry Point)
 * 
 * Sets up autoloader, initializes session, loads helpers, registers routes,
 * parses current request path, and dispatches to target controller action.
 */

// 1. Load Configurations
require_once __DIR__ . '/../config/config.php';

// 2. Load Core Framework Files
require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';
require_once __DIR__ . '/../app/core/Session.php';

// 3. Register Autoloader for Controllers and Models
spl_autoload_register(function ($className) {
    // Look up in controllers folder
    $controllerFile = __DIR__ . '/../app/controllers/' . $className . '.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        return;
    }

    // Look up in models folder
    $modelFile = __DIR__ . '/../app/models/' . $className . '.php';
    if (file_exists($modelFile)) {
        require_once $modelFile;
        return;
    }
});

// 4. Initialize Secure Session Context
$session = new Session();
$session->init();

// 5. Instantiate Router and Register Application Routes
$router = new Router();

// Public Front-Office Routes
$router->add('/', 'HomeController@index');
$router->add('/home', 'HomeController@index');
$router->add('/services', 'ServiceController@index');
$router->add('/services/detail/{id}', 'ServiceController@detail');
$router->add('/realisations', 'RealisationController@index');
$router->add('/contact', 'ContactController@index');
$router->add('/contact/submit', 'ContactController@submit');

// Admin Auth Routes
$router->add('/login', 'AuthController@login');
$router->add('/logout', 'AuthController@logout');

// Protected Back-Office Admin Routes
$router->add('/admin/dashboard', 'DashboardController@index');

// Admin Service Routes
$router->add('/admin/services', 'ServiceController@adminIndex');
$router->add('/admin/services/create', 'ServiceController@create');
$router->add('/admin/services/edit/{id}', 'ServiceController@edit');
$router->add('/admin/services/delete/{id}', 'ServiceController@deleteService');
$router->add('/admin/services/toggle/{id}', 'ServiceController@toggleActive');

// Admin Paramètres Routes
$router->add('/admin/parametres', 'ParametreController@index');
$router->add('/admin/parametres/update', 'ParametreController@update');

// Admin Témoignages Routes
$router->add('/admin/temoignages', 'TemoignageController@index');
$router->add('/admin/temoignages/create', 'TemoignageController@create');
$router->add('/admin/temoignages/edit/{id}', 'TemoignageController@edit');
$router->add('/admin/temoignages/delete/{id}', 'TemoignageController@delete');

// 6. Extract Request URI relative to base folder directory
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

// Extract the base script directory path (handles execution in subfolders on local Apache/XAMPP server)
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

// Remove directory prefix from requested URL
if (strpos($requestUri, $scriptDir) === 0) {
    $requestUri = substr($requestUri, strlen($scriptDir));
}

// Remove index.php prefix if present (e.g. /index.php or /index.php/route)
if (strpos($requestUri, '/index.php') === 0) {
    $requestUri = substr($requestUri, 10);
}

// Ensure it starts with a leading slash and is cleaned
$requestUri = '/' . ltrim($requestUri, '/');

// Dispatch routing execution
$router->dispatch($requestUri);